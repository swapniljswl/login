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
				<header><h4>Retrieve Password/पासवर्ड पुनः प्राप्त करें </h4></header>
				<?php echo form_open('Forgetpwd/forgotPassword'); ?>
				 <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
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
						<div class="form-group" >Enter your Emp No/ Unique Id/अपना कर्मचारी सं दर्ज करें
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'loginid','placeholder'=>'Emp No/ Unique Id/कर्मचारी सं दर्ज करें','class'=>'form-control','maxlength'=>'12' ));?>	
                                 <?php echo form_error('loginid',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-danger pull-right">
								Send OTP/ OTP भेजें
							</button>
						</div>
					 <div class="toolbar center">
                  <a href="<?php echo base_url('user_login'); ?>" data-target="#signup-box" class="user-signup-link">
                   Back to Login/लॉगिन पर वापस जाएं
                   <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                  </div>
					</fieldset>
				</form>
			</div>
			
		</div>
<?php include 'footerlogin.php'; ?>
		