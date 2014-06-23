<?php

class weather extends CApplicationComponent {
	
	public $key;
	
	protected $url;
	
	public function city($str){
		$this->url = 'http://api.worldweatheronline.com/free/v1/weather.ashx?q='.$str.'&format=json&num_of_days=1&date=today&key='.$this->key;
		
		$data = @file_get_contents($this->url);
		$json = json_decode($data);
		
		return $json;
	}
}