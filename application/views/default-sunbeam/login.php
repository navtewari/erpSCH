<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View Result</title>
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
    <body id="doc__" style="margin-top: 4% !important">
        <div class="page-loader"></div>
        <div id="loginbox">            
            <div class="control-group normal_text" style="margin-right: 25px; margin-bottom: 10px;">
            <div style="float: left; font-size: 10px; font-weight: bold"></div>
            <a href="https://www.thesunbeamschool.com/" style="padding: 1px 0px; border-top-left-radius: 10px; border-top-right-radius: 10px; background: #ff0000; width: 30px; height: 30px; color: #ffffff; font-weight: bold; float:right;"/><i class="icon-remove"></i></a>
        </div>
            <?php
            $attrib_ = array(
                'class' => 'form-vertical',
                'name' => 'loginform',
                'id' => 'loginform',
            );
            ?>
            <?php echo form_open('Exam/fetchResult', $attrib_); ?>
            <div class="control-group normal_text"> 
                <h3>View Result</h3>
                <h6>
                    <?php echo $this->session->userdata('sch_name'); ?>, <?php echo $this->session->userdata('sch_city'); ?>
                </h6>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lo"><i class="icon-calendar"></i></span>
                        <?php
                        $data = array(
                            'name' => 'classSessHiddenID',
                            'id' => 'classSessHiddenID',
                            'required' => 'required'
                        );
                        $options = array();
                        $options[''] = 'Select Class';
                        foreach ($class_in_session as $i) {
                                $options[$i->CLSSESSID] = $i->CLASSID;
                        }
                        echo form_dropdown($data, $options, '');
                        ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="stuHiddenID" id="stuHiddenID" placeholder="Enter Password here" required="required" />
                        <input type="hidden" value="1" name="reportLayout" id="reportLayout">
                        <input type="hidden" value="2" name="sideLayout" id="sideLayout">
                    </div>
                </div>
            </div>
            <div class="form-actions">                
                <input type="submit" class="btn btn-success" value="Show Result" style="width:40%;float:left; margin-left:18px;"/>           
                <input type="reset" class="btn btn-danger" value="Cancel" style="width:30%;float:right;margin-right: 18px;"/> 
            </div> 
            <?php echo form_close();?>
            <div class="control-group" style="padding: 0px; color: #ffffff">
                <h6 style="text-align: center;">
                </h6>
            </div>
    </div>

    <script src="<?php echo base_url('assets_/js/jquery.min.js'); ?>"></script>  
    <script src="<?php echo base_url('assets_/js/matrix.login.js'); ?>"></script>
    <script src="<?php echo base_url('assets_/js/masked.js');?>"></script>  
    <script src="<?php echo base_url('assets_/js/myjs.js'); ?>"></script> 
    <script type="text/javascript">
        $('#classSessHiddenID').change(function(){
            if($('#classSessHiddenID option:selected').text() >=1 && $('#classSessHiddenID option:selected').text() <=8){
                $('#reportLayout').val('1');
            } else if($('#classSessHiddenID option:selected').text() == 9) {
                $('#reportLayout').val('2');
            } else if ($('#classSessHiddenID option:selected').text() == 11) {
                $('#reportLayout').val('4');

            }
        });
    </script>
</body>

</html>
