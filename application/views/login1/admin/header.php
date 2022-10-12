<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets');?>/images/favicon.ico">
        <!-- App title -->
        <title>SSO-Single Sign On@RDSO</title>

        <!-- App css -->
        <link href="<?php echo base_url('assets');?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets');?>/css/ovcs.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets');?>/plugins/switchery/switchery.min.css">

        <!--Datatables-->
        <link href="<?php echo base_url('assets'); ?>/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets'); ?>/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script>  
           var base_addr="<?php echo base_url();?>";
            var csrf_token="<?php echo $this->lib_csrf->get_csrf_hash(); ?>";
        </script>


        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
         <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"> </script>

        <script src="<?php echo base_url('assets');?>/js/modernizr.min.js"></script>
         <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"> </script>
         <script src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js'); ?>"> </script>
    </head>


    <body class="fixed-left">
        
        <!-- dialog boxes -->
        <div class="modal fade" id="confirm_dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title title"></h4>
            </div>
            <div class="modal-body body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary ok" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="alert_dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title title">Attention!!!</h4>
        </div>
        <div class="modal-body body">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default close" data-dismiss="modal" data-toggle="modal">Close</button>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="info_dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title title">Message</h4>
        </div>
        <div class="modal-body body">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
    <!-- End of Dialog Boxes -->
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?php echo base_url('Home'); ?>" class="logo"><span>s<span>s</span>o</span><i class="mdi mdi-layers"></i></a>
                    <!-- Image logo -->
                    <!--<a href="index.html" class="logo">-->
                        <!--<span>-->
                            <!--<img src="<?php echo base_url('assets');?>/images/logo.png" alt="" height="30">-->
                        <!--</span>-->
                        <!--<i>-->
                            <!--<img src="<?php echo base_url('assets');?>/images/logo_sm.png" alt="" height="28">-->
                        <!--</i>-->
                    <!--</a>-->
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <span class="hidden-xs"><h2 class="m-t-20">Single Sign On</h2></span>
                                <span class="visible-xs"><h2>Single Sign On</h2></span>
                            </li>
                            
                        </ul>

                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">
                          

                            <!-- <li>
                                <a href="javascript:void(0);" class="right-bar-toggle right-menu-item">
                                    <i class="mdi mdi-settings"></i>
                                </a>
                            </li> -->

                             <!-- <li class="dropdown user-box">
                                 <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true"> -->
                                   <!--  <img src="<?php echo base_url('assets');?>/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img"> -->
                                  <!--  <span style="font-size:25px; ">
                                   <i class="mdi mdi-account-circle"></i></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list"> -->
                                    <!-- <li>
                                        <h5>Hi, John</h5>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li> -->
                                    
                                   <!--  <li><a href="#" onClick="event.preventDefault();"><?php //echo $user_info->name.'/'.$user_info->desig_desc;?></a></li>
                                   
                                </ul> -->
                            <!-- </li> -->
							
					       <li ><a style="color:red;" href="<?php echo base_url('user_login/logout'); ?>"><i  class="ti-power-off m-r-5"></i> Exit Application</a></li>
                            <li><a href="#" class="right-bar-toggle m-t-10"><?php //echo 'Welcome ';echo  $user ; echo '! '; echo $user_name;?>  </a></li>
                           
                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul id="Accordion">
                      <li class="menu-title">Navigation</li>
                      <li><a href="<?php echo base_url('Dirhome/ssohome'); ?>"><i class="mdi mdi-view-dashboard"></i><span>Home</span></a></li>
					  <li><a href="<?php echo base_url('../dgdashboard/Userdashboard'); ?>"><i class="mdi mdi-view-dashboard"></i><span>Dg Dashboard</span></a></li>
					  <li class="has_sub"> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span>User Management</span><span class="menu-arrow"></span></a><ul class="list-unstyled" id="User Management">
					  <li><a href=" <?php echo base_url('Userverify'); ?> "><span>User Verification</span></a></li>
					  <li><a href="<?php echo base_url('Userreject'); ?>"><span>Verified/Rejected User</span></a></li>
					  </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                    <div class="help-box">
                        <h5 class="text-muted m-t-0">For Help ?</h5>
                        <p class=""><span class="text-custom">Email:</span> <br/></p>
                        <p class="m-b-0"><span class="text-custom">Call:</span> (Rly)42184,42183,42995</p>
                    </div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
              <div class="content-page">
