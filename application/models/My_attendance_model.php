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
        $this -> db -> where('c.STATUS_', 1);
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->join('class_3_class_wise_students b', 'a.CLSSESSID = b.CLSSESSID');
        $this -> db -> join('master_8_stud_academics c', 'b.regid=c.regid');
        $this->db->where('a.SESSID', $year__);
        $query = $this->db->get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function get_students_in_class($clssessid, $year__){
        $this -> db -> order_by('a.FNAME');
        $this -> db -> select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_');
        $this -> db -> from('master_7_stud_personal a');
        $this -> db -> join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this -> db -> join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this -> db -> join('master_8_stud_academics d', 'b.regid=d.regid');
        $this -> db -> where('b.clssessid', $clssessid);
        $this -> db -> where('d.STATUS_', 1);
        $this->db->where('c.SESSID', $year__);
        $query = $this->db->get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function checkExistingAttendance(){
        $clssessid = $this->input->post('ClassSessid_');
        $dt_ = explode("/",$this->input->post('date_'));
        $date__ = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        $time_ = $this->input->post('time_');

        $this->db->distinct();
        $this->db->select('a.ATTID');
        $this->db->where('a.CLSSESSID',$clssessid);
        $this->db->where('a.DATE_',$date__);
        $this->db->where('a.TIME_',$time_);
        $this->db->where('b.STATUS_', 1);
        $this -> db -> from('class_4_class_wise_attendance a');
        $this -> db -> join('master_8_stud_academics b', 'a.regid=b.regid');
        $query = $this->db->get();

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

    function checkExistingAttendance_with_data(){
        $clssessid = $this->input->post('ClassSessid_');
        $dt_ = explode("/",$this->input->post('date_'));
        $date__ = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        $time_ = $this->input->post('time_');
        
        $this -> db -> order_by('c.FNAME');
        $this -> db -> distinct();
        $this -> db -> select('a.ATTID, a.regid, c.FNAME, a.STATUS');
        $this -> db -> where('a.CLSSESSID',$clssessid);
        $this -> db -> where('a.DATE_',$date__);
        $this -> db -> where('a.TIME_',$time_);
        $this -> db -> where('b.STATUS_', 1);
        $this -> db -> from('class_4_class_wise_attendance a');
        $this -> db -> join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> join('master_7_stud_personal c', 'b.regid=c.regid');
        $query = $this->db->get();

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        if($query->num_rows() != 0){
            $bool_ = array('res_'=>2, 'record'=>$query->result());
        } else {
            $bool_ = array('res_'=>1, 'record'=>'x');
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
            $editingStatus = $this->input->post('status_of_editting');
            $obj = $this->input->post('hidden_attendance_status');
            $username = $this -> session -> userdata('_user___');
            $sessionid =  $this->session->userdata('_current_year___');
            $doe_ = date('Y-m-d H:i:s');
            $dt_ = explode("/",$this->input->post('attendancedate'));
            $date__ = $dt_[2]."-".$dt_[1]."-".$dt_[0];
            $time_ = $this->input->post('attendanceHour').":".$this->input->post('attendanceMin').":".$this->input->post('attendanceAMPM');

            if($editingStatus == 'new'){
                $this->db->where('CLSSESSID', $clssessid);
                $this->db->where('DATE_', $date__);
                $this->db->where('TIME_', $time_);
                if($this->db->get('class_4_class_wise_attendance')->num_rows()!=0){
                    $bool_ = false;
                } else {
                    foreach($obj as $key => $value){
                        $data = array(
                            'regid' => $key,
                            'ROLLNO'=> 0,
                            'CLSSESSID'=>$clssessid,
                            'USERNAME_'=>$username,
                            'DATE_' => $date__,
                            'TIME_' => $time_,
                            'STATUS' => $value,
                            'DOE_' => $doe_
                            );
                        $bool_ = $this->db->insert('class_4_class_wise_attendance', $data);
                    }
                }
            } else {
                $objATTID = $this->input->post('hidden_attendance_id');
                foreach($obj as $key => $value){
                    $this->db->where('ATTID', $objATTID[$key]);
                    $data = array(
                        'USERNAME_'=>$username,
                        'DATE_' => $date__,
                        'TIME_' => $time_,
                        'STATUS' => $value,
                        'DOE_' => $doe_
                        );
                    $bool_ = $this->db->update('class_4_class_wise_attendance', $data);
                }
            }
  
            if($bool_== true){
                $data_['messageNo'] = 1; //'Attendance for class <b>'.$class.'</b> successfully submitted.';
                //$this->session->set_flashdata('msg_all', 'Attendance for class <b>'.$class.'</b> successfully submitted.');

                $this->db->select('a.regid, b.MOBILE_S, a.DATE_');
                $this->db->where('a.CLSSESSID', $clssessid);
                $this->db->where('a.DATE_', $date__);
                $this->db->where('a.TIME_', $time_);
                $this->db->where('a.STATUS', '0');
                $this->db->from('class_4_class_wise_attendance a');
                $this->db->join('master_10_stud_contact b', 'a.regid=b.regid');
                $query = $this->db->get();
                $data_['nos'] = $query->result();
            } else {
                $data_['messageNo'] = 2; //'Something goes wrong. Please try again...';
                $data_['nos'] = 0;
                $this->session->set_flashdata('msg_all', '<b>Attendance already exists</b> OR Something goes wrong. Please try again...');
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
        $this -> db -> order_by('a.FNAME');
        $this -> db -> select('a.regid, a.FNAME, a.MNAME, a.LNAME');
        $this -> db -> from('master_7_stud_personal a');
        $this -> db -> join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this -> db -> join('master_8_stud_academics c', 'b.regid=c.regid');
        $this -> db -> where('c.STATUS_', 1);
        $this -> db -> where('b.CLSSESSID', $clssessid);
        $this -> db -> where('b.SESSID', $year__);
        $query = $this->db->get();
        //echo $this->db->last_query(); 
        return $query->result();
    }
    function getstudentsforclass_for_view($year__){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $this -> db -> order_by('a.FNAME');
        $this->db->select('a.regid, a.FNAME, a.MNAME, a.LNAME');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this -> db -> join('master_8_stud_academics c', 'b.regid=c.regid');
        $this -> db -> where('c.STATUS_', 1);
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

        $dt_ = explode("/",$this->input->post('attendancedatefrom'));
        $date_from = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $dt_ = explode("/",$this->input->post('attendancedateto'));
        $date_upto = $dt_[2]."-".$dt_[1]."-".$dt_[0];

        $this->db->select('a.DATE_, a.TIME_');
        $this->db->group_by('a.DATE_');
        $this->db->where('a.CLSSESSID', $clssessid);
        $this->db->where('a.DATE_ >=', $date_from);   
        $this->db->where('a.DATE_ <=', $date_upto);
        $this->db->from('class_4_class_wise_attendance a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> where('b.STATUS_', 1);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchAttendance_consolidate_attendance(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $dt_ = explode("/",$this->input->post('attendancedatefrom'));
        $date_from = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $dt_ = explode("/",$this->input->post('attendancedateto'));
        $date_upto = $dt_[2]."-".$dt_[1]."-".$dt_[0];

        $this->db->select('a.regid, a.CLSSESSID, a.DATE_, a.STATUS');
        $this->db->where('a.CLSSESSID', $clssessid);
        $this->db->where('a.DATE_ >=',  $date_from);   
        $this->db->where('a.DATE_ <=',  $date_upto);
        //$this->db->group_by('a.DATE_');
        $this->db->from('class_4_class_wise_attendance a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> where('b.STATUS_', 1);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchTime_for_days(){
        $clssessid = $this->input->post('cmbClassesForStudents');
        $dt_ = explode("/",$this->input->post('attendancedatefrom'));
        $date_from = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $dt_ = explode("/",$this->input->post('attendancedateto'));
        $date_upto = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $date_ = $this->input->post('attendancedate');
        $this->db->select('a.DATE_, a.TIME_');
        $this->db->group_by('a.DATE_, a.TIME_');
        $this->db->where('a.DATE_ >=',  $date_from);   
        $this->db->where('a.DATE_ <=',  $date_upto);   
        $this->db->where('a.CLSSESSID', $clssessid); //Classessid is also contains the current session

        $this->db->from('class_4_class_wise_attendance a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> where('b.STATUS_', 1);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchTime_for_days_for_consolidate(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $dt_ = explode("/",$this->input->post('attendancedatefrom'));
        $date_from = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $dt_ = explode("/",$this->input->post('attendancedateto'));
        $date_upto = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $this->db->select('a.DATE_, a.TIME_');
        $this->db->group_by('a.DATE_, a.TIME_');
        $this->db->where('a.DATE_ >=',  $date_from);   
        $this->db->where('a.DATE_ <=',  $date_upto);   
        $this->db->where('a.CLSSESSID', $clssessid); //Classessid is also contains the current session

        $this->db->from('class_4_class_wise_attendance a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> where('b.STATUS_', 1);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }

    function fetchTime_for_daywise(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $dt_ = explode("/",$this->input->post('attendancedate'));
        $date__ = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        
        $this->db->order_by('a.ATTID');
        $this->db->select('a.DATE_, a.TIME_');
        $this->db->group_by('a.TIME_');
        $this->db->where('a.DATE_', $date__);   
        $this->db->where('a.CLSSESSID', $clssessid); //Classessid is also contains the current session

        $this->db->from('class_4_class_wise_attendance a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> where('b.STATUS_', 1);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
    function fetchTime_for_day(){
        $clssessid = $this->input->post('cmbClassesForStudents');
        $dt_ = explode("/",$this->input->post('attendancedate'));
        $date__ = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        $this->db->order_by('a.ATTID');
        $this->db->select('a.DATE_, a.TIME_');
        $this->db->group_by('a.TIME_');
        $this->db->where('a.DATE_', $date__);   
        $this->db->where('a.CLSSESSID', $clssessid); //Classessid is also contains the current session

        $this->db->from('class_4_class_wise_attendance a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this -> db -> where('b.STATUS_', 1);
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
    function fetchAttendance_daywise(){
        $clssessid = $this->input->post('cmbClassesForStudents_view');
        $dt_ = explode("/",$this->input->post('attendancedate'));
        $date__ = $dt_[2]."-".$dt_[1]."-".$dt_[0];
        $this->db->select('b.regid, b.CLSSESSID, b.DATE_, b.TIME_, b.STATUS');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_4_class_wise_attendance b', 'a.regid = b.regid');
        $this->db->join('master_8_stud_academics c', 'b.regid=c.regid');
        $this -> db -> where('c.STATUS_', 1);
        $this->db->where('b.CLSSESSID', $clssessid);
        $this->db->where('b.DATE_', $date__);   
        $query = $this->db->get();
        
        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->result();
    }
}