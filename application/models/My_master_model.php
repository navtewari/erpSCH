<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_Master_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
        $this->_db_error();
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

            $query = $this->db->query("DELETE FROM class_2_in_session where SESSID = '" . $year__ . "' AND CLSSESSID NOT IN (SELECT `CLSSESSID` from class_3_class_wise_students)");

            $bool_ = $this->insert_classes_in_session($count_list, $year__);
        } else {
            $bool_ = $this->insert_classes_in_session($count_list, $year__);
        }

        return $bool_;
    }

    function insert_classes_in_session($class_list, $year__) {
        $bool_ = 0;
        for ($i = 0; $i < count($class_list); $i++) {
            $data = array(
                'CLASSID' => $class_list[$i],
                'SESSID' => $year__,
                'DATE_' => date('Y-m-d H:i:s'),
                'STATUS_' => 1
            );
            $query = $this->db->insert('class_2_in_session', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Classes Updated successfully.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong or class <span style="color: #0000ff; font-weight: bold"> </span> is already exists. Please check and try again.');
            }
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

    function getAll_teacher() {
        $query = $this->db->get('master_13_teacher');
        return $query->result();
    }

    function mcreate_teacher() {
        $techName = $this->input->post('txtName');
        $techUname = $this->input->post('txtUname');

        $this->db->where('name', $techName);
        $this->db->where('username', $techUname);

        $query = $this->db->get('master_13_teacher');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Teacher already present');
        } else {
            $data = array(
                'name' => $techName,
                'username' => $techUname,
            );

            $query = $this->db->insert('master_13_teacher', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Teacher Submitted Successfully');
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
            $query = $this->db->delete('master_13_teacher');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Teacher Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }

        return $bool_;
    }

    function get_teacher_id($teacherID) {
        $this->db->where('teacherID', $teacherID);
        $query = $this->db->get('master_13_teacher');
        return $query->result();
    }

    function mupdate_teacher() {
        $techName = $this->input->post('txtName_Edit');
        $techUname = $this->input->post('txtUname_Edit');
        $teachID = $this->input->post('teachID_Edit');

        $this->db->where('name', $techName);
        $this->db->where('username', $techUname);

        $query = $this->db->get('master_13_teacher');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Teacher already present');
        } else {

            $data = array(
                'name' => $techName,
                'username' => $techUname,
            );

            $this->db->where('teacherID', $teachID);
            $query = $this->db->update('master_13_teacher', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Teacher Updated Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function _db_error() {
        //exception handling ------------------
        if ($this->db->trans_status() == FALSE) {
            echo "gadbad";
            die();
            //redirect('web/dberror');
        }
        //-------------------------------------
    }

}
