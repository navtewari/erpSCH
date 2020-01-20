<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->session->userdata('main_user')){
            redirect('gen_login');
        }
        $this->load->model('my_model', 'mm');
    }

    function index(){
        $this->session->set_userdata($this->mm->get_profile());
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
        $data = array(
            '_name_',
            '_user___',
            '_status_',
            '_current_year___',
            '_previous_year___',
            '_current_year_selected__',
        );
        $this->session->unset_userdata($data);
        redirect('login');
    }
    public function check_login(){
        if(! $this -> session -> userdata('_user___')) $this -> logout();
    }
}