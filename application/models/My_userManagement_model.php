<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_usermanagement_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }
    function getUsers($user = 'x'){
    	$this->db->select('b.USERNAME_, b.PASSWORD_, a.name, b.ACTIVE, c.STATUS, a.CATEGORY_ID, b.STAFFID');
    	$this->db->from('master_13_staff a');
    	$this->db->join('login b', 'a.teacherID = b.STAFFID');
    	$this->db->join('master_5_user_status c', 'c.ST_ID=a.CATEGORY_ID');
        if($user != 'x'){
            $this->db->where('b.USERNAME_', $user);
        }
    	//$this->db->where('b.ACTIVE', 1);
		//$this->db->where('a.STATUS_', 1);
    	$query = $this->db->get();
        if($user != 'x'){
            $bool_ = $query->row();
        } else {
            $bool_ = $query->result();
        }
    	return $bool_;
    }
    function getuserstatus(){
    	$query=$this->db->get('master_5_user_status');
    	return $query->result();
    }
    function getStaffData($categ_status = 'x'){
    	if($categ_status != 'x'){
    		$this->db->where('CATEGORY_ID', $categ_status);
    	}
    	$query = $this->db->get('master_13_staff');
    	return $query->result();
    }
    function createuser(){
    	$user = $this->input->post('txtUser_');
    	$pwd = $this->input->post('txtPwd_');
    	$status = $this->input->post('cmbUserStatus');
    	$staffid = $this->input->post('cmbStaff');
    	$active = 0;

    	$this->db->where('USERNAME_', $user);
    	$query = $this->db->get('login');

    	if($query->num_rows() != 0){
    		$data['res_']=false;
    		$data['msg_']= 'Username already Exists.';
    	} else {
    		$data = array(
    			'USERNAME_'=>$user,
    			'PASSWORD_'=>$pwd,
    			'STAFFID' => $staffid,
    			'ACTIVE' => 0
    		);
    		if($this->db->insert('login', $data) == true){
    			$data['res_'] = true;
    			$data['msg_'] = 'New User successfully created.';
    		} else {
    			$data['res_'] = false;
    			$data['msg_'] = 'Something goes wrong. Please try again';
    		}
    	}
    	return $data;
    }
    function updateuser(){
    	$user = $this->input->post('txtUser_');
        $pwd_ = $this->input->post('txtPwd_');
    	$staffid = $this->input->post('cmbStaff');

    	$this->db->where('USERNAME_', $user);
    	$data = array(
            'PASSWORD_'=> $pwd_,
    		'STAFFID' => $staffid
    	);
    	if($this->db->update('login', $data)){
			$data['res_'] = true;
			$data['msg_'] = 'User successfully updated.';
		} else {
			$data['res_'] = false;
			$data['msg_'] = 'Something goes wrong. Please try again';
		}
		return $data;
    }
    function activeDeactiveUser($user, $active_status){
    	$this->db->where('USERNAME_', $user);
    	$data = array(
    		'ACTIVE' => $active_status
    	);
    	if($this->db->update('login', $data) == true){
    		$data['res_'] = true;
    	} else {
    		$data['res_'] = false;
    	}
    	return $data;
    }
}