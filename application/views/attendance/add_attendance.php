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
                    <label class="control-label">Select Attendance Date <span style="font-size: 9px">(dd-mm-yyyy)</span></label>
                    <div class="controls">
                        <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12",
                                'data-date-format'=>"dd-mm-yyyy",
                                'autocomplete' => 'off',
                                'name' => 'attendancedate',
                                'id' => 'attendancedate',
                                'value'=> date('d-m-Y')
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="controls span8">
		<div class="control-group">
			<div class="widget-box">
				<div class="widget-title">
					<div style="float: left; padding: 5px; border:#C0C0C0 solid 1px; width: 20px;height: 25px; text-align: center">
						<input type="checkbox" id="classes_associates_students_for_flexibleHeads_check_boxes" />
					</div>
					<h5 id="caption_for_class"></h5>
					<div style="clear: both"></div>
				</div>
				<div class="widget-content nopadding" style="overflow: auto; height: 300px">
					<table class="table table-bordered table-striped with-check">
						<thead>
							<tr>
								<th><i class="icon-resize-vertical"></i></th>
								<th style="text-align: left">Select Classe(s)</th>
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
		<input type="button" value="Add Fee to selected Student(s)" class="btn btn-success span9" id="associate_flexible_head_with_Students">
		<input type="reset" value="X" class="btn btn-danger cancel_sassociate_flexible_head_with_Student span3" style="float: right">
		</div>
		</div>
	</div>
    <?php echo form_close();?>
</div>