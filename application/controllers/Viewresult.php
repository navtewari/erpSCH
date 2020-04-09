<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewresult extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('My_gen_login_model', 'mgm');
	}

	function sunbeamschool(){
		$this->session->set_userdata('res_prefix', 'sunbeam_');
		$this->mgm->checkit_from_site();
		redirect('viewResultnow/sunbeamschool');
    	//$this->load->view('default-sunbeam/login', $data);
	}
}