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
        $this->db->select('a.regid as REG NO, d.CLASSID as Class, UPPER(a.FNAME) as STUDENTNAME, UPPER(a.GENDER) as GENDER, DOB_ as DOB, e.MOBILE_S AS STDUENT_MOBILE, e.EMAIL_S AS STUDENT_MOBILE, UPPER(a.FATHER) as FATHER, a.F_MOBILE as FATHER_MOBILE, UPPER(a.MOTHER) as MOTHER, a.F_MOBILE as MOTHER_MOBILE, UPPER(a.CATEGORY) as CATEGORY');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('master_10_stud_contact e', 'b.regid=e.regid');
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
        $fake = 'Backup taken';
        // Load the file helper and write the file to your server
        $bckup_name = FCPATH . '/assets_/'.$this->session->userdata('db2').'/backup/'.date('d_m_Y h:i:s A').'_backup.gz';
        write_file($bckup_name, $backup);
        $this->email_db_backup($bckup_name); // Email the backup
        // Load the download helper and send the file to your desktop
        //force_download(date('d/m/Y h:i:s A').'_backup.gz', $fake);
        $this->session->set_userdata('bckup', 'Backup successfully taken. Thank you.');
    }


    function email_db_backup($bckup_name) {
        //-------------
        $this->email->set_mailtype("html");

        $msg_ = "<h2 style='color: #000090'>Attached Database Backup for ".$this->session->userdata('school_name')."</h2>";

        $from_ = "ttchld@gmail.com";
        $name_ = "Teamfreelancers.com";

        $this->email->from($from_, $name_);
        $this->email->to('ttchld@gmail.com');
        $this->email->bcc('nitin.d12@gmail.com, navtewari@gmail.com');

        $this->email->subject('Database Backup');
        $this->email->message($msg_);
        $this->email->attach($bckup_name);
        if ($this->email->send()) {
            $ret_data = "Thanks for your query. We will get back soon...";
        } else {
            $ret_data = "X: Server Error !! Try Again...";
        }
    }

}