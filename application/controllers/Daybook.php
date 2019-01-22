<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daybook extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('my_model', 'mm');
        $this->load->model('my_daybook_model', 'dbm');
    }

    function index(){
    	$this -> check_login();

    	$data['breadCrumb'] = 'Day Book';
        $data['title'] = 'Manage Day Book';

        $data['last_reg_'] = $this -> mm -> last_registration();
        $data['menu_'] = $this -> mm -> getmenu();
        $data['submenu_'] = $this -> mm -> getsubmenu();

        $this -> load -> view('templates/header', $data);
        $this -> load -> view('daybook/index', $data);
        $this -> load -> view('templates/footer');
    }

    function getCategory(){
        $data['dbcategory'] = $this->dbm->getCatgory();
        echo json_encode($data);
    }

    function getHeads($categid){
        $data['dbHead'] = $this->dbm->getHeads($categid);
        echo json_encode($data); 
    }

    function getSubHeads($hid){
        $data['dbSHead'] = $this->dbm->getSubHeads($hid);
        echo json_encode($data); 
    }

    function getSubHeadsAll(){
        $data['dbSHead'] = $this->dbm->getSubHeadsAll();
        echo json_encode($data);    
    }

    function check_login(){
        if(! $this -> session -> userdata('_user___')) redirect('web/logout');
    }

}