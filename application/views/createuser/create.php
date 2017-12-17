<style>
    .update_color{
        color: #FF5733;
    }
</style>
<div class="row-fluid">
    <?php
        $attrib_ = array(
            'class' => 'form-horizontal',
            'name' => 'frmUserManagement',
            'id' => 'frmUserManagement',
        );
        echo form_open('#', $attrib_); 
    ?>
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5><?php echo $title_;?></h5>
            </div>
            <div class="widget-content create-update-user-form">
            	<div class="control-group">
                    <label class="control-label">Status For</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbUserStatus',
                                'id' => 'cmbUserStatus',
                                'required' => 'required',
                                'class' => 'span12'
                            );
                            $options = array();
                            $options[''] = 'Select User Status';
                        ?>
                        <?php echo form_dropdown($data, $options, ''); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Associates</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbStaff',
                                'id' => 'cmbStaff',
                                'required' => 'required',
                                'class' => 'span12'
                            );
                            $options = array();
                            $options[''] = 'select Member';
                        ?>
                        <?php echo form_dropdown($data, $options, ''); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">username</label>
                    <div class="controls">
                        <?php
                            $data = array(
                            	'type' => 'text',
                                'name' => 'txtUser_',
                                'id' => 'txtUser_',
                                'required' => 'required',
                                'class' => 'span12' 
                            );
                        echo form_input($data); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <?php
                            $data = array(
                            	'type' => 'password',
                                'name' => 'txtPwd_',
                                'id' => 'txtPwd_',
                                'required' => 'required',
                                'class' => 'span12',
                                'value' =>'123456'
                            );
                        echo form_input($data); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" value="Create" class="btn btn-success create-new-user" id="create_update_user">
                        <input type="reset" value="Cancel" class="btn btn-default" id="resetCreateUser">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Existing Users</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>                            
                            <th style='text-align: left'>User</th>
                            <th style='text-align: left'>Associates</th>
                            <th style='text-align: left'>Status</th>
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="view_users_in_createUserMgnt"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>