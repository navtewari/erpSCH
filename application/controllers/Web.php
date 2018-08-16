<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_model', 'mm');
        $this->load->model('my_admission_model', 'mam');
        $this->load->model('my_master_fee_model', 'mmm');
        $this->load->model('my_master_model', 'mmm_');
        $this->load->model('my_discount_model', 'mdm');
        $this->load->model('my_fee_model', 'fm');
        $this->load->model('my_dashboard_reports_model', 'dr');
    }

    function dashboard($active = 1, $subno = 1, $submenu = 'index') {
        $this->check_login();
        $this->set_live_session();
        // fetching page according to active status
        $data = $this->get_page($subno);
        $data['inner_page'] = $submenu;
        $data['active'] = $active;
        // ----------------------------------------
        $data['menu'] = $this->mm->getmenu($this->session->userdata('_status_'), 1);
        $data['sub_menu'] = $this->mm->getsubmenu();

        $data['figure'] = $this->dr->all_figures_for_dashboard($this->session->userdata('_current_year___'));

        $this->load->view('templates/header');
        $this->load->view('templates/menu', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    function get_page($subno) {
        switch ($subno) {
            case 0:
                $data['page_'] = 'createuser';
                $data['title_'] = 'Create User';
                break;
            case 1:
                $data['page_'] = 'dashboard';
                $data['title_'] = 'Dashboard';
                break;
            case 2:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Sessions';
                break;
            case 3:
                $data['student_in_current_session'] = $this->mam->getstudents_for_dropdown_admission_form($this->session->userdata('_current_year___'));
                $data['admitted_students'] = $this->mam->get_admitted_students($this->session->userdata('_current_year___'));
                $data['category_'] = $this->mam->get_category();
                $data['discounts_'] = $this->mdm->get_discount_except_category_n_siblings();
                $data['page_'] = 'reg_adm';
                $data['title_'] = 'Registration';
                $data['Personal'] = ' active';
                $data['Parents'] = '';
                $data['Address'] = '';
                $data['siblings'] = '';
                $data['category'] = '';
                $data['discount'] = '';
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
                $data['title_'] = 'Master / Staff Members';
                break;
            case 8:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Fee';
                $data['duration'] = $this->mmm->get_duration();
                $data['static_heads__'] = $this->mmm->get_static_heads();
                $data['flexible_heads__'] = $this->mmm->get_flexible_heads();
                $data['classes_'] = $this->mmm->get_class_in_session($this->session->userdata('_current_year___'));
                $data['static_head'] = ' active';
                $data['flexible_head'] = '';
                $data['associate_static'] = '';
                $data['associate_flexible'] = '';
                $data['applicableDiscount'] = '';
                break;
            case 9:
                $data['page_'] = 'master';
                $data['title_'] = 'Change School Profile';
                break;
            case 10:
                $data['student_in_current_session'] = $this->mam->getstudents_for_dropdown($this->session->userdata('_current_year___'));
                $data['category_'] = $this->mam->get_category();
                $data['page_'] = 'reg_adm';
                $data['title_'] = 'Admission';
                $data['Personal'] = ' active';
                $data['Parents'] = '';
                $data['Address'] = '';
                $data['siblings'] = '';
                $data['category'] = '';
                $data['discount'] = '';
                break;
            case 11:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Discount (if any?)';
                $data['discounts'] = ' active';
                $data['discounted_items'] = $this->mdm->get_discounts();
                break;
            case 12:
                $data['page_'] = 'fee';
                $data['title_'] = 'Manage Invoice';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                $data['fetch_month'] = $this->getMonths();
                break;
            case 13:
                $data['page_'] = 'fee';
                $data['title_'] = 'Pay Fee';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                $data['fetch_month'] = $this->getMonths();
                break;
            case 14:
                $data['page_'] = 'promote';
                $data['title_'] = 'Promote students';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 15:
                $data['page_'] = 'promote';
                $data['title_'] = 'Switch students';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 16:
                $data['page_'] = 'attendance';
                $data['title_'] = 'Add Attendance';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 17:
                $data['page_'] = 'attendance';
                $data['title_'] = 'View Consolidate Attendance';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 18:
                $data['page_'] = 'attendance';
                $data['title_'] = 'View Daywise Attendance';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 19:
                $data['page_'] = 'attendance';
                $data['title_'] = 'View Total Attendance';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 20:
                $data['page_'] = 'exam';
                $data['title_'] = 'Subject Marks';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 21:
                $data['page_'] = 'exam';
                $data['title_'] = 'Scholastic Items';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 22:
                $data['page_'] = 'exam';
                $data['title_'] = 'Co-Scholastic Items';
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;            
            case 23:
                $data['page_'] = 'master';
                $data['title_'] = "Change Student's Contact Numbers";
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break; 
            case 24:
                $data['page_'] = 'exam';
                $data['title_'] = "Input Result of Students";
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 25:
                $data['page_'] = 'exam';
                $data['title_'] = "Prepare Result of Students";
                $data['class_in_session'] = $this -> fm -> get_class_in_session($this -> session -> userdata('_current_year___'));
                break;
            case 26:
                $data['page_'] = 'master';
                $data['title_'] = 'Master / Drop Student';
                $data['drop'] = ' active';
                $data['total_classes'] = $this->mam->getClasses_in_session($this->session->userdata('_current_year___'));
                $data['total_students'] = $this->mam->getStudents_in_class_in_session($this->session->userdata('_current_year___'));
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

    function getMonths(){
        $data = array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
        return $data;
    }

}