<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }  

}