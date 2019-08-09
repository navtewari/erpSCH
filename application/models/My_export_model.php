<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_export_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
        $this->load->model('My_error_model', 'error');
        $this->load->library('csvimport');
        // --------------------
    }

    function toCsv($classessid, $cls) {
        $this->load->dbutil();
        $this->db->where('b.STATUS_', 1);
        $this->db->where('c.CLSSESSID', $classessid);
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
        $filename = "Class_" . $cls . "_" . $this->session->userdata('school_name') . ".csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    function toCsv2($classessid, $cls){
        $this->load->dbutil();
        $this->db->order_by('a.FNAME', 'asc');
        $this->db->select('e.CLASSID, a.PHOTO_ AS PHOTO, UPPER(a.FNAME) AS FNAME, UPPER(a.MNAME) AS MNAME, UPPER(a.LNAME) AS LNAME, CONCAT("[ ",a.DOB_," ]") AS DOB, UPPER(a.GENDER) AS GENDER, UPPER(a.FATHER) AS FATHER, UPPER(a.MOTHER) AS MOTHER, b.MOBILE_S AS MOBILE, UPPER(c.STREET_1) AS STREET, UPPER(c.CITY_) AS CITY, UPPER(c.PIN_) AS PIN, UPPER(c.DISTT_) AS DISTT, UPPER(c.STATE_) AS STATE, UPPER(c.COUNTRY_) AS COUNTRY, a.regid');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_10_stud_contact b', 'a.regid=b.regid');
        $this->db->join('master_9_stud_address c', 'a.regid=c.regid');
        $this->db->join('class_3_class_wise_students d', 'a.regid=d.regid');
        $this->db->join('class_2_in_session e', 'd.CLSSESSID=e.CLSSESSID');
        $this->db->join('master_8_stud_academics k', 'a.regid=k.regid');
        $this->db->where('b.CONTACT_STATUS', "CORRESPONDANCE");
        $this->db->where('c.ADDRESS_STATUS', "PERMANENT");
        $this->db->where('k.STATUS_', 1);
        //$this->db->where('d.SESSID', $session);
        $this->db->where('e.CLSSESSID', $classessid);
        $query = $this->db->get();
        //echo $this->db->last_query(); die();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "ID_CARD_" . $cls . "_" . $this->session->userdata('school_name') . ".csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }
    function tcCsv_for_tc($classessid, $cls){
        $this->load->dbutil();
        $this->db->where('b.STATUS_', 1);
        $this->db->where('c.CLSSESSID', $classessid);
        $this->db->order_by('a.FNAME');
        $this->db->select('a.regid as REG NO, d.CLASSID as Class, UPPER(a.FNAME) as STUDENTNAME, UPPER(a.GENDER) as GENDER, DOB_ as DOB, e.MOBILE_S AS STDUENT_MOBILE, e.EMAIL_S AS STUDENT_MOBILE, UPPER(a.FATHER) as FATHER, a.F_MOBILE as FATHER_MOBILE, UPPER(a.MOTHER) as MOTHER, a.F_MOBILE as MOTHER_MOBILE, UPPER(a.CATEGORY) as CATEGORY, tc.DUES_PAID, tc.DATE_OF_CUTTING_NAME, tc.REASON_OF_LEAVING_SCHOOL, NO_OF_MEETING_UPTODATE, tc.SCHOOL_DAYS_ATTENDED, tc.GENERAL_CONDUCT_OF_STUDENT, tc.LAST_STUDIED_CLASS, tc.SCHOOL_OR_BOARD, tc.PROMOTED, tc.REMARKS_IF_ANY, tc.DATE_OF_ISSUE, ');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('master_10_stud_contact e', 'b.regid=e.regid');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        $this->db->join('class_2_in_session d', 'c.CLSSESSID=d.CLSSESSID');
        $this->db->join('master_7_stud_personal_tc_status tc', 'b.regid=tc.regid');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Class_" . $cls . "_" . $this->session->userdata('school_name') . ".csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }
    function mtoCsvExam($classessid, $cls) {
        $this->load->dbutil();
        $this->db->where('b.STATUS_', 1);
        $this->db->where('c.CLSSESSID', $classessid);
        $this->db->order_by('a.FNAME');
        $this->db->select('a.regid as REG NO, UPPER(a.FNAME) as STUDENTNAME');
        $this->db->select("NULL as Marks", false);
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        //$this->db->join('master_10_stud_contact e', 'b.regid=e.regid');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        $this->db->join('class_2_in_session d', 'c.CLSSESSID=d.CLSSESSID');
        $this->db->order_by('cast(a.regid AS SIGNED INT)', 'ASC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Class_" . $cls . "_" . $this->session->userdata('school_name') . ".csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    function insert_csv() {
        //$this->db->insert('exam_6_scholastic_result', $data);

        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');
        $subjectid = $this->input->post('cmbSubjectMarks');
        $examDate = $this->input->post('txtExamDate');
        $sessionid = $this->session->userdata('_current_year___');

        //$obj = $this->input->post('marks_status');
        $username = $this->session->userdata('_user___');
        $file_path = $_FILES["userfile"]["tmp_name"];
        /* $fp = fopen($file_path,'r');
          echo count($fp);
          die(); */
        if ($optScholastic == '1') {
            $this->db->where('itemID', $AssItem);
            $query2 = $this->db->get('exam_1_scholastic_items');

            if ($query2->num_rows() != 0) {
                foreach ($query2->result() as $row2) {
                    $maxMarks = $row2->maxMarks;
                }
            }

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'regid' => $row['REG NO'],
                        'CLSSESSID' => $classid,
                        'ROLLNO' => 0,
                        'SESSID' => $sessionid,
                        'subjectID' => $subjectid,
                        'itemID' => $AssItem,
                        'maxMarks' => $maxMarks,
                        'marks' => $row['Marks'],
                        'termID' => $termID,
                        'USERNAME_' => $username,
                        'DATEOFTEST' => $examDate,
                    );
                    //$this->mem->insert_csv($insert_data);                    
                    $query = $this->db->insert('exam_6_scholastic_result', $insert_data);
                    //echo $this->db->last_query();
                    //die();
                }
            }
        } else if ($optScholastic == '2') {
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'regid' => $row['REG NO'],
                        'CLSSESSID' => $classid,
                        'ROLLNO' => 0,
                        'SESSID' => $sessionid,
                        'coitemID' => $AssItem,
                        'grade' => $row['Marks'],
                        'termID' => $termID,
                        'USERNAME_' => $username,
                        'DATEOFTEST' => $examDate,
                    );
                    $query = $this->db->insert('exam_7_coscholastic_result', $insert_data);
                }
            }
        } else if ($optScholastic == '3') {
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'regid' => $row['REG NO'],
                        'CLSSESSID' => $classid,
                        'ROLLNO' => 0,
                        'SESSID' => $sessionid,
                        'disciplineID' => $AssItem,
                        'grade' => $row['Marks'],
                        'termID' => $termID,
                        'USERNAME_' => $username,
                        'DATEOFTEST' => $examDate,
                    );
                    $query = $this->db->insert('exam_12_discipline_result', $insert_data);
                }
            }           
        }

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Result Uploaded and submitted Successfully');
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong. Please check and try again.');
        }

        return $bool_;
    }
    
    function insert_csvUpdate() {
        //$this->db->insert('exam_6_scholastic_result', $data);

        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');
        $subjectid = $this->input->post('cmbSubjectMarks');
        $examDate = $this->input->post('txtExamDate');
        $sessionid = $this->session->userdata('_current_year___');

        //$obj = $this->input->post('marks_status');
        $username = $this->session->userdata('_user___');
        $file_path = $_FILES["userfile"]["tmp_name"];
        /* $fp = fopen($file_path,'r');
          echo count($fp);
          die(); */
        if ($optScholastic == '1') {
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'marks' => $row['Marks'],
                        'DATEOFTEST' => $examDate,                                               
                    );
                    $this->db->where('regid', $row['REG NO']);                                     
                    $this->db->where('CLSSESSID', $classid);  
                    $this->db->where('SESSID', $sessionid);                      
                    $this->db->where('subjectID', $subjectid);  
                    $this->db->where('itemID', $AssItem);  
                    $this->db->where('termID', $termID);
                    
                    $query = $this->db->update('exam_6_scholastic_result', $insert_data);                     
                }
            }
        } else if ($optScholastic == '2') {
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(                        
                        'grade' => $row['Marks'],                        
                        'DATEOFTEST' => $examDate,
                    );
                    
                    $this->db->where('regid', $row['REG NO']);                                     
                    $this->db->where('CLSSESSID', $classid);  
                    $this->db->where('SESSID', $sessionid);                                          
                    $this->db->where('coitemID', $AssItem);  
                    $this->db->where('termID', $termID);
                    
                    $query = $this->db->update('exam_7_coscholastic_result', $insert_data);                     
                }
            }
        } else if ($optScholastic == '3') {
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'grade' => $row['Marks'],                        
                        'DATEOFTEST' => $examDate,                                           
                    );
                    
                    $this->db->where('regid', $row['REG NO']);                                     
                    $this->db->where('CLSSESSID', $classid);  
                    $this->db->where('SESSID', $sessionid);                                          
                    $this->db->where('disciplineID', $AssItem);  
                    $this->db->where('termID', $termID);
                    $query = $this->db->update('exam_12_discipline_result', $insert_data);
                }
            }           
        }

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Result Uploaded and updated Successfully');
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong. Please check and try again.');
        }

        return $bool_;
    }

    function backup() {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $fake = 'Backup taken';
        // Load the file helper and write the file to your server
        $bckup_name = FCPATH . '/assets_/' . $this->session->userdata('db2') . '/backup/' . date('d_m_Y h:i:s A') . '_backup.gz';
        write_file($bckup_name, $backup);
        $this->email_db_backup($bckup_name); // Email the backup
        // Load the download helper and send the file to your desktop
        //force_download(date('d/m/Y h:i:s A').'_backup.gz', $fake);
        $this->session->set_userdata('bckup', 'Backup successfully taken. Thank you.');
    }

    function email_db_backup($bckup_name) {
        //-------------
        $this->email->set_mailtype("html");

        $msg_ = "<h2 style='color: #000090'>Attached Database Backup for " . $this->session->userdata('school_name') . "</h2>";

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

    function fee_total_class_collection_no_discount($cls, $class__, $datefrom, $dateto){
        $this->load->dbutil();
        $year__ = $this->session->userdata('_current_year___');

        if($class__ != 'x'){
            $this -> db -> where('a.CLSSESSID', $class__);
        }
        
        $this -> db -> where('z.STATUS_', 1);
        $this -> db -> where('c.PAID<>', 0);
        $this -> db -> order_by('y.CLASS', 'asc');
        $this -> db -> order_by('y.SECTION', 'asc');
        $this -> db -> order_by('zz.FNAME', 'asc');
        $this -> db -> order_by('DATE(c.DATE_)', 'asc');
        $this -> db -> where("DATE(c.DATE_) BETWEEN DATE('".$datefrom."') AND DATE('".$dateto."')");
        $this -> db -> select('y.CLASS, c.regid, zz.FNAME as NAME, c.PAID as PAID, CONCAT(" [",DATE_FORMAT(DATE(c.DATE_), "%d-%M-%Y"),"]") AS DATE_');
        $this -> db -> from('fee_6_invoice a');
        $this -> db -> join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this -> db -> join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this -> db -> join('class_2_in_session x', 'x.CLSSESSID=a.CLSSESSID');
        $this -> db -> join('class_1_classes y', 'x.CLASSID=y.CLASSID');
        $this -> db -> join('master_8_stud_academics z', 'c.regid=z.regid');
        $this -> db -> join('master_7_stud_personal zz', 'z.regid=zz.regid');
        $query = $this->db->get();
        //echo $this->db->last_query(); die();
        //return $query->result();

        $delimiter = ",";
        $newline = "\r\n";
        $filename = $cls ."_total_collection_without_discount.csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    function fee_total_class_collection_with_discount($cls, $class__, $datefrom, $dateto){
        $this->load->dbutil();
        $year__ = $this->session->userdata('_current_year___');

        if($class__ != 'x'){
            $this -> db -> where('a.CLSSESSID', $class__);
        }
        
        $this -> db -> where('z.STATUS_', 1);
        $this -> db -> order_by('y.CLASS', 'asc');
        $this -> db -> order_by('y.SECTION', 'asc');
        $this -> db -> order_by('zz.FNAME', 'asc');
        $this -> db -> order_by('DATE(c.DATE_)', 'asc');
        $this -> db -> where("DATE(c.DATE_) BETWEEN DATE('".$datefrom."') AND DATE('".$dateto."')");
        $this -> db -> select('y.CLASS, c.regid, zz.FNAME as NAME, c.DISCOUNT_AMOUNT AS DISOUNT, c.PAID as PAID, CONCAT(" [",DATE_FORMAT(DATE(c.DATE_), "%d-%M-%Y"),"]") AS DATE_');
        $this -> db -> from('fee_6_invoice a');
        $this -> db -> join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this -> db -> join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this -> db -> join('class_2_in_session x', 'x.CLSSESSID=a.CLSSESSID');
        $this -> db -> join('class_1_classes y', 'x.CLASSID=y.CLASSID');
        $this -> db -> join('master_8_stud_academics z', 'c.regid=z.regid');
        $this -> db -> join('master_7_stud_personal zz', 'z.regid=zz.regid');
        $query = $this->db->get();
        //echo $this->db->last_query(); die();
        //return $query->result();

        $delimiter = ",";
        $newline = "\r\n";
        $filename = $cls ."_total_collection_with_discount.csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    function fee_total_class_collection_consolidate($cls_, $class__, $datefrom, $dateto){
        $this->load->dbutil();
        $year__ = $this->session->userdata('_current_year___');

        if($class__ != 'x'){
            $this -> db -> where('a.CLSSESSID', $class__);
        }
        $this -> db -> group_by('c.regid');
        $this -> db -> where('z.STATUS_', 1);
        $this -> db -> order_by('y.CLASS', 'asc');
        $this -> db -> order_by('y.SECTION', 'asc');
        $this -> db -> order_by('zz.FNAME', 'asc');
        $this -> db -> order_by('DATE(c.DATE_)', 'asc');
        $this -> db -> where("DATE(c.DATE_) BETWEEN DATE('".$datefrom."') AND DATE('".$dateto."')");
        $this -> db -> select('y.CLASS, c.regid, zz.FNAME as NAME, sum(c.PAID) as TOTAL_PAID');
        $this -> db -> from('fee_6_invoice a');
        $this -> db -> join('fee_6_invoice_detail b', 'a.INVID=b.INVID');
        $this -> db -> join('fee_7_receipts c', 'b.INVDETID=c.INVDETID');
        $this -> db -> join('class_2_in_session x', 'x.CLSSESSID=a.CLSSESSID');
        $this -> db -> join('class_1_classes y', 'x.CLASSID=y.CLASSID');
        $this -> db -> join('master_8_stud_academics z', 'c.regid=z.regid');
        $this -> db -> join('master_7_stud_personal zz', 'z.regid=zz.regid');
        $query = $this->db->get();
        //echo $this->db->last_query(); die();
        //return $query->result();

        $delimiter = ",";
        $newline = "\r\n";
        $filename = $cls ."_total_collection_consolidate.csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

    function fee_dues_upto($cls, $class__, $datefrom, $dateto){
        $this->load->dbutil();
        $year__ = $this->session->userdata('_current_year___');

        if($class__ != 'x'){
            $this -> db -> where('a.CLSSESSID', $class__);
        }
        $this->db->select('a.CLASSID, zz.regid, zz.FNAME, d.DUE_AMOUNT AS DUES');
        $this -> db -> where ('b.SESSID', $year__);
        $this -> db -> where('e.STATUS_', 1);
        $this -> db -> where('d.STATUS', 1);
        $this -> db -> where('d.DUE_AMOUNT>', 0);
        $this -> db -> where("DATE(c.DATE_) BETWEEN DATE('".$datefrom."') AND DATE('".$dateto."')");
        $this -> db -> order_by('ABS(a.CLASSID)');
        $this -> db -> order_by('a.SECTION');
        $this -> db -> group_by('b.CLSSESSID');
        $this -> db -> from('class_1_classes a');
        $this -> db -> join('class_2_in_session b', 'a.CLASSID=b.CLASSID');
        $this -> db -> join('fee_6_invoice c', 'b.CLSSESSID=c.CLSSESSID');
        $this -> db -> join('fee_6_invoice_detail d', 'c.INVID=d.INVID');
        $this -> db -> join('master_8_stud_academics e', 'e.regid=d.regid');
        $this -> db -> join('master_7_stud_personal zz', 'e.regid=zz.regid');
        $query = $this -> db -> get();

        $delimiter = ",";
        $newline = "\r\n";
        $filename = $cls .".csv";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }

}
