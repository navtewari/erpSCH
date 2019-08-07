<div class="span4">
    <style type="text/css">
    .excelicon {width: 48px !important; float: left !important; padding:0px !important}
</style>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                <h5>Total Collection</h5>
                <h5 class="show_message" id="show_message"></h5>
            </div>
            <?php
                $attrib_ = array(
                    'class' => 'form-vertical',
                    'name' => 'frmTotalFeeCOllectedClasswiseDurationwise',
                    'id' => 'frmTotalFeeCOllectedClasswiseDurationwise',
                );
                echo form_open('exporting/export_fee_total_class_collection', $attrib_); 
            ?>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span12">
                    <label class="control-label">Select Class</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbClassForTotalCollection',
                                'id' => 'cmbClassForTotalCollection',
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
                <div class="control-group span12">
                    <label class="control-label">Date From</label>
                    <div class="controls">
                        <div  data-date="<?php echo date('d/m/Y'); ?>" class="input-append date datepicker">
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => "span12",
                                'data-date-format' => "dd-mm-YYYY",
                                'autocomplete' => 'off',
                                'name' => 'txtDateFrom',
                                'id' => 'txtDateFrom',
                                'value' => date('1/4/'.explode('-', $this->session->userdata('_current_year___'))[0])
                            );
                            echo form_input($data);
                            ?>
                            <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
                </div>
                <div class="control-group span12">
                    <label class="control-label">Date To</label>
                    <div  data-date="<?php echo date('d/m/Y'); ?>" class="input-append date datepicker">
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => "span12",
                            'data-date-format' => "dd-mm-yyyy",
                            'autocomplete' => 'off',
                            'name' => 'txtDateTo',
                            'id' => 'txtDateTo',
                            'value' => date('d/m/Y')
                        );
                        echo form_input($data);
                        ?>
                        <?php
                        $data = array(
                            'type' => 'hidden',
                            'class' => "span12",
                            'autocomplete' => 'off',
                            'name' => 'cls',
                            'id' => 'cls',
                        );
                        echo form_input($data);
                        ?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                    </div>
                </div>
                <div class="control-group span12">
                    <input type="button" value="View" class="btn btn-primary" id="cmdViewTotalFeeClasswise">
                </div>
                <?php if($this->session->userdata('_status_') == 'adm') {?>
                <div class="control-group span12">
                    <input type="image" src="<?php echo base_url('assets_/img/excel.png');?>" class="excelicon" id="totalCollection1">
                    <div style="padding: 15px 0px;"> Download without discount</div>
                </div>
                <div class="control-group span12">
                    <input type="image" src="<?php echo base_url('assets_/img/excel.png');?>" class="excelicon" id="totalCollection2">
                    <div style="padding: 15px 0px;"> Download with discount</div>
                </div>
                <div class="control-group span12">
                    <input type="image" src="<?php echo base_url('assets_/img/excel.png');?>" class="excelicon" id="totalCollection3">
                    <div style="padding: 15px 0px;"> Download Consolidate</div>
                </div>
                <?php } ?>
            </div>
    </div>
</div>