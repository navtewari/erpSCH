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
                    <label class="control-label">Session Start</label>
                    <div class="controls">                        
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => 'datepicker span11',
                            'data-date-format' => 'mm-dd-yyyy',
                            'name' => 'startYear',
                            'id' => 'startYear',
                            'value' => date('d-m-Y'),
                            'required' => 'required'
                        );
                        echo form_input($data);
                        ?>                                                   
                    </div>
                    <label class="control-label">Session End</label>
                    <div class="controls">                        
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => 'datepicker span11',
                            'data-date-format' => 'mm-dd-yyyy',
                            'name' => 'endYear',
                            'id' => 'endYear',
                            'value' => date('d-m-Y'),
                            'required' => 'required'
                        );
                        echo form_input($data);
                        ?>                                                   
                    </div>
                    <div class="form-actions" align="right">
                        <button type="submit" class="btn btn-success">Create New Session</button>
                        <button type="submit" class="btn btn-primary">Reset</button>                             
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>

    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Registration</h5>
            </div>
            <div class="widget-content">
                <?php
                    $attrib_ = array(
                        'class' => 'form-vertical',
                        'name' => 'frmFindStudent',
                        'id' => 'frmFindStudent',
                    );
                    echo form_open('#', $attrib_); 
                ?>
                <div class="control-group">
                    <label class="control-label">Select Student</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbRegistration',
                                'id' => 'cmbRegistration',
                                'required' => 'required'
                            );
                            $options = array();
                            $options['new'] = 'New | New Student';
                        ?>
                        <?php echo form_dropdown($data, $options, ''); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Class of Admission</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbClassofAdmission',
                                    'id' => 'cmbClassofAdmission',
                                    'required' => 'required'
                                );
                                $options = array();
                                $options[''] = 'Select Class';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>