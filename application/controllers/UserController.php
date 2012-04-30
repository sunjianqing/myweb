<?php
require_once APPLICATION_PATH."/models/User.php";
class UserController extends Zend_Controller_Action
{
	public function init()
    {
        /* Initialize action controller here */
    }
    
    public function registerAction(){
    	
    	$username = $this->_request->username;
    	$email = $this->_request->email;
    	$passwd = $this->_request->passwd;
    	$passwd2 = $this->_request->passwd2;
    	
    	$user_obj = new User();
    	$user = $user_obj->getUserByLogin($username);
    	
    	if(empty($user)){
    		if($passwd == $passwd2 && filter_var($email, FILTER_VALIDATE_EMAIL)){
    			$user_obj = $user_obj->createUser($username, $passwd, $email);
    			$auth = Zend_Auth::getInstance();
    			$userInfo = new stdClass();
    			$userInfo->username = $username;
    			$authStorage = $auth->getStorage();
    			$authStorage->write($userInfo);
    			$this->_redirect('index');
    		}
    	}
    	
    }
    
    public function profileAction(){
    	
    }
}
?>