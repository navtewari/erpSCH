<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class My_export_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }  
    function toCsv($classessid, $cls){
        $this->load->dbutil();
        $this->db->where('b.STATUS_', 1);
        $this->db->where('c.CLSSESSID',$classessid);        
        $this->db->order_by('a.FNAME');
        $this->db->select('a.regid as REG NO, d.CLASSID as Class, UPPER(a.FNAME) as STUDENTNAME, UPPER(a.GENDER) as GENDER, DOB_ as DOB, UPPER(a.FATHER) as FATHER, a.F_MOBILE as FATHER_MOBILE, UPPER(a.MOTHER) as MOTHER, a.F_MOBILE as MOTHER_MOBILE, UPPER(a.CATEGORY) as CATEGORY');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        $this->db->join('class_2_in_session d', 'c.CLSSESSID=d.CLSSESSID');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Class_".$cls."_".$this->session->userdata('school_name').".csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    function backup(){
        $this->load->dbutil();
        $backup = $this->dbutil->backup();

        // Load the file helper and write the file to your server
        write_file(base_url('/assets_/mybackup.gz'), $backup);

        // Load the download helper and send the file to your desktop
        force_download('mybackup.gz', $backup);
    }

}