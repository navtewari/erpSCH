<?php if (count($overall_result) != 0) { ?>
    <?php

    function numberToRomanRepresentation($number) {
        $map = array('X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
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
                body{ margin-top: 0px }
                .hide_button{ display: none }
                .hide_pagination{
                    display:none;
                }
            </style>
            <style>
                td{font-size: 14px;font-weight: 600;}
                .tdSize{font-size:.8em;}
                .tdSize1{font-size:.9em;}
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
                h3{
                    margin:0;
                }
                h4,h5{
                    font-size:1.3em;
                    margin-top:0px;
                    margin-bottom: 0px;
                }
                .marginLarge{
                    margin-top:4px;
                }
                table{
                	text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="page-loader"></div>
            <?php if (count($overall_result) == 1 && $regID_ != 0) { ?>
                
            <?php } else { ?>
                <!-------------------------------------------------------------------------------ALL---->
                <div class="container-fluid" id="student_table">                           
                	<div align="center">       
					     <button name="create_excel" id="create_excel" class="btn btn-success">Download Excel File</button>  
					</div>  
                <table width="100%" border="1">
                    <caption><h3><b>TERM-<?php echo $termLink?> CROSS LIST FOR CLASS <?php echo numberToRomanRepresentation($classID); ?></b> <br/> <b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3></caption>             
                    <tr style="display:none;">
                    	<td colspan="10"><h3><b>TERM-<?php echo $termLink?> CROSS LIST FOR CLASS <?php echo numberToRomanRepresentation($classID); ?></b> <br/> <b>Academic Session <?php echo $this->session->userdata('_current_year___'); ?></b></h3></td>                    	
                    </tr>
                    <tr bgcolor="lightgrey">
            			<td rowspan="2">Sr No</td>
            			<td rowspan="2">Name</td>
            			<?php foreach ($overall_result as $over_result) { ?>
	            			<?php
	                        	$schCount = 0;
	                        	$scholasticName = explode(",", $over_result->scholasticName);
	                        	$schCount = count($scholasticName);
	                        ?>
	            			<?php foreach ($subject_class as $subjectClass) {?>                                                                
	            				<td style="font-size: 17px;" colspan="<?php echo $schCount-1;?>"><?php echo $subjectClass->subName;?></td>
	            				<td rowspan="2" bgcolor="lightgrey" style="transform: rotate(-90deg);background: none">Total</td>            
	            			<?php }?>
            			<?php break;}?>
            			        		
            			<td rowspan="2" style="transform: rotate(-90deg);background: none">Overall Total</td>
            		</tr>
            		<tr bgcolor="lightgrey">
            			<?php foreach ($subject_class as $subjectClass) {?>    
                			<?php foreach ($sch_data_class as $scho_items) {?>
                    			<td style="font-size:13px;"><?php echo $scho_items->item; ?></td>	                    				                    			
                			<?php }?>	                    			
            			<?php }?>                    			                    			                    		
            		</tr>
                    <?php $i=1; foreach ($overall_result as $over_result) { $totalNumber_subject=0;?>                    	                    		
                    		<tr <?php if($i%2==0){ echo "bgcolor=#E5E5E5";}else{}?> style="height:50px;">
                    			<td><?php echo $i;?></td>

                    			<?php 
                                	$stuREGID = $over_result->regid; //student registrationID
                                	$personalDetail = explode(",", $over_result->personalInfo); 
                                ?>
                    			<td style="font-size:12px;width:100px;"><?php echo $personalDetail[0];?></td>

                    			<?php 
                                    $subjectLoop = 0;
                                    foreach ($subject_class as $subjectClass) {                                    
                                    $term = 1;
                                ?>
                                                                                       
	                                <?php
	                                if ($termLink == 1) {
	                                    $Term1TotalMarks = explode("@", $over_result->Term1SubjectWise);
	                                    $subjectMarks = explode(",", $Term1TotalMarks[$subjectLoop]);	                                
	                                }elseif($termLink ==2){
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
                                <?php
                                $yes = 0;

                                    $subjectID = explode(",", $over_result->subjectID);
                                    if ($termLink == 1) {
                                        $subjectTotal = explode(",", $over_result->term1Result);                                    
                                    }elseif($termLink==2){
                                    	$subjectTotal = explode(",", $over_result->term2Result);                                    
                                    }
                                    for ($loop = 1; $loop < count($subjectID); $loop++) {
                                        if ($subjectID[$loop] == $subjectClass->subjectID) {
                                            if ($subjectTotal[$loop] != 0) {
                                                echo "<td align=center bgcolor=lightgrey>" .$subjectTotal[$loop] ."</td>";
                                            } else {
                                                echo "<td align=center bgcolor=lightgrey> </td>"; 
                                                $yes = 1;
                                            }
                                            $totalNumber_subject += $subjectTotal[$loop];
                                        }
                                    }
                                ?>                               
                            	<?php 
	                                if ($term == 1) {
	                                    $term++;
	                                } else if ($term == 2) {
	                                    $term--;
	                                }
$subjectLoop++;
                                }
                                ?> 
                                <?php  ?>
                                <td bgcolor="lightgrey"><?php echo $totalNumber_subject;?></td>                                 
                    		</tr>
                    <?php $i++;} ?>
                    </table>   
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

<script src="<?php echo base_url(). 'assets_/js/jquery.table2excel.js'?>"></script>
<script>  
	$("#create_excel").click(function(){
  $("#student_table").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "crossList", //do not include extension
    fileext: ".xls", // file extension
    preserveColors:false
  }); 
});
 
</script>  