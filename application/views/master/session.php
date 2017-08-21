<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>New Session</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmSession',
                        'id' => 'frmSession',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                            <label class="control-label">Select Student</label>
                            <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbRegistrationID',
                                    'id' => 'cmbRegistrationID',
                                    'required' => 'required'
                                );
                                $options = array();
                                $options[''] = 'Select Student';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                            </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>

    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
                <h5>Already Present Sessions</h5>
            </div>
            <div class="widget-content nopadding">
                
            </div>            
        </div>
    </div>
</div>