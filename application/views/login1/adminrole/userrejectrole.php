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
	<?php echo form_open(''); ?>
	<div class="content">	
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
          </span>
          </div>
            <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
			   <th color="red" class="text-center"><h4 style="color: blue";> RDSO Rejected User/आरडीएसओ अस्वीकृत उपयोगकर्ता</h4></th>
               
              </tr>
            </thead>
           <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
           <?php
             echo "<div class='table-responsive'>          
                  <table class='table'>
              <tr class=info'>
              <th align='center'>S.No/क्रमांक</th>
             <th align='center'>IPAS Id /आईपास आईडी </th>
             <th align='center' >Name/नाम </th>
             <th align='center'>Mobile No</th>
			 <th align='center'>Designation/पद</th>
			 <th align='center'>Directorate/निदेशालय</th>
			 <th align='center'>Reject reason/अस्वीकार करने का कारण</th>
			 <th align='center'>Rejected Date/अस्वीकृत तिथि</th>
			 <th  >Status</th>
			 
             </tr>";  ?>
           <?php 
		     $i=1;
		   foreach ($verify->result_array() as $row)
{
      echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
  echo "<td align='left' width='8%'><type='text' name='loginid'>". $row["login_id"]." </td>" ;
  echo "<td align='left' width='20%'><name='name'>". $row["name"]." </td>" ;
 // echo "<td align='left' width='30%'><name='email'>". $row["email"]." </td>" ;
  echo "<td align='left' width='10%'><name='mobile'>". $row["mobno"]." </td>" ;
  echo "<td align='left' width='10%'><name='desig'>". $row["desig_desc"]." </td>" ;
  echo "<td align='left' width='10%'><name='dte'>". $row["dte_desc"]." </td>" ;
   echo "<td align='left' width='10%'><name='dte'>". $row["rejection_reason"]." </td>" ;
    $date=	date("d/m/Y", strtotime($row["verified_on"]));
    echo "<td align='left' width='10%'><name='dte'>". $date." </td>" ;
 echo "<td><a class='btn btn-success' href='".base_url('userverifyrole/verify/'.$row["login_id"])."'>Verify</</td>";
 echo "</tr>";
   $i++;   
}  
	

 ?>     
		     </table>  
	            </thead>
</table>

  
