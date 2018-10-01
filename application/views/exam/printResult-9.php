<?php if (count($subject_marks) != 0) { ?>
    <html>
        <head>
            <title> Result of <?php echo $reg_id; ?> </title>
            <!-- Bootstrap CSS -->
            <link href="<?PHP echo base_url() . 'assets_/css/bootstrap.min.css'; ?>" rel="stylesheet">
            <!-- bootstrap theme -->
            <link href="<?PHP echo base_url() . 'assets_/css/bootstrap-theme.css'; ?>" rel="stylesheet">
            <!--external css-->
            <!-- font icon -->
            <link href="<?PHP echo base_url() . 'assets_/css/elegant-icons-style.css'; ?>" rel="stylesheet" />
            <link href="<?PHP echo base_url() . 'assets_/css/font-awesome.min.css'; ?>" rel="stylesheet" />
            <style type="text/css" media="print">
                body{ margin-top: 0px }
                .hide_button{ display: none }
            </style>
            <style>
                td{font-size: 13px;font-weight: 600;}
                .table_{
                    border: #000000 solid 1px;                    
                    width:95%;
                }                               
            </style>
        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 hide_button" align="center">
                        <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-12">
                        <table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center">
                            <tr align="center">
                                <td width="100"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100" / ></td>
                                <td>
                                    <h1><?php echo $sch_name; ?></h1>
                                    <h5><?php echo $sch_remark; ?></h5>
                                    <h6><?php echo $sch_addr; ?>, Contact No-<?php echo $sch_contact; ?></h6> 
                                    <h6>Email-<?php echo $sch_email; ?></h6>
                                </td>
                            </tr>
                            <tr align="center" style="border-top:#000000 solid 0px;">
                                <td colspan="2"><h2 style="margin: 0px;"><u>REPORT CARD</u></h2></td>
                            </tr>                            
                            <tr align="center" style="border-top:#000000 solid 0px;line-height:25px;">
                                <td colspan="2"><h5><b><span style="float:left;">Class: <?php echo $classID; ?> </span><span style="float:right;">Academic Year: (<?php echo $this->session->userdata('_current_year___'); ?>)</span></b></h5></td>
                            </tr>
                            <!-- Student Information -->
                            <tr style="border-top:#000000 solid 0px;">
                                <td colspan="2">
                                    <table border="0" style="line-height:25px;" width="100%">
                                        <tr>
                                            <td width='50%'>
                                                <?php
                                                foreach ($student_per_data as $stuData) {
                                                    $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                    $name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                    $name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                    ?>

                                                    Student's Name: <b><?php echo $name_ ?></b><br>
                                                    Father's Name: <b><?php echo $stuData->FATHER; ?></b><br>                                                    
                                                    Mother's Name: <b><?php echo $stuData->MOTHER; ?></b><br> 
                                                    Date Of Birth: <b><?php echo $stuData->DOB_; ?></b><br>
                                                <?php } ?>
                                            </td>
                                            <td style="padding-left: 100px;" valign="top">
                                                <span style="float:right">
                                                    <?php foreach ($student_per_data as $stuData) { ?>                                                                                                        
                                                        Admission No: <b><?php echo $reg_id; ?></b><br>
                                                    <?php } ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Scholastic Area -->
                            <tr>
                                <td colspan="2">
                                    <table border="1" cellpadding="5" width="100%">
                                        <tr>
                                            <td width="16%">Scholastic Areas</td>
                                            <?php
                                            $schCount = 0;
                                            foreach ($sch_data_class as $scho_items) {
                                                $schCount++;
                                            }
                                            ?>

                                            <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>"><?php echo $exterm->termName; ?></td>
                                            <?php } ?>
                                            <td colspan="2" align="center">OVERALL<br> Term 1 + Term 2 <br>(50) + (50)</td>
                                        </tr>

                                        <tr align="center">
                                            <td>Subject Name</td>
                                            <?php $grandTotal = 0; ?>
                                            <?php foreach ($exam_term as $exterm) { ?> <!-- for each exam term -->
                                                <?php
                                                $totalMarks = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    ?> <!-- for each Scholastic item -->
                                                    <td align="center"><?php echo $scho_items->item; ?><br> (<?php
                                                        echo $scho_items->maxMarks;
                                                        $totalMarks = $totalMarks + $scho_items->maxMarks;
                                                        ?>)</td>
                                                <?php } ?>
                                                <td align="center">Marks<br>Obtained <br> <?php
                                                    echo '(' . $totalMarks . ')';
                                                    $grandTotal = $grandTotal + $totalMarks;
                                                    $totalMarks = 0;
                                                    ?></td>                                                
                                            <?php } ?>
                                            <td>Grand Total<br>(<?php echo $grandTotal; ?>)</td>
                                            <td>Grade</td>
                                        </tr>

                                        <?php $overallMarks = 0; foreach ($subject_class as $subjectClass) { ?>
                                            <tr>
                                                <td><?php echo $subjectClass->subName;
                                    $grandTotalSubject = 0; ?></td>
                                                <?php foreach ($exam_term as $exterm) { ?>
                                                    <?php $totalNumber_subject = 0; ?>
                                                    <?php foreach ($sch_data_class as $scho_items) { ?>
                                                        <?php $printData = false; ?>
                                                        <?php foreach ($subject_marks as $sub_marks) { ?>
                                                            <?php if ($subjectClass->subjectID == $sub_marks->subjectID) { ?>
                                                                    <?php if ($sub_marks->termID == $exterm->termID && $sub_marks->itemID == $scho_items->itemID) { ?>
                                                                    <td align="center">
                                                                        <?php
                                                                        echo $sub_marks->marks;
                                                                        $totalNumber_subject = $totalNumber_subject + $sub_marks->marks;
                                                                        $printData = true;
                                                                        ?>
                                                                    </td>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if ($printData == false) { ?>
                                                            <td></td>
                                                            <?php
                                                            $printData = false;
                                                        }
                                                        ?>
                                                        <?php } ?>
                                                    <td align="center">
                                                        <?php
                                                        if ($totalNumber_subject == -1) {
                                                            echo '';
                                                        } else {
                                                            echo $totalNumber_subject;
                                                            $grandTotalSubject = $grandTotalSubject + $totalNumber_subject;
                                                        }
                                                        ?>
                                                    </td>                                                    
        <?php } ?>                              <td align="center">
                                                    <?php $grandTotalSubject=$grandTotalSubject/2; 
                                                    echo $grandTotalSubject;
                                                    $overallMarks=$overallMarks + $grandTotalSubject;?>    
                                                </td>

                                                <td align="center">
                                                    <?php foreach ($class_grade as $cgrade) { ?>
                                                        <?php
                                                        if ($grandTotalSubject >= $cgrade->minMarks && $grandTotalSubject <= $cgrade->maxMarks) {
                                                            echo $cgrade->grade;
                                                        } else {
                                                            echo '';
                                                        }
                                                        ?>
                                            <?php } ?>
                                                </td>
                                            </tr>
    <?php } ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    8 point grading scale -
                                    <?php foreach ($class_grade as $cgrade) { ?>
                                    <?php echo $cgrade->grade; ?>(<?php echo $cgrade->minMarks . "%"; ?> - <?php echo $cgrade->maxMarks . "%"; ?>),                                            
                                        <?php } ?> 
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <table cellpadding="5" width="100%">
                                        <td style="border: 1px #000000 solid">Overall Marks</td>
                                        <td style="border: 1px #000000 solid"><?php echo $overallMarks;?></td>
                                        <td style="width:100px;"></td>
                                        <td style="border: 1px #000000 solid">Percentage</td>
                                        <td style="border: 1px #000000 solid"></td>
                                        <td style="width:100px;"></td>
                                        <td style="border: 1px #000000 solid">Grade</td>
                                        <td style="border: 1px #000000 solid"></td>
                                        <td style="width:100px;"></td>
                                        <td style="border: 1px #000000 solid">Rank</td>
                                        <td style="border: 1px #000000 solid"></td>
                                    </table>
                                </td>
                            </tr>
                            <!-- Co-Scholastic Area -->
                            <tr>
                                <td colspan="2">
                                    <table border="1" cellpadding="5" width="100%">
                                        <tr>
    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                <td width="43%" align="center" colspan="2">Co-Scholastic Area: <?php echo $exterm->termName; ?> <font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>                                                
                                        <?php } ?>                                                
                                        </tr>
                                        <tr><td></td><td align="center">Grade</td><td></td><td align="center">Grade</td></tr>
                                            <?php foreach ($cosch_data_class as $coSch) { ?>
                                            <tr>
                                                <?php foreach ($exam_term as $exterm) { ?>                                                    
                                                    <td><?php echo $coSch->coitem; ?></td>
                                                    <?php $printTD1 = false; ?>
                                                        <?php foreach ($coSch_marks as $coSchMarks) { ?>
                                                            <?php if ($coSchMarks->termID == $exterm->termID) { ?>
                                                                <?php if ($coSchMarks->coitemID == $coSch->coitemID) { ?>
                                                                <td align="center">
                                                                    <?php
                                                                    echo $coSchMarks->grade;
                                                                    $printTD1 = true;
                                                                    ?>
                                                                </td>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?> 
                                                    <?php if ($printTD1 == false) { ?>
                                                        <td></td>
                                                        <?php
                                                        $printTD1 = false;
                                                    }
                                                    ?>
        <?php } ?>                                                                                                                                               
                                            </tr>
    <?php } ?>
                                    </table>
                                </td>
                            </tr>

                            <tr height="50">
                                <td colspan="2">Teacher's Remarks
                                    <span style='border-bottom: #999999 dashed 1px; font-size: 17px;'>
                                        <?php
                                        foreach ($teacher_remarks as $remarks) {
                                            echo $remarks->teacherRemark;
                                        }
                                        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                </td>
                            </tr>

                            <tr height="80">
                                <td colspan="2">Promoted to Class
                                    <span style='border-bottom: #999999 dashed 1px; font-size: 17px;'>
                                        <?php
                                        foreach ($teacher_remarks as $remarks) {
                                            echo $remarks->promotedClass;
                                        }
                                        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                </td>
                            </tr>

                            <tr height="80px;">
                                <td colspan="2" valign="bottom">
                                    <table border='0' width="100%">
                                        <tr>
                                            <td align="center">Date: <?php echo date('d/m/Y'); ?></td>
                                            <td align="center">Signature of Class Teacher</td>
                                            <td align="center">Signature of Principal</td>
                                        </tr>
                                    </table>
                                </td> 
                            </tr>
                        </table>                        
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    echo 'No data Present for ' . $reg_id;
}
?>

