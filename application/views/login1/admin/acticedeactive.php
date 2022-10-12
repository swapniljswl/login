<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
        
          </span>
          </div>
 <h4 style="color: blue"; class="text-center">Active/Deactive Users/सक्रिय/निष्क्रिय उपयोगकर्ता </h4>
            <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="col-lg-12 alert alert-info" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
				  
				  <div class="row"> 

	<?php echo form_open('Listacivedeactdirec/getverifylist'); ?>				  
            <thead >
			 <div class='table-responsive'>          
            <table class='table'>
			<tr>
			<td > <select  class="form-control"  name="typeuser"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
            <td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit','class'=>'width-35 pull-left btn btn-sm btn-primary'));?>
			</td></tr></form>
           <?php
		   if (isset($_POST['Submit']))  { 
             echo "<div class='table-responsive'>          
            <table class='table'>
              <tr>
             <th align='center'>S.No/क्रमांक</th>
			 <th align='center' >Name/नाम  </th>
             <th align='center'>Emp No/Unique Id/कर्मचारी सं </th>
             <th align='center'>Designation/पद</th>
             <th align='center'>Mobile No/मोबाइल</th>			
			 <th align='center'>Directorate/निदेशालय</th>
			 <th align='center'></th>
			 
             </tr>";  ?>
           <?php 
		     $i=1;
		   foreach ($verify->result_array() as $row)
{
      echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
    echo "<td ><name='name'>". $row["name"]." </td>" ;
   if ($row["rdso_nonrdso"]=='1') {
   echo "<td ><type='text' name='loginid'>". $row["login_id"]." </td>" ;
   echo "<td ><name='desig'>". $row["desig_desc"]." </td>" ;   
   }
 if ($row["rdso_nonrdso"]=='2') {
   echo "<td align='left' width='8%'><type='text' name='loginid'>". $row["aadhar_no"]." </td>" ;
   echo "<td align='left' width='10%'><name='desig'>Non RDSO </td>" ;}
   echo "<td ><name='mobile'>". $row["mobno"]." </td>" ; 
  echo "<td ><name='dte'>". $row["dte_desc"]." </td>" ;
if ((($row["role"])!='3') and (($row["role"])!='2') and (($row["role"])!='4'))	
{
	if (($row["active_flag"])=='y')
	{
	 if ($row["rdso_nonrdso"]=='1') {
 echo "<td><a class='btn btn-danger' class='edit btn btn-outline-danger btn-sm' href='".base_url('Listacivedeactdirec/deactive/'.$row["login_id"])."'>Deactive</</td>";
	}
elseif ($row["rdso_nonrdso"]=='2') {
echo "<td><a class='btn btn-danger' class='edit btn btn-outline-danger btn-sm' href='".base_url('Listacivedeactdirec/nonrdsodeactive/'.$row["aadhar_no"])."'>Deactive</</td>";
	
    }	
 	}
	else
		{
	
	if ($row["rdso_nonrdso"]=='1') {
       echo "<td><a class='btn btn-success' class='edit btn btn-outline-primary btn-sm' href='".base_url('Listacivedeactdirec/active/'.$row["login_id"])."'>Active</</td>";
	 }  if ($row["rdso_nonrdso"]=='2') {
	echo "<td><a class='btn btn-success' class='edit btn btn-outline-primary btn-sm' href='".base_url('Listacivedeactdirec/nonrdsoactive/'.$row["aadhar_no"])."'>Active</</td>";		 
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
</table></div></div></div></div>

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
(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {            
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);
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
