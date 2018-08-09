<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardReports extends CI_Controller {

    function __construct() {
        parent::__construct();
        
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

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

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

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

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

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    function get_students(){
    	$clssessid = $this->input->post('classessid');
    	$data['class_students'] = $this->dr->getstudents_in_class($this->session->userdata('_current_year___'), $clssessid);
    	echo json_encode($data);
    }

    function get_invoices(){
        $this->check_login();

        $data['inner_page'] = 'invoices';
        $data['active'] = 1;

        $data['page_'] = 'dashboard_reports';
        $data['title_'] = "Invoice(s) in ". $this->session->userdata('_current_year___');
        $data['total_classes'] = $this->mam->getClasses_in_session($this->session->userdata('_current_year___'));
        $data['invoices'] = $this->dr->get_invoices_in_a_session($this->session->userdata('_current_year___'));

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
    function get_receipts(){
        $this->check_login();

        $data['inner_page'] = 'receipts';
        $data['active'] = 1;

        $data['page_'] = 'dashboard_reports';
        $data['title_'] = "Receipt(s) in ". $this->session->userdata('_current_year___');
        $data['total_classes'] = $this->mam->getClasses_in_session($this->session->userdata('_current_year___'));
        $data['receipts'] = $this->dr->get_receipts_in_a_session($this->session->userdata('_current_year___'));

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');   
    }
    function get_receipts_via_ajax(){
        $clssessid = $this->input->post('clssessid');
        $data['receipts'] = $this->dr->get_receipts_in_a_session($this->session->userdata('_current_year___'), $clssessid);
        echo json_encode($data);
    }
    function get_invoices_via_ajax(){
        $clssessid = $this->input->post('clssessid');
        $data['invoices'] = $this->dr->get_invoices_in_a_session($this->session->userdata('_current_year___'), $clssessid);
        echo json_encode($data);
    }

    function get_todays_collection(){
        $this->check_login();

        $data['inner_page'] = 'todaysCollection';
        $data['active'] = 1;

        $data['page_'] = 'dashboard_reports';
        $data['title_'] = "Today's Collection";
        
        $data['total_collection'] = $this->dr->get_todays_collection();
        

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');   
    }
    function get_total_collection(){
        $this->check_login();

        $data['inner_page'] = 'totalCollection';
        $data['active'] = 1;

        $data['page_'] = 'dashboard_reports';
        $data['title_'] = "Total Fee Collection";
        
        $data['total_collection'] = $this->dr->get_total_collection();
        

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');   
    }
    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }
}