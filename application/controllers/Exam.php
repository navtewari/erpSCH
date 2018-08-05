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
    
    function get_class_scholastic_in_session($classID){
        $data['scholasticinclass'] = $this->mem->mget_class_scholastic_in_session($classID);
        echo json_encode($data);
    }
    
    function AddScholastictoClass($classsessID){
        $data = $this->mem->massociateScholastic_with_class($classsessID);
        echo json_encode($data);
    }
    
    function delAssociated_scholastic_class($assocID){
        $data = $this->mem->mdelAssociated_scholastic_class($assocID);
        echo json_encode($data);
    }
    
    function getAllCoScholasticItems() {
        $data['CoScholastic'] = $this->mem->mgetAllCoScholasticItems();
        echo json_encode($data);
    }

    function submitCoScholasticItem() {
        $data = $this->mem->msubmitCoScholasticItem();
        echo json_encode($data);
    }
    
    function delete_coScholastic($coscholasticID){
        $data = $this->mem->mdelete_coScholastic($coscholasticID);
        echo json_encode($data);
    }
    
    function get_coScholastic_for_update($coscholasticID) {
        $data['coScholasticitem'] = $this->mem->mget_coScholastic_for_update($coscholasticID);
        echo json_encode($data);
    }    
    
    function get_class_coscholastic_in_session($classID){
        $data['coscholasticinclass'] = $this->mem->mget_class_coscholastic_in_session($classID);
        echo json_encode($data);
    }
    
    function AddcoScholastictoClass($classsessID){
        $data = $this->mem->mAddcoScholastictoClass($classsessID);
        echo json_encode($data);
    }
    
    function setSchoPriority($schoID, $priority){
        $data = $this->mem->msetSchoPriority($schoID, $priority);
        echo json_encode($data);
    }
    
    function setcoSchoPriority($coschoID, $priority){
        $data = $this->mem->msetcoSchoPriority($coschoID, $priority);
        echo json_encode($data);
    }
    
    function get_examterm_in_session(){
        $data['examTerm'] = $this->mem->mget_examterm_in_session();
        echo json_encode($data);
    }
    
    function create_term() {
        $data = $this->mem->mcreate_term();
        echo json_encode($data);
    }

    function deleteTerm($termID) {
        $data = $this->mem->mdeleteTerm($termID);
        echo json_encode($data);
    }
    
    function get_scholastic_item_classwise($classID) {
        $data['scholasticItem'] = $this->mem->mget_scholastic_item_classwise($classID);
        echo json_encode($data);
    }

    function get_coscholastic_item_classwise($classID) {
        $data['coscholasticItem'] = $this->mem->mget_coscholastic_item_classwise($classID);
        echo json_encode($data);
    }
    
    function getstudentsforclass(){
        
    }
}
