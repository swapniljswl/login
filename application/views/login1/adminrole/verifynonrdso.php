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
				  <h4 style="color: blue"; class="text-center">List of Users Pending For Verification/सत्यापन के लिए लंबित उपयोगकर्ताओं की सूची</h4>                     
           <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center"class="col-lg-12 alert alert-info"  class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
				
               ?> 
			  <?php echo form_open('Useractivedeavtive/selectemp'); ?>
         <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">   
			   <div class='table-responsive'>          
            <table class='table'>
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
<td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>'width-35 pull-left btn btn-sm btn-primary'));?>
			</td></tr></form>
			<?php echo form_open('Useractivedeavtive/nonrdsoverify1'); ?>
       <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">  
	
			<?php
	 
  foreach ($detail as $row)
{	 
  echo"<table class='table'>";
  echo "<td align='left' >Name/नाम:-". $row['name']." </td>" ;
   echo "<td >Unique Id/युनिक आईडी :-<input  name='aadharno' value=".$row['aadhar_no']." readonly></td>" ;
     echo "<td >Mobile/मोबाइल:-<input  name='obno' value=".$row['mobno']." readonly></td>" ;
   echo "<td >Email/ईमेल:-<input  name='email' value=".$row['email']." readonly></td>" ;
   echo "<td > <input type='hidden' name='dteid' value=".$row['dte_id']." readonly></td>" ; 
// echo "<td >Directorate:- <input  name='dte' value=".$row->dte_desc." readonly></td>" ;  
  echo "</tr>  ";
  echo "</table>  ";
				 
  foreach ($appmaster as $row)
{	
echo"<table class='table'>"; 
 echo "<tr>  ";?> 
<input type="checkbox" name="appid[]" value= "<?php echo $row['appid'] ;?>"><?php echo $row['app_name'] ;?></div>
<?php  echo "</tr>  ";
} } ?>
 <tr><td><input class="width-35 pull-center btn btn-sm btn-danger" type="submit" value="submit" name="submit"></td></tr>


 </div>
 			</div>
		     </table>  
	            </thead>
</table></div></div></div>
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
   