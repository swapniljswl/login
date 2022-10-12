
<script>
$('form[name=test]').submit(function(e) {
   e.preventDefault();
   window.scrollTo(5000,500);

   // a sample AJAX request
   $.ajax({
     url : this.action,
     type : this.method,
     data : $(this).serialize(),
     success : function(response) {

     }
   });
});
</script>

<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
        
          </span>
          </div>
				    <h4 style="color: blue"; class="text-center">List of Verified/Rejected Users/सत्यापित/अस्वीकृत उपयोगकर्ताओं की सूची</h4> 	
  	<?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 } ?>					
                  <?php echo form_open('Userverifyreject/selectemp'); ?>	
                   <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
				  <div class="row">    
	  			
              <div class='table-responsive'>          
              <table class='table'>
			<tr>
			<td > <select  class="form-control"  name="type"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
			<td > <select  class="form-control"  name="user"  size="1" required>
            <option value="V">Verified Users</option>
            <option value="R">Rejected Users</option>
            </select></td>
            <td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit','class'=>'width-35 pull-left btn btn-sm btn-primary'));?>
			</td></tr></form> <thead> </table>
           <?php
		    if (isset($_POST['Submit']))  { 
             echo "<div class='table-responsive'>          
            <table class='table'>
              <tr>
             <th >S.No/क्रमांक</th>
			  <th>Name/नाम  </th>
             <th>Emp No/ Unique Idकर्मचारी सं/ युनिक आईडी</th> 
              <th>Designation/पद</th>
              <th>Mobile No/मोबाइल  </th>			  
             <th>Email/ईमेल</th>             			
			 <th></th>
			
			 
             </tr>";  ?>
           <?php 
		     $i=1;
		   foreach ($verify->result_array() as $row)
{
      echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
  echo "<td ><name='name'>". $row["name"]." </td>" ;
  if ($row["rdso_nonrdso"]=='1') {
  echo "<td><type='text' name='loginid'>". $row["login_id"]." </td>" ;
  echo "<td ><name='desig'>". $row["desig_desc"]." </td>" ;
  }
   if ($row["rdso_nonrdso"]=='2') {
   echo "<td ><type='text' name='loginid'>". $row["aadhar_no"]." </td>" ;
   echo "<td ><name='desig'>Non RDSO </td>" ;}
  echo "<td ><name='mobile'>". $row["mobno"]." </td>" ;
  echo "<td  ><name='email'>". $row["email"]." </td>" ; 
 // echo "<td align='left' width='10%'><name='dte'>". $row["dte_desc"]." </td>" ;
if ((($row["role"])!='3') and (($row["role"])!='2') and (($row["role"])!='4'))	
{
	if (($row["active_flag"])=='y')
	{
	 if ($row["rdso_nonrdso"]=='1') {
 echo "<td><a class='btn btn-danger' class='edit btn btn-outline-danger btn-sm' href='".base_url('Userverifyreject/deactive/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Deactivate</td>";

 // echo "<td><a class='btn btn-danger' class='edit btn btn-outline-danger btn-sm' href='".base_url('Userverifyreject/deactive/'.$row["login_id"])."'>Deactivate</td>";
	}
elseif ($row["rdso_nonrdso"]=='2') {
echo "<td><a class='btn btn-danger' class='edit btn btn-outline-danger btn-sm' href='".base_url('Userverifyreject/nonrdsodeactive/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Deactivate</td>";
echo "<td><a class='btn btn-warning' class='edit btn btn-outline-warning btn-sm' href='".base_url('Userverifyreject/appprevnnrdso/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Application Prev.</td>";
	
    }	
 	}
	else
		{
	
	if ($row["rdso_nonrdso"]=='1') {
       echo "<td><a class='btn btn-success' class='edit btn btn-outline-primary btn-sm' href='".base_url('Userverifyreject/active/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Activate</td>";
	 }  if ($row["rdso_nonrdso"]=='2') {
	echo "<td><a class='btn btn-success' class='edit btn btn-outline-primary btn-sm' href='".base_url('Userverifyreject/nonrdsoactive/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Activate</td>";		 
//	echo "<td><a class='btn btn-warning' class='edit btn btn-outline-warning btn-sm' href='".base_url('Userverifyreject/appprevnnrdso/'.$row["aadhar_no"])."'>Application Prev.</td>";		
			}		
 	}	
}
 echo "</tr>";
   $i++;   
}  
	
			}
 ?>     
		     </table>  
	            </thead>
</div></div></div></div></div></div></div></div>

  
