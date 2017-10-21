<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_model', 'mm');
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('My_master_fee_model', 'mmm');
        $this->load->model('my_discount_model', 'mdm');
    }

    public function dashboard($active = 1, $subno = 1, $submenu = 'index') {
        $this->check_login();
        $this->set_live_session();

        // fetching page according to active status
        $data = $this->get_page($subno);
        $data['inner_page'] = $submenu;
        $data['active'] = $active;
        // ----------------------------------------
        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    function get_page($subno) {
        switch ($subno) {
            case 1:
                $data['page_'] = 'dashboard';
                $data['title_'] = 'Dashboard';
                break;
            case 2:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Sessions';
                break;
            case 3:
                $data['student_in_current_session'] = $this->mam->getstudents_for_dropdown($this->session->userdata('_current_year___'));
                $data['page_'] = 'reg_adm';
                $data['title_'] = 'Registration';
                $data['Personal'] = ' active';
                $data['Parents'] = '';
                $data['Address'] = '';
                $data['siblings'] = '';
                break;
            case 4:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Classes';
                break;
            case 5:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Subject';
                break;
            case 6:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / grading';
                break;
            case 7:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Teachers';
                break;
            case 8:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Fee';
                $data['static_heads__'] = $this->mmm->get_static_heads();
                $data['flexible_heads__'] = $this->mmm->get_flexible_heads();
                $data['classes_'] = $this->mmm->get_class_in_session($this->session->userdata('_current_year___'));
                $data['static_head'] = ' active';
                $data['flexible_head'] = '';
                $data['associate_static'] = '';
                $data['associate_flexible'] = '';
                break;
            case 9:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / General';
                break;
            case 10:
                $data['student_in_current_session'] = $this->mam->getstudents_for_dropdown($this->session->userdata('_current_year___'));
                $data['page_'] = 'reg_adm';
                $data['title_'] = 'Admission';
                $data['Personal'] = ' active';
                $data['Parents'] = '';
                $data['Address'] = '';
                $data['siblings'] = '';
                break;
            case 11:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Discount (if any?)';
                $data['discounts'] = ' active';
                $data['discounted_items'] = $this->mdm->get_discounts();
                break;
            default:
                $data['page_'] = 'erorrs';
        }
        return $data;
    }
    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }

    function set_live_session(){
        $thisyr = date('Y');
        $nextyr = date('y')+1;
        $live_ = $thisyr . "-" . $nextyr;
        $this->session->set_userdata('live__' , $live_);
    }

}