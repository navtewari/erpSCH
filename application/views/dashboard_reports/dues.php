<style type="text/css">
    .for_reminder_label{
        background:#FE8A8A;
        color:#ffff00;
        font-size:10px;
        border-radius: 5px;
        padding: 2px;
    }
    .transparent-label{
        background: transparent;
        color: #ffffff;
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
                                        <a href="#" id="class~<?php echo $class_->CLSSESSID;?>~ID~<?php echo $class_->CLASSID;?>" class="classwise_dues">
                                            <?php echo 'Class ' . $class_->CLASSID;?>       
                                        <div style="background: #CCFCF9; padding: 0px 5px; border: #96EAFD solid 1px; border-radius: 5px; width: auto; float: right">Rs. <?php echo $class_->DUES; ?> /-</div>
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
                <input type="hidden" id="class_reminder" name="class_reminder">
                <h5 style="float: left" id="dues_for_class">Total Due(s) in <?php echo $this -> session -> userdata('_current_year___'); ?></h5>
                <div style="float: left; text-align: center; margin-top: 3px">
                    <div class="btn btn-primary" style="font-size: 10px; border-radius: 5px" id="send_fee_reminder">Send Reminder</div>
                </div>
                <h5 style="float: right">Total Dues: <b style="color:#ff0000">Rs. <?php echo number_format($figure['total_dues_in_a_session'],0,".",","); ?> /-</b></h5>
            </div>
            <div class="widget-content nopadding" style="overflow-y: scroll; overflow-x: auto; height: 450px; padding: 5px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>INV ID</th>
                            <th style="text-align: left; min-width: 10%; width: 100px">
                                <div style="float: left;"><input type="checkbox" id="chkReminderALL"></div>
                                <div id="selectall_reminder" style="float: left; background: #ffffff; padding: 0px 5px; border-radius: 7px">Select All</div>
                            </th>
                            <th style="text-align: left; width: 100px; vertical-align: middle;">Duration</th>
                            <th style="text-align: left; vertical-align: middle;">Months</th>
                            <th style="text-align: left; vertical-align: middle;">RegID</th>
                            <th style="text-align: left; width: 100px; vertical-align: middle;">Name</th>
                            <th style="text-align: left; width: 100px; vertical-align: middle;">Applied Heads</th>
                            <th style="text-align: right; vertical-align: middle;" id="dues_from_class">Amount Due (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody id="student_dues_data_here" style="font-size: 12px">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

            <div id="myModal" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Send Reminder SMS of Fee Dues</h3>
              </div>
              <div class="modal-body">
                <?php echo form_open('#', array('name' => 'frmFeeReminder', 'id' => 'frmFeeReminder', 'role' => 'form')); ?>
                    <div class="control-group">
                        <div class="controls">
                            <label>Mobile Nos.</label>
                            <?php
                            $data = array(
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'placeholder' => 'Mobile Number(s)',
                                'class' => 'required span5',
                                'name' => 'mobilenumbers',
                                'id' => 'mobilenumbers',
                                'value' => '',
                                'style' => 'height: 100px',
                            );
                            echo form_textarea($data);
                            ?>
                        </div>
                        <div class="controls">
                            <label>Message to be sent</label>
                            <?php
                            $data = array(
                                'autocomplete' => 'off',
                                'placeholder' => 'Message please',
                                'required' => 'required',
                                'class' => 'required span5',
                                'name' => 'FeeReminderMsg',
                                'id' => 'FeeReminderMsg',
                                'value' => 'D/P, Kindly deposit your wards fee. IF PAID PLEASE IGNORE. Regards GDJM Public School, Chorgaliya',
                                'style' => 'height: 100px',
                            );
                            echo form_textarea($data);
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary sendreminder" value="Submit" name="sms_yes" id="sms_yes"><i class="fa fa-send"></i> &nbsp;Send SMS </button>
                    <button type="submit" class="btn btn-danger sendreminder" value="No" name="sms_no" id="sms_no"><i class="fa fa-close"></i> Don't Send SMS </button>
                <?php echo form_close(); ?>
              </div>
            </div>