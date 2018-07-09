<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_fee extends CI_Controller {
    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
        $this->load->model('My_master_fee_model', 'mmm');
    }
    
    function get_static_fee_heads(){
        $data['static_heads'] = $this->mmm->get_static_heads();
        echo json_encode($data);
    }

    function submit_static_fee_head(){
    	$data = $this->mmm->submit_static_fee_head();
    	echo json_encode($data);
    }

    function update_static_head(){
    	$data = $this->mmm->update_static_head();
        echo json_encode($data);
    }

    function deleteStatichead($stid){
        $data = $this->mmm->delete_static_head($stid);
        echo json_encode($data);
    }

    function get_flexible_heads(){
        $data['flexi_heads'] = $this->mmm->get_flexible_heads();
        echo json_encode($data);
    }

    function submit_flexible_fee_head(){
        $data = $this->mmm->submit_flexible_fee_head();
        echo json_encode($data);
    }

    function update_flexible_head(){
        $data = $this->mmm->update_flexible_head();
        echo json_encode($data);
    }

    function delete_flexible_head($flexid){
        $data = $this->mmm->delete_flexible_head($flexid);
        echo json_encode($data);
    }

    function get_class_in_session(){
        $data['classes_'] = $this->mmm->get_class_in_session($this->session->userdata('_current_year___'));
        echo json_encode($data);
    }

    function submit_static_fee_to_class(){
        $data = $this->mmm->submit_static_fee_to_class();
        echo json_encode($data);
    }

    function fill_accordion_statichead_associates_classes(){
        $data['class_fee_in_session'] = $this -> mmm -> get_class_fee_in_session($this -> session -> userdata('_current_year___'));
        $data['class_splitted_fee_in_session'] = $this -> mmm -> get_class_splitted_fee_in_session($this -> session -> userdata('_current_year___'));
        echo json_encode($data);
    }

    function delete_splitted_head_from_class($splittedID){
        $data = $this -> mmm -> delete_splitted_head_from_class($splittedID);
        echo json_encode($data);   
    }

    function getStduents_in_current_session($clssessid){
        $data['students__'] = $this->mmm->get_students_in_class($clssessid);
        echo json_encode($data);
    }

    function associateFlexibleHead_with_student(){
        $data = $this->mmm->associateFlexibleHead_with_student($this->session->userdata('_current_year___'));
        echo json_encode($data);
    }

    function get_flexible_fee_head_for_class($clssessid){
        $data['view_student_associated_with_flexible_heads'] = $this->mmm->get_flexible_fee_head_for_class($clssessid);
        $data['students__'] = $this->mmm->get_students_in_class($clssessid);
        echo json_encode($data);
    }

    function del_associated_flx_with_student($flx_asso_student_id){
        $data = $this->mmm->del_associated_flx_with_student($flx_asso_student_id);
        echo json_encode($data);
    }
}