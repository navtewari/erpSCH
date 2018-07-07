<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Error_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database(_DATABASE_);
    }

    function error(){
        echo "gadbad";
    }
}