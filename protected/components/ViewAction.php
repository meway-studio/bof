<?php

class ViewAction extends CViewAction
{
    public function run()
    {
        
        parent::run();
        
        if (!$this->resolveView( Yii::app()->language . '/' . $this->getRequestedView() )) {
            $this->resolveView( $this->getRequestedView() );
        }

    }

    protected function resolveView($viewPath)
	{
	    // start with a word char and have word chars, dots and dashes only
	    if(preg_match('/^\w[\w\.\-\/]*$/',$viewPath))
	    {
	        $view=strtr($viewPath,'.','/');
	        if(!empty($this->basePath))
	            $view=$this->basePath.'/'.$view;
	        if($this->getController()->getViewFile($view)!==false)
	        {
	            $this->view=$view;
	            return;
	        }
	    }
	    throw new CHttpException(404,Yii::t('yii','The requested view "{name}" was not found.',
	        array('{name}'=>$viewPath)));
	}
} 