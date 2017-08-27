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
    
    function deletesession() {
        $data['session'] = $this->mmm->getsession_();
        echo json_encode($data);
    }
    

    function create_Session() {
        $data = $this->mmm->mcreate_session();
        echo json_encode($data);
    }
    
    function delete_Session($sessID) {
        $data = $this->mmm->mdelete_session($sessID);
        echo json_encode($data);
    }

}
