<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_admission_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->my_library->changeDB();
        // Exceptional Handling
            $this->load->model('My_error_model', 'error');
        // --------------------
    }  

    function getstudents_for_dropdown_admission_form($session, $classessid=''){
        if($classessid!=''){
            $this->db->where('c.CLSSESSID',$classessid);
        }
        $this->db->where('b.SESSID', $session);
        $this->db->order_by('a.FNAME');
        $this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid, a.GENDER, b.CLASS_OF_ADMISSION, b.DOA, a.CATEGORY, d.CLASSID');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session d', 'b.CLASS_OF_ADMISSION=d.CLSSESSID');
        if($classessid!=''){
            $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        }
        $query = $this->db->get();

        return $query->result();
    }

    function get_admitted_students($session, $classessid=''){
        if($classessid!=''){
            $this->db->where('c.CLSSESSID',$classessid);
        }
        $this->db->where('c.SESSID', $session);
        $this->db->order_by('a.FNAME');
        $this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid, a.GENDER, b.CLASS_OF_ADMISSION, b.DOA, a.CATEGORY, d.CLASSID');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session d', 'b.CLASS_OF_ADMISSION=d.CLSSESSID');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        $query = $this->db->get();

        return $query->result();
    }

    function getstudents_for_dropdown($session, $classessid=''){
    	if($classessid!=''){
    		$this->db->where('c.CLSSESSID',$classessid);
    	}
        $this->db->where('c.SESSID', $session);
    	$this->db->select('a.FNAME, a.MNAME, a.LNAME, a.regid, a.GENDER, b.CLASS_OF_ADMISSION, b.DOA, d.CLASSID, a.CATEGORY');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_3_class_wise_students c', 'a.regid=c.regid');
        $this->db->join('class_2_in_session d', 'c.CLSSESSID=d.CLSSESSID');
        $query = $this->db->get();

        return $query->result();
    }

    function getClasses_in_session($session){
        $year__ = $session;
        $this -> db -> where ('b.SESSID', $year__);
        $this -> db -> order_by('ABS(a.CLASS)', 'asc');
        $this -> db -> order_by('a.SECTION', 'asc');
        $this -> db -> from('class_1_classes a');
        $this -> db -> join('class_2_in_session b', 'a.CLASSID=b.CLASSID');
        $query = $this -> db -> get();

        return $query -> result();
    }

    function getStudents_in_class_in_session($session){
        $year__ = $session;
        $this -> db -> select ('a.CLASSID, COUNT(c.regid) as TOTAL_STUDENTS, b.CLSSESSID');
        $this -> db -> where ('b.SESSID', $year__);
        $this -> db -> order_by('ABS(a.CLASS)', 'asc');
        $this -> db -> order_by('a.SECTION', 'asc');
        $this -> db -> group_by('c.CLSSESSID');
        $this -> db -> from('class_1_classes a');
        $this -> db -> join('class_2_in_session b', 'a.CLASSID=b.CLASSID', 'left outer');
        $this -> db -> join('class_3_class_wise_students c', 'b.CLSSESSID=c.CLSSESSID', 'left outer');
        $query = $this -> db -> get();

        return $query -> result();   
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
            if($this->session->userdata('live__') == $this->session->userdata('_current_year___')){
                $dataPersonal = array(
                'FNAME' => $this->input->post('txtFullName'),
                'MNAME' => '-x-',
                'LNAME' => '-x-',
                'PHOTO_' => 'no-image.jpg',
                'DOB_' => $this->input->post('txtStudDOB'),
                'GENDER' => $this->input->post('optStuGender'),
                'FATHER' => $this->input->post('txtFatherName'),
                'F_MOBILE' => $this->input->post('txtFatherMobile'),
                'F_EMAIL' => $this->input->post('txtFatherEmail'),
                'F_PROFESSION' => $this->input->post('txtFatherProfession'),
                'MOTHER' => $this->input->post('txtMotherName'),
                'CATEGORY'=> $this->input->post('cmbCategory'),
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

                $siblings = trim($this->input->post('txtSiblings'));
                $dataSibling = array(
                    'regid' => $regid_,
                    'SIBLINGS' => $siblings,
                    'DISCOUNT_OFFERED'=>1,
                    'DATE_'=> date('Y-m-d H:i:s'),
                    'USERNAME_' => $this->session->userdata('_user___'),
                    'STATUS' => 1
                );

                $discounts = trim($this->input->post('txtDiscounts'));
                $dataDiscount = array(
                    'regid' => $regid_,
                    'DISCOUNT'=>$discounts,
                    'DISCOUNT_OFFERED'=>1,
                    'DATE_'=> date('Y-m-d H:i:s'),
                    'USERNAME_' => $this->session->userdata('_user___'),
                    'STATUS' => 1  
                );

                $query = $this->db->insert('master_8_stud_academics', $dataAcademics);
                $query = $this->db->insert('master_7_stud_personal', $dataPersonal);
                $query = $this->db->insert('master_9_stud_address', $dataCorresAdd);
                $query = $this->db->insert('master_9_stud_address', $dataPerAdd);
                $query = $this->db->insert('master_10_stud_contact', $dataStuContact);

                if($siblings!=''){
                    $query = $this->db->insert('register_sibling', $dataSibling);
                    $this->no_discount_to_other_siblings($siblings); // Erase the sibling-discount offered to the selected siblings
                }

                if($discounts!=''){
                    $query = $this->db->insert('register_discount', $dataDiscount);
                }

                if ($query == true) {
                    $i = $this->updateID___($pid_, $newid_, $regid_);
                    if($i == true){
                        $bool_ = array('res_' => true, 'msg_' => 'New Reg ID: <b>'.$regid_.'</b> Submitted Successfully..!!');
                    } else {
                        $bool_ = array('res_' => true, 'msg_' => 'Something goes wrong with new reg ID. Please try again...!!');
                    }
                } else {
                    $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
                }
            } else {
                $bool_ = array('res_' => false, 'msg_' => 'Student can take admission only for the Session ' . $this->session->userdata('live__'));
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
            'CATEGORY'=> $this->input->post('cmbCategory'),
            'M_MOBILE' => $this->input->post('txtMotherMobile'),
            'M_EMAIL' => $this->input->post('txtMotherEmail'),
            'M_PROFESSION' => $this->input->post('txtMotherProfession'),
            'USERNAME_' => $this->session->userdata('_user___'),
            'DATE_' => date('Y-m-d H:i:s')
            );

            $dataAcademics = array(
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
                'STATE_' => $this->input->post('cmbPState'),
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

            $siblings = trim($this->input->post('txtSiblings'));

            //return $bool_ = array('res_' => TRUE, 'msg_' => $siblings);
            $dataSibling = array(
                'SIBLINGS' => $siblings,
                'DISCOUNT_OFFERED'=>1,
                'DATE_'=> date('Y-m-d H:i:s'),
                'USERNAME_' => $this->session->userdata('_user___'),
                'STATUS' => 1
            );

            $discounts = trim($this->input->post('txtDiscounts'));
            $dataDiscount = array(
                'regid' => $regid_,
                'DISCOUNT'=>$discounts,
                'DISCOUNT_OFFERED'=>1,
                'DATE_'=> date('Y-m-d H:i:s'),
                'USERNAME_' => $this->session->userdata('_user___'),
                'STATUS' => 1  
            );

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_8_stud_academics', $dataAcademics);

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_7_stud_personal', $dataPersonal);

            $this->db->where('regid', $regid_);
            $this->db->where('ADDRESS_STATUS', 'CORRESPONDANCE');
            $query = $this->db->update('master_9_stud_address', $dataCorresAdd);

            $this->db->where('regid', $regid_);
            $this->db->where('ADDRESS_STATUS', 'PERMANENT');
            $query = $this->db->update('master_9_stud_address', $dataPerAdd);

            $this->db->where('regid', $regid_);
            $query = $this->db->update('master_10_stud_contact', $dataStuContact);

            // Code for Siblings
            $this->db->where('regid', $regid_);
            $query = $this->db->get('register_sibling');
            
            if($siblings!=''){
                if($query->num_rows()!=0){
                    $this->db->where('regid', $regid_);
                    $query = $this->db->update('register_sibling', $dataSibling);
                } else {
                    if($siblings!=''){
                        $dataSibling = array(
                        'regid' => $regid_,
                        'SIBLINGS' => $siblings,
                        'DISCOUNT_OFFERED'=>1,
                        'DATE_'=> date('Y-m-d H:i:s'),
                        'USERNAME_' => $this->session->userdata('_user___'),
                        'STATUS' => 1
                        );
                        $query = $this->db->insert('register_sibling', $dataSibling);
                    }
                }
                $this->no_discount_to_other_siblings($siblings);
            } else {
                if($query->num_rows()!=0){
                    $this->db->where('regid', $regid_);
                    $this->db->delete('register_sibling');
                }
            }
            // -----------------

            // Code for Discounts
            $this->db->where('regid', $regid_);
            $query = $this->db->get('register_discount');
            if($discounts!=''){
                if($query->num_rows()!=0){
                    $this->db->where('regid', $regid_);
                    $query = $this->db->update('register_discount', $dataDiscount);
                } else {
                    if($discounts!=''){
                        $dataDiscount = array(
                        'regid' => $regid_,
                        'DISCOUNT' => $discounts,
                        'DISCOUNT_OFFERED'=>1,
                        'DATE_'=> date('Y-m-d H:i:s'),
                        'USERNAME_' => $this->session->userdata('_user___'),
                        'STATUS' => 1
                        );
                        $query = $this->db->insert('register_discount', $dataDiscount);
                    }
                }
            } else {
                $this->db->where('regid', $regid_);
                $query = $this->db->delete('register_discount');
            }
            // -----------------

            if ($query == true) {
                $bool_ = array('res_' => true, 'msg_' => 'Reg ID: <b>'.$regid_.'</b> Updated Successfully..!!');
            } else {
                $bool_ = array('res_' => false, 'msg_' => 'Something goes wrong. Please try again...!!');
            }
        }

        // Photo updation if selected by user to upload
        $path_ = $this->upload_stud_pic($regid_);
        if($path_ != 'x'){
            $data = array(
                'PHOTO_' => $path_
                );
            $this->db->where('regid', $regid_);
            $this->db->update('master_7_stud_personal', $data);
        }
        // --------------------------------------------

        return $bool_;
    }
    function no_discount_to_other_siblings($siblings){
        $arr = explode(",", $siblings);
        $dataSibling = array(
            'DISCOUNT_OFFERED'=>0,
            'DATE_'=> date('Y-m-d H:i:s'),
            'USERNAME_' => $this->session->userdata('_user___'),
            'STATUS' => 0
        );
        for($i=0;$i<count($arr);$i++){
            $this->db->where('regid', $arr[$i]);
            $this->db->update('register_sibling', $dataSibling);
        }


    }
    function updateID___($pid_, $newid_, $regid_){
        //$this -> db -> where('SESSIONID', $this->session->userdata('_current_year___'));
        $this->db->where('ID_', $pid_); // This is for new concept
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
        //$this -> db -> where('SESSIONID', $this->session->userdata('_current_year___'));
        $query = $this->db->get('_id_');
        
        $yr = explode('-', $this->session->userdata('_current_year___'));
        
        $regid__ = $yr[0] . date('m');

        if ($query->num_rows() != 0) {
            $item = $query->row();
            $data['pid_'] = $pid_ = $id_ = $item->ID_;
            $data['newid_'] = $id_ = $id_ + 1;
            $flag_ = TRUE;
        } else {
            //$data['newid_'] = $id_ = 1001;
            $data['newid_'] = $id_ = 0001; // new concept starts from 0001
            $data['pid_'] = $id_;
            $flag_ = FALSE;
        }

        //$data['regid__'] = $regid__ . $id_;
        $data['regid__'] = $regid__ . str_pad($id_, 4, "0", STR_PAD_LEFT); // new concept to concatenate

        return $data;
    }

    function upload_stud_pic($id){
        clearstatcache();
        $config = array(
            'upload_path' => './assets_/student_photo',
            'allowed_types' => 'jpg|png',
            'max_size' => 250,
            'file_name' => $id,
            'overwrite' => TRUE,
        );
        $file_element_name = 'txtPhotoUpload';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_element_name)) {
            $path_ji = $this->upload->data();
            $path_ = $path_ji['file_name'];
        } else {
            $path_ = 'x';
        }

        return $path_;
    }

    function get_admission_detail_1($regid_){
        $this->db->select('a.STUD_ID, a.FNAME, a.PHOTO_, a.DOB_, a.GENDER, a.FATHER, a.F_MOBILE, a.F_EMAIL, a.F_PROFESSION, a.MOTHER, a.CATEGORY, a.M_MOBILE, a.M_EMAIL, a.M_PROFESSION, a.SESSID, a.USERNAME_, b.DOA, b.CLASS_OF_ADMISSION, b.SESSID, e.CLASSID');
        $this->db->from('master_7_stud_personal a');
        $this->db->join('master_8_stud_academics b', 'a.regid=b.regid');
        $this->db->join('class_2_in_session e', 'b.CLASS_OF_ADMISSION=e.CLSSESSID');
        $this->db->where('a.regid', $regid_);
        //$this->db->where('b.STATUS_OF_ADMISSION', 0); //No Need as no registration table exists
        $query = $this->db->get();

        return $query->row();
    }
    function get_admission_detail_2($regid_, $type_){ //Permanent/Correspondance Addresses
        $this->db->where('ADDRESS_STATUS', $type_);
        $this->db->where('regid', $regid_);
        $query = $this->db->get('master_9_stud_address');

        // check transaction status
        $this->error->_db_error();
        // ------------------------
  
        return $query->row();
    }
    function get_admission_detail_3($regid_){ // Contact Detail
        $this->db->where('regid', $regid_);
        $query = $this->db->get('master_10_stud_contact');

        return $query->row();
    }
    function get_siblings_4($regid_){
        $this->db->where('regid', $regid_);
        $query = $this->db->get('register_sibling');

        return $query->row();   
    }
    function get_discount_5($regid_){
        $this->db->where('regid', $regid_);
        $query = $this->db->get('register_discount');

        return $query->row();   
    }
    function get_category(){
        $this->db->where('CATEGORY', 'CATEG');
        $query = $this->db->get('master_16_discount');

        return $query->result();
    }
    function get_student_category($regid){
        $this->db->where('CATEGORY', $regid);
        $query = $this->db->get('master_7_stud_personal');

        return $query->result();
    }
}