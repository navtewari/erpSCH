<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
    }    

    function authenticate(){
        $this->db->where('USERNAME_', $this->input->post('txtUser__'));
        $this->db->where('PASSWORD_', $this->input->post('txtPwd__'));
        $query = $this->db->get('login');

        if ($query->num_rows() != 0) {
            $row_ = $query->row();
            $this->session->set_userdata('_user___', $row_->USERNAME_);
            $this->session->set_userdata('_status_', $row_->USER_STATUS);
            $this->session->set_userdata('_current_year___', $this->input->post('cmbSession'));
            $sess_ = explode("-", $this->input->post('cmbSession'));
            $prevSess = ($sess_[0]-1)."-".($sess_[1]-1);
            $this->session->set_userdata('_previous_year___', $prevSess);
            $flag_ = TRUE;
        } else {
            $flag_ = FALSE;
            $this->session->set_flashdata('msg_', 'False Credentials !!');
        }

        // Exceptional Handling
            $this -> _db_error();
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

