<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_discount_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
    }  

    function submit_discount(){
    	$item_ = strtoupper($this->input->post('txtItem'));
    	$status_ = $this->input->post('cmdStatus');
        $category = $this->input->post('cmbCategory');
    	$amount_ = $this->input->post('txtAmount');
    	$desc_ = $this->input->post('txtDesc');

    	if($this->input->post('txtBool') == 'new'){
    		// Code for new record
    		$this->db->where('ITEM_', $item_);
    		$query = $this->db->get('master_16_discount');
    		if($query->num_rows()!=0){
    			$bool_ = array('res_' => false, 'msg_' => 'Item name already exists !! Please try another one.');
    		} else {
    			$Discount = array(
	    			'ITEM_' => $item_,
	    			'STATUS_' =>$status_,
                    'CATEGORY'=>$category,
	    			'AMOUNT' =>$amount_,
	    			'DESC_'=>$desc_,
	    			'DATE_'=> date('Y-m-d H:i:s')
	    		);
	    		$query = $this->db->insert('master_16_discount', $Discount);
	    		if($query == true){
	    			$bool_ = array('res_' => true, 'msg_' => 'Submitted Successfully..!!');
	    		} else {
	    			$bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
	    		}
    		}
    		
    	} else {
    		// Code for update the record
    		$did = $this->input->post('txtDiscountID');
    		$Discount = array(
    			'ITEM_' => $item_,
    			'STATUS_' =>$status_,
                'CATEGORY'=>$category,
    			'AMOUNT' =>$amount_,
    			'DESC_'=>$desc_,
    			'DATE_'=> date('Y-m-d H:i:s')
    		);
    		$this->db->where('DID', $did);
    		$query = $this->db->update('master_16_discount', $Discount);
    		if($query == true){
    			$bool_ = array('res_' => true, 'msg_' => 'Updated Successfully..!!');
    		} else {
    			$bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
    		}

    	}

    	return $bool_;
    }

    function get_discounts(){
    	$this->db->distinct();
    	$this->db->select('DID, ITEM_, STATUS_, CATEGORY, AMOUNT, DESC_');
    	$query = $this->db->get('master_16_discount');
    	return $query->result();
    }

    function get_specific_discount(){
    	$did = $this->input->post('did');
    	$this->db->where('DID', $did);
    	$query = $this->db->get('master_16_discount');
    	return $query->row();
    }

    function deleted_specific_discount(){
    	$did = $this->input->post('did');
    	$this->db->where('DID', $did);
    	$query = $this->db->delete('master_16_discount');
    	return $query;
    }
    function _db_error(){
        //exception handling ------------------
        if ($this -> db -> trans_status() == false) {
            echo "gadbad";
            die();
            //redirect('web/dberror');
        }
        //-------------------------------------
    }
}