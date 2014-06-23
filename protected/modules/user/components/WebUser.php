<?php
class WebUser extends CWebUser {

    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            return $user->AccessRoleName;
        }
    }
	
	function getRoleId() {
        if($user = $this->getModel()){
            return $user->role;
        }
    }
	
	function getPhoto(){
		if($user = $this->getModel()){
            return $user->photoThumb;
        }
	}

    function getIsTipster(){
        if($user = $this->getModel()){
            return in_array($user->role, array(User::ROLE_TIPSTER, User::ROLE_MODERATOR, User::ROLE_ADMIN));
        }
    }
	
	function getIsAdmin(){
        if($user = $this->getModel()){
            return in_array($user->role, array(User::ROLE_ADMIN));
        }
    }
	
	function getIsEditor(){
		if($user = $this->getModel()){
			
            if($user->role == User::ROLE_TIPSTER AND $user->tipster!=null)
				return $user->tipster->editor;
			
			return false;
        }
	}
	
	function getIsManager(){
		if($user = $this->getModel()){
			return in_array($user->role, array(User::ROLE_ADMIN, User::ROLE_MANAGER));
        }
	}
	
	function getAccessView(){
		if($user = $this->getModel())
            return $user->AccessViewTips;
	}
	
	function load(){
		$this->getModel();
	}
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'id, role, photo'));
        }
        return $this->_model;
    }
}