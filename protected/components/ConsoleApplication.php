<?php


class ConsoleApplication extends CConsoleApplication
{
    private $_theme;

    /**
     * Returns the widget factory.
     * @return IWidgetFactory the widget factory
     * @since 1.1
     */
    public function getWidgetFactory()
    {
        return Yii::app()->getComponent('widgetFactory');
    }

    /**
     * @return CThemeManager the theme manager.
     */
    public function getThemeManager()
    {
        return $this->getComponent('themeManager');
    }

    /**
     * @return CTheme the theme used currently. Null if no theme is being used.
     */
    public function getTheme()
    {
        if(is_string($this->_theme))
            $this->_theme=$this->getThemeManager()->getTheme($this->_theme);
        return $this->_theme;
    }

    /**
     * @param string $value the theme name
     */
    public function setTheme($value)
    {
        $this->_theme=$value;
    }

    /**
     * Returns the view renderer.
     * If this component is registered and enabled, the default
     * view rendering logic defined in {@link CBaseController} will
     * be replaced by this renderer.
     * @return IViewRenderer the view renderer.
     */
    public function getViewRenderer()
    {
        return $this->getComponent('viewRenderer');
    }
}