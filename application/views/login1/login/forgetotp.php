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
				<h3>Retrieve Password </h3>
				<?php echo form_open('Forgetpwd/forgetotp'); ?>
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
						<div class="form-group" >Enter your your Emp No/ Unique Id
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'loginid','placeholder'=>'Emp No/ Unique Id','class'=>'form-control','maxlength'=>'12','value'=>set_value('loginid'),'readonly'=>'true' ));?>	
                                 <?php echo form_error('loginid',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group" >Enter OTP 
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'otp','placeholder'=>'OTP','class'=>'form-control' ));?>	
                                <?php echo form_error('otp',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger pull-right">
								Reset Password 
							</button>
						</div>
					
					</fieldset>
				</form>
			</div>
			
		</div>
<?php include 'footerlogin.php'; ?>
		