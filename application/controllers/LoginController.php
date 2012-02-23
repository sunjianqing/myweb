<?php
require_once APPLICATION_PATH."/models/User.php";
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  Copyright (c) 2012 eBay Inc. All Rights Reserved
 * @license    Confidential - intended only for the use of eBay employees
 * @version    1.0 (Feb 18, 2012)
 * @author     jianqsun
 */
class  LoginController extends Zend_Controller_Action{
	
	protected $_redirector = null;
	
	public function init()
    {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction()
    {
    	$login_ok = false;

    	$username = $this->_request->username;
    	$passwd = $this->_request->passwd;
    	if(!empty($username) && !empty($passwd))
    	{
    		$user = new User();
        	$login_ok = $user->userAuth($username, $passwd);
    	}
    	
    	if($login_ok == true){
 			
			$this->_redirector->gotoSimple('index', 'Index');
    	}
    	
    }
    
}