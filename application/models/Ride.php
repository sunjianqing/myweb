<?php
/**
 * Ride
 * 
 * @author jianqsun
 * @version 
 */
require_once 'Zend/Db/Table/Abstract.php';
class Ride extends Zend_Db_Table_Abstract
{
    /**
     * The default table name 
     */
    protected $_name = 'ride';
    
    protected $_id;
    
    /*
    public function __construct($ride_id = 0){
    	parent::__construct();
    	$this->_id = $ride_id;
    }
    */
    
    public function setId($id){
    	$this->_id = $id;
    }
    
    public function getRideById(){
    	$sql = "select * from ride where id = ".$this->_id;
    	$res = $this->_db->query($sql)->fetchAll();
    	//echo $res[0]['ride_desc'];
    	return $res;
    }
}
