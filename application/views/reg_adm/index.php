<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Registration</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmFindStudent',
                        'id' => 'frmFindStudent',
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
</div>
<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#Personal">Personal Detail</a></li>
                    <li><a data-toggle="tab" href="#Academics">Academics Detail</a></li>
                    <li><a data-toggle="tab" href="#Address">Address</a></li>
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="Personal" class="tab-pane active">
                    <?php $this->load->view('reg_adm/tabs/personal'); ?>
                </div>
                <div id="Academics" class="tab-pane">
                    <?php $this->load->view('reg_adm/tabs/academics'); ?>
                </div>
                <div id="Address" class="tab-pane">
                    <?php $this->load->view('reg_adm/tabs/contact'); ?>
                </div>
            </div>
        </div>
    </div>
</div>