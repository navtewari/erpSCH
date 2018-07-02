<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_Master_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }

    function getsession_() {
        $this->db->order_by('SESSSTART', 'desc');
        $this->db->from('master_6_session');
        $query = $this->db->get();

        return $query->result();
    }

    function mcreate_session() {
        $startYear = $this->input->post('startYear');
        $endYear = $this->input->post('endYear');

        $idStart = explode('-', $startYear);
        $idEnd = explode('-', $endYear);

        $sessionID = $idStart[2] . "-" . substr($idEnd[2], -2);

        $this->db->where('SESSID', $sessionID);
        $query = $this->db->get('master_6_session');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => $sessionID . ' Session already created');
        } else {
            $data = array(
                'SESSID' => $sessionID,
                'SESSSTART' => $startYear,
                'SESSEND' => $endYear
            );

            $query = $this->db->insert('master_6_session', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Session created Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdelete_session($sessID) {
        $this->db->where('SESSID', $sessID);
        $query = $this->db->get('class_2_in_session');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Classes Already Associated with ' . $sessID . '. Therefore it can not be deleted');
        } else {
            $this->db->where('SESSID', $sessID);
            $query = $this->db->delete('master_6_session');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Session Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function getclasses_() {
        $this->db->order_by('ABS(CLASS)');
        $this->db->order_by('SECTION', 'asc');
        $query = $this->db->get('class_1_classes');
        return $query->result();
    }

    function mdelete_class($classID) {
        $this->db->where('CLASSID', $classID);
        $query = $this->db->get('class_2_in_session');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Class ' . $classID . ' is already Associated with Session. Therefore it can not be deleted');
        } else {
            $this->db->where('CLASSID', $classID);
            $query = $this->db->delete('class_1_classes');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Class Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mcreate_class() {
        $class_ = trim($this->input->post('txtAddClass_'));
        $section_ = trim($this->input->post('cmbClassSection'));
        $class_id_ = $class_ . ($section_ != '-' ? $section_ : '');

        $this->db->where('CLASSID', $class_id_);
        $query = $this->db->get('class_1_classes');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Sorry! Class <span style="color: #0000ff; font-weight: bold">' . $class_id_ . '</span> is already exists.');
        } else {
            $data = array(
                'CLASSID' => $class_id_,
                'CLASS' => $class_,
                'SECTION' => $section_,
                'DATE_' => date('Y-m-d H:i:s')
            );
            $query = $this->db->insert('class_1_classes', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Class <span style="color: #0000ff; font-weight: bold">' . $class_id_ . '</span> added successfully.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or class <span style="color: #0000ff; font-weight: bold">' . $class_id_ . '</span> is already exists. Please check and try again.');
            }
        }

        return $bool_;
    }

    function mget_Class_for_update($classid) {
        $this->db->where('CLASSID', $classid);
        $query = $this->db->get('class_1_classes');
        return $query->result();
    }

    function mupdate_Class($classID) {
        $this->db->where('CLASSID', $classID);
        $query = $this->db->get('class_2_in_session');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Class ' . $classID . ' is already Associated with Session. Therefore it can not be Updated');
        } else {
            $class_ = trim($this->input->post('txtEditClass_'));
            $section_ = trim($this->input->post('cmbEditSection'));
            $class_id_ = $class_ . ($section_ != '-' ? $section_ : '');

            $this->db->where('CLASSID', $class_id_);
            $query = $this->db->get('class_1_classes');

            if ($query->num_rows() != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Sorry! Class <span style="color: #0000ff; font-weight: bold">' . $class_id_ . '</span> is already exists.');
            } else {
                $data = array(
                    'CLASSID' => $class_id_,
                    'CLASS' => $class_,
                    'SECTION' => $section_,
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $this->db->where('CLASSID', $classID);
                $query = $this->db->update('class_1_classes', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Class <span style="color: #0000ff; font-weight: bold">' . $class_id_ . '</span> Updated successfully.');
                } else {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or class <span style="color: #0000ff; font-weight: bold">' . $class_id_ . '</span> is already exists. Please check and try again.');
                }
            }
        }
        return $bool_;
    }

    function get_totalClass_not_present_in_current_session($year__) {
        $this->db->order_by('ABS(a.CLASS)', 'asc');
        $this->db->order_by('a.SECTION', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes a');
        $this->db->join('class_2_in_session b', 'a.CLASSID=b.CLASSID AND b.SESSID="' . $year__ . '"', 'left');
        $this->db->where('b.CLASSID', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    function get_totalClass_in_current_session($year__) {
        /*
          Below query having join retrieves
          the data PRRESENT in table 'a' [class_2_in_session]
          but NOT PRRESENT in table 'b' [class_3_class_wise_students]
          AND
          if data PRRESENT in class_3_class_wise_students 'b'
          than it will not retrieve in this query from table 'a' [class_2_in_session].
         */
        $this->db->order_by('ABS(x.CLASS)', 'asc');
        $this->db->order_by('x.SECTION', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->join('class_3_class_wise_students b', 'a.CLSSESSID = b.CLSSESSID', 'left outer');
        $this->db->where('b.CLSSESSID IS NULL');
        $this->db->where('a.SESSID = "' . $year__ . '"');
        $this->db->order_by('a.CLASSID');
        $this->db->distinct();
        $query = $this->db->get();
        return $query->result();
    }

    function get_Classes_in_current_session($year__) {
        $this->db->order_by('ABS(x.CLASS)', 'asc');
        $this->db->order_by('x.SECTION', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->where('a.SESSID = "' . $year__ . '"');
        $this->db->order_by('a.CLASSID');
        $this->db->distinct();
        $query = $this->db->get();
        return $query->result();
    }

    function used_classes_($year__) {
        /*
          Below query having join retrieves
          ONLY the COMMON data PRRESENT in table a [class_2_in_session]
          and ALSO PRRESENT in table b [class_3_class_wise_students].
         */
        $this->db->order_by('ABS(x.CLASS)', 'asc');
        $this->db->order_by('x.SECTION', 'asc');
        $this->db->select('a.*');
        $this->db->from('class_1_classes x');
        $this->db->join('class_2_in_session a', 'x.CLASSID=a.CLASSID');
        $this->db->join('class_3_class_wise_students b', 'a.CLSSESSID=b.CLSSESSID AND a.SESSID="' . $year__ . '"');
        $this->db->order_by('a.CLASSID');
        $this->db->distinct();
        $query = $this->db->get();
        return $query->result();
    }

    function set_Class_in_Session($year__) {
        $count_list = $this->input->post('to');

        $this->db->where('SESSID', $year__);
        $query = $this->db->get('class_2_in_session');

        if ($query->num_rows() != 0) {

            $query = $this->db->query("DELETE FROM class_2_in_session WHERE SESSID ='" . $year__ . "' AND CLSSESSID NOT IN (SELECT CLASS_OF_ADMISSION FROM master_8_stud_academics) and CLSSESSID NOT IN (SELECT CLSSESSID FROM class_3_class_wise_students)");

            $bool_ = $this->insert_classes_in_session($count_list, $year__);
        } else {
            $bool_ = $this->insert_classes_in_session($count_list, $year__);
        }

        return $bool_;
    }

    function insert_classes_in_session($class_list, $year__) {
        $bool_ = false;
        $count_ = 0;
        $class_updated = '';
        foreach ($class_list as $item) {
            $this->db->where('CLASSID', $item);
            $this->db->where('SESSID', $year__);
            $query = $this->db->get('class_2_in_session');
            if($query->num_rows() == 0){
                $data = array(
                    'CLASSID' => $item,
                    'SESSID' => $year__,
                    'DATE_' => date('Y-m-d H:i:s'),
                    'STATUS_' => 1
                );
                $query = $this->db->insert('class_2_in_session', $data);
                if ($query == TRUE) {
                    if($class_updated !=''){
                        $class_updated = $class_updated . ", " . $item;
                    } else {
                        $class_updated = $item;
                    }
                    $count_++;
                }
            }
        }
        if($count_ != 0){
            $bool_ = array('res_' => TRUE, 'msg_' => 'Record successfully updated.<br>'.$class_updated);
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or class <span style="color: #0000ff; font-weight: bold"> </span> is already exists. Please check and try again.');
        }

        return $bool_;
    }

    function get_grade_in_class($classSessID) {
        $this->db->where('clssessID', $classSessID);
        $query = $this->db->get('master_11_grading');
        return $query->result();
    }

    function mcreate_grading() {
        $classessID = $this->input->post('cmbClassofGrading');
        $minM = $this->input->post('minMarks');
        $maxM = $this->input->post('maxMarks');
        $grade = $this->input->post('txtGrade');
        $desc = $this->input->post('txtDesc');

        $this->db->where('clssessID', $classessID);
        $this->db->where('minMarks', $minM);
        $this->db->where('maxMarks', $maxM);
        $query = $this->db->get('master_11_grading');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'This Grade is already present for Class');
        } else {
            $data = array(
                'minMarks' => $minM,
                'maxMarks' => $maxM,
                'grade' => $grade,
                'description' => $desc,
                'clssessID' => $classessID
            );

            $query = $this->db->insert('master_11_grading', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Grade created Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdelete_grade($gID) {
        $this->db->where('gradeID', $gID);
        $query = $this->db->delete('master_11_grading');

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Grade Deleted Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mget_grade_for_update($gID) {
        $this->db->where('gradeID', $gID);
        $query = $this->db->get('master_11_grading');
        return $query->result();
    }

    function mupdate_grading() {
        $gID = $this->input->post('gradeID_Edit');
        $classessID = $this->input->post('classID_Edit');
        $minM = $this->input->post('minMarks_Edit');
        $maxM = $this->input->post('maxMarks_Edit');
        $grade = $this->input->post('txtGrade_Edit');
        $desc = $this->input->post('txtDesc_Edit');


        $data = array(
            'minMarks' => $minM,
            'maxMarks' => $maxM,
            'grade' => $grade,
            'description' => $desc,
        );

        $this->db->where('gradeID', $gID);
        $query = $this->db->update('master_11_grading', $data);

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Grade Updated Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }
        return $bool_;
    }

    function get_subject_in_class($classID) {
        $this->db->where('classID', $classID);
        $this->db->order_by('subName', 'Asc');
        $this->db->order_by('status', 'desc');
        $query = $this->db->get('master_12_subject');
        return $query->result();
    }

    function mcreate_subject() {
        $classID = $this->input->post('subClassID');
        $subName = $this->input->post('txtSubject');
        $stTH = $this->input->post('chkSubStatusTH');
        $stPR = $this->input->post('chkSubStatusPR');

        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('classID', $classID);

        $this->db->where('subName', $subName);
        if ($stTH != '' && $stPR == '') {
            $whereQ = "status='$stTH'";
            $status = $stTH;
        } else if ($stPR != '' && $stTH == '') {
            $whereQ = "status='$stPR'";
            $status = $stPR;
        } else if ($stTH != '' && $stPR != '') {
            $whereQ = "(status='$stTH' OR status='$stPR')";
            $status = 1;
        }

        $this->db->where($whereQ);
        $query = $this->db->get('master_12_subject');
        // echo $this->db->last_query();
        // echo "<br>".$query->num_rows();
        // exit();


        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'This Subject with selected status already present for this Class');
        } else {

            if ($status != 1) {
                $data = array(
                    'subName' => $subName,
                    'classID' => $classID,
                    'status' => $status,
                    'SESSID' => $this->session->userdata('_current_year___')
                );

                $query = $this->db->insert('master_12_subject', $data);
            } else {
                //theory--------------------------------------------------
                $data = array(
                    'subName' => $subName,
                    'classID' => $classID,
                    'status' => $stTH,
                    'SESSID' => $this->session->userdata('_current_year___')
                );

                $query = $this->db->insert('master_12_subject', $data);

                //practical-----------------------------------------------
                $data = array(
                    'subName' => $subName,
                    'classID' => $classID,
                    'status' => $stPR,
                    'SESSID' => $this->session->userdata('_current_year___')
                );

                $query = $this->db->insert('master_12_subject', $data);
            }

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Subject created Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdelete_subject($sID) {
        $this->db->where('subjectID', $sID);
        $query1 = $this->db->get('exam_6_scholastic_result');

        if ($query1->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Result already associated with this Subject therefore cannot be Deleted');
        } else {
            $this->db->where('subjectID', $sID);
            $query = $this->db->delete('master_12_subject');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Subject Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function getAll_teacher($catID) {
        $this->db->where('CATEGORY_ID', $catID);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('master_13_staff');
        return $query->result();
    }

    function mgetExistingStaffCategory() {
        $this->db->order_by('STATUS', 'asc');
        $query = $this->db->get('master_5_user_status');
        return $query->result();
    }

    function getAll_existingteacher() {
        $this->db->where('STATUS_', 1);
        $this->db->where('CATEGORY_ID', 'fc');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('master_13_staff');
        return $query->result();
    }

    function mcreate_teacher() {
        $catID = $this->input->post('CategoryID');
        $techName = $this->input->post('txtName');

        $this->db->where('name', $techName);
        $this->db->where('CATEGORY_ID', $catID);

        $query = $this->db->get('master_13_staff');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Staff Member already present in this Category');
        } else {
            $data = array(
                'name' => $techName,
                'CATEGORY_ID' => $catID,
                'STATUS_' => 1,
                'USERNAME_' => $this->session->userdata('_user___')
            );

            $query = $this->db->insert('master_13_staff', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Staff Member Submitted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdelete_teacher($tID) {        
        $this->db->where('teacherID', $tID);
        $query = $this->db->get('master_14_teacher_wise_subject');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Teacher already associated with subject !! Therefore cannot be deleted');
        } else {

            $this->db->where('teacherID', $tID);
            $query = $this->db->delete('master_13_staff');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Staff Member Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function get_teacher_id($teacherID) {
        $this->db->where('teacherID', $teacherID);
        $query = $this->db->get('master_13_staff');
        return $query->result();
    }

    function mupdate_teacher() {
        $techName = $this->input->post('txtName_Edit');
        $techStatus = $this->input->post('optTeacherStatus');
        $teachID = $this->input->post('teachID_Edit');

        $this->db->where('name', $techName);
        $this->db->where('teacherID<>', $teachID);
        $query = $this->db->get('master_13_staff');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Staff Member already present in Selected Category');
        } else {

            $data = array(
                'name' => $techName,
                'STATUS_' => $techStatus,
                'USERNAME_' => $this->session->userdata('_user___')
            );

            $this->db->where('teacherID', $teachID);
            $query = $this->db->update('master_13_staff', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Staff Member Updated Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mget_exiting_subject_($classID) {
        $this->db->where('classID', $classID);
        $this->db->order_by('subName', 'Asc');
        $this->db->order_by('status', 'desc');
        $query = $this->db->get('master_12_subject');

        if ($query->num_rows() != 0) {
            $output = "<option value=''>SELECT SUBJECT</option>";
            foreach ($query->result() as $row) {
                $output .= "<option value='" . $row->subjectID . "'>" . $row->subName . " (" . $row->status . ")" . "</option>";
            }
        } else {
            $output = "<option value='0'>NO SUBJECT AVAILABLE</option>";
        }
        return $output;
    }

    function mget_exiting_subject_forTeacher($tid) {
        $this->db->select('a.*, b.*');
        $this->db->from('master_14_teacher_wise_subject a');
        $this->db->join('master_12_subject b', 'a.subjectID=b.subjectID');
        $this->db->where('a.sessID', $this->session->userdata('_current_year___'));
        $this->db->where('a.teacherID', $tid);
        $this->db->order_by('b.classID', 'Asc');
        $this->db->order_by('b.status', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function massociate_subject() {
        $techID = $this->input->post('txtTeacherID');
        $subID = $this->input->post('cmbSubject');
        $sessID = $this->session->userdata('_current_year___');

        $this->db->where('teacherID', $techID);
        $this->db->where('subjectID', $subID);
        $this->db->where('sessID', $sessID);

        $query = $this->db->get('master_14_teacher_wise_subject');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'This Subject already Assoicated');
        } else {

            $this->db->where('teacherID <>', $techID);
            $this->db->where('subjectID', $subID);
            $this->db->where('sessID', $sessID);

            $query = $this->db->get('master_14_teacher_wise_subject');

            if ($query->num_rows() != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'This Subject is already Assoicated with other Teacher');
            } else {
                $data = array(
                    'teacherID' => $techID,
                    'subjectID' => $subID,
                    'sessID' => $sessID,
                );

                $query = $this->db->insert('master_14_teacher_wise_subject', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Subject Associated with Teacher Successfully');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'error');
                }
            }
        }
        return $bool_;
    }

    function mdel_teacher_subject($tassoID) {
        $this->db->where('tasID', $tassoID);
        $query = $this->db->delete('master_14_teacher_wise_subject');

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Teacher-Subject Association Deleted Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mgetGeneralStatus() {
        $query = $this->db->get('master_17_general');
        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => TRUE, 'msg_' => $query->result());
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'x');
        }
        return $bool_;
    }

    function msubmitSchool($opt) {
        if ($opt == '1') {
            $schName_ = trim($this->input->post('txtSchName1'));
            $contact_ = trim($this->input->post('txtSchContact1'));
            $email_ = trim($this->input->post('txtSchEmail1'));
            $add_ = trim($this->input->post('txtSchAdd1'));
            $city_ = trim($this->input->post('txtPCity1'));
            $disitt_ = trim($this->input->post('txtPDistt1'));
            $state_ = trim($this->input->post('cmbPState1'));
            $country_ = trim($this->input->post('txtCountry1'));
        } else {
            $sch_id = trim($this->input->post('txtSchID'));
            $schName_ = trim($this->input->post('txtSchName'));
            $contact_ = trim($this->input->post('txtSchContact'));
            $email_ = trim($this->input->post('txtSchEmail'));
            $add_ = trim($this->input->post('txtSchAdd'));
            $city_ = trim($this->input->post('txtPCity'));
            $disitt_ = trim($this->input->post('txtPDistt'));
            $state_ = trim($this->input->post('cmbPState'));
            $country_ = trim($this->input->post('txtCountry'));
        }

        $data = array(
            'SCH_NAME' => $schName_,
            'SCH_CONTACT' => $contact_,
            'SCH_EMAIL' => $email_,
            'SCH_ADD' => $add_,
            'SCH_CITY' => $city_,
            'SCH_DISITT' => $disitt_,
            'SCH_STATE' => $state_,
            'SCH_COUNTRY' => $country_,
            'DATE_' => date('Y-m-d H:i:s'),
            'USERNAME' => $this->session->userdata('_user___')
        );

        if ($opt == '1') {
            $query = $this->db->insert('master_17_general', $data);
            $sch_id = $this->db->insert_id();
            // --------------------------------------------logo
            if (isset($_FILES['txtLogoUpload1']) && is_uploaded_file($_FILES['txtLogoUpload1']['tmp_name'])) {
                $path_ = $this->upload_logo($sch_id, $opt);
                if ($path_ != 'x') {
                    $data = array(
                        'SCH_LOGO' => $path_
                    );
                    $this->db->where('SCH_ID', $sch_id);
                    $this->db->update('master_17_general', $data);
                }
            }
            // --------------------------------------------
        } else {
            $this->db->where('SCH_ID', $sch_id);
            $query1 = $this->db->update('master_17_general', $data);
            // --------------------------------------------logo           
            if (isset($_FILES['txtLogoUpload']) && is_uploaded_file($_FILES['txtLogoUpload']['tmp_name'])) {
                $path_ = $this->upload_logo($sch_id, $opt);
                if ($path_ != 'x') {
                    $data = array(
                        'SCH_LOGO' => $path_
                    );
                    $this->db->where('SCH_ID', $sch_id);
                    $this->db->update('master_17_general', $data);
                }
            }
            // --------------------------------------------
        }

        if ($opt == '1') {
            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'School <span style="color: #0000ff; font-weight: bold">' . $schName_ . '</span> added successfully.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or School <span style="color: #0000ff; font-weight: bold">' . $schName_ . '</span> is already exists. Please check and try again.');
            }
        } else {
            if ($query1 == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'School <span style="color: #0000ff; font-weight: bold">' . $schName_ . '</span> updated successfully.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or School <span style="color: #0000ff; font-weight: bold">' . $schName_ . '</span> is already exists. Please check and try again.');
            }
        }

        return $bool_;
    }

    function upload_logo($id, $op) {
        clearstatcache();
        $config = array(
            'upload_path' => './assets_/logo',
            'allowed_types' => 'jpg|png',
            'max_size' => 250,
            'file_name' => $id,
            'overwrite' => TRUE,
        );
        if ($op == '1') {
            $file_element_name = 'txtLogoUpload1';
        } else {
            $file_element_name = 'txtLogoUpload';
        }
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_element_name)) {
            $path_ji = $this->upload->data();
            $path_ = $path_ji['file_name'];
        } else {
            $path_ = 'x';
        }
        return $path_;
    }

}
