<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }  

    function getPersonalDetail($stdid){
    	$this->db->where('regid', $stdid);
    	$query = $this->db->get('master_7_stud_personal');
    	return $query->row();
    }

    function getAcademicDetail($stdid){
    	$this->db->where('regid', $stdid);
    	$this->db->where('STATUS_', 1);
    	$query = $this->db->get('master_8_stud_academics');
    	return $query->row();	
    }

    function get_P_AddressDetail($stdid){
    	$this->db->where('regid', $stdid);
    	$this->db->where('ADDRESS_STATUS', 'PERMANENT');
    	$query = $this->db->get('master_9_stud_address');
    	return $query->row();	
    }

    function get_C_AddressDetail($stdid){
    	$this->db->where('regid', $stdid);
    	$this->db->where('ADDRESS_STATUS', 'CORRESPONDANCE');
    	$query = $this->db->get('master_9_stud_address');
    	return $query->row();	
    }

    function get_c_ContactDetail($stdid){
        $this->db->where('regid', $stdid);
        $this->db->where('CONTACT_STATUS', 'CORRESPONDANCE');
        $query = $this->db->get('master_10_stud_contact');
        return $query->row();      
    }
    
    function getCurrentClass($stdid){
        $this->db->select('b.CLSSESSID, b.CLASSID');
        $this->db->where('a.regid', $stdid);
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->from('class_3_class_wise_students a');
        $this->db->join('class_2_in_session b', 'a.CLSSESSID=b.CLSSESSID');
        $query = $this->db->get();
        if($query->num_rows()!=0){
            $r = $query->row();
            $class_ = array('clssessid'=>$r->CLSSESSID, 'classid'=>$r->CLASSID);
        } else {
            $class_ = array('clssessid'=>'NA', 'classid'=>'NA');
        }

        return $class_;
    }

    function getAllClasses($stdid){
        $this->db->order_by('b.SESSID');
        $this->db->select('b.CLSSESSID, b.CLASSID, b.SESSID');
        $this->db->where('a.regid', $stdid);
        $this->db->from('class_3_class_wise_students a');
        $this->db->join('class_2_in_session b', 'a.CLSSESSID=b.CLSSESSID');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getAllInvoices($stdid){
        $this->db->group_by('c.INVDETID');
        $this->db->order_by('c.INVDETID');
        $this->db->select('a.INVID, c.INVDETID, a.SESSID, e.CLSSESSID, e.CLASSID, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, a.NOM, c.ACTUAL_DUE_AMOUNT, c.DUE_AMOUNT, sum(f.DISCOUNT_AMOUNT) as DISCOUNT_AMOUNT, sum(f.PAID) as PAID, sum(f.FINE) as FINE');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail c', 'a.INVID=c.INVID');
        $this->db->join('master_8_stud_academics d', 'd.regid=c.regid');
        $this->db->join('class_2_in_session e', 'a.CLSSESSID=e.CLSSESSID');
        $this->db->join('fee_7_receipts f', 'c.INVDETID=f.INVDETID');
        $this->db->where('c.REGID', $stdid);
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('d.STATUS_', 1);
        $query=$this->db->get();
        return $query->result();
    }

}