<!DOCTYPE html>
<html lang="en">
    <head>
        <title>School ERP Software: Teamfreelancers</title>
        <script>
        	site_url_ = <?PHP echo '"' . site_url() . '"'; ?>;
            base_url_ = <?PHP echo '"' . base_url() . '"'; ?>;
            _img_folder_ = <?php echo '"' . $this->session->userdata('db2') . '"'; ?>;
            <?php if ($this->session->userdata('_current_year___')) { ?>
                _current_year___ = <?php echo '"' . $this->session->userdata('_current_year___') . '"'; ?>;
                _previous_year___ = <?php echo '"' . $this->session->userdata('_previous_year___') . '"'; ?>;
            <?php } else { ?>
                _current_year___ = '1000';
                _previous_year___ = '999';
            <?php } ?>
    	</script>
    	<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-responsive.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-wysihtml5.css'); ?>" />
        <link href="<?php echo base_url('assets_/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/fullcalendar.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/jquery.easy-pie-chart.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/jquery.gritter.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-style.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-media.css'); ?>" />        
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/mycss.css'); ?>?version=<?php echo JS_VERSION_NITIN; ?>" />
        <style>
            .page-loader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url(<?php echo base_url('assets_/img/page-loader.gif'); ?>) 50% 50% no-repeat rgb(249,249,249);
                opacity: .8;
            }
        </style>
        <style media="all">
        	body{
        		margin: 0mm 0mm;
        	}
            .table_{
            	background: #ffffff;
            	color: #000090 !important;
            }
            .header{
            	font-size: 13px;
            	font-weight: bold
            }
            .content{
            	font-size: 12px;
            	font-weight: bold;
            }
            U{
            	color: #000000 !important;
            }
            .gap_{
            	padding: 0px 5px; 
            }
        </style>
    </head>
    <body id="doc__">
    	<?php //print_r($tc_data);?>
    	<center>
    		<div class="container">
	    		<div class="row">
	    			<div class="col-sm-12 col-md-12 col-lg-12">
	    				<table border="0" width="80%" height="auto" cellpadding="10" class="table_" align="center" style="background: #ffffff">
	    					<tr>
	    						<td width="100">
	    							<img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="100" / ><br>
	    							<b>Aff. No. <?php echo $school_profile['affiliation']; ?></b>
	    						</td>
	    						<td align="center" class="header">
	    							<h3><?php echo strtoupper($school_profile['sch_name']);?></h3>
	    							[<?php echo $school_profile['remark'];?>]<br>
	    							<?php echo $school_profile['sch_addr'].", ".$school_profile['sch_city']." (".$school_profile['sch_distt'].")";?>, Mob.:<?php echo $school_profile['sch_contact'];?><br>
	    							e-mail: <?php echo $school_profile['sch_email'];?>
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="2">
	    							<table border="0" width="80%" height="auto" cellpadding="10" class="table_" align="center" style="background: #ffffff">
	    								<tr>
	    									<td width="100"></td>
	    									<td align="center">
	    										<div style="padding: 5px 0px; width: 500px; border:#000090 solid 2px; border-radius: 8px;font-size: 20px; font-weight: bold" class="col-sm-3">
			    									स्थानांतरण प्रमाण-पत्र/ TRANSFER CERTIFICATE
			    								</div>
	    									</td>
	    									<td width="100"></td>
	    								</tr>
		    						</table>
	    						</td>
	    					</tr>
	    					<tr class="content">
	    						<td colspan="2">
	    							<table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center" style="background: #ffffff" class="content">
	    								<tr>
	    									<td>
	    										विद्यालय सं0/ School No. <u><?php echo $tc_data->SCHOOL_NO;?></u><span class="gap_"></span>पुस्तक नं/ Book No. <u><?php echo $tc_data->BOOK_NO;?></u><span class="gap_"></span>क्रम सं/ S.N. <u><?php echo $tc_data->SNO;?></u><span class="gap_"></span>प्रवेश सं/ Admission No. <u><?php echo $tc_data->ADM_NO;?></u><span class="gap_"></span>
	    										<br>
	    										Application No. <u><?php echo $tc_data->APPLICATION_NO;?></u><span class="gap_"></span>Renewed upto <u><?php echo $tc_data->RENEWED_UPTO;?></u><span class="gap_"></span>Status of School <u><?php echo $tc_data->SCHOOL_STATUS;?></u>
	    										<br>
	    										Registration No. of Candidate (in case Class - IX to XII) <u><?php echo $tc_data->REGNO_OF_CANDIDATE;?></u>
	    									</td>
	    								</tr>
	    								<tr>
	    									<td>
	    										<ol>
	    											<li>विद्यार्थी का पूरा नाम/ Name of Pupil: <u><?php echo ucwords($tc_data->FNAME);?></u></li>

	    											<li>माता का नाम/ Mother's Name: <u><?php echo ucwords($tc_data->MOTHER);?></u></li>
	    											
	    											<li>पिता का नाम/ Father's Name: <u><?php echo ucwords($tc_data->FATHER);?></u></li>
	    											
	    											<li>राष्ट्रीयता/ Nationality: <u><?php echo strtoupper($tc_data->NATIONALITY);?></u></li>
	    											
	    											<li>क्या अनु०जाति/ जनजाति/ पिछड़ा वर्ग से सम्बंधित है : /Whether the pupil belongs to SC/ST/OBC Category: <u><?php echo strtoupper($tc_data->CATEGORY);?></u></li>
	    											
	    											<li>प्रवेश पुस्तिका के अनुसार  जन्म-तिथि/ DOB according to the Admission Register (अंकों में/in figure): <u><?php echo strtoupper($tc_data->DOB_);?></u></li>
	    											
	    											<li>क्या विद्यार्थी का परीक्षा परिणाम अनुतीर्ण है/ Whether the student is failed: <u><?php echo strtoupper($tc_data->STUDENT_FAILED);?></u></li>
	    											
	    											<li>प्रस्तावित विषय/ Subject Offered: <u><?php echo strtoupper($tc_data->SUBJECT_OFFERED);?></u></li>
	    											
	    											<li>पिछली कक्षा जिसमे विद्यार्थी अध्यनरत था/ Class in which the pupil last studied: <u><?php echo $tc_data->LAST_STUDIED_CLASS;?></u></li>
	    											
	    											<li>पिछले विद्यालय/ बोर्ड परीक्षा एवं परिणाम/ School/Board Annual examination last taken with result: <u><?php echo $tc_data->SCHOOL_OR_BOARD;?></u></li>
	    											
	    											<li>क्या उच्च कक्षा में पदोन्नति केअधिकारी है<br> Whether qualified for promotion to the next higher class: <u><?php echo $tc_data->PROMOTED;?></u></li>
	    											
	    											<li>क्या विधार्थी ने विद्यालय को सभी देय राशि का भुगतान कर दिया है<br> Whether the pupil was paid all dues to the school: <u><?php echo $tc_data->DUES_PAID;?></u></li>
	    											
	    											<li>क्या विधार्थी को कोई शुल्क रियायत प्रदान की गयी थी, यदि हाँ तो उसकी प्रकति<br> Whether the pupil was in receipt of any fee consession, if so the nature of such concession: <u><?php echo $tc_data->ANY_CONSESSION;?></u></li>

													<li>क्या विधार्थी ऐन०सी०सी० कैडिट/ स्काउट है? विवरण दें<br> Whether the pupil is NCC Cadet/ Boy Scout/ Girl Guide (give details): <u><?php echo $tc_data->NCC_SCOUT_GUIDE;?></u></li>

													<li>विद्यालय से विद्यार्थी का नाम काटे जाने की तिथि<br> Date of which pupil's name was struck off the rolls of the school: <u><?php echo $tc_data->DATE_OF_CUTTING_NAME;?></u></li>

													<li>विद्यालय छोड़ने का कारण/ Reason for leaving the school: <u><?php echo $tc_data->REASON_OF_LEAVING_SCHOOL;?></u></li>

													<li>अंतिम तिथि तक उपस्थितियों की कुल संख्या/ No. of meetings up to date: <u><?php echo $tc_data->NO_OF_MEETING_UPTODATE;?></u></li>

													<li>विद्यार्थी की विद्यालय दिनों की कुल उपस्थितियाँ/ No. of school days the pupil attended: <u><?php echo $tc_data->SCHOOL_DAYS_ATTENDED;?></u></li>

													<li>कोई अन्य टिप्प्पणी/ Any other remarks: <u><?php echo $tc_data->REMARKS_IF_ANY;?></u></li>

													<li>प्रमाण पत्र जारी करने की तिथि/ Date of issue of certificate: <u><?php echo $tc_data->DATE_OF_ISSUE;?></u></li>
	    										</ol>
	    									</td>
	    								</tr>
	    								<tr>
	    									<td colspan="2" style="padding: 5px 0px; height: 10px;"></td>
	    								</tr>
	    								<tr>
	    									<td colspan="2">
	    										<table border="0" width="100%" height="auto" cellpadding="10" class="table_" align="center" style="background: #ffffff" class="content">
	    											<tr>
	    												<td width="10"></td>
	    												<td align="center" style="border-top: #000000 solid 1px">हस्ताक्षरकर्ता/ Prapared by<br>(Name &amp; Designation)</td>
	    												<td width="10"></td>
	    												<td align="center" style="border-top: #000000 solid 1px">जााँचकर्ता/ Checked by<br>(Name &amp; Designation)</td>
	    												<td width="10"></td>
	    												<td align="center" style="border-top: #000000 solid 1px">ह० प्राचार्य/ कार्यालय मोहर<br>(Name &amp; Designation)</td>
	    												<td width="10"></td>
	    											</tr>
	    										</table>
	    									</td>
	    								</tr>
	    								<tr>
	    									<td colspan="2" style="font-size: 11px !important">
	    										नोट: यदि इस प्रबंधन केंद्र इंचार्ज द्वारा प्रमाणित हो तो प्रबंधक/ अध्यक्ष विद्यालय प्रबंधन समिति द्वारा प्रति हस्ताक्षरित आवशयक है |<br>
	    										Note: If this T.C. is certified by the officiating/ Incharge Principal, in variably countersigned by the Manager V.M.C.
	    									</td>
	    								</tr>
	    							</table>
	    						</td>
	    					</tr>
	    				</table>
	    			</div>
	    		</div>
	    	</div>
    	</center>

    	<script src="<?php echo base_url('assets_/js/jquery.min.js'); ?>"></script> 
		<script src="<?php echo base_url('assets_/js/jquery.ui.custom.js'); ?>"></script> 
		<script src="<?php echo base_url('assets_/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets_/js/myjs.js'); ?>?version=<?php echo JS_VERSION_NITIN; ?>"></script>  
    </body>
 </html>