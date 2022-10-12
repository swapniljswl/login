
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
	<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
           </span>
          </div>
		    <div class="table-responsive">          
            <table class="table">
          	 <h4 style="color: blue"; class="text-center">List Of Users Pending For Verification/सत्यापन के लिए लंबित उपयोगकर्ताओं की सूची</h4> 
           <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
			<?php echo form_open('Userverifyrole/selectemp'); ?>
       <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
			<tr>
			<td > <select  class="form-control"  name="typeuser"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
			<td > <select  class="form-control"  name="direc"  size="1" required>
            
            <?php 
              
            foreach($record1 as $row1)
            {  ?>
			<option value="<?php echo $row1['dte_id']; ?>"<?php echo set_select('direc', $row1['dte_id'], False); ?> ><?php echo $row1['dte_desc'];?> </option>
       
           <?php  //echo '<option value="'.$row1->dte_id.'">'.$row1->dte_desc.'</option>';
            }
            ?>
            </select></td>
<td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>'width-35 pull-left btn btn-sm btn-primary'));?>
			</td></tr></div>
			
           <?php
		 if (isset($_POST['Submit']))  { 
 if ($records > 0)
			{		 
             echo "<div class='table-responsive'>          
            <table class='table'>
              <tr>
             <th align='center'>S.No/क्रमांक</th>
			 <th  >Name/नाम </th>
             <th >Emp No/ Unique Id/कर्मचारी सं </th>
			 <th ></th>
			 <th >Designation/पद</th> 
			 <th >Mobile No/मोबाइल</th>
             <th >Email/ईमेल</th>             			
			 <th  ></th>
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
   echo "<td align='center'><name='id'> </td>" ;
  echo "<td align='left' ><name='desig'>". $row["desig_desc"]." </td>" ;
} elseif ($row["rdso_nonrdso"]=='2')
{
 echo "<td  ><type='text' name='loginid'>". $row["aadhar_no"]." </td>" ;
 echo "<td  ><input type='hidden' name='aadharno' value=".$row["aadhar_no"]."></td>" ;
 echo "<td  ><name='desig'>Non RDSO</td>" ; 
}
  echo "<td ><name='mobile'>". $row["mobno"]." </td>" ;
  echo "<td  ><name='email'>". $row["email"]." </td>" ;
 
 // echo "<td align='left' ><name='dte'>". $row["dte_desc"]." </td>" ; 
if ($row["rdso_nonrdso"]=='1')
{  
  // echo "<td><a class='btn btn-success' href='".base_url('userverifyrole/verify/'.$row["login_id"])."'>Verify</</td>";
  // echo "<td><a class='btn btn-danger' href='".base_url('userverifyrole/getdetail/'.$row["login_id"])."'>Reject</</td>";
  echo "<td><a class='btn btn-success' href='".base_url('userverifyrole/verify/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Verify</</td>";
  echo "<td><a class='btn btn-danger' href='".base_url('userverifyrole/getdetail/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Reject</</td>";
 } elseif ($row["rdso_nonrdso"]=='2')
{ 
// echo "<td><a class='btn btn-success' href='".base_url('userverifyrole/nonrdsoverify/'.$row["aadhar_no"])."'>Verify</</td>";
// echo "<td><a class='btn btn-danger' href='".base_url('userverifyrole/getdetail/'.$row["aadhar_no"])."'>Reject</td>";
echo "<td><a class='btn btn-success' href='".base_url('userverifyrole/nonrdsoverify/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Verify</</td>";
echo "<td><a class='btn btn-danger' href='".base_url('userverifyrole/getdetail/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Reject</</td>";
} echo "</tr>";
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
