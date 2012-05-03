<?php

require_once APPLICATION_PATH."/models/Ride.php";
class RideController extends Zend_Controller_Action{
	
	public function requestAction(){
		$db =  Zend_Registry::get('dbay');
		$from_addr = $this->_getParam("passenger_from_addr");
		$to_addr = $this->_getParam("passenger_to_addr");
		$start_date = $this->_getParam("passenger_start_date");
		$end_date = $this->_getParam("passenger_end_date");
		$people_num = $this->_getParam("passenger_people_num");
		$price = $this->_getParam("passenger_price");
		$userInfo = Zend_Auth::getInstance()->getStorage()->read();
		$user_id = $userInfo->id;
		
		$db = Zend_Registry::get('dbay');
		$ride_obj = new Ride();
		$data['from_addr'] = $from_addr;
		$data['to_addr'] = $to_addr;
		$data['from_date'] = $start_date;
		$data['to_date'] = $end_date;
		$data['price'] = $price;
		$data['people_num'] = $people_num;
		$data['user_id'] = $user_id;
		$data['update_time'] = date("Y-m-d H:i:s");
		
		$ride_id = $ride_obj->insert($data);
		
		$this->_helper->json($ride_id);
	}

	public function postAction(){
		$db =  Zend_Registry::get('dbay');
		$from_addr = $this->_getParam("driver_from_addr");
		$to_addr = $this->_getParam("driver_to_addr");
		$start_date = $this->_getParam("driver_start_date");
		$end_date = $this->_getParam("driver_end_date");
		$seat_num = $this->_getParam("driver_seat_num");
		$price = $this->_getParam("driver_price");
		
		$userInfo = Zend_Auth::getInstance()->getStorage()->read();
		$user_id = $userInfo->id;
		
		$db = Zend_Registry::get('dbay');
		$ride_obj = new Ride();
		$data['from_addr'] = $from_addr;
		$data['to_addr'] = $to_addr;
		$data['from_date'] = $start_date;
		$data['to_date'] = $end_date;
		$data['price'] = $price;
		$data['user_id'] = $user_id;
		$data['seat_num'] = $seat_num;
		$data['update_time'] = date("Y-m-d H:i:s");
		
		$ride_id = $ride_obj->insert($data);
		
		/*
		$sql = " INSERT INTO user_ride (`user_id`,`ride_id`)
		VALUES ('$user_id','$ride_id') ";
		
		$db->query($sql);
		*/
		
		$this->_helper->json($seat_num);
	}
	
	public function indexAction(){
		$ride_num = $this->_request->ride;
		$ride_obj = new Ride();
		$ride_obj->setId($ride_num);
		$ride_info = $ride_obj->getRideById();
		
		$this->view->ride_info = $ride_info[0];
	}
}