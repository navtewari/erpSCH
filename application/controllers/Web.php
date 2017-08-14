<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    function __construct() {
        parent::__construct();        
    }

    public function index() {       
        //$this->load->view('templates/header');       
        $this->load->view('login');
        //$this->load->view('templates/footer');
    }  
    
    public function dashboard() {       
        $this->load->view('templates/header');
         $this->load->view('templates/menu');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }  

}
