<?php if($bool_ == 0){ ?>
	<div class="row-fluid"><hr>
	    <div class="span12">
	        <div class="widget-box">
	        	No data found.
	        </div>
	    </div>
	</div>
<?php } else { ?>
	<div class="row-fluid">
	    <div class="span12">
	        <div class="widget-box">
	        	<div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
	        	<h5>Personal Detail</h5>
	        	</div>
		        <div class="widget-content">
		            <div class="row-fluid">
		            	<div class="span2">
		            		<img src="<?php echo base_url('assets_/'.$this->session->userdata('db2').'/student_photo/'.$personal->PHOTO_); ?>">
		            	</div>
			            <div class="span5">
			                <table class="table">
				                <tbody>
				                    <tr>
				                      <td colspan="2"><h4><?php echo ucwords(strtolower($personal->FNAME)); ?></h4></td>
				                    </tr>
				                    <tr style="font-size: 14px; font-weight: bold">
										<td>Reg. No.</td>
										<td><?php echo $personal->regid; ?></td>
									</tr>
				                    <tr>
										<td><b>Gender</b></td>
										<td>
											<?php if($personal->GENDER == 'M'){?>
												<img src="<?php echo base_url('assets_/img/male.png');?>" style="width: 16px" title="Male">
											<?php } else { ?>
												<img src="<?php echo base_url('assets_/img/female.png');?>" style="width: 16px" title="Female">
											<?php }?>
										</td>
									</tr>
				                    <tr>
										<td><b>DOB</b></td>
										<td><?php echo $personal->DOB_; ?></td>
									</tr>
									<tr>
										<td><b>Adhaar Card No</b></td>
										<td><?php echo $personal->ADHAARCARD_STUDENT; ?></td>
									</tr>
				                    <tr>
										<td><b>Father</b></td> 
										<td>
											<?php echo $personal->FATHER; ?><br>
											Mobile: <?php echo $personal->F_MOBILE; ?>
										</td>
									</tr>
									<tr>
										<td><b>Mother</b></td>
										<td>
											<?php echo $personal->MOTHER; ?><br>
											Mobile: <?php echo $personal->M_MOBILE; ?>
										</td>
									</tr>
				                </tbody>
				            </table>
				        </div>
				        <div class="span5">
				        	<table class="table">
				        			<tr>
				                      <td colspan="2"><h4>Address(s)</h4></td>
				                    </tr>
				        			<tr style="text-decoration: underline;">
				                      <td>Permanent Address</td>
				                      <td>Correspondance Address</td>
				                    </tr>
					        		<tr>
					        			<td>
					        				<?php echo $p_address->STREET_1; ?>,<br>
					        				<?php echo $p_address->CITY_."-".$p_address->PIN_; ?>,<br>
					        				Distt.-<?php echo $p_address->DISTT_; ?>,<br>
					        				State-<?php echo $p_address->STATE_; ?>,<br>
					        				(<?php echo $p_address->COUNTRY_; ?>)
					        			</td>
					        			<td>
					        				<?php echo $c_address->STREET_1; ?>,<br>
					        				<?php echo $c_address->CITY_."-".$c_address->PIN_; ?>,<br>
					        				Distt. -<?php echo $c_address->DISTT_; ?>,<br>
					        				State -<?php echo $c_address->STATE_; ?>,<br>
					        				(<?php echo $c_address->COUNTRY_; ?>)
					        			</td>
					        		</tr>
					        		<tr>
										<td><b>Contact No(s)</b></td>
										<td style="font-size: 11px">
											Mobile:	<?php echo $c_contact->MOBILE_S; ?><br>
											Email: <?php echo $c_contact->EMAIL_S; ?><br>
											Phone: <?php echo $c_contact->PH_S; ?>
										</td>
									</tr>
				        	</table>
				        </div>
			    	</div>
		    	</div>
			</div>
		</div>
	</div>
<?php } ?>
