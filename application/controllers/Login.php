<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');
    }

    function index(){
        $this->session->sess_destroy();
        $data['master_sessions'] = $this->mm->getsessions();
    	$this->load->view('login', $data);
    }

    function authenticate(){
    	if($this->mm->authenticate() == true){
            redirect('web/dashboard');
        } else {
            redirect('login');
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
    public function check_login(){
        if(! $this -> session -> userdata('_user___')) $this -> logout();
    }
}