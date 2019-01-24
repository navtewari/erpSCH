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

    function updateScholasticItem() {
        $data = $this->mem->mupdateScholasticItem();
        echo json_encode($data);
    }

    function delete_Scholastic($scholasticID) {
        $data = $this->mem->mdelete_Scholastic($scholasticID);
        echo json_encode($data);
    }

    function get_class_scholastic_in_session($classID) {
        $data['scholasticinclass'] = $this->mem->mget_class_scholastic_in_session($classID);
        echo json_encode($data);
    }

    function AddScholastictoClass($classsessID) {
        $data = $this->mem->massociateScholastic_with_class($classsessID);
        echo json_encode($data);
    }

    function delAssociated_scholastic_class($assocID) {
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

    function delete_coScholastic($coscholasticID) {
        $data = $this->mem->mdelete_coScholastic($coscholasticID);
        echo json_encode($data);
    }

    function get_coScholastic_for_update($coscholasticID) {
        $data['coScholasticitem'] = $this->mem->mget_coScholastic_for_update($coscholasticID);
        echo json_encode($data);
    }

    function get_class_coscholastic_in_session($classID) {
        $data['coscholasticinclass'] = $this->mem->mget_class_coscholastic_in_session($classID);
        echo json_encode($data);
    }

    function AddcoScholastictoClass($classsessID) {
        $data = $this->mem->mAddcoScholastictoClass($classsessID);
        echo json_encode($data);
    }

    function setSchoPriority($schoID, $priority) {
        $data = $this->mem->msetSchoPriority($schoID, $priority);
        echo json_encode($data);
    }

    function setcoSchoPriority($coschoID, $priority) {
        $data = $this->mem->msetcoSchoPriority($coschoID, $priority);
        echo json_encode($data);
    }

    function delAssociated_coscholastic_class($assocID) {
        $data = $this->mem->mdelAssociated_coscholastic_class($assocID);
        echo json_encode($data);
    }

    function setdisciplinePriority($disciplineID, $priority) {
        $data = $this->mem->msetdisciplinePriority($disciplineID, $priority);
        echo json_encode($data);
    }

    function getAllDisciplineItems() {
        $data['Discipline'] = $this->mem->mgetAllDisciplineItems();
        echo json_encode($data);
    }

    function submitDisciplineItem() {
        $data = $this->mem->msubmitDisciplineItem();
        echo json_encode($data);
    }

    function delete_discipline($disciplineID) {
        $data = $this->mem->mdelete_discipline($disciplineID);
        echo json_encode($data);
    }

    function get_class_discipline_in_session($classID) {
        $data['disciplineinclass'] = $this->mem->mget_class_discipline_in_session($classID);
        echo json_encode($data);
    }

    function AddDisciplinetoClass($classsessID) {
        $data = $this->mem->mAddDisciplinetoClass($classsessID);
        echo json_encode($data);
    }

    function delAssociated_discipline_class($assocID) {
        $data = $this->mem->mdelAssociated_discipline_class($assocID);
        echo json_encode($data);
    }

    function get_examterm_in_session() {
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

    function get_discipline_item_classwise($classID) {
        $data['disciplineItem'] = $this->mem->mget_discipline_item_classwise($classID);
        echo json_encode($data);
    }

    function getstudentsforclass($classID, $assmID, $assID = 0) {
        if ($assmID == 1) {
            $res_ = $this->mem->mcheckData_entry_result();
        } else if ($assmID == 2) {
            $res_ = $this->mem->mcheckcoSchData_entry_result();
        } else if ($assmID == 3) {
            $res_ = $this->mem->mcheckdisciplineData_entry_result();
        }

        $data['res_'] = '';

        $maxMarks = 0;
        if ($assID != 0) {
            $data['maxMarks'] = $this->mem->get_maxMarks_in_assessmentarea($assID);
        }

        if ($res_['res_'] == FALSE) {
            $data['res_'] = $res_['msg_'];
            $data['studentdata'] = $this->mem->mget_students_in_class_with_marks($classID);
        } else {
            $data['studentdata'] = $this->mem->mget_students_in_class($classID);
        }
        echo json_encode($data);
    }

    function inputResult() {
        $data = $this->mem->minputResult();
        echo json_encode($data);
    }

    function updateInputResult() {
        $data = $this->mem->mupdateInputResult();
        echo json_encode($data);
    }

    function get_student_for_result($classID) {
        $data['checkRemarks'] = $this->mem->checkStudentRemarks($classID);
        $data['studentdata'] = $this->mem->mget_students_in_class_for_remarks($classID);
        echo json_encode($data);
    }

    function submitRemarks($clssessid) {
        $data = $this->mem->mSubmitRemarks($clssessid);
        echo json_encode($data);
    }

    function updateRemarks($clssessid) {
        $data = $this->mem->mUpdateRemarks($clssessid);
        echo json_encode($data);
    }

    function fetchResult($classSessID = 0, $regID = 0, $reportlayout = 0, $sidelayout = 0, $classID = 0, $pagi = 0) {
        if ($pagi == 0) {
            $classSessID = $this->input->post('classSessHiddenID');
            $regID = $this->input->post('stuHiddenID');
            $reportlayout = $this->input->post('reportLayout');
            $sidelayout = $this->input->post('sideLayout');
        }
        $this->check_login();
        $classID = $this->mem->mcheckClassID($classSessID);
        $data['regID_'] = $regID;
        $data['classID'] = $classID;
        $data['session'] = array($this->session->userdata('_current_year___'));
        if ($regID == 0) {
            $pagi = 1;
            $config = array();
            $config["base_url"] = base_url() . "index.php/exam/fetchResult" . "/" . $classSessID . "/" . $regID . "/" . $reportlayout . "/" . $sidelayout . "/" . $classID . "/" . $pagi;
            $config["total_rows"] = count($this->mem->mfetchStuDatainClass($classSessID));
            $config["per_page"] = 10;
            $config["uri_segment"] = 9;
            $choice = $config["total_rows"] / $config["per_page"];

            $config["num_links"] = round($choice);
            $config['full_tag_open'] = '<ul class="pagination pagination-lg">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';


            $this->pagination->initialize($config);
            $page = ($this->uri->segment(9)) ? $this->uri->segment(9) : 0;
            $data['student_per_data'] = $this->mem->mfetchStuDatainClassLimitwise($classSessID, $config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
        } else {
            $data['student_per_data'] = $this->mem->mfetchStuPerData($regID);
        }
        $data['exam_term'] = $this->mem->mget_examterm_in_session();
        $data['term_class'] = $this->mem->mfetchterm_class($classSessID, $this->session->userdata('_current_year___'));
        $data['sch_data_class'] = $this->mem->mfetchScholasticClassWise($classSessID, $this->session->userdata('_current_year___'));
        $data['cosch_data_class'] = $this->mem->mfetchcoScholasticClassWise($classSessID, $this->session->userdata('_current_year___'));
        $data['discipline_data_class'] = $this->mem->mfetchdisciplineClassWise($classSessID, $this->session->userdata('_current_year___'));
        $data['subject_class'] = $this->mem->mfetchSubClassWise($classID, $this->session->userdata('_current_year___'));

        $data['subject_marks'] = $this->mem->mfetchSubMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['coSch_marks'] = $this->mem->mcoSchMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['discipline_marks'] = $this->mem->mdisciplineMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['teacher_remarks'] = $this->mem->checkregIDRemark($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['class_grade'] = $this->mem->get_grade_in_class($classSessID);
        $data['overall_result'] = $this->mem->get_overall_result_in_class($regID, $classSessID);

        //$data['sch_data'] = $this->mem->mfetchScholasticResult($regID, $this->session->userdata('_current_year___'), $classID, $classSessID);
        $data['sch_name'] = $this->session->userdata('sch_name');
        $data['sch_remark'] = $this->session->userdata('remark');
        $data['sch_logo'] = $this->session->userdata('logo');
        $data['sch_addr'] = $this->session->userdata('sch_addr');
        $data['sch_contact'] = $this->session->userdata('sch_contact');
        $data['sch_email'] = $this->session->userdata('sch_email');
        $data['sch_distt'] = $this->session->userdata('sch_distt');
        $data['sch_state'] = $this->session->userdata('sch_state');
        $data['sch_country'] = $this->session->userdata('sch_country');
        $data['website'] = $this->session->userdata('website');
        $data['reg_id'] = $regID;

        if ($reportlayout == 1 && $sidelayout == 1) {
            $this->load->view('exam/printResult-1to8-1', $data);
        } else if ($reportlayout == 2 && $sidelayout == 1) {
            $this->load->view('exam/printResult-9-1', $data);
        } else if ($reportlayout == 1 && $sidelayout == 2) {
            $this->load->view('exam/printResult-1to8', $data);
        } else if ($reportlayout == 2 && $sidelayout == 2) {
            $this->load->view('exam/printResult-9', $data);
        } else if ($reportlayout == 3 && $sidelayout == 2) {
            $this->load->view('exam/printResult-lkg', $data);
        }else {
            die();
        }
    }

    function fetchResult1() {
        $classSessID = $this->input->post('classSessHiddenID');
        $regID = $this->input->post('stuHiddenID');
        $reportlayout = $this->input->post('reportLayout');
        $sidelayout = $this->input->post('sideLayout');

        $this->check_login();
        $classID = $this->mem->mcheckClassID($classSessID);
        $data['classID'] = $classID;
        $data['session'] = array($this->session->userdata('_current_year___'));
        if ($regID == 0) {
            $data['student_per_data'] = $this->mem->mfetchStuDatainClass($classSessID);
        } else {
            $data['student_per_data'] = $this->mem->mfetchStuPerData($regID);
        }
        $data['exam_term'] = $this->mem->mget_examterm_in_session();
        $data['term_class'] = $this->mem->mfetchterm_class($classSessID, $this->session->userdata('_current_year___'));
        $data['sch_data_class'] = $this->mem->mfetchScholasticClassWise($classSessID, $this->session->userdata('_current_year___'));
        $data['cosch_data_class'] = $this->mem->mfetchcoScholasticClassWise($classSessID, $this->session->userdata('_current_year___'));
        $data['discipline_data_class'] = $this->mem->mfetchdisciplineClassWise($classSessID, $this->session->userdata('_current_year___'));
        $data['subject_class'] = $this->mem->mfetchSubClassWise($classID, $this->session->userdata('_current_year___'));

        $data['subject_marks'] = $this->mem->mfetchSubMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['coSch_marks'] = $this->mem->mcoSchMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['discipline_marks'] = $this->mem->mdisciplineMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['teacher_remarks'] = $this->mem->checkregIDRemark($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['class_grade'] = $this->mem->get_grade_in_class($classSessID);
        $data['overall_result'] = $this->mem->get_overall_result_in_class($regID, $classSessID);

        //$data['sch_data'] = $this->mem->mfetchScholasticResult($regID, $this->session->userdata('_current_year___'), $classID, $classSessID);
        $data['sch_name'] = $this->session->userdata('sch_name');
        $data['sch_remark'] = $this->session->userdata('remark');
        $data['sch_logo'] = $this->session->userdata('logo');
        $data['sch_addr'] = $this->session->userdata('sch_addr');
        $data['sch_contact'] = $this->session->userdata('sch_contact');
        $data['sch_email'] = $this->session->userdata('sch_email');
        $data['sch_distt'] = $this->session->userdata('sch_distt');
        $data['sch_state'] = $this->session->userdata('sch_state');
        $data['sch_country'] = $this->session->userdata('sch_country');
        $data['website'] = $this->session->userdata('website');
        $data['reg_id'] = $regID;

        if ($reportlayout == 1 && $sidelayout == 1) {
            $this->load->view('exam/printResult-1to8-1', $data);
        } else if ($reportlayout == 2 && $sidelayout == 1) {
            $this->load->view('exam/printResult-9-1', $data);
        } else if ($reportlayout == 1 && $sidelayout == 2) {
            $this->load->view('exam/printResult-1to8', $data);
        } else if ($reportlayout == 2 && $sidelayout == 2) {
            $this->load->view('exam/printResult-9', $data);
        } else {
            die();
        }
    }

    function calculateResult($classSessID) {
        $this->check_login();
        $data = $this->mem->mcalculateResult($classSessID);
        echo json_encode($data);
    }

    function frontPrint($classSessID = 0, $regID = 0, $reportlayout=0, $classID = 0, $pagi = 0, $print_ = 0) {
        $this->check_login();
        if ($pagi == 0) {            
            $classSessID = $this->input->post('classSessHiddenID');
            $regID = $this->input->post('stuHiddenID');
            $reportlayout = $this->input->post('reportLayout');
            $classID = $this->mem->mcheckClassID($classSessID);
        }
        $data['classID'] = $classID;
        $data['classSessID'] = $classSessID;        
        $data['session'] = array($this->session->userdata('_current_year___'));
        if ($regID == 0) {
            //$data['student_per_data'] = $this->mem->mfetchStuDatainClass($classSessID);
            $pagi = 1;
            $config = array();
            $config["base_url"] = base_url() . "index.php/exam/frontPrint" . "/" . $classSessID . "/" . $regID . "/". $reportlayout . "/" . $classID . "/" . $pagi . "/".$print_ ;
            $config["total_rows"] = count($this->mem->mfetchStuDatainClass($classSessID));
            $config["per_page"] = 10;
            $config["uri_segment"] = 9;
            $choice = $config["total_rows"] / $config["per_page"];

            $config["num_links"] = round($choice);
            $config['full_tag_open'] = '<ul class="pagination pagination-lg">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';


            $this->pagination->initialize($config);
            $page = ($this->uri->segment(9)) ? $this->uri->segment(9) : 0;
            $data['startLimit'] = $page;
            $data['per_page'] = $config["per_page"];
            $data['student_per_data'] = $this->mem->mfetchStuDatainClassLimitwise($classSessID, $config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
        } else {
            $data['startLimit'] = 1;
            $data['per_page']=1;
            $data['student_per_data'] = $this->mem->mfetchStuPerData($regID);
        }
        
        $data['exam_term'] = $this->mem->mget_examterm_in_session();
        $data['term_class'] = $this->mem->mfetchterm_class($classSessID, $this->session->userdata('_current_year___'));
        $data['subject_class'] = $this->mem->mfetchSubClassWise($classID, $this->session->userdata('_current_year___'));

        $data['class_grade'] = $this->mem->get_grade_in_class($classSessID);
        $data['overall_result'] = $this->mem->get_overall_result_in_class($regID, $classSessID);
        $data['subject_marks'] = $this->mem->mfetchSubMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['sch_name'] = $this->session->userdata('sch_name');
        $data['sch_remark'] = $this->session->userdata('remark');
        $data['sch_logo'] = $this->session->userdata('logo');
        $data['sch_addr'] = $this->session->userdata('sch_addr');
        $data['sch_contact'] = $this->session->userdata('sch_contact');
        $data['sch_email'] = $this->session->userdata('sch_email');
        $data['sch_distt'] = $this->session->userdata('sch_distt');
        $data['sch_state'] = $this->session->userdata('sch_state');
        $data['sch_country'] = $this->session->userdata('sch_country');
        $data['website'] = $this->session->userdata('website');

        $data['reg_id'] = $regID;
        if ($print_ == 0) {            
            if($reportlayout==1){
                $this->load->view('exam/printResult-front', $data);
            }else if($reportlayout==2){
                $this->load->view('exam/printResult-front-lkg', $data);
            }else{
                echo json_encode($data);
            }
        } elseif ($print_ == 1) {
            echo json_encode($data);
        }
    }
    
    function frontPrintGraph($classSessID , $regID, $print_, $pagelimit, $start) {
        $this->check_login();        
        $classID = $this->mem->mcheckClassID($classSessID);        
        $data['classID'] = $classID;
        $data['classSessID'] = $classSessID;
        $data['session'] = array($this->session->userdata('_current_year___'));
        
        if ($regID == 0) {
            $data['student_per_data'] = $this->mem->mfetchStuDatainClassLimitwise($classSessID,$pagelimit,$start);            
        } else {
            $data['student_per_data'] = $this->mem->mfetchStuPerData($regID);
        }
        $data['exam_term'] = $this->mem->mget_examterm_in_session();
        $data['term_class'] = $this->mem->mfetchterm_class($classSessID, $this->session->userdata('_current_year___'));
        $data['subject_class'] = $this->mem->mfetchSubClassWise($classID, $this->session->userdata('_current_year___'));

        $data['class_grade'] = $this->mem->get_grade_in_class($classSessID);
        $data['overall_result'] = $this->mem->get_overall_result_in_class($regID, $classSessID);
        $data['subject_marks'] = $this->mem->mfetchSubMarks($regID, $classSessID, $this->session->userdata('_current_year___'));
        $data['sch_name'] = $this->session->userdata('sch_name');
        $data['sch_remark'] = $this->session->userdata('remark');
        $data['sch_logo'] = $this->session->userdata('logo');
        $data['sch_addr'] = $this->session->userdata('sch_addr');
        $data['sch_contact'] = $this->session->userdata('sch_contact');
        $data['sch_email'] = $this->session->userdata('sch_email');
        $data['sch_distt'] = $this->session->userdata('sch_distt');
        $data['sch_state'] = $this->session->userdata('sch_state');
        $data['sch_country'] = $this->session->userdata('sch_country');
        $data['website'] = $this->session->userdata('website');

        $data['reg_id'] = $regID;
        if ($print_ == 0) {
            $this->load->view('exam/printResult-front', $data);
        } elseif ($print_ == 1) {
            echo json_encode($data);
        }
    }

    function check_login() {
        if (!$this->session->userdata('_user___')) {
            redirect('login/logout');
        }
    }

}
