<div class="row-fluid" style="height: 200px;">
		<div class="control-group span12">
			<div class="controls span6">
            <label class="control-label">Discount offered (if any?)</label>
                <?php
                    $data = array(
                        'name' => 'cmbDiscount_if_any',
                        'id' => 'cmbDiscount_if_any',
                        'required' => 'required'
                    );
                    $options = array();
                    $options['x'] = 'No Discount';
                ?>
                <?php echo form_dropdown($data, $options, 'Select Discount'); ?>
            </div>
            <div class="controls span6">
            <label class="control-label">Discount(s) on</label>
                <?php
                    $data = array(
                        'type' => 'hidden',
                        'name' => 'txtDiscounts',
                        'id' => 'txtDiscounts',
                        'required' => 'required',
                    );
                ?>
                <?php echo form_input($data); ?>
                <div style="height: 100px; width:100%; float: left; border: #f0f0f0 solid 1px" id="show_discount"></div>
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