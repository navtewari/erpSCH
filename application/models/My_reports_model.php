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

}