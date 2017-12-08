<?php
	if($invoice['status'] == true){
		unset($invoice->res_);
	if(count($invoice['invoice'])!=0){
		$fee_ = new My_library();
		$inwords = new Numbertowords();
		foreach($invoice['invoice']  as $item) {
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
        	.single_record{
				page-break-after: always;
			}
			.sno_{
				border: #ff0000 solid 0px;
				width: 70px;
				text-align: center;
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
        </style>
	</head>
	<body>
		<center>
		<div class="row">
		<div class="col-sm-12 hide_button" style="margin-top: 10px">
            <button class="btn btn-danger print_button" onclick="window.print();">Print</button>
        </div>
        <div style="clear: both; height: 45px"></div>
		<?php foreach($invoice['invoice']  as $item) {
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
									<img src='<?php echo base_url("/nitnav/img/"._logo_1); ?>' width="100" / >
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
									<h4><b style="font-size: 12px"><?php echo _SCHOOL_; ?></b></h4>
								</td>
								<td align="right">
									<img src='<?php echo base_url("/nitnav/img/"._logo_1); ?>' width="100" / >
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
								<td style="height: 25px" colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3">
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
								<td style="height: 10px" colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3">
									<table border="0" class="myfont table_" width="700" height="25" style='border:#009900 solid 0px; font-size: 13px; font-weight: bold'>
										<tr>
											<td class="sno_ bgcolor_"align="center">SNO</td>
											<td class="particular_ bgcolor_" style="width: 475px">Particulars</td>
											<td class="amount_ bgcolor_" align="right">Amount (Rs.)</td>
										</tr>
										<?php 
											$static = explode("~", $item->STATIC_HEADS);
											$static_amount = explode(",", $item->STATIC_SPLIT_AMT);
											$flexible = explode("~", $item->FLEXIBLE_HEADS);
											$flexible_amount = explode(",", $item->FLEXI_SPLIT_AMT)

										?>
										<tr>
											<td valign="top" align="center" colspan="3" style="font-weight: 100; height: 250px">
												<?php $sno = 0; $index_ = 0;?>

												<?PHP foreach($static as $val){ ?>
													<div class="sno_" style="float: left;"><?php echo $sno+1;?></div>
													<div class="particular_" style="float: left;"><?php echo $val;?></div>
													<div class="particular_amt" style="float: left; border: #009000 solid 0px">
														<?php echo number_format(($static_amount[$index_]), 2, '.', '')." x ".$item->NOM;?>
													</div>
													<div class="amount_" style="float: left;"><?php echo number_format($static_amount[$index_]*$item->NOM, 2, '.', '');?></div>
													<div style="float: left; clear: both; width: 100%; height: 5px"></div>
													<?php $sno++; $index_++;?>
												<?php } ?>
												<?php $index_=0;?>
												<?php if(trim($item->FLEXIBLE_HEADS) != ''){  ?>
												<div style="float: left; clear: both; width: 100%; height: 5px"></div>
												<?PHP foreach($flexible as $val){ ?>
													<div class="sno_" style="float: left; border: #009000 solid 0px"><?php echo $sno+1;?></div>
													<div class="particular_" style="float: left; border: #009000 solid 0px">
														<?php echo $val;?>
													</div>
													<div class="particular_amt" style="float: left; border: #009000 solid 0px">
														<?php echo number_format(($flexible_amount[$index_]), 0, '.', '')." x ".$item->NOM;?>
													</div>
													<div class="amount_" style="float: left; border: #009000 solid 0px"><?php echo number_format(($flexible_amount[$index_]* $item->NOM), 2, '.', '');?></div>
													<div style="float: left; clear: both; width: 100%; height: 5px"></div>
													<?php $sno++; $index_++;?>
												<?php } ?>
												<?php } ?>
												<?php
													if(trim($item->ACTUAL_DUE_AMOUNT) != '' || trim($item->ACTUAL_DUE_AMOUNT) > 0){
														$due_ = $item->ACTUAL_DUE_AMOUNT - $item->ACTUAL_AMOUNT;
													} else { ?>
													<?php } ?>
													<?php if($due_ > 0) {?>
													<div style="float: left; clear: both; width: 100%; height: 25px"></div>
													<div style="float: right; width: 140px; text-align: right"><?php echo number_format($due_, 2, '.', '');?></div>
													<div style="float: right; width: 545px; text-align: right; font-style: italic;">Previous Dues</div>
													<?php }?>
											</td>
										</tr>
										<tr>
											<td class="myline_" colspan="3"></td>
										</tr>
										<tr>
											<td colspan="3">
												<div style="float: left; width: 545px; text-align: right; font-weight: bold">Total</div>
												<div style="float: right; width: 140px; text-align: right"><?php echo number_format($item->ACTUAL_DUE_AMOUNT, 2, '.', '');?></div>
											</td>
										</tr>
										<tr>
											<td class="myline_" colspan="3"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 10px">
						*This Invoice is generated for <?php echo $item->NOM; ?> Month<?php if($item->NOM > 1){ echo "s"; } ?>.
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