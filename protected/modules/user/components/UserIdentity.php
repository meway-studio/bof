<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	protected $_id;
	protected $_FullName;
	protected $_login;
	protected $_photo;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate(){
	
		$record = User::model()->findByAttributes(array('email'=>$this->username));
		
        if($record===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
			
        }else if($record->password!==User::cryptPassword($this->password) OR !$record->isActive){
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
			
        }else{
			$this->_id        = $record->id;
            $this->_FullName  = $record->FullName;
            $this->_photo     = $record->PhotoThumb;

			$this->setState('FullName' , $this->_FullName);
			$this->setState('login',     $this->_login);
			$this->setState('photo',     $this->_photo);

            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
	}
	
	public function getId(){
		return $this->_id;
	}
	
	public function getName(){
		return $this->_FullName;
	}

	public function getPhoto(){
		return $this->_photo;
	}
}