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
			$this->session->set_userdata('main_user', $row->USERNAME_);
			$this->session->set_userdata('db2', $row->DB_);
			$this->session->set_userdata('school_name', $row->CLIENT_NAME);
			$this->session->set_userdata('user_status', $row->user_status);
			$bool_ = array('res_'=>true, 'db'=>$row->DB_);
		} else {
			$bool_ = array('res_'=>false, 'db'=>'default');
		}

		return $bool_;
	}
}