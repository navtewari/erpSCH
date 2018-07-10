<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gen_login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('My_gen_login_model', 'mglm');
	}
	function index(){
		$this->session->sess_destroy();
		$this->load->view('genlogin/login');
	}
	function checking(){
		$i = $this->mglm->checkit();
		if($i['res_'] == true){
			if($this->session->userdata('user_status') != 'admin'){
				redirect('login/');
			} else {
				redirect('https://teamfreelancers.com');
			}
        } else {
            redirect('gen_login');
        }
	}
}