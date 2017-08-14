<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }    

    function get_files(){
        $this->db->order_by('PDFID', 'desc');
        $this->db->where('STATUS_',1);
        $query = $this->db->get('b2_pdf');
        return $query->result();
    }
    
    function get_recent_file(){
        $this->db->order_by('DATE_', 'desc');
        $this->db->limit(1, 0);
        $this->db->where('STATUS_',1);
        $this->db->where('PATH_<>','no-image.png');
        $query = $this->db->get('b2_pdf');
        return $query->result();
    }
    
    function get_team(){
        $this->db->order_by('MID', 'asc');        
        $this->db->where('STATUS_',1);
        $query = $this->db->get('members');
        return $query->result();
    }
    
    function get_newsdetail() {
        $this->db->where('STATUS', 1);
        $this->db->order_by('DATE_', 'DESC');
        $query = $this->db->get('newsevents');
        return $query->result();
    }
    
    function get_team_byid($id_){
        $this->db->where('MID', $id_);        
        $query = $this->db->get('members');
        return $query->result();
    }
}

