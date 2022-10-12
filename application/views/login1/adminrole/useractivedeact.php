
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
<script>

</script>
<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
       
          </span>
          </div>
		    <div class="table-responsive">          
            <table class="table">
          
           <?php   $message = $this->session->flashdata('role');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
			<h4 style="color: blue"; class="text-center">List of Verified/Rejected Users/सत्यापित/अस्वीकृत उपयोगकर्ताओं की सूची</h4>
			<?php echo form_open('Useractivedeavtive/selectemp'); ?>
       <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
				
			<tr>
			<td > <select  class="form-control"  name="typeuser"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
			<td > <select  class="form-control"  name="user"  size="1" required>
            <option value="V">Verified Users</option>
            <option value="R">Rejected Users</option>
            </select></td>
			<td > <select  class="form-control "  size="1" name="direc"  required>
            
            <?php 
              
            foreach($record1 as $row1)
            { ?>
			<option value="<?php echo $row1['dte_id']; ?>"<?php echo set_select('direc', $row1['dte_id'], False); ?> ><?php echo $row1['dte_desc'];?> </option>
       
           <?php // echo '<option value="'.$row1->dte_id.'">'.$row1->dte_desc.'</option>';
            }
            ?>
            </select></td>
<td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>' btn btn-sm btn-primary'));?>
			</td></tr></div>
			<form  method='post' action='Userrole/role'  onkeypress="return event.keyCode != 13;">
         <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
           <?php
		 if (isset($_POST['Submit']))  { 
 if ($records > 0)
			{
$type1=0;				
             echo "<div class='table-responsive'>          
            <table class='table'>
              <tr>
             <th >S.No/क्रमांक</th>
			  <th>Name/नाम  </th>
             <th>Emp No/ Unique Id/कर्मचारी सं </th> 
              <th>Designation//पद</th>
              <th>Mobile No/मोबाइल  </th>			  
             <th>Email/ईमेल</th>			 
             </tr>";  ?>
           <?php 
		     $i=1;
			// if(isset($records)) 
			
				 foreach ($records as $row)		
		  {
 
      echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
   echo "<td align='left' ><type='text' name='name'>". $row["name"]." </td>" ;
    if ($row["rdso_nonrdso"]=='1') {
   echo "<td align='left' ><type='text' name='loginid'>". $row["login_id"]." </td>" ;
	echo "<td align='left' ><type='text' name='desig'>". $row["desig_desc"]." </td>" ; }
	 if ($row["rdso_nonrdso"]=='2') {
   echo "<td align='left' ><type='text' name='loginid'>". $row["aadhar_no"]." </td>" ;
	echo "<td align='left' ><type='text' name='desig'>Non RDSO</td>" ; }
   echo "<td ><name='mobile'>". $row["mobno"]." </td>" ;
   echo "<td  ><name='email'>". $row["email"]." </td>" ;
 
   	if (($row["role"])=='1')	
{
$type1="Directorate Admin";	
}
elseif  (($row["role"])=='2')
{
$type1="Sub Super Admin";	
}
elseif (($row["role"])=='3')
{
$type1=" Super Admin";	
}
else
{
$type1=null;	
}	
    echo "<td align='left' ><type='text' name='desig'>". $type1." </td>" ; 
		if ((($row["role"])!='3') and ($row["role"])!='2')	
{
	if (($row["active_flag"])=='y')
	{
		 if ($row["rdso_nonrdso"]=='1') {
 echo "<td><a class='btn btn-danger' href='".base_url('Useractivedeavtive/deactive/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Deactivate</</td>";
	}
elseif ($row["rdso_nonrdso"]=='2') {
echo "<td><a class='btn btn-danger' href='".base_url('Useractivedeavtive/nonrdsodeactive/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Deactivate</</td>";
}
	}
	else
		{
			 if ($row["rdso_nonrdso"]=='1') {
       echo "<td><a class='btn btn-success' href='".base_url('Useractivedeavtive/active/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Activate</</td>";
	 }  if ($row["rdso_nonrdso"]=='2') {
	echo "<td><a class='btn btn-success' href='".base_url('Useractivedeavtive/nonrdsoactive/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Activate</</td>";		 
			 }	
}
   
 echo "</tr>";
   $i++;   
		   }
			} }
			else
			{
				 echo "<div class='table-responsive'>          
                <table class='table'>
                <tr>
				 <th align='center'>Sorry ! No data found.</th>
				 </tr>";
			}				
			}
		 
 ?>     
		     </table>  
	            </thead>
</table>
</form>

  
