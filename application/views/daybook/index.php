<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmDayBook',
            'id' => 'frmDayBook',
        );
        echo form_open('#', $attrib_); 
    ?>
    <div class="span9">
        <div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5><?php echo $title_;?></h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span4">
                		<label class="control-label">Select Sub-head</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'txtDaybook_subhead',
	                                'id' => 'txtDaybook_subhead',
	                                'required' => 'required'
	                            );
	                            $options = array();
	                        ?>
	                        <?php echo form_dropdown($data, $options, ''); ?>
	                    </div>
                </div>
                <div class="controls span2">
		            <label class="control-label">Price</label>
		            <?php
		            $data = array(
		                'type' => 'text',
		                'class' => "span12",
		                'placeholder' => 'Price',
		                'autocomplete' => 'off',
		                'required' => 'required',
		                'name' => 'txtPrice',
		                'id' => 'txtPrice'
		            );
		            echo form_input($data);
		            ?>
		        </div>
		        <div class="controls span4">
		            <label class="control-label">Quantity</label>
		            <?php
		            $data = array(
		                'type' => 'text',
		                'class' => "span6",
		                'placeholder' => 'Quantity',
		                'autocomplete' => 'off',
		                'required' => 'required',
		                'name' => 'txtQty',
		                'id' => 'txtQty'
		            );
		            echo form_input($data);
		            ?>
		        </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>