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
