<?php
/**
 * Class ImportCommand
 *
*/
class ImportCommand extends CConsoleCommand
{

	protected $attributes;

    public function actionInit() {

    }
	
	public function actionTest(){
		$str = '13.01.14';
		echo $str."\n";
		
		if(strlen($str)==8)
			$new_date = substr($str,0,6).'20'.substr($str,6,8);
		
		echo $new_date."\n";
		
		echo "\n\n";
	}

    public function actionIndex() {

		// открыть файл
    	$file   = Yii::getPathOfAlias('application.data') . DIRECTORY_SEPARATOR . 'import2.1.csv';
		$handle = fopen($file, "r");

		if(!$handle)
			Yii::app()->end(Yii::t('importcommand', 'Не возможно открыть файл {file}', array('{file}'=>$file)));

		// прочитать первую строку
		$this->attributes = fgetcsv($handle, 0, ";");
		
		//print_r($this->attributes);Yii::app()->end();
		
		// начать цикл
		while (($data = fgetcsv($handle, 0, ";")) !== FALSE){
			
			// составить ассоциативный массив на основании первой строки
			$attr = $this->setAttributes($data);
			
			// преобразовать формат данных
			$attr = $this->formatAttr($attr);

			// добавить запись в базу
			$this->addTip($attr);

			// обновить запись в базе
		}

		// Закрыть файл
		fclose($handle);

		Yii::app()->end();
    }

    protected function addTip($attributes){

    	//print_r($attributes);

    	$model = new Tips();
    	$model->scenario = 'import';
    	$model->attributes = $attributes;
    	$model->validate();

    	//print_r($model->attributes);Yii::app()->end();

    	if(!$model->hasErrors() AND $model->save()){
    		$model->save();
		echo Yii::t('importcommand', '{mid} добавлен', array('{mid}'=>$model->id));
		echo "\n";
    	}else{
    		print_r($attributes);
    		print_r($model->getErrors());
    		echo "\n";
    		Yii::app()->end();
    	}

    	//Yii::app()->end();
    }

    protected function setAttributes($data){
    	
    	$result = array();

    	for($i=0;$i<count($this->attributes);$i++){
    		$result[ $this->attributes[$i] ] = $data[$i];
    	}

    	return $result;
    }

    protected function formatAttr($data){

    	$tipsters = array(
    		'Oddsmaker'   => 20,
    		'Mantis'      => 21,
    		'De Generaal' => 22,
    	);

    	foreach($data AS $key => $value){
	    	
	    	switch($key){
	    		
	    		CASE 'create_date':
	    			$data[$key] = $this->prepareDate($value);
	    		break;
	    		
	    		CASE 'event_date':
	    			$data[$key] = $this->prepareDate($value);
	    		break;
	    		
	    		CASE 'tipster_id':
	    			$data[$key] = isset($tipsters[$value]) ? $tipsters[$value] : 0 ;
	    		break;
	    		
	    		CASE 'selection_num':
	    			$data[$key] = str_replace(",", ".", $value);
	    		break;

	    		CASE 'bet_on':
	    			$data[$key] = $value == $data['club_1'] ? 1 : 2;
	    		break;
	    		
	    		CASE 'odds':
	    			$data[$key] = str_replace(",", ".", $value);
	    		break;
	    		
	    		CASE 'stake':
	    			$data[$key] = str_replace(",", ".", $value);
	    		break;
	    		
	    		CASE 'profit':
	    			$data[$key] = str_replace(",", ".", $value);
	    		break;
	    	}
    	}

    	return $data;
    }
	
	protected function prepareDate($str){
	
		if(strlen($str)==8)
			$str = substr($str,0,6).'20'.substr($str,6,8);
			
		return strtotime($str);
	}
}