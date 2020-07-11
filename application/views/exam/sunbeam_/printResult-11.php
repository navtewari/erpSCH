<?php if (count($overall_result) != 0) { ?>
<?php 
function numberToRomanRepresentation($number) {
    $map = array('X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
?>
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

                h1{margin:0;padding:0;margin-top:5px;}

                h2{
                	margin-top: 2px;
                	margin-bottom: 2px;
                }

                h3{
                    font-size:1.7em;
                  	margin:0px;
                    padding:0px;
                    line-height:20px!important;
                }
                .marginLarge{
                    margin-top: 5px;
                }

                h4,h5{
                    font-size:1.5em;
                	margin-top: 2px;
                	margin-bottom: 2px;
                }
            </style>
        </head>
        <body>
            <div class="page-loader"></div>
            <?php if (count($overall_result) == 1 && $regID_ != 0) { ?>
                <div class="container-fluid" style="padding-right: 15px !important;padding-left: 35px;">
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="align-items:center; justify-content:center;">
                            <table border="0" height="100%" cellpadding="0" class="table_" align="center">
                                <tr align="center" height="140">   
                                <td width="150" valign="top" style="padding-right:2em;padding-top:5px;"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100"/></td>
                                    <td valign="top">
                                        <h1><?php echo $sch_name; ?></h1>
                                        <h3 class="marginLarge"><?php echo $sch_remark; ?></h3>
                                        <h4 class="marginLarge"><?php echo $sch_addr . ', Haldwani (' . $sch_distt . ') 263139'; ?></h4> 
                                        <h4 class="marginLarge"><?php echo $sch_aff; ?>, Website- <?php echo $website; ?></h4>
                                    </td>
                                    
                                </tr>
                                <tr align="center" height="40px">
                                    <td colspan="2">
                                        <h3><b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3><br/>
                                        <h3 style="margin-bottom: 10px;"><b>REPORT CARD FOR CLASS <?php echo numberToRomanRepresentation($classID);?></b></h3>
                                    </td>
                                </tr>
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2" valign="middle">
                                        <table border="0" width="100%">
                                            <tr>
                                                <td width='33%' valign="top" style="font-size:.85em;padding-left: 10px;">
                                                    <?php
                                                    foreach ($overall_result as $over_result) {
                                                        $personalDetail = explode(",", $over_result->personalInfo);
                                                    }
                                                    ?><br/>
                                                    Student's Name: <b class='under'><?php echo $personalDetail[0]; ?></b><br/><br/>  
                                                    Class/ Section: <b class='under'><?php echo numberToRomanRepresentation($classID);?></b>  <br/><br/>                                                          
                                                </td>        
                                                <td width='33%' valign="top" style="font-size:.85em;"><br/>
                                                    Mother's Name: <b class='under'><?php echo $personalDetail[1]; ?></b><br/><br/>
                                                    Admission No.: <b class='under'><?php echo $personalDetail[3]; ?></b>    <br/><br/>
                                                </td>        
                                                <td valign="top" style="font-size:.85em;"><br/>                                                    
                                                    Father's Name: <b class='under'><?php echo $personalDetail[2]; ?></b><br/><br/>
                                                    Date Of Birth: <b class='under'><?php echo $personalDetail[4]; ?></b>  <br/><br/>
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Scholastic Area -->
                                <tr>
                                    <td colspan="2" valign="top">
                                        <table border="1" cellpadding="2" width="100%" height="100%">
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
                                                foreach ($overall_result as $over_result) {
                                                    $scholasticName = explode(",", $over_result->scholasticName);
                                                    $schCount = count($scholasticName);                                                                
                                                }
                                                ?>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount); ?>">Half Yearly</td>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount); ?>">Final</td>  
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

                                            <?php $subjectCount=0; $subTotal1=0;$subTotal2=0;$loopCount=0;$subjectLoop = 0;
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
                                                        <?php foreach ($overall_result as $over_result) {
                                                            if ($term == 1) {
                                                                $Term1TotalMarks = explode("@", $over_result->Term1SubjectWise);
                                                                $subjectMarks = explode(",", $Term1TotalMarks[$subjectLoop]);
                                                            } else {
                                                                $Term2TotalMarks = explode("@", $over_result->Term2SubjectWise);
                                                                $subjectMarks = explode(",", $Term2TotalMarks[$subjectLoop]);                                                                            
                                                            }
                                                            if(count($subjectMarks)!=1){
                                                                for ($loop = 1; $loop < count($subjectMarks); $loop++) {                                                                            
                                                                        echo "<td align=center>" . $subjectMarks[$loop] . "</td>";
                                                                }
                                                            }else{                                                                        
                                                                for ($loop = 1; $loop <  $schCount; $loop++) { 
                                                                     echo "<td align=center></td>";   
                                                                }
                                                            }
                                                        }
                                                        ?>
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
                                                <?php $subjectLoop++;?>
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
                                                    <td height="30px;">Remarks</td>
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                    <td colspan="<?php echo $schCount+1;?>"></td>                                                    
                                                </tr>
                                        </table>
                                    </td>
                                </tr>                                                                
                                <!-- Co-Scholastic Area -->                                
                                <tr>
                                    <td colspan="2" valign="top">
                                        <table width="100%" height="100%" cellpadding="0" border="0" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align:top;padding-top:5px;" align="left">&nbsp;&nbsp;Signature: </td>
                                                <td style="vertical-align:top;padding-top:5px;padding-left: 5px;" align="left" width="9%">
                                                    Class Teacher- <br/><br/>
                                                    Principal- <br/><br/>
                                                    Parents- 
                                                </td>
                                                <td style="vertical-align: top;padding-top: 5px;" align="left">
                                                    .....................................................<br/><br/>
                                                    .....................................................<br/><br/>
                                                    .....................................................
                                                </td>
                                                <td width="37%"></td>
                                                <td style="vertical-align: top;text-align:left;padding-top: 5px;">
                                                    Final Result :
                                                    <span style='border-bottom: #000 dotted 1px; font-size: 13px;'>
                                                        <?php
                                                        foreach ($teacher_remarks as $remarks) {
                                                            echo $remarks->teacherRemark;
                                                        }
                                                        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                    </span>              
                                                    Signature of Class Teacher- .............................................<br/><br/>
                                                    Signature of Principal with Seal- ......................................<br/><br/><br/><br/>
                                                </td>
                                            </tr>
                                            <tr height="50px">
                                                <td colspan="5" valign="top" style="font-size:18px;">
                                                    &nbsp;&nbsp;Conduct: 
                                                    <?php
                                                        foreach ($teacher_remarks as $remarks) {
                                                            echo $remarks->promotedClass;
                                                        }?>
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
                <div class="container-fluid" style="padding-right: 15px !important;padding-left: 35px;">
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
                    <?php foreach ($overall_result as $over_result) { ?>
                        <div class="row page" style="page-break-after: always;">
                            <div class="col-sm-12" style="align-items:center; justify-content:center;">
                                <table border="0" height="100%" cellpadding="0" class="table_" align="center">
                                    <tr align="center" height="140"> 
                                    <td width="150" valign="top" style="padding-right:2em;padding-top:5px;"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100"/></td>
                                        <td>
                                            <h1><?php echo $sch_name; ?></h1>
                                            <h3 class="marginLarge"><?php echo $sch_remark; ?></h3>
                                            <h4 class="marginLarge"><?php echo $sch_addr . ', Haldwani (' . $sch_distt . ') 263139'; ?></h4> 
                                            <h4 class="marginLarge"><?php echo $sch_aff; ?>, Website- <?php echo $website; ?></h4>
                                        </td>
                                        
                                    </tr>
                                    <tr align="center" height="40px">
                                    <td colspan="2">
                                        <h3><b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3><br/>
                                        <h3 style="margin-bottom: 10px;"><b>REPORT CARD FOR CLASS <?php echo numberToRomanRepresentation($classID);?></b></h3>
                                    </td>
                                </tr>                            
                                <!-- Student Information -->
                                <tr style="border-top:#000000 solid 1px;">
                                    <td colspan="2" valign="middle">
                                        <table border="0" width="100%">
                                            <tr>
                                                <td width='33%' valign="top" style="font-size:.85em;padding-left: 10px;">
                                                    <?php  $stuREGID = $over_result->regid; //student registrationID
                                                        $personalDetail = explode(",", $over_result->personalInfo);
                                                    ?><br/>
                                                    Student's Name: <b class='under'><?php echo $personalDetail[0]; ?></b><br/><br/>  
                                                    Class/ Section: <b class='under'><?php echo numberToRomanRepresentation($classID);?></b>  <br/><br/>                                                          
                                                </td>        
                                                <td width='33%' valign="top" style="font-size:.85em;"><br/>
                                                    Mother's Name: <b class='under'><?php echo $personalDetail[1]; ?></b><br/><br/>
                                                    Admission No.: <b class='under'><?php echo $personalDetail[3]; ?></b>    <br/><br/>
                                                </td>        
                                                <td valign="top" style="font-size:.85em;"><br/>                                                    
                                                    Father's Name: <b class='under'><?php echo $personalDetail[2]; ?></b><br/><br/>
                                                    Date Of Birth: <b class='under'><?php echo $personalDetail[4]; ?></b>  <br/><br/>
                                                </td>        
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                    <!-- Scholastic Area -->
                                    <tr>
                                        <td colspan="2" valign="top">
                                            <table border="1" cellpadding="2" width="100%" height="100%">
                                                <tr align="center">
                                                    <td width="2%" rowspan="3">Sr. No.</td>
                                                    <td width="16%" rowspan="3">Subjects</td>
                                                    <?php
                                                        $schCount = 0;
                                                        foreach ($overall_result as $over_result) {
                                                            $scholasticName = explode(",", $over_result->scholasticName);
                                                            $schCount = count($scholasticName);                                                                
                                                        }
                                                        $schCount=($schCount+2)*2;
                                                    ?>
                                                    
                                                    <td colspan="<?php echo ($schCount); ?>">Full Marks - 100 in each Subject in each Term,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pass Marks - 33% Marks each in Practical & Theory / Project</td>
                                                </tr>
                                                <tr align="center">
                                                    <?php
                                                        $schCount = 0;
                                                        foreach ($overall_result as $over_result) {
                                                            $scholasticName = explode(",", $over_result->scholasticName);
                                                            $schCount = count($scholasticName);                                                                
                                                        }
                                                    ?>                                               
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount); ?>">Half Yearly</td>                                                
                                                    <td width="34%" align="center" colspan="<?php echo ($schCount); ?>">Final</td>  
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


                                            <?php $subjectCount=0; $subTotal1=0;$subTotal2=0;$loopCount=0;$subjectLoop = 0;
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
                                                                                                                                                                    
                                                                <?php
                                                                if ($term == 1) {
                                                                    $Term1TotalMarks = explode("@", $over_result->Term1SubjectWise);
                                                                    $subjectMarks = explode(",", $Term1TotalMarks[$subjectLoop]);
                                                                } else {
                                                                    $Term2TotalMarks = explode("@", $over_result->Term2SubjectWise);
                                                                    $subjectMarks = explode(",", $Term2TotalMarks[$subjectLoop]);
                                                                }
                                                                if(count($subjectMarks)!=1){
                                                                    for ($loop = 1; $loop < count($subjectMarks); $loop++) {                                                                            
                                                                            echo "<td align=center>" . $subjectMarks[$loop] . "</td>";
                                                                    }
                                                                }else{                                                                        
                                                                    for ($loop = 1; $loop <  $schCount; $loop++) { 
                                                                         echo "<td align=center> </td>";   
                                                                    }
                                                                }

                                                                ?> 

                                                            <td align="center">
                                                                <?php $yes=0; 
                                                            
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
                                                                if ($term == 1) {
                                                                    $term++;
                                                                } else if ($term == 2) {
                                                                    $term--;
                                                                }
                                                                ?>
                                                            </td>
                                                        <?php } ?>                                                                                      
                                                    </tr>
                                                    <?php $subjectLoop++; ?>
                                                <?php } ?>
                                                    <tr align="center">
                                                    <?php
                                                        $schCount = 0;
                                                        foreach ($overall_result as $over_result) {
                                                            $scholasticName = explode(",", $over_result->scholasticName);
                                                            $schCount = count($scholasticName);                                                                
                                                        }
                                                    ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="<?php echo $schCount-1;?>">Grand Total</td>
                                                    <td>Marks Obtained / Total Marks</td>
                                                    <td colspan="<?php echo $schCount-1;?>">Grand Total</td>
                                                    <td>Marks Obtained / Total Marks</td>
                                                </tr>
                                                
                                                <tr align="center">                                                    
                                                    <td></td>
                                                    <td>Term Result</td>
                                                    <td colspan="<?php echo $schCount-1;?>"><?php echo '500'//$subjectCount*100;?></td>
                                                    <td><?php echo $subTotal1;?></td>
                                                    <td colspan="<?php echo $schCount-1;?>"><?php echo '500'//$subjectCount*100;?></td>
                                                    <td><?php echo $subTotal2;?></td>
                                                </tr>
                                                
                                                <tr align="center">                                                    
                                                    <td></td>
                                                    <td height="40px;">Remarks</td>
                                                    <td colspan="<?php echo $schCount;?>"></td>                                                    
                                                    <td colspan="<?php echo $schCount;?>"></td>                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>                                   
                                    <tr>
                                        <td colspan="2" valign="top">
                                            <table width="100%" height="100%" cellpadding="0" border="0" cellspacing="0">
                                                <tr>
                                                    <td style="vertical-align:top;padding-top:15px;" align="left">&nbsp;&nbsp;Signature: </td>
                                                    <td style="vertical-align:top;padding-top:15px;padding-left: 5px;" align="left" width="9%">
                                                        Class Teacher- <br/><br/>
                                                        Principal- <br/><br/>
                                                        Parents- 
                                                    </td>
                                                    <td style="vertical-align: top;padding-top: 15px;" align="left">
                                                        .....................................................<br/><br/>
                                                        .....................................................<br/><br/>
                                                        .....................................................
                                                    </td>
                                                    <td width="37%"></td>
                                                    <td style="vertical-align: top;text-align:left;padding-top: 15px;">
                                                        Final Result :
                                                         <span style='border-bottom: #000 dotted 1px; font-size: 13px;'>
                                                            <?php
                                                            foreach ($teacher_remarks as $remarks) {
                                                                if ($stuREGID == $remarks->regid) {
                                                                    echo $remarks->teacherRemark;
                                                                }
                                                            }
                                                            ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                        </span>              
                                                        Signature of Class Teacher- .............................................<br/><br/>
                                                        Signature of Principal with Seal- ......................................<br/><br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <tr height="30px">
                                                    <td colspan="5" valign="top" style="font-size:15px;">
                                                        &nbsp;&nbsp;Conduct: 
                                                        <?php
                                                                        foreach ($teacher_remarks as $remarks) {
                                                                            if ($stuREGID == $remarks->regid) {
                                                                                echo $remarks->promotedClass;
                                                                            }
                                                                        }
                                                                        ?>
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
    if (count($overall_result) == 1 && $regID_ != 0) {
        echo 'No data Present for ' . $reg_id . '<br>Please calculate Result before Marksheet Printing';
    } else {
        echo 'No data Present for Class' . $classID .  '<br>Please calculate Result before Marksheet Printing';
    }
}
?>
