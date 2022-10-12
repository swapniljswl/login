<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
        
          </span>
          </div>
		  <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="col-lg-12 alert alert-info" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
				
               ?> 
				  <h4 style="color: blue"; class="text-center">List of Verified/Rejected Users सत्यापित/अस्वीकृत उपयोगकर्ताओं की सूची</h4> 				       
           
			  <?php echo form_open('Userverifyreject/selectemp'); ?>
          <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
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
			</td></tr></form>
			<form  method='post' action='nonrdsoverify'  onkeypress="return event.keyCode != 13;">
            <thead >
           <?php
		  
		    if (isset($_POST['Submit']))  { 
 if ($verify->result_array() > 0)
			{
             echo "<div class='table-responsive'>          
            <table class='table'>
              <tr>
              <th align='center'>S.No/क्रमांक</th>
			    <th >Name/नाम </th>
             <th >Emp No/Unique Id/कर्मचारी सं</th>
			 <th >Designation/पद</th>           
             <th >Mobile No/मोबाइल</th>			
			 <th >Rejected Reason/अस्वीकृत कारण</th>
			 <th >Rejected Date/अस्वीकृत तिथि</th>
			 <th colspan='2' ></th>
			  
             </tr>";  ?>
           <?php  
		     $i=1;
			   // echo "hi";exit;
		   foreach ($verify->result_array() as $row)
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
  // echo "<td><a class='btn btn-success' href='".base_url('Userverifyreject/verify/'.$row["login_id"])."'>Verify</</td>";
  //  echo "<td  ><a class='btn btn-danger' href='".base_url('Userverifyreject/getdetail/'.$row["login_id"].'/'.$row["rdso_nonrdso"])."'>Modify</a></td>";
    echo "<td><a class='btn btn-success' href='".base_url('Userverifyreject/verify/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Verify</</td>";
   echo "<td  ><a class='btn btn-danger' href='".base_url('Userverifyreject/getdetail/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Modify</a></td>";
   
  
 } elseif ($row["rdso_nonrdso"]=='2')
{ 
 echo "<td><a class='btn btn-success' href='".base_url('Userverifyreject/nonrdsoverify/'.$row["aadhar_no"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Verify</td>";
 echo "<td ><a class='btn btn-danger' href='".base_url('Userverifyreject/getdetail/'.$row["aadhar_no"].'/'.$row["rdso_nonrdso"])."'>Modify</a></td>";

 }

  
  echo "</tr>";
   $i++;   
			}  }
			else
			{
			echo "<tr>";
  echo "<td align='center'><name='id'> Sorry! No Data found.</td>" ;
  echo "</tr>  ";
			}
			
			} ?></form>
			<form  method='post' action='nonrdsoverify1'  onkeypress="return event.keyCode != 13;">
			<?php
 if (isset($_POST['Verify']))  {
	 
  foreach ($detail as $row)
{	 
  echo"<table class='table'>";
  echo "<td align='left' >Name:-". $row->name." </td>" ;
   echo "<td align='left' width='8%'>Aadhar No:-<input  name='aadharno' value=".$row->aadhar_no." readonly></td>" ;
   echo "<td align='left' width='8%'>Email:-<input  name='email' value=".$row->email." readonly></td>" ;
  //echo "<td align='left' >Email:- ". $row->email." </td>" ;
    echo "<td align='left' width='8%'>Mobile:-<input  name='obno' value=".$row->mobno." readonly></td>" ;
  //echo "<td align='left' >Mobile:- ". $row->mobno." </td>" ;
   echo "<td align='left' width='8%'> <input type='hidden' name='dteid' value=".$row->dte_id." readonly></td>" ; 
 echo "<td align='left' width='8%'>Directorate:- <input  name='dte' value=".$row->dte_desc." readonly></td>" ;  
  echo "</tr>  ";
  echo "</table>  ";
				 
  foreach ($appmaster as $row)
{	
echo"<table class='table'>"; 
 echo "<tr>  ";?> 
<input type="checkbox" name="appid[]" value= "<?php echo $row->appid ;?>"><?php echo $row->app_name ;?></div>
<?php  echo "</tr>  ";
} } ?>
 <tr><td><input class="width-35 pull-center btn btn-sm btn-danger" type="submit" value="submit" name="submit"></td></tr>
<?php }
 ?> 

 </div>
 			</div>
		     </table>  
	            </thead>
</table></div></div></div></div>
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
   