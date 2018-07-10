<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_attendance_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function getClasses($year__){
        $this->db->order_by('ABS(x.CLASS)', 'asc');
    	$this->db->select('x.CLASS, a.CLASSID, a.CLSSESSID');
    	$this->db->distinct();
        $this->db->from('class_1_classes x');
    	$this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
    	$this->db->join('class_3_class_wise_students b', 'a.CLSSESSID = b.CLSSESSID');
    	$this->db->where('a.SESSID', $year__);
    	$query = $this->db->get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
    	return $query->result();
    }

    function get_students_in_class($clssessid, $year__){
        $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this->db->where('b.clssessid', $clssessid);
        $this->db->where('c.SESSID', $year__);
        $query = $this->db->get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function checkExistingAttendance(){
        $clssessid = $this->input->post('ClassSessid_');
        $date_ = $this->input->post('date_');
        $time_ = $this->input->post('time_');

        $this->db->distinct();
        $this->db->select('ATTID');
        $this->db->where('CLSSESSID',$clssessid);
        $this->db->where('DATE_',$date_);
        $this->db->where('TIME_',$time_);
        $query = $this->db->get('class_4_class_wise_attendance');

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        if($query->num_rows() != 0){
            $bool_ = 2;
        } else {
            $bool_ = 1;
        }

        return $bool_;
    }

    function takeattendance(){

        $clssessid = $this->input->post('cmbClassesForStudents');

        $this->db->where('CLSSESSID', $clssessid);
        $query = $this->db->get('class_2_in_session');

        if($query->num_rows()!=0){
            $row = $query->row();
            $class = $row->CLASSID;
            $obj = $this->input->post('hidden_attendance_status');
            $username = $this -> session -> userdata('_user___');
            $sessionid =  $this->session->userdata('_current_year___');
            $doe_ = date('Y-m-d H:i:s');
            $dt_ = $this->input->post('attendancedate');
            $time_ = $this->input->post('attendanceHour').":".$this->input->post('attendanceMin').":".$this->input->post('attendanceAMPM');

            foreach($obj as $key => $value){
                $data = array(
                    'regid' => $key,
                    'ROLLNO'=> 0,
                    'CLSSESSID'=>$clssessid,
                    'USERNAME_'=>$username,
                    'DATE_' => $dt_,
                    'TIME_' => $time_,
                    'STATUS' => $value,
                    'DOE_' => $doe_
                    );
                $bool_ = $this->db->insert('class_4_class_wise_attendance', $data);
            }
  
            if($bool_== true){
                $data_['messageNo'] = 1; //'Attendance for class <b>'.$class.'</b> successfully submitted.';
                //$this->session->set_flashdata('msg_all', 'Attendance for class <b>'.$class.'</b> successfully submitted.');

                $this->db->select('a.regid, b.MOBILE_S, a.DATE_');
                $this->db->where('a.CLSSESSID', $clssessid);
                $this->db->where('a.DATE_', $dt_);
                $this->db->where('a.TIME_', $time_);
                $this->db->where('a.STATUS', '0');
                $this->db->from('class_4_class_wise_attendance a');
                $this->db->join('master_10_stud_contact b', 'a.regid=b.regid');
                $query = $this->db->get();
                $data_['nos'] = $query->result();
            } else {
                $data_['messageNo'] = 2; //'Something goes wrong. Please try again...';
                $data_['nos'] = 0;
                $this->session->set_flashdata('msg_all', 'Something goes wrong. Please try again...');
            }
        } else {
            $data_['messageNo'] = 3; //'Something goes wrong. Please try again...';
            $data_['nos'] = 0;
            $this->session->set_flashdata('msg_all', 'Something goes wrong. Please try again...');
        }

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  

        return json_encode($data_);
    }

    function getstudentsforclass($year__){
        $clssessid = $this->input->post('cmbClassesForStudents');
        $this->db->select('a.regid, a.FNAME, a.MNAME, a.LNAME');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->where('b.CLSSESSID', $clssessid);
        $this->db->where('b.SESSID', $year__);
        $query = $this->db->get();
        //echo $this->db->last_query(); 
        return $query->result();
    }
    function getstudentsforclass_for_view($year__){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $this->db->select('a.regid, a.FNAME, a.MNAME, a.LNAME');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->where('b.CLSSESSID', $clssessid);
        $this->db->where('b.SESSID', $year__);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        //echo $this->db->last_query(); 
        return $query->result();
    }
    function fetchAttendance_consolidate_date(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $date_from = $this->input->post('attendancedatefrom');
        $date_upto = $this->input->post('attendancedateto');

        $this->db->select('DATE_, TIME_');
        $this->db->group_by('DATE_');
        $this->db->where('CLSSESSID', $clssessid);
        $this->db->where('DATE_ >=', $date_from);   
        $this->db->where('DATE_ <=', $date_upto);
        $query = $this->db->get('class_4_class_wise_attendance');
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchAttendance_consolidate_attendance(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $date_from = $this->input->post('attendancedatefrom');
        $date_upto = $this->input->post('attendancedateto');

        $this->db->select('regid, CLSSESSID, DATE_, STATUS');
        $this->db->where('CLSSESSID', $clssessid);
        $this->db->where('DATE_ >=',  $date_from);   
        $this->db->where('DATE_ <=',  $date_upto);
        //$this->db->group_by('DATE_');
        $query = $this->db->get('class_4_class_wise_attendance');
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchTime_for_days(){
        $clssessid = $this->input->post('cmbClassesForStudents');
        $date_from = $this->input->post('attendancedatefrom');
        $date_upto = $this->input->post('attendancedateto');
        $date_ = $this->input->post('attendancedate');
        $this->db->select('DATE_, TIME_');
        $this->db->group_by('DATE_,TIME_');
        $this->db->where('DATE_ >=',  $date_from);   
        $this->db->where('DATE_ <=',  $date_upto);   
        $this->db->where('CLSSESSID', $clssessid); //Classessid is also contains the current session

        $query = $this->db->get('class_4_class_wise_attendance');
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchTime_for_days_for_consolidate(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $date_from = $this->input->post('attendancedatefrom');
        $date_upto = $this->input->post('attendancedateto');
        $date_ = $this->input->post('attendancedate');
        $this->db->select('DATE_, TIME_');
        $this->db->group_by('DATE_,TIME_');
        $this->db->where('DATE_ >=',  $date_from);   
        $this->db->where('DATE_ <=',  $date_upto);   
        $this->db->where('CLSSESSID', $clssessid); //Classessid is also contains the current session

        $query = $this->db->get('class_4_class_wise_attendance');
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchTime_for_daywise(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $date_ = $this->input->post('attendancedate');
        $this->db->order_by('ATTID');
        $this->db->select('DATE_, TIME_');
        $this->db->group_by('TIME_');
        $this->db->where('DATE_', $date_);   
        $this->db->where('CLSSESSID', $clssessid); //Classessid is also contains the current session

        $query = $this->db->get('class_4_class_wise_attendance');
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
    function fetchTime_for_day(){
        $clssessid = $this->input->post('cmbClassesForStudents');
        $date_ = $this->input->post('attendancedate');
        $this->db->order_by('ATTID');
        $this->db->select('DATE_, TIME_');
        $this->db->group_by('TIME_');
        $this->db->where('DATE_', $date_);   
        $this->db->where('CLSSESSID', $clssessid); //Classessid is also contains the current session

        $query = $this->db->get('class_4_class_wise_attendance');
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
    function fetchAttendance_daywise(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $date_ = $this->input->post('attendancedate');
        $this->db->select('b.regid, b.CLSSESSID, b.DATE_, b.TIME_, b.STATUS');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_4_class_wise_attendance b', 'a.regid = b.regid');
        $this->db->where('b.CLSSESSID', $clssessid);
        $this->db->where('b.DATE_', $date_);   
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
}