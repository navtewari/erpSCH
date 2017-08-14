<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    function __construct() {
        parent::__construct();    
        $this->load->model('my_model', 'mm');    
    }

    public function index() {       
        //$this->load->view('templates/header');       
        $this->load->view('login');
        //$this->load->view('templates/footer');
    }  
    
    public function dashboard($active = 1, $submenu = 'index') {       
        //$data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'));
        $data['active'] = $active;
        
        // fetching page according to active status
        $data['page_'] = $this->get_page($active);
        $data['inner_page'] = $this->get_submenu($submenu);
        // ----------------------------------------s

        $data['menu'] = $this->mm->getmenu('adm', 1);
        $data['sub_menu'] = $this->mm->getsubmenu();
        
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }  
    function get_page($active){
        switch($active){
            case 1:
                $page_ = 'dashboard';
                break;
            case 2:
                $page_ = 'master';
                break;
            default: 
                $page_ = 'eror';
        }
        return $page_;
    }
    function get_submenu($submenu){
        switch($submenu){
            case 1:
                $inner_page = 'dashboard';
                break;
            case 2:
                $inner_page = 'master';
                break;
            default: 
                $inner_page = 'index';
        }
        return $inner_page;
    }
}
