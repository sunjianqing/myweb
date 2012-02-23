<?php

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  Copyright (c) 2011 eBay Inc. All Rights Reserved
 * @license    Confidential - intended only for the use of eBay employees
 * @version    1.0 (Nov 30, 2011)
 * @author     jianqsun
 */
require_once 'Zend/Db/Table/Abstract.php';
class User extends Zend_Db_Table_Abstract {
   protected $_name = 'user';
   
   public function getUserByLogin($login){
		$user = $this->fetchAll('login = "'.$login.'"')->toArray();
		return $user;
   }
   
   public function userAuth($username, $passwd){
		$select = $this->_db->select()->from(array('u' => 'user'))
									->where("u.username =?", $username)
									->where("u.passwd =?", md5($passwd));
		$res = $this->_db->fetchAll($select);
		/*
		$select = $this->select()->where('username = ?', $username)
								->where('passwd = ?', md5($passwd));
 		$rows = $this->fetchAll($select)->toArray();
 		*/
		return !empty($res);
   }
   
}