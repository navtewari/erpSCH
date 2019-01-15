<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmTCCC',
            'id' => 'frmTCCC',
            'target'=>'_blank'
        );
        echo form_open('tc/issue_tc', $attrib_); 
    ?>
    <div class="span4">
        <div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5><?php echo $title_;?></h5>
            </div>
            <div class="widget-content">
                <div class="control-group">
                    <label class="control-label">Select Student</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbRegistrationID_for_tccc',
                                'id' => 'cmbRegistrationID_for_tccc',
                                'required' => 'required'
                            );
                            $options = array();
                            $options['x'] = 'Select Student';
                        ?>
                        <?php echo form_dropdown($data, $options, ''); ?>
                    </div>
                </div>
                <div class="control-group">&nbsp;&nbsp;</div>
                <div class="control-group">
                	<div class="controls">
                		<input type="button" class="btn btn-default" name="cmdTC" value="-" id="cmdTC" disabled="disabled">
                		<input type="button" class="btn btn-default" name="cmdTC" value="-" id="cmdCC" disabled="disabled">
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>