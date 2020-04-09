<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ViewResultnow extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('My_model', 'mm');
		$this->load->model('my_admission_model', 'mam');
	}

	function sunbeamschool(){
		$x = $this->mm->a___();
		if($x == true){
			$this->session->set_userdata($this->mm->get_profile());
	        $data['master_sessions'] = $this->mm->getsessions();
	        $data['class_in_session'] = $this->mam->getClasses_in_session('2019-20');
	    	$this->load->view('default-sunbeam/login', $data);
    	} else {
    		echo "Server Error !! Please contact ". $this->session->userdata('sch_name'). ", ". $this->session->userdata('sch_city'). " for detail";
    	}
	}
}