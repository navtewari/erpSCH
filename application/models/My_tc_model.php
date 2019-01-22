<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_tc_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function getTC_Data(){
    	$regid = $this->input->post('cmbRegistrationID_for_tccc');
    	$this->db->where('a.regid', $regid);
    	$this->db->from('master_7_stud_personal a');
    	$this->db->join('master_7_stud_personal_detail b','a.regid=b.regid');
    	$this->db->join('master_7_stud_personal_tc_status c', 'b.regid=c.regid');
    	$query = $this->db->get();

    	return $query->row();
    }
    function generateTC(){
    	// Feed the for printing TC 1st time/ 2nd time or n time in master_7_stud_personal_tc_status
    }
}