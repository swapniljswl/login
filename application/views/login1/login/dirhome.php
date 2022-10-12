<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>WELCOME TO SINGLE SIGN ON</title>
		
		<!-- css -->
		
		<!--  google fonts  -->
		 <link id="switcher" rel="stylesheet" href="<?php echo base_url('adminast');?>/assets/css/slick.css">
  <link id="switcher" rel="stylesheet" href="<?php echo base_url('adminast');?>/assets/css/defualt_theme.css">
		 <link href="<?php echo base_url('assets');?>/css/bootstrap.min.css" rel="stylesheet">
		 <link href="<?php echo base_url('assets/font-awesome');?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
          <link href="<?php echo base_url('assets');?>/css/animate.css" rel="stylesheet" type="text/css">
          <link href="<?php echo base_url('assets');?>/css/custom.css" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="<?php echo base_url('assets/libs/flot/css/float-chart.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/font-awesome/css/fontawesome-all.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/themify-icons/themify-icons.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icons/material-design-iconic-font/css/materialdesignicons.min.css');?>" >
	<link rel="stylesheet" href="<?php echo base_url('assets/libs/flot/css/float-chart.css');?>" >
    
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style1.min.css');?>" >
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
    <!--Menu sidebar -->
	<script src="<?php echo base_url('assets/js/sidebarmenu.js'); ?>"> </script>
    <!--Custom JavaScript -->
	<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"> </script>
	  <script src="<?php echo base_url(); ?>adminast/assets/js/slick.min.js"></script>
	</head>
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
						

						<!--  begin of counter  -->
                      <div class="row">
							<div class="col-md-12 text-center">
								<div class="header-text">
								<h5><p class="coming"></p></h5>
								<marquee><p class="service-text">WELCOME TO SINGLE SIGN ON</p></marquee>
								 
		<?php  $type	=$this->session->userdata('login'); 
		if ($type=='sso') { ?>
			<p class="service-text" style="color:white;"><a style="color:white;" href="<?php echo base_url('Login');?>"><i class="fa fa-hand-o-right faa-horizontal animated" ></i>IT Aplication</a></p>
		
            <?php   } elseif ($type=='dgdash') { ?>
			<p class="service-text" ><a style="color:white;" href="<?php echo base_url('Dirhome/ssohome');?>"><i class="fa fa-hand-o-right faa-horizontal animated" ></i>IT Aplication</a></p>
		<?php   } ?>
	 <p class="service-text" ><a  style="color:white"; href="<?php echo base_url('../dgdashboard/Userdashboard');?>"><i class="fa fa-hand-o-right faa-horizontal animated" ></i>DG Dashboard</a></p>								
							</div>
								
							</div>
						</div>
						   <?PHP  foreach ($sum as $row)
		
		  {  ?>
		 <div >	
					
		 
						  <div class="autoplay" id="switcher">
						
                     <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                           <div class="box bg-danger text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->top) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">High Priority Letter!</h6></a>
                            </div>
                        </div>
                    </div>
 	<div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                           <div class="box bg-warning text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->medium) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->medium ;?>&nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">Medium Priority Letter!</h6></a>
                            </div>
                        </div>
                    </div>
    	<div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                           <div class="box bg-success text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->low) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->low ;?>&nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">Normal Priority Letter!</h6></a>
                            </div>
                        </div>
                    </div>
     <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
							<a class="nav-link" href="<?php //echo base_url('Topletter');?>">
                               <?php if (count($row->all) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->all ;?>&nbsp;&nbsp;<i class="fa fa-envelope"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa  fa-envelope"></i></h1>
                             	<?php }  ?> 
                          	   <h6 class="text-white">All Open letter!</h6></a>
                            </div>
                        </div>
                  </div >	
	
 
	<?PHP   }
		 foreach ($prosum as $row)
		
		  {  ?> 

					    <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
						<div class="box bg-danger text-center">
						 <?php if ($row->top > 0) { ?>
						    <a class="nav-link" href="<?php //echo base_url('Topprojectuser');?>"><?php }
                              else {								  ?>
							   <a class="nav-link" href="<?php //echo base_url('');?>">
							  <?php } ?>
						        <h1 class="font-light text-white"><?php echo $row->top ;?>&nbsp;&nbsp;<i class="far fa-chart-bar"></i></h1>
                                <h6 class="text-white">High Priority Projects!</h6></a>
                            </div>
                        </div>
						
                    </div>
                    <!-- Column -->
                  <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
						 <div class="box bg-warning text-center">
						 <?php if ($row->medium > 0) { ?>
						    <a class="nav-link" href="<?php //echo base_url('Mediumprojectuser');?>"><?php }
                              else {								  ?>
							   <a class="nav-link" href="<?php //echo base_url('');?>">
							  <?php } ?>
                                <h1 class="font-light text-white"><?php echo $row->medium ;?>&nbsp;&nbsp;<i class="far fa-chart-bar"></i></h1>
                                <h6 class="text-white">Medium Priority Projects!</h6></a>
                            </div>
                        </div>
						
                    </div>
                     <!-- Column -->
                    <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                           <div class="box bg-success text-center">
						   <?php if ($row->low > 0) { ?>
						    <a class="nav-link" href="<?php // echo base_url('Lowprojectuser');?>"><?php }
                              else {								  ?>
							   <a class="nav-link" href="<?php //echo base_url('');?>">
							  <?php } ?>
                                <h1 class="font-light text-white"><?php echo $row->low ;?>&nbsp;&nbsp;<i class="far fa-chart-bar"></i></h1>
                                <h6 class="text-white">Normal Priority Projects!</h6></a>
                            </div>
                        </div>
						
                    </div>
                    <!-- Column -->
                    <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
							<?php if ($row->alll > 0) { ?>
							<a class="nav-link" href="<?php //echo base_url('Allprojectuser');?>"> <?php }
							else {								  ?>
							   <a class="nav-link" href="<?php //echo base_url('');?>">
							  <?php } ?>
                                <h1 class="font-light text-white"><?php echo $row->alll ;?>&nbsp;&nbsp;<i class="far fa-chart-bar"></i></h1>
                                <h6 class="text-white">All Open Projects!</h6></a>
                            </div>
                        </div>
						
                    </div>
		  <?php }  foreach ($levsum as $row)
		
		  {  ?> 
<div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-dark text-center">
							<a class="nav-link" href="<?php //echo base_url('Edleave/edleaveuser');?>">
							<?php if (count($row->edleave) > 0)
							{ ?>
                                <h1 class="font-light text-white"><?php echo $row->edleave ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 						   
								<h6 class="text-white">Exec. Director On Leave!</h6></a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                       <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Dirleave/dirleaveuser');?>">
							<?php if (count($row->dleave) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->dleave ;?>&nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                                
                          	   <h6 class="text-white">Director On Leave!</h6></a>
                            </div>
                        </div>
                    </div>
						<?PHP   }
					 foreach ($toursum as $row)
		
		  {  ?>
                     <!-- Column -->
                  <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-primary text-center">
							 <a class="nav-link" href="<?php //echo base_url('Edtour/edtouruser');?>">
							 <?php if (count($row->edtour) > 0)
							{ ?>
                            <h1 class="font-light text-white"><?php echo $row->edtour ;?>&nbsp;&nbsp;<i class="mdi mdi-view-dashboard"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                                
                               <h6 class="text-white">Exec. Director On Tour!</h6></a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                 
				<div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
							<a class="nav-link" href="<?php //echo base_url('Dirtour/dirtouruser');?>">
							 <?php if (count($row->dtour) > 0)
							{ ?>
                           <h1 class="font-light text-white"><?php echo $row->dtour ;?>&nbsp;&nbsp;<i class="mdi mdi-collage"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="mdi mdi-home"></i></h1>
                             	<?php }  ?> 
                               
                             <h6 class="text-white">Director On Tour!</h6></a>
                            </div>
                        </div>
                    </div>	
				
		  <?php } ?>
<?php   foreach ($comapp as $row)
		
		  {  ?> 
<div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-dark text-center">
							<a class="nav-link" href="<?php //echo base_url('Edleave/edleaveuser');?>">
							<?php if (count($row->register1) > 0)
							{ ?>
                                <h1 class="font-light text-white"><?php echo $row->register1 ;?>&nbsp;&nbsp;<i class="fa fa-users"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-users"></i></h1>
                             	<?php }  ?> 						   
								<h6 class="text-white">Registered Users!</h6></a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                       <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
							<a class="nav-link" href="<?php //echo base_url('Dirleave/dirleaveuser');?>">
							<?php if (count($row->verify1) > 0)
							{ ?>
                               <h1 class="font-light text-white"><?php echo $row->verify1 ;?>&nbsp;&nbsp;<i class="fa fa-users"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-users"></i></h1>
                             	<?php }  ?> 
                                
                          	   <h6 class="text-white">Verified Users!</h6></a>
                            </div>
                        </div>
                    </div>
						
                     <!-- Column -->
                  <div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-primary text-center">
							 <a class="nav-link" href="<?php //echo base_url('Edtour/edtouruser');?>">
							 <?php if (count($row->reject1) > 0)
							{ ?>
                            <h1 class="font-light text-white"><?php echo $row->reject1 ;?>&nbsp;&nbsp;<i class="fa fa-users"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-users"></i></h1>
                             	<?php }  ?> 
                                
                               <h6 class="text-white">Rejected Users!</h6></a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                 
				<div class="col-md-3 col-lg-2 col-xlg-2">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
							<a class="nav-link" href="<?php //echo base_url('Dirtour/dirtouruser');?>">
							 <?php if (count($row->active1 ) > 0)
							{ ?>
                           <h1 class="font-light text-white"><?php echo $row->active1  ;?>&nbsp;&nbsp;<i class="fa fa-users"></i></h1>
							<?php } else { ?>  
                               <h1 class="font-light text-white">0 &nbsp;&nbsp;<i class="fa fa-users"></i></h1>
                             	<?php }  ?> 
                               
                             <h6 class="text-white">Active Users!</h6></a>
                            </div>
                        </div>
                    </div>	
				<!---	<div class="col-md-6 col-lg-4 col-xlg-3">
					     <div class="card card-hover">
						    <div class="box bg-dark text-center">
							 <a class="nav-link" href="<?php echo base_url('Allleavetour/Allleavetouruser');?>">
                                <h1 class="font-light text-white"><?php echo $row->alll ;?>&nbsp;&nbsp;<i class="mdi mdi-arrow-all"></i></h1>
                                <h6 class="text-white">All Officer <br> Leave or Tour</h6></a>
                            </div>
                        </div>
                    </div> -->
					</div>
		  <?php } ?>		  
  </div>
			</section>
			
			<!--   end of footer section  -->
		</div>
	
		<!--  js files -->

		<!--  js files -->
            <script src="<?php echo base_url('assets/js/jquery.js'); ?>"> </script>
			<script src="<?php echo base_url('assets/js/bootstrap.min-comming.js'); ?>"> </script>
			<script src="<?php echo base_url('assets/js/timer.js'); ?>"> </script>
			<script src="<?php echo base_url('assets/js/script.js'); ?>"> </script>
		
  <script src="<?php echo base_url('adminast')?>/assets/js/slick.min.js"></script>
	
	</body>
</html>
 <script type="text/javascript">
    $(document).ready(function(){
      $('.autoplay').slick({
  slidesToShow: 4,
  slidesToScroll: 4,
  autoplay: true,
  autoplaySpeed: 3000,
});
    });
  </script>