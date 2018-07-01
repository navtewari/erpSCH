<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_error_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }  
    
	function _db_error(){
        //exception handling ------------------
        if ($this -> db -> trans_status() == FALSE) {
            echo "gadbad";
            die();
            //redirect('web/dberror');
        }
        //-------------------------------------
    }
}