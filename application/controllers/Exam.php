<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database(_DATABASE_);
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

}
