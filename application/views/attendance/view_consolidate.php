<style>
    .printHead{
        font-size: 20px; 
        color:#000000; 
        text-align: center;
    }
    .print_btn{
        visibility: hidden; 
        color: #ffffff; 
        background: #ff0000; 
        padding: 0px 3px; 
        border-radius: 3px;
    }
</style>
<style media="print">
    .hide_print{
        display: none;
    }
</style>
<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmViewConsolidateAttendance',
            'id' => 'frmViewConsolidateAttendance',
        );
        echo form_open('#', $attrib_); 
    ?>
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                <h5><?php echo $title_;?></h5>
                <h5 class="show_message" id="show_message"></h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span2">
                    <label class="control-label">Select Class</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbClassesForStudents_view',
                                'id' => 'cmbClassesForStudents_view',
                                'required' => 'required',
                                'class' => 'span12'
                            );
                            $options = array();
                            $options['x'] = 'Class';
                            foreach ($class_in_session as $item) {
                                $options[$item->CLSSESSID] = 'Class ' . $item->CLASSID;
                            }
                            echo form_dropdown($data, $options, '');
                        ?>
                    </div>
                </div>
	            <div class="control-group span3">
	                <label class="control-label"> Date From <span style="font-size: 9px">(dd/mm/yyyy)</span></label>
                    <div class="controls">
                        <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12",
                                'data-date-format'=>"dd/mm/yyyy",
                                'autocomplete' => 'off',
                                'name' => 'attendancedatefrom',
                                'id' => 'attendancedatefrom',
                                'value'=> date('d/m/Y')
                            );
                            echo form_input($data);
                        ?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
	            </div>
	            <div class="control-group span3">
	                <label class="control-label"> Date upto <span style="font-size: 9px">(dd/mm/yyyy)</span></label>
                    <div class="controls">
                        <div  data-date="<?php echo date('d-m-Y');?>" class="input-append date datepicker">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12",
                                'data-date-format'=>"dd/mm/yyyy",
                                'autocomplete' => 'off',
                                'name' => 'attendancedateto',
                                'id' => 'attendancedateto',
                                'value'=> date('d/m/Y')
                            );
                            echo form_input($data);
                        ?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
	            </div>
	            <div class="control-group span2">
					<label class="control-label">&nbsp;</label>
					<button type="submit" class="btn btn-primary col-sm-12" name="cmbAddClassSubmit" id="cmbAddClassSubmit">Show Attendance</button>
	            </div>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>
<div class="row-fluid">
        <?php $this->load->view('fee/feestyle'); ?>
		<div class="widget-box" id="printTable">
		    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
		        <h5 id="printHead" class="printHead">Attendance -</h5>
		        <h5 style="float:right;" class="hide_print">
		        	<a href="#" style="visibility: hidden; color: #ffffff; background: #ff0000; padding: 0px 3px; border-radius: 3px" onclick="printData();" id="my_print_btn">Print</a>
		    	</h5>
		        <h5 style="float: right" id="total_students"></h5>
		    </div>
		    <div class="widget-content nopadding" id="view_consolidate_attendance" style="overflow: auto">
		    </div>
		</div>
</div>