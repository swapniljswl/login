
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
           <?php
		 if (isset($_POST['Submit']))  { 
 if ($records > 0)
			{
$type1=0;				
             echo "<div class='table-responsive'>          
            <table class='table'>
               <tr>
              <th align='center'>S.No/क्रमांक</th>
			 <th >Name/नाम   </th>
             <th >Emp No/Unique Id/कर्मचारी सं </th>
			 <th >Designation/पद</th>           
             <th >Mobile No/मोबाइल  </th>			
			 <th >Rejected Reason/अस्वीकृत कारण</th>
			 <th >Rejected Date/अस्वीकृत तिथि</th>
			 <th colspan='2' ></th>			 
             </tr>";  ?>
           <?php 
		     $i=1;
			// if(isset($records)) 
			
				 foreach ($records as $row)		
		  {
  echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
   echo "<td  ><name='name'>". $row["name"]." </td>" ;
if ($row["rdso_nonrdso"]=='1')
{
  echo "<td ><type='text' name='loginid'>". $row["login_id"]." </td>" ;
 echo "<td  ><name='desig'>". $row["desig_desc"]." </td>" ;
} elseif ($row["rdso_nonrdso"]=='2')
{
 echo "<td ><type='text' name='loginid'>". $row["aadhar_no"]." </td>" ;
// echo "<td align='left' width='8%'><input type='hidden' name='aadharno' value=".$row["aadhar_no"]."></td>" ;
 echo "<td ><name='desig'>Non RDSO</td>" ; 
}

  echo "<td  ><name='mobile'>". $row["mobno"]." </td>" ;
 // echo "<td ><name='dte'>". $row["dte_desc"]." </td>" ; 
  echo "<td ><name='dte'>". $row["rejection_reason"]." </td>" ; 
  $date=	date("d/m/Y", strtotime($row["verified_on"]));
  echo "<td ><name='dte'>". $date ." </td>" ; 
if ($row["rdso_nonrdso"]=='1')
{  
  echo "<td><a class='btn btn-success' href='".base_url('Useractivedeavtive/verify/'.$row["login_id"])."'>Verify</</td>";
  echo "<td ><a class='btn btn-danger' href='".base_url('Useractivedeavtive/getdetail/'.$row["login_id"].'/'.$row["rdso_nonrdso"])."'>Modify</a></button></td>";
 } elseif ($row["rdso_nonrdso"]=='2')
{ 
 echo "<td><a class='btn btn-success' href='".base_url('Useractivedeavtive/nonrdsoverify/'.$row["aadhar_no"])."'>Verify</td>";
 echo "<td ><a class='btn btn-danger' href='".base_url('Useractivedeavtive/getdetail/'.$row["aadhar_no"].'/'.$row["rdso_nonrdso"])."'>Modify</a></button></td>";

 }

  
  echo "</tr>";
   $i++;   
 }  }
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

  
