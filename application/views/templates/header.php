<!DOCTYPE html>
<html lang="en">
    <head>
        <title>School ERP Software: Teamfreelancers</title>
        <script>
            site_url_ = <?PHP echo '"' . site_url() . '"'; ?>;
            base_url_ = <?PHP echo '"' . base_url() . '"'; ?>;
            <?php if($this->session->userdata('_current_year___')){?>
                _current_year___ = <?php echo '"'.$this->session->userdata('_current_year___').'"'; ?>;
                _previous_year___= <?php echo '"'.$this->session->userdata('_previous_year___').'"'; ?>;
            <?php } else { ?>
                _current_year___ = '1000'
                _previous_year___= '999';
            <?php } ?>
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-responsive.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/bootstrap-wysihtml5.css'); ?>" />
        <link href="<?php echo base_url('assets_/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/fullcalendar.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/jquery.easy-pie-chart.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/jquery.gritter.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-style.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/matrix-media.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/select2.css');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets_/css/uniform.css');?>" />
    </head>
    <body>

        <!--Header-part-->
        <div id="header">
            <h1><a href="#">School <span>ERP</span></a></h1>
        </div>
        <!--close-Header-part--> 
        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome User</span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('login/logout');?>"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>                
                <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
                <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        <!--close-top-Header-menu-->

        <!--start-top-serch-->
        <div id="search">
            <input type="text" placeholder="Search here..."/>
            <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
        </div>
        <!--close-top-serch-->