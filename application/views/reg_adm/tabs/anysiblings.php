<div class="row-fluid" style="height: 200px;">
		<div class="control-group span12">
			<div class="controls span6">
            <label class="control-label">Find Sibling</label>
                <?php
                    $data = array(
                        'name' => 'cmbSiblingRegistrationID',
                        'id' => 'cmbSiblingRegistrationID',
                        'required' => 'required'
                    );
                    $options = array();
                    $options[''] = 'Select Sibling';
                ?>
                <?php echo form_dropdown($data, $options, ''); ?>
            </div>
            <div class="controls span6">
            <label class="control-label">Sibling(s)</label>
                <?php
                    $data = array(
                    	'type' => 'hidden',
                        'name' => 'txtSiblings',
                        'id' => 'txtSiblings',
                        'required' => 'required',
                    );
                ?>
                <?php echo form_input($data); ?>
                <div style="height: 100px; width:100%; float: left; border: #f0f0f0 solid 1px" id="show_siblings"></div>
            </div>
		</div>
		<div class="control-group">
					<div class="controls span12">
                	<input type="button" value="Update" class="btn btn-success submit_or_update_admission">
                	<input type="button" value="Cancel" class="btn btn-danger reset_button_template">
                	<input type="reset" value="" style="visibility: hidden" id="reset_me">
                	</div>
              	</div>
    </div>