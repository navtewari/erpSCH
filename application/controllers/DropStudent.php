<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DropStudent extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('my_drop_model', 'mdm');    
    }

	function dropstudent(){
		echo json_encode($this->mdm->dropstudent());
	}

	function get_admision_detail($regid){
        $data['personal_academics'] = $this->mam->get_admission_detail_1($regid);
        $data['address_permanent'] = $this->mam->get_admission_detail_2($regid, 'PERMANENT');
        $data['address_correspondance'] = $this->mam->get_admission_detail_2($regid, 'CORRESPONDANCE');
        $data['contact'] = $this->mam->get_admission_detail_3($regid);
        $data['siblings'] = $this->mam->get_siblings_4($regid);
        $data['discounts'] = $this->mam->get_discount_5($regid);
        $data['dropped'] = $this->mdm->get_dropped_student($regid);
        echo json_encode($data);
    }
}