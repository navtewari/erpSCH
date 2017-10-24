invoice<div class="row-fluid">
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
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                <h5><?php echo $title_;?></h5>
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
                        ?>
                        <?php echo form_dropdown($data, $options, 'x'); ?>
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
	                            for($i=date('Y'); $i<=(date('Y')+1);$i++){
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
	                            for($i=date('Y'); $i<=(date('Y')+1);$i++){
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
                <div class="control-group"></div>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>
<div class="row-fluid">
        <?php $this->load->view('fee/generateinvoice'); ?>
</div>