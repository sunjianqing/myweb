<?php
require_once APPLICATION_PATH."/models/User.php";
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		// get the user info from the storage (session)  
		$userInfo = Zend_Auth::getInstance()->getStorage()->read();  
		if(!empty($userInfo)){
			$this->view->userinfo = $userInfo;
		}
       
    }
	 

}

