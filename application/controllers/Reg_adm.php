<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reg_adm extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
        $this->load->model('my_admission_model', 'mam');
    }
    function index($active = 1, $submenu = 'index'){
    	$this->check_login();
        $data['active'] = $active;
        
        // fetching page according to active status
        $data['page_'] = $this->get_page($active);
        $data['inner_page'] = $this->get_submenu($submenu);
        // ----------------------------------------

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();
        
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
    function check_login(){
        if(! $this -> session -> userdata('_user___')) redirect('login/logout');
    }
    
    function getstudents_for_dropdown(){
        $data['students_'] = $this->mam->getstudents_for_dropdown();
        echo json_encode($data);
    }
}