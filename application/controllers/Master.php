<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_model', 'mm');
        $this->load->model('my_master_model', 'mmm');
    }

    function getsession() {
        $data['session'] = $this->mmm->getsession_();
        echo json_encode($data);
    }
    

    function submitSession() {
        $res_ = $this->mam->mcreate_session();
        $this->session->set_flashdata('msg_all', $res_['msg_']);        
    }

}
