<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reg_adm extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('my_discount_model', 'mdm');
    }
    
    function index($active = 1, $submenu = 'index'){
        $this->check_login();
        $data['active'] = $active;
        
        // fetching page according to active status
        $data['page_'] = $this->get_page($active);
        $data['inner_page'] = $this->get_submenu($submenu);
        // ----------------------------------------
        //$data['student_in_current_session'] = $this->mam->getstudents_for_dropdown_admission_form($this->session->userdata('_current_year___'));
        $data['student_in_current_session'] = $this->mam->getstudents_for_dropdown_($this->session->userdata('_current_year___'));
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
    
    function getstudents_for_dropdown($studid=''){
        $data['students_'] = $this->mam->getstudents_for_dropdown_($this->session->userdata('_current_year___'), $studid);
        echo json_encode($data);
    }
    function getstudents_for_dropdown_for_dropping($studid=''){
        $data['students_'] = $this->mam->getstudents_for_dropdown_ALL($this->session->userdata('_current_year___'), $studid);
        echo json_encode($data);
    }
    function get_admitted_students(){
        $data['students_'] = $this->mam->get_admitted_students($this->session->userdata('_current_year___'));
        echo json_encode($data);   
    }
    function getDiscount(){
        $data['discounts_'] = $this->mdm->get_discount_except_category_n_siblings();
        echo json_encode($data);
    }
    function getClasses_in_session(){
        $data['class_in_session'] = $this->mam->getClasses_in_session($this->session->userdata('_current_year___'));
        echo json_encode($data);   
    }
    function getState(){
        $data['state'] = $this->mam->getState();
        echo json_encode($data);      
    }
    function update_Admission(){
        $data = $this->mam->update_Admission();
        echo json_encode($data);
    }
    function get_admision_detail($regid){
        $data['curr_sess_admission'] = $this->mam->check_current_admission($regid);
        $data['personal_academics'] = $this->mam->get_admission_detail_1($regid);
        $data['address_permanent'] = $this->mam->get_admission_detail_2($regid, 'PERMANENT');
        $data['address_correspondance'] = $this->mam->get_admission_detail_2($regid, 'CORRESPONDANCE');
        $data['contact'] = $this->mam->get_admission_detail_3($regid);
        $data['siblings'] = $this->mam->get_siblings_4($regid);
        $data['discounts'] = $this->mam->get_discount_5($regid);
        echo json_encode($data);
    }
}