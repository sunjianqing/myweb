<?php
/**
 * ServiceController
 * 
 * @author
 * @version 
 */
require_once 'Zend/Controller/Action.php';
class ServiceController extends Zend_Controller_Action
{
    /**
     * The default action - show the home page
     */
    public function indexAction ()
    {
        // TODO Auto-generated ServiceController::indexAction() default action
        
    	$this->view->test = 1;
    }
}
