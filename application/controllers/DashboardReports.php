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
    function get_total_dues_via_ajax(){
        $clssessid = $this->input->post('clssessid');
        $data['fetch_month'] = $this->my_library->getMonths();
        $data['total_class_dues'] = $this->dr->total_dues_in_a_session($clssessid);
        $data['total_dues'] = $this->dr->get_total_dues_in_a_session($this->session->userdata('_current_year___'), $clssessid);
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
    function get_total_dues_in_a_session(){
        $this->check_login();

        $data['inner_page'] = 'dues';
        $data['active'] = 1;

        $data['page_'] = 'dashboard_reports';
        $data['title_'] = "Total Dues";
        
        $data['total_classes'] = $this->dr->getClasses_in_session_having_dues($this->session->userdata('_current_year___'));
        

        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    function sendReminder(){
        $username = $this->session->userdata('sms_userid');
        $password = $this->session->userdata('sms_pwd');
        $number = $this->input->post("mobilenumbers");
        $sender = $this->session->userdata('sms_senderid');
        $msg1=$this->input->post("FeeReminderMsg");
        $class_ = $this->input->post('class_reminder');
        $message = rawurlencode($msg1);

        if($this->input->post('check_sms') == 'yes'){
            /* */ // Booking Message to Owner Mobile
                $url=$this->session->userdata('sms_loginto')."/unicodesmsapi.php?username=".trim($username,'"')."&password=".trim($password,'"')."&mobilenumber=".trim($number,'"')."&message=".trim($message,'"')."&senderid=".trim($sender,'"')."&type=3";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
            /* */
            $data['msg_all'] = "Fee reminder SMS is sent to the selected Registered Mobile numbers.";

            // Store the sent sms to the respective database
                $nums = explode(",", $number);
                $no_of_sms = count($nums);
                $status = 'sent';
                $this->dr->submit_sms($class_, $msg1, $no_of_sms, $number, $sender, $status);
            // ---------------------------------------------
        } else {
            $data['msg_all'] = "Sending SMS is cancelled by you. No SMS sent.";
            $nums = explode(",", $number);
            $no_of_sms = count($nums);
            $this->dr->submit_sms($class_, $msg1, $no_of_sms, $number, $sender, 'cancelled');
        }
        echo json_encode($data);
    }
    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }
}