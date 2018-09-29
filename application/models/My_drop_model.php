<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_drop_model extends CI_Model {
	function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function dropstudent(){
    	$regid = $this->input->post('cmbRegistrationID_to_Drop');
    	$reason = $this->input->post('txtReasonToDrop');

    	$this->db->where('regid', $regid);
    	$data = array(
            'DOL' => date('Y-m-d H:i:s'),
    		'STATUS_' => 0
    	);
    	if($this->db->update('master_8_stud_academics', $data) == true){
    		$data = array(
    			'regid' => $regid,
    			'REASON' => $reason,
    			'USERNAME_' => $this->session->userdata('_user___'),
    			'DATE_' => date('Y-m-d H:i:s'),
    			'SESSID'=> $this->session->userdata('_current_year___'),
                'STATUS_' => 1
    		);
    		if($this->db->insert('_drop_students', $data) == true){
    			$bool = array('res_' => true, 'msg_' => $regid . ' Successfully dropped');
    		} else {
    			$bool = array('res_' => true, 'msg_' => $regid . ' Successfully dropped but not stored.');
    		}
    	} else {
    		$bool = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...');
    	}
    	return $bool;
    }

    function get_dropped_student($regid){
        $this->db->where('regid', $regid);
        $this->db->where('STATUS_', 1);
        $query = $this->db->get('_drop_students');
        if($query->num_rows()!=0){
            $bool_ = array('res'=>true, 'record'=>$query->row());
        } else {
            $bool_ = array('res'=>false, 'record'=>'x');
        }
        return $bool_;
    }
}