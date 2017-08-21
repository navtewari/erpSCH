<div class="row-fluid">
	    		<div class="control-group span12">
	    			<div class="controls span4">
	    				<label class="control-label">Full Name</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Full Name',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtFullName',
	                            'id' => 'txtFullName'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls span4">
	    				<label class="control-label">Date of Birth <span style="font-size: 9px">(dd-mm-YYYY)</span></label>
						<div class="controls">
							<div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
							<?php
		                        $data = array(
		                            'type' => 'text',
		                            'class'=>"span11",
		                            'data-date-format'=>"dd-mm-yyyy",
		                            'autocomplete' => 'off',
		                            'name' => 'txtStudDOB',
		                            'id' => 'txtStudDOB',
		                            'value'=> date('d-m-Y')
		                        );
		                        echo form_input($data);
		                    ?>
							<span class="add-on"><i class="icon-th"></i></span> 
							</div>
	    				</div>
	    			</div>
	    			<div class="controls span4">
	    				<label class="control-label">Gender</label>
						<div class="controls">
							<label style="background:#f0f0f0; padding: 5px 5px; border: #E0E0E0 solid 1px">
			                  <input type="radio" name="optStuGender" id="optStuMale" value="M" />
			                  Male
			                  &nbsp;&nbsp;&nbsp;&nbsp;|
			                  <input type="radio" name="optStuGender" id="optStuFemale" value="F" />
			                  Female</label>
	    				</div>
	    			</div>
				</div>
				<div class="control-group">
					<div class="controls span4">
						<label class="control-label">Contact <span style="font-size: 11px; color: #0000ff">(999) 999-9999</span></label>
						<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span12 mask text",
	                            'autocomplete' => 'off',
	                            'name' => 'txtStudentPhone',
	                            'id' => 'txtStudentPhone'
	                        );
	                        echo form_input($data);
	                    ?>
					</div>
					<div class="controls span4">
	    				<label class="control-label">Your Email</label>
						<?php
	                        $data = array(
	                            'type' => 'email',
	                            'class'=>"span12 mask text",
	                            'autocomplete' => 'off',
	                            'name' => 'txtEmail',
	                            'id' => 'txtEmail'
	                        );
	                        echo form_input($data);
	                    ?>
					</div>
					<div class="controls span4">
						<label class="control-label">Upload Photo</label>
	    				<?php
	                        $data = array(
	                            'type' => 'file',
	                            'class'=>"span4",
	                            'placeholder' => 'First Name',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtPhotoUpload',
	                            'id' => 'txtPhotoUpload'
	                        );
	                        echo form_input($data);
	                    ?>
					</div>
				</div>
				<div class="control-group">
					<div class="controls span12">
                	<input type="button" value="Update" class="btn btn-success" onclick="submit_or_update_admission();">
                	</div>
              	</div>
</div>