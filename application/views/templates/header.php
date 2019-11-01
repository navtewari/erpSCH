<!DOCTYPE html>
<html lang="en">
    <head>
        <title>School ERP Software: Teamfreelancers</title>
        <script>
            site_url_ = <?PHP echo '"' . site_url() . '"'; ?>;
            base_url_ = <?PHP echo '"' . base_url() . '"'; ?>;

            _img_folder_ = <?php echo '"' . $this->session->userdata('db2') . '"'; ?>;
            <?php if ($this->session->userdata('_current_year___')) { ?>
                _current_year___ = <?php echo '"' . $this->session->userdata('_current_year___') . '"'; ?>;
                _previous_year___ = <?php echo '"' . $this->session->userdata('_previous_year___') . '"'; ?>;
            <?php } else { ?>
                _current_year___ = '1000';
                _previous_year___ = '999';
            <?php } ?>
            _abbrev_ = <?php echo '"' . $this->session->userdata('_abbrev_') . '"';?>;
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-responsive.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-wysihtml5.css'); ?>" />
        <link href="<?php echo base_url('assets_/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/fullcalendar.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/jquery.easy-pie-chart.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/jquery.gritter.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-style.css'); ?>?ver=1.2" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-media.css'); ?>" />        
        <?php
        $callSelect2 = 0;
        if (strpos($_SERVER['REQUEST_URI'], 'classes') == false) {
            $callSelect2++;
        }
        if (strpos($_SERVER['REQUEST_URI'], 'promotestudent') == false) {
            $callSelect2++;
        }        
        if ($callSelect2 == 2){            
            ?>
            <link rel="stylesheet" href="<?php echo base_url('assets_/css/select2.css'); ?>?version=<?php echo JS_VERSION_NAVEEN; ?>" />                      
        <?php         
        }else{
                $callSelect2 = 0;
        }
        ?>                                        

        <link rel="stylesheet" href="<?php echo base_url('assets_/css/datepicker.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/uniform.css'); ?>" />
        <link  rel="stylesheet" href="<?PHP echo base_url() . 'assets_/multiSelect/css/style.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/mycss.css'); ?>?version=<?php echo JS_VERSION_NITIN; ?>" />
        <style>
            .page-loader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url(<?php echo base_url('assets_/img/page-loader.gif'); ?>) 50% 50% no-repeat rgb(249,249,249);
                opacity: .8;
            }
        </style>
    </head>
    <body id="doc__">
        <div class="page-loader"></div>
        <div style="text-align: center; width: 100%">
            <div id="loading_process" style="font-weight: bold; font-family: verdana; display: inline-block; opacity: 0; left:auto; right: auto; position: fixed; min-width: 100px; width: auto; height: auto; border-radius: 5px; padding: 5px; background: #F0F0F0; border: #808080 dotted 1px; color: 000000; margin-top: 2%; z-index: 99999"></div>
        </div>
        <!--Header-part-->
        <div id="header">
            <h1><a href="#">School <span style="color: #cccccc">ERP</span></a></h1>
        </div>
        <!--close-Header-part--> 
        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $this->session->userdata('_name_'); ?></span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('c_pwd'); ?>"><i class="icon-check"></i> Change Password</a></li>
                        <li class="divider"></li>
                        <?php if ($this->session->userdata('_status_') == 'adm') { ?>
                            <li class=""><a title="" href="<?php echo site_url('web/dashboard/2/9/general'); ?>"><i class="icon icon-edit"></i> <span class="text">Change School Profile</span></a></li>                                           
                            <li class="divider"></li>
<?php } ?>
                        <li><a href="<?php echo site_url('exporting/backup'); ?>"><i class="icon-envelope-alt"></i> Take Backup</a></li>                                               
                    </ul>
                </li>                                                              
                <li class=""><a title="" style="color: #00ffff" href="<?php echo site_url('login/logout'); ?>"><i class="icon icon-key"></i> <span class="text">&nbsp;Log-out?</span></a></li>
                <li class=""><a title="" style="color: #ffff00"><i class="icon icon-calendar"></i> <span class="text"> &nbsp;Session <?php echo $this->session->userdata('_current_year___'); ?></span></a></li>
                <li class=""><a title="Transfer Certificate/ Character Certificate" href="<?php echo site_url('web/dashboard/1/29/tccc');?>" style="color: #ffff00"><i class="icon icon-calendar"></i> <span class="text">TC/ CC</span></a></li></a>
            </ul>
            <?php if ($this->session->userdata('bckup')) { ?>
                <div style="margin-left: auto; margin-right: auto;border: #A0A0A0 dotted 1px; display: inline-block; position: absolute; top: 45px; background: #F7E563; color:#625600; padding: 0px 5px; border-radius: 5px; width: 80%"><?php echo $this->session->userdata('bckup'); ?><a href="#" onclick="$(this).parent().remove();" style="float: right"><span class="label label-important">X</span></a>
                </div>
    <?php $this->session->unset_userdata('bckup');
} ?>
        </ul>
    </div>
    <!--close-top-Header-menu-->

    <!--start-top-serch-->
    <div id="search">
        <form name="frmStudentInfoSearch" id="frmStudentInfoSearch" method="post" action="<?php echo site_url('reports/getStudentInfo'); ?>">
            <input type="text" placeholder="Search here..." name="txtSearchID" id="txtSearchID" required="required" />
            <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
        </form>
    </div>
    <!--close-top-serch-->
