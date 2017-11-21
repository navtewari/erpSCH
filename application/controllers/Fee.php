<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fee extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
        $this->load->model('My_master_fee_model', 'mmm');
        $this->load->model('My_fee_model', 'fm');
    }

    function show_class_for_receipt(){
        $class__ = $this->input->post('cmbClassForInvoice');
        $data['fetch_invoice_for_receipt'] = $this->fm->get_invoice_for_receipt($class__);
        echo json_encode($data);
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
}