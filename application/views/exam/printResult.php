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
            <style>
                .table_{
                    width: 95%; border: #000000 solid 2px;                    
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" align="center">
                        <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                    </div>
                </div>
                <div class="row">
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
                            <tr style="border-top:#000000 solid 1px;">
                                <td colspan="2" style="line-height:25px;">
                                    <?php
                                    foreach ($student_per_data as $stuData) {
                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                        $name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                        $name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                        ?>

                                        Student Name: <b><?php echo $name_ ?></b><br>
                                        Mother's Name / Father's Name: <b><?php echo $stuData->MOTHER; ?> / <?php echo $stuData->FATHER; ?></b><br>
                                        DOB: <b><?php echo $stuData->DOB_; ?></b><br>                                        
                                    <?php } ?>
                                </td>
                            </tr>
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
                                                    <?php $totalNumber_subject=0;?>
                                                    <?php foreach ($sch_data_class as $scho_items) { ?>
                                                        <?php $printData = false; ?>
                                                        <?php foreach ($subject_marks as $sub_marks) { ?>                                                              
                                                            <?php if ($subjectClass->subjectID == $sub_marks->subjectID){?>
                                                                <?php if ($sub_marks->termID == $exterm->termID && $sub_marks->itemID == $scho_items->itemID) { ?>
                                                                    <td align="center">                                                                    
                                                                        <?php echo $sub_marks->marks;
                                                                        $totalNumber_subject=$totalNumber_subject+$sub_marks->marks;
                                                                        $printData = true; ?>                                                                    
                                                                    </td>                                                            
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if ($printData == false) { ?>
                                                            <td></td>
                                                        <?php $printData=false;} ?> 
                                                    <?php } ?>                                     
                                                    <td align="center"><?php echo $totalNumber_subject;?></td>
                                                    <td align="center">Grade</td>
                                            <?php } ?>
                                            </tr>
                                        <?php } ?>
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