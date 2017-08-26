<div class="row-fluid">
	    		<div class="control-group span6">
	    			<div class="controls">
	    				<label class="control-label">Father's Name</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Full Name',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtFatherName',
	                            'id' => 'txtFatherName'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Father's Mobile</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Mobile No.',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtFatherMobile',
	                            'id' => 'txtFatherMobile'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Father's Email</label>
	    				<?php
	                        $data = array(
	                            'type' => 'email',
	                            'class'=>"span11",
	                            'placeholder' => 'Email',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtFatherEmail',
	                            'id' => 'txtFatherEmail'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Father's Profession</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Profession',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtFatherProfession',
	                            'id' => 'txtFatherProfession'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
				</div>
				<div class="control-group span6">
	    			<div class="controls">
	    				<label class="control-label">Mother's Name</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Full Name',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtMotherName',
	                            'id' => 'txtMotherName'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Mother's Mobile</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Mobile No.',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtMotherMobile',
	                            'id' => 'txtMotherMobile'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Mother's Email</label>
	    				<?php
	                        $data = array(
	                            'type' => 'email',
	                            'class'=>"span11",
	                            'placeholder' => 'Email',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtMotherEmail',
	                            'id' => 'txtMotherEmail'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Father's Profession</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Profession',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtMotherProfession',
	                            'id' => 'txtMotherProfession'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
				</div>
				<div class="control-group">
					<div class="controls">
                		<input type="button" value="Update" class="btn btn-success submit_or_update_admission">
                		<input type="button" value="Cancel" class="btn btn-danger reset_button_template">
                	</div>
              	</div>
</div>