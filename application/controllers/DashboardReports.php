<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardReports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database(_DATABASE_);
        $this->load->model('my_model', 'mm');
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('my_dashboard_reports_model', 'dr');
    }

    function total_students(){
    	$this->check_login();

        $data['inner_page'] = 'regStudents';
        $data['active'] = 1;

    	$data['page_'] = 'dashboard_reports';
        $data['title_'] = "Total Classes";
        $data['student_in_current_session'] = $this->mam->getstudents_for_dropdown_admission_form($this->session->userdata('_current_year___'));

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    function total_classes(){
    	$this->check_login();

        $data['inner_page'] = 'totalClasses';
        $data['active'] = 1;

    	$data['page_'] = 'dashboard_reports';
        $data['title_'] = "Total Classes in ".$this -> session -> userdata('_current_year___');
        $data['total_classes'] = $this->mam->getClasses_in_session($this->session->userdata('_current_year___'));
        $data['total_students'] = $this->mam->getStudents_in_class_in_session($this->session->userdata('_current_year___'));

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    function total_admitted_students(){
        $this->check_login();

        $data['inner_page'] = 'regStudents';
        $data['active'] = 1;

        $data['page_'] = 'dashboard_reports';
        $data['title_'] = "Total Admitted Students in ". $this->session->userdata('_current_year___');
        $data['student_in_current_session'] = $this->mam->get_admitted_students($this->session->userdata('_current_year___'));

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
    function all_figures_for_dashboard($year__){
        $data['count_reg_students'] = $this->dr->total_reg_students($year__);
        $data['count_classes_in_session'] = $this->dr->total_classes_in_a_session($year__);
        return $data;
    }

    function get_students(){
    	$clssessid = $this->input->post('classessid');
    	$data['class_students'] = $this->dr->getstudents_in_class($this->session->userdata('_current_year___'), $clssessid);
    	echo json_encode($data);
    }
    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }
}