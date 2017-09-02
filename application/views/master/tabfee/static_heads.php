<div class="row-fluid">
    <div class="controls span3">
        <div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-ok-sign"></i> </span>
                <h5>Add Static Heads</h5>
            </div>
            <div class="widget-content">
                <div class="control-group">
                    <label class="control-label">New Static Head</label>
                    <div class="controls">
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => "span12 text",
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'name' => 'txtFeeStaticHead',
                            'id' => 'txtFeeStaticHead'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Add" class="btn btn-success" id="add_static_head">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="controls span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                <h5>View Static Heads</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: left">Static Heads</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="static_fee_heads_here">
                        <?php foreach ($static_heads__ as $itemstaticheads) { ?>
                            <tr>
                                <td style="text-align: left" class="taskDesc"><i class="icon-info-sign"></i> <?php echo $itemstaticheads->FEE_HEAD; ?></td>
                                <td class="taskOptions">
                                    <a href="#" class="tip edit_static_head_" id="<?php echo 'EditStaticHead' . "~" . $itemstaticheads->ST_HD_ID . "~" . $itemstaticheads->FEE_HEAD; ?>"><i class="icon-pencil"></i></a> |
                                    <a href="#" class="tip-top delete_static_head_" id="<?php echo $itemstaticheads->ST_HD_ID; ?>"><i class="icon-remove"></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="controls span3">
        <div class="widget-box" id="edit_static_head_panel" style="display: none">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
                <h5 style="color: #DD0000">Update Static Head</h5>
            </div>
            <div class="widget-content" style="color: #DD0000">
                <div class="control-group">
                    <label class="control-label">Edit Static Head</label>
                    <div class="controls">
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => "span12 text",
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'name' => 'txtFeeStaticHead_edit',
                            'id' => 'txtFeeStaticHead_edit',
                            'style' => "color: #0000DD"
                        );
                        echo form_input($data);
                        ?>
                        <?php
                        $data = array(
                            'type' => 'hidden',
                            'class' => 'span12 text',
                            'required' => 'required',
                            'name' => 'txtID_edit',
                            'id' => 'txtID_edit'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Update" class="btn btn-primary" id="update_static_head">
                        <input type="reset" value="Cancel" class="btn btn-danger cancel_static_head_update">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>