<style>
    .edit_color_head{
        color: #ff0000 !important;
    }
    .edit_color_content{
        color: #0000ff !important;
    }
</style>
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
                                <div class="widget-title"> <span class="icon"> <i class="icon-certificate"></i> </span>
                                    <h5 id="discount_head">Add Discount</h5>
                                </div>
                                <div class="widget-content" style="overflow: hidden">
                                    <div class="control-group span4">
                                        <label class="control-label">Category</label>
                                        <div class="controls">
                                            <?php
                                                $data = array(
                                                    'class' => 'span12 text',
                                                    'name' => 'cmbCategory',
                                                    'id' => 'cmbCategory',
                                                    'required' => 'required'
                                                );
                                                $options = array();
                                                $options['x'] = 'Select Category';
                                                $options['OTHER'] = 'OTHER';
                                                $options['CATEG'] = 'CATEGORY';
                                                $options['SIBLINGS'] = 'SIBLINGS';
                                            ?>
                                            <?php echo form_dropdown($data, $options, ''); ?>
                                        </div>
                                    </div>
                                    <div class="control-group span8">
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
                                    <div class="control-group span12" id="sibling_count" style="display: none">
                                        <label class="control-label" style="font-weight: bold; font-size: 10px">Total Siblings eligible for discount</label>
                                        <div class="controls">
                                        <?php
                                            $data = array(
                                                'class' => "span4 text",
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'name' => 'cmbSiblingCountForDiscount',
                                                'id' => 'cmbSiblingCountForDiscount',
                                                'style' => 'float: left; color: #0000ff; background: #00ffff',
                                            );
                                            $optSibNo = array();
                                            $optSibNo['x'] = 'Select Number';
                                            for($i=1; $i<=5; $i++){
                                                $optSibNo[$i] = $i;
                                            }
                                            echo form_dropdown($data,$optSibNo, 'x');
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
                                            <input type="button" value="Add" class="btn btn-success" id="update_master_Discount">
                                            <input type="reset" value="Cancel" class="btn btn-danger" id="reset_discount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="controls span7">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                                    <h5>Existing Discounts/ Category discounts</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: left">Discounted Item</th>
                                                <th style="text-align: left">Status</th>
                                                <th style="text-align: left">Category of Discount</th>
                                                <th style="text-align: left">Amt/ Percentage</th>
                                                <th style="text-align: left">Description</th>
                                                <th style="text-align: left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="static_fee_heads_here">
                                            <?php foreach ($discounted_items as $discountItems) { ?>
                                                <tr class="gradeX">
                                                    <td class="taskDesc"><i class="icon-info-sign"></i> <?php echo $discountItems->ITEM_;?></td>
                                                    <td class="taskDesc"><?php echo $discountItems->STATUS_;?></td>
                                                    <td class="taskDesc"><?php echo $discountItems->CATEGORY;?></td>
                                                    <td class="taskDesc"><?php echo $discountItems->AMOUNT;?></td>
                                                    <td class="taskDesc"><?php echo $discountItems->DESC_;?></td>
                                                    <td class="taskDesc">
                                                        <a href="#" class="ModifyDiscount" id="Edit~<?php echo $discountItems->DID; ?>"><i class="icon-pencil"></i></a> | 
                                                        <a href="#" class="ModifyDiscount" id="Delete~<?php echo $discountItems->DID; ?>"><i class="icon-remove"></i></a> 
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