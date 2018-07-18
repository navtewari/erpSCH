<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_model', 'mm');
        $this->load->model('my_exam_model', 'mem');
    }

    function getMarksAssociatedSubject($subjectID, $classID) {
        $data['Subject_marks'] = $this->mem->mgetMarksAssociatedSubject($subjectID, $classID);
        echo json_encode($data);
    }

    function deleteAssoicatedSubjectMarks($marksID) {
        $data = $this->mem->mdeleteAssoicatedSubjectMarks($marksID);
        echo json_encode($data);
    }

    function submitMarksAssociatedSubject() {
        $data = $this->mem->msubmitMarksAssociatedSubject();
        echo json_encode($data);
    }

    function getAllScholasticItems() {
        $data['Scholastic'] = $this->mem->mgetAllScholasticItems();
        echo json_encode($data);
    }

    function submitScholasticItem() {
        $data = $this->mem->msubmitScholasticItem();
        echo json_encode($data);
    }

    function get_Scholastic_for_update($scholasticID) {
        $data['Scholasticitem'] = $this->mem->mget_Scholastic_for_update($scholasticID);
        echo json_encode($data);
    }
    
    function updateScholasticItem(){
        $data = $this->mem->mupdateScholasticItem();
        echo json_encode($data);
    }
    
    function delete_Scholastic($scholasticID){
        $data = $this->mem->mdelete_Scholastic($scholasticID);
        echo json_encode($data);
    }

}
