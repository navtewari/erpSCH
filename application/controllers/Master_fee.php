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
}