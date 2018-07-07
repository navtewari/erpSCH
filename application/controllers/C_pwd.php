<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_pwd extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database(_DATABASE_);
        $this->load->model('my_model', 'mm');
        if (! $this->session->userdata('_user___')) {
            redirect(__BACKTOSITE__);
        }
    }

    function index(){
        if($this->session->userdata('pwd_count') && $this->session->userdata('pwd_count') > 3){
            redirect('login/logout');
        }
        $data['user___'] = $this->session->userdata('_user___');
        $data['wallpaper_'] = '';
        
        $this->check_login();

        $data['inner_page'] = 'cpwd';
        $data['active'] = 1;

        $data['page_'] = 'c_pwd';
        $data['title_'] = "Change Password";
        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    function changepwd(){
        if($this->session->userdata('pwd_count')){
            $cnt_ = $this->session->userdata('pwd_count');
            $this->session->set_userdata('pwd_count', ++$cnt_);
        } else {
            $this->session->set_userdata('pwd_count', 1);
        }
        $res = $this->mm->changepwd();
        echo $res['msg_'];
    }

    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }
}
