<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }    

    function authenticate(){
        $this->db->select('a.*, b.name, b.CATEGORY_ID');
        $this->db->where('a.USERNAME_', $this->input->post('txtUser__'));
        $this->db->where('a.PASSWORD_', $this->input->post('txtPwd__'));
        $this->db->where('a.ACTIVE', 1);
        $this->db->where('b.STATUS_', 1);
        $this->db->from('login a');
        $this->db->join('master_13_staff b', 'b.teacherID=a.STAFFID');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $row_ = $query->row();
            $this->session->set_userdata('_name_', $row_->name);
            $this->session->set_userdata('_user___', $row_->USERNAME_);
            $this->session->set_userdata('_status_', $row_->CATEGORY_ID);
            $this->session->set_userdata('_current_year___', $this->input->post('cmbSession'));
            $sess_ = explode("-", $this->input->post('cmbSession'));
            $prevSess = ($sess_[0]-1)."-".($sess_[1]-1);
            $this->session->set_userdata('_previous_year___', $prevSess);
            $flag_ = true;
        } else {
            $flag_ = false;
            $this->session->set_flashdata('msg_', 'False Credentials !!');
        }

        // Exceptional Handling
            $this -> error -> _db_error();
        // --------------------
        return $flag_;
    }

    function getsessions(){
        $this->db->order_by('SESSSTART', 'desc');
        $query = $this->db->get('master_6_session');

        return $query->result();

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

    function last_registration() {
        $this -> db -> where('SESSIONID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('_id_');
        if ($query->num_rows() != 0) {
            $row_ = $query->row();
            $reg___ = $row_->regid_;
        } else {
            $reg___ = 0;
        }
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
        return $reg___;
    }
    
}

