<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_master_fee_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
        $this->_db_error();
        // --------------------
    }

    function submit_static_fee_head(){
        $this -> db -> where('FEE_HEAD', trim($this->input->post('txtFeeStaticHead')));
        $query = $this -> db -> get('fee_3_static_heads');
        //return array('res_' => false, 'msg_' => $this->db->last_query());;

        if($query->num_rows() != 0){
            $bool_ = array('res_' => false, 'msg_' => 'X: This head is already exists.');
        } else {
            $data = array(
                'FEE_HEAD' => strtoupper($this -> input -> post('txtFeeStaticHead')),
                'USERNAME' => $this -> session -> userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
                );
        	$query = $this->db->insert('fee_3_static_heads', $data);
            if($query == true){
                $bool_ = array('res_' => true, 'msg_' => 'Submitted Successfully..!!');
            } else {
                $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
            }
        }
        return $bool_;
    }

    function get_static_heads(){
        $query = $this -> db -> get('fee_3_static_heads');

        return $query->result();
    }
    function update_static_head(){
        $data = array(
            'FEE_HEAD' => trim(strtoupper($this->input->post('txtFeeStaticHead_edit'))),
            'USERNAME' => $this -> session -> userdata('_user___'),
            'DATE_' => date('Y-m-d H:i:s')
        );
        $this -> db -> where('ST_HD_ID', $this->input->post('txtID_edit'));
        $query = $this -> db -> update('fee_3_static_heads', $data);

        if($query == true){
            $bool_ = array('res_' => true, 'msg_' => 'Updated Successfully..!!');
        } else {
            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
        }
        return $bool_;
    }
    function delete_static_head($stid){
        $this -> db -> where ('ST_HD_ID', $stid);
        $query = $this -> db -> delete('fee_3_static_heads');

        if($query == true){
            $bool_ = array('res_' => true, 'msg_' => 'Delete Successfully..!!');
        } else {
            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
        }
        return $bool_;
    }
    
    //------------------------------------FLEXIBLE HEADS--------------------------------------
    function get_flexible_heads(){
        $query = $this -> db -> get('fee_4_flexible_heads');
        return $query->result();
    }
    
    function flexible_head_exists($head_){
        $this -> db -> where('FEE_HEAD', trim($head_));
        $query = $this -> db -> get('fee_4_flexible_heads');
        if($query->num_rows() != 0){
            $bool_ = array('res_' => false, 'msg_' => '<span style="color:#ff0000; font-weight: bold">X: Not-Available. Already Exists</span>');
        } else {
            $bool_ = array('res_' => true, 'msg_' => '<span style="color:#0000ff; font-weight: bold">This head is Available. Go ahead.</span>');
        }
        
        return $bool_;
    }
    function submit_flexible_fee_head(){
        $this -> db -> where('FEE_HEAD', trim($this->input->post('txtFeeFlexibleHead')));
        $query = $this -> db -> get('fee_4_flexible_heads');

        if($query->num_rows() != 0){
            $bool_ = array('res_' => false, 'msg_' => 'X: This head is already exists.');
        } else {
            $data = array(
                'FEE_HEAD' => strtoupper($this -> input -> post('txtFeeFlexibleHead')),
                'AMOUNT' => strtoupper($this -> input -> post('txtFeeFlexibleHeadAmt')),
                'USERNAME' => $this -> session -> userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
                );
            $query = $this->db->insert('fee_4_flexible_heads', $data);
            if($query == true){
                $bool_ = array('res_' => true, 'msg_' => 'Submitted Successfully..!!');
            } else {
                $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
            }
        }
        return $bool_;
    }
 
    function update_flexible_head(){
        $data = array(
            'FEE_HEAD' => trim(strtoupper($this->input->post('txtFlexibleHead_edit'))),
            'AMOUNT' => trim(strtoupper($this->input->post('txtFlexibleHeadAmt_edit'))),
            'USERNAME' => $this -> session -> userdata('_user___'),
            'DATE_' => date('Y-m-d H:i:s')
        );
        $this -> db -> where('FLX_HD_ID', $this->input->post('txtFlexID_edit'));
        $query = $this -> db -> update('fee_4_flexible_heads', $data);

        if($query == true){
            $bool_ = array('res_' => true, 'msg_' => 'Updated Successfully..!!');
        } else {
            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
        }
        return $bool_;
    }
    function delete_flexible_head($flexid){
        $this -> db -> where ('FLX_HD_ID', $flexid);
        $query = $this -> db -> delete('fee_4_flexible_heads');

        if($query == true){
            $bool_ = array('res_' => true, 'msg_' => 'Delete Successfully..!!');
        } else {
            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
        }
        return $bool_;
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