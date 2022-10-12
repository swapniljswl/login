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
				<h4>Sign in</h4>
				<?php echo form_open('user_login/login'); ?>
<!-- audit changes -->
				<input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token"> 
	<!-- audit changes -->
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
						<div class="form-group" >Emp No/Unique Id / कर्मचारी सं
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'username','placeholder'=>'Emp No/ Unique Id/ कर्मचारी सं','class'=>'form-control','maxlength'=>'12' ));?>	
                                 <?php echo form_error('username',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">Password /पासवर्ड
							<span class="input-icon">
								<?php  echo form_password(array('name'=>'password','placeholder'=>'Password/पासवर्ड','class'=>'form-control' ));?>	
	                             <?php echo form_error('password',"<p class='text-danger'>","</p>"); ?>
								<i class="fa fa-lock"></i>
								 </span>
						</div>
						<div class="form-actions">
											
							<button type="submit" class="btn btn-success pull-right">
								Login लॉग इन  <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					  <div class="form-actions">
							<a href="<?php echo base_url('forgetpwd'); ?>" data-target="#signup-box" class="user-signup-link">
                             <i class="ace-icon fa fa-arrow-left"></i>Forget Password ?/पासवर्ड भूल गए 
                                     </a> 
							<label for="remember" class="pull-right">
								<a href="<?php echo base_url('registration') ?>" data-target="#signup-box" class="user-signup-link">
                                 <i class="ace-icon fa fa-arrow-right">Register/रजिस्टर करें</i>
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
	<div class="col-md-12 row"> 
		<div class="col-md-6">
					<span style="font-style: italic; color: blue; font-size: 12px">Visitor No :</b>			  
					 <a href="https://www.hitwebcounter.com" target="_blank">
		<img src="https://hitwebcounter.com/counter/counter.php?page=7879176&style=0006&nbdigits=5&type=page&initCount=0" title="Free Counter" Alt="web counter"   border="0" /></a>    


			</div>
			<div class="col-md-6" align="right">
				<span style="font-style: italic; color: blue; font-size: 12px">Last Updated on : </span> 
				 <span style="font-style: italic; color: black; font-size: 12px; font-weight: bolder;">27.10.2021	
			</div>
			
		</div>

		</div>
<?php include 'footerlogin.php'; ?>
		
