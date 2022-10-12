
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
            <thead>
          <!--  <table class="table table-striped" id="tblGrid">
            <thead id="tblHead"> -->
              <tr>
                <th color="red" class="text-center"><h4 style="color: blue";>Assign/Delete Profile Admin Role/प्रोफ़ाइल व्यवस्थापक भूमिका असाइन/हटाएं</h4></th>
              </tr>
            </thead>
           <?php   $message = $this->session->flashdata('role');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
			<?php echo form_open('Superrole/selectemp'); ?>
			<div class='table-responsive'>          
            <table class='table'>
			<tr>
			<td > <select  class="form-control"  name="direc"  size="1" required>
            
            <?php 
              
            foreach($record1 as $row1)
            { 
             echo '<option value="'.$row1->dte_id.'">'.$row1->dte_desc.'</option>';
            }
            ?>
            </select></td>
<td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit','class'=>'width-35 pull-left btn btn-sm btn-primary'));?>
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
             <th align='center'>S.No//क्रमांक</th>
             <th align='center'>IPAS Id/कर्मचारी सं </th>
             <th align='center' >Name/नाम </th>
			 <th align='center'>Directorate//निदेशालय</th>
             <th align='center'>Designation/पद</th>
			  <th > Role/भूमिका </th>
			 <th > Assign/Delete Role/भूमिका असाइन/हटाएं </th>
			
             </tr>";  ?>
           <?php 
		     $i=1;
			// if(isset($records)) 
			
				 foreach ($records as $row)		
		  {
 
      echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
  echo "<td align='left' ><type='text' name='loginid'>". $row["login_id"]." </td>" ;
  echo "<td align='left' ><type='text' name='name'>". $row["name"]." </td>" ;
    echo "<td align='left' ><type='text' name='dte'>". $row["dte_desc"]." </td>" ;
   echo "<td align='left' ><type='text' name='desig'>". $row["desig_desc"]." </td>" ;
   	if (($row["user_type"])=='4')	
{
$type1="Directorate Admin";	
}
elseif  (($row["user_type"])=='2')
{
$type1="Sub Super Admin";	
}
elseif (($row["user_type"])=='3')
{
$type1="Super Admin";	
}
else
{
$type1=null;	
}	
     echo "<td align='left' ><type='text' name='desig'>". $type1." </td>" ; 
	if  (($row["user_type"]) !='2')
{
	if  (($row["user_type"]) !='3')
	{
	if  (($row["user_type"]) !='4')
	{	
    echo "<td><a class='edit btn btn-outline-primary btn-sm' href='".base_url('Superrole/role/'.$row["login_id"])."'>Assign Role</</td>";
}
}
}
 else {
 echo "<td><a class='edit btn btn-outline-danger btn-sm' href='".base_url('Superrole/deleterole/'.$row["login_id"])."'>Delete Role</</td>";

}
 echo "</tr>";
   $i++;   
		  }
			}
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

  
