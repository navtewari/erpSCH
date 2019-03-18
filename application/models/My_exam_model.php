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
        $this->db->order_by('priority', 'Asc');
        $query = $this->db->get();
        return $query->result();
    }

    function msubmitScholasticItem() {
        $schlasticItem = $this->input->post('txtScholasticItem');
        $maxMarks = $this->input->post('txtScholasticMarks');
        $minMarks = $this->input->post('txtScholasticminMarks');

        $this->db->where('item', $schlasticItem);
        $query = $this->db->get('exam_1_scholastic_items');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => ' This Scholastic Item already present');
        } else {
            $data = array(
                'item' => $schlasticItem,
                'maxMarks' => $maxMarks,
                'minMarks' => $minMarks
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
        $minMarks = $this->input->post('txtScholasticminMarks_edit');

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
                'maxMarks' => $maxMarks,
                'minMarks' => $minMarks
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

    function mdelete_Scholastic($scholasticID) {
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

    function mget_class_scholastic_in_session($classID) {
        $this->db->select('a.CLSSESSID, a.CLASSID, b.*,  c.*');
        $this->db->from('exam_2_add_scholastic_to_class b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->join('exam_1_scholastic_items c', 'b.itemID = c.itemID');
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('b.CLSSESSID', $classID);
        $this->db->order_by('c.priority', 'Asc');
        $query = $this->db->get();
        //echo $this->db->last_query()."<br />";
        //die();
        return $query->result();
    }

    function massociateScholastic_with_class($classsessID) {
        $scholastic_item = $this->input->post('chkScholastic');
        $seleted_classes = $classsessID;
        $session = $this->session->userdata('_current_year___');

        for ($loop1 = 0; $loop1 < count($scholastic_item); $loop1++) {
            $this->db->where('CLSSESSID', $seleted_classes);
            $this->db->where('itemID', $scholastic_item[$loop1]);
            $this->db->where('SESSID', $session);
            $query = $this->db->get('exam_2_add_scholastic_to_class');

            if ($query->num_rows($query) != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Already Exists');
            } else {
                $data = array(
                    'CLSSESSID' => $seleted_classes,
                    'SESSID' => $session,
                    'itemID' => $scholastic_item[$loop1],
                    'USERNAME_' => $this->session->userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('exam_2_add_scholastic_to_class', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Scholastic Head Associated Successfully');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again');
                }
            }
        }
        return $bool_;
    }

    function mdelAssociated_scholastic_class($assocID) {
        $this->db->where('ADDSCHCLASSID', $assocID);
        $query = $this->db->delete('exam_2_add_scholastic_to_class');
        // echo $this->db->last_query()."<br />";
        //exit();
        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Associated Scholastic Item Deleted from Class Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mgetAllCoScholasticItems() {
        $this->db->order_by('priority', 'Asc');
        $query = $this->db->get('exam_3_coscholastic_items');
        return $query->result();
    }

    function msubmitCoScholasticItem() {
        $coschlasticItem = $this->input->post('txtCoScholasticItem');

        $this->db->where('coitem', $coschlasticItem);
        $query = $this->db->get('exam_3_coscholastic_items');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => ' This Co-Scholastic Item already present');
        } else {
            $data = array(
                'coitem' => $coschlasticItem,
            );

            $query = $this->db->insert('exam_3_coscholastic_items', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Co-Scholastic Item Inserted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdelete_coScholastic($coscholasticID) {
        $this->db->where('coitemID', $coscholasticID);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query1 = $this->db->get('exam_4_add_coscholastic_to_class');

        if ($query1->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => '!! This Co-Scholastic Item is already Associated with Class Therefore Cannot be deleted !!');
        } else {
            $this->db->where('coitemID', $coscholasticID);
            $query = $this->db->delete('exam_3_coscholastic_items');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'CO-Scholastic Item Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mget_class_coscholastic_in_session($classID) {
        $this->db->select('a.CLSSESSID, a.CLASSID, b.*,  c.*');
        $this->db->from('exam_4_add_coscholastic_to_class b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->join('exam_3_coscholastic_items c', 'b.coitemID = c.coitemID');
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('b.CLSSESSID', $classID);
        $this->db->order_by('c.priority', 'Asc');
        $query = $this->db->get();
        return $query->result();
    }

    function mAddcoScholastictoClass($classsessID) {
        $coscholastic_item = $this->input->post('chkcoScholastic');
        $seleted_classes = $classsessID;
        $session = $this->session->userdata('_current_year___');

        for ($loop1 = 0; $loop1 < count($coscholastic_item); $loop1++) {
            $this->db->where('CLSSESSID', $seleted_classes);
            $this->db->where('coitemID', $coscholastic_item[$loop1]);
            $this->db->where('SESSID', $session);
            $query = $this->db->get('exam_4_add_coscholastic_to_class');

            if ($query->num_rows($query) != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Already Exists');
            } else {
                $data = array(
                    'CLSSESSID' => $seleted_classes,
                    'SESSID' => $session,
                    'coitemID' => $coscholastic_item[$loop1],
                    'USERNAME_' => $this->session->userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('exam_4_add_coscholastic_to_class', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Co-Scholastic Head Associated Successfully');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again');
                }
            }
        }
        return $bool_;
    }

    function msetSchoPriority($schoID, $priority) {
        $data = array(
            'priority' => $priority,
        );

        $this->db->where('itemID', $schoID);
        $query = $this->db->update('exam_1_scholastic_items', $data);

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Scholastic Priority Updated');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error!! Try Again');
        }

        return $bool_;
    }

    function msetcoSchoPriority($coschoID, $priority) {
        $data = array(
            'priority' => $priority,
        );

        $this->db->where('coitemID', $coschoID);
        $query = $this->db->update('exam_3_coscholastic_items', $data);

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Co-Scholastic Priority Updated');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error!! Try Again');
        }
        return $bool_;
    }

    function mdelAssociated_coscholastic_class($assocID) {
        $this->db->where('ADDCOSCHCLASSID', $assocID);
        $query = $this->db->delete('exam_4_add_coscholastic_to_class');
        // echo $this->db->last_query()."<br />";
        //exit();
        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Associated Co-Scholastic Item Deleted from Class Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mgetAllDisciplineItems() {
        $this->db->order_by('priority', 'Asc');
        $query = $this->db->get('exam_10_discipline_items');
        return $query->result();
    }

    function msubmitDisciplineItem() {
        $disciplineItem = $this->input->post('txtDisciplineItem');

        $this->db->where('disciplineitem', $disciplineItem);
        $query = $this->db->get('exam_10_discipline_items');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => ' This Discipline Item already present');
        } else {
            $data = array(
                'disciplineitem' => $disciplineItem,
            );

            $query = $this->db->insert('exam_10_discipline_items', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Discipline Item Inserted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdelete_discipline($disciplineID) {
        $this->db->where('disciplineID', $disciplineID);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query1 = $this->db->get('exam_11_add_discipline_to_class');

        if ($query1->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => '!! This Discipline Item is already Associated with Class, Therefore Cannot be deleted !!');
        } else {
            $this->db->where('disciplineID', $disciplineID);
            $query = $this->db->delete('exam_10_discipline_items');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Discipline Item Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function msetdisciplinePriority($disciplineID, $priority) {
        $data = array(
            'priority' => $priority,
        );

        $this->db->where('disciplineID', $disciplineID);
        $query = $this->db->update('exam_10_discipline_items', $data);

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Discipline Priority Updated');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error!! Try Again');
        }
        return $bool_;
    }

    function mget_class_discipline_in_session($classID) {
        $this->db->select('a.CLSSESSID, a.CLASSID, b.*,  c.*');
        $this->db->from('exam_11_add_discipline_to_class b');
        $this->db->join('class_2_in_session a', 'a.CLSSESSID = b.CLSSESSID', 'left');
        $this->db->join('exam_10_discipline_items c', 'b.disciplineID = c.disciplineID');
        $this->db->where('a.SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('b.CLSSESSID', $classID);
        $this->db->order_by('c.priority', 'Asc');
        $query = $this->db->get();
        return $query->result();
    }

    function mAddDisciplinetoClass($classsessID) {
        $discipline_item = $this->input->post('chkDiscipline');
        $seleted_classes = $classsessID;
        $session = $this->session->userdata('_current_year___');

        for ($loop1 = 0; $loop1 < count($discipline_item); $loop1++) {
            $this->db->where('CLSSESSID', $seleted_classes);
            $this->db->where('disciplineID', $discipline_item[$loop1]);
            $this->db->where('SESSID', $session);
            $query = $this->db->get('exam_11_add_discipline_to_class');

            if ($query->num_rows($query) != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Already Exists');
            } else {
                $data = array(
                    'CLSSESSID' => $seleted_classes,
                    'SESSID' => $session,
                    'disciplineID' => $discipline_item[$loop1],
                    'USERNAME_' => $this->session->userdata('_user___'),
                    'DATE_' => date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('exam_11_add_discipline_to_class', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Discipline Associated Successfully');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again');
                }
            }
        }
        return $bool_;
    }

    function mdelAssociated_discipline_class($assocID) {
        $this->db->where('ADDDISCIPLINECLASSID', $assocID);
        $query = $this->db->delete('exam_11_add_discipline_to_class');
        // echo $this->db->last_query()."<br />";
        //exit();
        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Associated Discipline Item Deleted from Class Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mget_examterm_in_session() {
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('exam_5_term');
        return $query->result();
    }

    function mcreate_term() {
        $termName = $this->input->post('txtExamTerm');

        $this->db->where('termName', $termName);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('exam_5_term');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => $sessionID . ' Exam Term already created');
        } else {
            $data = array(
                'termName' => $termName,
                'SESSID' => $this->session->userdata('_current_year___')
            );

            $query = $this->db->insert('exam_5_term', $data);

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Exam Term created Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mdeleteTerm($termID) {
        $this->db->where('termID', $termID);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query1 = $this->db->get('exam_6_scholastic_result');

        $this->db->where('termID', $termID);
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $query2 = $this->db->get('exam_7_coscholastic_result');

        if (($query1->num_rows() != 0 ) || ($query2->num_rows() != 0 )) {
            $bool_ = array('res_' => FALSE, 'msg_' => '!! This Term is already Associated with Result Therefore Cannot be deleted !!');
        } else {
            $this->db->where('termID', $termID);
            $this->db->where('SESSID', $this->session->userdata('_current_year___'));
            $query = $this->db->delete('exam_5_term');

            if ($query == TRUE) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Term Deleted Successfully');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mget_scholastic_item_classwise($classID) {
        $this->db->select('a.*, b.*');
        $this->db->from('exam_2_add_scholastic_to_class b');
        $this->db->join('exam_1_scholastic_items a', 'a.itemID = b.itemID');
        $this->db->where('b.CLSSESSID', $classID);
        $this->db->order_by('a.priority', 'Asc');
        $query = $this->db->get();

        return $query->result();
    }

    function mget_coscholastic_item_classwise($classID) {
        $this->db->select('a.*, b.*');
        $this->db->from('exam_4_add_coscholastic_to_class b');
        $this->db->join('exam_3_coscholastic_items a', 'a.coitemID = b.coitemID');
        $this->db->where('b.CLSSESSID', $classID);
        $this->db->order_by('a.priority', 'Asc');
        $query = $this->db->get();
        return $query->result();
    }

    function mget_discipline_item_classwise($classID) {
        $this->db->select('a.*, b.*');
        $this->db->from('exam_11_add_discipline_to_class b');
        $this->db->join('exam_10_discipline_items a', 'a.disciplineID = b.disciplineID');
        $this->db->where('b.CLSSESSID', $classID);
        $this->db->order_by('a.priority', 'Asc');
        $query = $this->db->get();
        return $query->result();
    }

    function mcheckData_entry_result() {
        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');

        $subjectid = $this->input->post('cmbSubjectMarks');
        $sessionid = $this->session->userdata('_current_year___');

        if ($optScholastic == '1') {
            //-----------------------Checking for already submitted result---
            $this->db->where('termID', $termID);
            $this->db->where('CLSSESSID', $classid);
            $this->db->where('itemID', $AssItem);
            $this->db->where('subjectID', $subjectid);
            $this->db->where('SESSID', $sessionid);
            $queryEdit = $this->db->get('exam_6_scholastic_result');

            if ($queryEdit->num_rows() != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Scholastic Data already present for this combination');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mcheckcoSchData_entry_result() {
        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');

        $sessionid = $this->session->userdata('_current_year___');

        if ($optScholastic == '2') {
            //-----------------------Checking for already submitted result---
            $this->db->where('termID', $termID);
            $this->db->where('CLSSESSID', $classid);
            $this->db->where('coitemID', $AssItem);
            $this->db->where('SESSID', $sessionid);
            $queryEdit = $this->db->get('exam_7_coscholastic_result');

            if ($queryEdit->num_rows() != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Co-Scholastic Data already present for this combination');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function mcheckdisciplineData_entry_result() {
        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');

        $sessionid = $this->session->userdata('_current_year___');

        if ($optScholastic == '3') {
            //-----------------------Checking for already submitted result---
            $this->db->where('termID', $termID);
            $this->db->where('CLSSESSID', $classid);
            $this->db->where('disciplineID', $AssItem);
            $this->db->where('SESSID', $sessionid);
            $queryEdit = $this->db->get('exam_12_discipline_result');

            if ($queryEdit->num_rows() != 0) {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Discipline Data already present for this combination');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'error');
            }
        }
        return $bool_;
    }

    function get_maxMarks_in_assessmentarea($assItem) {
        $this->db->where('itemID', $assItem);
        $query = $this->db->get('exam_1_scholastic_items');

        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $maxMarks = $row->maxMarks;
            }
        }
        return $maxMarks;
    }

    function mget_students_in_class($classID) {
        $year__ = $this->session->userdata('_current_year___');

        $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this->db->where('b.clssessid', $classID);
        $this->db->where('c.SESSID', $year__);
        $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function mget_students_in_class_with_marks($classID) {
        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');
        $subjectid = $this->input->post('cmbSubjectMarks');
        $year__ = $this->session->userdata('_current_year___');

        if ($optScholastic == '1') {
            $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_, d.*');
            $this->db->from('master_7_stud_personal a');
            $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
            $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
            $this->db->join('exam_6_scholastic_result d', 'a.regid=d.regid');
            $this->db->where('b.clssessid', $classID);
            $this->db->where('c.SESSID', $year__);
            $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');

            $this->db->where('d.termID', $termID);
            $this->db->where('d.CLSSESSID', $classid);
            $this->db->where('d.itemID', $AssItem);
            $this->db->where('d.subjectID', $subjectid);
            $this->db->where('d.SESSID', $year__);

            $query = $this->db->get();
        } else if ($optScholastic == '2') {
            $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_, d.*');
            $this->db->from('master_7_stud_personal a');
            $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
            $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
            $this->db->join('exam_7_coscholastic_result d', 'a.regid=d.regid');
            $this->db->where('b.clssessid', $classID);
            $this->db->where('c.SESSID', $year__);
            $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');

            $this->db->where('d.termID', $termID);
            $this->db->where('d.CLSSESSID', $classid);
            $this->db->where('d.coitemID', $AssItem);
            $this->db->where('d.SESSID', $year__);

            $query = $this->db->get();
        } else if ($optScholastic == '3') {
            $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_, d.*');
            $this->db->from('master_7_stud_personal a');
            $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
            $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
            $this->db->join('exam_12_discipline_result d', 'a.regid=d.regid');
            $this->db->where('b.clssessid', $classID);
            $this->db->where('c.SESSID', $year__);
            $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');

            $this->db->where('d.termID', $termID);
            $this->db->where('d.CLSSESSID', $classid);
            $this->db->where('d.disciplineID', $AssItem);
            $this->db->where('d.SESSID', $year__);

            $query = $this->db->get();
        }

        return $query->result();
    }

    function checkStudentRemarks($classID) {
        $this->db->where('CLSSESSID', $classID);
        $query2 = $this->db->get('exam_9_result_remarks');
        if ($query2->num_rows() != 0) {
            return ('1');
        } else {
            return ('2');
        }
    }

    function mget_students_in_class_for_remarks($classID) {
        $this->db->where('CLSSESSID', $classID);
        $query2 = $this->db->get('exam_9_result_remarks');
        $year__ = $this->session->userdata('_current_year___');

        if ($query2->num_rows() != 0) {
            $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_, d.*');
            $this->db->from('master_7_stud_personal a');
            $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
            $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
            $this->db->join('exam_9_result_remarks d', 'a.regid=d.regid');
            $this->db->where('b.clssessid', $classID);
            $this->db->where('c.SESSID', $year__);
            $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');

            $this->db->where('d.CLSSESSID', $classID);
            $this->db->where('d.SESSID', $year__);

            $query = $this->db->get();
        } else {
            $this->db->select('a.regid, a.FNAME, a.MNAME,a.LNAME, c.CLASSID, b.clssessid, b.ID_');
            $this->db->from('master_7_stud_personal a');
            $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
            $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
            $this->db->where('b.clssessid', $classID);
            $this->db->where('c.SESSID', $year__);
            $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');
            $query = $this->db->get();
        }

        return $query->result();
    }

    function minputResult() {
        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');
        $subjectid = $this->input->post('cmbSubjectMarks');
        $examDate = $this->input->post('txtExamDate');
        $sessionid = $this->session->userdata('_current_year___');

        $obj = $this->input->post('marks_status');
        $username = $this->session->userdata('_user___');

        if ($optScholastic == '1') {
            $this->db->where('itemID', $AssItem);
            $query2 = $this->db->get('exam_1_scholastic_items');

            if ($query2->num_rows() != 0) {
                foreach ($query2->result() as $row2) {
                    $maxMarks = $row2->maxMarks;
                }
            }

            foreach ($obj as $key => $value) {
                $data = array(
                    'regid' => $key,
                    'CLSSESSID' => $classid,
                    'ROLLNO' => 0,
                    'SESSID' => $sessionid,
                    'subjectID' => $subjectid,
                    'itemID' => $AssItem,
                    'maxMarks' => $maxMarks,
                    'marks' => $value,
                    'termID' => $termID,
                    'USERNAME_' => $username,
                    'DATEOFTEST' => $examDate,
                );

                $query = $this->db->insert('exam_6_scholastic_result', $data);
            }
        } else if ($optScholastic == '2') {
            foreach ($obj as $key => $value) {
                $data = array(
                    'regid' => $key,
                    'CLSSESSID' => $classid,
                    'ROLLNO' => 0,
                    'SESSID' => $sessionid,
                    'coitemID' => $AssItem,
                    'grade' => $value,
                    'termID' => $termID,
                    'USERNAME_' => $username,
                    'DATEOFTEST' => $examDate,
                );

                $query = $this->db->insert('exam_7_coscholastic_result', $data);
            }
        } else if ($optScholastic == '3') {
            foreach ($obj as $key => $value) {
                $data = array(
                    'regid' => $key,
                    'CLSSESSID' => $classid,
                    'ROLLNO' => 0,
                    'SESSID' => $sessionid,
                    'disciplineID' => $AssItem,
                    'grade' => $value,
                    'termID' => $termID,
                    'USERNAME_' => $username,
                    'DATEOFTEST' => $examDate,
                );

                $query = $this->db->insert('exam_12_discipline_result', $data);
            }
        }

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Result Inserted Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mupdateInputResult() {
        $termID = $this->input->post('cmbExamTerm');
        $classid = $this->input->post('cmbClassofResult');
        $optScholastic = $this->input->post('cmbAssessment');
        $AssItem = $this->input->post('cmbAssessmentItem');
        $subjectid = $this->input->post('cmbSubjectMarks');
        $sessionid = $this->session->userdata('_current_year___');
        $examDate = $this->input->post('txtExamDate');

        $obj = $this->input->post('marks_status');
        //$objResult=$this->input->post('resultID');
        $username = $this->session->userdata('_user___');

        if ($optScholastic == '1') {
            //$this->db->where('itemID', $AssItem);
            //$query2 = $this->db->get('exam_1_scholastic_items');

            foreach ($obj as $key => $value) {
                $data = array(
                    'marks' => $value,
                    'DATEOFTEST' => $examDate,
                );
                $this->db->where('schID', $key);
                $query = $this->db->update('exam_6_scholastic_result', $data);
            }
        } else if ($optScholastic == '2') {
            foreach ($obj as $key => $value) {
                $data = array(
                    'grade' => $value,
                    'DATEOFTEST' => $examDate,
                );
                $this->db->where('coschID', $key);
                $query = $this->db->update('exam_7_coscholastic_result', $data);
            }
        } else if ($optScholastic == '3') {
            foreach ($obj as $key => $value) {
                $data = array(
                    'grade' => $value,
                    'DATEOFTEST' => $examDate,
                );
                $this->db->where('disResultID', $key);
                $query = $this->db->update('exam_12_discipline_result', $data);
            }
        }

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Result Updated Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mSubmitRemarks($clssessid) {
        $sessionid = $this->session->userdata('_current_year___');

        $obj = $this->input->post('stu_remark');
        $obj1 = $this->input->post('stu_promoted');

        $username = $this->session->userdata('_user___');
        foreach ($obj as $key => $value) {
            $data = array(
                'regid' => $key,
                'CLSSESSID' => $clssessid,
                'ROLLNO' => 0,
                'SESSID' => $sessionid,
                'teacherRemark' => $value,
                'promotedClass' => $obj1[$key],
                'USERNAME_' => $username,
            );

            $query = $this->db->insert('exam_9_result_remarks', $data);
        }

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Remarks Inserted Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mUpdateRemarks($clssessid) {
        $sessionid = $this->session->userdata('_current_year___');

        $obj = $this->input->post('stu_remark');
        $obj1 = $this->input->post('stu_promoted');

        $username = $this->session->userdata('_user___');
        foreach ($obj as $key => $value) {
            $data = array(
                'teacherRemark' => $value,
                'promotedClass' => $obj1[$key],
                'USERNAME_' => $username,
            );

            $this->db->where('resultsubtotalID', $key);
            $query = $this->db->update('exam_9_result_remarks', $data);
        }

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Remarks Updated Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'error');
        }

        return $bool_;
    }

    function mfetchStuPerData($regID) {
        $this->db->where('regid', $regID);
        $query = $this->db->get('master_7_stud_personal');
        //$this->db->order_by('cast(regid AS SIGNED INT)', 'ASC');
        return $query->result();
    }

    function mfetchterm_class($classsessID, $year_) {
        $this->db->select('a.termName, b.*');
        $this->db->from('exam_6_scholastic_result b');
        $this->db->join('exam_5_term a', 'a.termID = b.termID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classsessID);
        $this->db->group_by('b.termID');
        $this->db->order_by('a.termName', 'Desc');
        $query = $this->db->get();

        // echo $this->db->last_query()."<br />";
        return $query->result();
    }

    function mfetchScholasticClassWise($classsessid, $year_) {
        $this->db->select('a.item, a.maxMarks, b.*');
        $this->db->from('exam_2_add_scholastic_to_class b');
        $this->db->join('exam_1_scholastic_items a', 'a.itemID = b.itemID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classsessid);
        $this->db->order_by('a.priority', 'Asc');
        $query = $this->db->get();

        return $query->result();
    }

    function mfetchcoScholasticClassWise($classsessid, $year_) {
        $this->db->select('a.coitem, b.*');
        $this->db->from('exam_4_add_coscholastic_to_class b');
        $this->db->join('exam_3_coscholastic_items a', 'a.coitemID = b.coitemID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classsessid);
        $this->db->order_by('a.priority', 'Asc');
        $query = $this->db->get();

        // echo $this->db->last_query()."<br />";
        return $query->result();
    }

    function mfetchdisciplineClassWise($classsessid, $year_) {
        $this->db->select('a.disciplineitem, b.*');
        $this->db->from('exam_11_add_discipline_to_class b');
        $this->db->join('exam_10_discipline_items a', 'a.disciplineID = b.disciplineID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classsessid);
        $this->db->order_by('a.priority', 'Asc');
        $query = $this->db->get();

        // echo $this->db->last_query()."<br />";
        return $query->result();
    }

    function mfetchSubClassWise($classID, $year_) {
        $this->db->where('classID', $classID);
        $this->db->where('SESSID', $year_);
        $this->db->order_by('priority', 'Asc');
        $query = $this->db->get('master_12_subject');

        return $query->result();
    }

    function mfetchSubMarks($regID, $classSessID, $year_) {
        if ($regID != 0) {
            $this->db->where('regid', $regID);
        }
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $query = $this->db->get('exam_6_scholastic_result');

        return $query->result();
    }
    
    function mfetchSubMarkswholeClass($regID, $classSessID, $year_) {
        if ($regID != 0) {
            $this->db->where('regid', $regID);
        }
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $this->db->order_by('regid', 'Asc');
        $query = $this->db->get('exam_6_scholastic_result');

        return $query->result();
    }

    function mfetchSubMarksLimit($classSessID, $year_, $limit, $start) { 
        //---------counting scholastic Data------------------------
         $this->db->select('a.item, a.maxMarks, b.*');
        $this->db->from('exam_2_add_scholastic_to_class b');
        $this->db->join('exam_1_scholastic_items a', 'a.itemID = b.itemID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classSessID);
        $this->db->order_by('a.priority', 'Asc');
        $count_scho = $this->db->count_all_results();
        
        
        //---------counting subject Data------------------------
        $classID = $this->mcheckClassID($classSessID);
        $this->db->where('classID', $classID);
        $this->db->where('SESSID', $year_);
        $this->db->order_by('priority', 'Asc');
        $this->db->from('master_12_subject');        
        $count_sub = $this->db->count_all_results();
        //echo $count_sub;
        //exit(0);
        //------------------------------------------------------
        $totlLimit=$count_scho*$count_sub;
        //------------------------------------------------------
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $this->db->order_by('cast(REGID AS SIGNED INT)', 'ASC');
        $this->db->limit($limit * $totlLimit, $start*$totlLimit);
        $query = $this->db->get('exam_6_scholastic_result');
       
        //echo $this->db->last_query()."<br />";
        //exit(0);
        return $query->result();
    }
    
    function mcoSchMarksLimit($classSessID, $year_, $limit, $start) {        
        //---------counting Coscholastic Data------------------------
        $this->db->select('a.coitem, b.*');
        $this->db->from('exam_4_add_coscholastic_to_class b');
        $this->db->join('exam_3_coscholastic_items a', 'a.coitemID = b.coitemID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classSessID);
        //$query=$this->db->get();
        $count_cosho = $this->db->count_all_results();
        //echo $this->db->last_query();
        
        //echo $count_cosho;
        //exit(0);
       
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $this->db->order_by('cast(REGID AS SIGNED INT)', 'ASC');
        $this->db->limit($limit*$count_cosho, $start*$count_cosho);
        $query = $this->db->get('exam_7_coscholastic_result');

        return $query->result();
    }
    
    function mdisciplineMarksLimit($classSessID, $year_, $limit, $start) {        
        //---------counting Discipline Data------------------------
        $this->db->select('a.disciplineitem, b.*');
        $this->db->from('exam_11_add_discipline_to_class b');
        $this->db->join('exam_10_discipline_items a', 'a.disciplineID = b.disciplineID', 'left');
        $this->db->where('b.SESSID', $year_);
        $this->db->where('b.CLSSESSID', $classSessID);
        //$query=$this->db->get();
        $count_dis = $this->db->count_all_results();
        //echo $this->db->last_query();
        
        //echo $count_cosho;
        //exit(0);      
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $this->db->order_by('cast(REGID AS SIGNED INT)', 'ASC');
        $this->db->limit($limit*$count_dis, $start*$count_dis);
        $query = $this->db->get('exam_12_discipline_result');
        
        return $query->result();
    }
    
    function checkregIDRemarkLimit($classSessID, $session, $limit, $start) {
        $this->db->where('CLSSESSID', $classSessID);        
        //$this->db->where('regid', $regID);
        $this->db->where('SESSID', $session);
        $this->db->order_by('cast(REGID AS SIGNED INT)', 'ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('exam_9_result_remarks');
       
        return $query->result();
    }
    
    function get_overall_result_in_classLimit($classSessID, $limit, $start) {
        $year__ = $this->session->userdata('_current_year___');                
        
        $this->db->where('CLSSESSID', $classSessID);        
        $this->db->where('SESSID', $year__);
        $this->db->order_by('cast(REGID AS SIGNED INT)', 'ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('exam_13_calculated_result');
        
        return $query->result();
    }
    
    function mcoSchMarks($regID, $classSessID, $year_) {
        if ($regID != 0) {
            $this->db->where('regid', $regID);
        }
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $query = $this->db->get('exam_7_coscholastic_result');

        return $query->result();
    }

    function mdisciplineMarks($regID, $classSessID, $year_) {
        if ($regID != 0) {
            $this->db->where('regid', $regID);
        }
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $query = $this->db->get('exam_12_discipline_result');

        return $query->result();
    }

    function mfetchScholasticResult($regID, $year_, $classID, $classSessID) {
        //$classID = $this->input->post('txtClassID');
        //$classSessID = $this->input->post('txtClassSessID');

        if ($regID != 0) {
            $this->db->where('regid', $regID);
        }
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year_);
        $query = $this->db->get('exam_6_scholastic_result');

        return $query->result();
    }

    function mcheckClassID($classSessID) {
        $this->db->where('SESSID', $this->session->userdata('_current_year___'));
        $this->db->where('CLSSESSID', $classSessID);
        $query1 = $this->db->get('class_2_in_session');
        //echo $this->db->last_query()."<br />";
        //exit(0);
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row1) {
                $classID = $row1->CLASSID;
            }
        }
        return $classID;
    }

    function checkregIDRemark($regID, $classSessID, $session) {
        $this->db->where('CLSSESSID', $classSessID);
        if ($regID != 0) {
            $this->db->where('regid', $regID);
        }
        $this->db->where('SESSID', $session);
        $query = $this->db->get('exam_9_result_remarks');
        return $query->result();
    }

    function get_grade_in_class($classSessID) {
        $this->db->where('clssessID', $classSessID);
        $query = $this->db->get('master_11_grading');
        return $query->result();
    }

    function mfetchStuDatainClass($classSessID) {
        $year__ = $this->session->userdata('_current_year___');

        $this->db->select('a.*, c.CLASSID, b.clssessid, b.ID_');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this->db->where('b.clssessid', $classSessID);
        $this->db->where('c.SESSID', $year__);
        $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
        
    
    function mfetchStuDatainClassLimitwise($classSessID,$limit, $start) {
        $year__ = $this->session->userdata('_current_year___');

        $this->db->select('a.*, c.CLASSID, b.clssessid, b.ID_');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('class_3_class_wise_students b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session c', 'b.CLSSESSID=c.CLSSESSID');
        $this->db->where('b.clssessid', $classSessID);
        $this->db->where('c.SESSID', $year__);        
        $this->db->order_by('cast(a.REGID AS SIGNED INT)', 'ASC');
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();

        return $query->result();
    }

    function mcalculateResult($classSessID) {
        ini_set('max_execution_time', 300);
        $regID = 0;
        $year__ = $this->session->userdata('_current_year___');
        $classID = $this->mcheckClassID($classSessID);

        $subject_class = $this->mfetchSubClassWise($classID, $year__);
        $student_per_data = $this->mfetchStuDatainClass($classSessID); //studentData
        $subject_marks = $this->mfetchSubMarks($regID, $classSessID, $year__); //Subject Marks                        
        $exam_term = $this->mget_examterm_in_session(); // Term
        $sch_data_class = $this->mfetchScholasticClassWise($classSessID, $year__); //SchData

        foreach ($student_per_data as $stuData) {
            $term1 = '';
            $term2 = '';
            $term = 0;
            foreach ($exam_term as $exterm) {
                $term++;
                $subject = '';
                foreach ($subject_class as $subjectClass) {
                    $subject = $subject . ',' . $subjectClass->subjectID;
                    $totalNumber_subject = 0;
                    foreach ($sch_data_class as $scho_items) {
                        foreach ($subject_marks as $sub_marks) {
                            if ($stuData->regid == $sub_marks->regid) {
                                if ($subjectClass->subjectID == $sub_marks->subjectID) {
                                    if ($sub_marks->termID == $exterm->termID && $sub_marks->itemID == $scho_items->itemID) {
                                        $totalNumber_subject = $totalNumber_subject + $sub_marks->marks;
                                    }
                                }
                            }
                        }
                    }
                    if ($term == 1) {
                        $term1 = $term1 . ',' . $totalNumber_subject;
                    } else if ($term == 2) {
                        $term2 = $term2 . ',' . $totalNumber_subject;
                    }
                }
            }

            //----------------------Calculating Average Subject Marks
            $term1Average = explode(",", $term1);
            $term2Average = explode(",", $term2);
            $subjectAverage = '';
            for ($loop = 1; $loop < count($term1Average); $loop++) {
                $average1 = $term1Average[$loop] / 2;
                $average2 = $term2Average[$loop] / 2;
                $subjectAverage = $subjectAverage . ',' . ($average1 + $average2);
            }

            //-----------------------Calculating Grade each subject            
            $Grade = explode(",", $subjectAverage);
            $subjectGrade = '';
            $class_grade = $this->get_grade_in_class($classSessID);
            //echo(count($Grade)) . ',';
            for ($loop = 1; $loop < count($Grade); $loop++) {
                //echo $Grade[$loop] . '=';
                foreach ($class_grade as $cgrade) {                    
                    if ((int)$Grade[$loop] >= (int)$cgrade->minMarks && (int)$Grade[$loop] <= (int)$cgrade->maxMarks) {
                        $subjectGrade = $subjectGrade . ',' . $cgrade->grade;
                        //echo $cgrade->grade . ',';
                    }
                }
            }
            //echo '<br/>';
            //die();
            //---------------------------Updating/Inserting in Database
            $this->db->where('regid', $stuData->regid);
            $this->db->where('CLSSESSID', $classSessID);
            $this->db->where('SESSID', $year__);
            $query = $this->db->get('exam_13_calculated_result');

            if ($query->num_rows($query) != 0) {
                $data = array(
                    'subjectID' => $subject,
                    'term1Result' => $term1,
                    'term2Result' => $term2,
                    'averageResult' => $subjectAverage,
                    'subjectGrade' => $subjectGrade,
                    'subjectRank' => '',
                    'USERNAME_' => $this->session->userdata('_user___'),
                );
                $this->db->where('regid', $stuData->regid);
                $this->db->where('CLSSESSID', $classSessID);
                $this->db->where('SESSID', $year__);
                $query = $this->db->update('exam_13_calculated_result', $data);
            } else {
                $data = array(
                    'regid' => $stuData->regid,
                    'CLSSESSID' => $classSessID,
                    'ROLLNO' => 0,
                    'subjectID' => $subject,
                    'term1Result' => $term1,
                    'term2Result' => $term2,
                    'averageResult' => $subjectAverage,
                    'subjectGrade' => $subjectGrade,
                    'SESSID' => $year__,
                    'USERNAME_' => $this->session->userdata('_user___'),
                );

                $query = $this->db->insert('exam_13_calculated_result', $data);
            }
        }

        //-----------------Calculating Rank-------------------------
        $noOfsubject = explode(",", $subject);
        $countSubject = count($noOfsubject);

        for ($loop = 2; $loop <= $countSubject; $loop++) {

            $sql = "SELECT regid,subjectRank, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(averageResult,',', '" . $loop . "'), ',',-1) AS DECIMAL( 4, 1 ) ) AS avgResult FROM  exam_13_calculated_result WHERE  CLSSESSID =  '" . $classSessID . "' AND  SESSID=  '" . $year__ . "' ORDER BY avgResult DESC ";
            $query = $this->db->query($sql);

            $avg = -1;
            $rank = 1;
            foreach ($query->result() as $row) {
                if ($avg != -1) {
                    if ($avg == $row->avgResult) {
                        $rank = $rank;
                    } else {
                        $rank++;
                    }
                }

                $subRank = $row->subjectRank;
                $subRank = $subRank . ',' . $rank;

                $data = array(
                    'subjectRank' => $subRank,
                );

                $this->db->where('regid', $row->regid);
                $this->db->where('CLSSESSID', $classSessID);
                $this->db->where('SESSID', $year__);
                $query = $this->db->update('exam_13_calculated_result', $data);

                $avg = $row->avgResult;
            }
        }
        //-----------------End Rank Calculation---------------------
        //-----------------Update Overall Result--------------------

        $this->db->select('regid, averageResult');
        $this->db->where('CLSSESSID', $classSessID);
        $this->db->where('SESSID', $year__);
        $query1 = $this->db->get('exam_13_calculated_result');

        foreach ($query1->result() as $row) {
            $overall = '';
            $total = 0;
            $avgResult = explode(",", $row->averageResult);
            for ($loop = 1; $loop < count($avgResult); $loop++) {
                $total = $total + (float) $avgResult[$loop];
            }
            $overall = $overall . ',' . $total;
            $percentage = $total / ($countSubject - 1);
            $overall = $overall . ',' . $percentage;

            foreach ($class_grade as $cgrade) {
                if ((int)$percentage >= (int)$cgrade->minMarks && (int)$percentage <= (int)$cgrade->maxMarks) {
                    $overall = $overall . ',' . $cgrade->grade;
                }
            }

            $data = array(
                'overallResult' => $overall,
            );
            $this->db->where('regid', $row->regid);
            $this->db->where('CLSSESSID', $classSessID);
            $this->db->where('SESSID', $year__);
            $query = $this->db->update('exam_13_calculated_result', $data);
        }

        //-----------------End Overall Result-----------------------
        //-----------------Overall Rank-----------------------------
        $sql = "SELECT regid,overallResult, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(overallResult,',',2), ',',-1) AS DECIMAL( 4, 1 ) ) AS result FROM  exam_13_calculated_result WHERE  CLSSESSID =  '" . $classSessID . "' AND  SESSID=  '" . $year__ . "' ORDER BY result DESC ";
        $query = $this->db->query($sql);

        $avg = -1;
        $rank = 1;
        foreach ($query->result() as $row) {
            if ($avg != -1) {
                if ($avg == $row->result) {
                    $rank = $rank;
                } else {
                    $rank++;
                }
            }

            $overallRank = $row->overallResult;
            $overallRank = $overallRank . ',' . $rank;

            $data = array(
                'overallResult' => $overallRank,
            );

            $this->db->where('regid', $row->regid);
            $this->db->where('CLSSESSID', $classSessID);
            $this->db->where('SESSID', $year__);
            $query = $this->db->update('exam_13_calculated_result', $data);

            $avg = $row->result;
        }
        //-----------------End Overall Rank-------------------------
        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Result Updated/Calculated Successfully');
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Error! Please try after sometime');
        }

        return $bool_;
    }

    function get_overall_result_in_class($regID,$classSessID) {
        $year__ = $this->session->userdata('_current_year___');
        
        if($regID != 0){
            $this->db->where('regid', $regID);    
        }
        $this->db->where('CLSSESSID', $classSessID);        
        $this->db->where('SESSID', $year__);
        $query = $this->db->get('exam_13_calculated_result');
        
        return $query->result();
    }

}
