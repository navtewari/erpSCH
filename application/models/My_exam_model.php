<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_exam_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function mgetMarksAssociatedSubject($subjectID){
        $this->db->select('a.*, b.*');
        $this->db->from('master_12_subject a');
        $this->db->join('master_15_subject_marks b', 'a.subjectID=b.subjectID');
        $this->db->where('a.sessID', $this->session->userdata('_current_year___'));
        $this->db->where('b.subjectID', $subjectID);
        
        $query = $this->db->get();
        
       /* $this->db->where('subjectID', $subjectID);
        $this->db->from('master_15_subject_marks');       
        $query = $this->db->get();*/
        return $query->result();
    }
    
    function mdeleteAssoicatedSubjectMarks($marksID){
         $this->db->where('submarkID', $marksID);
        $query = $this->db->delete('master_15_subject_marks');

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Marks Deleted Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }
    
}