<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initDb() {
        $db_file = $this->getOption('db_settings_file');
        $db_config = new Zend_Config_Ini(APPLICATION_PATH . $db_file, 'development');
        $db_array = $db_config->toArray();
        $dbs = (empty($db_array['database'])) ? array() : $db_array['database'];
        $init_db = Zend_Db::factory($dbs['adapter'], $dbs['params']);
		$init_db->setFetchMode(Zend_Db::FETCH_ASSOC);
        Zend_Registry::set($dbs['params']['dbname'], $init_db);
        Zend_Db_Table::setDefaultAdapter($init_db); 
    }
    
	protected function _initViewHelpers() {
     	
		$this->bootstrap('layout');
     	
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        //$view->user = $user = Zend_Auth::getInstance()->getStorage()->read();
        // get the user info from the storage (session)
        $userInfo = Zend_Auth::getInstance()->getStorage()->read();
        
        if(!empty($userInfo)){
        	$view->userinfo = $userInfo;
        }
        
	}

}

