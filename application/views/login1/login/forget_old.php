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
				<header><h3>Retrieve Password </h3></header>
				<?php echo form_open('forget/forgotPassword'); ?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> 

					</div>
					<fieldset>
				<?php   $message = $this->session->flashdata('email_sent');
if (isset($message)) {
 echo '<div class="alert alert-info">' . $message . '</div>';
 $this->session->unset_userdata('message');
}
   ?>
						<div class="form-group" >Enter your your Emp No/ Unique Id
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'loginid','placeholder'=>'Emp No/ Unique Id','class'=>'form-control','maxlength'=>'12' ));?>	
                                 <?php echo form_error('loginid',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-danger pull-right">
								Send OTP
							</button>
						</div>
					 <div class="toolbar center">
                  <a href="<?php echo base_url('user_login'); ?>" data-target="#signup-box" class="user-signup-link">
                   Back to Login
                   <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                  </div>
					</fieldset>
				</form>
			</div>
			
		</div>
<?php include 'footerlogin.php'; ?>
		