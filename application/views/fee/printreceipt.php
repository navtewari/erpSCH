<?php
	if(count($receipt)!=0){
	$fee_ = new My_library();
	$inwords = new Numbertowords();

	$name_ = (($receipt->FNAME == "-x-") ? "" : $receipt->FNAME);
    $name_ = $name_ . (($receipt->MNAME == "-x-") ? "" : " ".$receipt->MNAME);
    $name_ = $name_ . (($receipt->LNAME == "-x-") ? "" : $receipt->LNAME);
?>

<html>
	<head>
		<title> Receipt for <?php echo $receipt->regid; ?> </title>
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
	    </style>
        <style type="text/css" media="all">
	    	.table_{
	    		width: 700px; border: #000000 solid 2px;
	        }
        	.print_button{ 
        		font-family: Arial; 
        		border-radius: 5px; 
        	}
        	.label_{
        		font-weight: bold;
        		font-size:13px;
        	}
        	.content{
        		font-size: 13px;
        	}
        	.address_contact{
        		font-family: Courier;
        		font-size: 11px;
        	}
        	.optionalNote{
        		font-family: Arial;
        		font-size: 10px;
        		padding: 5px
        	}
        	.myfont {
        		font-family: Verdana;
        	}
        	.border_ {
        		border: #000000 solid 1px;
        	}
        	.myborder{
        		border: #000000 solid 1px;
        	}
        	.feeHeader{
        		height: 100px; 
        		text-align: center; 
        		vertical-align: middle
        	}
        	.header_text{
        		font-size: 25px;
        	}
        	.space_td{
        		  padding: 5px;
        		  font-size: 12px;
        		  font-weight: bold;
        	}
        	.myline_{
        		height: 1px; 
        		border-bottom: 1px solid #000000; 
        	}
        	sup{
        		font-size: 9px;
        	}
        </style>
	</head>
	<body>
		<center>
		<div class="row">
		<div class="col-sm-12 hide_button" style="margin-top: 10px">
            <button class="btn btn-danger print_button" onclick="window.print();">Print</button>
        </div>
        <div style="clear: both; height: 10px"></div>
		<?php for($i=1;$i<=2;$i++){ ?>
			<table border="0" class="myfont table_" cellpadding="10"><tr><td>
			<table border="0" class="myfont table_" style='border:#009900 solid 0px'>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" class="table_" style='border:#009900 solid 0px'>
							<tr class="feeHeader">
								<td width="100"><img src='<?php echo base_url('assets_/'.$this->session->userdata('db2').'/logo/'.$this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_;?>' width="100" / ></td>
								<td width="500">
									<span class='header_text'>
									<b><?php echo $this->session->userdata('sch_name').", ".$this->session->userdata('sch_city'); ?></b><br />
									<span style="font-weight: 100">Fee Receipt <br />
									<span style="font-size: 13px; font-weight: bold">
										<?PHP 
											if($receipt->YEAR_FROM == $receipt->YEAR_TO && $receipt->MONTH_FROM == $receipt->MONTH_TO){
												echo $receipt->YEAR_FROM . ", " . $fee_->getMonthsName($receipt->MONTH_FROM);
											} else {
												echo $receipt->YEAR_FROM . ", " . $fee_->getMonthsName($receipt->MONTH_FROM) . " - to - " . $receipt->YEAR_TO . ", " . $fee_->getMonthsName($receipt->MONTH_TO);
											}
										?>
									</span>
								</td>
								<td width="100"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" class="table_" style='border:#009900 solid 0px'>
							<tr>
								<td class="myline_" colspan="4"></td>
							</tr>
							<tr>
								<td colspan="4">
									<table border="0" cellpadding="0" cellspacing="0" class="table_" style='border:#009900 solid 0px'>
										<tr>
											<td align="left" class="space_td">Receipt No.: <?php echo $receipt->RECPTID; ?></td>
											<td align="center" class="space_td">
												<div style="width:150px; background: #f0f0f0; border-radius: 5px">
												<?php if($i == 1){ ?>
													Office Copy
												<?php } else if($i == 2){ ?>
													Student Copy
												<?php } ?>
												</div>
											</td>
											<td align="right" class="space_td">Date: <?php echo date('d/m/Y'); ?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="myline_" colspan="4"></td>
							</tr>
							<tr>
								<td style="height: 10px"></td>
							</tr>
							<tr class="myfont">
								<td colspan="2" width="50%" valign="top">
									<table border="0" class="myfont" cellpadding="5">
										<tr>
											<td class="label_" width="100">Reg. no.</td>
											<td class="content"><?php echo $receipt->regid; ?></td>
										</tr>
										<tr>
											<td class="label_">Name</td>
											<td class="content"><?php echo $name_; ?></td>
										</tr>
										<tr>
											<td class="label_">Father</td>
											<td class="content"><?php echo $receipt->FATHER; ?></td>
										</tr>
										<tr>
											<td class="label_">Class</td>
											<td class="content"><?php echo $receipt->CLASSID; ?></td>
										</tr>
										<tr>
											<td class="label_">Session</td>
											<td class="content"><?php echo $receipt->SESSID; ?></td>
										</tr>
									</table>
								</td>
								<td colspan="2" width="50%" valign="top">
									<table border="0" class="myfont" cellpadding="5">
										<?php 
											$i_ = explode(" ",$receipt->DATE_);
											$x_ = explode("-",$i_[0]);
											$dt_ = $x_[2] . "/" . $x_[1] . "/" . $x_[0];
											
										?>
										<tr valign="top">
											<td class="label_" width="130">Submission Date</td>
											<td class="content"><?php echo $dt_; ?></td>
										</tr>
										<?php
											$static_heads = ''; 
											$static_amnt  = 0;
											$flexi_heads = '';
											$flexi_amount = 0;
											if($receipt->STATIC_HEADS_1_TIME != ''){ // static heads 1 time
												$st1time = explode(",", $receipt->STATIC_HEADS_1_TIME);
												foreach($st1time as $val){
													if($static_heads != ''){
														$static_heads = $static_heads . explode("@", $val)[0];		
													} else {
														$static_heads = explode("@", $val)[0];
													}
												}
											}
											if($receipt->STATIC_HEADS_N_TIMES != ''){ // static heads n time
												$stntime = explode(",", $receipt->STATIC_HEADS_N_TIMES);
												foreach($stntime as $val){
													if($static_heads != ''){
														$static_heads = $static_heads . ", " . explode("@", $val)[0];		
													} else {
														$static_heads = explode("@", $val)[0];
													}	
												}
											}
											$static_amnt  = $receipt->STATIC_SPLIT_AMT_1_TIME;

											if($receipt->STATIC_SPLIT_AMT_N_TIME!=''){
												$static_amnt  = $static_amnt  . ", ".$receipt->STATIC_SPLIT_AMT_N_TIME;
											} else {
												$static_amnt  = $receipt->STATIC_SPLIT_AMT_N_TIME;
											}
											$flexi_heads  = $receipt->FLEXIBLE_HEADS_1_TIME;
											if($receipt->FLEXIBLE_HEADS_1_TIME != ''){ // static heads n time
												$flex1time = explode(",", $receipt->FLEXIBLE_HEADS_1_TIME);
												foreach($flex1time as $val){
													if($flexi_heads != ''){
														$flexi_heads = $flexi_heads . explode("@", $val)[0];		
													} else {
														$flexi_heads = explode("@", $val)[0];
													}	
												}
											}
											$flexi_amount = $receipt->FLEXI_SPLIT_AMT_1_TIME;
											if($flexi_heads != ''){
												$flexi_heads  = $flexi_heads  . ", ".$receipt->FLEXIBLE_HEADS_N_TIMES;
											} else {
												$flexi_heads  = $receipt->FLEXIBLE_HEADS_N_TIMES;
											}
											if($receipt->FLEXI_SPLIT_AMT_N_TIMES != ''){ // Flexi heads n time
												$flexntime = explode(",", $receipt->FLEXI_SPLIT_AMT_N_TIMES);
												foreach($flexntime as $val){
													if($flexi_heads != ''){
														$flexi_heads = $flexi_heads . ", " . explode("@", $val)[0];		
													} else {
														$flexi_heads = explode("@", $val)[0];
													}	
												}
											}
											if($receipt->FLEXI_SPLIT_AMT_N_TIMES != ''){ // Flexi heads n time
												$flexi_amount = $flexi_amount . ", " . $receipt->FLEXI_SPLIT_AMT_N_TIMES;
											} else {
												$flexi_amount = $flexi_amount . $receipt->FLEXI_SPLIT_AMT_N_TIMES;
											}

											$heads = $static_heads . ", " . $flexi_heads;
										?>
										<tr valign="top">
											<td class="label_" width="130">Heads</td>
											<td class="content"><?php echo ucwords(strtolower($heads)); ?></td>
										</tr>
										<tr valign="top">
											<td class="label_">Mode </td>
											<td class="content"><?php echo $receipt->MODE; ?></td>
										</tr>
										<?php if($receipt->MODE != 'cash') {?>
										<tr valign="top">
											<td class="label_"><?php echo ucwords(strtolower($receipt->MODE)); ?> No. &amp; Date</td>
											<td class="content"><?php echo $receipt->DD_CQ_NO." [".$receipt->DD_CQ_DATE."]"; ?></td>
										</tr>
										<?php } ?>
										<?php if($receipt->DISCOUNT_AMOUNT != 0){?>
										<tr valign="top" style="background: #f0f0f0">
											<td class="label_"></td>
											<td class="content">
												Discount - Rs.<?php echo $receipt->DISCOUNT_AMOUNT; ?>/-<sup>**</sup>
											</td>
										</tr>
										<?php } ?>
										<?php if($receipt->FINE != 0){?>
										<tr valign="top" style="background: #f0f0f0">
											<td class="label_"></td>
											<td class="content">Fine - Rs.<?php echo $receipt->FINE; ?>/-</td>
										</tr>
										<?php } ?>
										<?php 
											$total_paid = $receipt->ACTUAL_PAID_AMT-$receipt->DISCOUNT_AMOUNT+$receipt->FINE;
										?>
										<tr valign="top">
											<td class="label_">Total Paid</td>
											<td class="content"><b>Rs. <?php echo $total_paid; ?></b>/- &nbsp;
												(<?php echo $inwords->convert_number($total_paid); ?>)
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="myline_" colspan="4"></td>
							</tr>
							<tr>
								<td colspan="4" style="height: 10px"></td>
							</tr>
							<tr>
								<td colspan="4">
									<table border="0" cellpadding="5" class="table_" style='border:#009900 solid 0px'>
										<tr>
											<td colspan="2" class="address_contact" width="50%">
												<b>Address</b><br /> 
												<?php echo $this->session->userdata('sch_addr').", ".$this->session->userdata('sch_city').", ".$this->session->userdata('sch_state')." (".$this->session->userdata('sch_country').")"; ?>
												<BR />
												<b>Contact</b>: <?php echo $this->session->userdata('sch_contact'); ?><br />
												<b>Email</b>: <?php echo $this->session->userdata('sch_email'); ?><br />
											</td>
											<td colspan="2" width="50%" align="right" valign="bottom" style="font-size: 12px">Authorized Signatory</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="myline_" colspan="4"></td>
							</tr>
							<tr>
								<td colspan="4" class="optionalNote">
									*Optional fee is not compulsory for student. Those student enrolled for additional facilities are required to submit the same.
									<?php if($receipt->DISCOUNT_AMOUNT != 0){?>
									<?php
										$categ = explode('|', $receipt->DISCOUNT_CATEGORY);
									?>
									<br />
									** Discount on behalf of - <?php echo $categ[0];?>
									<?php } ?>
									<br>
									<?php if($receipt->DESCRIPTION_IFANY != '' && $receipt->DESCRIPTION_IFANY != 'x' && strlen($receipt->DESCRIPTION_IFANY) >1){?>
										<br>{Note: <?php echo $receipt->DESCRIPTION_IFANY?>}
									<?php } ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</td></tr></table>
			<div class="col-sm-2"></div>
			<div style="clear: both; height: 35px"></div>
		<?php } ?>
		<div class="col-sm-12 hide_button" style="margin-top: 10px">
            <button class="btn btn-danger print_button" onclick="window.print();">Print</button>
        </div>
		</div>
		</center>
	</body>
	<!-- javascripts -->
	<script src="<?PHP echo base_url() . 'nitnav/js/jquery.js'; ?>"></script>
	<script src="<?PHP echo base_url() . 'nitnav/js/jquery-ui-1.10.4.min.js'; ?>"></script>
	<script src="<?PHP echo base_url() . 'nitnav/js/jquery-1.8.3.min.js'; ?>"></script>
	<script type="text/javascript" src="<?PHP echo base_url() . 'nitnav/js/jquery-ui-1.9.2.custom.min.js'; ?>"></script>
	<!-- bootstrap -->
	<script src="<?PHP echo base_url() . 'nitnav/js/bootstrap.min.js'; ?>"></script>
	<!-- nice scroll -->
	<script src="<?PHP echo base_url() . 'nitnav/js/jquery.scrollTo.min.js'; ?>"></script>
	<script src="<?PHP echo base_url() . 'nitnav/js/jquery.nicescroll.js'; ?>" type="text/javascript"></script>
	<script src="<?PHP echo base_url() . 'nitnav/js/checkList.js'; ?>"></script>
	<!--custome script for all page-->
	<script src="<?PHP echo base_url() . 'nitnav/js/scripts.js'; ?>"></script>
</html>
<?php } else { ?>
	<h2 align="center">No Receipt Found.</h2>
<?php }
?>

