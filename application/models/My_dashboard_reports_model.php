<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_dashboard_reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
        	$this->load->model('My_error_model', 'error');
            $this -> error -> _db_error();
        // --------------------
    }

    function getstudents_for_dropdown_admission_form($session, $classessid=''){
        if($classessid!=''){
            $this->db->where('c.CLSSESSID',$classessid);
        }
        $this->db->where('b.SESSID', $session);
        $this->db->order_by('a.FNAME');
        $this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid, a.GENDER, b.CLASS_OF_ADMISSION, b.DOA, a.CATEGORY, d.CLASSID');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session d', 'b.CLASS_OF_ADMISSION=d.CLSSESSID');
        if($classessid!=''){
            $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        }
        $query = $this->db->get();
        return $query->result();
    }
}