<?php

class Auth extends CWidget
{

	protected $count = 0;

	public function init(){

		$session = new CHttpSession;
		$session->open();

		if(isset($session['cart']))
			$this->count = count($session['cart']);
	}
	
	public function run(){
		$this->render('view' , array('count'=>$this->count) );
	}


}