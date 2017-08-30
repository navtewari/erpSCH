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

    //------------------------------------Fetch class in selected session/ Year --------------------------------------
    function get_class_in_session($year__){
        $this -> db -> where ('SESSID', $year__);
        $this -> db -> order_by('CLASSID');
        $query = $this -> db -> get('class_2_in_session');

        return $query -> result();
    }
    function get_class_fee_in_session($year__){
        $this->db->select('a.CLSSESSID, a.CLASSID, b.CFEEID, b.TOTFEE');
        $this->db->from('fee_8_class_fee b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->where('a.SESSID', $year__);
        $query = $this -> db -> get();

        //echo $this->db->last_query()."<br />";
        
        return $query->result();
    }
    function get_class_splitted_fee_in_session($year__){
        $this->db->select('a.CLSSESSID, a.CLASSID, b.CFEEID, c.CFEESPLITID, c.ST_HD_ID, c.AMOUNT, c.PAYMENT_STATUS, d.FEE_HEAD');
        $this->db->from('fee_8_class_fee b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->join('fee_9_class_fee_split c', 'b.CFEEID = c.CFEEID');
        $this->db->join('fee_3_static_heads d', 'd.ST_HD_ID = c.ST_HD_ID');
        $this->db->where('a.SESSID', $year__);
        $query = $this -> db -> get();

        //echo $this->db->last_query()."<br />";
        
        return $query->result();
    }

    //------------------------------------ASSOCIATE STATIC HEADS FEE AMT TO CLASS --------------------------------------
    function submit_static_fee_to_class(){
        $static_head = $this -> input -> post ('cmbStaticHeads');
        $seleted_classes = $this->input->post('ckhClass_');
        $fee_amount = $this -> input -> post ('txtFeeStaticHeadAmt');
        
        for($loop1 = 0; $loop1 < count($seleted_classes); $loop1++){
            $this -> db -> where('CLSSESSID', $seleted_classes[$loop1]);
            $query = $this -> db -> get ('fee_8_class_fee');

            if($query->num_rows($query) != 0){
                $item = $query->row();
                $id__ = $item -> CFEEID;
                $amt__ = $item -> TOTFEE + $fee_amount;


                // Checking whether selected static head with associated class already exists or not 
                $this -> db -> where ('CFEEID', $id__);
                $this -> db -> where ('ST_HD_ID', $static_head);
                $query_inner = $this -> db -> get('fee_9_class_fee_split');

                if($query_inner -> num_rows() != 0){ 
                    $bool_ = array('res_'=>FALSE, 'msg_' => 'Already Exists'); 
                } else {
                    $data = array(
                        'TOTFEE' => $amt__,
                        'USERNAME'=> $this -> session -> userdata('_user___'),
                        'DATE_' => date('Y-m-d H:i:s')
                    );
                    $this -> db -> where ('CFEEID', $id__);
                    $query_update = $this -> db -> update('fee_8_class_fee', $data);

                    if($query_update == TRUE){
                        $bool_ = $this -> submit_splitted_staticHead_amount_($id__, $static_head, $fee_amount, '12');
                    } else {
                        $bool_ = array('res_'=>FALSE, 'msg_' => 'Something goes wrong. Please try again');
                    }
                }

            } else {
                $data = array(
                    'CLSSESSID' => $seleted_classes[$loop1],
                    'TOTFEE' => $fee_amount,
                    'USERNAME'=> $this -> session -> userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $query_insert = $this -> db -> insert ('fee_8_class_fee', $data);
                $id__ = $this -> db -> insert_id();
                if($query_insert == TRUE){
                    $bool_ = $this -> submit_splitted_staticHead_amount_($id__, $static_head, $fee_amount, '12');
                } else {
                    $bool_ = array('res_'=>FALSE, 'msg_' => 'Something goes wrong. Please try again');
                }
            }
        }
        return $bool_;
    }
    function submit_splitted_staticHead_amount_($id__, $static_head, $fee_amount, $payment_status = '12'){
        $data = array(
            'CFEEID' => $id__,
            'ST_HD_ID' => $static_head,
            'AMOUNT' => $fee_amount,
            'PAYMENT_STATUS' => $payment_status,
            'USERNAME'=> $this -> session -> userdata('_user___'),
            'DATE_' => date('Y-m-d H:i:s')
        );
        $query = $this -> db -> insert ('fee_9_class_fee_split', $data);

        if($query == TRUE){
            $bool_ = array('res_'=>TRUE, 'msg_' => 'Successfully submitted');
        } else {
            $bool_ = array('res_'=>FALSE, 'msg_' => 'Something goes wrong. Please try again');
        }
    return $bool_;
    }

    function delete_splitted_head_from_class($splittedID){
        $this -> db -> where('CFEESPLITID', $splittedID);
        $query = $this -> db -> get('fee_9_class_fee_split');

        if($query->num_rows() != 0){
            $item = $query->row();
            $to_be_deducted_amount = $item->AMOUNT;
            $cfee_id = $item->CFEEID;

            $this -> db -> where('CFEESPLITID', $splittedID);
            $query = $this -> db -> delete('fee_9_class_fee_split');

            if($query == true){
                $this -> db -> where ('CFEEID', $cfee_id);
                $query = $this -> db -> get('fee_8_class_fee');
                if($query->num_rows() != 0){
                    $item_2 = $query->row();
                    $actual_amount = $item_2 -> TOTFEE - $to_be_deducted_amount;
                    if($actual_amount != 0) {
                        $data = array(
                            'TOTFEE' => $actual_amount
                        );
                        $this -> db -> where('CFEEID', $cfee_id);
                        $query = $this -> db -> update('fee_8_class_fee', $data);

                        if($query == true){
                            $bool_ = array('res_' => true, 'msg_' => 'Successfully deleted &amp; updated !!');
                        } else {
                            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');        
                        }
                    } else {
                        $this -> db -> where('CFEEID', $cfee_id);
                        $query = $this -> db -> delete('fee_8_class_fee');    
                        
                        if($query == true){
                            $bool_ = array('res_' => true, 'msg_' => 'Successfully deleted &amp; updated !!');
                        } else {
                            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');   
                        }
                    } 
                } else {
                    $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');    
                }
            } else {
                $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');    
            }
        } else {
            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');
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