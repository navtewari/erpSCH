<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="<?php echo $discounts;?>"><a data-toggle="tab" href="#discounts">Manage Discounts</a></li>
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="discounts" class="tab-pane<?php echo $discounts;?>">
                	<?php
				        $attrib_ = array(
				            'class' => 'form-vertical',
				            'name' => 'frmDiscounts',
				            'id' => 'frmDiscounts',
				        );
				        echo form_open('#', $attrib_); 
				    ?>
                    <div class="row-fluid">
                        <div class="controls span5">
                            <div class="widget-box">
                                <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
                                <div class="widget-title"> <span class="icon"> <i class="icon-certificate"></i> </span>
                                    <h5>Add Discount</h5>
                                </div>
                                <div class="widget-content" style="overflow: hidden">
                                    <div class="control-group">
                                        <label class="control-label">Item for discount</label>
                                        <div class="controls">
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'class' => "span12 text",
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'txtItem',
                                                'id' => 'txtItem'
                                            );
                                            echo form_input($data);
                                            $data = array(
                                                'type' => 'hidden',
                                                'class' => "span12 text",
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'txtBool',
                                                'id' => 'txtBool',
                                                'value' => 'new'
                                            );
                                            echo form_input($data);
                                            $data = array(
                                                'type' => 'hidden',
                                                'class' => "span12 text",
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'txtDiscountID',
                                                'id' => 'txtDiscountID',
                                                'value' => 'x'
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group span5">
                                        <label class="control-label">Discount Status</label>
                                        <div class="controls">
                                            <?php
                                                $data = array(
                                                    'class' => 'span12 text',
                                                    'name' => 'cmdStatus',
                                                    'id' => 'cmdStatus',
                                                    'required' => 'required'
                                                );
                                                $options = array();
                                                $options['x'] = 'Select Status';
                                                $options['Percentage'] = 'Percentage';
                                                $options['Amount'] = 'Amount';
                                            ?>
                                            <?php echo form_dropdown($data, $options, ''); ?>
                                        </div>
                                    </div>
                                    <div class="control-group span6">
                                        <label class="control-label" id="amount_percentage">Percentage/Amount</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                    'type' => 'text',
                                                    'class' => "span12 text",
                                                    'autocomplete' => 'off',
                                                    'required' => 'required',
                                                    'name' => 'txtAmount',
                                                    'id' => 'txtAmount'
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Description (if any?)</label>
                                            <div class="controls">
                                                <?php
                                                    $data = array(
                                                        'class' => 'span12 text',
                                                        'name' => 'txtDesc',
                                                        'id' => 'txtDesc',
                                                        'required' => 'required',
                                                        'style' => 'height: 100px;'
                                                    );
                                                    echo form_textarea($data);
                                                ?>
                                            </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="button" value="Update" class="btn btn-success" id="update_master_Discount">
                                            <input type="reset" value="Cancel" id="reset_disccount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="controls span7">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                    <h5>Existing Discount(s)</h5>
                                    <h5 style="float: right; color:#900000" id="reload_me">Reload</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                            <th style="text-align: left">Discounted Item</th>
                                            <th style="text-align: left">Status</th>
                                            <th style="text-align: left">Amt/ Percentage</th>
                                            <th style="text-align: left">Description</th>
                                            <th style="text-align: left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student_data_here">
                                            <?php foreach ($discounted_items as $discountItems) { ?>
                                            <tr class="gradeX">
                                                <td><?php echo $discountItems->ITEM_;?></td>
                                                <td><?php echo $discountItems->STATUS_;?></td>
                                                <td><?php echo $discountItems->AMOUNT;?></td>
                                                <td><?php echo $discountItems->DESC_;?></td>
                                                <td class="center">
                                                    <a href="#" class="ModifyDiscount" id="Edit~<?php echo $discountItems->DID; ?>">Edit</a> | 
                                                    <a href="#" class="ModifyDiscount" id="Delete~<?php echo $discountItems->DID; ?>">Delete</a> 
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>