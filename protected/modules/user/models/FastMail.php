<?php

/**
 * This is the model class for table "{{tips_fast_mailing}}".
 */
class FastMail extends CActiveRecord {

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tips_fast_mailing}}';
	}
	
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave(){

		if(parent::beforeSave()){
			
			if($this->isNewRecord){
				$this->create_date = date("U");
			}
			
			return true;
		
		}else{
			return false;
		}
	}

}