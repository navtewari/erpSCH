<?php

class My_library {
    
    function getMonthsName($no){
        $data = array(
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10=> 'October',
                11=> 'November',
                12=> 'December'
            );
        return $data[$no];
    }

    function changeDB(){
        $CI =& get_instance();
        if($CI->session->userdata('db2')){
            $CI->db = $CI->load->database($CI->session->userdata('db2'), true);
        } else {
            redirect('GEN_LOGIN');
        }
    }
}

?>
