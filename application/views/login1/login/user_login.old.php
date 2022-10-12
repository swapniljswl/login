 <script type="text/javascript">  
            window.onbeforeunload = function()  
            {  
                var inputs = document.getElementsByTagName("INPUT");  
                for (var i = 0; i < inputs.length; i++)  
                {  
                    if (inputs[i].type == "button" || inputs[i].type == "submit")  
                    {  
                        inputs[i].disabled = true;  
                    }  
                }  
            };  
        </script>
<?php include 'headerlogin.php'; ?>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3>Sign in </h3>
				<?php echo form_open('user_login/login'); ?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> 

					</div>
					<fieldset>
					<?php   $message = $this->session->flashdata('login_failed');
if (isset($message)) {
 echo '<div class="alert alert-info">' . $message . '</div>';
 $this->session->unset_userdata('message');
}
   $message = $this->session->flashdata('feedback');
                 if (isset($message)) {
                  echo '<div class="alert alert-info">' . $message . '</div>';
                   $this->session->unset_userdata('message');
                   }

 $message = $this->session->flashdata('email_sent');
if (isset($message)) {
 echo '<div class="alert alert-info">' . $message . '</div>';
 $this->session->unset_userdata('message');
}
  ?> 
						<div class="form-group" >Emp No/Unique Id
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'username','placeholder'=>'Emp No/ Unique Id','class'=>'form-control','maxlength'=>'12' ));?>	
                                 <?php echo form_error('username',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">Password
							<span class="input-icon">
								<?php  echo form_password(array('name'=>'password','placeholder'=>'Password','class'=>'form-control' ));?>	
	                             <?php echo form_error('password',"<p class='text-danger'>","</p>"); ?>
								<i class="fa fa-lock"></i>
								 </span>
						</div>
						<div class="form-actions">
											
							<button type="submit" class="btn btn-success pull-right">
								Login <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					  <div class="form-actions">
							<a href="<?php echo base_url('forget'); ?>" data-target="#signup-box" class="user-signup-link">
                             <i class="ace-icon fa fa-arrow-left"></i>Forget Password ?
                                     </a>
							<label for="remember" class="pull-right">
								<a href="<?php echo base_url('registration') ?>" data-target="#signup-box" class="user-signup-link">
                                 <i class="ace-icon fa fa-arrow-right">Register</i>
							</label>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- end: LOGIN BOX -->

			<!-- start: COPYRIGHT -->
			<div class="copyright">
				 <h2><marquee><font color=red>Newly Registered user should contact directorate admin for verification</marquee>	

			</div>
			<!-- end: COPYRIGHT -->
		</div>
<?php include 'footerlogin.php'; ?>
		