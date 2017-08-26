<div class="row-fluid">
	    		<div class="control-group span6">
	    			<h5>Permanent</h5>
	    			
	    			<div class="controls">
	    				<label class="control-label">Address</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Address',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtPAddress',
	                            'id' => 'txtPAddress',
	                            'style'=>'height: 55px'
	                        );
	                        echo form_textarea($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">City</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'City',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtPCity',
	                            'id' => 'txtPCity'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">District</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'District',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtPDistt',
	                            'id' => 'txtPDistt'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Pin Code</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Profession',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtPPinCode',
	                            'id' => 'txtPPinCode'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">State</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'cmbPState',
	                                'id' => 'cmbPState',
	                            );
	                            $options = array();
	                            $options['-x-'] = 'Select State';
	                        ?>
	                        <?php echo form_dropdown($data, $options, ''); ?>
	                        <div style="padding: 5px"></div>
	                    </div>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Country</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Mobile No.',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtPCountry',
	                            'id' => 'txtPCountry',
	                            'value'=>'INDIA'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
				</div>
				<div class="control-group span6">
					<h5>Correspondance</h5>

	    			<div class="controls">
	    				<label class="control-label">Address</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Address',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtCAddress',
	                            'id' => 'txtCAddress',
	                            'style'=>'height: 55px'
	                        );
	                        echo form_textarea($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">City</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'City',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtCCity',
	                            'id' => 'txtCCity'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">District</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'District',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtCDistt',
	                            'id' => 'txtCDistt'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Pin Code</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Profession',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtCPinCode',
	                            'id' => 'txtCPinCode'
	                        );
	                        echo form_input($data);
	                    ?>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">State</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'cmbCState',
	                                'id' => 'cmbCState',
	                            );
	                            $options = array();
	                            $options['-x-'] = 'Select State';
	                        ?>
	                        <?php echo form_dropdown($data, $options, ''); ?>
	                        <div style="padding: 5px"></div>
	                    </div>
	    			</div>
	    			<div class="controls">
	    				<label class="control-label">Country</label>
	    				<?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span11",
	                            'placeholder' => 'Mobile No.',
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtCCountry',
	                            'id' => 'txtCCountry',
	                            'value'=>'INDIA'
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