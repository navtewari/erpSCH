<div class="row-fluid">
    <?php if (!empty($status_)) { ?>
        <div class="span6 editSchoolData">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>SCHOOL INFORMATION</h5>
                </div>
                <?php
                $attrib_ = array(
                    'class' => 'form-horizontal',
                    'name' => 'frmGenSchoolEdit',
                    'id' => 'frmGenSchoolEdit',
                );
                ?>
                <?php echo form_open('#', $attrib_); ?>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">   
                        <?php foreach ($status_ as $sch) { ?>
                            <tbody>
                                <tr>
                                    <td>School Logo</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editPhoto"></i></td>  
                                    <td>
                                        <img src="<?php echo base_url('assets_/logo/' . $sch->SCH_LOGO); ?>">
                                        <div class="txtSchLogoEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'hidden',
                                                'class' => "span4",
                                                'placeholder' => 'School ID',                                                
                                                'name' => 'txtSchID',
                                                'id' => 'txtSchID',
                                                'value' => $sch->SCH_ID
                                            );
                                            echo form_input($data);
                                            ?>
                                            <?php
                                            $data = array(
                                                'type' => 'file',
                                                'class' => "span4",
                                                'placeholder' => 'School Logo',
                                                'autocomplete' => 'off',
                                                'name' => 'txtLogoUpload',
                                                'id' => 'txtLogoUpload'
                                            );
                                            echo form_input($data);
                                            ?>
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>School Name</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editName"></i></td>                                        
                                    <td>
                                        <?php echo $sch->SCH_NAME; ?> <br>                                       
                                        <div class="txtSchNameEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',                                               
                                                'placeholder' => 'School Name',
                                                'name' => 'txtSchName',
                                                'id' => 'txtSchName',
                                                'value' => $sch->SCH_NAME
                                            );
                                            echo form_input($data);
                                            ?>
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editContact"></i></td>
                                    <td><?php echo $sch->SCH_CONTACT; ?>                                     
                                        <div class="txtSchContactEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',                                               
                                                'placeholder' => 'School Name',
                                                'name' => 'txtSchContact',
                                                'id' => 'txtSchContact',
                                                'value' => $sch->SCH_CONTACT
                                            );
                                            echo form_input($data);
                                            ?>                      
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>                            
                                <tr>
                                    <td>Email-ID</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editEmail"></i></td>
                                    <td>
                                        <?php echo $sch->SCH_EMAIL; ?>
                                        <div class="txtSchEmailEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'email',
                                                'autocomplete' => 'off',
                                                'required' => 'required',                                                
                                                'placeholder' => 'email-ID',
                                                'name' => 'txtSchEmail',
                                                'id' => 'txtSchEmail',
                                                'value' => $sch->SCH_EMAIL
                                            );
                                            echo form_input($data);
                                            ?>    
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editAdd"></i></td>
                                    <td>
                                        <?php echo $sch->SCH_ADD; ?>
                                        <div class="txtSchAddEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',                                                
                                                'placeholder' => 'Address',
                                                'name' => 'txtSchAdd',
                                                'id' => 'txtSchAdd',
                                                'value' => $sch->SCH_ADD
                                            );
                                            echo form_input($data);
                                            ?>     
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editCity"></i></td>
                                    <td>
                                        <?php echo $sch->SCH_CITY; ?>
                                        <div class="txtSchCityEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',                                                
                                                'placeholder' => 'City',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'txtPCity',
                                                'id' => 'txtPCity',
                                                'value' => $sch->SCH_CITY
                                            );
                                            echo form_input($data);
                                            ?>   
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editDisitt"></i></td>
                                    <td>
                                        <?php echo $sch->SCH_DISITT; ?>
                                        <div class="txtSchDisittEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',                                                
                                                'placeholder' => 'District',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'txtPDistt',
                                                'id' => 'txtPDistt',
                                                'value' => $sch->SCH_DISITT
                                            );
                                            echo form_input($data);
                                            ?>   
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editState"></i></td>
                                    <td>
                                        <?php echo $sch->SCH_STATE; ?>
                                        <div class="txtSchStateEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'class' => 'span7',
                                                'name' => 'cmbPState',
                                                'id' => 'cmbPState',
                                            );
                                            $options = array();
                                            $options['-x-'] = 'Select State';
                                            ?>
                                            <?php echo form_dropdown($data, $options,''); ?>   
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td class="taskOptions"><i class="icon-edit" style="color: #ff3333;cursor:pointer;" id="editCountry"></i></td>
                                    <td>
                                        <?php echo $sch->SCH_COUNTRY; ?>
                                        <div class="txtSchCountryEdit" style="display:none;">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',                                                
                                                'placeholder' => 'Country',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'txtCountry',
                                                'id' => 'txtCountry',
                                                'value' => $sch->SCH_COUNTRY
                                            );
                                            echo form_input($data);
                                            ?>         
                                            <input type="button" value="update" class="btn btn-warning updateMe"/>
                                        </div>
                                    </td>   
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>        
    <?php } else { ?>
        <div class="span6 submitSchoolData">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>School Information</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="control-group">
                        <?php
                        $attrib_ = array(
                            'class' => 'form-horizontal',
                            'name' => 'frmGenSchool',
                            'id' => 'frmGenSchool',
                        );
                        ?>
                        <?php echo form_open('#', $attrib_); ?>
                        <div class="control-group">
                            <label class="control-label">School Logo</label>
                            <div class="controls">                        
                                <?php
                                $data = array(
                                    'type' => 'file',
                                    'class' => "span4",
                                    'placeholder' => 'School Logo',
                                    'autocomplete' => 'off',
                                    'name' => 'txtLogoUpload',
                                    'id' => 'txtLogoUpload'
                                );
                                echo form_input($data);
                                ?>                                                   
                            </div>
                        </div>
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
                            <label class="control-label">Contact Number</label>
                            <div class="controls">                        
                                <?php
                                $data = array(
                                    'type' => 'text',
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'class' => 'span11',
                                    'placeholder' => 'Contact Number',
                                    'name' => 'txtSchContact',
                                    'id' => 'txtSchContact',
                                    'value' => ''
                                );
                                echo form_input($data);
                                ?>                                                   
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">email-ID</label>
                            <div class="controls">                        
                                <?php
                                $data = array(
                                    'type' => 'email',
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'class' => 'span11',
                                    'placeholder' => 'email-ID',
                                    'name' => 'txtSchEmail',
                                    'id' => 'txtSchEmail',
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
    <?php } ?>
</div>