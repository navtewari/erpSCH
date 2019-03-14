<?php if (count($subject_marks) != 0) { ?>
    <html>
        <head>
            <title> Result of Class <?php echo $classID; ?> </title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap.min.css'); ?>" />                        
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
            <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
            <style type="text/css">

                @media print { 
                    body{ margin-top: 0px }
                    .hide_button{ display: none }
                    .hide_pagination{
                        display:none;
                    }
                    
                    .backcolor{
                        background:#0066ff!important;
                        color:#ffffff!important;
                    }
                    .txtcolor{
                        color:#0066ff!important;
                    }
                }
            </style>
            <style>
                td{font-size: 13px;font-weight: 600;}
                .table_{
                    border: #0066ff solid 45px;
                    width:98%;
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
            <div id="loading_process" style="font-weight: bold; font-family: verdana; display: inline-block; opacity: 0; left:auto; right: auto; position: fixed; min-width: 100px; width: auto; height: auto; border-radius: 5px; padding: 5px; background: #F0F0F0; border: #808080 dotted 1px; color: 000000; margin-top: 2%; z-index: 99999"></div>

            <?php if (count($student_per_data) == 1 && $regID_ != 0) { ?>
                <div class="container">                    
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>                
                    <div class="row" style="margin-top:0px;">
                        <div class="col-sm-12">
                            <table border="0" width="100%" height="auto" cellpadding="8" class="table_" align="center">                                                                                           
                                <!-- Scholastic Area -->
                                <tr>
                                    <td colspan="2">
                                        <table border="1" cellpadding="5" width="100%">
                                            <tr>
                                                <td width="30%" rowspan="2">SUBJECT STUDIES</td>
                                                <td rowspan="2">MARKS</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php $noterm=1; foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td align="center" colspan="<?php echo ($schCount); ?>"><?php if($noterm==1){echo "HALF YEARLY";} else {echo "ANNUAL";}/*$exterm->termName;*/$noterm++; ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>                                               
                                                
                                                <?php foreach ($exam_term as $exterm) { ?> <!-- for each exam term -->
                                                    <?php      
                                                    foreach ($sch_data_class as $scho_items) {
                                                        ?> <!-- for each Scholastic item -->
                                                        <td align="center" width="220"><?php echo $scho_items->item; ?></td>
                                                    <?php } ?>                                                    
                                                <?php } ?>
                                            </tr>


                                            <?php foreach ($subject_class as $subjectClass) { ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        echo $subjectClass->subName;
                                                        $term = 1;
                                                        ?>
                                                    </td>
                                                    <td>GRADE</td>
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
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Co-Scholastic Area -->
                                <tr>
                                    <td>
                                        <table border="1" cellspacing="0" cellpadding="5" width="100%">                                        
                                            <tr>
                                                <td>TRAITS OF PERSONALITY</td>                                                
                                                <td align="center">HALF YEARLY</td>
                                                <td align="center">ANNUAL</td>    
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
                                        <table border="1" cellspacing="0" cellpadding="5" width="100%" style="height: 100%">                                        
                                            <tr>
                                                <td></td>                                                
                                                <td align="center">HALF YEARLY</td>
                                                <td align="center" width="26%">ANNUAL</td>    
                                            </tr>                                            
                                            <tr>
                                                <td>Total Attendance</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                            <tr>
                                                <td>Total Attendance</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                            <tr>
                                                <td>Total Working Days</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                            <tr style="height: 80px;">
                                                <td>Remarks</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                            <tr style="height: 50px;">
                                                <td>Signature of Class Teacher</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                            <tr style="height: 50px;">
                                                <td>Signature of Parent</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                            <tr style="height: 50px;">
                                                <td>Signature of Principal</td>                                                
                                                <td align="center"></td>
                                                <td align="center"></td>    
                                            </tr>
                                        </table>
                                    </td>
                                </tr>                               

                                <tr height="80">
                                    <td colspan="2" style="text-align: center; font-family: cursive">
                                        <div align="center" style="margin: 10px 0 20px 0"><h3 align="center" class="backcolor" style="width:300px;-webkit-print-color-adjust: exact;font-family: cursive;background: #0066ff;padding:5px;color: #fff;border-radius: 40px;">Congratulation</h3></div>
                                        <h4>Promoted to Class
                                            <span style='border-bottom: #999999 dashed 1px; font-size: 17px;padding-left: 20px;'>
                                                <?php
                                                foreach ($teacher_remarks as $remarks) {
                                                    echo $remarks->promotedClass;
                                                }
                                                ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </span>
                                        </h4>
                                    </td>                                    
                                </tr>    
                                <tr>
                                    <td colspan="2">
                                        <h3 class="txtcolor" style="text-align: center;color: #0066ff; font-family: cursive">I wish all the best to the child and <br>sincerely hope that the ensuing years will be as memorable as this one</h3>
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
                        <div class="row" style="margin-top:0px;page-break-after: always;">
                            <div class="col-sm-12">
                                <table border="0" width="100%" height="auto" cellpadding="8" class="table_" align="center">

                                    <!-- Scholastic Area -->
                                    <tr>
                                        <td colspan="2">
                                            <table border="1" cellpadding="5" width="100%">                                                
                                                <tr>
                                                <td width="30%" rowspan="2">SUBJECT STUDIES</td>
                                                <td rowspan="2">MARKS</td>
                                                <?php
                                                $schCount = 0;
                                                foreach ($sch_data_class as $scho_items) {
                                                    $schCount++;
                                                }
                                                ?>

                                                <?php $noterm=1; foreach ($exam_term as $exterm) { ?> <!-- Display each exam term -->
                                                    <td align="center" colspan="<?php echo ($schCount); ?>"><?php if($noterm==1){echo "HALF YEARLY";} else {echo "ANNUAL";}/*$exterm->termName;*/$noterm++; ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>                                               
                                                
                                                <?php foreach ($exam_term as $exterm) { ?> <!-- for each exam term -->
                                                    <?php      
                                                    foreach ($sch_data_class as $scho_items) {
                                                        ?> <!-- for each Scholastic item -->
                                                        <td align="center" width="220"><?php echo $scho_items->item; ?></td>
                                                    <?php } ?>                                                    
                                                <?php } ?>
                                            </tr>

                                                <?php foreach ($subject_class as $subjectClass) { ?>
                                                    <tr>
                                                        <td><?php
                                                            echo $subjectClass->subName;
                                                            $term = 1;
                                                            ?></td>
                                                        <td>GRADE</td>
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
                                                        <?php } ?>
                                                    </tr><?php } ?>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- Co-Scholastic Area -->
                                    <tr>
                                        <td>
                                            <table border="1" cellspacing="0" cellpadding="5" width="100%">                                        
                                                <tr>
                                                    <td>TRAITS OF PERSONALITY</td>                                                
                                                    <td align="center">HALF YEARLY</td>
                                                    <td align="center">ANNUAL</td>    
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
                                            <table border="1" cellspacing="0" cellpadding="5" width="100%" style="height: 100%">                                        
                                                <tr>
                                                    <td></td>                                                
                                                    <td align="center">HALF YEARLY</td>
                                                    <td align="center" width="26%">ANNUAL</td>    
                                                </tr>                                            
                                                <tr>
                                                    <td>Total Attendance</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                                <tr>
                                                    <td>Total Attendance</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                                <tr>
                                                    <td>Total Working Days</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                                <tr style="height: 80px;">
                                                    <td>Remarks</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <td>Signature of Class Teacher</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <td>Signature of Parent</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <td>Signature of Principal</td>                                                
                                                    <td align="center"></td>
                                                    <td align="center"></td>    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr height="80">
                                        <td colspan="2" style="text-align: center; font-family: cursive">
                                            <div align="center" style="margin: 10px 0 20px 0"><h3 class="backcolor" align="center" style="width:300px;-webkit-print-color-adjust: exact;font-family: cursive;background: #0066ff;padding:5px;color: #fff;border-radius: 40px;">Congratulation</h3></div>
                                            <h4>Promoted to Class
                                                <span style='border-bottom: #999999 dashed 1px; font-size: 17px;padding-left: 20px;'>
                                                    <?php
                                                    foreach ($teacher_remarks as $remarks) {
                                                        if ($stuData->regid == $remarks->regid) {
                                                            echo $remarks->promotedClass;
                                                        }
                                                    }
                                                    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </span>
                                            </h4>
                                        </td>                                    
                                    </tr>    
                                    <tr>
                                        <td colspan="2">
                                            <h3 class="txtcolor" style="text-align: center;color: #0066ff; font-family: cursive">I wish all the best to the child and <br>sincerely hope that the ensuing years will be as memorable as this one</h3>
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

