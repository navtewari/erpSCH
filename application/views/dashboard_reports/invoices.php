<style>
    .view_invoice_0{
         color: #808080; 
         background: #f0f0f0;
         color: #ff0000;
         border-radius: 4px;
         border: #A0A0A0 solid 1px;
         padding: 1px 5px;
         text-decoration: none !important;
    }
    .view_invoice_1{
         color: #B0B0B0; 
         background: #ffff00;
         color: #ff0000;
         border-radius: 4px;
         border: #A0A0A0 solid 1px;
         padding: 1px 5px;
    }
</style>
<div class="row-fluid">
    <div class="span3">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Classes in <?php echo $this -> session -> userdata('_current_year___'); ?></h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: left">Class</th>
                        </tr>
                    </thead>
                    <tbody id="student_data_here" style="font-size: 12px">
                        <?php $i = 1; ?>
                        <?php foreach ($total_classes as $class_) { ?>
                            <tr class="gradeX">
                                <td>
                                    <div style="font-size: 12px; padding: 0px 2px;">
                                        <a href="#" id="class~<?php echo $class_->CLSSESSID;?>~ID~<?php echo $class_->CLASSID;?>" class="classwise_invoices">
                                            <?php echo 'Class ' . $class_->CLASSID;?>        
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span9">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="invoice_for_class">Invoice(s) in <?php echo $this -> session -> userdata('_current_year___'); ?></h5>
            </div>
            <div class="widget-content nopadding" style="overflow-y: scroll; overflow-x: auto; height: 450px; padding: 5px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>INV. ID</th>
                            <th>Class</th>
                            <th style="text-align: left">RegID</th>
                            <th style="text-align: left">Name</th>
                            <th style="text-align: right">Amount</th>
                            <th style="text-align: right">Due Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="student_invoice_data_here" style="font-size: 12px">
                        <!--
                            <?php //foreach ($invoices as $inv_item) { ?>
                                <?php //if($inv_item->STATUS == 1){ ?>
                                    <?php $css_class = ' class="view_invoice_1"'; ?>
                                    <tr class="gradeX">
                                        <?php $due_amnt = $inv_item->DUE_AMOUNT; ?>
                                <?php //} else { ?>
                                    <?php $css_class = ' class="view_invoice_0"'; ?>
                                    <tr class="gradeX" style="color: #B0B0B0; text-decoration: line-through;">
                                        <?php //if($inv_item->DUE_AMOUNT != 0){?>
                                            <?php $due_amnt = "(c/fwd) " . $inv_item->DUE_AMOUNT; ?>
                                        <?php //} else { ?>
                                            <?php //$due_amnt = $inv_item->DUE_AMOUNT; ?>
                                        <?php //} ?>
                                <?php //} ?>
                                <?php //$url_ = 'fee/print_invoice/'.$inv_item->INVDETID."/".$inv_item->CLSSESSID; ?>
                                    <td style="text-align: center">
                                        <a href="<?php //echo site_url($url_);?>" target="_blank"<?php echo $css_class; ?>>View</a>
                                    </td>
                                    <td style="text-align: center">
                                        <?php //echo $inv_item->INVDETID; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php //echo $inv_item->CLASSID; ?>
                                    </td>
                                    <td>
                                        <div>
                                            <?php //echo $inv_item->regid;?>        
                                        </div>
                                    </td>
                                    <td>
                                        <?php //echo $inv_item->FNAME; ?>
                                    </td>
                                    <td style="text-align: right">
                                        <?php //echo $inv_item->ACTUAL_DUE_AMOUNT+$inv_item->PREV_DUE_AMOUNT; ?>
                                    </td>
                                    <td style="text-align: right">
                                        <?php //echo $due_amnt; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="<?php //echo site_url($url_);?>" target="_blank"<?php echo $css_class; ?>>View</a>
                                    </td>
                                </tr>

                            <?php //} ?>
                        -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>