<?php $this->load->view('fee/feestyle'); ?>
<div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h5>Invoice(s)</h5>
        <h5 style="float: right" id="total_students"></h5>
    </div>
    <div class="widget-content nopadding" id="class_invoices_here">
    </div>
</div>
<div id="myModal" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Send SMS to the Absentees Parents</h3>
              </div>
              <div class="modal-body">
                <?php echo form_open('#', array('name' => 'frmSMS', 'id' => 'frmSMS', 'role' => 'form')); ?>
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
                                'name' => 'Fee_Message',
                                'id' => 'Fee_Message',
                                'value' => 'Your ward is Absent today.',
                                'style' => 'height: 100px',
                            );
                            echo form_textarea($data);
                            $data = array(
                                'type' => 'hidden',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'placeholder' => 'Mobile Number(s)',
                                'class' => 'required',
                                'name' => 'MessageToPrint',
                                'id' => 'MessageToPrint',
                                'value' => '',
                                'style' => 'height: 100px',
                            );
                            echo form_input($data);
                            ?>
                            <input type="hidden" name="txtFeeSMS" id="txtFeeSMS">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary sendsmsForFee" value="Submit" name="sms_yes" id="sms_yes"><i class="fa fa-send"></i> &nbsp;Send SMS </button>
                    <button type="submit" class="btn btn-danger sendsmsForFee" value="No" name="sms_no" id="sms_no"><i class="fa fa-close"></i> Don't Send SMS </button>
                <?php echo form_close(); ?>
              </div>
            </div>