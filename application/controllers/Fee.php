<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fee extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('My_master_fee_model', 'mmm');
        $this->load->model('My_fee_model', 'fm');
    }

    function fetch_last_invoice_month(){
        $class__ = $this->input->post('cmbClassForInvoice');
        $data['prev_invoice'] = $this->fm->check_previous_invoice_generation($class__);
        echo json_encode($data);
    }
    function check_selected_month_year_invoice(){
        $class__ = $this->input->post('cmbClassForInvoice');
        $yr_from = $this->input->post('cmbYearFromForInvoice');
        $mnth_from = $this->input->post('cmbMonthFromForInvoice');
        $data['check_selected_year_month_'] = $this->fm->check_previous_invoice($class__, $yr_from, $mnth_from);
        echo json_encode($data);
    }
    function show_invoice_needs_to_be_generated() {
        $class__ = $this->input->post('cmbClassForInvoice');
        $yr_from = $this->input->post('cmbYearFromForInvoice');
        $mnth_from = $this->input->post('cmbMonthFromForInvoice');
        $yr_to = $this->input->post('cmbYearToForInvoice');
        $mnth_to = $this->input->post('cmbMonthToForInvoice');

        $data['fetch_class_students'] = $this->fm->get_students_in_class($class__);
        $data['static_fee_to_class'] = $this->fm->get_static_heads_to_class($class__);
        $data['flexible_head_to_class'] = $this->fm->get_flexible_fee_head_for_class($class__);
        $data['previous_invoice'] = $this->fm->get_invoice_data($class__,$yr_from, $mnth_from, $yr_to, $mnth_to);
        $data['prev_invoice_generated_month_year'] = $this->fm->check_previous_invoice_generation($class__);

        echo json_encode($data);
    }

    function generateInvoice(){
        
        /*//*
        $class__ = '406';
        $yr_from = '2017';
        $mnth_from = 12;
        $yr_to = '2017';
        $mnth_to = 11;
        $regid_ = '2017041028';
        /*/

        $class__ = $this->input->post('cmbClassForInvoice');
        $yr_from = $this->input->post('cmbYearFromForInvoice');
        $mnth_from = $this->input->post('cmbMonthFromForInvoice');
        $yr_to = $this->input->post('cmbYearToForInvoice');
        $mnth_to = $this->input->post('cmbMonthToForInvoice');
        $regid_ = $this->input->post('regid');

        /**/

        $no_of_months = $this->calculate_no_months($yr_from, $mnth_from, $yr_to, $mnth_to);
        
        $data = $this->fm->generateInvoice($class__, $yr_from, $mnth_from, $yr_to, $mnth_to, $regid_, $no_of_months);
        echo json_encode($data);
    }
    function undo_invoice($invdetid_, $regid_, $clssessid){
        $data = $this->fm->undo_invoice($invdetid_, $regid_, $clssessid);
        echo json_encode($data);
    }
    function print_invoice($invdetid_, $clssessid){
        $data = $this->fm->get_invoice($clssessid, $invdetid_);
        $this -> load -> view('fee/printinvoice', $data);
    }
    
    function calculate_no_months($yrfrom, $mnthfrom, $yr2, $mnth2){
        if($yrfrom<$yr2){
            $count_1 = 12 - $mnthfrom;
            $count_2 = $mnth2 - 1;
            $total = $count_1 + $count_2 + 2;
        } else if($yrfrom == $yr2){
            if($mnthfrom<=$mnth2){
                $total = $mnth2 - $mnthfrom + 1;
            } else {
                $total = 0;
            }
        } else {
            $total = 0;
        }
        return $total;
    }

    function show_class_for_receipt(){
        $class__ = $this->input->post('class_in_session_for_Receipt');
        $yr_from = $this->input->post('cmbYearFromForReceipt');
        $mnth_from = $this->input->post('cmbMonthFromForReceipt');
        $yr_to = $this->input->post('cmbYearToForReceipt');
        $mnth_to = $this->input->post('cmbMonthToForReceipt');

        $data['fetch_invoice_for_receipt'] = $this->fm->get_invoice_for_receipt($class__, $yr_from, $mnth_from, $yr_to, $mnth_to);
        $data['fetch_class_students'] = $this->mam->getstudents_for_dropdown($this->session->userdata('_current_year___'), $class__);
        echo json_encode($data);
    }
    
    function show_student_data_for_receipt(){
        $invdetid_ =  $this->input->post('invdetid');
        $clssessid = $this->input->post('clssessid');
        $regid_ = $this->input->post('regid_');
        $data['sibling_discount_eligiblity'] = $this->fm->check_eligibility_for_sibling_discount($regid_);
        $data['fetch_receipt_data'] = $this->fm->get_student_receipt($invdetid_, $clssessid);
        if($this->fm->chkDiscountStatus($invdetid_) == false){
            $data['sibling_discount'] = $this->fm->get_specific_sibling_for_fee_discount($regid_);
            $data['other_discount_data'] = $this->fm->get_specific_other_discount_for_fee_discount($regid_);

            if(count($data['other_discount_data'])!=0){
                $data['fetch_other_discount_data'] = $this->fm->get_other_discount('OTHER');
            } else {
                $data['fetch_other_discount_data'] = NULL;
            }
            
            /*
            if($data['sibling_discount_eligiblity']['res_'] == true){
                if(count($data['sibling_discount']) != 0){
                    $data['fetch_discount_data'] = $this->fm->get_student_discount('SIBLINGS');
                } else {
                    $data['fetch_discount_data'] = NULL;
                }
            } else {
                $data['fetch_discount_data'] = NULL;
            }
            */
            $data['fetch_discount_data'] = NULL;
            
            if($data['fetch_receipt_data'][0]->CATEGORY != '' && $data['fetch_receipt_data'][0]->CATEGORY != 'x'){
                $data['fetch_category_discount_data'] = $this->fm->get_student_discount($data['fetch_receipt_data'][0]->CATEGORY);
            } else {
                $data['fetch_category_discount_data'] = NULL;
            }
        } else {
            $data['fetch_discount_data'] = NULL;
            $data['fetch_category_discount_data'] = NULL;
            $data['fetch_other_discount_data'] = NULL;
        }
        $data['date_'] = array(date('d/m/Y')); 
        $data['sch_name'] = array($this->session->userdata('sch_name'));
        $data['sch_address'] = array($this->session->userdata('sch_addr'));
        $data['sch_contact'] = array($this->session->userdata('sch_contact'));
        $data['sch_email'] = array($this->session->userdata('sch_email'));
        echo json_encode($data);
    }
    function createReceipt(){
        $data = $this->fm->submitfee();

        if($data['id_'] != 'x'){
            $data['receipt_msg'] = array("Fee Submitted Successfully");
            $data['receipt_id'] = $data['id_'];
            $data['student'] = $this->fm->getMobileNo($this->input->post('txtREGID'), $data['id_']);
            $data['sms_check'] = $this->session->userdata('sms_loginto');
        } else {
            $data['receipt_msg'] = array("Fee can't be submitted as no due amount is left in current invoice.");
            $data['receipt_id'] = array($data['id_']);
        }
        echo json_encode($data);
    }

    function sendSMS(){

        $msg = $this->input->post('MessageToPrint');

        $username = $this->session->userdata('sms_userid');
        $password = $this->session->userdata('sms_pwd');
        $number = $this->input->post("mobilenumbers");
        $sender = $this->session->userdata('sms_senderid');
        $msg1=$this->input->post("Fee_Message");
        $message = rawurlencode($msg1);

        if($this->input->post('check_sms') == 'yes'){
            /* */ // Booking Message to Owner Mobile
                $url=$this->session->userdata('sms_loginto')."/unicodesmsapi.php?username=".trim($username,'"')."&password=".trim($password,'"')."&mobilenumber=".trim($number,'"')."&message=".trim($message,'"')."&senderid=".trim($sender,'"')."&type=3";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
            /* */
            $data['msg_all'] = $msg.". And Fee SMS is also sent to the Registered Mobile.";

            // Store the sent sms to the respective database
                $nums = explode(",", $number);
                $no_of_sms = count($nums);
                $status = 'sent';
                $this->fm->submit_sms($msg1, $no_of_sms, $number, $sender, $status);
            // ---------------------------------------------
        } else {
            $data['msg_all'] = $msg." But without any sms as cancelled by you.";
            $nums = explode(",", $number);
            $no_of_sms = count($nums);
            $this->fm->submit_sms($msg1, $no_of_sms, $number, $sender, 'cancelled');
        }
        echo json_encode($data);
    }
    function fee_print($receipt_id){
        $this -> check_login();

        $data['breadCrumb'] = 'Receipt';
        $data['title'] = 'Print Receipt';

        $data['date_'] = array(date('d/m/Y')); 
        $data['sch_name'] = _SCHOOL_;
        $data['sch_address'] = _ADDRESS_;
        $data['sch_contact'] = _CONTACT_;
        $data['sch_email'] = _EMAIL_;

        $data['receipt'] = $this->fm->get_receipt($receipt_id);

        $this -> load -> view('fee/printreceipt', $data);
    }
    function print_latest_receipt($invdetid){
        $receipt_id = $this->fm->get_latest_receipt($invdetid);
        redirect('fee/fee_print/'.$receipt_id);
    }
    
    function get_all_fee_heads(){
        // yet to code
    }
    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }
}