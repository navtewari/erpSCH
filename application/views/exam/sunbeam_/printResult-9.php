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
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                .hide_pagination{
                    display:none;
                }
            </style>
            <style>
                td{font-size: 14px;font-weight: 600;}
                .tdSize{font-size:1.1em;}
                .tdSize1{font-size:1em;}
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
                h4,h5{
                    font-size:1.3em;
                	margin-top: 10px;
                	margin-bottom: 10px;
                }
                .marginLarge{
                    margin-top: 5px;
                }
            </style>
        </head>
        <body>
            <div class="page-loader"></div>
            <?php if (count($overall_result) == 1 && $regID_ != 0) { ?>
                <div class="container" style="padding-right: 10px !important;padding-left:30px;">
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="align-items:center; justify-content:center;">
                            <table border="0" width="100%" height="100%" cellpadding="3" class="table_" align="center">
                                <tr>
                                    <td valign="top">
                                        <table border="0" width="100%" height="95%" cellpadding="2" align="center">        
                                            <tr align="center"> 
                                            <td width="150" valign="top" style="padding-right:1em;padding-top:2.5em;"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="140"/></td>
                                                <td>
                                                    <h1><?php echo $sch_name; ?></h1>
                                                    <h3><?php echo $sch_remark; ?></h3>
                                                    <h3><?php echo $sch_addr . ', Haldwani (' . $sch_distt . ') 263139'; ?></h3> 
                                                    <h4><?php echo $sch_aff; ?>, Website- <?php echo $website; ?></h4>
                                                </td>
                                                
                                            </tr>
                                            <tr align="center" height="100px;">
                                                <td colspan="2">
                                                    <h3 style="line-height: 40px!important;"><b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3>
                                                    <h3><b>REPORT CARD FOR CLASS <?php echo numberToRomanRepresentation($classID);?></b></h3>
                                                </td>
                                            </tr>
                                            <tr style="border-top:#000000 solid 1px;">
                                                <td colspan="2">
                                                    <table border="0" style="line-height:40px;" width="100%">
                                                        <tr>
                                                            <td width='33%' valign="top" style="font-size:1em;">
                                                                <?php
                                                                foreach ($overall_result as $over_result) {
                                                                    $personalDetail = explode(",", $over_result->personalInfo);
                                                                }
                                                                ?>

                                                                     Student's Name: <b class='under'><?php echo $personalDetail[0]; ?></b><br/>  
                                                                     Class/ Section: <b class='under'><?php echo numberToRomanRepresentation($classID);?></b>                                                            
                                                            </td>        
                                                            <td width='33%' valign="top" style="font-size:1em;">
                                                                
                                                                    Mother's Name: <b class='under'><?php echo $personalDetail[1]; ?></b><br/>
                                                                    Admission No.: <b class='under'><?php echo $personalDetail[3]; ?></b>                                                                
                                                            </td>        
                                                            <td valign="top" style="font-size:1em;">
                                                               
                                                                    Father's Name: <b class='under'><?php echo $personalDetail[2]; ?></b><br/>
                                                                    Date Of Birth: <b class='under'><?php echo $personalDetail[4]; ?></b>                                                                                                                
                                                            </td>        
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                <!-- Scholastic Area -->
                                            <tr>
                                                <td colspan="2" style="vertical-align: top">
                                                    <table border="1" cellpadding="6" width="100%">
                                                        <tr>
                                                            <td width="16%" colspan="2">Scholastic Areas</td>
                                                            <?php
                                                            $schCount = 0;
                                                            foreach ($overall_result as $over_result) {
                                                                $scholasticName = explode(",", $over_result->scholasticName);
                                                                $schCount = count($scholasticName);                                                                
                                                            }
                                                            ?>

                                                            <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                                <td width="34%" align="center" colspan="<?php echo ($schCount); ?>"><?php echo $exterm->termName; ?></td>
                                                            <?php } ?>                                                
                                                        </tr>

                                                        <tr align="center" style="vertical-align: bottom">
                                                            <td>Sr. No.</td>
                                                            <td width="16%">Subject Name</td>
                                                            <?php //$grandTotal = 0; ?>
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
                                                                    //$grandTotal = $grandTotal + $totalMarks;
                                                                    $totalMarks = 0;
                                                                    ?></td>
                                                            <?php } ?>                                               
                                                        </tr>

                                                        <?php $loopCount=0;
                                                        $subjectLoop = 0;
                                                        foreach ($subject_class as $subjectClass) {
                                                            ?>
                                                            <tr>
                                                                <td align="center" width="3%"><?php $loopCount++; echo $loopCount;?></td>
                                                                <td style="padding-top:1em;padding-bottom:1em;">
                                                                    <?php
                                                                        echo $subjectClass->subName;
                                                                        $term = 1;
                                                                    ?>                                                                    
                                                                </td>
                                                                <?php foreach ($exam_term as $exterm) {
                                                                    foreach ($overall_result as $over_result) {
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

                                                                    }?>
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
                                                    </table>
                                                </td>
                                            </tr>                                
                                
                                <!-- Co-Scholastic Area -->
                                            <tr>
                                                <td colspan="2" style="vertical-align: top;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <td style="vertical-align:top;width:50%;">
                                                            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                                                                <tr>
                                                                    <td class="tdSize">Co-Scholastic Area:<font style="font-size: 14px;">(on a 3-point (A-C) grading scale)</font></td>
                                                                    <td align="center" colspan="2" class="tdSize">Grade</td>                                            
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" class="tdSize">TERM 1</td>
                                                                    <td align="center" class="tdSize">TERM 2</td>                                            
                                                                </tr>

                                                                <?php foreach ($cosch_data_class as $coSch) { ?>
                                                                    <tr>                                                
                                                                        <td style="padding-top:1em;padding-bottom:1em;" class="tdSize"><?php echo $coSch->coitem; ?></td>
                                                                        <?php foreach ($exam_term as $exterm) { ?>
                                                                            <?php $printTD1 = false; ?>
                                                                            <?php foreach ($coSch_marks as $coSchMarks) { ?>
                                                                                <?php if ($coSchMarks->termID == $exterm->termID) { ?>
                                                                                    <?php if ($coSchMarks->coitemID == $coSch->coitemID) { ?>
                                                                                        <td align="center" class="tdSize">
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
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" valign="top">
                                                    <table width="100%" height="100%" cellpadding="0" border="0" cellspacing="0">
                                                        <tr>
                                                            <td style="vertical-align:top;padding-top:5px;" align="left" class="tdSize1">&nbsp;&nbsp;Signature: </td>
                                                            <td style="vertical-align:top;padding-top:5px;padding-left:5px;" align="left" width="14%" class="tdSize1">
                                                                Class Teacher- <br/><br/>
                                                                Principal- <br/><br/>
                                                                Parents- 
                                                            </td>
                                                            <td style="vertical-align: top;padding-top: 5px;" align="left" class="tdSize1">
                                                                .....................................................<br/><br/>
                                                                .....................................................<br/><br/>
                                                                .....................................................
                                                            </td>
                                                            <td width="8%"></td>
                                                            <td style="vertical-align: top;text-align:left;padding-top: 5px;" class="tdSize1">
                                                                Final Result :
                                                                <span style='border-bottom: #000 dotted 1px; font-size: 15px;'>
                                                                    <?php
                                                                    foreach ($teacher_remarks as $remarks) {
                                                                        echo $remarks->teacherRemark;
                                                                    }
                                                                    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                                </span>              
                                                                Signature of Class Teacher- ..................................<br/><br/>
                                                                Signature of Principal with Seal- ..........................<br/><br/><br/><br/>
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
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-------------------------------------------------------------------------------ALL---->
                <div class="container" style="padding-right: 10px !important;padding-left: 30px;">
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
                                <table border="0" width="100%" height="100%" cellpadding="0" class="table_" align="center">
                                	<tr>
                                    	<td valign="top">
                                        	<table border="0" width="100%" height="95%" cellpadding="2" align="center">
                                    			<tr align="center">   
                                    			<td width="150" valign="top" style="padding-right:1em;padding-top:2.5em;"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="140"/></td>
	                                                <td>
	                                                    <h1><?php echo $sch_name; ?></h1>
	                                                    <h3><?php echo $sch_remark; ?></h3>
	                                                    <h3><?php echo $sch_addr . ', Haldwani (' . $sch_distt . ') 263139'; ?></h3> 
	                                                    <h4><?php echo $sch_aff; ?>, Website- <?php echo $website; ?></h4>
	                                                </td>
	                                                
	                                            </tr>
	                                            <tr align="center" height="100px;">
	                                                <td colspan="2">
	                                                    <h3 style="line-height: 40px!important;"><b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3>
	                                                    <h3><b>REPORT CARD FOR CLASS <?php echo numberToRomanRepresentation($classID);?></b></h3>
	                                                </td>
	                                            </tr>
			                                                                   
                                <!-- Student Information -->
				                                <tr style="border-top:#000000 solid 1px;">
				                                    <td colspan="2">
				                                        <table border="0" style="line-height:40px;" width="100%">
				                                            <tr>
				                                                <td width='33%' valign="top" style="font-size:1em;">
				                                                    <?php $stuREGID = $over_result->regid; //student registrationID
                                                                    $personalDetail = explode(",", $over_result->personalInfo); ?>

			                                                        Student's Name: <b class='under'><?php echo $personalDetail[0] ?></b><br/>  
			                                                        Class/ Section: <b class='under'><?php echo numberToRomanRepresentation($classID);?></b>
				                                                       
				                                                </td>        
				                                                <td width='33%' valign="top" style="font-size:1em;">                                                                
                                                                    Mother's Name: <b class='under'><?php echo $personalDetail[1]; ?></b><br/>
                                                                    Admission No.: <b class='under'><?php echo $personalDetail[3]; ?></b>                                                                
                                                                </td>        
                                                                <td valign="top" style="font-size:1em;">                                                               
                                                                        Father's Name: <b class='under'><?php echo $personalDetail[2]; ?></b><br/>
                                                                        Date Of Birth: <b class='under'><?php echo $personalDetail[4]; ?></b>                                                                                                                
                                                                </td>         
				                                            </tr>
				                                        </table>
				                                    </td>
				                                </tr>
                                    <!-- Scholastic Area -->
			                                    <tr>
			                                        <td colspan="2" style="vertical-align: top">
			                                            <table border="1" cellpadding="6" width="100%">
			                                                <tr>
			                                                    <td width="16%" colspan="2">Scholastic Areas</td>
			                                                    <?php
			                                                    $schCount = 0;
			                                                    foreach ($sch_data_class as $scho_items) {
			                                                        $schCount++;
			                                                    }
			                                                    ?>

			                                                    <?php foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
			                                                        <td width="34%" align="center" colspan="<?php echo ($schCount + 1); ?>"><?php echo $exterm->termName; ?></td>
			                                                    <?php } ?>			                                                   
			                                                </tr>

			                                                <tr align="center" style="vertical-align: bottom">
			                                                	<td>Sr. No.</td>
			                                                    <td>Subject Name</td>
			                                                    <?php //$grandTotal = 0; ?>
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
			                                                            //$grandTotal = $grandTotal + $totalMarks;
			                                                            $totalMarks = 0;
			                                                            ?></td>
			                                                    <?php } ?>
			                                                </tr>

			                                                <?php $loopCount=0;
                                                            $subjectLoop = 0;
			                                                foreach ($subject_class as $subjectClass) {
			                                                    ?>
			                                                    <tr>
			                                                    	<td align="center" width="3%"><?php $loopCount++; echo $loopCount;?></td>
			                                                        <td style="padding-top:1em;padding-bottom:1em;"><?php
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
                                                                            for ($loop = 1; $loop <  $schCount+1; $loop++) { 
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
			                                                                                if ($subjectTotal[$loop] !=0){
			                                                                                    echo $subjectTotal[$loop];
			                                                                                }else{
			                                                                                    echo '';
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
			                                            </table>
			                                        </td>
			                                    </tr>                                    
			                                    
                                    <!-- Co-Scholastic Area -->
			                                    <tr>
			                                        <td colspan="2" style="vertical-align: top;">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                        <td style="vertical-align:top;width:50%;">
			                                                    <table border="1" cellspacing="0" cellpadding="5" width="100%">                                        
			                                                        <tr>
	                                                                    <td class="tdSize">Co-Scholastic Area:<font style="font-size: 14px;">(on a 3-point (A-C) grading scale)</font></td>
	                                                                    <td align="center" colspan="2" class="tdSize">Grade</td>                                            
	                                                                </tr>
	                                                                <tr>
	                                                                    <td></td>
	                                                                    <td align="center" class="tdSize">TERM 1</td>
	                                                                    <td align="center" class="tdSize">TERM 2</td>                                            
	                                                                </tr>

			                                                        <?php foreach ($cosch_data_class as $coSch) { ?>
			                                                            <tr>                                                
			                                                                <td style="padding-top:1em;padding-bottom:1em;" class="tdSize"><?php echo $coSch->coitem; ?></td>
			                                                                <?php foreach ($exam_term as $exterm) { ?>
			                                                                    <?php $printTD1 = false; ?>
			                                                                    <?php foreach ($coSch_marks as $coSchMarks) { ?>
			                                                                        <?php if ($stuREGID == $coSchMarks->regid) { ?>
			                                                                            <?php if ($coSchMarks->termID == $exterm->termID) { ?>
			                                                                                <?php if ($coSchMarks->coitemID == $coSch->coitemID) { ?>
			                                                                                    <td align="center" class="tdSize">
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
			                                            </table>
			                                        </td>
			                                    </tr>

			                                    <tr>
			                                       <td colspan="2" valign="top">
                                                    <table width="100%" height="100%" cellpadding="0" border="0" cellspacing="0">
                                                        <tr>
                                                            <td style="vertical-align:top;padding-top:5px;" align="left" class="tdSize1">&nbsp;&nbsp;Signature: </td>
                                                            <td style="vertical-align:top;padding-top:5px;padding-left:5px;" align="left" width="14%" class="tdSize1">
                                                                Class Teacher- <br/><br/>
                                                                Principal- <br/><br/>
                                                                Parents- 
                                                            </td>
                                                            <td style="vertical-align: top;padding-top: 5px;" align="left" class="tdSize1">
                                                                .....................................................<br/><br/>
                                                                .....................................................<br/><br/>
                                                                .....................................................
                                                            </td>
                                                            <td width="8%"></td>
                                                            <td style="vertical-align: top;text-align:left;padding-top: 5px;" class="tdSize1">
                                                                Final Result :
                                                                <span style='border-bottom: #000 dotted 1px; font-size: 15px;'>
				                                                        <?php
						                                                foreach ($teacher_remarks as $remarks) {
						                                                    if ($stuREGID  == $remarks->regid) {
						                                                        echo $remarks->teacherRemark;
						                                                    }
						                                                }
						                                                ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                                </span>              
                                                                Signature of Class Teacher- ..................................<br/><br/>
                                                                Signature of Principal with Seal- ..........................<br/><br/><br/><br/>
				                                                </td>
				                                            </tr>
                                                            <tr height="50px">
                                                            <td colspan="5" valign="top" style="font-size:18px;">
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
