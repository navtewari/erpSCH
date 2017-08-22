<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_admission_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Exceptional Handling
            $this -> _db_error();
        // --------------------
    }  

    function getstudents_for_dropdown($classessid=''){
    	if($classessid!=''){
    		$this->db->where('CLASS_OF_ADMISSION', 	$classessid);
    	}
    	$this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $query = $this->db->get();
        return $query->result();
    }

    function getClasses_in_session($session){
        $this->db->where('SESSID', $session);
        $this->db->select('CLSSESSID, CLASSID');
        $query = $this->db->get('class_2_in_session');
        return $query->result();
    }

    function getState(){
        $query = $this->db->get('master_3_state_');
        return $query->result();
    }

    function update_Admission(){
        if($this->input->post('cmbRegistrationID') == 'new'){
            $data = $this->createRegID();
            $regid_ = $data['regid__'];
            $pid_ = $data['pid_'];
            $newid_ = $data['newid_'];
        } else {
            $regid_ = $this->input->post('cmbRegistrationID');
        }
        $class_this_session = $this->input->post('cmbClassofAdmission');

        if($this->input->post('cmbRegistrationID') == 'new'){
            $dataPersonal = array(
            'FNAME' => $this->input->post('txtFullName'),
            'MNAME' => '-x-',
            'LNAME' => '-x-',
            'DOB_' => $this->input->post('txtStudDOB'),
            'GENDER' => $this->input->post('optStuGender'),
            'FATHER' => $this->input->post('txtFatherName'),
            'F_MOBILE' => $this->input->post('txtFatherMobile'),
            'F_EMAIL' => $this->input->post('txtFatherEmail'),
            'F_PROFESSION' => $this->input->post('txtFatherProfession'),
            'MOTHER' => $this->input->post('txtMotherName'),
            'M_MOBILE' => $this->input->post('txtMotherMobile'),
            'M_EMAIL' => $this->input->post('txtMotherEmail'),
            'M_PROFESSION' => $this->input->post('txtMotherProfession'),
            'regid' => $regid_,
            'SESSID' => $this->session->userdata('_current_year___'),
            'USERNAME_' => $this->session->userdata('_user___'),
            'DATE_' => date('Y-m-d H:i:s')
            );
            $dataAcademics = array(
                'DOA' => $this->input->post('txtDOA'),
                'CLASS_OF_ADMISSION' => $class_this_session,
                'STATUS_OF_ADMISSION' => 0,
                'ANY_REMARK' => '-x-',
                'regid' => $regid_,
                'SESSID' => $this->session->userdata('_current_year___'),
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s'),
                'STATUS_' => 1
            );
            $dataCorresAdd = array(
                'STREET_1' => $this->input->post('txtCAddress'),
                'CITY_' => $this->input->post('txtCCity'),
                'PIN_' => $this->input->post('txtCPinCode'),
                'DISTT_' => $this->input->post('txtCDistt'),
                'STATE_' => $this->input->post('cmbCState'),
                'COUNTRY_' => $this->input->post('txtCCountry'),
                'DOC_' => date('Y-m-d H:i:s'),
                'STATUS' => '1',
                'ADDRESS_STATUS' => 'CORRESPONDANCE',
                'regid' => $regid_,
                'SESSID' => $this->session->userdata('_current_year___'),
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
            );
            $dataPerAdd = array(
                'STREET_1' => $this->input->post('txtPAddress'),
                'CITY_' => $this->input->post('txtPCity'),
                'PIN_' => $this->input->post('txtPPinCode'),
                'DISTT_' => $this->input->post('txtPDistt'),
                'STATE_' => $this->input->post('cmbPState'),
                'COUNTRY_' => $this->input->post('txtPCountry'),
                'DOC_' => date('Y-m-d H:i:s'),
                'STATUS' => '1',
                'ADDRESS_STATUS' => 'PERMANENT',
                'regid' => $regid_,
                'SESSID' => $this->session->userdata('_current_year___'),
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
            );
            $dataStuContact = array(
                'MOBILE_S' => $this->input->post('txtStudentPhone'),
                'PH_S' => '-x-',
                'EMAIL_S' => $this->input->post('txtEmail'),
                'DOC_' => date('Y-m-d H:i:s'),
                'STATUS' => '1',
                'CONTACT_STATUS' => 'CORRESPONDANCE',
                'regid' => $regid_,
                'SESSID' => $this->session->userdata('_current_year___'),
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
            );
            $query = $this->db->insert('master_8_stud_academics', $dataAcademics);
            $query = $this->db->insert('master_7_stud_personal', $dataPersonal);
            $query = $this->db->insert('master_9_stud_address', $dataCorresAdd);
            $query = $this->db->insert('master_9_stud_address', $dataPerAdd);
            $query = $this->db->insert('master_10_stud_contact', $dataStuContact);

            if ($query == true) {
                $i = $this->updateID___($pid_, $newid_, $regid_);
                if($i == true){
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Submitted Successfully..!!');
                } else {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Something goes wrong with new reg ID. Please try again...!!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again...!!');
            }

        } else {
            $dataPersonal = array(
            'FNAME' => $this->input->post('txtFullName'),
            'MNAME' => '-x-',
            'LNAME' => '-x-',
            'DOB_' => $this->input->post('txtStudDOB'),
            'GENDER' => $this->input->post('optStuGender'),
            'FATHER' => $this->input->post('txtFatherName'),
            'F_MOBILE' => $this->input->post('txtFatherMobile'),
            'F_EMAIL' => $this->input->post('txtFatherEmail'),
            'F_PROFESSION' => $this->input->post('txtFatherProfession'),
            'MOTHER' => $this->input->post('txtMotherName'),
            'M_MOBILE' => $this->input->post('txtMotherMobile'),
            'M_EMAIL' => $this->input->post('txtMotherEmail'),
            'M_PROFESSION' => $this->input->post('txtMotherProfession'),
            'USERNAME_' => $this->session->userdata('_user___'),
            'DATE_' => date('Y-m-d H:i:s')
            );
            $dataAcademics = array(
                'DOA' => $this->input->post('txtDOA'),
                'CLASS_OF_ADMISSION' => $class_this_session,
                'STATUS_OF_ADMISSION' => 0,
                'ANY_REMARK' => '-x-',
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s'),
            );
            $dataCorresAdd = array(
                'STREET_1' => $this->input->post('txtCAddress'),
                'CITY_' => $this->input->post('txtCCity'),
                'PIN_' => $this->input->post('txtCPinCode'),
                'DISTT_' => $this->input->post('txtCDistt'),
                'STATE_' => $this->input->post('cmbCState'),
                'COUNTRY_' => $this->input->post('txtCCountry'),
                'ADDRESS_STATUS' => 'CORRESPONDANCE',
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
            );
            $dataPerAdd = array(
                'STREET_1' => $this->input->post('txtPAddress'),
                'CITY_' => $this->input->post('txtPCity'),
                'PIN_' => $this->input->post('txtPPinCode'),
                'DISTT_' => $this->input->post('txtPDistt'),
                'STATE_' => $this->input->post('txtPState'),
                'COUNTRY_' => $this->input->post('txtPCountry'),
                'ADDRESS_STATUS' => 'PERMANENT',
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
            );
            $dataStuContact = array(
                'MOBILE_S' => $this->input->post('txtStudentPhone'),
                'PH_S' => '-x-',
                'EMAIL_S' => $this->input->post('txtEmail'),
                'CONTACT_STATUS' => 'CORRESPONDANCE',
                'USERNAME_' => $this->session->userdata('_user___'),
                'DATE_' => date('Y-m-d H:i:s')
            );
            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_8_stud_academics', $dataAcademics);

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_7_stud_personal', $dataPersonal);

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_9_stud_address', $dataCorresAdd);

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_9_stud_address', $dataPerAdd);

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_10_stud_contact', $dataStuContact);

            if ($query == true) {
                $bool_ = array('res_' => TRUE, 'msg_' => 'Updated Successfully..!!');
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again...!!');
            }
        }
        return $bool_;
    }

    function updateID___($pid_, $newid_, $regid_){
        $this -> db -> where('SESSIONID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('_id_');
        
        if ($query->num_rows() != 0) {
            $this->db->where('ID_', $pid_);
            $data = array('ID_' => $newid_, 'regid_' => $regid_, 'SESSIONID' => $this->session->userdata('_current_year___'));
            $bool_ = $this->db->update('_id_', $data);
        } else {
            $data = array('ID_' => $newid_, 'regid_' => $regid_,'SESSIONID' => $this->session->userdata('_current_year___'));
            $bool_ = $this->db->insert('_id_', $data);
        }
        return $bool_;
    }

    function createRegID() {
        $this -> db -> where('SESSIONID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('_id_');
        
        $yr = explode('-', $this->session->userdata('_current_year___'));
        
        $regid__ = $yr[0] . date('m');

        if ($query->num_rows() != 0) {
            $item = $query->row();
            $data['pid_'] = $pid_ = $id_ = $item->ID_;
            $data['newid_'] = $id_ = $id_ + 1;
            $flag_ = TRUE;
        } else {
            $data['newid_'] = $id_ = 1001;
            $data['pid_'] = $id_;
            $flag_ = FALSE;
        }

        $data['regid__'] = $regid__ . $id_;

        return $data;
    }

    function _db_error(){
        //exception handling ------------------
        if ($this -> db -> trans_status() == FALSE) {
            echo "gadbad";
            die();
            //redirect('web/dberror');
        }
        //-------------------------------------
    }
}