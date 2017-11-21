<div class="row-fluid" style="height: 200px;">
		<div class="control-group span12">
			<div class="controls span6">
            <label class="control-label">Choose Category</label>
                <?php
                    $data = array(
                        'name' => 'cmbCategory',
                        'id' => 'cmbCategory',
                        'required' => 'required'
                    );
                    $options = array();
                    $options['GENERAL'] = 'Select Sibling';
                    foreach($category_ as $itemcateg){
                        $options[$itemcateg->ITEM_] = $itemcateg->ITEM_;
                    }
                ?>
                <?php echo form_dropdown($data, $options, ''); ?>
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