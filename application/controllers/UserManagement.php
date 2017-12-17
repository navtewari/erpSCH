<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('userManagement_model', 'umm');
    }
    function getUsers(){
    	$data = $this->umm->getUsers();
    	echo json_encode($data);	
    }
    function getuserstatus(){
    	$data['userstatus'] = $this->umm->getuserstatus();
    	echo json_encode($data);
    }
    function getStaffData($categ_status){
    	$data = $this->umm->getStaffData($categ_status);
    	echo json_encode($data);
    }
    function createuser(){
    	$data = $this->umm->createuser();
    	echo json_encode($data);
    }
    function activeDeactiveUser($user, $active_status){
    	$data = $this->umm->activeDeactiveUser($user, $active_status);
    	echo json_encode($data);
    }
}