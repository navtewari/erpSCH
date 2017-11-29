
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_fee_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
    }  

    function check_previous_invoice_generation($class__){
        $this->db->where('CLSSESSID', $class__);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $this->db->from('fee_6_invoice');
        $this->db->order_by('cast(YEAR_TO AS SIGNED INTEGER)', 'desc');
        $this->db->order_by('cast(MONTH_TO AS SIGNED INTEGER)', 'desc');
        $this->db->order_by('INVID', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows()!=0){
            $r = $query->row();
            $data['msg'] = '*Invoice had already been generted Upto <b style="color: #000090">'.$this->getMonths($r->MONTH_TO) .', '.$r->YEAR_TO.'</b> for the selected class.';
            $data['month'] = $r->MONTH_TO;
            $data['year'] = $r->YEAR_TO;
        } else {
            $data['msg'] = '*No invoice yet generated for the selected class. Please proceed.';
            $data['month'] = 'x';
            $data['year'] = 'x';
        }
        return $data;
    }
    function get_invoice_for_receipt($class__){
        $this->db->group_by('YEAR_TO, MONTH_TO');
        $this->db->where('CLSSESSID', $class__);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $this->db->order_by('cast(YEAR_TO AS SIGNED INTEGER)', 'desc');
        $this->db->order_by('cast(MONTH_TO AS SIGNED INTEGER)', 'desc');
        //$this->db->limit(1);
        $query = $this->db->get('fee_6_invoice');
        if($query->num_rows()!=0){
            $R = $query->row();
            $this->db->select('b.FNAME, b.MNAME, b.LNAME, b.GENDER, a.*, C.INVDETID, c.STATIC_HEADS_1_TIME, c.STATIC_SPLIT_AMT_1_TIME, c.STATIC_HEADS_N_TIMES, c.STATIC_SPLIT_AMT_N_TIME, c.FLEXIBLE_HEADS_1_TIME, c.FLEXI_SPLIT_AMT_1_TIME, c.FLEXIBLE_HEADS_N_TIMES, c.FLEXI_SPLIT_AMT_N_TIMES, c.ACTUAL_AMOUNT, c.REGID, c.ACTUAL_DUE_AMOUNT, c.PREV_DUE_AMOUNT, c.DUE_AMOUNT');
            $this->db->where('a.CLSSESSID', $class__);
            $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
            $this->db->where('a.YEAR_FROM',$R->YEAR_FROM);
            $this->db->where('a.MONTH_FROM',$R->MONTH_FROM); 
            $this->db->where('a.YEAR_TO',$R->YEAR_TO);
            $this->db->where('a.MONTH_TO',$R->MONTH_TO);
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail c', 'a.INVID = c.INVID');
            $this->db->join('master_7_stud_personal b', 'c.REGID=b.regid');
            $this->db->order_by('cast(c.REGID AS SIGNED INT)', 'ASC');
            $query = $this->db->get();
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
    }

    function get_static_heads_to_class($class__){
        $this->db->select('d.CLASSID, c.FEE_HEAD, a.TOTFEE, b.AMOUNT, b.PAYMENT_STATUS, c.DURATION');
        $this->db->from('fee_8_class_fee a');
        $this->db->join('fee_9_class_fee_split b', 'a.CFEEID=b.CFEEID');
        $this->db->join('fee_3_static_heads c', 'c.ST_HD_ID = b.ST_HD_ID');
        $this->db->join('class_2_in_session d', 'd.CLSSESSID = a.CLSSESSID');
        $this->db->where('a.CLSSESSID', $class__);
        $query = $this->db->get();
        return $query->result();
    }

    function get_flexible_fee_head_for_class($class__, $regid_ = 'x'){
            $this->db->select('c.regid, a.FEE_HEAD, a.DURATION, a.AMOUNT, b.*');
            $this->db->from('fee_4_flexible_heads a');
            $this->db->join('fee_5_add_flexi_head_to_students b', 'a.FLX_HD_ID = b.FLX_HD_ID', 'left');
            $this->db->join('master_7_stud_personal c', 'b.REGID=c.regid');
            $this -> db -> where('b.CLSSESSID', $class__);
            $this -> db -> where('b.STATUS', 1);
            if($regid_ != 'x'){
                $this -> db -> where('c.regid', $regid_);
            }
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
        //echo $this->db->last_query();
        return $query->result();
    }
    
    //------------------------------------Fetch class in selected session/ Year --------------------------------------
    function get_class_in_session($year__){
        
        $year__ = $this->session->userdata('_current_year___');
        $this -> db -> where ('SESSID', $year__);
        $this -> db -> order_by('CLASSID');
        $query = $this -> db -> get('class_2_in_session');

        return $query -> result();
    }
    function get_class_fee_in_session($year__){

        $this->db->select('a.CLSSESSID, a.CLASSID, b.CFEEID, b.TOTFEE');
        $this->db->from('fee_8_class_fee b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $query = $this -> db -> get();

        //echo $this->db->last_query()."<br />";
        
        return $query->result();
    }
    function get_class_splitted_fee_in_session($year__){

        $this->db->select('a.CLSSESSID, a.CLASSID, b.CFEEID, c. CFEESPLITID, c.ST_HD_ID, c.AMOUNT, c.PAYMENT_STATUS, d.FEE_HEAD');
        $this->db->from('fee_8_class_fee b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->join('fee_9_class_fee_split c', 'b.CFEEID = c.CFEEID');
        $this->db->join('fee_3_static_heads d', 'd.ST_HD_ID = c.ST_HD_ID');
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $query = $this -> db -> get();

        //echo $this->db->last_query()."<br />";
        
        return $query->result();
    }
    // -----------------------------------------------------------------------------------------------------------------

    // Fetch Previous Invoice data
    function get_invoice_data($class__, $yr_from, $mnth_from, $yr_to, $mnth_to){
        $this->db->select('a.INVID, b.REGID');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
        $this->db->where('a.CLSSESSID', $class__);
        $this->db->where('a.YEAR_FROM', $yr_from);
        $this->db->where('a.MONTH_FROM', $mnth_from);
        $this->db->where('a.YEAR_TO', $yr_to);
        $this->db->where('a.MONTH_TO', $mnth_to);
        $query = $this->db->get();
        return $query->result();
    }

    function generateInvoice($class__, $yr_from, $mnth_from, $yr_to, $mnth_to, $regid_, $no_of_months){
        $s = 'x';
        $data = $this->check_previous_individual_invoice($regid_, $class__, $yr_from, $mnth_from, $yr_to, $mnth_to);
        //print_r($data);
        //exit();
        if($data['bool_'] == false){
            $data = $this->check_invoice($class__, $yr_from, $mnth_from, $yr_to, $mnth_to);
            if($data['bool_'] == false){
                $data1 = array(
                    'SESSID' => $this->session->userdata('_current_year___'),
                    'CLSSESSID' => $class__,
                    'YEAR_FROM' => $yr_from,
                    'MONTH_FROM'=> $mnth_from,
                    'YEAR_TO'=> $yr_to,
                    'MONTH_TO'=> $mnth_to,
                    'NOM'=>$no_of_months,
                    'DESCRIPTION_IFANY'=> 'X',
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('fee_6_invoice', $data1);
                if($query == true){
                    $invoiceid = $this->db->insert_id();
                    $data_['bool__'] = 1;
                } else {
                    $data_['bool__'] = 0;
                }
            } else {
                $invoiceid = $data['invid'];
            }
            $data_ = $this->check_invoice_detail($invoiceid, $regid_);
            if($data_['bool_'] == false){
                $data_static = $this->fetch_static_heads_to_class($class__, $regid_,$no_of_months);
                $data_flexi = $this->fetch_flexi_heads_to_students($class__, $regid_,$no_of_months);
                $total_actual_amount = $data_static['static_amount'] + ($data_static['n_static_amount']*$no_of_months) + $data_flexi['_flexi_amount'] + ($data_flexi['n_flexi_amount']*$no_of_months);
                $due_amount = $this->fetch_due_amount_in_invoice($regid_);
                $total_amount_due = $due_amount+$total_actual_amount;
                $data1 = array(
                    'INVID'=>$invoiceid,
                    'STATIC_HEADS_1_TIME'=>$data_static['static_heads'],
                    'STATIC_SPLIT_AMT_1_TIME'=>$data_static['static_heads_amount'],
                    'STATIC_HEADS_N_TIMES'=>$data_static['n_static_heads'],
                    'STATIC_SPLIT_AMT_N_TIME'=>$data_static['n_static_heads_amount'],
                    'FLEXIBLE_HEADS_1_TIME'=>$data_flexi['flexi_heads'],
                    'FLEXI_SPLIT_AMT_1_TIME'=>$data_flexi['flexi_heads_amount'],
                    'FLEXIBLE_HEADS_N_TIMES'=>$data_flexi['n_flexi_heads'],
                    'FLEXI_SPLIT_AMT_N_TIMES'=>$data_flexi['n_flexi_heads_amount'],
                    'ACTUAL_AMOUNT'=> $total_actual_amount,
                    'DESCRIPTION_IFANY' => 'X',
                    'REGID'=>$regid_,
                    'ACTUAL_DUE_AMOUNT'=>$total_actual_amount,
                    'PREV_DUE_AMOUNT'=>$due_amount,
                    'DUE_AMOUNT'=>$total_amount_due,
                    'DATE_'=> date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('fee_6_invoice_detail', $data1);
                if($query == true){
                    $data_['bool__'] = 1; // Invoice Successfully generated
                    $s = "Invoice Successfully generated";
                } else {
                    $data_['bool__'] = 0; // Something goes wrong. Please try again
                    $s = "Something goes wrong. Please try again";
                }
            } else {
                $data_['bool__'] = 2; // Already Exists
                $s = "Invoice Already Exists.";
            }
        } else {
            $data_['bool__'] = 3; // 
        }
        if($s != 'x'){
            $data_['msg_'] = $s;
        } else {
            $data_['msg_'] = $data['msg_'];
        }
        return $data_;
    }
    function check_previous_individual_invoice($regid_, $class__, $yr_from, $mnth_from, $yr_to, $mnth_to){
        $this->db->order_by('INVID', 'desc');
        $this->db->where('CLSSESSID', $class__);
        $this->db->where('YEAR_TO>=', (int)$yr_from);
        $this->db->where('MONTH_TO>=', (int)$mnth_from);
        $this->db->limit(1);
        $query = $this->db->get('fee_6_invoice');
        //echo $this->db->last_query();
        //echo " - " . $query->num_rows()."<br>";

        $str = 'x';
        if($query->num_rows()!=0){ //checking year_from-month_from for which invoice are already generated

            /* This below code is checking for already generated invoice year and month for those students 
                not generated their invoices for the selected period
            */
            $data['bool_'] = true; // true means invoice for year from-month from selection was already exists

            // Below is to find last invoice for a student 
            $this->db->select('b.INVDETID, a.INVID, a.CLSSESSID, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, b.REGID');
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
            $this->db->where('b.REGID', $regid_);
            $this->db->order_by('cast(a.YEAR_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('cast(a.MONTH_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('b.INVDETID', 'desc');
            $this->db->limit(1);
            $querylast = $this->db->get();
            //$str = $this->db->last_query();

            if($querylast->num_rows()!=0){ // Last invoice exists for selected student information
                $data['bool_'] = true;

                $this->db->select('INVID');
                $this->db->where('CLSSESSID', $class__);
                $this->db->where('YEAR_FROM', $yr_from);
                $this->db->where('MONTH_FROM', $mnth_from);
                $this->db->where('YEAR_TO', $yr_to);
                $this->db->where('MONTH_TO', $mnth_to);
                $query_selected_period = $this->db->get('fee_6_invoice');

                if($query_selected_period->num_rows()!=0){ // if condition true means the invoice of selected period for the selected class is already exits

                    // Below query is to find the student invoice for the same selected period if exists or not?
                    $row = $query_selected_period->row();
                    $invid = $row->INVID;
                    $this->db->where('INVID', $invid);
                    $this->db->where('REGID', $regid_);
                    $q = $this->db->get('fee_6_invoice_detail');
                    // ---------------------------------
                    if($q->num_rows() != 0){
                        $data['bool_'] = true;
                        $str = "Invoice already exists for the selected period.";
                    } else {
                        $data['bool_'] = false;
                        $str = "Generate Invoice.";
                    }
                } else {
                    /* 
                        Invoice will not be generated as the selected period is ofcourse lesser than the latest invoice already generated.
                    */
                    $data['bool_'] = true;
                    $rlast = $querylast->row();
                    $str = "Invoice already generated upto <br><b style=''>".$rlast->YEAR_TO.", ".$this->getMonths($rlast->MONTH_TO)."</b>.";
                }
                
            } else { // No invoice generated yet for the selected student but still need to find the correct period of generating the invoice
                /*
                    Means if already generated invoice period is pending for the student to generate the invoice, then first generate the previous invoice then proceed for the another period.
                */

                $this->db->order_by('INVID');
                $this->db->where('CLSSESSID', $class__);
                $this->db->limit(1);
                $qfirstInvoiceForClass = $this->db->get('fee_6_invoice');

                if($query->num_rows()!=0){
                    $res = $qfirstInvoiceForClass->row();

                    $str = "First generate the Invoice for [<b style='color: #ffff00'>" . $res->YEAR_FROM . ", " . $this->getMonths($res->MONTH_FROM) . " -to- ". $res->YEAR_TO . ", ". $this->getMonths($res->MONTH_TO) . "</b>] of the selected student.";
                } else {
                    $str = "First generate the first Invoice of the selected student.";
                }
                $data['bool_'] = false;
            }
            
        } else {

            // Below is to find last invoice for a student 
            $this->db->select('b.INVDETID, a.INVID, a.CLSSESSID, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, b.REGID');
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
            $this->db->where('b.REGID', $regid_);
            $this->db->order_by('cast(a.YEAR_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('cast(a.MONTH_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('b.INVDETID', 'desc');
            $this->db->limit(1);
            $querylast = $this->db->get();
            //$str = $this->db->last_query();

            if($querylast->num_rows() != 0){
                $data['bool_'] = true;
                $r = $querylast->row();
                    $yr_from_r = (int)$r->YEAR_FROM;
                    $mnth_from_r = (int)$r->MONTH_FROM;
                    $yr_to_r = (int)$r->YEAR_TO;
                    $mnth_to_r = (int)$r->MONTH_TO;

                    if(($yr_from - $yr_to_r) == 0 || ($yr_from - $yr_to_r) == 1){
                        $diff_month = (($yr_from - $yr_to_r) * 12) + ($mnth_from - $mnth_to_r);
                        if($diff_month == 1){ // This condition true means we can generate the invoice for the selected period
                            $data['bool_'] = false;
                            $str = "Invoice can be generated";
                        } else if($diff_month > 1) { // This condition true means user is selecting a period by skipping some months means Error!!
                            $bool_['bool_'] = true;
                            $str = "You cannot skip months";
                        } else if ($diff_month <= 0){ // This condition true means user is selecting a period for which invoice is already being generated
                            $data['bool_'] = true;
                            $str = "Invoice Already exists.";
                        }
                    } else {
                        $data['bool_'] = true;
                        $str = "Invoice Already exists.";
                    }
            } else {
                // Now check the last invoice of a class then check the difference from the selected period [If 1 generate otherwise not]
                $data['bool_'] = false;
                $str = 'Incoice can be generated';
            }
        }
        $data['msg_'] = $str;
        return $data;
    }
    function check_previous_invoice($class__, $yr_from, $mnth_from){
        $this->db->where('CLSSESSID', $class__);
        $this->db->where('YEAR_TO>=', (int)$yr_from);
        $this->db->where('MONTH_TO>=', (int)$mnth_from);
        $query = $this->db->get('fee_6_invoice');
        if($query->num_rows()!=0){
            $data['bool_'] = true;
        } else {
            $data['bool_'] = false;
        }
        return $data;
    }
    
    function check_invoice($class__, $yr_from, $mnth_from, $yr_to, $mnth_to){
        $this->db->where('YEAR_FROM', $yr_from);
        $this->db->where('MONTH_FROM', $mnth_from);
        $this->db->where('YEAR_TO', $yr_to);
        $this->db->where('MONTH_TO', $mnth_to);
        $this->db->where('CLSSESSID', $class__);
        $query = $this->db->get('fee_6_invoice');
        if($query->num_rows()!=0){
            $row = $query->row();
            $data['bool_'] = true;
            $data['invid'] = $row->INVID;
        } else {
            $data['bool_'] = false;
            $data['invid'] = 'x';
        }
        return $data;
    }
    function check_invoice_detail($invid, $regid){
        $this->db->where('INVID', $invid);
        $this->db->where('REGID', $regid);
        $query = $this->db->get('fee_6_invoice_detail');
        if($query->num_rows()!=0){
            $row = $query->row();
            $data['bool_'] = true;
            $data['invdetid'] = $row->INVDETID;
        } else {
            $data['bool_'] = false;
            $data['invdetid'] = 'x';
        }
        return $data;
    }

    function fetch_static_heads_to_class($class__, $regid_){
        $data['static_heads_to_class'] = $this->get_static_heads_to_class($class__);
        $_static_heads__ = '';
        $_static_heads_amount_ = '';
        $_static_total_amount = 0;
        $n_static_heads__ = '';
        $n_static_heads_amount_ = '';
        $n_static_total_amount = 0;
        if(count($data['static_heads_to_class']) != 0){
            foreach ($data['static_heads_to_class'] as $static_item) {
                if($static_item->DURATION == '1'){
                    if($_static_heads__ != ''){
                        $_static_heads__ = $_static_heads__ .",". $static_item->FEE_HEAD;
                        $_static_heads_amount_ = $_static_heads_amount_ .", ". $static_item->AMOUNT;
                        $_static_total_amount = $_static_total_amount + $static_item->AMOUNT;

                    } else {
                        $_static_heads__ = $static_item->FEE_HEAD;
                        $_static_heads_amount_ = $static_item->AMOUNT;
                        $_static_total_amount = $static_item->AMOUNT;
                    }
                } else {
                    if($n_static_heads__ != ''){
                        $n_static_heads__ = $n_static_heads__ .",". $static_item->FEE_HEAD;
                        $n_static_heads_amount_ = $n_static_heads_amount_. ",". $static_item->AMOUNT;
                        $n_static_total_amount = $n_static_total_amount + $static_item->AMOUNT;
                    } else {
                        $n_static_heads__ = $static_item->FEE_HEAD;
                        $n_static_heads_amount_ = $static_item->AMOUNT;
                        $n_static_total_amount = $static_item->AMOUNT;
                    }
                }
             } 
        }
        $data['static_heads'] = $_static_heads__;
        $data['static_heads_amount'] = $_static_heads_amount_;
        $data['static_amount'] = $_static_total_amount;
        $data['n_static_heads'] = $n_static_heads__;
        $data['n_static_heads_amount'] = $n_static_heads_amount_;
        $data['n_static_amount'] = $n_static_total_amount;

        return $data;
    }
    function fetch_flexi_heads_to_students($class__, $regid_){
        $data['flexi_heads_to_students'] = $this->get_flexible_fee_head_for_class($class__, $regid_);
        $_flexi_heads__ = '';
        $_flexi_heads_amount_ = '';
        $_flexi_total_amount = 0;
        $n_flexi_heads__ = '';
        $n_flexi_heads_amount_ = '';
        $n_flexi_total_amount = 0;
        if(count($data['flexi_heads_to_students']) != 0){
            foreach ($data['flexi_heads_to_students'] as $flexi_item) {
                if($flexi_item->DURATION == '1'){
                    if($_flexi_heads__ != ''){
                        $_flexi_heads__ = $_flexi_heads__ .",". $flexi_item->FEE_HEAD;
                        $_flexi_heads_amount_ = $_flexi_heads_amount_ .",".$flexi_item->AMOUNT;
                        $_flexi_total_amount = $_flexi_total_amount + $flexi_item->AMOUNT;
                    } else {
                        $_flexi_heads__ = $flexi_item->FEE_HEAD;
                        $_flexi_heads_amount_ = $flexi_item->AMOUNT;
                        $_flexi_total_amount = $flexi_item->AMOUNT;
                    }
                } else {
                    if($n_flexi_heads__ != ''){
                        $n_flexi_heads__ = $n_flexi_heads__ .",". $flexi_item->FEE_HEAD;
                        $n_flexi_heads_amount_ = $n_flexi_heads_amount_ .",".$flexi_item->AMOUNT;
                        $n_flexi_total_amount = $n_flexi_total_amount + $flexi_item->AMOUNT;
                    } else {
                        $n_flexi_heads__ = $flexi_item->FEE_HEAD;
                        $n_flexi_heads_amount_ = $flexi_item->AMOUNT;
                        $n_flexi_total_amount = $flexi_item->AMOUNT;
                    }
                }
            }
        }

        $data['flexi_heads'] = $_flexi_heads__;
        $data['flexi_heads_amount'] = $_flexi_heads_amount_;
        $data['_flexi_amount'] = $_flexi_total_amount;
        $data['n_flexi_heads'] = $n_flexi_heads__;
        $data['n_flexi_heads_amount'] = $n_flexi_heads_amount_;
        $data['n_flexi_amount'] = $n_flexi_total_amount;
        return $data;
    }

    function fetch_due_amount_in_invoice($regid){
        $this->db->where('REGID', $regid);
        $this->db->select('INVDETID');
        $this->db->from('fee_6_invoice_detail');
        $this->db->order_by('INVID', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()!=0){
            $row = $query->row();
            $invdetid = $row->INVDETID;
            $this->db->select('DUE_AMOUNT');
            $this->db->where('INVDETID', $invdetid);
            $query = $this->db->get('fee_6_invoice_detail');
            //echo $this->db->last_query();
            $r = $query->row();
            $bool_ = $r->DUE_AMOUNT;
        } else {
            $bool_ = 0;
        }
        return $bool_;
    }

    function get_student_receipt($invdetid_, $clssessid){

            $this->db->select('d.REGID, b.FNAME, b.MNAME, b.LNAME, b.GENDER, b.FATHER, b.CATEGORY, a.*, c.CLASSID, d.INVDETID, d.STATIC_HEADS_1_TIME, d.STATIC_SPLIT_AMT_1_TIME, d.STATIC_HEADS_N_TIMES, d.STATIC_SPLIT_AMT_N_TIME, d.FLEXIBLE_HEADS_1_TIME, d.FLEXI_SPLIT_AMT_1_TIME, d.FLEXIBLE_HEADS_N_TIMES, d.FLEXI_SPLIT_AMT_N_TIMES, d.ACTUAL_AMOUNT, d.DESCRIPTION_IFANY, d.ACTUAL_DUE_AMOUNT, d.PREV_DUE_AMOUNT, d.DUE_AMOUNT, d.DATE_');
            $this->db->where('a.CLSSESSID', $clssessid);
            $this->db->where('d.INVDETID', $invdetid_);
            $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail d', 'a.INVID = d.INVID');
            $this->db->join('master_7_stud_personal b', 'd.REGID = b.regid');
            $this->db->join('class_2_in_session c', 'a.CLSSESSID = c.CLSSESSID');
            $query = $this->db->get();
            
        return $query->result();
    }
    function get_specific_sibling_for_fee_discount($regid_){
        $this->db->where('regid', $regid_);
        $query = $this->db->get('register_sibling');
        return $query->row();
    }
    function get_student_discount($item_){
        $this->db->where('ITEM_', $item_);
        $query = $this->db->get('master_16_discount');
        return $query->row();
    }
    // ---------------------------

    function getMonths($no){
        $data = array(
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10=> 'October',
                11=> 'November',
                12=> 'December'
            );

        if($no>12 || $no < 1){
            $month = "Wrong Month number selected.";
        } else {
            $month = $data[$no];
        }
        return $month;
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