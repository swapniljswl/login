<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php $user_data=unserialize($this->session->dguser);
           $user_name = $user_data[0]->email;
           $usertype = $user_data[0]->typeuser; ?>
<head>
    <meta charset="utf-8">
	<?php header('X-Frame-Options: DENY'); 
		 header("X-XSS-Protection: 1; mode=block"); 
		 header('X-Content-Type-Options: nosniff'); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets');?>/images/favicon.png" >
    <title>DG Dashboard</title>
    <!-- Custom CSS -->
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
    
	        </head>

<body>
   <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
