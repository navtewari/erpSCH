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
