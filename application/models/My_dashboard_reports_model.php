<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_dashboard_reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function all_figures_for_dashboard($year__){
        $data['count_reg_students'] = $this->total_reg_students($year__);
        $data['count_classes_in_session'] = $this->total_classes_in_a_session($year__);
        $data['count_students_in_a_session'] = $this->total_students_in_a_session($year__);
        $data['count_invoices_in_session'] = $this->total_invoices_in_a_session($year__);
        $data['count_fee_receipts'] = $this->total_fee_paid($year__);
        $data['total_fee_collected'] = $this->total_fee_collected($year__);
        $data['total_receipt_count'] = $this->total_receipt_count($year__);
        $data['todays_collection']= $this->todays_collection();
        $data['todays_receipt_count'] = $this->todays_receipt_count();
        $data['total_dues_in_a_session'] = $this->total_dues_in_a_session();
        $data['total_student_having_dues'] = $this->total_student_having_dues_in_a_session();
        return $data;
    }

    function total_reg_students($year_){
        $this->db->where('STATUS_', 1);
        $this->db->where('SESSID', $year_);
        $this->db->select('count(regid) as count_students');
        $query = $this->db->get('master_8_stud_academics');

        $result = $query->row();
        return $result->count_students;
    }

    function total_classes_in_a_session($year_){
        $this->db->where('SESSID', $year_);
        $this->db->select('count(CLASSID) as count_classes_in_session');
        $query = $this->db->get('class_2_in_session');

        $result = $query->row();
        return $result->count_classes_in_session;   
    }

    function getstudents_in_class($session, $classessid=''){
        $this->db->where('b.STATUS_', 1);
        $this->db->where('c.CLSSESSID',$classessid);
        $this->db->where('c.SESSID', $session);
        
        $this->db->order_by('a.FNAME');
        $this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid, a.GENDER, b.CLASS_OF_ADMISSION, b.DOA, a.CATEGORY, d.CLASSID');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        $this->db->join('class_2_in_session d', 'c.CLSSESSID=d.CLSSESSID');
        
        $query = $this->db->get();

        return $query->result();
    }

    function total_students_in_a_session($year_){
        $this->db->where('b.STATUS_', 1);
        $this->db->where('a.SESSID', $year_);
        $this->db->select('count(a.regid) as count_students');
        $this->db->from('class_3_class_wise_students a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $query = $this->db->get();

        $result = $query->row();
        return $result->count_students;
    }

    function total_invoices_in_a_session($year_='x'){
        $this->db->where('d.STATUS_', 1);
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        $this->db->select('count(a.INVID) as total_invoices');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('master_7_stud_personal c', 'c.regid=b.REGID');
        $this->db->join('master_8_stud_academics d', 'd.regid=c.regid');
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_invoices;
    }

    function get_invoices_in_a_session($year_='x', $clssessid='x'){
        $this->db->where('d.STATUS_', 1); // This means student not left the school yet 
        //$this->db->where('b.STATUS', 1); // This means only latest invoice should be fetched not previous one for any student
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        if($clssessid != 'x'){
            $this->db->where('a.CLSSESSID', $clssessid);   
        }
        $this->db->select('x.CLASSID, x.CLSSESSID, c.FNAME, c.MNAME, c.LNAME, c.regid, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, a.NOM, b.INVDETID, b.ACTUAL_DUE_AMOUNT, b.PREV_DUE_AMOUNT, b.DUE_AMOUNT, b.STATUS');
        $this->db->from('class_1_classes y');
        $this->db->join('class_2_in_session x', 'y.CLASSID=x.CLASSID');
        $this->db->join('fee_6_invoice a', 'x.CLSSESSID=a.CLSSESSID');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('master_7_stud_personal c', 'c.regid=b.REGID');
        $this->db->join('master_8_stud_academics d', 'd.regid=c.regid');
        $this->db->order_by('y.CLASS');
        $this->db->order_by('c.regid');
        $this->db->order_by('b.INVDETID');
        $query = $this->db->get();
        return $query->result();
    }
    function get_receipts_in_a_session($year_='x', $clssessid='x'){
        $this->db->where('d.STATUS_', 1); // This means student not left the school yet 
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        if($clssessid != 'x'){
            $this->db->where('a.CLSSESSID', $clssessid);   
        }
        $this->db->select('x.CLASSID, x.CLSSESSID, c.FNAME, c.MNAME, c.LNAME, c.regid, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, a.NOM, b.INVDETID, b.ACTUAL_DUE_AMOUNT, b.PREV_DUE_AMOUNT, b.DUE_AMOUNT, b.STATUS, z.RECPTID, z.FLEXI_FEE_STATUS, z.ADFLXFEESTUDID, z.DISCOUNT_AMOUNT, z.ACTUAL_PAID_AMT, z.PAID, z.FINE');
        $this->db->from('class_1_classes y');
        $this->db->join('class_2_in_session x', 'y.CLASSID=x.CLASSID');
        $this->db->join('fee_6_invoice a', 'x.CLSSESSID=a.CLSSESSID');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('master_7_stud_personal c', 'c.regid=b.REGID');
        $this->db->join('master_8_stud_academics d', 'd.regid=c.regid');
        $this->db->join('fee_7_receipts z', 'b.INVDETID=z.INVDETID');
        $this->db->order_by('y.CLASS');
        $this->db->order_by('z.RECPTID');
        $this->db->order_by('c.regid');
        $query = $this->db->get();
        return $query->result();
    }
    function total_fee_paid($year_){
        $this->db->where('e.STATUS_', 1);
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        $this->db->select('count(c.RECPTID) as total_Receipts');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this->db->join('master_7_stud_personal d', 'c.regid=d.REGID');
        $this->db->join('master_8_stud_academics e', 'e.regid=d.regid');
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_Receipts;

    }

    function total_fee_collected($year_){
        $this->db->where('e.STATUS_', 1);
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        $this->db->select('sum(c.PAID) as total_fee_collected');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this->db->join('master_7_stud_personal d', 'c.regid=d.REGID');
        $this->db->join('master_8_stud_academics e', 'e.regid=d.regid');
        $query = $this->db->get();
        if($query->num_rows()!=0){
            $result = $query->row();
            if($result->total_fee_collected != NULL){
                $value = $result->total_fee_collected;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }

    function total_receipt_count($year_){
        $this->db->where('d.STATUS_', 1);
        if($year_ != 'x'){
            $this->db->where('a.SESSID', $year_);
        }
        $this->db->select('COUNT(c.RECPTID) as TOTAL_RECEIPT_COUNT');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this->db->join('master_8_stud_academics d', 'c.regid=d.regid');

        $query = $this->db->get();
        if($query->num_rows()!=0){
            $r = $query->row();
            if($r->TOTAL_RECEIPT_COUNT != NULL){
                $value = $r->TOTAL_RECEIPT_COUNT;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }
    function get_total_collection(){
        $this->db->where('z.STATUS_', 1);
        $this -> db -> order_by('ABS(y.CLASS)', 'asc');
        $this -> db -> order_by('y.SECTION', 'asc');
        //$this->db->where('DATE_FORMAT(DATE(c.DATE_), "%d-%m-%Y") = DATE_FORMAT(DATE(CURDATE()), "%d-%m-%Y")');
        $this->db->where('c.PAID<>', 0);
        $this->db->select('a.SESSID, x.CLASSID, c.*');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this->db->join('class_2_in_session x', 'x.CLSSESSID=a.CLSSESSID');
        $this -> db -> join('class_1_classes y', 'x.CLASSID=y.CLASSID');
        $this->db->join('master_8_stud_academics z', 'c.regid=z.regid');
        $query = $this->db->get();

        return $query->result();
    }
    function get_todays_collection(){
        $this->db->where('z.STATUS_', 1);
        $this -> db -> order_by('ABS(y.CLASS)', 'asc');
        $this -> db -> order_by('y.SECTION', 'asc');
        $this->db->where('DATE_FORMAT(DATE(c.DATE_), "%d-%m-%Y") = DATE_FORMAT(DATE(CURDATE()), "%d-%m-%Y")');
        $this->db->where('c.PAID<>', 0);
        $this->db->select('a.SESSID, x.CLASSID, c.*');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this->db->join('class_2_in_session x', 'x.CLSSESSID=a.CLSSESSID');
        $this -> db -> join('class_1_classes y', 'x.CLASSID=y.CLASSID');
        $this->db->join('master_8_stud_academics z', 'c.regid=z.regid');
        $query = $this->db->get();

        return $query->result();
    }

    function todays_collection(){ // Receipt Collection for today
        //$this->db->where('MODE', 'cash');
        $this->db->where('d.STATUS_', 1);
        $this->db->where('DATE_FORMAT(DATE(c.DATE_), "%d-%m-%Y") = DATE_FORMAT(DATE(CURDATE()), "%d-%m-%Y")');
        $this->db->where('c.PAID<>', 0);
        $this->db->select('SUM(c.PAID) as TODAYS_COLLECTION');
        $this->db->from('fee_7_receipts c');
        $this->db->join('master_8_stud_academics d', 'c.regid=d.regid');
        $query = $this->db->get();

        if($query->num_rows()!=0){
            $r = $query->row();
            if($r->TODAYS_COLLECTION != NULL){
                $value = $r->TODAYS_COLLECTION;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }
    function todays_cash_collection(){
        $this->db->where('MODE', 'cash');
        $this->db->where('b.STATUS_', 1);
        $this->db->where('DATE_FORMAT(DATE(a.DATE_), "%d-%m-%Y") = DATE_FORMAT(DATE(CURDATE()), "%d-%m-%Y")');
        $this->db->select('SUM((a.ACTUAL_PAID_AMT - a.DISCOUNT_AMOUNT) + a.FINE) as TODAYS_COLLECTION');
        $this->db->from('fee_7_receipts a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $query = $this->db->get();

        if($query->num_rows()!=0){
            $r = $query->row();
            if($r->TODAYS_COLLECTION != NULL){
                $value = $r->TODAYS_COLLECTION;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }
    function todays_receipt_count(){
        $this->db->where('b.STATUS_', 1);
        $this->db->where('DATE_FORMAT(DATE(a.DATE_), "%d-%m-%Y") = DATE_FORMAT(DATE(CURDATE()), "%d-%m-%Y")');
        $this->db->where('a.PAID<>', 0);
        $this->db->select('COUNT(a.ACTUAL_PAID_AMT) AS RECEIPT_COUNT');
        $this->db->from('fee_7_receipts a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $query = $this->db->get();

        if($query->num_rows()!=0){
            $r = $query->row();
            if($r->RECEIPT_COUNT != NULL){
                $value = $r->RECEIPT_COUNT;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }

    function total_dues_in_a_session($clssessid='x'){
        if($clssessid != 'x'){
            $this->db->where('a.CLSSESSID', $clssessid);
        }
        $this->db->where('d.STATUS_', 1); // This means student not left the school yet 
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('b.STATUS', 1); // means latest invoice
        $this->db->where('b.DUE_AMOUNT>', 0);
        $this->db->select('SUM(b.DUE_AMOUNT) AS DUES');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('master_8_stud_academics d', 'b.regid=d.regid');
        $query = $this->db->get();
        if($query->num_rows()!=0){
            $r = $query->row();
            if($r->DUES != NULL){
                $value = $r->DUES;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }

    function total_student_having_dues_in_a_session(){
        $this->db->where('d.STATUS_', 1); // This means student not left the school yet 
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('b.STATUS', 1); // means latest invoice
        $this->db->where('b.DUE_AMOUNT>', 0);
        $this->db->select('COUNT(b.DUE_AMOUNT) AS DUES');
        $this->db->from('fee_6_invoice a');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('master_8_stud_academics d', 'b.regid=d.regid');
        $query = $this->db->get();
        if($query->num_rows()!=0){
            $r = $query->row();
            if($r->DUES != NULL){
                $value = $r->DUES;
            } else {
                $value = 0;
            }
        } else {
            $value = 0;
        }
        return $value;
    }

    function get_total_dues_in_a_session($year_='x', $clssessid='x'){     
        if($year_ != 'x'){
            $this->db->where('x.SESSID', $year_);
        }
        if($clssessid != 'x'){
            $this->db->where('x.CLSSESSID', $clssessid);   
        }
        $this->db->where('d.STATUS_', 1); // This means student not left the school yet 
        $this->db->where('b.STATUS', 1); // means latest invoice   
        $this->db->where('b.DUE_AMOUNT>', 0);
        $this->db->select('x.CLASSID, x.CLSSESSID, c.FNAME, c.MNAME, c.LNAME, c.regid, a.YEAR_FROM, a.MONTH_FROM, a.YEAR_TO, a.MONTH_TO, a.NOM, b.STATIC_HEADS_1_TIME, b.STATIC_HEADS_N_TIMES, b.FLEXIBLE_HEADS_1_TIME, b.FLEXIBLE_HEADS_N_TIMES, b.INVDETID, b.ACTUAL_DUE_AMOUNT, b.PREV_DUE_AMOUNT, b.DUE_AMOUNT');
        $this->db->from('class_1_classes y');
        $this->db->join('class_2_in_session x', 'y.CLASSID=x.CLASSID');
        $this->db->join('fee_6_invoice a', 'x.CLSSESSID=a.CLSSESSID');
        $this->db->join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this->db->join('master_7_stud_personal c', 'c.regid=b.REGID');
        $this->db->join('master_8_stud_academics d', 'd.regid=c.regid');
        $this->db->order_by('ABS(a.YEAR_FROM)', 'desc');
        $this->db->order_by('ABS(a.MONTH_FROM)', 'desc');
        $this->db->order_by('c.regid');
        $query = $this->db->get();
        return $query->result();
    }

    function getClasses_in_session_having_dues($session){
        $year__ = $session;
        $this->db->select('a.CLASSID, b.CLSSESSID, SUM(d.DUE_AMOUNT) AS DUES');
        $this -> db -> where ('b.SESSID', $year__);
        $this -> db -> where('e.STATUS_', 1);
        $this -> db -> where('d.STATUS', 1);
        $this->db->where('d.DUE_AMOUNT>', 0);
        $this -> db -> order_by('ABS(a.CLASSID)');
        $this -> db -> order_by('a.SECTION');
        $this -> db -> group_by('b.CLSSESSID');
        $this -> db -> from('class_1_classes a');
        $this -> db -> join('class_2_in_session b', 'a.CLASSID=b.CLASSID');
        $this -> db -> join('fee_6_invoice c', 'b.CLSSESSID=c.CLSSESSID');
        $this -> db -> join('fee_6_invoice_detail d', 'c.INVID=d.INVID');
        $this -> db -> join('master_8_stud_academics e', 'e.regid=d.regid');
        $query = $this -> db -> get();

        return $query -> result();
    }

}