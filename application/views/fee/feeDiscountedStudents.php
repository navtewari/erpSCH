<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmDiscountedStudents',
            'id' => 'frmDiscountedStudents',
        );
        echo form_open('#', $attrib_); 
    ?>
    <div class="span4">
        <div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5><?php echo $title_;?></h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group">
                    <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbClassesForDiscountedStudents',
                                    'id' => 'cmbClassesForDiscountedStudents',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                $options['x'] = 'Select Class';
                                foreach ($class_in_session as $item) {
                                	$options[$item->CLSSESSID] = $item->CLASSID;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group">
                    <label class="control-label">Select Discounts</label>
                        <div class="controls" style="overflow-y: scroll; max-height: 250px;">
                            <?php
                                $data = array(
                                    'name' => 'cmbDiscounts',
                                    'id' => 'cmbDiscounts',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                $options['x'] = 'Select Class';
                                foreach ($discounts as $item) { ?>
                                	<input type="checkbox" value="<?php echo $item->CATEGORY."~".$item->ITEM_; ?>" name="chkDiscounts[]" id="chkDiscounts_<?php echo $item->ITEM_;?>"> <?php echo $item->ITEM_; ?> <br>
                                <?php }
                            ?>
                            <?php //echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
            </div>
            <div class="widget-content" style="overflow: hidden">
            <div class="control-group">
		        <div class="controls">
		            <input type="submit" value="Show" class="btn btn-success" name="cmbShowDiscountedStudents" id="cmbShowDiscountedStudents">
		        </div>
	        </div>
	    </div>
        </div>
    </div>
    <div class="controls span6">
        <div class="control-group">
            <div class="widget-box">
                <div class="widget-title student_class_info">
                    <div>
                        
                    </div>
                    <h5 id="caption_for_class_for_discounted_students"></h5>
                    <div style="clear: both"></div>
                </div>
                <div class="widget-content nopadding" style="overflow: hidden">
                    <table class="table table-bordered table-striped with-check">
                        <thead>
                            <tr>
                                <th style="text-align: left; min-width: 10%">Reg. No.</th>
                                <th style="text-align: left; min-width: 80%">Student Name</th>
                                <th style="text-align: left; min-width: 80%">Discount applied</th>
                            </tr>
                        </thead>
                        <tbody id="discounted_students_here">

                        </tbody>
                    </table>
                    <input type="hidden" value="new" name="status_of_editting" id="status_of_editting">
                </div>
            </div>
        </div>
        <div class="control-group">
        <div class="controls">
            <input type="submit" value="Print Students" class="btn btn-success" name="cmbPrintDiscountedStudents" id="cmbPrintDiscountedStudents">
        </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>