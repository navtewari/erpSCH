<?php if (count($subject_marks) != 0) { ?>
    <html>
        <head>
            <title> Print Result </title>
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
                    display: block !important;
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
                <?php foreach ($student_per_data as $stuData) { ?>
                    <div class="row" style="margin-top:70px;page-break-after: always;">
                        <div class="col-sm-12">
                            <table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center">
                                <tr align="center">
                                    <td width="100"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100" / ></td>
                                    <td>
                                        <h2><?php echo $sch_name; ?></h2>
                                        <h4><?php echo $sch_remark; ?></h4>
                                        <h6><?php echo $sch_addr; ?>, Contact No-<?php echo $sch_contact; ?>, Email-<?php echo $sch_email; ?></h6>
                                    </td>
                                </tr>
                                <tr align="center" style="border-top:#000000 solid 1px;line-height:25px;"><td colspan="2"><b>Academic Year - (<?php echo $this->session->userdata('_current_year___'); ?>)<br>Progress Report of Class <?php echo $classID; ?></b></td></tr>
                                <!-- Student Information -->
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <table border="0" style="line-height:25px;" width="100%">
                                            <tr>
                                                <td width='50%'>
                                                    <?php
                                                    $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                    $name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                    $name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                    ?>

                                                    Student's Name: <b><?php echo $name_ ?></b><br>
                                                    Mother's Name: <b><?php echo $stuData->MOTHER; ?></b><br>
                                                    Father's Name: <b><?php echo $stuData->FATHER; ?></b><br>
                                                </td>
                                                <td style="padding-left: 100px;" valign="top">
                                                    Date Of Birth: <b><?php echo $stuData->DOB_; ?></b><br>
                                                    Class: <b><?php echo $classID; ?></b><br>
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
                                                    <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>"><?php echo $exterm->termName; ?></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Subject Name</td>
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
                                                        $totalMarks = 0;
                                                        ?></td>
                                                    <td align="center">Grade</td>
                                                <?php } ?>
                                            </tr>

                                            <?php foreach ($subject_class as $subjectClass) { ?>
                                                <tr>
                                                    <td><?php echo $subjectClass->subName ?></td>
                                                    <?php foreach ($exam_term as $exterm) { ?>
                                                        <?php $totalNumber_subject = -1; ?>
                                                        <?php foreach ($sch_data_class as $scho_items) { ?>
                                                            <?php $printData = false; ?>
                                                            <?php foreach ($subject_marks as $sub_marks) { ?>
                                                                <?php if ($stuData->regid == $sub_marks->regid) { ?>
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
                                                            }
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php foreach ($class_grade as $cgrade) { ?>
                                                                <?php
                                                                if ($totalNumber_subject >= $cgrade->minMarks && $totalNumber_subject <= $cgrade->maxMarks) {
                                                                    echo $cgrade->grade;
                                                                } else {
                                                                    echo '';
                                                                }
                                                                ?>
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
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
                                                        <?php $printTD1 = false; ?>
                                                        <td><?php echo $coSch->coitem; ?></td>
                                                        <?php foreach ($coSch_marks as $coSchMarks) { ?>
                                                            <?php if ($stuData->regid == $coSchMarks->regid) { ?>
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
                                                        <?php } ?>
                                                        <?php if ($printTD1 == false) { ?>
                                                            <td> </td>
                                                        <?php }
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
                                                if ($stuData->regid == $remarks->regid) {
                                                    echo $remarks->teacherRemark;
                                                }
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
                                                if ($stuData->regid == $remarks->regid) {
                                                    echo $remarks->promotedClass;
                                                }
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
                            <table border="0" width="95%" height="auto" cellpadding="10" align="center" style="border: #000000 solid 1px;">
                                <tr>
                                    <td colspan="2" align="center"><h4 align="center">Instructions</h4>Grading Scale for Scholastic Areas: Grades are awarded on a 8-point grading scale as follows</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <table width="40%" border="1" cellpadding="2">
                                            <tr>
                                                <td align="center">Marks Range</td>
                                                <td align="center">Grade</td>
                                            </tr>
                                            <?php foreach ($class_grade as $cgrade) { ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $cgrade->minMarks; ?> - <?php echo $cgrade->maxMarks; ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $cgrade->grade; ?>
                                                        <?php if($cgrade->description!=''){
                                                        echo '(' .$cgrade->description . ')';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </body>
    </html>
    <?php
} else {
    echo 'No Exam data Present for Select Class';
}
?>