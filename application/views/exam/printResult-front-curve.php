<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if (count($subject_marks) != 0) { ?>
    <html>
        <head>
            <title> Result of Class <?php echo $classID; ?> </title>
            <!-- Bootstrap CSS -->
            <link href="<?PHP echo base_url() . 'assets_/css/bootstrap.min.css'; ?>" rel="stylesheet">
            <!-- bootstrap theme -->
            <style>
                @media print { 
                    body{ margin-left:1.5em;margin-right:1.5; height:100vh;}
                    .printWindow{margin-top: 1.5em;}
                    .hide_button{ display: none }
                    .hide_pagination{
                        display:none;
                    }
                    .backcolor{
                        background: #000!important;width:500px; padding:5px;color: #ffffff!important;
                    }
                }
            </style>
            <style>
                td{font-size: 13px;font-weight: 600;}
                .table_{
                    border: #000000 solid 1px;
                    width:95%;                    
                }   
                h4{
                    font-size:20px;
                }
                .backcolor{
                    background: #000!important;width:500px; padding:5px;color: #fff;
                }
                h5{
                    font-size:16px;
                    margin-bottom: 20px;
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
            <?php if (count($student_per_data) == 1 && $reg_id != 0) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 hide_button" align="center">
                            <button class="btn btn-danger print_button" onclick="window.print();">Print Result</button>
                        </div>
                    </div>                
                    <div class="row printWindow">
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
                                <tr align="center" height='250'>
                                    <td colspan="2">
                                        <h1 class='backcolor'>PROGRESS REPORT</h1>
                                        <h3>Class : <?php echo $classID; ?></h3>
                                        <h4>Academic Year  (<?php echo $this->session->userdata('_current_year___'); ?>)</h4><br/>
                                    </td>
                                </tr>
                                <!-- Student Information -->
                                <tr>
                                    <td colspan="2">
                                        <table border="0" style="line-height:25px;" width="100%" cellpadding='5'>                                        
                                            <tr>
                                                <td valign='top'><img src='<?php echo base_url() . 'assets_/img/download.jpg' ?>' align='left' style='border:1px #000 solid;max-width: 150px;margin-top: 10px;'/></td>
                                                <td valign='top'>                                                         
                                                    <?php
                                                    foreach ($student_per_data as $stuData) {
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>                                                    
                                                        <h5>Admission No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000;"><?php echo $reg_id ?></span></h5>
                                                        <h5>Student's Name&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $name_ ?></span></h5>
                                                        <h5>Mother's Name&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $stuData->MOTHER; ?></span></h5>
                                                        <h5>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $stuData->FATHER; ?></span></h5>  
                                                        <h5>Date Of Birth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $stuData->DOB_; ?></span></h5>
                                                        <h5>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $classID; ?></span></h5>
                                                    <?php } ?>
                                                </td>
                                                <td style="padding-left: 100px;" valign="top">
                                                    <h5>HEALTH STATUS :</h5>
                                                    <h5>Height :.......................................</h5>
                                                    <h5>Weight :.......................................</h5>
                                                    <h5>Blood Group :............................</h5>
                                                    <h5>Vision (L) :..............(R)...............</h5>
                                                    <h5>School Reopens on :.................</h5>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Scholastic Area -->                                                                                           
                                <tr style='height:100px;'>
                                    <td colspan="2">
                                        <h4 align='center'></h4>                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <h4 align='center'>INSTRUCTIONS</h4>                                        
                                    </td>
                                </tr>

                                <!-- Co-Scholastic Area -->                            
                                <tr>
                                    <td colspan="2">
                                        <table border="0" width="95%" height="auto" cellpadding="10" align="center">
                                            <tr>
                                                <td align="center"><h5 align="center">Grading Scale for Scholastic Areas</h5>(Grading are awarded on 8 point grading scale as follow)</td>
                                                <td align="center"><h5 align="center">Co-Scholastic Activities</h5>(Grading are awarded on 3 point grading scale as follow)</td>
                                            </tr>
                                            <tr>
                                                <td align="center">                                    
                                                    <table width="60%" border="1" cellpadding="2" style="height:250px;">                                        
                                                        <tr>
                                                            <td align="center">Marks Range</td>
                                                            <td align="center">Grade

                                                            </td>
                                                        </tr>
                                                        <?php foreach ($class_grade as $cgrade) { ?>
                                                            <tr>                                
                                                                <td align="center">
                                                                    <?php echo $cgrade->minMarks; ?> - <?php echo $cgrade->maxMarks; ?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo $cgrade->grade; ?>

                                                                    <?php
                                                                    if ($cgrade->description != '') {
                                                                        echo '(' . $cgrade->description . ')';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>                                        
                                                    </table>                                    
                                                </td>

                                                <td align="center" valign="top">                                    
                                                    <table style="height:250px;" width="70%" border="1" cellpadding="2">
                                                        <tr>
                                                            <td align="center">GRADE</td>
                                                            <td align="center">Grade Achievement</td>
                                                        </tr>
                                                        <tr>                                
                                                            <td align="center">A</td>
                                                            <td align="center">OutStanding</td>
                                                        </tr>
                                                        <tr>                                
                                                            <td align="center">B</td>
                                                            <td align="center">Very Good</td>
                                                        </tr>
                                                        <tr>                                
                                                            <td align="center">C</td>
                                                            <td align="center">Fair</td>
                                                        </tr>                                       
                                                    </table>                                    
                                                </td>
                                            </tr>                            
                                        </table>
                                    </td>
                                </tr>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-------------------------------PRINT ALL---------------------------------------------->
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
                        <div class="row printWindow" style="page-break-after: always;">
                            <div class="col-sm-12">
                                <table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center">
                                    <tr align="center">
                                        <td width="100"><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100" /></td>
                                        <td>
                                            <h1><?php echo $sch_name; ?></h1>
                                            <h4>[<?php echo $sch_remark; ?>]</h4>
                                            <h6><?php echo $sch_addr; ?>, Contact No-<?php echo $sch_contact; ?>, Email-<?php echo $sch_email; ?></h6>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="2">
                                            <h1 style="background: #000;width:300px; padding:5px;color: #fff;">REPORT CARD</h1>
                                            <h3>Class : <?php echo $classID; ?></h3>
                                            <h4>Academic Session  (<?php echo $this->session->userdata('_current_year___'); ?>)</h4><br/>
                                        </td>
                                    </tr>
                                    <!-- Student Information -->
                                    <tr>
                                        <td colspan="2">
                                            <table border="0" style="line-height:25px;" width="100%">                                        
                                                <tr>                                            
                                                    <td width='50%'>     
                                                        <h5>STUDENT PROFILE :</h5>
                                                        <?php
                                                        $name_ = (($stuData->FNAME == "-x-") ? "" : $stuData->FNAME);
                                                        //$name_ = $name_ . (($stuData->MNAME == "-x-") ? "" : " " . $stuData->MNAME);
                                                        //$name_ = $name_ . (($stuData->LNAME == "-x-") ? "" : $stuData->LNAME);
                                                        ?>
                                                        <h5>Admission No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000;"><?php echo $stuData->regid ?></span></h5>
                                                        <h5>Student's Name&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $name_ ?></span></h5>
                                                        <h5>Mother's Name&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $stuData->MOTHER; ?></span></h5>
                                                        <h5>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $stuData->FATHER; ?></span></h5>  
                                                        <h5>Date Of Birth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $stuData->DOB_; ?></span></h5>
                                                        <h5>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="border-bottom: 2px dotted #000"><?php echo $classID; ?></span></h5>                                                        
                                                    </td>
                                                    <td style="padding-left: 100px;" valign="top">
                                                        <h5>HEALTH STATUS :</h5>
                                                        <h5>Height :.....................................................</h5>
                                                        <h5>Weight :.....................................................</h5>
                                                        <h5>Blood Group :..........................................</h5>
                                                        <h5>Vision (L) :....................(R).......................</h5>
                                                        <h5>School Reopens on :...............................</h5>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- Scholastic Area -->                                                           
                                    <tr>
                                        <td colspan="2">
                                            <h4><?php echo $name_ ?>'s Performance :</h4>
                                            <div id="curve_chart<?php echo $stuData->regid; ?>" style="height:300px;"></div>
                                        </td>
                                    </tr>

                                    <!-- Co-Scholastic Area -->                            

                                    <table border="0" width="95%" height="auto" cellpadding="10" align="center" style="border: #000000 solid 1px;">
                                        <tr>
                                            <td align="center"><h5 align="center">Grading Scale for Scholastic Areas</h5>(Grading are awarded on 8 point grading scale as follow)</td>
                                            <td align="center"><h5 align="center">Co-Scholastic Activities</h5>(Grading are awarded on 3 point grading scale as follow)</td>
                                        </tr>
                                        <tr>
                                            <td align="center">                                    
                                                <table width="50%" border="1" cellpadding="2">                                        
                                                    <tr>
                                                        <td align="center">Marks Range</td>
                                                        <td align="center">Grade

                                                        </td>
                                                    </tr>
                                                    <?php foreach ($class_grade as $cgrade) { ?>
                                                        <tr>                                
                                                            <td align="center">
                                                                <?php echo $cgrade->minMarks; ?> - <?php echo $cgrade->maxMarks; ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $cgrade->grade; ?>

                                                                <?php
                                                                if ($cgrade->description != '') {
                                                                    echo '(' . $cgrade->description . ')';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>                                        
                                                </table>                                    
                                            </td>

                                            <td align="center" valign="top">                                    
                                                <table width="70%" border="1" cellpadding="2">
                                                    <tr>
                                                        <td align="center">GRADE</td>
                                                        <td align="center">Grade Achievement</td>
                                                    </tr>
                                                    <tr>                                
                                                        <td align="center">A</td>
                                                        <td align="center">OutStanding</td>
                                                    </tr>
                                                    <tr>                                
                                                        <td align="center">B</td>
                                                        <td align="center">Very Good</td>
                                                    </tr>
                                                    <tr>                                
                                                        <td align="center">C</td>
                                                        <td align="center">Fair</td>
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

<script type="text/javascript">
                        site_url_ = <?PHP echo '"' . site_url() . '"'; ?>;
                        base_url_ = <?PHP echo '"' . base_url() . '"'; ?>;
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        regid_ = <?PHP echo '"' . $reg_id . '"'; ?>;
                        pageLimit_ = <?PHP echo '"' . $per_page . '"'; ?>;
                        start_ = <?PHP echo '"' . $startLimit . '"'; ?>;
                        classSessid_ = <?PHP echo '"' . $classSessID . '"'; ?>;

                        url_ = site_url_ + "/exam/frontPrintGraph/" + classSessid_ + "/" + regid_ + "/1/" + pageLimit_ + "/" + start_;
                        //alert(url_);
                        function drawChart() {
                            $.ajax({
                                type: 'POST',
                                url: url_,
                                success: function (data1) {
                                    var obj = JSON.parse(data1);
                                    //alert(obj.student_per_data.length);
                                    if (obj.student_per_data.length > 0) {
                                        for (i = 0; i < obj.student_per_data.length; i++) {
                                            var reg_id = obj.student_per_data[i].regid;
                                            //alert(reg_id);

                                            var data = new google.visualization.DataTable();

                                            data.addColumn('string', 'SUBJECT');
                                            data.addColumn('number', 'TERM 1');
                                            data.addColumn('number', 'TERM 2');

                                            data.addRows(obj.subject_class.length);

                                            for (j = 0; j < obj.subject_class.length; j++) {
                                                data.setCell(j, 0, obj.subject_class[j].subName);
                                            }

                                            for (j = 0; j < obj.overall_result.length; j++) {
                                                if (reg_id === obj.overall_result[j].regid) {

                                                    var term1Arr = obj.overall_result[j].term1Result;

                                                    var term1 = term1Arr.split(',');
                                                    l = 0;
                                                    for (k = 1; k < term1.length; k++) {
                                                        data.setCell(l, 1, term1[k]);
                                                        l++;
                                                    }

                                                    var term2Arr = obj.overall_result[j].term2Result;

                                                    var term2 = term2Arr.split(',');
                                                    l = 0;
                                                    for (k = 1; k < term2.length; k++) {
                                                        data.setCell(l, 2, term2[k]);
                                                        l++;
                                                    }

                                                    var options = {
                                                        title: '',
                                                        curveType: 'function',
                                                        legend: {position: 'right'}
                                                    };

                                                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart' + reg_id));
                                                    //alert('curve_chart' + reg_id);
                                                    chart.draw(data, options);
                                                }
                                            }
                                        }
                                    }
                                }, error: function (xhr, status, error) {
                                    callDanger(xhr.responseText);
                                }
                            });
                        }
</script>