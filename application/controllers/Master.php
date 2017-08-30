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

    function getclasses() {
        $data['classes'] = $this->mmm->getclasses_();
        echo json_encode($data);
    }

    function delete_Class($classID) {
        $data = $this->mmm->mdelete_class($classID);
        echo json_encode($data);
    }

    function create_Class() {
        $data = $this->mmm->mcreate_class();
        echo json_encode($data);
    }

    function get_Class_for_update($classID) {
        $data['classData'] = $this->mmm->mget_Class_for_update($classID);
        echo json_encode($data);
    }

    function update_Class($classiD) {
        $data = $this->mmm->mupdate_Class($classiD);
        echo json_encode($data);
    }
    
    function getTotalClasses(){
        $data['totalClassData']=$this -> mmm -> get_totalClass_not_present_in_current_session($this->session->userdata('_current_year___'));
        echo json_encode($data);
    }
    
    function fillClassesNewSession(){
        $data['totalclass_in_session']=$this -> mmm -> get_totalClass_in_current_session($this->session->userdata('_current_year___'));
        echo json_encode($data);
    }
    
    function fillUsedClasses(){
        $data['used_classes_']=$this -> mmm -> used_classes_($this->session->userdata('_current_year___'));
        echo json_encode($data);
    }
    
    function setClassInSession(){  
        $data = $this -> mmm -> set_Class_in_Session($this->session->userdata('_current_year___'));        
        echo json_encode($data);
    }

}
