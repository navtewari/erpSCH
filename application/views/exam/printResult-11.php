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
                @page {size: A4 landscape;width:100%; height:100%;}               
                .hide_button{ display: none }
                .hide_pagination{
                    display:none;
                }
                
            </style>
            <style>
                td{font-size: 13px;font-weight: 600;}
                .table_{
                    border: #000000 solid 3px;
                    border-radius:50px;
                    width:100%;
                }      
                .under{
                    border-bottom: 1px #999999 dotted;                   
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
                .page-loader {
                    position: fixed;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                    background: url(http://localhost/erpSCH/assets_/img/page-loader.gif) 50% 50% no-repeat rgb(249,249,249);
                    opacity: .8;
                }
            </style>
        </head>
        <body>
            <div class="page-loader"></div>
            <?php if (count($student_per_data) == 1 && $regID_ != 0) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-sm-12">
                            <table border="0" height="auto" cellpadding="5" class="table_" align="center">
                                <tr align="center">                                    
                                    <td>
                                        <h2><?php echo $sch_name; ?></h2>
                                        <h5><?php echo $sch_remark; ?></h5>                                    
                                        <h5><?php echo $sch_addr . ', Haldwani, (' . $sch_distt . '), 263139'; ?></h5> 
                                        <h5>Ph. No. -<?php echo $sch_contact; ?>, Website- <?php echo $website; ?></h5>
                                    </td>
                                    <td width="150" valign="top"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="150"/></td>
                                </tr>
                                <tr align="center" style="line-height:25px;">
                                    <td colspan="2">
                                        <h4><b>Academic Session - (<?php echo $this->session->userdata('_current_year___'); ?>)</b></h4>
                                        <h4><b>REPORT CARD OF CLASS <?php echo $classID; ?></b></h4>
                                    </td>
                                </tr>
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <table border="0" style="line-height:30px;" width="100%">
                                            <tr>
                                                <td width='33%' valign="top">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        Student's Name: <b class='under'><?php echo $name_ ?></b>      <br/>  
                                                        Mother's Name: <b class='under'><?php echo $stuData->MOTHER; ?></b><br/>   
                                                    <?php } ?>
                                                </td>        
                                                <td width='33%' valign="top">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        Date Of Birth: <b class='under'><?php echo $stuData->DOB_; ?></b> <br/>                                               
                                                        Father's/ Guardian's Name: <b class='under'><?php echo $stuData->FATHER; ?></b>                                                        
                                                    <?php } ?>
                                                </td>        
                                                <td valign="top">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>   
                                                    Class: <b class='under'><?php echo $classID; ?></b>
                                                    <?php } ?>
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Scholastic Area -->
                                <tr>
                                    <td colspan="2">
                                        <table border="1" cellpadding="5" width="100%">
                                             <tr align="center">
                                                <td width="16%" rowspan="3">Subjects</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                $schCount=($schCount+2)*2;
                                                ?>
                                                <td colspan="<?php echo ($schCount); ?>">Full Marks - 100 in each subject in each term,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pass marks - 33% each in Practical & Theory</td>
                                            </tr>
                                            <tr align="center">
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>">Half Yearly</td>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>">Final</td>  
                                            </tr>                                           

                                            <tr align="center">
                                                <?php $grandTotal = 0; ?>
                                                <?php foreach ($exam_term as $exterm) { ?> <!-- for each exam term -->
                                                    <?php
                                                    $totalMarks = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        ?> <!-- for each Scholastic item -->
                                                        <td align="center"><?php echo $scho_items->item; ?></td>
                                                    <?php } ?>
                                                    <td align="center">Sub Total</td>
                                                <?php } ?>                                               
                                            </tr>

                                            <?php $subjectCount=0; $subTotal1=0;$subTotal2=0;
                                            foreach ($subject_class as $subjectClass) {
                                                ?>
                                                <tr align="center">
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
                                                                            if($term==1){
                                                                                $subjectCount++;
                                                                                $subTotal1=$subTotal1+$subjectTotal[$loop];
                                                                            }else{
                                                                                $subTotal2=$subTotal2+$subjectTotal[$loop];
                                                                            }                                                                           
                                                                        }else{
                                                                            echo '';
                                                                            $yes=1;
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
                                            <?php } ?>
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td></td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained/Total Marks</td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained/Total Marks</td>
                                                </tr>
                                                
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td>Term Result</td>
                                                    <td colspan="<?php echo $schCount;?>"><?php echo $subjectCount*100;?></td>
                                                    <td><?php echo $subTotal1;?></td>
                                                    <td colspan="<?php echo $schCount;?>"><?php echo $subjectCount*100;?></td>
                                                    <td><?php echo $subTotal2;?></td>
                                                </tr>
                                                
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td height="40px;">Remarks</td>
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                </tr>
                                        </table>
                                    </td>
                                </tr>                                                                
                                <!-- Co-Scholastic Area -->                                

                                <tr>
                                    <td colspan="2" align="right">Final Result:
                                        <span style='border-bottom: #999999 dotted 1px; font-size: 13px;'>
                                            <?php
                                            foreach ($teacher_remarks as $remarks) {
                                                echo $remarks->teacherRemark;
                                            }
                                            ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="vertical-align: top">
                                        Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class Teacher -<br/><br/><br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal - <br/><br/><br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parents -
                                    </td>
                                </tr>                                
                            </table>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-------------------------------------------------------------------------------ALL---->
                <div class="container">
                    <div class="row hide_pagination">
                        <div class="col-sm-12" align="center">
                            <p> <?php echo $links; ?></p>
                            <p>Result rendered in <strong>{elapsed_time}</strong> seconds</p>
                        </div>                           
                    </div>
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>
                    <?php foreach ($student_per_data as $stuData) { ?>
                        <div class="row" style="margin-top:10px;page-break-after: always;">
                            <div class="col-sm-12">
                                <table border="0" width="100%" height="auto" cellpadding="5" class="table_" align="center">
                                    <tr align="center">                                    
                                    <td>
                                        <h2><?php echo $sch_name; ?></h2>
                                        <h5><?php echo $sch_remark; ?></h5>                                    
                                        <h5><?php echo $sch_addr . ', Haldwani, (' . $sch_distt . '), 263139'; ?></h5>                                    
                                        <h5>Ph. No. -<?php echo $sch_contact; ?>, Website- <?php echo $website; ?></h5>
                                    </td>
                                    <td width="150" valign="top"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="150"/></td>
                                </tr>
                                <tr align="center" style="line-height:20px;">
                                    <td colspan="2">
                                        <h4><b>Academic Session - (<?php echo $this->session->userdata('_current_year___'); ?>)</b></h4>
                                        <h4><b>REPORT CARD OF CLASS <?php echo $classID; ?></b></h4>
                                    </td>                                    
                                </tr>                              
                                <!-- Student Information -->
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <table border="0" style="line-height:25px;" width="100%">
                                            <tr>
                                                <td width='33%' valign="top">
                                                    <?php                                                    
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        Student's Name: <b class='under'><?php echo $name_ ?></b>      <br/>  
                                                        Mother's Name: <b class='under'><?php echo $stuData->MOTHER; ?></b><br/>                                                       
                                                </td>        
                                                <td width='33%' valign="top">
                                                    <?php
                                                    
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        Date Of Birth: <b class='under'><?php echo $stuData->DOB_; ?></b> <br/>                                               
                                                        Father's/ Guardian's Name: <b class='under'><?php echo $stuData->FATHER; ?></b>                                                        
                                                  
                                                </td>        
                                                <td valign="top">
                                                    <?php
                                                    
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>   
                                                    Class: <b class='under'><?php echo $classID; ?></b>
                                                   
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                    <!-- Scholastic Area -->
                                    <tr>
                                        <td colspan="2">
                                            <table border="1" cellpadding="5" width="100%">
                                                <tr align="center">
                                                <td width="16%" rowspan="3">Subjects</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                $schCount=($schCount+2)*2;
                                                ?>
                                                <td colspan="<?php echo ($schCount); ?>">Full Marks - 100 in each subject in each term,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pass marks - 33% each in Practical & Theory</td>
                                            </tr>
                                            <tr align="center">
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>">Half Yearly</td>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>">Final</td>  
                                            </tr>                                           

                                            <tr align="center">
                                                <?php $grandTotal = 0; ?>
                                                <?php foreach ($exam_term as $exterm) { ?> <!-- for each exam term -->
                                                    <?php
                                                    $totalMarks = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        ?> <!-- for each Scholastic item -->
                                                        <td align="center"><?php echo $scho_items->item; ?></td>
                                                    <?php } ?>
                                                    <td align="center">Sub Total</td>
                                                <?php } ?>                                               
                                            </tr>

                                            <?php $subjectCount=0; $subTotal1=0;$subTotal2=0;
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
                                                            <?php $yes=0; 
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
                                                                                if($term==1){
                                                                                    $subjectCount++;
                                                                                    $subTotal1=$subTotal1+$subjectTotal[$loop];
                                                                                }else{
                                                                                    $subTotal2=$subTotal2+$subjectTotal[$loop];
                                                                                }                                                                           
                                                                            }else{
                                                                                echo '';
                                                                                $yes=1;
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
                                                <?php } ?>
                                                    <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td></td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained/Total Marks</td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained/Total Marks</td>
                                                </tr>
                                                
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td>Term Result</td>
                                                    <td colspan="<?php echo $schCount;?>"><?php echo $subjectCount*100;?></td>
                                                    <td><?php echo $subTotal1;?></td>
                                                    <td colspan="<?php echo $schCount;?>"><?php echo $subjectCount*100;?></td>
                                                    <td><?php echo $subTotal2;?></td>
                                                </tr>
                                                
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td height="40px;">Remarks</td>
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>                                   
                                   
                                    <tr height="50">
                                        <td colspan="2" align="right">Final Result:
                                        <span style='border-bottom: #999999 dashed 1px; font-size: 13px;'>
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
                                    <tr>
                                        <td colspan="2" style="vertical-align: top">
                                            Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class Teacher -<br/><br/><br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal - <br/><br/><br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parents -
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
