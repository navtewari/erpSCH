<?php if (count($subject_marks) != 0) { ?>
    <html>
        <head>
            <title> Result of Class <?php echo $classID; ?> </title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap.min.css'); ?>" />                        
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
            <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
            <style type="text/css" media="print">               
                body{ margin-left:1.5em;margin-right:1.5; height:100vh;}
                .printWindow{margin-top: 1.5em;}
                .hide_button{ display: none; }
                .hide_pagination{
                    display:none;
                }
            </style>
            <style>
                td{font-size: 13px;font-weight: 600;}                
                .table_{
                    border: #000000 solid 1px;
                    width:95%;
                }                  
                ul li{
                    display:inline-block;
                    padding-right: 20px;
                    background: #f2f2f2;
                    padding:10px;
                }

                ul li.active {                    
                    background-color:#dddbdb;                    
                }
            </style>            
        </head>
        <body>
            <div id="loading_process" style="font-weight: bold; font-family: verdana; display: inline-block; opacity: 0; left:auto; right: auto; position: fixed; min-width: 100px; width: auto; height: auto; border-radius: 5px; padding: 5px; background: #F0F0F0; border: #808080 dotted 1px; color: 000000; margin-top: 2%; z-index: 99999"></div>

            <?php if (count($student_per_data) == 1 && $regID_ != 0) { ?>
                <div class="container">                    
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>                
                    <div class="row printWindow">
                        <div class="col-sm-12">
                            <table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center">                            
                                <tr align="center" style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <h3><b>ANNUAL PROGRESS REPORT</b></h3>
                                    </td>                                 
                                </tr>
                                <!-- Student Information -->
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <table border="0" style="line-height:25px;" width="100%">
                                            <tr>
                                                <td width='40%' valign="top">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>
                                                        REGISTRATION ID: <?php echo $reg_id;?>                                                                                                                

                                                    <?php } ?>
                                                </td>        
                                                <td width='50%' valign="top">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>                                    
                                                    STUDENT'S NAME: <b><?php echo $name_ ?></b>
                                                        
                                                    <?php } ?>
                                                </td>        
                                                <td valign="top">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        CLASS: <b><?php echo $classID; ?></b>
                                                    <?php } ?>
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border:1px #000000 solid;">
                                    <td colspan="2" align="center">SCHOLASTIC AREAS</td>
                                </tr>
                                <!-- Scholastic Area -->
                                <tr>
                                    <td colspan="2">
                                        <table border="1" cellpadding="5" width="100%">                                            
                                            <tr height='45'>
                                                <td width="16%" rowspan="2" align="center">SUBJECT</td>
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
                                                <tr height='35'>
                                                    <td><?php
                                                        echo $subjectClass->subName;
                                                        $term = 1;
                                                        ?>
                                                    </td>
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
                                                            <?php $yes=0;
                                                            foreach ($overall_result as $over_result) {
                                                                $subjectID = explode(",", $over_result->subjectID);
                                                                if ($term == 1) {
                                                                    $subjectTotal = explode(",", $over_result->term1Result);
                                                                } else {
                                                                    $subjectTotal = explode(",", $over_result->term2Result);
                                                                }
                                                                for ($loop = 1; $loop < count($subjectID); $loop++) {
                                                                    if ($subjectID[$loop] == $subjectClass->subjectID) {
                                                                        if($subjectTotal[$loop] !=0){
                                                                            echo $subjectTotal[$loop];
                                                                        }else{
                                                                            echo '';
                                                                            $yes=1;
                                                                        }
                                                                        $totalNumber_subject = $subjectTotal[$loop];
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
                                                        <td align="center">
                                                            <?php foreach ($class_grade as $cgrade) { ?>
                                                                <?php
                                                                if($yes==0){
                                                                    if ($totalNumber_subject >= $cgrade->minMarks && $totalNumber_subject <= $cgrade->maxMarks) {
                                                                        echo $cgrade->grade;
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                }else{
                                                                    echo '';
                                                                }
                                                                ?>
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                                
                                            <tr height='35'>
                                                <td width="16%" align="center">Grand Total</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                        <?php $yes=0;$totalNumber_subject=0;
                                                            $totalMarks = 0;
                                                            foreach ($sch_data_class as $scho_items) {
                                                                $totalMarks = $totalMarks + $scho_items->maxMarks;     
                                                            }
                                                            foreach ($overall_result as $over_result) {
                                                                if ($term == 1) {
                                                                    $subjectTotal = explode(",", $over_result->term1Result);
                                                                } else {
                                                                    $subjectTotal = explode(",", $over_result->term2Result);
                                                                }
                                                                for ($loop = 1; $loop < count($subjectTotal); $loop++) {                                                                    
                                                                        if($subjectTotal[$loop] !=0){                                                                            
                                                                            $totalNumber_subject=$totalNumber_subject+$subjectTotal[$loop];
                                                                        }else{                                                                            
                                                                            $yes=1;
                                                                        }                                                                        
                                                                }
                                                                if($yes==0){
                                                                    echo $totalNumber_subject . ' / ' . $totalMarks*($loop-1);
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
                                            </tr>
                                            
                                            <tr height='35'>
                                                <td width="16%" align="center">Percentage</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                        <?php $yes=0;$totalNumber_subject=0;
                                                            $totalMarks = 0;
                                                            foreach ($sch_data_class as $scho_items) {
                                                                $totalMarks = $totalMarks + $scho_items->maxMarks;     
                                                            }
                                                            foreach ($overall_result as $over_result) {
                                                                if ($term == 1) {
                                                                    $subjectTotal = explode(",", $over_result->term1Result);
                                                                } else {
                                                                    $subjectTotal = explode(",", $over_result->term2Result);
                                                                }
                                                                for ($loop = 1; $loop < count($subjectTotal); $loop++) {                                                                    
                                                                        if($subjectTotal[$loop] !=0){                                                                            
                                                                            $totalNumber_subject=$totalNumber_subject+$subjectTotal[$loop];
                                                                        }else{                                                                            
                                                                            $yes=1;
                                                                        }                                                                        
                                                                }
                                                                if($yes==0){
                                                                    echo round(($totalNumber_subject/($totalMarks*($loop-1)))*100, 1) . '%';
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
                                            </tr>
                                            
                                            <tr height='35'>
                                                <td width="16%" align="center">Overall Grade</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                        <?php $yes=0;$totalNumber_subject=0;
                                                            $totalMarks = 0;
                                                            foreach ($sch_data_class as $scho_items) {
                                                                $totalMarks = $totalMarks + $scho_items->maxMarks;     
                                                            }
                                                            foreach ($overall_result as $over_result) {
                                                                if ($term == 1) {
                                                                    $subjectTotal = explode(",", $over_result->term1Result);
                                                                } else {
                                                                    $subjectTotal = explode(",", $over_result->term2Result);
                                                                }
                                                                for ($loop = 1; $loop < count($subjectTotal); $loop++) {                                                                    
                                                                        if($subjectTotal[$loop] !=0){                                                                            
                                                                            $totalNumber_subject=$totalNumber_subject+$subjectTotal[$loop];
                                                                        }else{                                                                            
                                                                            $yes=1;
                                                                        }                                                                        
                                                                }
                                                                if($yes==0){
                                                                    $percentage=($totalNumber_subject/($totalMarks*($loop-1)))*100;                                                                    
                                                                    foreach ($class_grade as $cgrade) {
                                                                        if ($percentage >= $cgrade->minMarks && $percentage <= $cgrade->maxMarks) {
                                                                            echo $cgrade->grade;
                                                                        } else {
                                                                            echo '';
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
                                            </tr>
                                            
                                            <tr height='35'>
                                                <td width="16%" align="center">Attendance</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                        
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            
                                            <tr height='35'>
                                                <td width="16%" align="center">Overall Result</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php foreach ($exam_term as $exterm) { 
                                                    $schCount = $schCount*2;
                                                 } $schCount = $schCount/2;?>
                                                
                                                <td width="43%" align="center" colspan="<?php echo ($schCount+4); ?>">
                                                        
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>                                                                
                                <!-- Co-Scholastic Area -->
                                <tr>
                                    <td colspan="2">
                                        <table border="1" cellpadding="5" width="100%">
                                            <tr height='35'>
                                                <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td width="43%" align="center" colspan="2">Co-Scholastic Area: <?php echo $exterm->termName; ?> <font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>                                                
                                                <?php } ?>                                                
                                            </tr>
                                            <tr height='35'><td></td><td align="center">Grade</td><td></td><td align="center">Grade</td></tr>
                                            <?php foreach ($cosch_data_class as $coSch) { ?>
                                                <tr height='35'>
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
                                            <!-- Discipline Area -->
                                            <tr height='20'><td colspan="4" style="height:20px;"></td></tr>
                                            <tr height='35'>
                                                <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td width="43%" align="center" colspan="2">Discipline: <?php echo $exterm->termName; ?> <font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>                                                
                                                <?php } ?>
                                            </tr>
                                            <tr height='35'><td></td><td align="center">Grade</td><td></td><td align="center">Grade</td></tr>
                                            <?php foreach ($discipline_data_class as $disciplie) { ?>
                                                <tr height='35'>
                                                    <?php foreach ($exam_term as $exterm) { ?>                                                    
                                                        <td><?php echo $disciplie->disciplineitem; ?></td>
                                                        <?php $printTD1 = false; ?>
                                                        <?php foreach ($discipline_marks as $disciplineMarks) { ?>
                                                            <?php if ($disciplineMarks->termID == $exterm->termID) { ?>
                                                                <?php if ($disciplineMarks->disciplineID == $disciplie->disciplineID) { ?>
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
                                </tr>

                                <tr height="50">
                                    <td width='95%'>Teacher's Remarks
                                        <span style='border-bottom: #999999 dashed 1px; font-size: 17px;'>
                                            <?php
                                            foreach ($teacher_remarks as $remarks) {
                                                echo $remarks->teacherRemark;
                                            }
                                            ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </td>
                                    <td>Date: <?php echo date('d/m/Y'); ?></td>
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
                                                <td align="center">Class Teacher's Signature</td>
                                                <td align="center">Principal's Signature</td>
                                                <td align="center">Parent's Signature</td>
                                            </tr>
                                        </table>
                                    </td> 
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-------------------------------PRINT ALL---------------------------------------------->
                <div class="container">
                    <div class="row hide_pagination">
                        <div class="col-sm-12" align="center">
                            <p><?php echo $links; ?></p>
                            <p>Result rendered in <strong>{elapsed_time}</strong> seconds</p>
                        </div>                           
                    </div>
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>
                    <?php foreach ($student_per_data as $stuData) { ?>
                        <div class="row printWindow" style="page-break-after:always;">
                            <div class="col-sm-12">
                                <table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center">
                                    <tr align="center" style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <h3><b>ANNUAL PROGRESS REPORT</b></h3>
                                    </td>
                                </tr>
                                    <!-- Student Information -->
                                    <tr style="border-top:#000000 solid 1px;">
                                        <td colspan="2">
                                            <table border="0" style="line-height:25px;" width="100%">
                                                <tr>
                                                <td width='40%' valign="top">
                                                    <?php                                                   
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>
                                                        REGISTRATION ID: <?php echo $stuData->regid;?>                                                                                                                                                                    
                                                </td>        
                                                <td width='50%' valign="top">
                                                    <?php                                                    
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>                                    
                                                    STUDENT'S NAME: <b><?php echo $name_ ?></b>
                                                                                                          
                                                </td>        
                                                <td valign="top">
                                                    <?php                                                   
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        CLASS: <b><?php echo $classID; ?></b>                                                    
                                                </td>        
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr style="border:1px #000000 solid;">
                                        <td colspan="2" align="center">SCHOLASTIC AREAS</td>
                                    </tr>
                                    <!-- Scholastic Area -->
                                    <tr>
                                        <td colspan="2">
                                            <table border="1" cellpadding="5" width="100%">
                                                <tr height='45'>
                                                    <td width="16%" rowspan="2" align="center">SUBJECT</td>
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
                                                    <tr height='35'>
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
                                                                <?php $yes = 0;
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
                                                                                if($subjectTotal[$loop] !=0){
                                                                                    echo $subjectTotal[$loop];
                                                                                }else{
                                                                                    echo '';
                                                                                    $yes=1;
                                                                                }
                                                                                $totalNumber_subject = $subjectTotal[$loop];
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
                                                            <td align="center">
                                                                <?php foreach ($class_grade as $cgrade) { ?>
                                                                    <?php
                                                                    if($yes==0){
                                                                        if ($totalNumber_subject >= $cgrade->minMarks && $totalNumber_subject <= $cgrade->maxMarks) {
                                                                            echo $cgrade->grade;
                                                                        } else {
                                                                            echo '';
                                                                        }
                                                                    }else{
                                                                        echo '';                                                                        
                                                                    }
                                                                    ?>
                                                                <?php } ?>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                                    
                                                <tr height='35'>
                                                    <td width="16%" align="center">Grand Total</td>
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?>

                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                        <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                            <?php $yes=0;$totalNumber_subject=0;
                                                                $totalMarks = 0;
                                                                foreach ($sch_data_class as $scho_items) {
                                                                    $totalMarks = $totalMarks + $scho_items->maxMarks;     
                                                                }
                                                                foreach ($overall_result as $over_result) {
                                                                    if ($stuData->regid == $over_result->regid) {
                                                                        if ($term == 1) {
                                                                            $subjectTotal = explode(",", $over_result->term1Result);
                                                                        } else {
                                                                            $subjectTotal = explode(",", $over_result->term2Result);
                                                                        }
                                                                        for ($loop = 1; $loop < count($subjectTotal); $loop++) {                                                                    
                                                                                if($subjectTotal[$loop] !=0){                                                                            
                                                                                    $totalNumber_subject=$totalNumber_subject+$subjectTotal[$loop];
                                                                                }else{                                                                            
                                                                                    $yes=1;
                                                                                }                                                                        
                                                                        }
                                                                        if($yes==0){
                                                                            echo $totalNumber_subject . ' / ' . $totalMarks*($loop-1);
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
                                                </tr>
                                            
                                                <tr height='35'>
                                                    <td width="16%" align="center">Percentage</td>
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?>

                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                        <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                            <?php $yes=0;$totalNumber_subject=0;
                                                                $totalMarks = 0;
                                                                foreach ($sch_data_class as $scho_items) {
                                                                    $totalMarks = $totalMarks + $scho_items->maxMarks;     
                                                                }
                                                                foreach ($overall_result as $over_result) {
                                                                    if ($stuData->regid == $over_result->regid) {
                                                                        if ($term == 1) {
                                                                            $subjectTotal = explode(",", $over_result->term1Result);
                                                                        } else {
                                                                            $subjectTotal = explode(",", $over_result->term2Result);
                                                                        }
                                                                        for ($loop = 1; $loop < count($subjectTotal); $loop++) {                                                                    
                                                                                if($subjectTotal[$loop] !=0){                                                                            
                                                                                    $totalNumber_subject=$totalNumber_subject+$subjectTotal[$loop];
                                                                                }else{                                                                            
                                                                                    $yes=1;
                                                                                }                                                                        
                                                                        }
                                                                        if($yes==0){
                                                                            echo round(($totalNumber_subject/($totalMarks*($loop-1)))*100, 1) . '%';
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
                                                </tr>
                                            
                                                <tr height='35'>
                                                    <td width="16%" align="center">Overall Grade</td>
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?>

                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                        <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">
                                                            <?php $yes=0;$totalNumber_subject=0;
                                                                $totalMarks = 0;
                                                                foreach ($sch_data_class as $scho_items) {
                                                                    $totalMarks = $totalMarks + $scho_items->maxMarks;     
                                                                }
                                                                foreach ($overall_result as $over_result) {
                                                                    if ($stuData->regid == $over_result->regid) {
                                                                        if ($term == 1) {
                                                                            $subjectTotal = explode(",", $over_result->term1Result);
                                                                        } else {
                                                                            $subjectTotal = explode(",", $over_result->term2Result);
                                                                        }
                                                                        for ($loop = 1; $loop < count($subjectTotal); $loop++) {                                                                    
                                                                                if($subjectTotal[$loop] !=0){                                                                            
                                                                                    $totalNumber_subject=$totalNumber_subject+$subjectTotal[$loop];
                                                                                }else{                                                                            
                                                                                    $yes=1;
                                                                                }                                                                        
                                                                        }
                                                                        if($yes==0){
                                                                            $percentage=($totalNumber_subject/($totalMarks*($loop-1)))*100;                                                                    
                                                                            foreach ($class_grade as $cgrade) {
                                                                                if ($percentage >= $cgrade->minMarks && $percentage <= $cgrade->maxMarks) {
                                                                                    echo $cgrade->grade;
                                                                                } else {
                                                                                    echo '';
                                                                                }
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
                                                </tr>
                                            
                                                <tr height='35'>
                                                    <td width="16%" align="center">Attendance</td>
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?>

                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                        <td width="43%" align="center" colspan="<?php echo ($schCount + 2); ?>">

                                                        </td>
                                                    <?php } ?>
                                                </tr>

                                                <tr height='35'>
                                                    <td width="16%" align="center">Overall Result</td>
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?>

                                                    <?php foreach ($exam_term as $exterm) { 
                                                        $schCount = $schCount*2;
                                                     } $schCount = $schCount/2;?>

                                                    <td width="43%" align="center" colspan="<?php echo ($schCount+4); ?>">

                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- Co-Scholastic Area -->
                                    <tr>
                                        <td colspan="2">
                                            <table border="1" cellpadding="5" width="100%">
                                                <tr height='35'>
                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                        <td width="43%" align="center" colspan="2">Co-Scholastic Area: <?php echo $exterm->termName; ?> <font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr height='35'><td></td><td align="center">Grade</td><td></td><td align="center">Grade</td></tr>
                                                <?php foreach ($cosch_data_class as $coSch) { ?>
                                                    <tr height='35'>
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
                                                    
                                                    <!-- Discipline Area -->
                                                <tr height='20'><td colspan="4" style="height:20px;"></td></tr>
                                                <tr height='35'>
                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                        <td width="43%" align="center" colspan="2">Discipline: <?php echo $exterm->termName; ?> <font style="font-size: 11px;">(on a 3-point (A-C) grading scale)</font></td>                                                
                                                    <?php } ?>
                                                </tr>
                                                <tr height='35'><td></td><td align="center">Grade</td><td></td><td align="center">Grade</td></tr>
                                                <?php foreach ($discipline_data_class as $disciplie) { ?>
                                                    <tr height='35'>
                                                        <?php foreach ($exam_term as $exterm) { ?>                                                    
                                                            <td><?php echo $disciplie->disciplineitem; ?></td>
                                                            <?php $printTD1 = false; ?>
                                                            <?php foreach ($discipline_marks as $disciplineMarks) { ?>
                                                            <?php if ($stuData->regid == $disciplineMarks->regid) { ?>
                                                                <?php if ($disciplineMarks->termID == $exterm->termID) { ?>
                                                                    <?php if ($disciplineMarks->disciplineID == $disciplie->disciplineID) { ?>
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
                                    </tr>
                                    <tr height="50">
                                        <td width='95%'>Teacher's Remarks
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
                                        <td>Date: <?php echo date('d/m/Y'); ?></td>
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
                                                    <td align="center">Class Teacher's Signature</td>
                                                    <td align="center">Principal's Signature</td>
                                                    <td align="center">Parent's Signature</td>
                                                </tr>
                                            </table>
                                        </td> 
                                    </tr>
                                </table>                                
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!----------------------------------------------------------------------------->
            <?php } ?>
        </body>
        
        <script src="<?php echo base_url('assets_/js/jquery.min.js'); ?>"></script> 
        <script src="<?php echo base_url('assets_/js/jquery.ui.custom.js'); ?>"></script> 
        <script src="<?php echo base_url('assets_/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets_/js/myjs.js'); ?>?version=<?php echo JS_VERSION_NITIN; ?>"></script>          
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

