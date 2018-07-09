<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends CI_Controller {

    function __construct() {
        parent::__construct();    
        
        $this->load->model('my_discount_model', 'mdm');
    }

    function submit_discount(){
        $data = $this->mdm->submit_discount();
        echo json_encode($data);
    }

    function get_specific_discount(){
        $data = $this->mdm->get_specific_discount();
        echo json_encode($data);
    }

    function deleted_specific_discount(){
        $data = $this->mdm->deleted_specific_discount();
        echo json_encode($data);   
    }

    function get_discounts(){
        $data['discounts'] = $this->mdm->get_discounts();
        echo json_encode($data);
    }
}