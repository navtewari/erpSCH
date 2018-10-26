<?php if (count($subject_marks) != 0) { ?>
    <html>
        <head>
            <title> Result of Class <?php echo $classID; ?> </title>
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
            <?php if (count($student_per_data) == 1) { ?>
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
                                    <td width="150" valign="top"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="150"/></td>
                                    <td>
                                        <h1><?php echo $sch_name; ?></h1>
                                        <h4><?php echo $sch_remark; ?></h4>                                    
                                        <h4><?php echo $sch_addr . ', Disitt. ' . $sch_distt . ', ' . $sch_state . ', ' . $sch_country; ?></h4>                                    
                                        <h5>Email-<?php echo $sch_email; ?> , Website- <?php echo $website; ?></h5>
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
                                                <td colspan="3" align="center">OVERALL<br> Term 1 + Term 2 <br>(50) + (50)</td>
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
                                                <td>Rank</td>
                                            </tr>

                                            <?php
                                            foreach ($subject_class as $subjectClass) {
                                                ?>
                                                <tr>
                                                    <td><?php
                                                        echo $subjectClass->subName;
                                                        $term = 1;
                                                        ?></td>
                                                    <?php foreach ($exam_term as $exterm) { ?>                                                    
                                                        <?php foreach ($sch_data_class as $scho_items) { ?>
                                                            <?php $printData = false; ?>
                                                            <?php foreach ($subject_marks as $sub_marks) { ?>
                                                                <?php if ($subjectClass->subjectID == $sub_marks->subjectID) { ?>
                                                                    <?php if ($sub_marks->termID == $exterm->termID && $sub_marks->itemID == $scho_items->itemID) { ?>
                                                                        <td align="center">
                                                                            <?php
                                                                            echo $sub_marks->marks;
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
                                                            foreach ($overall_result as $over_result) {
                                                                $subjectID = explode(",", $over_result->subjectID);
                                                                if ($term == 1) {
                                                                    $subjectTotal = explode(",", $over_result->term1Result);
                                                                } else {
                                                                    $subjectTotal = explode(",", $over_result->term2Result);
                                                                }
                                                                for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                    if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                        echo $subjectTotal[$loop];
                                                                    }
                                                                }
                                                            }
                                                            if ($term == 1) {
                                                                $term++;
                                                            } else if ($term == 2) {
                                                                $term--;
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php } ?>                              
                                                    <td align="center">
                                                        <?php
                                                        foreach ($overall_result as $over_result) {
                                                            $subjectID = explode(",", $over_result->subjectID);
                                                            $subjectAvg = explode(",", $over_result->averageResult);
                                                            for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                    echo $subjectAvg[$loop];
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>

                                                    <td align="center">
                                                        <?php
                                                        foreach ($overall_result as $over_result) {
                                                            $subjectID = explode(",", $over_result->subjectID);
                                                            $subjectGrade = explode(",", $over_result->subjectGrade);
                                                            for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                    echo $subjectGrade[$loop];
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        foreach ($overall_result as $over_result) {
                                                            $subjectID = explode(",", $over_result->subjectID);
                                                            $subjectRank = explode(",", $over_result->subjectRank);
                                                            for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                    echo $subjectRank[$loop];
                                                                }
                                                            }
                                                        }
                                                        ?>
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
                                            <td style="border: 1px #000000 solid">
                                                <?php
                                                foreach ($overall_result as $over_result) {
                                                    $overallResult = explode(",", $over_result->overallResult);
                                                    echo $overallResult[1];
                                                }
                                                ?>
                                            </td>
                                            <td style="width:100px;"></td>
                                            <td style="border: 1px #000000 solid">Percentage</td>
                                            <td style="border: 1px #000000 solid">
                                                <?php
                                                foreach ($overall_result as $over_result) {
                                                    $overallResult = explode(",", $over_result->overallResult);
                                                    echo $overallResult[2];
                                                }
                                                ?>
                                            </td>
                                            <td style="width:100px;"></td>
                                            <td style="border: 1px #000000 solid">Grade</td>
                                            <td style="border: 1px #000000 solid">
                                                <?php
                                                foreach ($overall_result as $over_result) {
                                                    $overallResult = explode(",", $over_result->overallResult);
                                                    echo $overallResult[3];
                                                }
                                                ?>
                                            </td>
                                            <td style="width:100px;"></td>
                                            <td style="border: 1px #000000 solid">Rank</td>
                                            <td style="border: 1px #000000 solid">
                                                <?php
                                                foreach ($overall_result as $over_result) {
                                                    $overallResult = explode(",", $over_result->overallResult);
                                                    echo $overallResult[4];
                                                }
                                                ?>
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Co-Scholastic Area -->
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <td style="vertical-align:top;width:50%;">
                                                <table border="1" cellspacing="0" cellpadding="5" width="100%">                                        
                                                    <tr>
                                                        <td>Co-Scholastic Area:<font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>
                                                        <td align="center" colspan="2">Grade</td>                                            
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td align="center">T1</td>
                                                        <td align="center">T2</td>                                            
                                                    </tr>

                                                    <?php foreach ($cosch_data_class as $coSch) { ?>
                                                        <tr>                                                
                                                            <td><?php echo $coSch->coitem; ?></td>                                                        
                                                            <?php foreach ($exam_term as $exterm) { ?>
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

                                            <td style="vertical-align: top;">
                                                <table border="1" cellpadding="5" width="100%">                                        
                                                    <tr>
                                                        <td>Discipline Area:<font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>
                                                        <td align="center" colspan="2">Grade</td>                                            
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td align="center">T1</td>
                                                        <td align="center">T2</td>                                            
                                                    </tr>

                                                    <?php foreach ($discipline_data_class as $discipline) { ?>
                                                        <tr>                                                
                                                            <td><?php echo $discipline->disciplineitem; ?></td>                                                        
                                                            <?php foreach ($exam_term as $exterm) { ?>
                                                                <?php $printTD1 = false; ?>
                                                                <?php foreach ($discipline_marks as $disciplineMarks) { ?>
                                                                    <?php if ($disciplineMarks->termID == $exterm->termID) { ?>
                                                                        <?php if ($disciplineMarks->disciplineID == $discipline->disciplineID) { ?>
                                                                            <td align="center">
                                                                                <?php
                                                                                echo $disciplineMarks->grade;
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
            <?php } else { ?>
                <!-------------------------------------------------------------------------------ALL---->
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
                                        <td width="150" valign="top"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="150"/></td>
                                        <td>
                                            <h1><?php echo $sch_name; ?></h1>
                                            <h4><?php echo $sch_remark; ?></h4>                                    
                                            <h4><?php echo $sch_addr . ', Disitt. ' . $sch_distt . ', ' . $sch_state . ', ' . $sch_country; ?></h4>                                    
                                            <h5>Email-<?php echo $sch_email; ?> , Website- <?php echo $website; ?></h5>
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
                                                        <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>"><?php echo $exterm->termName; ?></td>
                                                    <?php } ?>
                                                    <td colspan="3" align="center">OVERALL<br> Term 1 + Term 2 <br>(50) + (50)</td>
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
                                                    <td>Rank</td>
                                                </tr>

                                                <?php
                                                foreach ($subject_class as $subjectClass) {
                                                    ?>
                                                    <tr>
                                                        <td><?php
                                                            echo $subjectClass->subName;
                                                            $term = 1;
                                                            ?></td>
                                                        <?php foreach ($exam_term as $exterm) { ?>                                                    
                                                            <?php foreach ($sch_data_class as $scho_items) { ?>
                                                                <?php $printData = false; ?>
                                                                <?php foreach ($subject_marks as $sub_marks) { ?>
                                                                    <?php if ($stuData->regid == $sub_marks->regid) { ?>
                                                                        <?php if ($subjectClass->subjectID == $sub_marks->subjectID) { ?>
                                                                            <?php if ($sub_marks->termID == $exterm->termID && $sub_marks->itemID == $scho_items->itemID) { ?>
                                                                                <td align="center">
                                                                                    <?php
                                                                                    echo $sub_marks->marks;
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
                                                                foreach ($overall_result as $over_result) {
                                                                    if ($stuData->regid == $over_result->regid) {
                                                                        $subjectID = explode(",", $over_result->subjectID);
                                                                        if ($term == 1) {
                                                                            $subjectTotal = explode(",", $over_result->term1Result);
                                                                        } else {
                                                                            $subjectTotal = explode(",", $over_result->term2Result);
                                                                        }
                                                                        for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                            if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                                echo $subjectTotal[$loop];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                if ($term == 1) {
                                                                    $term++;
                                                                } else if ($term == 2) {
                                                                    $term--;
                                                                }
                                                                ?>
                                                            </td>
                                                        <?php } ?>                              
                                                        <td align="center">
                                                            <?php
                                                            foreach ($overall_result as $over_result) {
                                                                if ($stuData->regid == $over_result->regid) {
                                                                    $subjectID = explode(",", $over_result->subjectID);
                                                                    $subjectAvg = explode(",", $over_result->averageResult);
                                                                    for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                        if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                            echo $subjectAvg[$loop];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>

                                                        <td align="center">
                                                            <?php
                                                            foreach ($overall_result as $over_result) {
                                                                if ($stuData->regid == $over_result->regid) {
                                                                    $subjectID = explode(",", $over_result->subjectID);
                                                                    $subjectGrade = explode(",", $over_result->subjectGrade);
                                                                    for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                        if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                            echo $subjectGrade[$loop];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            foreach ($overall_result as $over_result) {
                                                                if ($stuData->regid == $over_result->regid) {
                                                                    $subjectID = explode(",", $over_result->subjectID);
                                                                    $subjectRank = explode(",", $over_result->subjectRank);
                                                                    for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                        if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                            echo $subjectRank[$loop];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
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
                                                <td style="border: 1px #000000 solid">
                                                    <?php
                                                    foreach ($overall_result as $over_result) {
                                                        if ($stuData->regid == $over_result->regid) {
                                                            $overallResult = explode(",", $over_result->overallResult);
                                                            echo $overallResult[1];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width:100px;"></td>
                                                <td style="border: 1px #000000 solid">Percentage</td>
                                                <td style="border: 1px #000000 solid">
                                                    <?php
                                                    foreach ($overall_result as $over_result) {
                                                        if ($stuData->regid == $over_result->regid) {
                                                            $overallResult = explode(",", $over_result->overallResult);
                                                            echo $overallResult[2];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width:100px;"></td>
                                                <td style="border: 1px #000000 solid">Grade</td>
                                                <td style="border: 1px #000000 solid">
                                                    <?php
                                                    foreach ($overall_result as $over_result) {
                                                        if ($stuData->regid == $over_result->regid) {
                                                            $overallResult = explode(",", $over_result->overallResult);
                                                            echo $overallResult[3];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width:100px;"></td>
                                                <td style="border: 1px #000000 solid">Rank</td>
                                                <td style="border: 1px #000000 solid">
                                                    <?php
                                                    foreach ($overall_result as $over_result) {
                                                        if ($stuData->regid == $over_result->regid) {
                                                            $overallResult = explode(",", $over_result->overallResult);
                                                            echo $overallResult[4];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- Co-Scholastic Area -->
                                    <tr>
                                        <td colspan="2">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <td style="vertical-align:top;width:50%;">
                                                    <table border="1" cellspacing="0" cellpadding="5" width="100%">                                        
                                                        <tr>
                                                            <td>Co-Scholastic Area:<font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>
                                                            <td align="center" colspan="2">Grade</td>                                            
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td align="center">T1</td>
                                                            <td align="center">T2</td>                                            
                                                        </tr>

                                                        <?php foreach ($cosch_data_class as $coSch) { ?>
                                                            <tr>                                                
                                                                <td><?php echo $coSch->coitem; ?></td>                                                        
                                                                <?php foreach ($exam_term as $exterm) { ?>
                                                                    <?php $printTD1 = false; ?>
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

                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="5" width="100%">                                        
                                                        <tr>
                                                            <td>Discipline Area:<font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>
                                                            <td align="center" colspan="2">Grade</td>                                            
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td align="center">T1</td>
                                                            <td align="center">T2</td>                                            
                                                        </tr>

                                                        <?php foreach ($discipline_data_class as $discipline) { ?>
                                                            <tr>                                                
                                                                <td><?php echo $discipline->disciplineitem; ?></td>                                                        
                                                                <?php foreach ($exam_term as $exterm) { ?>
                                                                    <?php $printTD1 = false; ?>
                                                                    <?php foreach ($discipline_marks as $disciplineMarks) { ?>
                                                                        <?php if ($stuData->regid == $coSchMarks->regid) { ?>
                                                                            <?php if ($disciplineMarks->termID == $exterm->termID) { ?>
                                                                                <?php if ($disciplineMarks->disciplineID == $discipline->disciplineID) { ?>
                                                                                    <td align="center">
                                                                                        <?php
                                                                                        echo $disciplineMarks->grade;
                                                                                        $printTD1 = true;
                                                                                        ?>
                                                                                    </td>
                                                                                <?php } ?>
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
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!--------------------------------------------------------------------------------END ALL--->
            <?php } ?>
        </body>
    </html>
    <?php
} else {
    if (count($student_per_data) == 1) {
        echo 'No data Present for ' . $reg_id;
    } else {
        echo 'No data Present for Class' . $classID;
    }
}
?>
