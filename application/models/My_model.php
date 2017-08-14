<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }    

    function getmenu($status=''){
        $this->db->select('a.*, b.USER_');
        $this->db->from('menu_1 a');
        $this->db->join('user_menu b', 'a.ID_= b.MENU');
        $this->db->where('b.USER_', $status);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
    function getsubmenu(){
        $query = $this->db->get('menu_2_submenu');
        return $query->result();
    }
}

