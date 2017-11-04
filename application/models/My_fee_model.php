
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
        //echo $this->db->last_query();
        if($query->num_rows()!=0){
            $r = $query->row();
            $data = '*Invoice had already been generted Upto <b style="color: #000090">'.$this->getMonths($r->MONTH_TO) .', '.$r->YEAR_TO.'</b> for the selected class.';
        } else {
            $data = '*No invoice yet generated for the selected class. Please proceed.';
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
            $this->db->select('b.FNAME, b.MNAME, b.LNAME, b.GENDER, a.*');
            $this->db->where('a.CLSSESSID', $class__);
            $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
            $this->db->where('a.YEAR_FROM',$R->YEAR_FROM);
            $this->db->where('a.MONTH_FROM',$R->MONTH_FROM); 
            $this->db->where('a.YEAR_TO',$R->YEAR_TO);
            $this->db->where('a.MONTH_TO',$R->MONTH_TO);
            $this->db->from('fee_6_invoice a');
            $this->db->join('master_7_stud_personal b', 'a.REGID=b.regid');
            $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');
            $query = $this->db->get();
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
    }

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
        switch ($no) {
            case 1:
                $month = 'January';
                break;
            case 2:
                $month = 'February';
                break;
            case 3:
                $month = 'March';
                break;
            case 4:
                $month = 'April';
                break;
            case 5:
                $month = 'May';
                break;
            case 6:
                $month = 'June';
                break;
            case 7:
                $month = 'July';
                break;
            case 8:
                $month = 'August';
                break;
            case 9:
                $month = 'September';
                break;
            case 10:
                $month = 'October';
                break;
            case 11:
                $month = 'November';
                break;
            case 12:
                $month = 'December';
                break;
            default:
                $month = 'No-Month';
                break;
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