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
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Registration</h5>
            </div>
            <div class="widget-content">
                <div class="control-group">
                    <label class="control-label">Select Student</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbRegistrationID',
                                'id' => 'cmbRegistrationID',
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
                    <label class="control-label">Date of Admission <span style="font-size: 9px">(dd-mm-yyyy)</span></label>
                    <div class="controls">
                        <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span10",
                                'data-date-format'=>"dd-mm-yyyy",
                                'autocomplete' => 'off',
                                'name' => 'txtDOA',
                                'id' => 'txtDOA',
                                'value'=> date('d-m-Y')
                            );
                            echo form_input($data);
                        ?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Update" class="btn btn-success submit_or_update_admission">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span8">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="<?php echo $Personal;?>"><a data-toggle="tab" href="#Personal">Personal Detail</a></li>
                    <li class="<?php echo $Parents;?>"><a data-toggle="tab" href="#Parents">Parent's Detail</a></li>
                    <li class="<?php echo $Address;?>"><a data-toggle="tab" href="#Address">Address</a></li>
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="Personal" class="tab-pane<?php echo $Personal;?>">
                    <?php $this->load->view('reg_adm/tabs/personal'); ?>
                </div>
                <div id="Parents" class="tab-pane<?php echo $Parents;?>">
                    <?php $this->load->view('reg_adm/tabs/parents'); ?>
                </div>
                <div id="Address" class="tab-pane<?php echo $Address;?>">
                    <?php $this->load->view('reg_adm/tabs/contact'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>
<div class="row-fluid">
        <?php $this->load->view('reg_adm/view_student_data'); ?>
</div>