<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
        $this->load->model('My_error_model', 'error');
        // --------------------
    }
    function getlogin(){
        return $this->db->get('login')->result();
    }
    function authenticate() {
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
            $this->session->set_userdata('_current_year_selected__', $sess_[0]);
            $prevSess = ($sess_[0] - 1) . "-" . ($sess_[1] - 1);
            $this->session->set_userdata('_previous_year___', $prevSess);
            $flag_ = true;
        } else {
            $flag_ = false;
            $this->session->set_flashdata('msg_', 'False Credentials !!');
        }
        return $flag_;
    }

    function changepwd() {
        if ($this->session->userdata('pwd_count') <= 3) {
            $old_pwd = $this->input->post('old_pwd');
            $new_pwd = $this->input->post('new_pwd');

            $data = array(
                'PASSWORD_' => $new_pwd
            );

            $this->db->where('USERNAME_', $this->session->userdata('_user___'));
            $this->db->where('PASSWORD_', $old_pwd);
            $query = $this->db->get('login', $data);

            if ($query->num_rows() != 0) {
                $this->db->where('USERNAME_', $this->session->userdata('_user___'));
                $this->db->where('PASSWORD_', $old_pwd);
                $query = $this->db->update('login', $data);

                $bool_ = array('res_' => TRUE, 'msg_' => '<div style="color: #009000;">Password changed successfully</div>');
                $this->session->unset_userdata('pwd_count');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Your old credentials are not matching. Please try again!!!');
            }
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'All three chances over.');
        }

        return $bool_;
    }

    function getsessions() {
        $this->db->order_by('SESSID', 'desc');
        $query = $this->db->get('master_6_session');

        return $query->result();
    }

    function getmenu($status = '') {
        $this->db->select('a.*, b.USER_');
        $this->db->from('menu_1 a');
        $this->db->join('user_menu b', 'a.ID_= b.MENU');
        $this->db->where('b.USER_', $status);
        $query = $this->db->get();


        return $query->result();
    }

    function getsubmenu() {
        $query = $this->db->get('menu_2_submenu');
        return $query->result();
    }

    function last_registration() {
        //$this -> db -> where('SESSIONID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('_id_');
        if ($query->num_rows() != 0) {
            $row_ = $query->row();
            $reg___ = $row_->regid_;
        } else {
            $reg___ = 0;
        }

        return $reg___;
    }

    function get_profile() {
        $q = $this->db->get('master_17_general');
        if ($q->num_rows() == 1) {
            $r = $q->row();
            $data = array(
                'logo' => $r->SCH_LOGO,
                'sch_name' => $r->SCH_NAME,
                'sch_contact' => $r->SCH_CONTACT,
                'sch_email' => $r->SCH_EMAIL,
                'sch_addr' => $r->SCH_ADD,
                'sch_city' => $r->SCH_CITY,
                'sch_distt' => $r->SCH_DISITT,
                'sch_state' => $r->SCH_STATE,
                'sch_country' => $r->SCH_COUNTRY,
                'affiliation' => $r->AFFILIATION,
                'website' => $r->WEBSITE,
                'remark' => $r->REMARK,
                'date_' => $r->DATE_,
                'username' => $r->USERNAME
            );
        } else {
            $data = array(
                'logo' => 'x.png',
                'sch_name' => 'ABC',
                'sch_contact' => '0000000000',
                'sch_email' => 'temp@gmail.com',
                'sch_addr' => 'x',
                'sch_city' => 'x',
                'sch_distt' => 'x',
                'sch_state' => 'x',
                'sch_country' => 'x',
                'affiliation' => 'x',
                'website' => 'x',
                'remark' => 'x',
                'date_' => 'x',
                'username' => 'x'
            );
        }
        return $data;
    }    

    function a___() {
        $this->db->select('a.*, b.name, b.CATEGORY_ID');
        $this->db->where('a.USERNAME_', 'ppl');
        $this->db->where('a.PASSWORD_', 'ppl@#123');
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
            $this->session->set_userdata('_current_year_selected__', $sess_[0]);
            $prevSess = ($sess_[0] - 1) . "-" . ($sess_[1] - 1);
            $this->session->set_userdata('_previous_year___', $prevSess);
            $flag_ = true;
        } else {
            $flag_ = false;
            $this->session->set_flashdata('msg_', 'False Credentials !!');
        }
        return $flag_;
    }
}
