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

    function mdeleteTerm($termID){
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
}
