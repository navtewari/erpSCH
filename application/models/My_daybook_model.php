<?php

class My_daybook_model extends CI_Model{
	function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }  

    function getCatgory(){
    	$query = $this->db->get('daybook_1_category');
    	return $query->result();
    }

    function getHeads($categid){
    	$this->db->where('DBCATEGID', $categid);
    	$query = $this->db->get('daybook_2_heads');
    	return $query->result();
    }

    function getSubHeads($hid){
    	$this->db->where('DBHID', $hid);
    	$query = $this->db->get('daybook_3_subheads');
    	return $query->result();
    }

    function getSubHeadsAll(){
    	$query = $this->db->get('daybook_3_subheads');
    	return $query->result();
    }
}