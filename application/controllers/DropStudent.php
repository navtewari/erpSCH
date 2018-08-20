<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DropStudent extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('my_drop_model', 'mdm');    
    }

	function dropstudent(){
		echo json_encode($this->mdm->dropstudent());
	}
}