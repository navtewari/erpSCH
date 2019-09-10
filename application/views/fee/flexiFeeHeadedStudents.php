<style type="text/css">
    .selectedFlexiHeadCSS{float: left; margin:3px; padding: 3px; background: #FFF0BF; border:#900000 dotted 1px; border-radius: 5px; font-size: 10px;}
    .fade{ opacity: 1; }

    @media print {
      body * {
        visibility: hidden;
      }
      #section-to-print, #section-to-print * {
        visibility: visible;
      }
      #section-to-print {
        color: #000000 !important;
        position: absolute;
        left: 0;
        top: 0;
      }
    }
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
    <div class="span6">
        <div class="widget-box">
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
                                $options['all'] = 'ALL' ;
                                foreach ($class_in_session as $item) {
                                	$options[$item->CLSSESSID] = $item->CLASSID;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span3 fade">
                    <label class="control-label">Year From<?php echo explode("-", $this->session->userdata('_current_year___'))[0];?></label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbYr_from',
                                    'id' => 'cmbYr_from',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                for($i=explode("-", $this->session->userdata('_current_year___'))[0]; $i<=(date('Y')+1);$i++){
                                    $options[$i] = $i;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, explode("-", $this->session->userdata('_current_year___'))[0]); ?>
                        </div>
                </div>
                <div class="control-group span3 fade">
                    <label class="control-label">Month From</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbMnth_from',
                                    'id' => 'cmbMnth_from',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                foreach($fetch_month as $key => $value){
                                    $options[$key] = $value;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, (4)); ?>
                        </div>
                </div>
                <div class="control-group span3 fade">
                    <label class="control-label">Year To</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbYr_to',
                                    'id' => 'cmbYr_to',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                for($i=explode("-", $this->session->userdata('_current_year___'))[0]; $i<=(date('Y')+1);$i++){
                                    $options[$i] = $i;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, date('Y')); ?>
                        </div>
                </div>
                <div class="control-group span3 fade">
                    <label class="control-label">Month To</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbMnth_to',
                                    'id' => 'cmbMnth_to',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                foreach($fetch_month as $key => $value){
                                    $options[$key] = $value;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, date('m')); ?>
                            
                        </div>
                </div>
                <div class="control-group"></div>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span6">
                    <label class="control-label" style="color: #0000ff">Select <b>1-Time</b> Heads</label>
                        <div class="controls" style="overflow-y: auto; height: 150px;">
                            <?php
                                $options = array();
                                $options['x'] = 'Select Class';
                                foreach ($felxiHeads_1 as $item) {
                                    if(trim($item->HEADS)!=''){
                                        $options = array(
                                            'name' => 'chkFlexiHeads1Times[]',
                                            'id' => 'chkFlexiHeads1Times_'.$item->HEADS,
                                            'value'=> $item->HEADS,
                                            'class'=> 'chkFlexiHeaded1time'
                                        );
                                    echo form_checkbox($options) . $item->HEADS. "<br>";
                                    }
                                }
                            ?>
                            <?php //echo form_dropdown($data, $options, ''); ?>
                        </div>
                </div>
                <div class="control-group span6">
                    <label class="control-label" style="color: #0000ff">Select <b>N-Time</b> Heads</label>
                        <div class="controls" style="overflow-y: auto; height: 150px;">
                            <?php
                                $options = array();
                                $options['x'] = 'Select Class';
                                foreach ($felxiHeads_n as $item) {
                                    if(trim($item->HEADS)!=''){
                                        $options = array(
                                            'name' => 'chkFlexiHeadsNTimes[]',
                                            'id' => 'chkFlexiHeadsNTimes_'.$item->HEADS,
                                            'value'=> $item->HEADS,
                                            'class'=> 'chkFlexiHeadedNtime'
                                        );
                                    echo form_checkbox($options) . $item->HEADS. "<br>";
                                    }
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
    <div class="controls span5" id="section-to-print">
        <div class="control-group">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5 id="felxiHeads_1_time_heading">Opted Fee to Collect (<b>1</b> Time)</h5>
                </div>
                <div class="widget-content nopadding">
                    <div id="discount_selected" style="padding: 1px 1px;"></div>
                </div>
                <div class="widget-content nopadding" style="overflow: hidden">
                    <table class="table table-bordered table-striped with-check">
                        <thead>
                            <tr>
                                <th style="text-align: left; width: 40%">Optional Fee applied</th>
                                <th style="text-align: center; width: 40%">Number of Entries</th>
                                <th style="text-align: right; width: 20%">Amount (Rs.)</th>
                            </tr>
                        </thead>
                        <tbody id="FlexiHeaded_students_here_1_time">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5 id="felxiHeads_N_time_heading">Opted Fee to Collect (<b><i>N</i></b> Time)</h5>
                </div>
                <div class="widget-content nopadding">
                    <div id="discount_selected" style="padding: 1px 1px;"></div>
                </div>
                <div class="widget-content nopadding" style="overflow: hidden">
                    <table class="table table-bordered table-striped with-check">
                        <thead>
                            <tr>
                                <th style="text-align: left; width: 40%">Optional Fee applied</th>
                                <th style="text-align: center; width: 40%">Number of Entries</th>
                                <th style="text-align: right; width: 20%">Amount (Rs.)</th>
                            </tr>
                        </thead>
                        <tbody id="FlexiHeaded_students_here_N_time">

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