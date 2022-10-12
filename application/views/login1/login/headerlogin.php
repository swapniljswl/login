<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

		<title>Single Sign on@RDSO </title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<?php header('X-Frame-Options: DENY'); 
		 header("X-XSS-Protection: 1; mode=block"); 
		 header('X-Content-Type-Options: nosniff'); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link href="<?php echo base_url('assets');?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets');?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminast/assets/css/print.css" type="text/css" media="print"/> 
		 <script>  
           var base_addr="<?php echo base_url();?>";
            var csrf_token="<?php echo $this->lib_csrf->get_csrf_hash(); ?>";
        </script>
         
		<div class="login-container">
							<div class="center">
							
							<h3 class="blue" id="id-company-text">
									<span align="center" class="red">Welcome To RDSO IT Service Portal </br> <h4>आरडीएसओ आईटी सेवा पोर्टल में आपका स्वागत है</h4></span>
								
								</h3>
							</div>
	 
	</head>
       	<body class="login example2">
		<div class="main-login col-sm-4 col-sm-offset-4">
		