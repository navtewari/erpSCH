<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_dashboard_reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
        	$this->load->model('My_error_model', 'error');
        // --------------------
    }

    function all_figures_for_dashboard($year__){
        $data['count_reg_students'] = $this->total_reg_students($year__);
        $data['count_classes_in_session'] = $this->total_classes_in_a_session($year__);
        $data['count_students_in_a_session'] = $this->total_students_in_a_session($year__);
        $data['count_invoices_in_session'] = $this->total_invoices_in_a_session($year__);
        $data['count_fee_receipts'] = $this->total_fee_paid($year__);
        $data['total_fee_collected'] = $this->total_fee_collected($year__);
        return $data;
    }

    function total_reg_students($year_){
        $this->db->where('SESSID', $year_);
        $this->db->select('count(regid) as count_students');
        $query = $this->db->get('master_8_stud_academics');

        $result = $query->row();
        return $result->count_students;
    }

    function total_classes_in_a_session($year_){
        $this->db->where('SESSID', $year_);
        $this->db->select('count(CLASSID) as count_classes_in_session');
        $query = $this->db->get('class_2_in_session');

        $result = $query->row();
        return $result->count_classes_in_session;   
    }

    function getstudents_in_class($session, $classessid=''){
        $this->db->where('c.CLSSESSID',$classessid);
        $this->db->where('c.SESSID', $session);
        
        $this->db->order_by('a.regid');
        $this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid, a.GENDER, b.CLASS_OF_ADMISSION, b.DOA, a.CATEGORY, d.CLASSID');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session d', 'b.CLASS_OF_ADMISSION=d.CLSSESSID');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        
        $query = $this->db->get();

        return $query->result();
    }

    function total_students_in_a_session($year_){
        $this->db->where('SESSID', $year_);
        $this->db->select('count(regid) as count_students');
        $query = $this->db->get('class_3_class_wise_students');

        $result = $query->row();
        return $result->count_students;
    }

    function total_invoices_in_a_session($year_='x'){
        if($year_ != 'x'){
            $this->db->where('SESSID', $year_);
        }
        $this->db->select('count(a.INVID) as total_invoices');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_invoices;
    }

    function get_invoices_in_a_session($year_){
        if($year_ != 'x'){
            $this->db->where('SESSID', $year_);
        }
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $query = $this->db->get();
        return $query->result();
    }

    function total_fee_paid($year_){
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        $this->db->select('count(c.RECPTID) as total_Receipts');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_Receipts;

    }

    function total_fee_collected($year_){
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        $this->db->select('sum(c.ACTUAL_PAID_AMT) as fee_collected');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $query = $this->db->get();
        $result = $query->row();
        return $result->fee_collected;

    }
}