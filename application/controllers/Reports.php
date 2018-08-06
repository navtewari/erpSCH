<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    function __construct() {
    	parent::__construct();
    	$this->load->model('my_model', 'mm');
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('my_reports_model', 'mrm');
    }

    function getStudentInfo(){
    	$stdid = $this->input->post('txtSearchID');
    	$data['academic'] = $this->mrm->getAcademicDetail($stdid);


    	if(count($data['academic']) != 0){
    		$data['bool_'] = 1;

	    	$data['personal'] = $this->mrm->getPersonalDetail($stdid);
	    	$data['p_address'] = $this->mrm->get_P_AddressDetail($stdid);
	    	$data['c_address'] = $this->mrm->get_C_AddressDetail($stdid);
            $data['c_contact'] = $this->mrm->get_c_ContactDetail($stdid);

    	} else {
    		$data['bool_'] = 0;
    	}

    	$data['inner_page'] = 'studentInfo';
        $data['active'] = 1;

    	$data['page_'] = 'reports';
        $data['title_'] = "Student Detail";

    	$data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

    	$this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}