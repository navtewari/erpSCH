<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmAdmission',
            'id' => 'frmAdmission',
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
                            $options['new'] = 'Select Student';
                        ?>
                        <?php echo form_dropdown($data, $options, ''); ?>
                    </div>
                </div>
                <div class="control-group">
                	<label class="control-label">Class</span></label>
                    <div class="controls" id="show_class_for_dop">
                        Class here...
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Date of Admission <span style="font-size: 9px">(dd-mm-yyyy)</span></label>
                    <div class="controls" id="show_class_for_dop">
                        Class here...
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Drop Student" class="btn btn-danger drop_admission">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span8">

    </div>
    <?php echo form_close();?>
</div>
<div class="row-fluid">
        <?php //$this->load->view('reg_adm/view_student_data'); ?>
</div>