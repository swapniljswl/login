<?php    $user_data=unserialize($this->session->user);
	             $user_name = $user_data[0]->name; 
	   echo form_open('Changepassword/changepwd'); ?>	 
    <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
<div class="content">	 
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 		 
          </span>
          </div>
		  <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th color="red" class="text-center"><h4 style="color: blue";>Change Password/पासवर्ड बदलें</h4></th>
              </tr>
            </thead>
			</table>
		 <table class="table table-striped" id="tblGrid">	
            <tbody>
			<?php   $message = $this->session->flashdata('chpwd_success');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
			     <tr><td style="width:15%">User Name / उपयोगकर्ता नाम</td>
                <td style="width:25%"> <?php  echo  $user_name ;  ?></td>
                </tr>
              <tr><td style="width:15%">Old Password/ पुराना पासवर्ड</td>
                <td style="width:25%"> <?php  echo form_input(array('name'=>'opassword','type'=>'password','placeholder'=>'Old Password','class'=>'form-control' ));?></td>
              
			  </tr>
			   <tr>
			   <td class="danger"> </td>
			   <td class="danger" style="width:10%"> <?php echo form_error('opassword',"<p class='text-danger'>","</p>"); ?>	</td>
              </tr>
              <tr><td style="width:15%">New Password / नया पासवर्ड</td>
                <td style="width:25%"> <?php  echo form_input(array('name'=>'npassword','type'=>'password','placeholder'=>'New Password','class'=>'form-control' ));?></td>
                </tr>
				<tr>
				  <td class="danger"> </td>
				<td class="danger" style="width:10%"> <?php echo form_error('npassword',"<p class='text-danger'>","</p>"); ?>	</td>
              </tr>
			   <tr><td style="width:15%">Confirmed Password/ पुष्टि पासवर्ड</td>
               <td style="width:25%">  <?php  echo form_input(array('name'=>'cpassword','type'=>'password','placeholder'=>'Re-enter Password','class'=>'form-control' ));?></td>
               </tr>
			   <tr>
			     <td class="danger"> </td>
			   <td class="danger" style="width:10%">  <?php echo form_error('cpassword',"<p class='text-danger'>","</p>"); ?></td>	
              </tr>
            </tbody>
          </table>
		  <button class="btn btn-danger" type="reset">Reset/ रीसेट</button>
		  <?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>'width-35 pull-center btn btn-sm btn-primary'));?>
            
        </form>    
       </div>
	   </div>
