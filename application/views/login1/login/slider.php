<html>
  <head>
  <title>Dir Home Page</title>
   <link id="switcher" rel="stylesheet" href="<?php echo base_url('adminast');?>/assets/css/slick.css">
  <link id="switcher" rel="stylesheet" href="<?php echo base_url('adminast');?>/assets/css/defualt_theme.css">
 	 <link href="<?php echo base_url('assets');?>/css/bootstrap.min.css" rel="stylesheet">
		 <link href="<?php echo base_url('assets/font-awesome');?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
          <link href="<?php echo base_url('assets');?>/css/animate.css" rel="stylesheet" type="text/css">
          <link href="<?php echo base_url('assets');?>/css/custom.css" rel="stylesheet" type="text/css">
       <link rel="stylesheet" href="<?php echo base_url('assets/css/icons/font-awesome/css/fontawesome-all.css');?>" >
	   <link rel="stylesheet" href="<?php echo base_url('assets/libs/flot/css/float-chart.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/font-awesome/css/fontawesome-all.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/themify-icons/themify-icons.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/material-design-iconic-font/css/materialdesignicons.min.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/libs/flot/css/float-chart.css');?>" >
      <!-- Custom CSS -->
		<script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"> </script>
    <!-- Bootstrap tether Core JavaScript -->
	<script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"> </script>
    <!-- Bootstrap tether Core JavaScript -->
	 <script src="<?php echo base_url('assets/libs/popper.js/dist/umd/popper.min.js'); ?>"> </script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"> </script>
	<script src="<?php echo base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js'); ?>"> </script>
    <script src="<?php echo base_url('assets/extra-libs/sparkline/sparkline.js'); ?>"> </script>
    <!--Wave Effects -->
	<script src="<?php echo base_url('assets/js/waves.js'); ?>"> </script>
  
    <!--Custom JavaScript -->
	<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"> </script>
	   <!--Custom JavaScript -->
	  </head>
  <body>
  <div class="body-wrapper">
			<section class="header" id="overlay-1">
				<div class="header-wrapper">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center">
								<div class="theme-name">
									
								</div>
							</div>
						</div>
						
                           <div class="row">
							<div class="col-md-12 text-center">
								<div class="header-text">
								<h5><p class="coming"></p></h5>
								<marquee><p class="service-text">WELCOME TO SINGLE SIGN ON</p></marquee>
								 
		<?php  $type	=$this->session->userdata('login'); 
		if ($type=='sso') { ?>
			<p class="service-text"><a href="<?php echo base_url('Login');?>"><i class="fa fa-hand-o-right faa-horizontal animated" ></i>IT Aplication</a></p>
		
            <?php   } elseif ($type=='dgdash') { ?>
			<p class="service-text"><a href="<?php echo base_url('Dirhome/ssohome');?>"><i class="fa fa-hand-o-right faa-horizontal animated" ></i>IT Aplication</a></p>
		<?php   } ?>
		<i class="fa fa-hand-o-right" aria-hidden="true"></i> <p class="service-text"><a href="<?php echo base_url('../dgdashboard/Userdashboard');?>"><i class="fa fa-hand-o-right faa-horizontal animated" ></i>DG Dashboard</a></p>								
							</div>
								
							</div>
						</div>
						<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                         <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                              
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
						<div class="row">
						
  <div class="autoplay" id="switcher">
      <?PHP  foreach ($sum as $row)
		
		  {  ?>
    <div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">first On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
    <div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">first On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
    <div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">first On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
	<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">first On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
	<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">secondary On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
	<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">secondary On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
	<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">secondary On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
	<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">secondary On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
					<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">check On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
					<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">check On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
					<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">check On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
					<div><div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">check On Leave!</h6></a>
                            </div>
                        </div>
                    </div></div>
		<?PHP   }
					  ?>
  </div> </div></div></div>
						
  </section>
			
			<!--   end of footer section  -->
		</div>
        <script src="<?php echo base_url('assets/js/jquery.js'); ?>"> </script>
			<script src="<?php echo base_url('assets/js/bootstrap.min-comming.js'); ?>"> </script>
			<script src="<?php echo base_url('assets/js/timer.js'); ?>"> </script>
			<script src="<?php echo base_url('assets/js/script.js'); ?>"> </script>
 	
 <script src="http://[::1]/test/adminast/assets/js/jquery1.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="http://[::1]/test/adminast/assets/js/slick.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.autoplay').slick({
  slidesToShow: 4,
  slidesToScroll: 4,
  autoplay: true,
  autoplaySpeed: 1000,
});
    });
  </script>

  </body>
</html>
		