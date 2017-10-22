<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_master_fee_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
        $this->_db_error();
        // --------------------
    }

    function get_duration(){
        $query = $this->db->get('fee_0_duration');
        return $query->result();
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
                'DURATION' => $this->input->post('cmbDuration'),
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
        $this->db->select('a.ITEM, b.*');
        $this->db->from('fee_0_duration a');
        $this->db->join('fee_3_static_heads b', 'a.DURATION = b.DURATION');
        $query = $this -> db -> get();
        return $query->result();
    }
    function update_static_head(){
        $data = array(
            'FEE_HEAD' => trim(strtoupper($this->input->post('txtFeeStaticHead_edit'))),
            'DURATION' => $this->input->post('cmbDuration_edit'),
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
        $this->db->select('a.ITEM, b.*');
        $this->db->from('fee_0_duration a');
        $this->db->join('fee_4_flexible_heads b', 'a.DURATION = b.DURATION');
        $query = $this -> db -> get();
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
                'DURATION' => $this->input->post('cmbDuration_felxi'),
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
            'DURATION' => $this->input->post('cmbDuration_felxi_edit'),
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
    function get_static_heads_to_class($class__){
        $this->db->select('d.CLASSID, c.FEE_HEAD, a.TOTFEE, b.AMOUNT, b.PAYMENT_STATUS');
        $this->db->from('fee_8_class_fee a');
        $this->db->join('fee_9_class_fee_split b', 'a.CFEEID=b.CFEEID');
        $this->db->join('fee_3_static_heads c', 'c.ST_HD_ID = b.ST_HD_ID');
        $this->db->join('class_2_in_session d', 'd.CLSSESSID = a.CLSSESSID');
        $this->db->where('a.CLSSESSID', $class__);
        $query = $this->db->get();
        
        return $query->result();
    }

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

    // ASSOCIATE FLEXIBE HEADS TO THE INDIVIDUAL STUDENTS

    function associateFlexibleHead_with_student($year__){
        $cnt = 0;
        $total = 0;
        $anyquery = true;
        $students = $this->input->post('ckhStudents_');
        $class_in_session_ = $this->input->post('optClasses');
        $flx_hd_id = $this->input->post('opt_flexible_heads');

        $bool_ = FALSE;
        for($loop1_ = 0; $loop1_ < count($students); $loop1_++){

            $this->db->where('CLSSESSID', $class_in_session_);
            $this->db->where('SESSID', $year__);
            $this->db->where('FLX_HD_ID', $flx_hd_id);
            $this->db->where('REGID', $students[$loop1_]);
            $this->db->where('STATUS', 1);
            $query = $this->db->get('fee_5_add_flexi_head_to_students');
            $total++;
            if($query->num_rows() != 0){
            } else {
                $data = array(
                    'REGID' => $students[$loop1_],
                    'CLSSESSID' => $class_in_session_,
                    'SESSID' => $year__,
                    'FLX_HD_ID' => $flx_hd_id,
                    'STATUS' => 1,
                    'USERNAME' => $this->session->userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $bool_ = $this->db->insert('fee_5_add_flexi_head_to_students', $data);
                if($bool_ == false){
                    $anyquery = false;
                }
            }
            if($bool_ == true){
                $cnt++;
            }
        }
        if($cnt > 0){
            if($anyquery == false){
                $bool_ = array('res_' => true, 'msg_' => 'Out of ' . $total . ' selected students '.$cnt.' Successfully submitted. Please try again for rest!!');
            } else {
                $bool_ = array('res_' => true, 'msg_' => 'Out of ' . $total . ' selected students '.$cnt.' Successfully submitted. Rest already exists!!');
            }
        } else {
            if($anyquery == false){
                $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');
            } else {
                $bool_ = array('res_' => false, 'msg_' => 'Already Exists !!');
            }
        }
    return $bool_;
    }

    function get_associatedFlexibleHead_with_student($year__, $reg_id = 'x'){
        $this->db->select('a.FEE_HEAD, a.AMOUNT, b.*');
        $this->db->from('fee_4_flexible_heads a');
        $this->db->join('fee_5_add_flexi_head_to_students b', 'a.FLX_HD_ID = b.FLX_HD_ID', 'left');
        $this -> db -> where('b.SESSID', $year__);
        $this -> db -> where('b.STATUS', 1);

        if($reg_id != 'x') $this -> db -> where('REGID', $reg_id);

        $query = $this -> db -> get();

        return $query->result();
    }

    /*
    function del_associated_flx_with_student_old($flx_asso_student_id, $regid){
        $where_condition = "FIND_IN_SET('".$flx_asso_student_id."', ADFLXFEESTUDID)";
        $this->db->where($where_condition);
        $this->db->where('REGID', $regid);
        $query = $this->db->get('fee_5_add_flexi_head_to_students');

        if($query->num_rows() != 0){
            $data = array(
                'STATUS' => 0
            );
            $this->db->where('ADFLXFEESTUDID', $flx_asso_student_id);
            $bool_ = $this->db->update('fee_5_add_flexi_head_to_students', $data);
        } else {
            $this->db->where('ADFLXFEESTUDID', $flx_asso_student_id);
            $bool_ = $this->db->delete('fee_5_add_flexi_head_to_students');
        }
        return $bool_;
    }
    */

    function del_associated_flx_with_student($flx_asso_student_id){
        $this->db->where('ADFLXFEESTUDID', $flx_asso_student_id);
        $bool_ = $this->db->delete('fee_5_add_flexi_head_to_students');
        if($bool_ == true){
            $bool_ = array('res_' => true, 'msg_' => 'Sucessfully Deleted !!');
        } else {
            $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again !!');
        }
        return $bool_;
    }

    function get_flexible_fee_head_for_class($class__){
        $this->db->select('c.regid, a.FEE_HEAD, a.AMOUNT, b.*');
        $this->db->from('fee_4_flexible_heads a');
        $this->db->join('fee_5_add_flexi_head_to_students b', 'a.FLX_HD_ID = b.FLX_HD_ID', 'left');
        $this->db->join('master_7_stud_personal c', 'b.REGID=c.regid');
        $this -> db -> where('b.CLSSESSID', $class__);
        $this -> db -> where('b.STATUS', 1);
        $query = $this -> db -> get();
        return $query->result();
    }

    function get_students_in_class($clssessid){
        $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this->db->where('b.clssessid', $clssessid);
        $query = $this->db->get();
        return $query->result();
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