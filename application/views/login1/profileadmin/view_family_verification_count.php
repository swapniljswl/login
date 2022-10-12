
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

<?php	 $user_data=unserialize($this->session->user);
	 $user_name = $user_data[0]->name;
	$user_desig = $user_data[0]->desig_desc; ?>
	<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
         </span>
          </div>
 <div  class="row form-group" >
   <div class="col-md-12" align="text-center">
          <h5 style="color: blue";>Family Verified List/परिवार सत्यापित सूची</h5>
        </div>
		   </div>  
        <fieldset class="fset" id="book_rh">
      <legend class="legend"></legend>
      <div class="row form-group">
          
      
          <div class="col-md-12">
           <span class="label label-default col-md-2 text-primary">Directorate/निदेशालय:</span>
           <select id="dir_code" name="dir_code">
                      <option value="1000">All Directorate</option>
                      <?php
                     foreach($directorate_list as $directorate)
                     {
                        echo '<option value="' .$directorate->dte_id. '">' .$directorate->dte_desc.'</option>';
                     }
                     ?>
                    </select>


           <select id="status" name="status">
                      <option value="V">Verified</option>
                      <option value="N">Not Verified</option>
                      <option value="R">Rejected</option>
                    </select>

                    
       
            <input type="button" class="btn btn-outline-primary btn-sm btn-default"  onclick="view()" name="view" value="Get Records">
      </div>
      
          
    </fieldset>
        
       <fieldset class="fset app_list hide" id="fset_emp_list" style="font-size: .8em">
       <legend class="legend">List of Employees of selected directorate whose Family details have been Verified/चयनित निदेशालय के कर्मचारियों की सूची जिनके परिवार का विवरण सत्यापित किया गया है</legend>
      <div class='col-md-12 table-responsive' >
        <table class="table table-condensed table-hover" id="table_verified_list">
          <thead>
            <tr>
            <th>SNo/क्रमांक</th>
            <th>IPAS ID/कर्मचारी सं</th>
             <th>Name/नाम</th>
             <th>Designation/पद</th>
            <th>Directorate/निदेशालय</th>
            <th>Status/स्थिति</th>
             
             </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </fieldset>

    <script>
 
$(document).ready(function() {
$("#accordion").accordion({
          heightStyle: "content",
          collapsible: true,
          active: false
      });
$('#request_date').datepicker({
     dateFormat: 'dd-mm-yy',
   //dateFormat: 'yy-mm-dd',
     showButtonPanel: true,
     //minDate: dateToday,
     altField: "#alternate_date",
     //altFormat: "DD, d MM, yy"
   altFormat: "yy-mm-dd"
   });
   
   $('#request_date2').datepicker({
     dateFormat: 'dd-mm-yy',
    //dateFormat: 'yy-mm-dd',
     showButtonPanel: true,
     //minDate: dateToday,
     altField: "#alternate_date2",
     //altFormat: "DD, d MM, yy"
   altFormat: "yy-mm-dd"
   });

 }); //document ready

 function view()
    {
      
    var dir_id= $('#dir_code').val();
    var srno=0;
      //var dt1=$('#alternate_date').val();
    //var dt2=$('#alternate_date2').val();
    var status_code = $('#status').val();

    alert (status_code);
    $('#table_verified_list > tbody').empty();
      
      
           $.ajax({
            type: "POST",
      // url:"<?php echo base_url() . 'ReportFamilyVerification/get_family_verification_report/'?>"+dir_id+"/"+dt1+"/"+dt2,
       url:"<?php echo base_url() . 'CountFamilyVerification/get_family_verification_count/'?>"+dir_id+"/"+status_code,
           dataType: "JSON",
           success: function(data){    
          $.each(data,function(index, val) {
            $('#fset_emp_list').removeClass('hide');
    $('#fset_emp_list').addClass('show');
      var html="<tr><td>"+ ++srno +"</td>"; 
       html+="<td>"+data[index].login_id+"</td>";  
      html+="<td>"+data[index].name+"</td>"; 
       html+="<td>"+data[index].desig_desc+"</td>"; 
       html+="<td>"+data[index].dte_desc+"</td>";
      switch(data[index].status)
        {
                case 'R': 
                var_status = 'Rejected';
                var_remarks= (data[index].remarks);
                 break;
                case 'V': 
                var_status = 'Verified';
                var_remarks= '';
                 break;
         } 

       html+="<td>"+var_status+"</td>";  
      
      
        html+="</tr>";
                $('#table_verified_list > tbody:last-child').append(html);
                });

              },
              error: OnError
                    // error: function(){
                    //               msg="Error while getting Family verified list of Employees !";
                    //               window.alert(msg);
                    //           }
       
        }); //ajax_list_dtwise
} // function view()

    
    
    function OnError(xhr, errorType, exception) {
                var responseText;
                $("#dialog").html("");
                try {
                    responseText = jQuery.parseJSON(xhr.responseText);
                    $("#dialog").append("<div><b>" + errorType + " " + exception + "</b></div>");
                    $("#dialog").append("<div><u>Exception</u>:<br /><br />" + responseText.ExceptionType + "</div>");
                    $("#dialog").append("<div><u>StackTrace</u>:<br /><br />" + responseText.StackTrace + "</div>");
                    $("#dialog").append("<div><u>Message</u>:<br /><br />" + responseText.Message + "</div>");
                } catch (e) {
                    responseText = xhr.responseText;
                    $("#dialog").html(responseText);
                }
                $("#dialog").dialog({
                    title: "jQuery Exception Details",
                    width: 700,
                    buttons: {
                        Close: function () {
                            $(this).dialog('close');
                        }
                    }
                });
            } //closing function OnError

        </script>
    
