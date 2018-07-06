<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database(_DATABASE_);
        $this->load->model('my_usermanagement_model', 'mumm');
    }
    function getUsers($user = 'x'){
        if($user != 'x'){
            $data = $this->mumm->getUsers($user);
        } else {
            $data = $this->mumm->getUsers();
        }
    	echo json_encode($data);	
    }
    function getuserstatus(){
    	$data['userstatus'] = $this->mumm->getuserstatus();
    	echo json_encode($data);
    }
    function getStaffData($categ_status){
    	$data = $this->mumm->getStaffData($categ_status);
    	echo json_encode($data);
    }
    function createuser(){
    	$data = $this->mumm->createuser();
    	echo json_encode($data);
    }
    function updateuser(){
        $data = $this->mumm->updateuser();
        echo json_encode($data);   
    }
    function activeDeactiveUser($user, $active_status){
    	$data = $this->mumm->activeDeactiveUser($user, $active_status);
    	echo json_encode($data);
    }
}