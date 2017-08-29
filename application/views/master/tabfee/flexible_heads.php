<div class="row-fluid">
	<div class="controls span3">
		<div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-ok-sign"></i> </span>
                <h5>Add Flexible Heads</h5>
            </div>
            <div class="widget-content">
                <div class="control-group">
                    <label class="control-label">New Flexible Head</label>
                    <div class="controls">
                        <?php
	                        $data = array(
	                            'type' => 'text',
	                            'class'=>"span12 text",
	                            'autocomplete' => 'off',
	                            'required' => 'required',
	                            'name' => 'txtFeeFlexibleHead',
	                            'id' => 'txtFeeFlexibleHead'
	                        );
	                        echo form_input($data);
	                    ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Amount</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12 text",
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtFeeFlexibleHeadAmt',
                                'id' => 'txtFeeFlexibleHeadAmt'
                            );
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Add" class="btn btn-success" id="add_flexible_head">
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div class="controls span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
            <h5>View Flexible Heads</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="text-align: left">Flexible Heads</th>
                  <th style="text-align: right">Amount (INR)</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="flexible_fee_heads_here">
                <?php foreach ($flexible_heads__ as $itemflexiheads) { ?>
                <tr>
                  <td style="text-align: left" class="taskDesc"><i class="icon-info-sign"></i> <?php echo $itemflexiheads->FEE_HEAD; ?></td>
                  <td  style="text-align: right" class="taskDesc"> <?php echo $itemflexiheads->AMOUNT; ?></td>
                  <td class="taskOptions">
                  <a href="#" class="tip edit_flexible_head_" id="<?php echo 'EditFlexibleHead'. "~" . $itemflexiheads->FLX_HD_ID . "~" . $itemflexiheads->FEE_HEAD . "~" . $itemflexiheads->AMOUNT;?>"><i class="icon-pencil"></i></a> |
                  <a href="#" class="tip-top delete_flexible_head_" id="<?php echo $itemflexiheads->FLX_HD_ID;?>"><i class="icon-remove"></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="controls span3">
        <div class="widget-box" id="edit_flexible_head_panel" style="display: none">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
                <h5 style="color: #DD0000">Update Flexible Head</h5>
            </div>
            <div class="widget-content" style="color: #DD0000">
                <div class="control-group">
                    <label class="control-label">Edit Flexible Head</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12 text",
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtFlexibleHead_edit',
                                'id' => 'txtFlexibleHead_edit',
                                 'style'=>"color: #0000DD"
                            );
                            echo form_input($data);
                        ?>
                        <?php
                            $data = array(
                                'type' => 'hidden',
                                'class'=> 'span12 text',
                                'required' => 'required',
                                'name' => 'txtFlexID_edit',
                                'id' => 'txtFlexID_edit'
                                );
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Amount</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12 text",
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtFlexibleHeadAmt_edit',
                                'id' => 'txtFlexibleHeadAmt_edit'
                            );
                            echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Update" class="btn btn-primary" id="update_flexible_head">
                        <input type="reset" value="Cancel" class="btn btn-danger cancel_flexible_head_update">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>