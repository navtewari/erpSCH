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
                td{font-size: 12px;font-weight: 600;}
                .table_{                	
                    border: #000000 solid 3px;             
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
                h2{
                	margin-top: 2px;
                	margin-bottom: 2px;
                }
                h3{
                        font-size:1.5em;
                  	margin-top:2px;
                	margin-bottom: 2px;  
                }
                h4,h5{
                        font-size:1.3em;
                	margin-top: 2px;
                	margin-bottom: 2px;
                }
            </style>
        </head>
        <body>
            <div class="page-loader"></div>
            <?php if (count($student_per_data) == 1 && $regID_ != 0) { ?>
                <div class="container-fluid" style="padding-right: 10px !important;padding-left: 40px;">
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="display:flex;align-items:center; justify-content:center;">
                            <table border="0" height="100%" cellpadding="1" class="table_" align="center">
                                <tr align="center">                                    
                                    <td>
                                        <h1><?php echo $sch_name; ?></h1>
                                        <h3><?php echo $sch_remark; ?></h3>
                                        <h4><?php echo $sch_addr . ', Haldwani (' . $sch_distt . ') 263139'; ?></h4> 
                                        <h4><?php echo $sch_aff; ?>, Website- <?php echo $website; ?></h4>
                                    </td>
                                    <td width="150" valign="top" style="padding-right:1em;padding-top:1em;"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100"/></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2">
                                        <h3 style="line-height: 20px!important;"><b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3>
                                        <h4><b>REPORT CARD FOR CLASS XI</b></h4>
                                    </td>
                                </tr>
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <table border="0" style="line-height:30px;" width="100%">
                                            <tr>
                                                <td width='33%' valign="top" style="font-size:.85em;">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        Student's Name: <b class='under'><?php echo $name_ ?></b><br/>  
                                                        Class/ Section: <b class='under'><?php echo substr($classID,0,2); ?></b>
                                                    <?php } ?>
                                                </td>        
                                                <td width='33%' valign="top" style="font-size:.85em;">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>
                                                        Mother's Name: <b class='under'><?php echo $stuData->MOTHER; ?></b><br/>   
                                                        Admission No.: <b class='under'>
                                                            <?php echo $stuData->ADM_NO; ?></b>
                                                    <?php } ?>
                                                </td>        
                                                <td valign="top" style="font-size:.85em;">
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>
                                                        Father's Name: <b class='under'><?php echo $stuData->FATHER; ?></b><br/>
                                                        Date Of Birth: <b class='under'><?php echo $stuData->DOB_; ?></b>
                                                    <?php } ?>
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Scholastic Area -->
                                <tr>
                                    <td colspan="2">
                                        <table border="1" cellpadding="3" width="100%">
                                             <tr align="center">
                                                <td width="2%" rowspan="3">Sr. No.</td>
                                                <td width="16%" rowspan="3">Subjects</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                $schCount=($schCount+2)*2;
                                                ?>
                                                <td colspan="<?php echo ($schCount); ?>">Full Marks - 100 in each Subject in each Term &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pass Marks - 33% Marks each in Practical & Theory / Project</td>
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

                                            <?php $subjectCount=0; $subTotal1=0;$subTotal2=0;$loopCount=0;
                                            foreach ($subject_class as $subjectClass) {
                                                ?>
                                                <tr align="center">
                                                    <td><?php $loopCount++; echo $loopCount;?></td>
                                                    <td align="left" style="padding-left:1em;"><?php
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
                                                                    <?php }?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php if ($printData == false) { ?>
                                                                <td>-</td>
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
                                                                            echo '-';
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
                                                    <td></td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained / Total Marks</td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained / Total Marks</td>
                                                </tr>
                                                
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td></td>
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
                                                    <td></td>
                                                    <td height="40px;">Remarks</td>
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                </tr>
                                        </table>
                                    </td>
                                </tr>                                                                
                                <!-- Co-Scholastic Area -->                                

                                
                                <tr>
                                    <td colspan="2" style="vertical-align:top;padding-top: 0!important;margin-top: 0!important;">
                                        <table width="100%" cellpadding="0" border="0">
                                            <tr>
                                                <td style="vertical-align:top;" align="right" width="16%">
                                                    Signature: &nbsp;&nbsp;&nbsp;&nbsp;Class Teacher- <br/><br/>
                                                    Principal- <br/><br/>
                                                    Parents- 
                                                </td>
                                                <td style="vertical-align: top;" align="left">
                                                    .....................................................<br/><br/>
                                                    .....................................................<br/><br/>
                                                    .....................................................
                                                </td>
                                                <td style="vertical-align: top;text-align:right;">
                                                    Final Result :
                                                    <span style='border-bottom: #000 dotted 1px; font-size: 13px;'>
                                                        <?php
                                                        foreach ($teacher_remarks as $remarks) {
                                                            echo $remarks->teacherRemark;
                                                        }
                                                        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                    </span>              
                                                    Signature of Class Teacher- ..............................................<br/><br/>
                                                    Signature of Principal with Seal- ..............................................<br/><br/><br/><br/>
                                                </td>
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
                <div class="container-fluid" style="padding-right: 10px !important;padding-left: 40px;">
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
                        <div class="row page" style="page-break-after: always;">
                            <div class="col-sm-12" style="display:flex;align-items:center; justify-content:center;">
                                <table border="0" height="100%" cellpadding="5" class="table_" align="center">
                                    <tr align="center">                                    
                                        <td>
                                            <h1><?php echo $sch_name; ?></h1>
                                            <h3><?php echo $sch_remark; ?></h3>
                                            <h4><?php echo $sch_addr . ', Haldwani (' . $sch_distt . ') 263139'; ?></h4> 
                                            <h4><?php echo $sch_aff; ?>, Website- <?php echo $website; ?></h4>
                                        </td>
                                        <td width="150" valign="top" style="padding-right:1em;padding-top:1em;"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100"/></td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="2">
                                            <h3 style="line-height: 20px!important;"><b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3>
                                            <h4><b>REPORT CARD FOR CLASS XI</b></h4>
                                        </td>
                                    </tr>                             
                                <!-- Student Information -->
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2">
                                        <table border="0" style="line-height:30px;" width="100%">
                                            <tr>
                                                <td width='33%' valign="top" style="font-size:.85em;">
                                                    <?php                                                    
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>

                                                        Student's Name: <b class='under'><?php echo $name_ ?></b><br/>  
                                                        Class/ Section: <b class='under'><?php echo substr($classID,0,2); ?></b>
                                                                                                   
                                                </td>        
                                                <td width='33%' valign="top" style="font-size:.85em;">
                                                    <?php
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>
                                                    Mother's Name: <b class='under'><?php echo $stuData->MOTHER; ?></b><br/>
                                                    Admission No.: <b class='under'><?php echo $stuData->ADM_NO; ?></b>                                                        
                                                  
                                                </td>        
                                                <td valign="top" style="font-size:.85em;">
                                                    <?php
                                                    
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>  
                                                        Father's Name: <b class='under'><?php echo $stuData->FATHER; ?></b> <br>
                                                        Date Of Birth: <b class='under'><?php echo $stuData->DOB_; ?></b> <br/>                                                    
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                    <!-- Scholastic Area -->
                                    <tr>
                                        <td colspan="2">
                                            <table border="1" cellpadding="3" width="100%">
                                                <tr align="center">
	                                                <td width="2%" rowspan="3">Sr. No.</td>
	                                                <td width="16%" rowspan="3">Subjects</td>
	                                                <?php
	                                                $schCount = 0;
	                                                foreach ($sch_data_class as $scho_items) {
	                                                    $schCount++;
	                                                }
	                                                $schCount=($schCount+2)*2;
	                                                ?>
	                                                <td colspan="<?php echo ($schCount); ?>">Full Marks - 100 in each Subject in each Term,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pass Marks - 33% Marks each in Practical & Theory / Project</td>
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

                                            <?php $subjectCount=0; $subTotal1=0;$subTotal2=0;$loopCount=0;
                                                foreach ($subject_class as $subjectClass) {
                                                    ?>
                                                    <tr align="center">
                                                    	<td><?php $loopCount++; echo $loopCount;?></td>
                                                        <td align="left" style="padding-left:1em;"><?php
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
                                                                        <td>-</td>
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
                                                                                echo '-';
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
                                                    <td></td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained / Total Marks</td>
                                                    <td colspan="<?php echo $schCount;?>">Grand Total</td>
                                                    <td>Marks Obtained / Total Marks</td>
                                                </tr>
                                                
                                                <tr align="center">
                                                    <?php
                                                    $schCount = 0;
                                                    foreach ($sch_data_class as $scho_items) {
                                                        $schCount++;
                                                    }
                                                    ?> 
                                                    <td></td>
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
                                                    <td></td>
                                                    <td height="40px;">Remarks</td>
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>                                   
                                   <tr>
                                    <td colspan="2" style="vertical-align:top;padding-top: 0!important;margin-top: 0!important;">
                                        <table width="100%" cellpadding="0" border="0">
                                            <tr>
                                                <td style="vertical-align:top" align="right" width="16%">
                                                    Signature: &nbsp;&nbsp;&nbsp;&nbsp;Class Teacher- <br/><br/>
                                                    Principal- <br/><br/>
                                                    Parents- 
                                                </td>
                                                <td style="vertical-align: top;" align="left">
                                                    .....................................................<br/><br/>
                                                    .....................................................<br/><br/>
                                                    .....................................................
                                                </td>
                                                <td style="vertical-align: top; text-align:right">
                                                    Final Result :
                                                    <span style='border-bottom: #000 dotted 1px; font-size: 13px;'>
                                                        <?php
		                                                foreach ($teacher_remarks as $remarks) {
		                                                    if ($stuData->regid == $remarks->regid) {
		                                                        echo $remarks->teacherRemark;
		                                                    }
		                                                }
		                                                ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                    </span>              
                                                    Signature of Class Teacher- ..............................................<br/><br/>
                                                    Signature of Principal with Seal- ..............................................<br/><br/><br/><br/>
                                                </td>
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
