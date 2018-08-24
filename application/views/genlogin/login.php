<!DOCTYPE html>
<html lang="en">
    <head>
        <title>School ERP</title>
        <script>
            site_url_ = <?PHP echo '"' . site_url() . '"'; ?>;
            base_url_ = <?PHP echo '"' . base_url() . '"'; ?>;
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-responsive.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-login.css'); ?>" />
        <link href="<?php echo base_url('assets_/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <style>
        .page-loader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url(<?php echo base_url('assets_/img/page-loader.gif');?>) 50% 50% no-repeat rgb(249,249,249);
                opacity: .8;
            }
        </style>
    </head>
    <body id="doc__">
        <div class="page-loader"></div>
        <div id="loginbox">            
            <?php
            $attrib_ = array(
                'class' => 'form-vertical',
                'name' => 'GENloginform',
                'id' => 'GENloginform',
            );
            ?>
            <?php echo form_open('gen_login/checking', $attrib_); ?>
            <div class="control-group normal_text"> <h3>School ERP</h3></div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="txtUser__" id="txtUser__" placeholder="Username" required="required" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="txtPwd__" id= "txtPwd__" placeholder="Password" />
                    </div>
                </div>
            </div>
            <div class="form-actions">                
                <input type="submit" class="btn btn-success" value="LOGIN" style="width:40%;float:left; margin-left:18px;"/>
                <input type="reset" class="btn btn-danger" value="RESET" style="width:30%;float:right;margin-right: 18px;"/>               
            </div> 
            <?php echo form_close();?>
    </div>

    <script src="<?php echo base_url('assets_/js/jquery.min.js'); ?>"></script>  
    <script src="<?php echo base_url('assets_/js/matrix.login.js'); ?>"></script> 
    <script src="<?php echo base_url('assets_/js/masked.js');?>"></script> 
    <script src="<?php echo base_url('assets_/js/myjs.js'); ?>"></script> 
</body>

</html>
