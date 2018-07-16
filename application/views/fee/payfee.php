<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-vertical',
            'name' => 'frmPayFee',
            'id' => 'frmPayFee',
        );
        echo form_open('#', $attrib_); 
    ?>
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon" style="font-size: 20px;"> &#8377; </span>
                <h5><?php echo $title_;?></h5>
                <h5 class="show_message" id="show_message"></h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span2">
                    <label class="control-label">Select Class</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'class_in_session_for_Receipt',
                                'id' => 'class_in_session_for_Receipt',
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
                                    'name' => 'cmbYearFromForReceipt',
                                    'id' => 'cmbYearFromForReceipt',
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
                                    'name' => 'cmbMonthFromForReceipt',
                                    'id' => 'cmbMonthFromForReceipt',
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
                                    'name' => 'cmbYearToForReceipt',
                                    'id' => 'cmbYearToForReceipt',
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
                                    'name' => 'cmbMonthToForReceipt',
                                    'id' => 'cmbMonthToForReceipt',
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
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>
<div class="row-fluid">
        <?php $this->load->view('fee/feereceipt'); ?>
</div>