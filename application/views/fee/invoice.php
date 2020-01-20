<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmInvoice',
            'id' => 'frmInvoice',
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
                                'name' => 'cmbClassForInvoice',
                                'id' => 'cmbClassForInvoice',
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
                <div class="control-group span1"></div>
	            <div class="control-group span2">
	                <label class="control-label">Year From</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'cmbYearFromForInvoice',
	                                'id' => 'cmbYearFromForInvoice',
	                                'required' => 'required',
	                            	'class' => 'span12'
	                            );
	                            $options = array();
	                            //for($i=date('Y')-1; $i<=(date('Y')+1);$i++){
	                            $year__ = $this->session->userdata('_current_year_selected__');
	                            $limit_year = $year__+ 2;
	                            for($i=$year__; $i<=$limit_year; $i++){
	                            	$options[$i] = $i;
	                            }
	                        ?>
	                        <?php echo form_dropdown($data, $options, date('Y')); ?>
	                    </div>
	            </div>
	            <div class="control-group span2">
	                <label class="control-label">Month From</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'cmbMonthFromForInvoice',
	                                'id' => 'cmbMonthFromForInvoice',
	                                'required' => 'required',
	                            	'class' => 'span12'
	                            );
	                            $options = array();
	                            foreach($fetch_month as $key => $value){
	                            	$options[$key] = $value;
	                            }
	                        ?>
	                        <?php echo form_dropdown($data, $options, (date('m'))); ?>
	                    </div>
	            </div>
	            <div class="control-group span1"></div>
                <div class="control-group span2">
	                <label class="control-label">Year To</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'cmbYearToForInvoice',
	                                'id' => 'cmbYearToForInvoice',
	                                'required' => 'required',
	                            	'class' => 'span12'
	                            );
	                            $options = array();
	                            //for($i=date('Y'); $i<=(date('Y')+1);$i++){
	                            $year__ = $this->session->userdata('_current_year_selected__');
	                            $limit_year = $year__+ 2;
	                            for($i=$year__; $i<=$limit_year; $i++){
	                            	$options[$i] = $i;
	                            }
	                        ?>
	                        <?php echo form_dropdown($data, $options, date('Y')); ?>
	                    </div>
	            </div>
	            <div class="control-group span2">
	                <label class="control-label">Month To</label>
	                    <div class="controls">
	                        <?php
	                            $data = array(
	                                'name' => 'cmbMonthToForInvoice',
	                                'id' => 'cmbMonthToForInvoice',
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
	            <?php if($this->session->userdata('_status_') == 'adm'){ ?>
	                <div class="control-group" style="border: #ff0000 solid 0px">
		                <input type="button" value="Zero Receipt" name="cmdPayZeroReceipt" id="cmdPayZeroReceipt" class="span4 zero_receipt" style="float: right; width: auto">
	                </div>
	            <?php } else { ?>
	            	<div class="control-group"></div>
	            <?php } ?>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>
<div class="row-fluid">
        <?php $this->load->view('fee/generateinvoice'); ?>
</div>