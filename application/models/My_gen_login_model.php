<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_gen_login_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function checkit(){
		$u = $this->input->post('txtUser__');
		$p = $this->input->post('txtPwd__');
		$this->db->select('a.*, b.STATUS as user_status, b.ACTIVE');
		$this->db->where('b.USERNAME_', $u);
		$this->db->where('b.PASSWORD_', $p);
		$this->db->where('a.STATUS', 1);
		$this->db->where('b.ACTIVE', 1);
		$this->db->from('clients a');
		$this->db->join('users b', 'a.USERNAME_ = b.USERNAME_');
		$query = $this->db->get();

		if($query->num_rows()!=0){
			$bool_ = true;
			$row = $query->row();
			$this->session->set_userdata('_abbrev_', $row->ABBREV);
			$this->session->set_userdata('main_user', $row->USERNAME_);
			$this->session->set_userdata('db2', $row->DB_);
			$this->session->set_userdata('school_name', $row->CLIENT_NAME);
			$this->session->set_userdata('user_status', $row->user_status);

			$this->db->where('CID', $row->CID);
			$this->db->where('STATUS', 1);
			$query = $this->db->get('bulksms');

			if($query->num_rows() != 0){
				$r = $query->row();
				$this->session->set_userdata('sms_loginto', $r->LOGINTO);
				$this->session->set_userdata('sms_senderid', $r->SENDERID);
				$this->session->set_userdata('sms_userid', $r->USERID);
				$this->session->set_userdata('sms_pwd', $r->PWD);
			} else {
				$this->session->set_userdata('sms_loginto', 'NA');
				$this->session->set_userdata('sms_senderid', 'NA');
				$this->session->set_userdata('sms_userid', 'NA');
				$this->session->set_userdata('sms_pwd', 'NA');
			}
//----------------------------RESULT----------------------------			
			$this->db->where('CID', $row->CID);
			$this->db->where('STATUS', 1);
			$query1 = $this->db->get('result');
			if($query1->num_rows() != 0){
				$r = $query1->row();
				$this->session->set_userdata('res_prefix', $r->PREFIX);				
			} else {
				$this->session->set_userdata('res_prefix', 'NA');				
			}
//----------------------------RESULT----------------------------	

			$bool_ = array('res_'=>true, 'db'=>$row->DB_);
		} else {
			$bool_ = array('res_'=>false, 'db'=>'default');
		}
		return $bool_;
	}



	function checkit_from_site(){
        $u = 'mamta';
        $p = '123';
        $this->db->select('a.*, b.STATUS as user_status, b.ACTIVE');
        $this->db->where('b.USERNAME_', $u);
        $this->db->where('b.PASSWORD_', $p);
        $this->db->where('a.STATUS', 1);
        $this->db->where('b.ACTIVE', 1);
        $this->db->from('clients a');
        $this->db->join('users b', 'a.USERNAME_ = b.USERNAME_');
        $query = $this->db->get();

        if($query->num_rows()!=0){
            $bool_ = true;
            $row = $query->row();
            $this->session->set_userdata('_abbrev_', $row->ABBREV);
            $this->session->set_userdata('main_user', $row->USERNAME_);
            $this->session->set_userdata('db2', $row->DB_);
            $this->session->set_userdata('school_name', $row->CLIENT_NAME);
            $this->session->set_userdata('user_status', $row->user_status);

            $this->db->where('CID', $row->CID);
            $this->db->where('STATUS', 1);
            $query = $this->db->get('bulksms');

            if($query->num_rows() != 0){
                $r = $query->row();
                $this->session->set_userdata('sms_loginto', $r->LOGINTO);
                $this->session->set_userdata('sms_senderid', $r->SENDERID);
                $this->session->set_userdata('sms_userid', $r->USERID);
                $this->session->set_userdata('sms_pwd', $r->PWD);
            } else {
                $this->session->set_userdata('sms_loginto', 'NA');
                $this->session->set_userdata('sms_senderid', 'NA');
                $this->session->set_userdata('sms_userid', 'NA');
                $this->session->set_userdata('sms_pwd', 'NA');
            }
//----------------------------RESULT----------------------------            
            $this->db->where('CID', $row->CID);
            $this->db->where('STATUS', 1);
            $query1 = $this->db->get('result');
            if($query1->num_rows() != 0){
                $r = $query1->row();
                $this->session->set_userdata('res_prefix', $r->PREFIX);             
            } else {
                $this->session->set_userdata('res_prefix', 'NA');               
            }
//----------------------------RESULT----------------------------    

            $bool_ = array('res_'=>true, 'db'=>$row->DB_);
        } else {
            $bool_ = array('res_'=>false, 'db'=>'default');
        }
        return $bool_;
    }
}