<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
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

    function _db_error(){
        //exception handling ------------------
        if ($this -> db -> trans_status() == FALSE) {
            echo "gadbad";
            die();
            //redirect('web/dberror');
        }
        //-------------------------------------
    }
}