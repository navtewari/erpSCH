<style type="text/css">
    .selectedFlexiHeadCSS{float: left; margin:3px; padding: 3px; background: #FFF0BF; border:#900000 dotted 1px; border-radius: 5px; font-size: 10px;}
</style>
<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmFlexiHeadedStudents',
            'id' => 'frmFlexiHeadedStudents',
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
                                    'name' => 'cmbClassesForFlexiHeadedStudents',
                                    'id' => 'cmbClassesForFlexiHeadedStudents',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                $options['x'] = 'Select Class';
                                foreach ($class_in_session as $item) {
                                	$options[$item->CLSSESSID] = $item->CLASSID;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group">
                    <label class="control-label">Select Heads</label>
                        <div class="controls" style="overflow-y: scroll; max-height: 250px;">
                            <?php
                                $options = array();
                                $options['x'] = 'Select Class';
                                foreach ($felxiHeads_1 as $item) {
                                    $options = array(
                                        'name' => 'chkFlexiHeadsNTimes[]',
                                        'id' => 'chkFlexiHeadsNTimes_'.$item->flexiHeads,
                                        'value'=> $item->flexiHeads,
                                        'class'=> 'chkFlexiHeadedStudents'
                                    );
                                    echo form_checkbox($options) . $item->flexiHeads. "<br>";
                                }
                            ?>
                            <?php //echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
            </div>
            <div class="widget-content" style="overflow: hidden">
            <div class="control-group">
		        <div class="controls">
		            <input type="submit" value="Show" class="btn btn-success" name="cmbShowFlexiHeadedStudents" id="cmbShowFlexiHeadedStudents">
		        </div>
	        </div>
	    </div>
        </div>
    </div>
    <div class="controls span6">
        <div class="control-group">
            <div class="widget-box">
                <div class="widget-content nopadding">
                    <div id="discount_selected" style="padding: 1px 1px;"></div>
                </div>
                <div style="clear: both"></div>
                <div class="widget-title student_class_info">
                    <div>
                        <h5 id="caption_for_class_for_FlexiHeaded_students" style="float: left"></h5>
                        <h5 id="caption_for_total_FlexiHeaded_students" style="float: right;"></h5>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <div class="widget-content nopadding" style="overflow: hidden">
                    <table class="table table-bordered table-striped with-check">
                        <thead>
                            <tr>
                                <th style="text-align: left; min-width: 10%">Reg. No.</th>
                                <th style="text-align: left; min-width: 80%">Student Name</th>
                                <th style="text-align: left; min-width: 80%">Optional Fee applied</th>
                            </tr>
                        </thead>
                        <tbody id="FlexiHeaded_students_here">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="control-group">
        <div class="controls">
            <input type="submit" value="Print Students" class="btn btn-success" name="cmbPrintFlexiHeadedStudents" id="cmbPrintFlexiHeadedStudents">
        </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>