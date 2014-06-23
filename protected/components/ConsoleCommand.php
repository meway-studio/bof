<?php

class ConsoleCommand extends CConsoleCommand
{
    private $_widgetStack=array();

    /**
     * Creates a widget and initializes it.
     * This method first creates the specified widget instance.
     * It then configures the widget's properties with the given initial values.
     * At the end it calls {@link CWidget::init} to initialize the widget.
     * Starting from version 1.1, if a {@link CWidgetFactory widget factory} is enabled,
     * this method will use the factory to create the widget, instead.
     * @param string $className class name (can be in path alias format)
     * @param array $properties initial property values
     * @return CWidget the fully initialized widget instance.
     */
    public function createWidget($className,$properties=array())
    {
        $widget=Yii::app()->getWidgetFactory()->createWidget($this,$className,$properties);
        $widget->init();
        return $widget;
    }


    /**
     * Creates a widget and executes it.
     * @param string $className the widget class name or class in dot syntax (e.g. application.widgets.MyWidget)
     * @param array $properties list of initial property values for the widget (Property Name => Property Value)
     * @param boolean $captureOutput whether to capture the output of the widget. If true, the method will capture
     * and return the output generated by the widget. If false, the output will be directly sent for display
     * and the widget object will be returned. This parameter is available since version 1.1.2.
     * @return mixed the widget instance when $captureOutput is false, or the widget output when $captureOutput is true.
     */
    public function widget($className,$properties=array(),$captureOutput=false)
    {
        if($captureOutput)
        {
            ob_start();
            ob_implicit_flush(false);

            $widget=$this->createWidget($className,$properties);
            $widget->run();
            return ob_get_clean();
        }
        else
        {
            $widget=$this->createWidget($className,$properties);
            $widget->run();
            return $widget;
        }
    }

    /**
     * Creates a widget and executes it.
     * This method is similar to {@link widget()} except that it is expecting
     * a {@link endWidget()} call to end the execution.
     * @param string $className the widget class name or class in dot syntax (e.g. application.widgets.MyWidget)
     * @param array $properties list of initial property values for the widget (Property Name => Property Value)
     * @return CWidget the widget created to run
     * @see endWidget
     */
    public function beginWidget($className,$properties=array())
    {
        $widget=$this->createWidget($className,$properties);
        $this->_widgetStack[]=$widget;
        return $widget;
    }

    /**
     * Ends the execution of the named widget.
     * This method is used together with {@link beginWidget()}.
     * @param string $id optional tag identifying the method call for debugging purpose.
     * @return CWidget the widget just ended running
     * @throws CException if an extra endWidget call is made
     * @see beginWidget
     */
    public function endWidget($id='')
    {
        if(($widget=array_pop($this->_widgetStack))!==null)
        {
            $widget->run();
            return $widget;
        }
        else
            throw new CException(Yii::t('yii','{controller} has an extra endWidget({id}) call in its view.',
                array('{controller}'=>get_class($this),'{id}'=>$id)));
    }
}
 