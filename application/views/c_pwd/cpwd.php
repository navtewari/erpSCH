<div class="span4">
<div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5><?php echo $this->session->userdata('ussr_') ;?> needs to change the password...<?php echo $this->session->userdata('pwd_count');?></h5>
            </div>
            <div class="widget-content" id="fullform">
                <?php echo form_open('#', array('name' => 'frm_cpwd', 'id' => 'frm_cpwd', 'role' => 'form')); ?>
                    <div class="form-group" style="color: #ff0000;">
                        <label>Old Password<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'password',
                            'maxlength' => '28',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Old Password',
                            'class' => 'required form-control span3',
                            'name' => 'old_pwd',
                            'id' => 'old_pwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="Controls" style="color: #009000">
                        <label>New Password<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'password',
                            'maxlength' => '28',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'New Password',
                            'class' => 'required form-control span3',
                            'name' => 'new_pwd',
                            'id' => 'new_pwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group" style="color: #009000">
                        <label>Confirm new Password<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'password',
                            'maxlength' => '28',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'New Re-Password',
                            'class' => 'required form-control span3',
                            'name' => 'new_re-pwd',
                            'id' => 'new_re-pwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-danger" id="changepwdbutt"> Change Password </button>
                    </div>
                    <?php echo form_close(); ?>
                    <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 2px 2px" id="msg_"><?php echo $this->session->flashdata('feed_msg_'); ?></div>
            </div>
        </div>
</div>