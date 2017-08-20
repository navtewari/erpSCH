<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_admission_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
    }  

    function getstudents_for_dropdown($classessid=''){
    	if($classessid!=''){
    		$this->db->where('CLASS_OF_ADMISSION', 	$classessid);
    	}
    	$this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $query = $this->db->get();
        return $query->result();
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