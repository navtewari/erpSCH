<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ChangeDB extends CI_Controller{
	function changeit(){
		if($this->session->userdata('db2')){
			$this->db = $this->load->database($this->session->userdata('db2'), true);
		} else {
			redirect('GEN_LOGIN');
		}
	}	
}