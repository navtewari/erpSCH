<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reg_adm extends CI_Controller {

    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
    }
    function index(){
    	$this->check_login();
    }
    function check_login(){
        if(! $this -> session -> userdata('_user___')) redirect('login/logout');
    }
}