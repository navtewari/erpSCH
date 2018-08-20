<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmStudentToDrop',
            'id' => 'frmStudentToDrop',
        );
        echo form_open('#', $attrib_); 
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
                                'name' => 'cmbRegistrationID_to_Drop',
                                'id' => 'cmbRegistrationID_to_Drop',
                                'required' => 'required'
                            );
                            $options = array();
                            $options['select'] = 'Select Student';
                        ?>
                        <?php echo form_dropdown($data, $options, ''); ?>
                    </div>
                </div>
                <div class="control-group">
                	<label class="control-label">Admitted Class</label>
                    <div class="controls" id="show_class_for_drop" style="color: #ff0000; font-weight: bold">
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Date of Admission <span style="font-size: 9px">(dd/mm/yyyy)</span></label>
                    <div class="controls" id="show_DOA" style="color: #0000ff; font-weight: bold">
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Reason to drop this student <sup style="color: #ff0000">*</sup></label>
                    <div class="controls" id="show_DOA" style="color: #0000ff; font-weight: bold">
                        <?php 
                        $data = array(
                            'name' => 'txtReasonToDrop',
                            'id' => 'txtReasonToDrop',
                            'required' => 'required',
                            'class' => 'span11',
                            'style' => 'height: 100px'
                        );
                        echo form_textarea($data);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Drop Student" class="btn btn-danger drop_admission" id="drop_button" disabled="disabled">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Student detail here...</h5>
            </div>
            <div class="widget-content" id="student_to_drop_detail">

            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Address</h5>
            </div>
            <div class="widget-content" id="student_to_drop_address">

            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>