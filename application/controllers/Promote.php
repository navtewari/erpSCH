<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promote extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_model', 'mm');    
        $this->load->model('Promote_model', 'clsm');
    }

    function getClassForCurrentSessionAdmission(){
        $option = $this->input->post('PromotionFor');//'PreviousSession' or 'Admission' 
        //echo json_encode($option); die();
        if($option == 'Admission'){
            $data['promotion_record'] = $this->clsm->getClassesFromAdmission($this->session->userdata('_current_year___'));
        } else if($option == 'PreviousSession') {
            $data['promotion_record'] = $this->clsm->getClassesFromPreviousSession($this->session->userdata('_current_year___')); 
        } else {
            $data['promotion_record'] = Array();   
        }

        echo json_encode($data['promotion_record']);
    }
    function getStudentForCurrentSession(){
        $option = $this->input->post('PromotionFor');

        if($option == 'Admission'){
            $data['student_record'] = $this->clsm->getStudentFromAdmission($this->session->userdata('_current_year___'));
        } else if($option == 'PreviousSession'){
            $data['student_record'] = $this->clsm->getStudentFromPreviousSession($this->session->userdata('_current_year___'));
        }
        echo json_encode($data['student_record']);
    }

    function getStudentsofCurrentSession(){
        $data['student_record'] = $this->clsm->getStudentsofcurrentSession($this->session->userdata('_current_year___'));
        echo json_encode($data['student_record']);
    }

    function getPrevSession(){
        $sess__ = explode("-", $this->session->userdata('_current_year___'));
        $fst = $sess__[0]-1;
        $scnd = $sess__[1]-1;
        echo "Select Students to Promote (".$fst."-".$scnd.")";
    }

    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }
}