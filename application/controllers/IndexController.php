<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $dbconf = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini','development');
		$db = Zend_Db::factory($dbconf->database);
		
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
		Zend_Registry::set('db',$db);
		
		require_once APPLICATION_PATH . '/models/User.php';
		
		$user = new Users(); // Users Table Object. 
		$rowset = $user->fetchAll()->toArray();
		$list_of_users = array();
		
		foreach($rowset as $row) {
			$list_of_users[] = $row->id;
		}
		//$this->view->userlist
		$this->view->id = 2;
  		
    }

    public function ajaxAction()
    {
    	
    }
    
    

}

