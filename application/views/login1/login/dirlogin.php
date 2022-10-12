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
				<?php echo form_open('dirlogin/login'); ?>
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
						<div class="form-group" >Email ID
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'username','placeholder'=>'Email','class'=>'form-control' ));?>	
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
					
					</fieldset>
				</form>
			</div>
			
		</div>
<?php include 'footerlogin.php'; ?>
		