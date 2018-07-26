<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_fee_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
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
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $data;
    }
    function get_invoice_for_receipt($class__, $yr_from, $mnth_from, $yr_to, $mnth_to){
        $this->db->group_by('YEAR_TO, MONTH_TO');
        $this->db->where('CLSSESSID', $class__);
        $this->db->where('YEAR_FROM', $yr_from);
        $this->db->where('MONTH_FROM', $mnth_from);
        $this->db->where('YEAR_TO', $yr_to);
        $this->db->where('MONTH_TO', $mnth_to);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $this->db->order_by('INVID', 'desc');
        //$this->db->order_by("DATE_FORMAT(CONCAT(YEAR_TO,'-',MONTH_TO,'-',1), '%Y-%m-%d')", 'desc');
        //$this->db->order_by('cast(YEAR_TO AS SIGNED INTEGER)', 'desc');
        //$this->db->order_by('cast(MONTH_TO AS SIGNED INTEGER)', 'desc');
        //$this->db->limit(1);
        $query = $this->db->get('fee_6_invoice');
        //echo $this->db->last_query();
        
        if($query->num_rows()!=0){
            $R = $query->row();
            $this->db->select('b.FNAME, b.MNAME, b.LNAME, b.GENDER, a.*, c.INVDETID, c.STATIC_HEADS_1_TIME, c.STATIC_SPLIT_AMT_1_TIME, c.STATIC_HEADS_N_TIMES, c.STATIC_SPLIT_AMT_N_TIME, c.FLEXIBLE_HEADS_1_TIME, c.FLEXI_SPLIT_AMT_1_TIME, c.FLEXIBLE_HEADS_N_TIMES, c.FLEXI_SPLIT_AMT_N_TIMES, c.ACTUAL_AMOUNT, c.REGID, c.ACTUAL_DUE_AMOUNT, c.PREV_DUE_AMOUNT, c.DUE_AMOUNT, c.STATUS');
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

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $data;
    }

    function get_static_heads_to_class($class__){
        $this->db->select('d.CLASSID, c.FEE_HEAD, a.TOTFEE, b.AMOUNT, b.PAYMENT_STATUS, c.DURATION, c.DISCOUNT_APPLICABLE');
        $this->db->from('fee_8_class_fee a');
        $this->db->join('fee_9_class_fee_split b', 'a.CFEEID=b.CFEEID');
        $this->db->join('fee_3_static_heads c', 'c.ST_HD_ID = b.ST_HD_ID');
        $this->db->join('class_2_in_session d', 'd.CLSSESSID = a.CLSSESSID');
        $this->db->where('a.CLSSESSID', $class__);
        $query = $this->db->get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
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

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
    
    function get_students_in_class($clssessid){
        $this->db->order_by('a.FNAME', 'asc');
        //$this->db->order_by('a.regid', 'asc');
        $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this->db->where('b.clssessid', $clssessid);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
    
    //------------------------------------Fetch class in selected session/ Year --------------------------------------
    function get_class_in_session($year__){
        $year__ = $this->session->userdata('_current_year___');
        $this -> db -> where ('b.SESSID', $year__);
        $this -> db -> order_by('ABS(a.CLASS)', 'asc');
        $this -> db -> order_by('a.SECTION', 'asc');
        $this -> db -> from('class_1_classes a');
        $this -> db -> join('class_2_in_session b', 'a.CLASSID=b.CLASSID');
        $query = $this -> db -> get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query -> result();
    }
    function get_class_fee_in_session($year__){

        $this->db->select('a.CLSSESSID, a.CLASSID, b.CFEEID, b.TOTFEE');
        $this->db->from('fee_8_class_fee b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $query = $this -> db -> get();

        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        
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

        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        
        return $query->result();
    }
    // -----------------------------------------------------------------------------------------------------------------

    // Fetch Previous Invoice data
    function get_invoice_data($class__, $yr_from, $mnth_from, $yr_to, $mnth_to){
        $this->db->select('a.INVID, b.REGID, b.INVDETID');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
        $this->db->where('a.CLSSESSID', $class__);
        $this->db->where('a.YEAR_FROM', $yr_from);
        $this->db->where('a.MONTH_FROM', $mnth_from);
        $this->db->where('a.YEAR_TO', $yr_to);
        $this->db->where('a.MONTH_TO', $mnth_to);
        $query = $this->db->get();
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function generateInvoice($class__, $yr_from, $mnth_from, $yr_to, $mnth_to, $regid_, $no_of_months){
        $s = 'x';
        $data = $this->check_previous_individual_invoice($regid_, $class__, $yr_from, $mnth_from, $yr_to, $mnth_to);
        $prevInvoiceID = $data['last_invoice_detail_id']['ID'];
        $prevInvoice_result = $data['last_invoice_detail_id']['res_'];
        $data['prev_id'] = $prevInvoiceID;

        if($data['bool_'] == 6 || $data['bool_'] == 8 || $data['bool_'] == 12 || $data['bool_'] == 13){
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
        } else if($data['bool_'] == 4){
            $invoiceid = $data['invid_'];
        }

        if($data['bool_'] == 4 || $data['bool_'] == 6 || $data['bool_'] == 8 || $data['bool_'] == 12 || $data['bool_'] == 13){
            $data_static = $this->fetch_static_heads_to_class($class__, $regid_,$no_of_months);
            $data_flexi = $this->fetch_flexi_heads_to_students($class__, $regid_,$no_of_months);
            $total_applicable_discount_amount = $data_static['static_discount_applicable_amount'];
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
                'APPLICABLE_DISCOUNT_AMOUNT' => $total_applicable_discount_amount,
                'DESCRIPTION_IFANY' => 'X',
                'REGID'=>$regid_,
                'ACTUAL_DUE_AMOUNT'=>$total_actual_amount,
                'PREV_DUE_AMOUNT'=>$due_amount,
                'DUE_AMOUNT'=>$total_amount_due,
                'DATE_'=> date('Y-m-d H:i:s')
            );
            $query = $this->db->insert('fee_6_invoice_detail', $data1);
            if($query == true){
                $data['bool__'] = 1; // Invoice Successfully generated

                $data['invdetid'] = $this->db->insert_id();
                // Updation: Disable the previous invoice
                    if($prevInvoice_result == true){
                        
                        $this->db->where('INVDETID', $prevInvoiceID);
                        if($this->db->update('fee_6_invoice_detail', array('STATUS' => 0)) == true){
                            $s = "Invoice Successfully generated++"; // invoice generated with disabling the previous invoice
                        } else {
                            /* 
                                E-Mail the new invoice ID to nitin.d12@gmail.com notifyng that 
                                previous-invoiceID against new-invoiceId is not disabled for 
                                smoother invoice monitoring. Also E-mail the school name 
                                via session variable: $this->session->userdata('school_name');
                            */
                            $s = "Invoice Successfully generated"; // invoice generated without disabling the previous invoice
                        }
                    } else {
                        $s = "Invoice Successfully generated"; // Invoice generated first time so no need to disable any invoice
                    }
                // --------------------------------------
            } else {
                $data['bool__'] = 0; // Something goes wrong. Please try again
                $data['invdetid'] = 'x';
                $s = "Something goes wrong. Please try again";
            }
        } else {
            $data['bool__'] = 2; // Invoice already exists
            $data['invdetid'] = 'x';
        }

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $data;
    }
    function check_previous_individual_invoice($regid_, $class__, $yr_from, $mnth_from, $yr_to, $mnth_to){
        $this->db->order_by('INVID', 'desc');
        $this->db->where('CLSSESSID', $class__);
        $this->db->where("DATE_FORMAT(CONCAT(YEAR_TO,'-',MONTH_TO,'-',1), '%Y-%m-%d') >=", date('Y-m-d', strtotime($yr_from."-".$mnth_from."-1")));
        $this->db->limit(1);
        $query = $this->db->get('fee_6_invoice');
        
        $str = 'x';
        if($query->num_rows()!=0){ //checking year_from-month_from for which invoice already generated for a class

            /* This below code is checking for already generated invoice year and month for the student
                not generated his/her invoice for the selected period
            */
            /*(1) */ $data['bool_'] = 1; // true means invoice for year from-month from selection was already exists

            // Below is to find last invoice for a student 
            $this->db->select('b.INVDETID, a.INVID, a.CLSSESSID, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, b.REGID');
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
            $this->db->where('b.REGID', $regid_);
            $this->db->where('a.CLSSESSID', $class__);
            $this->db->order_by('cast(a.YEAR_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('cast(a.MONTH_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('b.INVDETID', 'desc');
            $this->db->limit(1);
            $querylast = $this->db->get();
            
            if($querylast->num_rows()!=0){ // Last invoice exists for selected student information
            /*(2) */$data['bool_'] = 2;

                $this->db->select('INVID, YEAR_TO, MONTH_TO');
                $this->db->where('CLSSESSID', $class__);
                $this->db->where("DATE_FORMAT(CONCAT(YEAR_FROM,'-',MONTH_FROM,'-',1), '%Y-%m-%d')=", date('Y-m-d', strtotime($yr_from."-".$mnth_from."-1")));
                $this->db->where("DATE_FORMAT(CONCAT(YEAR_TO,'-',MONTH_TO,'-',1), '%Y-%m-%d')=", date('Y-m-d', strtotime($yr_to."-".$mnth_to."-1")));
                $query_selected_period = $this->db->get('fee_6_invoice');

                
                /* 
                    First calculate the difference in months between last invoice of student with the selected period, 
                    if difference is 1 then check the last invoice of student is not equals to the selected period then
                    generate the invoice.
                */
                $rs = $querylast->row();
                // This array variable is used to disable the previous invoice if new invoice generated for the selected student
                    $data['last_invoice_detail_id'] = array('res_' => true, 'ID'=>$rs->INVDETID); 
                // -------------------------------------------------------------------------------------------------------------
                $date1 = mktime(0,0,0,$rs->MONTH_TO,0,$rs->YEAR_TO);
                $date2 = mktime(0,0,0,$mnth_from,0,$yr_from);
                $diff_ = round((($date2-$date1)/60/60/24/30),0,PHP_ROUND_HALF_UP);
                // -------------------------------------------------------------------------------------------------------
                
                if($query_selected_period->num_rows()!=0){ // if condition true means the invoice of selected period for the selected class is already exits
                    if($diff_ == 1){
                        $row_ = $query_selected_period->row();
                        $invid = $row_->INVID;
                        $this->db->where('INVID', $invid);
                        $this->db->where('REGID', $regid_);
                        $q = $this->db->get('fee_6_invoice_detail');
                        // ---------------------------------
                        if($q->num_rows() != 0){
                        /*(3) */$data['bool_'] = 3;
                            $str = "Code-3: Invoice already exists for the selected period.";
                            $final_invid_ = 'x';
                        } else {
                        /*(4) */$data['bool_'] = 4;
                        $final_invid_ = $invid;
                        $str = "Code-4: Invoice generated successfully.";
                        }
                    } else {
                        /*(14) */$data['bool_'] = 14;
                            $final_invid_ = 'x';
                        $str = "Code-14: Invoice upto [<b style='color: #ffff00'>" . $rs->YEAR_FROM . ", " . $this->getMonths($rs->MONTH_FROM) . " -to- ". $rs->YEAR_TO . ", ". $this->getMonths($rs->MONTH_TO) . "</b>] for the selected student is already generated. And you cannot skip months";
                    }
                } else {
                    if($diff_ == 1){
                        /*(13) */$data['bool_'] = 13;
                                $final_invid_ = 'x';
                        $str = 'Code-13: Invoice generated successfully.';
                    } else {
                        /*(5) */$data['bool_'] = 5;
                        $final_invid_ = 'x';
                        $str = "Code-5: Invoice upto [<b style='color: #ffff00'>" . $rs->YEAR_FROM . ", " . $this->getMonths($rs->MONTH_FROM) . " -to- ". $rs->YEAR_TO . ", ". $this->getMonths($rs->MONTH_TO) . "</b>] for the selected student is already generated..";
                    }
                }
                
            } else { // No invoice generated yet for the selected student 
                /*
                    Means generate invoice for the selected period
                */
            /*(6) */$data['bool_'] = 6;
                    $final_invid_ = 'x';
                    // This array variable is used to disable the previous invoice but here no need as no previous invoice found
                        $data['last_invoice_detail_id'] = array('res_' => false, 'ID'=>'x'); 
                    // -------------------------------------------------------------------------------------------------------------
                    $str = "Code-6: Invoice generated successfully.";
            }
            
        } else {

            // Below is to find last invoice for a student 
            $this->db->select('b.INVDETID, a.INVID, a.CLSSESSID, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, b.REGID');
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
            $this->db->where('b.REGID', $regid_);
            $this->db->where('a.CLSSESSID', $class__); // CLSSESSID in where condition means we are selecting a class as well as session
            $this->db->order_by('cast(a.YEAR_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('cast(a.MONTH_TO AS SIGNED INTEGER)', 'desc');
            $this->db->order_by('b.INVDETID', 'desc');
            $this->db->limit(1);
            $querylast = $this->db->get();
            //$str = $this->db->last_query();

            if($querylast->num_rows() != 0){
            /*(7) */$data['bool_'] = 7;
                $r = $querylast->row();
                // This array variable is used to disable the previous invoice if new invoice generated for the selected student
                    $data['last_invoice_detail_id'] = array('res_' => true, 'ID'=>$r->INVDETID); 
                // -------------------------------------------------------------------------------------------------------------
                    $yr_from_r = (int)$r->YEAR_FROM;
                    $mnth_from_r = (int)$r->MONTH_FROM;
                    $yr_to_r = (int)$r->YEAR_TO;
                    $mnth_to_r = (int)$r->MONTH_TO;

                    if(($yr_from - $yr_to_r) == 0 || ($yr_from - $yr_to_r) == 1){
                        $diff_month = (($yr_from - $yr_to_r) * 12) + ($mnth_from - $mnth_to_r);
                        if($diff_month == 1){ // This condition true means we can generate the invoice for the selected period
                        /*(8) */$data['bool_'] = 8;
                                $final_invid_ = 'x';
                            $str = "Code-8: Invoice generated successfully.";
                        } else if($diff_month > 1) { // This condition true means user is selecting a period by skipping some months means Error!!
                        /*(9) */$bool_['bool_'] = 9;
                                $final_invid_ = 'x';
                            $str = "Code-9: You cannot skip months";
                        } else if ($diff_month <= 0){ // This condition true means user is selecting a period for which invoice is already being generated
                        /*(10)*/$data['bool_'] = 10;
                                $final_invid_ = 'x';
                            $str = "Code-10: Invoice Already exists.";
                        }
                    } else {
                    /*(11) */$data['bool_'] = 11;
                            $final_invid_ = 'x';
                        $str = "Code-11: Invoice Already exists.";
                    }
            } else {
                // No last invoice found for the selected student then generate the invoice for the selected period
                /* (12) */$data['bool_'] = 12;
                        $final_invid_ = 'x';
                        // This array variable is used to disable the previous invoice but here no need as no previous invoice found
                            $data['last_invoice_detail_id'] = array('res_' => false, 'ID'=>'x'); 
                        // -------------------------------------------------------------------------------------------------------------
                $str = 'Code-12: Invoice generated successfully.';
            }
        }
        $data['msg_'] = $str;
        $data['invid_'] = $final_invid_;
  
        return $data;
    }

    function check_last_invoice_for_a_student($regid_, $clssessid){
        $this->db->select('b.INVDETID, a.INVID, a.CLSSESSID, b.REGID');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID = b.INVID');
        $this->db->where('b.REGID', $regid_);
        $this->db->where('a.CLSSESSID', $clssessid);
        $this->db->order_by('cast(a.YEAR_TO AS SIGNED INTEGER)', 'desc');
        $this->db->order_by('cast(a.MONTH_TO AS SIGNED INTEGER)', 'desc');
        $this->db->order_by('b.INVDETID', 'desc');
        $this->db->limit(1);
        $querylast = $this->db->get();
        if($querylast->num_rows()!=0){
            $r = $querylast->row();
            $bool_ = array('res_'=>true, 'prev_id'=>$r->INVDETID);
        } else {
            $bool_ = array('res_'=>false, 'prev_id'=>'x');
        }
        return $bool_;
    }
    function check_previous_invoice($class__, $yr_from, $mnth_from){
        $this->db->where('CLSSESSID', $class__);
        $this->db->where("DATE_FORMAT(CONCAT(YEAR_TO,'-',MONTH_TO,'-',1), '%Y-%m-%d') >=", date('Y-m-d', strtotime($yr_from."-".$mnth_from."-1")));
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
    function fetch_invoice_data_for_receipt($invdetid_){
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->where('b.INVDETID', $invdetid_);
        $query = $this->db->get();

        return $query->row();
    }
    function fetch_static_heads_to_class($class__, $regid_){
        $data['static_heads_to_class'] = $this->get_static_heads_to_class($class__);
        $_static_heads__ = '';
        $_static_heads_amount_ = '';
        $_static_discount_applicable_amount_1_time = 0;
        $_static_total_amount = 0;
        $n_static_heads__ = '';
        $n_static_heads_amount_ = '';
        $_static_discount_applicable_amount_n_time = 0;
        $n_static_total_amount = 0;
        if(count($data['static_heads_to_class']) != 0){
            foreach ($data['static_heads_to_class'] as $static_item) {
                if($static_item->DURATION == '1'){
                    if($_static_heads__ != ''){
                        $_static_heads__ = $_static_heads__ .",". $static_item->FEE_HEAD."@".$static_item->DISCOUNT_APPLICABLE;
                        $_static_heads_amount_ = $_static_heads_amount_ .", ". $static_item->AMOUNT;
                        $_static_total_amount = $_static_total_amount + $static_item->AMOUNT;
                        if($static_item->DISCOUNT_APPLICABLE == 1){
                            $_static_discount_applicable_amount_1_time = $_static_discount_applicable_amount_1_time + $static_item->AMOUNT;
                        }
                    } else {
                        $_static_heads__ = $static_item->FEE_HEAD."@".$static_item->DISCOUNT_APPLICABLE;
                        $_static_heads_amount_ = $static_item->AMOUNT;
                        $_static_total_amount = $static_item->AMOUNT;
                        if($static_item->DISCOUNT_APPLICABLE == 1){
                            $_static_discount_applicable_amount_1_time = $_static_discount_applicable_amount_1_time + $static_item->AMOUNT;
                        }
                    }
                } else {
                    if($n_static_heads__ != ''){
                        $n_static_heads__ = $n_static_heads__ .",". $static_item->FEE_HEAD."@".$static_item->DISCOUNT_APPLICABLE;
                        $n_static_heads_amount_ = $n_static_heads_amount_. ",". $static_item->AMOUNT;
                        $n_static_total_amount = $n_static_total_amount + $static_item->AMOUNT;
                        if($static_item->DISCOUNT_APPLICABLE == 1){
                            $_static_discount_applicable_amount_n_time = $_static_discount_applicable_amount_n_time + $static_item->AMOUNT;
                        }
                    } else {
                        $n_static_heads__ = $static_item->FEE_HEAD."@".$static_item->DISCOUNT_APPLICABLE;
                        $n_static_heads_amount_ = $static_item->AMOUNT;
                        $n_static_total_amount = $static_item->AMOUNT;
                        if($static_item->DISCOUNT_APPLICABLE == 1){
                            $_static_discount_applicable_amount_n_time = $_static_discount_applicable_amount_n_time + $static_item->AMOUNT;
                        }
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
        $data['static_discount_applicable_amount'] = $_static_discount_applicable_amount_1_time + $_static_discount_applicable_amount_n_time;

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
    function undo_invoice($invdetid_, $regid_, $clssessid){
        $this->db->select('regid');
        $this->db->where('INVDETID', $invdetid_);
        $this->db->limit(1);
        $query = $this->db->get('fee_7_receipts');
        if($query->num_rows()!=0){
            $r = $query->row();
            /*(1)*/$data['bool_'] = 1;
            $data['msg_'] = "Code-1: Connot undo this invoice of Stud ID -".$r->regid." as he/ she already paid some fee against the same.";
        } else{
            $this->db->where('INVDETID', $invdetid_);
            $this->db->where('STATUS', 1);
            $query = $this->db->get('fee_6_invoice_detail');
            if($query->num_rows()!=0){
                $r1 = $query->row();
                $invid = $r1->INVID;
                $this->db->where('INVDETID', $invdetid_);
                $res = $this->db->delete('fee_6_invoice_detail');
                if($res == true){
                    $this->db->where('INVID', $invid);
                    $query = $this->db->get('fee_6_invoice_detail');
                    if($query->num_rows()==0){
                        $this->db->where('INVID', $invid);
                        $this->db->delete('fee_6_invoice');
                    }
                    // trying to Enabled the last invoice id for a student
                        $result_prev_invoice = $this->check_last_invoice_for_a_student($regid_, $clssessid);
                        if($result_prev_invoice['res_'] == true){
                            $invdetid = $result_prev_invoice['prev_id'];
                            $this->db->where('INVDETID', $invdetid);
                            $query = $this->db->update('fee_6_invoice_detail', array('STATUS'=> 1));
                        }
                    // ---------------------------------------------------
                    /*(2)*/$data['bool_'] = 2;
                    $data['msg_'] = "Code-2: Invoice Deleted Successfully.";
                } else {
                    /*(3)*/$data['bool_'] = 3;
                    $data['msg_'] = "Code-3: Something goes wrong. Please try again.";
                }
            } else {
                /*(4)*/$data['bool_'] = 4;
                $data['msg_'] = "Code-4: Only Latest Invoice for the student can undo.";
            }
        }
        return $data;
    }
    function get_invoice($clssessid, $invdetid_ = ''){
        $this->db->select('*');
        if($invdetid_!=''){
            $this->db->where('b.INVDETID', $invdetid_);
        }
        $this->db->where('CLSSESSID', $clssessid);
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->order_by('cast(a.YEAR_TO AS SIGNED INTEGER)', 'desc');
        $this->db->order_by('cast(a.MONTH_TO AS SIGNED INTEGER)', 'desc');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()!=0){
            $R = $query->row();

            $this->db->select('b.FNAME, b.MNAME, b.LNAME, b.GENDER, a.SESSID, a.CLSSESSID, a.YEAR_FROM, a.YEAR_TO, a.MONTH_FROM, a.MONTH_TO, a.NOM, aa.*, c.CLASSID');
            if($invdetid_!=''){
                $this->db->where('aa.INVDETID', $invdetid_);
            }
            $this->db->where('a.CLSSESSID', $clssessid);
            $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
            $this->db->where('a.YEAR_FROM',$R->YEAR_FROM);
            $this->db->where('a.MONTH_FROM',$R->MONTH_FROM); 
            $this->db->where('a.YEAR_TO',$R->YEAR_TO);
            $this->db->where('a.MONTH_TO',$R->MONTH_TO);
            $this->db->from('fee_6_invoice a');
            $this->db->join('fee_6_invoice_detail aa', 'a.INVID=aa.INVID');
            $this->db->join('master_7_stud_personal b', 'aa.regid=b.regid');
            $this->db->join('class_2_in_session c', 'a.CLSSESSID = c.CLSSESSID');
            $this->db->order_by('cast(aa.regid AS SIGNED INT)', 'ASC');
            $query = $this->db->get();
            //echo $this->db->last_query() . "<br />";
            $data['invoice'] = $query->result();
            $data['status'] = true;
        } else {
            //echo $this->db->last_query() . "<br />";
            $data['invoice'] = array();
            $data['status'] = false;
        }
        return $data;
    }
    function get_student_receipt($invdetid_, $clssessid){

            $this->db->select('d.REGID, b.FNAME, b.MNAME, b.LNAME, b.GENDER, b.FATHER, b.CATEGORY, a.*, c.CLASSID, d.INVDETID, d.STATIC_HEADS_1_TIME, d.STATIC_SPLIT_AMT_1_TIME, d.STATIC_HEADS_N_TIMES, d.STATIC_SPLIT_AMT_N_TIME, d.FLEXIBLE_HEADS_1_TIME, d.FLEXI_SPLIT_AMT_1_TIME, d.FLEXIBLE_HEADS_N_TIMES, d.FLEXI_SPLIT_AMT_N_TIMES, d.ACTUAL_AMOUNT, d.APPLICABLE_DISCOUNT_AMOUNT, d.DESCRIPTION_IFANY, d.ACTUAL_DUE_AMOUNT, d.PREV_DUE_AMOUNT, d.DUE_AMOUNT, d.DATE_');
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
    function check_eligibility_for_sibling_discount($regid_){
        $bool_ = array('res_'=>false, 'msg_'=>"Not Eligible for sibling discount");
        
        $this->db->select('SIBLINGS');
        $this->db->where('regid', $regid_);
        $query = $this->db->get('register_sibling');
        if($query->num_rows() != 0){
            $row = $query->row();
            $regids = count(explode(",",$row->SIBLINGS))+1; // here +1 means: the student himself/ herself (is also included in sibling's count) 

            $this->db->select('ELIGIBLE_COUNT');
            $this->db->where('CATEGORY', 'SIBLINGS');
            $qry_eligible = $this->db->get('master_16_discount');
            if($qry_eligible->num_rows()!=0){
                $row = $qry_eligible->row();
                $eligilble_count = $row->ELIGIBLE_COUNT;

                if($regids >= $eligilble_count){
                    $bool_ = array('res_'=>true, 'msg_'=>"Eligible for sibling discount");            
                }
            }

        }
        return $bool_;
    }
    function get_specific_sibling_for_fee_discount($regid_){
        $this->db->where('regid', $regid_);
        $query = $this->db->get('register_sibling');
        return $query->row();
    }
    function get_specific_other_discount_for_fee_discount($regid_){
        $this->db->where('regid', $regid_);
        $query = $this->db->get('register_discount');
        return $query->row();   
    }
    function get_student_discount($item_){
        $this->db->where('ITEM_', $item_);
        $query = $this->db->get('master_16_discount');
        return $query->row();
    }
    function get_other_discount($OTHER_){
        $this->db->where('CATEGORY', $OTHER_);
        $query = $this->db->get('master_16_discount');
        return $query->result();
    }
    function chkDiscountStatus($invdetid_){
        $this->db->where('INVDETID', $invdetid_);
        $this->db->where('DISCOUNT', 1);
        $this->db->where('DISCOUNT_CATEGORY <>', '0');
        $query = $this->db->get('fee_7_receipts');
        if($query->num_rows()!=0){
            $bool_ = true;
        } else {
            $bool_ = false;
        }
        return $bool_;
    }
    function submitfee(){
        $invdetid = $this->input->post('txtINVDETID');
        $regid = $this->input->post('txtREGID');
        $flexiheads = trim($this->input->post('txtFlexiHeads'));
        $discount_category = trim($this->input->post('txtDiscountCategory'));
        $desc_ = $this->input->post('txtDesc');

        $fine = $this->input->post('_fine_');
        $due_amnt_input = $this->input->post('due_amnt_input');
        $discount_amount = trim($this->input->post('_discount_'));
        $mode = $this->input->post('cmbPaymentMode');
        if($mode != 'cash'){
            $ddcq_no = $this->input->post('txtCCDDNumber');
            $ddcq_date = $this->input->post('txtCCDDDate');
        } else {
            $ddcq_no = 'x';
            $ddcq_date = 'x';
        }
            
        // Calculation to reduce due amount from invoice against the receipt payment
        $this->db->select('DUE_AMOUNT');
        $this->db->where('INVDETID', $invdetid);
        $query = $this->db->get('fee_6_invoice_detail');
        if($query->num_rows()!=0){
            $r = $query->row();
            $due_amount = $r->DUE_AMOUNT;
        } else {
            $this->db->set_flashdata('blunder_error', 'OH NO!! Invoice Record is deleted. You should have to maintain the fee detail for '.$this->session->userdata('_current_year___')." against the registration id - ". $regid);
            $due_amount = 0;
        }
        $new_due_amount = $due_amount - $due_amnt_input;
        // -------------------------------------------------------------------------
        if($due_amount > 0){

            if($flexiheads != ''){
                $flexistatus = true;
            } else {
                $flexistatus = false;
            }
            if($discount_amount != 0 && $discount_amount != ''){
                $discount = true;
            } else {
                $discount = false;
            }

            $data = array(
                'FLEXI_FEE_STATUS' =>$flexistatus,
                'ADFLXFEESTUDID' =>$flexiheads,
                'DISCOUNT' =>$discount,
                'DISCOUNT_CATEGORY' => $discount_category,
                'DISCOUNT_AMOUNT'=>$discount_amount,
                'DESCRIPTION_IFANY'=>$desc_,
                'ACTUAL_PAID_AMT'=>$due_amnt_input,
                'FINE'=>$fine,
                'MODE'=>$mode,
                'DD_CQ_NO' =>$ddcq_no,
                'DD_CQ_DATE'=>$ddcq_date,
                'regid'=>$regid,
                'INVDETID'=>$invdetid,
                'DATE_'=> date('Y-m-d H:i:s')
                );
            $this->db->insert('fee_7_receipts', $data);
            $id_ = $this->db->insert_id();
            // Update the due amount ----------------------
                $data = array(
                    'DUE_AMOUNT' => $new_due_amount
                    );
                $this->db->where('INVDETID', $invdetid);
                $this->db->update('fee_6_invoice_detail', $data);
            // --------------------------------------------
        } else {
            $id_ = 'x';
        }
        return $id_;
    }

    function get_receipt($receipt_id){
        $this->db->distinct();
        $this->db->select('e.FNAME, e.MNAME, e.LNAME, e.FATHER, b.YEAR_FROM, b.MONTH_FROM, b.YEAR_TO, b.MONTH_TO, b.NOM, a.DUE_AMOUNT, a.STATIC_HEADS_1_TIME,a.STATIC_SPLIT_AMT_1_TIME, a.STATIC_HEADS_N_TIMES, a.STATIC_SPLIT_AMT_N_TIME, a.FLEXIBLE_HEADS_1_TIME, a.FLEXI_SPLIT_AMT_1_TIME, a.FLEXIBLE_HEADS_N_TIMES, a.FLEXI_SPLIT_AMT_N_TIMES, c.MODE, c.DD_CQ_NO, c.DD_CQ_DATE, c.*, d.CLASSID, d.SESSID');
        $this->db->from('fee_6_invoice b');
        $this->db->join('fee_6_invoice_detail a', 'b.INVID=a.INVID');
        $this->db->join('fee_7_receipts c', 'a.INVDETID = c.INVDETID');
        $this->db->join('class_2_in_session d', 'd.CLSSESSID=b.CLSSESSID');
        $this->db->join('master_7_stud_personal e', 'a.REGID=e.regid');
        $this->db->where('c.RECPTID', $receipt_id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $data = $query->row();
        return $data;
    }

    function get_latest_receipt($invdetid){
        $this->db->where('INVDETID', $invdetid);
        $this->db->order_by('RECPTID', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('fee_7_receipts');

        if($query->num_rows()!=0){
            $r = $query->row();
            $id_ = $r->RECPTID;
        } else {
            $id_ = 'x';
        }
        return $id_;
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
}