<div class="row-fluid">
    <div class="control-group">
        <div class="controls span4">
            <label class="control-label" style="font-weight: bold; color: #0000ff">TC issue date</label>
            <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span10",
                    'data-date-format'=>"dd-mm-yyyy",
                    'autocomplete' => 'off',
                    'name' => 'txtTcIssueDate',
                    'id' => 'txtTcIssueDate',
                    'value'=> '',
                    'style' => 'color: #0000ff'
                );
                echo form_input($data);
                ?>
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
        </div>
        <div class="controls span4"></div>
        <div class="controls span4"></div>
        <div style="clear: both"></div>
    </div>
	<div class="control-group">
        <div class="controls span4" style="color: #900000">
        	<label class="control-label">Nationality</label>
            <?php
                $data = array(
                    'type' => 'text',
                    'class' => "span12",
                    'placeholder' => 'Nationality',
                    'autocomplete' => 'off',
                    'required' => 'required',
                    'name' => 'txtNationality',
                    'id' => 'txtNationality',
                    'value' => 'INDIAN',
                    'style' => 'color: #900000'
                );
            echo form_input($data);
            ?>
        </div>
        <div class="controls span4">
            <label class="control-label" style="color: #900000">Student Failed?</label>
            <div class="controls span12" style="float: left; background:#f0f0f0; padding: 0px 10px; border: #E0E0E0 solid 1px; color: #900000">
                <label style="float: left;margin-top: 5px" class="span6">
                    <input type="radio" name="optIsFailed" id="optFailedNo" value="NO" checked="checked" />
                    No</label>
                <label style="float: left;margin-top: 5px;" class="span6">
                    <input type="radio" name="optIsFailed" id="optFailedYes" value="YES" />
                    Yes</label>
            </div>
        </div>
        <div class="controls span4">
            <label class="control-label">Candidate's Reg. No. <span style="font-size: 10px; color: #0000ff; font-weight: bold">(for IX to XII)</span></label>
            <?php
            $data = array(
                'type' => 'text',
                'class' => "span12",
                'placeholder' => 'Serial Number',
                'autocomplete' => 'off',
                'required' => 'required',
                'name' => 'txtRgNo',
                'id' => 'txtRgNo'
            );
            echo form_input($data);
            ?>  
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="control-group">
        <div class="controls span4">
        	<label class="control-label">School No.</label>
            <?php
            $data = array(
                'type' => 'text',
                'class' => "span12",
                'placeholder' => 'School Number',
                'autocomplete' => 'off',
                'required' => 'required',
                'name' => 'txtSchoolNo',
                'id' => 'txtSchoolNo'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="controls span4">
        	<label class="control-label">Book No.</label>
            <?php
            $data = array(
                'type' => 'text',
                'class' => "span12",
                'placeholder' => 'Book Number',
                'autocomplete' => 'off',
                'required' => 'required',
                'name' => 'txtBookNo',
                'id' => 'txtBookNo'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="controls span4">
        	<label class="control-label">Serial No.</label>
            <?php
            $data = array(
                'type' => 'text',
                'class' => "span12",
                'placeholder' => 'Serial Number',
                'autocomplete' => 'off',
                'required' => 'required',
                'name' => 'txtSNo',
                'id' => 'txtSNo'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls span4">
            <label class="control-label">Renewed Upto</label>
            <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span10",
                    'data-date-format'=>"dd-mm-yyyy",
                    'autocomplete' => 'off',
                    'name' => 'txtRenewedUpto',
                    'id' => 'txtRenewedUpto',
                    'value'=> ''
                );
                echo form_input($data);
                ?>
                <span class="add-on"><i class="icon-th"></i></span>
            </div>    
        </div>
    	<div class="controls span4">
    		<label class="control-label">Application No.</label>
            <?php
            $data = array(
                'type' => 'text',
                'class' => "span12",
                'placeholder' => 'Serial Number',
                'autocomplete' => 'off',
                'required' => 'required',
                'name' => 'txtApplicationNo',
                'id' => 'txtApplicationNo'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="controls span4">
    		<label class="control-label">School Status</label>
                <?php
                $data = array(
                    'name' => 'cmbSchoolStatus',
                    'id' => 'cmbSchoolStatus',
                    'class' => 'span12',
                    'style' => 'min-width: 200px; width: 210px;'
                );
                $options = array();
                $options['-x-'] = 'School Status';
                $options['Secondary'] = 'Secondary';
                $options['Sr Secondary'] = 'Sr Secondary';
                
                echo form_dropdown($data, $options, ''); 
                ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls span12">
            <label class="control-label">Subject Offered</label>
            <?php
            $data = array(
                'type' => 'text',
                'class'=>"span12",
                'autocomplete' => 'off',
                'name' => 'txtSubjectOffered',
                'id' => 'txtSubjectOffered',
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls span4">
            <label class="control-label" style="color: #900000">Any Concession?</label>
            <div class="controls span12" style="float: left; background:#f0f0f0; padding: 0px 10px; border: #E0E0E0 solid 1px; color: #900000">
                <label style="float: left;margin-top: 5px" class="span6">
                    <input type="radio" name="optAnyConcession" id="optConcessionNo" value="NO" checked="checked" />
                    No</label>
                <label style="float: left;margin-top: 5px;" class="span6">
                    <input type="radio" name="optAnyConcession" id="optConcessionYes" value="YES" />
                    Yes</label>
            </div>
        </div>
        <div class="controls span8" style="color: #000090">
            <label class="control-label">NCC/ SCOUT/ GUIDE</label>
            <div class="controls span12" style="float: left; background:#f0f0f0; padding: 0px 10px; border: #E0E0E0 solid 1px">
                <label style="float: left;margin-top: 5px" class="span2">
                    <input type="radio" name="optNccScoutGuide" id="optNCC" value="NCC" />
                    NCC</label>
                <label style="float: left;margin-top: 5px;" class="span2">
                    <input type="radio" name="optNccScoutGuide" id="optSCOUT" value="SCOUT" />
                    SCOUT</label>
                <label style="float: left;margin-top: 5px;" class="span2">
                    <input type="radio" name="optNccScoutGuide" id="optGUIDE" value="GUIDE" />
                    GUIDE</label>
                <label style="float: left;margin-top: 5px;" class="span3">
                    <input type="radio" name="optNccScoutGuide" id="optNA" value="NA" checked="checked" />
                    NA</label>
            </div>
            <div style="clear: both;padding: 5px"></div>
        </div>
        <div class="control-group">
            <div class="controls span12">
                <label class="control-label">Reason of Leaving School</label>
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span12",
                    'autocomplete' => 'off',
                    'name' => 'txtReasonForLeavingSchool',
                    'id' => 'txtReasonForLeavingSchool',
                    'style' => 'height: 50px'
                );
                echo form_textarea($data);
                ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls span4">
                <label class="control-label">Date of Cutting Name</label>
                <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                    <?php
                    $data = array(
                        'type' => 'text',
                        'class'=>"span10",
                        'data-date-format'=>"dd-mm-yyyy",
                        'autocomplete' => 'off',
                        'name' => 'txtDateOfCuttingName',
                        'id' => 'txtDateOfCuttingName',
                        'value'=> ''
                    );
                    echo form_input($data);
                    ?>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>      
            </div>
            <div class="controls span4">
                <label class="control-label">Last Studied Class</label>
                    <?php
                        $data = array(
                            'name' => 'cmbLastStudiedClass',
                            'id' => 'cmbLastStudiedClass',
                            'class' => 'span12',
                            'style' => 'min-width: 200px; width: 210px;'
                        );
                        $options = array();
                        $options['x'] = 'Select Class';
                        foreach ($class_in_session as $item) {
                            $options[$item->CLSSESSID] = $item->CLASSID;
                        }
                    ?>
                    <?php echo form_dropdown($data, $options, ''); ?>
            </div>
            <div class="controls span4">
                <label class="control-label">School/ Board</label>
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span12",
                    'autocomplete' => 'off',
                    'name' => 'txtSchoolOrBoard',
                    'id' => 'txtSchoolOrBoard',
                );
                echo form_input($data);
                ?>
            </div>
            <div style="clear: both; padding: 5px"></div>
        </div>
        <div class="control-group">
            <div class="controls span4">
                <label class="control-label">No. of meetings upto date</label>
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span12",
                    'autocomplete' => 'off',
                    'name' => 'txtMeetingsUptoDate',
                    'id' => 'txtMeetingsUptoDate',
                );
                echo form_input($data);
                ?>
            </div>
            <div class="controls span4">
                <label class="control-label">School days attended</label>
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span12",
                    'autocomplete' => 'off',
                    'name' => 'txtSchoolDaysAttended',
                    'id' => 'txtSchoolDaysAttended',
                );
                echo form_input($data);
                ?>
            </div>
            <div class="controls span4" style="color: #000090">
                <label class="control-label">Dues Paid?</label>
                <div class="controls span12" style="float: left; background:#f0f0f0; padding: 0px 10px; border: #E0E0E0 solid 1px">
                    <label style="float: left;margin-top: 5px" class="span4">
                        <input type="radio" name="optDuesPaid" id="optDuesPaidYes" value="YES" />
                        Yes</label>
                    <label style="float: left;margin-top: 5px;" class="span4">
                        <input type="radio" name="optDuesPaid" id="optDuesPaidNo" value="NO" />
                        No</label>
                    <label style="float: left;margin-top: 5px;" class="span4">
                        <input type="radio" name="optDuesPaid" id="optDuesPaidNA" value="NA" checked="checked" />
                        NA</label>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls span4">
                <label class="control-label">General Conduct of Student</label>
                <?php
                    $data = array(
                        'name' => 'cmbGeneralConduct',
                        'id' => 'cmbGeneralConduct',
                        'class' => 'span12',
                        'style' => 'min-width: 200px; width: 210px;'
                    );
                    $options = array();
                    $options['x'] = 'Select General Conduct';
                    $options['Excellent'] = 'Excellent';
                    $options['Good'] = 'Good';
                    $options['Satisfactory'] = 'Satisfactpry';
                    $options['Poor'] = 'Poor';
                    
                ?>
                <?php echo form_dropdown($data, $options, ''); ?>
            </div>
            <div class="controls span4">
                <label class="control-label">Promoted?</label>
                <div class="controls span12" style="float: left; background:#f0f0f0; padding: 0px 10px; border: #E0E0E0 solid 1px">
                    <label style="float: left;margin-top: 5px" class="span4">
                        <input type="radio" name="optIsPromoted" id="optPromotedYes" value="YES" />
                        Yes</label>
                    <label style="float: left;margin-top: 5px;" class="span4">
                        <input type="radio" name="optIsPromoted" id="optPromotedNo" value="NO" />
                        No</label>
                    <label style="float: left;margin-top: 5px;" class="span4">
                        <input type="radio" name="optIsPromoted" id="optPromotedNA" value="NA" checked="checked" />
                        NA</label>
                </div>
            </div>
            <div class="controls span4"></div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="controls span12">
                <label class="control-label">Remarks (if any)</label>
                <?php
                $data = array(
                    'type' => 'text',
                    'class'=>"span12",
                    'autocomplete' => 'off',
                    'name' => 'txtRemarks',
                    'id' => 'txtRemarks',
                    'style' => 'height: 60px'
                );
                echo form_textarea($data);
                ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls span4">
                <input type="button" value="Update" class="btn btn-success submit_or_update_admission">
                <input type="button" value="Cancel" class="btn btn-danger reset_button_template">
            </div>
        </div>
    </div>

</div>