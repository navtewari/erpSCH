<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_exam_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
        $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function mgetMarksAssociatedSubject($subjectID, $classID) {
        $this->db->select('a.*, b.*');
        $this->db->from('master_12_subject a');
        $this->db->join('master_15_subject_marks b', 'a.subjectID=b.subjectID');
        $this->db->where('a.sessID', $this->session->userdata('_current_year___'));
        $this->db->where('a.classID', $classID);

        $query = $this->db->get();

        /* $this->db->where('subjectID', $subjectID);
          $this->db->from('master_15_subject_marks');
          $query = $this->db->get(); */
        return $query->result();
    }

    function mdeleteAssoicatedSubjectMarks($marksID) {
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

    function mgetAllScholasticItems() {
        $this->db->from('exam_1_scholastic_items');
        $query = $this->db->get();
        return $query->result();
    }

    function msubmitScholasticItem() {
        $schlasticItem = $this->input->post('txtScholasticItem');
        $maxMarks = $this->input->post('txtScholasticMarks');

        $this->db->where('item', $schlasticItem);
        $query = $this->db->get('exam_1_scholastic_items');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => ' This Scholastic Item already present');
        } else {
            $data = array(
                'item' => $schlasticItem,
                'maxMarks' => $maxMarks
            );

            $query = $this->db->insert('exam_1_scholastic_items', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Scholastic Item Inserted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mget_Scholastic_for_update($scholasticID) {
        $this->db->where('itemID', $scholasticID);
        $query = $this->db->get('exam_1_scholastic_items');
        return $query->result();
    }

    function mupdateScholasticItem() {
        $schlasticItem = $this->input->post('txtScholasticItem_edit');
        $schlasticID = $this->input->post('ScholasticID_Edit');
        $maxMarks = $this->input->post('txtScholasticMarks_edit');

        $this->db->where('itemID', $schlasticID);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query1 = $this->db->get('exam_2_add_scholastic_to_class');
        //echo $this->db->last_query()."<br />";
        //exit();

        if ($query1->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => '!! This Scholastic Item is already Associated with Class Therefore Cannot be Updated !!');
        } else {
            $data = array(
                'item' => $schlasticItem,
                'maxMarks' => $maxMarks
            );

            $this->db->where('itemID', $schlasticID);
            $query = $this->db->update('exam_1_scholastic_items', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Scholastic Item Updated Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }
    
    function mdelete_Scholastic($scholasticID){
        $this->db->where('itemID', $scholasticID);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query1 = $this->db->get('exam_2_add_scholastic_to_class');

        if ($query1->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => '!! This Scholastic Item is already Associated with Class Therefore Cannot be deleted !!');
        } else {
            $this->db->where('itemID', $scholasticID);
            $query = $this->db->delete('exam_1_scholastic_items');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Scholastic Item Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }

        return $bool_;
    }

}
