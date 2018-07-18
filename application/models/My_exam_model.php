<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_exam_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function mgetMarksAssociatedSubject($subjectID, $classID){
        $this->db->select('a.*, b.*');
        $this->db->from('master_12_subject a');
        $this->db->join('master_15_subject_marks b', 'a.subjectID=b.subjectID');
        $this->db->where('a.sessID', $this->session->userdata('_current_year___'));
        $this->db->where('a.classID', $classID);
        
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
    
    function msubmitMarksAssociatedSubject() {
        $subjectID_ = trim($this->input->post('cmbSubject'));       
        $maxMarks_ = trim($this->input->post('txtmaxMarks'));
        $passMArks_ = trim($this->input->post('txtpassMarks'));        

        $this->db->where('subjectID', $subjectID_);
        $query = $this->db->get('master_15_subject_marks');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Sorry! Marks already associated for selected Subject.');
        } else {
            $data = array(
                'subjectID' => $subjectID_,
                'maxMarks' => $maxMarks_,
                'passMarks' => $passMArks_                
            );
            $query = $this->db->insert('master_15_subject_marks', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Marks associated successfully.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or Marks already associated for selected Subject. Please check and try again.');
            }
        }

        return $bool_;
    }
    
    function mgetAllScholasticItems(){        
        $this->db->from('exam_1_scholastic_items');       
        $query = $this->db->get();
        return $query->result();
    }
    
}