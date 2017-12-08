<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>School Information</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmSchool',
                        'id' => 'frmSchool',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">School Name</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'class' => 'span11',
                                'placeholder' => 'School Name',
                                'name' => 'txtSchName',
                                'id' => 'txtSchName',
                                'value' => ''
                            );
                            echo form_input($data);
                            ?>                                                   
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Address</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'class' => 'span11',
                                'placeholder' => 'Address',
                                'name' => 'txtSchAdd',
                                'id' => 'txtSchAdd',
                                'value' => ''
                            );
                            echo form_input($data);
                            ?>                                                   
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">City</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => "span11",
                                'placeholder' => 'City',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtPCity',
                                'id' => 'txtPCity'
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">District</label>
                        <div class="controls">    
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => "span11",
                                'placeholder' => 'District',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtPDistt',
                                'id' => 'txtPDistt'
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">State</label>
                        <div class="controls">    
                            <?php
                            $data = array(
                                'name' => 'cmbPState',
                                'id' => 'cmbPState',
                            );
                            $options = array();
                            $options['-x-'] = 'Select State';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Country</label>
                        <div class="controls">    
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => "span11",
                                'placeholder' => 'Country',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtCountry',
                                'id' => 'txtCountry',
                                'value' => 'INDIA'
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Submit School Data" class="btn btn-success schoolSubmit">
                        <button type="reset" class="btn btn-primary">Reset</button>                             
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>    
</div>