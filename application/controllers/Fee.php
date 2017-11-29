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
        /**//*
        $class__ = '405';
        $yr_from = '2017';
        $mnth_from = 9;
        $yr_to = '2018';
        $mnth_to = 8;
        $regid_ = '2017041078';
        /**/

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
        $data['fetch_invoice_for_receipt'] = $this->fm->get_invoice_for_receipt($class__);
        $data['fetch_class_students'] = $this->mam->getstudents_for_dropdown($this->session->userdata('_current_year___'), $class__);
        echo json_encode($data);
    }
    function show_student_data_for_receipt(){
        $invdetid_ =  $this->input->post('invdetid');
        $clssessid = $this->input->post('clssessid');
        $regid_ = $this->input->post('regid_');
        $data['fetch_receipt_data'] = $this->fm->get_student_receipt($invdetid_, $clssessid);
        $data['sibling_discount'] = $this->fm->get_specific_sibling_for_fee_discount($regid_);
        if(count($data['sibling_discount']) != 0){
            $data['fetch_discount_data'] = $this->fm->get_student_discount('SIBLINGS');
        } else {
            $data['fetch_discount_data'] = NULL;
        }
        if($data['fetch_receipt_data'][0]->CATEGORY != ''){
            $data['fetch_category_discount_data'] = $this->fm->get_student_discount($data['fetch_receipt_data'][0]->CATEGORY);
        } else {
            $data['fetch_category_discount_data'] = NULL;
        }
        //$invid = $data['fetch_receipt_data'][0]->INVID;
        $data['date_'] = array(date('d/m/Y')); 
        $data['sch_name'] = array(_SCHOOL_);
        $data['sch_address'] = array(_ADDRESS_);
        $data['sch_contact'] = array(_CONTACT_);
        $data['sch_email'] = array(_EMAIL_);
        echo json_encode($data);
    }
    function createReceipt(){
        //echo $this->input->post('cmbPaymentMode');
        $rid = $this->fm->submitfee();

        if($rid != 'x'){
            $data['receipt_link'] =  array("<div style='float: right; color: #ff0000; padding: 0px 0px 0px 0px'><a href='".site_url('fee/fee_print/'.$rid)."' class='btn btn-danger' target='_blank'>Print Fee</a></div>");
            $data['receipt_msg'] = array("<div style='float: right; color: #ff0000; padding: 0px 10px 0px 0px'>Fee Submitted Successfully.</div>");
            $data['receipt_id'] = array($rid);
        } else {
            $data['receipt_link'] = array('');
            $data['receipt_msg'] = array("<div style='float: right; color: #ff0000; padding: 0px 10px 0px 0px'>Fee can't be submitted as no due amount is left in current invoice.</div>");
            $data['receipt_id'] = array($rid);
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

        $this -> load -> view('fees/feereceipt', $data);
    }
}