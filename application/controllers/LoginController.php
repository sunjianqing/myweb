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

    	// If we're already logged in, just redirect  
        if(Zend_Auth::getInstance()->hasIdentity())  
        {  
            $this->_redirect('index');  
        }
    	
    	$username = $this->_request->username;
    	$passwd = $this->_request->passwd;
    	if(!empty($username) && !empty($passwd))
    	{
    		$dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
    		
			$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);  
    		$authAdapter->setTableName('user')  
            ->setIdentityColumn('username')  
            ->setCredentialColumn('passwd')  
            ->setCredentialTreatment('MD5(?)'); 
			
            $authAdapter->setIdentity($username)  
            ->setCredential($passwd);  
  
            $auth = Zend_Auth::getInstance();  
			$result = $auth->authenticate($authAdapter); 
			
			if($result->isValid())  
			{  
			    // get all info about this user from the login table  
			    // ommit only the password, we don't need that  
			    $userInfo = $authAdapter->getResultRowObject(null, 'passwd');  
			    // the default storage is a session with namespace Zend_Auth  
			    $authStorage = $auth->getStorage();  
			    $authStorage->write($userInfo);  
			    $this->_redirect('index');  
			}

    		/*
    		$user = new User();
        	$login_ok = $user->userAuth($username, $passwd);
    		*/
    	}
    	/*
    	if($login_ok == true){
 			$this->_redirector->gotoSimple('index', 'Index');
    	}
    	*/
    	
    }
    
	public function logoutAction()  
	{  
	    // clear everything - session is cleared also!  
	    Zend_Auth::getInstance()->clearIdentity();  
	    $this->_redirect('index');  
	}
    
}