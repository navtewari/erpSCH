<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmAddAttendance',
            'id' => 'frmAddAttendance',
        );
        echo form_open('#', $attrib_); 
    ?>
    <div class="span4">
        <div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5><?php echo $title_;?></h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group">
                    <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbClassesForStudents',
                                    'id' => 'cmbClassesForStudents',
                                    'required' => 'required'
                                );
                                $options = array();
                                $options['x'] = 'Select Class';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Select Attendance Date <span style="font-size: 9px">(dd/mm/yyyy)</span></label>
                    <div class="controls">
                        <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12",
                                'data-date-format'=>"dd/mm/yyyy",
                                'autocomplete' => 'off',
                                'name' => 'attendancedate',
                                'id' => 'attendancedate',
                                'value'=> date('d/m/Y')
                            );
                            echo form_input($data);
                        ?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Select Attendance Time <span style="font-size: 9px">(hr-min)</span></label>
                    <div class="controls">
                        <div class="controls span3">
                        <?php
                                $data = array(
                                    'name' => 'attendanceHour',
                                    'id' => 'attendanceHour',
                                    'required' => 'required'
                                );
                                $options = array();
                                $options['x'] = 'HR';
                                for($i=1; $i<=12; $i++){
                                	$options[$i] = $i;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                        <div class="controls span3">
                            <?php
                                $data = array(
                                    'name' => 'attendanceMin',
                                    'id' => 'attendanceMin',
                                    'required' => 'required'
                                );
                                $options = array();
                                $options['x'] = 'MIN';
                                for($i=0; $i<=60; $i++){
                                	$options[$i] = $i;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                        <div class="controls span4">
                            <?php
                                $data = array(
                                    'name' => 'attendanceAMPM',
                                    'id' => 'attendanceAMPM',
                                    'required' => 'required'
                                );
                                $options = array();
                                $options['x'] = 'AM/PM';
                                $options['AM'] = 'AM';
                                $options['PM'] = 'PM';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                            <input type="reset" value="" id="resetAttendForm" name="resetAttendForm" style="display: none;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="controls span6">
		<div class="control-group">
			<div class="widget-box">
				<div class="widget-title">
					<div>
						
					</div>
					<h5 id="caption_for_class"></h5>
					<div style="clear: both"></div>
				</div>
				<div class="widget-content nopadding" style="overflow: auto; height: 300px">
					<table class="table table-bordered table-striped with-check">
						<thead>
							<tr>
								<th style="text-align: left; min-width: 10%;"><input type="checkbox" id="atten_check" /></th>
								<th style="text-align: left; min-width: 10%">Reg. No.</th>
								<th style="text-align: left; min-width: 80%">Student Name</th>
							</tr>
						</thead>
						<tbody id="students_here">

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="control-group">
		<div class="controls">
			<input type="submit" value="Submit Attendance" class="btn btn-success" name="cmbAddClassSubmit" id="cmbAddClassSubmit">
		</div>
		</div>
	</div>
    <?php echo form_close();?>
</div>
            <div id="myModal" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Send SMS to the Absentees Parents</h3>
              </div>
              <div class="modal-body">
                <?php echo form_open('#', array('name' => 'frmSMS', 'id' => 'frmSMS', 'role' => 'form')); ?>
                    <div class="control-group">
                        <div class="controls">
                            <label>Mobile Nos.</label>
                            <?php
                            $data = array(
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'placeholder' => 'Mobile Number(s)',
                                'class' => 'required span5',
                                'name' => 'mobilenumbers',
                                'id' => 'mobilenumbers',
                                'value' => '',
                                'style' => 'height: 100px',
                            );
                            echo form_textarea($data);
                            ?>
                        </div>
                        <div class="controls">
                            <label>Message to be sent</label>
                            <?php
                            $data = array(
                                'autocomplete' => 'off',
                                'placeholder' => 'Message please',
                                'required' => 'required',
                                'class' => 'required span5',
                                'name' => 'Absent_Message',
                                'id' => 'Absent_Message',
                                'value' => 'Your ward is Absent today.',
                                'style' => 'height: 100px',
                            );
                            echo form_textarea($data);
                            $data = array(
                                'type' => 'hidden',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'placeholder' => 'Mobile Number(s)',
                                'class' => 'required',
                                'name' => 'MessageToPrint',
                                'id' => 'MessageToPrint',
                                'value' => '',
                                'style' => 'height: 100px',
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary sendsms" value="Submit" name="sms_yes" id="sms_yes"><i class="fa fa-send"></i> &nbsp;Send SMS </button>
                    <button type="submit" class="btn btn-danger sendsms" value="No" name="sms_no" id="sms_no"><i class="fa fa-close"></i> Don't Send SMS </button>
                <?php echo form_close(); ?>
              </div>
            </div>