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
		            		<img src="<?php echo base_url('assets_/student_photo/'.$personal->PHOTO_); ?>">
		            	</div>
			            <div class="span6">
			                <table class="">
				                <tbody>
				                    <tr>
				                      <td colspan="2"><h4><?php echo $personal->FNAME; ?></h4></td>
				                    </tr>
				                    <tr>
										<td><b>Gender</b></td>
										<td><?php echo $personal->GENDER; ?></td>
									</tr>
				                    <tr>
										<td><b>DOB</b></td>
										<td><?php echo $personal->DOB_; ?></td>
									</tr>
				                    <tr>
										<td><b>Father</b></td> 
										<td><?php echo $personal->FATHER; ?></td>
									</tr>
									<tr>
										<td><b>Mother</b></td>
										<td><?php echo $personal->MOTHER; ?></td>
									</tr>
				                </tbody>
				            </table>
				        </div>
			    	</div>
		    	</div>
			</div>
		</div>
	</div>
<?php } ?>