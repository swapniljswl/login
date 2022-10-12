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
                                <span class="hidden-xs"><h4 class="m-t-15">Single Sign On for IT Application <br>आईटी एप्लीकेशन के लिए सिंगल साइन ऑन </h4></span>
                                <!-- <span class="visible-xs"><h2>Single Sign On</h2></span> -->
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
							<?php  $user_data=unserialize($this->session->user);
							        $user_name = $user_data[0]->name;
							        $user=unserialize($this->session->secret);	                              
								   $usertype = $user[0]->role; 
								   if ($usertype=='4'){ $user='Directorate Admin';}
								   elseif ($usertype=='2'){ $user='Sub Admin';} 
								   elseif ($usertype=='3'){ $user='Admin';}
								   elseif ($usertype=='5'){ $user='Profile Admin';}
								   elseif ($usertype=='6'){ $user='Family Admin';}
								   elseif ($usertype=='7'){ $user='';}
								   elseif ($usertype=='8'){ $user='';}
								  ?>
							 <li id="google_translate_element"></li>
					        <li>
							
							<?php echo 'Welcome ';echo  $user ; echo '! '; echo $user_name;?>
							<a style="color:red;" href="<?php echo base_url('user_login/logout'); ?>"> <i  class="ti-power-off m-r-5"></i> Log Out</a>
							
							</li>
                          
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
                        <?php      
                        function design_menu(& $menu,$mlft=Null,$mrght=Null,$parent='Accordion')
                        { 
                           $menu_html='';
                           static $level=1; 
                           foreach ($menu as &$menu_item)
                           { 
       //echo '<br>'.$menu_item['title'].'   '.$menu_item['flag'].'<br>';
                              if (!($menu_item['flag']=='Y'))
                              { 
        //echo '<br>1.Item selected<br>';
        //echo 'menu_left='.$mlft.' menu_right='.$mrght.'<br>';
        //var_dump($menu_item);
                                $lft=$menu_item['lft'];
                                $rght=$menu_item['rght'];
                                if($mlft!=Null){
                                 if(($lft-1)==$mrght){
            //echo '<br>exiting loop<br>';
                                    break;
                                }
                                if (!($lft>$mlft && $rght<$mrght))
                                {
            //echo '<br>2.Item not processed<br>';
                                    continue;
                                }


                            }

                            $child=($rght-$lft-1)/2;
                            if($child)
                            {
          //echo '<br>3.Item has children.<br>';
                              $level++;
                              $menu_html=$menu_html.'<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect">';
                              if(!empty($menu_item['icon']))
                                $menu_html=$menu_html.'<i class="'.$menu_item['icon'].'"></i>';
                              $menu_html=$menu_html.'<span>'.$menu_item['title'].'</span><span class="menu-arrow"></span></a>';
                              
                            $menu_html=$menu_html."<ul class=\"list-unstyled\" id=\"".$menu_item['menu_name'].'">';
                            $menu_html=$menu_html.design_menu($menu,$lft,$rght,$menu_item['menu_name']);
                            $menu_html=$menu_html.'</ul></li>';
                            $level=$level-1;

                        }
                        else
                        {
          //echo '<br>4.Item has no child.<br>';
                          $menu_html=$menu_html.'<li>';
                          $menu_html=$menu_html.'<a href="'. base_url($menu_item['path']).'">';
                          if (!empty($menu_item['icon']))
                            $menu_html=$menu_html.'<i class="'.$menu_item['icon'].'"></i>';
                          $menu_html=$menu_html.'<span>'.$menu_item['title'].'</span></a></li>';
                      }
                      $menu_item['flag']='Y';

      //echo $menu_html;
                  }


              }

              return $menu_html;
          }

          echo design_menu($menu);

          ?>
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
