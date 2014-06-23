<?php
class ServiceUserIdentity extends UserIdentity {

    const ERROR_NOT_AUTHENTICATED = 3;

    /**
     * @var EAuthServiceBase the authorization service instance.
     */
    protected $service;
    
    /**
     * Constructor.
     * @param EAuthServiceBase $service the authorization service instance.
     */
    public function __construct($service) {
        $this->service = $service;
    }
    
    /**
     * Authenticates a user based on {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {        
        if ($this->service->isAuthenticated) {
		
            $this->username = $this->service->getAttribute('name');
			
			$hash  = md5($this->service->serviceName.$this->service->id);
			$eauth = UserEauth::model()->findByAttributes(array('hash'=>$hash));
			
			// зарегистрировать пользователя если еще не зарегистрирован
			if($eauth==null){
			
				$user = new User('eauth');
				$user->firstname  = $this->username;
				$user->status     = 1;
				$user->role       = 1;
				$user->save();
				
				$eauth = new UserEauth();
				$eauth->user_id = $user->id;
				$eauth->hash    = $hash;
				$eauth->service = $this->service->serviceName;
				$eauth->save();
				
			}else{
			
				$user = $eauth->user;
			}
			
			$this->_id        = $user->id;
            $this->_FullName  = $user->FullName;

			$this->setState('FullName' , $this->_FullName);
			$this->setState('login',     $this->_login);

            $this->errorCode = self::ERROR_NONE;        
        }
        else {
            $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
        }
        return !$this->errorCode;
    }
	
	public function bindAuthenticate(){
		if ($this->service->isAuthenticated) {
		
            $this->username = $this->service->getAttribute('name');
			
			$hash  = md5($this->service->serviceName.$this->service->id);
			$eauth = UserEauth::model()->findByAttributes(array('hash'=>$hash));
			
			if($eauth==null){
				$eauth = new UserEauth();
				$eauth->user_id = Yii::app()->user->id;
				$eauth->hash    = $hash;
				$eauth->service = $this->service->serviceName;
				$eauth->save();
			}

            $this->errorCode = self::ERROR_NONE;        
        }
        else {
            $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
        }
        return !$this->errorCode;
	}
}