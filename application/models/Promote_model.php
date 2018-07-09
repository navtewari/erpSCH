<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promote_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }
    function get_totalClass(){
    	$this->db->order_by('ABS(CLASS)');
        $query = $this -> db -> get('class_1_classes');
        return $query->result();
    }
    function get_totalClass_not_present_in_current_session($year__){
        $this->db->order_by('ABS(a.CLASS)', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes a');
        $this->db->join('class_2_in_session b', 'a.CLASSID=b.CLASSID AND b.SESSID="'.$year__.'"', 'left');
        $this->db->where('b.CLASSID',NULL);
        $query = $this->db->get();
    return $query->result();
    }
    function get_totalClass_in_current_session($year__){
        /*
            Below query having join retrieves 
            the data PRRESENT in table 'a' [class_2_in_session] 
            but NOT PRRESENT in table 'b' [class_3_class_wise_students]
            AND
            if data PRRESENT in class_3_class_wise_students 'b'
            than it will not retrieve in this query from table 'a' [class_2_in_session].
        */
        $this->db->order_by('ABS(x.CLASS)', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->join('class_3_class_wise_students b', 'a.CLSSESSID = b.CLSSESSID', 'left outer');
        $this->db->where('b.CLSSESSID IS NULL');
        $this->db->where('a.SESSID = "'.$year__.'"');
        $this->db->order_by('a.CLASSID');
        $this->db->distinct();
        $query = $this->db->get();
    return $query->result();
    }

    function get_Classes_in_current_session($year__){
        $this->db->order_by('ABS(x.CLASS)', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->where('a.SESSID = "'.$year__.'"');
        $this->db->order_by('a.CLASSID');
        $this->db->distinct();
        $query = $this->db->get();
    return $query->result();
    }
    function used_classes_($year__){
        /*
            Below query having join retrieves 
            ONLY the COMMON data PRRESENT in table a [class_2_in_session] 
            and ALSO PRRESENT in table b [class_3_class_wise_students].
        */
        $this->db->order_by('ABS(x.CLASS)', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->join('class_3_class_wise_students b', 'a.CLSSESSID=b.CLSSESSID AND a.SESSID="'.$year__.'"');
        $this->db->order_by('a.CLASSID');
        $this->db->distinct();
        $query = $this->db->get();
    return $query->result();
    }
    function set_Class_in_Session($year__){
        $count_list = $this->input->post('to');

        $this->db->where('SESSID', $year__);
        //$this->db->where('STATUS_', 0);
        $query = $this->db->get('class_2_in_session');        
        
        //$this->db->where('SESSID', $year__);
        //$query_admission = $this->db->get('master_8_stud_academics');

            if($query->num_rows() != 0){

                $query = $this->db->query("DELETE FROM class_2_in_session where SESSID = '".$year__."' AND CLSSESSID NOT IN (SELECT `CLSSESSID` from class_3_class_wise_students)");

                $bool_ = $this->insert_classes_in_session($count_list, $year__);
            } else {
                $bool_ = $this->insert_classes_in_session($count_list, $year__);
            }

        return $bool_;
    }
    function insert_classes_in_session($class_list, $year__){
        $bool_ = 0;
        for ($i = 0; $i < count($class_list); $i++){
            $data = array(
                'CLASSID' => $class_list[$i],
                'SESSID' => $year__,
                'DATE_' => date('Y-m-d H:i:s'),
                'STATUS_' => 1
            );
            $bool_ = $this->db->insert('class_2_in_session', $data);
        }

        return $bool_;
    }
    function add_class_master(){
    	$class_ = trim($this->input->post('txtAddClass_'));
    	$section_ = trim($this->input->post('cmbClassSection'));
    	$class_id_ = $class_ . ($section_ != '-' ? $section_:'');

    	$this->db->where('CLASSID', $class_id_);
    	$query = $this->db->get('class_1_classes');
    	
    	if($query->num_rows() != 0){
    		$bool_ = array('res_'=>FALSE, 'msg_'=>'Sorry! Class <span style="color: #0000ff; font-weight: bold">'.$class_id_.'</span> is already exists.');
    	} else {
    		$data = array (
    			'CLASSID' => $class_id_,
    			'CLASS' => $class_,
    			'SECTION' => $section_,
    			'DATE_' => date('Y-m-d H:i:s') 
    		);
    		$query = $this->db->insert('class_1_classes', $data);

    		if($query == TRUE){
	    		$bool_ = array('res_'=>TRUE, 'msg_'=>'Class <span style="color: #0000ff; font-weight: bold">'.$class_id_.'</span> added successfully.');
	    	} else {
	    		$bool_ = array('res_'=>TRUE, 'msg_'=>'Something goes wrong or class <span style="color: #0000ff; font-weight: bold">'.$class_id_.'</span> is already exists. Please check and try again.');
	    	}
    	}

    	return $bool_;
    }
    function get_classes_in_sesson($year__){
        $this->db->order_by('ABS(a.CLASS)', 'asc');
        $this->db->distinct('a.CLASSID');
        $this->db->select('a.CLASSID, b.CLSSESSID');
        $this->db->from('class_1_classes a');
        $this->db->join('class_2_in_session b', 'a.CLASSID = b.CLASSID');
        $this->db->where('b.SESSID', $year__);
        $query = $this->db->get();

        return $query->result();
    }
    function getClassesFromAdmission($year__){
        $this->db->order_by('ABS(a.CLASS)', 'asc');
        $this -> db -> order_by('a.SECTION', 'asc');
        $this->db->distinct('a.CLASSID');
        $this->db->select('a.CLASSID, b.CLSSESSID');
        $this->db->from('class_1_classes a');
        $this->db->join('class_2_in_session b', 'a.CLASSID = b.CLASSID');
        $this->db->join('master_8_stud_academics c', 'c.CLASS_OF_ADMISSION = b.CLSSESSID');
        // Below condition is used to check whether the student is already choosen for promotion (1) or not (0)
        $this->db->where('c.STATUS_OF_ADMISSION' , 0); 
        // Below condition is used to check whether student exists (1) or not (0)
        $this->db->where('c.STATUS_' ,1);
        $this->db->where('c.SESSID', $year__);
        $query = $this->db->get();
        //echo $this->db->last_query(); die();
        return $query->result();
    }
    function getClassesFromPreviousSession($year__){ 
        /*
            This function should retieve all the classes 
            added to the current session to retrieve 
            the previous session's student
        */

        // Below Calculation is for Previous Session
            $yr_data = explode("-", $year__);
            $one = $yr_data[0]-1;
            $two = $yr_data[1]-1;
            $prevYear = $one . "-" . $two;
        //------------------------------------------
        $this->db->order_by('ABS(a.CLASS)', 'asc');
        $this->db->distinct('a.CLASSID');
        $this->db->select('a.CLASSID, b.CLSSESSID');
        $this->db->from('class_1_classes a');
        $this->db->join('class_2_in_session b', 'a.CLASSID = b.CLASSID');
        $this->db->where('b.SESSID', $prevYear);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getStudentFromAdmission($year__){
        $class_session_id = $this->input->post('ClassSessid_'); // catching ClassSessid_ from ajax serialize array
        
        $this->db->select('a.STUD_ID, a.FNAME, a.MNAME, a.LNAME, a.regid');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid = b.regid AND b.CLASS_OF_ADMISSION ='.$class_session_id );
        $this->db->where('a.SESSID', $year__);
        // 0 means modification possible and also means this student is not yet associated with some class and 1 means already associated with some class
        $this->db->where('b.STATUS_OF_ADMISSION', 0); 
        // ---------------------------------------------------------
        $query = $this->db->get();

        return $query->result();
    }
    function getStudentFromPreviousSession($year__){
        $class_session_id = $this->input->post('ClassSessid_');  // catching ClassSessid_ from ajax serialize array


        // Below Calculation is for Previous Session
            $yr_data = explode("-", $year__);
            $one = $yr_data[0]-1;
            $two = $yr_data[1]-1;
            $prevYear = $one . "-" . $two;
        //------------------------------------------

        //Below code means if for this class students are present then please switch students by different module 'Switch Students'
        $this->db->select('a.STUD_ID, a.FNAME, a.MNAME, a.LNAME, a.regid');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid = b.regid AND b.CLSSESSID ='.$class_session_id);
        $this->db->where('a.SESSID', $year__);
        $query = $this->db->get();
        //------------------------------------------------------------------------------------------------------------------------

        if($query->num_rows() != 0){
            $result_ = Array();
        } else {
            $this->db->select('a.STUD_ID, a.FNAME, a.MNAME, a.LNAME, a.regid');
            $this->db->from('master_7_stud_personal a');
            $this->db->join('class_3_class_wise_students b', 'a.regid = b.regid AND b.CLSSESSID ='.$class_session_id);
            $this->db->where('b.SESSID', $prevYear);
            $query = $this->db->get();
            
            if($query->num_rows() != 0){
                $result_ = $query->result();
            } else {
                $result_ = Array();
            }
        }
        //print_r($result_);
        //die();
        return $result_;
    }

    function promote_admit_admission_students($year__){
        $x = $this->input->post('to');
        $promote_students = explode(',',$x);
        $clssessid = $this->input->post('cmbAdmFor');
        $count_ = 0;
        for($i=0; $i<count($promote_students); $i++){
            $this->db->where('SESSID', $year__);
            $this->db->where('regid',$promote_students[$i]);
            $query = $this->db->get('class_3_class_wise_students');
            
            if($query->num_rows() == 0){
                $data = array(
                    'regid' => $promote_students[$i],
                    'ROLLNO'=> 0,
                    'CLSSESSID' => $clssessid,
                    'USERNAME_' => $this -> session -> userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s'),
                    'SESSID' => $year__
                    );
                
                $q = $this->db->insert('class_3_class_wise_students', $data);
                
                if($q == true){
                    $data = array(
                        'STATUS_OF_ADMISSION' => 1,
                    );
                    $this->db->where('regid', $promote_students[$i]);
                    $this->db->update('master_8_stud_academics', $data);    
                }     
                $count_++;
            }
        }
        // Fetching class for printing proper message
        $this->db->where('CLSSESSID', $clssessid);
        $classquery = $this->db->get('class_2_in_session');
        if($classquery->num_rows() != 0){
            $row = $classquery->row();
            $class__ = $row->CLASSID;
            if($count_ > 0){
                $bool_ = array('res_'=>true, 'msg_'=>$count_.' student(s) to Class <span style="background: #ffff00; color: #ff0000; padding: 2px; border-radius: 5px; font-weight: bold">'.$class__.'</span> added successfully.');
            } else {
                $bool_ = array('res_'=>false, 'msg_'=>' Seleted student(s) in class <span style="background: #ffff00; color: #ff0000; padding: 2px; border-radius: 5px; font-weight: bold">'.$class__.'</span> already promoted/ exists.');
            }
        } else {
            $class__ = "-NA-";
            $bool_ = array('res_'=>false, 'msg_'=>'Something goes wrong. Please try again.');
        }
        //-------------------------------------------

        return $bool_;
    }

    function promote_admit_prev_students($year__){
        $x = $this->input->post('to');
        $promote_students = explode(',',$x);
        //$promote_students = $this->input->post('to');
        $clssessid = $this->input->post('cmbAdmFor');

        for($i=0; $i<count($promote_students); $i++){
            
            $this->db->where('SESSID', $year__);
            $this->db->where('regid',$promote_students[$i]);
            $query = $this->db->get('class_3_class_wise_students');

            if($query->num_rows() == 0){
                $data = array(
                    'regid' => $promote_students[$i],
                    'ROLLNO'=> 0,
                    'CLSSESSID' => $clssessid,
                    'USERNAME_' => $this -> session -> userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s'),
                    'SESSID' => $year__
                    );
                $q = $this->db->insert('class_3_class_wise_students', $data);
            }
        }
        // Fetching class for printing proper message
        $this->db->where('CLSSESSID', $clssessid);
        $classquery = $this->db->get('class_2_in_session');
        if($classquery->num_rows() != 0){
            $row = $classquery->row();
            $class__ = $row->CLASSID;
        } else {
            $class__ = "-NA-";
        }
        //-------------------------------------------
        $bool_ = array('res_'=>TRUE, 'msg_'=>'Student(s) for Class <span style="color: #0000ff; font-weight: bold">'.$class__.'</span> are promotted successfully.');

        return $bool_;
    }

    function getStudentsofcurrentSession($year__){
        $clssessid = $this->input->post('ClassSessid_');

        $this->db->select('b.FNAME, b.MNAME, b.LNAME, a.CLSSESSID, a.SESSID, a.regid');
        $this->db->from('class_3_class_wise_students a');
        $this->db->join('master_7_stud_personal b', 'b.regid = a.regid');
        $this->db->where('a.CLSSESSID', $clssessid);
        $this->db->where('a.SESSID', $year__);
        $query = $this->db->get();

        return $query->result();
    }
}