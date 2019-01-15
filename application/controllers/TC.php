<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TC extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm'); 
        $this->load->model('My_attendance_model', 'mam');
        $this->load->model('my_tc_model', 'mtcm');
    }

    function issue_tc(){
    	$data['tc_data']= $this->mtcm->getTC_Data();
    	$data['school_profile'] = $this->mm->get_profile();
    	$this->load->view('tcc/issuetc',$data);
    }

    function check_login(){
        if(! $this -> session -> userdata('_user___')) redirect('web/logout');
    }
}