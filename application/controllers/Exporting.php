<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exporting extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_export_model', 'mem');        
    }

    function toCsv($clssessid, $cls) {
        $this->mem->toCsv($clssessid, $cls);
    }
    function toCsv2($clssessid, $cls){
        $this->mem->toCsv2($clssessid, $cls);
    }
    function toCsvExam() {
        $clssessid = $this->input->post('txtClassSessID');
        $cls = $this->input->post('txtClassName');

        $this->mem->mtoCsvExam($clssessid, $cls);        
    }

    function backup() {
        $backup = $this->mem->backup();
        redirect($_SERVER['HTTP_REFERER']);
    }

    function importcsvExam() {
        $data = $this->mem->insert_csv();
        echo json_encode($data);
    }
    
    function importcsvUpdateExam() {
        $data = $this->mem->insert_csvUpdate();
        echo json_encode($data);
    }

    function pendingCode_notWorking() {
        require APPATH . '/third_party/PHPExcel/Classes/PHPExcel.php';
        require APPATH . '/third_party/PHPExcel/Classes/PHPExcel/writer/Excel2007.php';
        $data['lgn'] = $this->mm->getlogin();

        $objPHPExcel = new PHPExcel();
        //$objPHPExcel->getProperties()->setLastModified('');
        $objPHPExcel->getProperties()->setTitle('');
        $objPHPExcel->getProperties()->setSubject('');
        $objPHPExcel->getProperties()->setDescription('');

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Title 1');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title 2');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Title 3');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Title 4');

        $row = 2;
        foreach ($lgn as $item) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $item['username']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, 'Value2');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, 'Value3');
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, 'Value3');
            $row++;
        }

        $filename = "Task-Exported-on-" . date('Y-m-d-H-i-s') . '.xls';
        $objPHPExcel->getActiveSheet()->setTitle("Task-Overview");

        header('Content-Type: application/vnd.ms-excel-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
    }

    function export_fee_total_class_collection_no_discount(){
        $x = explode('/',$this->input->post('txtDateFrom'));
        $datefrom = $x[2]."-".$x[1]."-".$x[0];
        $y = explode('/', $this->input->post('txtDateTo'));
        $dateto = $y[2]."-".$y[1]."-".$y[0];
        $class__ = $this->input->post('cmbClassForTotalCollection');
        $cls_ = $this->input->post('cls');

        $this->mem->fee_total_class_collection_no_discount($cls_, $class__, $datefrom, $dateto);
    }

    function export_fee_total_class_collection_with_discount(){
        $x = explode('/',$this->input->post('txtDateFrom'));
        $datefrom = $x[2]."-".$x[1]."-".$x[0];
        $y = explode('/', $this->input->post('txtDateTo'));
        $dateto = $y[2]."-".$y[1]."-".$y[0];
        $class__ = $this->input->post('cmbClassForTotalCollection');
        $cls_ = $this->input->post('cls');

        $this->mem->fee_total_class_collection_with_discount($cls_, $class__, $datefrom, $dateto);
    }

    function export_fee_total_class_collection_consolidate(){
        $x = explode('/',$this->input->post('txtDateFrom'));
        $datefrom = $x[2]."-".$x[1]."-".$x[0];
        $y = explode('/', $this->input->post('txtDateTo'));
        $dateto = $y[2]."-".$y[1]."-".$y[0];
        $class__ = $this->input->post('cmbClassForTotalCollection');
        $cls_ = $this->input->post('cls');

        $this->mem->fee_total_class_collection_consolidate($cls_, $class__, $datefrom, $dateto);   
    }

}
