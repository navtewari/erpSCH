<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('My_attendance_model', 'mam');
        $this->load->model('my_model', 'mm');    
        $this->load->model('my_admission_model', 'mam');
    }
    function index(){
        $this -> check_login();

        $data['breadCrumb'] = 'Take Attendance';
        $data['title'] = 'MANAGE ATTENDANCE';

        $data['last_reg_'] = $this -> mm -> last_registration();

        $data['menu_'] = $this -> mnum -> get_menu();
        $data['submenu_'] = $this -> mnum -> get_submenu();

        $data['classesincurrentsession'] = $this->mam->getClasses($this->session->userdata('_current_year___'));

        $this -> load -> view('templates/header', $data);
        $this -> load -> view('attendance/add_attendance', $data);
        $this -> load -> view('templates/footer');
    }
    function check_login(){
        if(! $this -> session -> userdata('_user___')) redirect('web/logout');
    }

    function getstudentsforclass(){
        $clssessid = $this->input->post('ClassSessid_');
        $studentdata = $this->mam->get_students_in_class($clssessid, $this->session->userdata('_current_year___'));
        echo json_encode($studentdata);
    }

    function checkExistingAttendance(){
        $bool_ = $this->mam->checkExistingAttendance();
        echo $bool_;
    }

    function takeattendance(){
        $data['no__'] = json_decode($this->mam->takeattendance());
        echo json_encode($data['no__']);
    }

    function viewconsolidate(){
        $this -> check_login();

        $data['breadCrumb'] = 'View Consolidate Attendance';
        $data['title'] = 'View/ Print Consolidate ATTENDANCE';

        $data['last_reg_'] = $this -> mm -> last_registration();

        $data['menu_'] = $this -> mnum -> get_menu();
        $data['submenu_'] = $this -> mnum -> get_submenu();

        $data['classesincurrentsession'] = $this->mam->getClasses($this->session->userdata('_current_year___'));

        $this -> load -> view('templates/header', $data);
        $this -> load -> view('attendance/view_consolidate', $data);
        $this -> load -> view('templates/footer');
    }

    function viewdaywise(){
        $this -> check_login();

        $data['breadCrumb'] = 'View Daywise Attendance';
        $data['title'] = 'View/ Print Daywise ATTENDANCE';

        $data['last_reg_'] = $this -> mm -> last_registration();

        $data['menu_'] = $this -> mnum -> get_menu();
        $data['submenu_'] = $this -> mnum -> get_submenu();

        $data['classesincurrentsession'] = $this->mam->getClasses($this->session->userdata('_current_year___'));

        $this -> load -> view('templates/header', $data);
        $this -> load -> view('attendance/view_daywise', $data);
        $this -> load -> view('templates/footer');
    }

    function fetchdaywiseresult(){
        $data['students'] = $this->mam->getstudentsforclass($this->session->userdata('_current_year___'));
        $data['time_'] = $this->mam->fetchTime_for_day();
        $data['daywise'] = $this->mam->fetchAttendance_daywise();
        echo json_encode($data);
    }

    function fetchConsolidateresult(){
        $data['students'] = $this->mam->getstudentsforclass($this->session->userdata('_current_year___'));
        $data['date_'] = $this->mam->fetchAttendance_consolidate_date();
        $data['time_'] = $this->mam->fetchTime_for_days();
        $data['consolidate'] = $this->mam->fetchAttendance_consolidate_attendance();


        echo json_encode($data);
    }

    function sendSMS(){
        $msg = $this->input->post('MessageToPrint');

        if($this->input->post('yes') == 'Submit'){
            /* */ // Booking Message to Owner Mobile
                $username = "pop";
                $password = "pop123";
                $number = $this->input->post("mobilenumbers");
                $sender = "SCHOOL";
                $msg1=$this->input->post("Absent_Message");
                $message = rawurlencode($msg1);

                //$url="http://teamfreelancer.bulksms5.com/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&message=".urlencode($message)."&sender=".urlencode($sender)."&type=".urlencode('3');

                //$url = "http://www.login.bulksmsgateway.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($number) . "&sender=" . urlencode($sender) . "&message=" . urlencode($message) . "&type=" . urlencode('3');

                //$url = "http://teamfreelancer.bulksms5.com/unicodesmsapi.php?user=" . $username . "&password=" . $password . "&mobile=" . $number . "&sender=" . $sender . "&message=" . $message . "&type=3";
                
                $url="http://teamfreelancer.bulksms5.com/unicodesmsapi.php?username=".trim($username,'"')."&password=".trim($password,'"')."&mobilenumber=".trim($number,'"')."&message=".trim($message,'"')."&senderid=".trim($sender,'"')."&type=3";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
            /* */
            $data['msg_all'] = $msg.". And SMS is also sent to the Absantee's Parents.";
        } else {
            $data['msg_all'] = $msg.". But without any sms as cancelled by you.";
        }
        echo json_encode($data);
    }

}