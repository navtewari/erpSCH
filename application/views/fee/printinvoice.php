<?php
	if($status == true){
	if(count($invoice)!=0){
		$fee_ = new My_library();
		$inwords = new Numbertowords();
		foreach($invoice  as $item) {
			$class = $item->CLASSID;
			break;
		}
?>

<html>
	<head>
		<title> Invoice(s) for Class <?php echo $class; ?> </title>
		<!-- Bootstrap CSS -->    
        <link href="<?PHP echo base_url() . 'nitnav/css/bootstrap.min.css'; ?>" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="<?PHP echo base_url() . 'nitnav/css/bootstrap-theme.css'; ?>" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="<?PHP echo base_url() . 'nitnav/css/elegant-icons-style.css'; ?>" rel="stylesheet" />
        <link href="<?PHP echo base_url() . 'nitnav/css/font-awesome.min.css'; ?>" rel="stylesheet" />    
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
        		font-weight: normal;
        		text-decoration: underline;
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
        	.single_record{
				page-break-after: always;
			}
			.sno_{
				border: #ff0000 solid 0px;
				width: 70px;
				text-align: center;
				vertical-align: top;
			}
			.particular_{
				border: #009000 solid 0px;
				width: 100px;
				text-align: left
			}
			.particular_amt{
				border: #009000 solid 0px;
				width: 375px;
				text-align: right;
			}
			.amount_{
				border: #0000ff solid 0px;
				width: 150px;
				text-align: right;
			}
			.bgcolor_{
				border-bottom: #808080 solid 1px;
				background: #f0f0f0;
				padding: 5px;
			}
			.times_{
				padding: 0px 0px 0px 10px; 
				font-size: 8px
			}
			.content_{
				float: left; 
				text-align: left; 
				padding: 0px 0px 0px 0px; 
				border-bottom: #c0c0c0 solid 0px; 
				width: 47%;
			}
			.content_r{
				float: right; 
				text-align: right; 
				padding: 0px 0px 0px 0px; 
				border-bottom: #c0c0c0 solid 0px; 
				width: 47%;
			}
			sup{
				color: #000000;
				font-size: 8px;
			}
        </style>
	</head>
	<body>
		<center>
		<div class="row">
		<div class="col-sm-12 hide_button" style="margin-top: 10px">
            <button class="btn btn-danger print_button" onclick="window.print();">Print</button>
        </div>
        <div style="clear: both; height: 5px"></div>
		<?php foreach($invoice  as $item) {
				$name_ = (($item->FNAME == "-x-") ? "" : $item->FNAME);
		    	$name_ = $name_ . (($item->MNAME == "-x-") ? "" : " ".$item->MNAME);
		    	$name_ = $name_ . (($item->LNAME == "-x-") ? "" : $item->LNAME);
    	?>
    		<p class="single_record">
			<table border="0" class="myfont table_" cellpadding="10">
				<tr>
					<td>
						<table border="0" class="myfont table_" style='border:#009900 solid 0px'>
							<tr>
			
								<td align="left">
									<img src='<?php echo base_url('assets_/logo/'.$this->session->userdata('logo')); ?>' width="100" / >
								</td>
								<td style="text-align: center">
									<h1>INVOICE</h1>
									<b style="font-size: 12px">
										(<?PHP 
											if($item->YEAR_FROM == $item->YEAR_TO && $item->MONTH_FROM == $item->MONTH_TO){
												echo  $fee_->getMonthsName($item->MONTH_FROM). ", " . $item->YEAR_FROM;
											} else {
												echo $fee_->getMonthsName($item->MONTH_FROM) . ", " . $item->YEAR_FROM . " - to - " . $fee_->getMonthsName($item->MONTH_TO) . ", " . $item->YEAR_TO;
											}
										?>)
									</b>
									<h4><b style="font-size: 12px"><?php echo $this->session->userdata('sch_name'); ?></b></h4>
								</td>
								<td align="right">
									<img src='<?php echo base_url('assets_/logo/'.$this->session->userdata('logo')); ?>' width="100" / >
								</td>
							</tr>
							<tr>
								<td class="myline_" colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3">
									<table border="0" class="myfont table_" style='border:#009900 solid 0px; font-size: 12px; font-weight: bold'>
										<tr>
											<td>Invoice #<?php echo $item->INVID; ?></td>
											<td></td>
											<td align="right">Date: <?php echo date('d/m/Y');?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="myline_" colspan="3"></td>
							</tr>
							<tr>
								<td style="height: 5px" colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3" valign="top">
									<table border="0" class="myfont table_" style='border:#009900 solid 0px; font-size: 12px; font-family: "Times New Roman"'>
										<tr>
											<td valign="top">
												<div style="float:left; font-size: 15px; padding: 0px 0px 10px 0px">To,</div>
												<div style="clear: both"></div>
												<div style="display: block; float: left">
												<?php echo $name_; ?>,<br />
												<?php echo "Reg. No. - " . $item->REGID; ?>,<br />
												<?php echo "CLASS (" . $item->CLASSID . ")"; ?>,<br />
												</div>
											</td>
											<?php 
												$i_ = explode(" ",$item->DATE_);
												$x_ = explode("-",$i_[0]);
												$dt_ = $x_[2] . "/" . $x_[1] . "/" . $x_[0];
												
											?>
											<td valign="top" align="right">
											<b>
											Invoice Date: <?php echo $dt_; ?>
											</b>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="height: 5px" colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3">
									<table border="0" class="myfont table_" width="700" height="25" style='border:#009900 solid 0px; font-size: 13px;'>
										<tr>
											<th class="myline_" colspan="3"></th>
										</tr>
										<tr style="font-weight: bold">
											<th class="sno_ bgcolor_">SNO</th>
											<th class="particular_ bgcolor_" style="width: 475px; padding: 0px 3px">Particulars</th>
											<th class="amount_ bgcolor_" align="right" style="padding: 0px 3px">Amount (Rs.)</th>
										</tr>
										<?php 
											$static_heads_1_time = explode(",", $item->STATIC_HEADS_1_TIME);
											$static_split_amt_1_time = explode(",", $item->STATIC_SPLIT_AMT_1_TIME);
											$static_heads_n_times = explode(",", $item->STATIC_HEADS_N_TIMES);
											$static_split_amt_n_time = explode(",", $item->STATIC_SPLIT_AMT_N_TIME);
											
											$flexible_heads_1_time = explode(",", $item->FLEXIBLE_HEADS_1_TIME);
											$flexi_split_amt_1_time = explode(",", $item->FLEXI_SPLIT_AMT_1_TIME);
											$flexible_heads_n_times = explode(",", $item->FLEXIBLE_HEADS_N_TIMES);
											$flexi_split_amt_n_times = explode(",", $item->FLEXI_SPLIT_AMT_N_TIMES);

										?>
											<?php /* $height is taken to maintain the height of invoice in print */ ?>
											<?php $s_heads1 = ''; $s_headsN = ''; $s_amnt1 = ''; $s_amntN = ''; $height = 100; ?>
											<?php $sno = 0; $index_ = 0; $s_total_amount=0; $total_amount=0;?>

											<?php if($item->STATIC_HEADS_1_TIME!=''){?>
												<?PHP foreach($static_heads_1_time as $val){ ?>
													<?php $s_heads1 = $s_heads1 . $val . "<span class='times_'>(1 time)</span><br>";?>
													<?php $s_amnt1 = $s_amnt1 . number_format((int)$static_split_amt_1_time[$index_], 2, '.', ''). "<br>";?>
													<?php $s_total_amount = $s_total_amount + (int)$static_split_amt_1_time[$index_]; ?>
													<?php $index_++; ?>
												<?php } ?>
											<?php } ?>
											
											<?php if($item->STATIC_HEADS_N_TIMES!=''){?>
												<?php $index_ = 0;?>
												<?PHP foreach($static_heads_n_times as $val){ ?>
													<?php $s_headsN = $s_headsN . $val . "<span class='times_'>(". $static_split_amt_n_time[$index_] . " x ". $item->NOM.")</span><br>";?>
													<?php $s_amntN = $s_amntN . number_format((int)$static_split_amt_n_time[$index_]*(int)$item->NOM, 2, '.', ''). "<br>";?>
													<?php $s_total_amount = $s_total_amount + ((int)$static_split_amt_n_time[$index_]*(int)$item->NOM); ?>
													<?php $index_++; ?>
												<?php } ?>
											<?php } ?>

											<?php $total_amount = $total_amount + (int)$s_total_amount; ?>

											<?php if($item->STATIC_HEADS_1_TIME!='' || $item->STATIC_HEADS_N_TIMES!=''){?>
												<tr>
													<td class="sno_"><?php echo ++$sno;?></td>
													<td style="width:60px; text-align: right;">
														<div class="content_"><?php echo "<span class='label_'>Compulsory Heads</span><br />".$s_heads1.$s_headsN; ?></div>
														<div class="content_r"><?php echo "<br>".$s_amnt1.$s_amntN; ?></div>
													</td>
													<td style="text-align: right; vertical-align: bottom;"><?php echo number_format($s_total_amount, 2, '.', ''); ?></td>
												</tr>	
											<?php } else { ?>
												<?php $height+=20; ?>
												<tr style="height: 50px;">
													<td colspan="3"></td>
												</tr>
											<?php } ?>
										<tr>
											<td colspan="3" style="padding:10px 0px"></td>
										</tr>
											<?php $f_heads1 = ''; $f_headsN = ''; $f_amnt1 = ''; $f_amntN = ''; ?>
											<?php $index_ = 0; $f_total_amount=0;?>
											<?php if($item->FLEXIBLE_HEADS_1_TIME!=''){?>
											<?PHP foreach($flexible_heads_1_time as $val){ ?>
												<?php $f_heads1 = $f_heads1 . $val . "<span class='times_'>(1 time)</span><br>";?>
												<?php $f_amnt1 = $f_amnt1 . number_format((int)$flexi_split_amt_1_time[$index_], 2, '.', ''). "<br>";?>
												<?php $f_total_amount = $f_total_amount + (int)$flexi_split_amt_1_time[$index_]; ?>
												<?php $index_++; ?>
											<?php } ?>
											<?php } ?>
											
											<?php if($item->FLEXIBLE_HEADS_N_TIMES!=''){?>
											<?php $index_ = 0;?>
											<?PHP foreach($flexible_heads_n_times as $val){ ?>
												<?php $f_headsN = $f_headsN . $val . "<span class='times_'>(". $flexi_split_amt_n_times[$index_] . " x ". $item->NOM.")</span><br>";?>
												<?php $f_amntN = $f_amntN . number_format((int)$flexi_split_amt_n_times[$index_]*(int)$item->NOM, 2, '.', ''). "<br>";?>
												<?php $f_total_amount = $f_total_amount + ((int)$flexi_split_amt_n_times[$index_]*(int)$item->NOM); ?>
												<?php $index_++; ?>
											<?php } ?>
											<?php } ?>

											<?php $total_amount = $total_amount + (int)$f_total_amount; ?>

											<?php if($item->FLEXIBLE_HEADS_1_TIME!='' || $item->FLEXIBLE_HEADS_N_TIMES!=''){?>
											<tr>
												<td class="sno_"><?php echo ++$sno;?></td>
												<td style="width:60px; text-align: right;">
													<div class="content_"><?php echo "<span class='label_'>Optional Heads</span><sup>*</sup><br />".$f_heads1.$f_headsN; ?></div>
													<div class="content_r"><?php echo "<br>".$f_amnt1.$f_amntN; ?></div>
												</td>
												<td style="text-align: right; vertical-align: bottom;"><?php echo number_format($f_total_amount, 2, '.', ''); ?></td>
											</tr>
											<?php } else { ?>
												<?php $height+=20; ?>
												<tr style="height: 50px;">
													<td colspan="3">&nbsp;</td>
												</tr>
											<?php } ?>
										<?php if($item->PREV_DUE_AMOUNT != 0){ ?>
										<tr>
											<td style="height: <?php echo $height;?>px; text-align: right; vertical-align: bottom" colspan="2">
													Previous Dues
											</td>
											<td style="text-align: right; vertical-align: bottom;"><?php echo number_format($item->PREV_DUE_AMOUNT, 2, '.', ''); ?></td>
										</tr>
										<?PHP $total_amount = $total_amount + (int)$item->PREV_DUE_AMOUNT; ?>
										<?php } else { ?>
										<tr>
											<td colspan="3" style="height: <?php echo $height;?>px"></td>
										</tr>
										<?PHP } ?>
										<tr>
											<td class="myline_" colspan="3"></td>
										</tr>
										<tr>
											<td colspan="3">
												<div style="float: left; width: 545px; text-align: right; font-weight: bold">Total</div>
												<div style="float: right; width: 140px; text-align: right;font-weight: bold"><?php echo number_format($total_amount, 2, '.', '');?></div>
											</td>
										</tr>
										<tr>
											<td colspan="3" style="height: 10px; text-align: right; vertical-align: top; font-size: 9px">(<?php echo $inwords->convert_number($total_amount); ?>)</td>
										</tr>
										<tr>
											<td class="myline_" colspan="3"></td>
										</tr>
										<tr>
											<td colspan="3" style="height: 10px;"></td>
										</tr>
										<tr>
											<td colspan="3">
												<table border="0" cellpadding="5" class="table_" style='border:#009900 solid 0px'>
													<tr>
														<td colspan="2" class="address_contact" width="50%">
															<b>Address</b><br /> 
															<?php echo $this->session->userdata('sch_name').", ".$this->session->userdata('sch_city').", ".$this->session->userdata('sch_state')." (".$this->session->userdata('sch_country').")"; ?>
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
											<td colspan="3" class="optionalNote">
												*Optional fee is not compulsory for student. Those student enrolled for additional facilities are required to submit the same.
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 10px">
						<b>Note</b>: This Invoice is generated for <?php echo $item->NOM; ?> Month<?php if($item->NOM > 1){ echo "s"; } ?>.
					</td>
				</tr>
			</table>
			</p>
			<div class="col-sm-2"></div>
			<div style="clear: both; height: 45px"></div>
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
	<h2 align="center">No Receipt Found</h2>
<?php } ?>
<?php } else {?>
	<h3 align="center">Wrong Information</h3>
<?php } ?>