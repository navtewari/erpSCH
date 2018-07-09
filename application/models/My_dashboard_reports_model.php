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
}