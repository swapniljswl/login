
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
          <h5 style="color: blue";>Profile Verified List/प्रोफ़ाइल सत्यापित सूची</h5>
        </div>
		   </div>  
        <fieldset class="fset" id="book_rh">
      <legend class="legend"></legend>
      <div class="row form-group">
          
      
          <div class="col-md-12">
           <b>Directorate/निदेशालय:-</b>
           <select id="dir_code" name="dir_code">
                      <option value="1000">All Directorate</option>
                      <?php
                     foreach($directorate_list as $directorate)
                     {
                       echo '<option value="' .$directorate['dte_id']. '">' .$directorate['dte_desc'].'</option>';
                       // echo '<option value="' .$directorate->dte_id. '">' .$directorate->dte_desc.'</option>';
                     }
                     ?>
                    </select>

                 <b>  From:-</b>
         
     <?php 
			 echo form_input(array('name'=>'alternate_date','id'=>'alternate_date','type'=>'text','data-date-format'=>'dd-mm-yyyy','data-provide'=>'datepicker','placeholder'=>'dd-mm-yyyy','readonly'=>'true')); " </td>"	
				?>
      
     <b>To:-</b>
        
           <?php 
			 echo form_input(array('name'=>'alternate_date2','id'=>'alternate_date2','type'=>'text','data-date-format'=>'dd-mm-yyyy','data-provide'=>'datepicker','placeholder'=>'dd-mm-yyyy','readonly'=>'true')); " </td>"	
				?>
       
            <input type="button" class="btn btn-outline-primary btn-sm btn-primary"  onclick="view()" name="view" value="Get Records">
      </div>
      
          
    </fieldset>
        
       <fieldset class="fset app_list hide" id="fset_emp_list" style="font-size: .8em">
       <legend class="legend">List of Employees of selected directorate whose Profile details have been Verified/Rejected/चयनित निदेशालय के कर्मचारियों की सूची जिनका प्रोफाइल विवरण सत्यापित/अस्वीकार कर दिया गया है</legend>
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
             <th>Verified by/द्वारा सत्यापित</th>
             <th>Verified on/सत्यापित  तिथि</th>
             <th>Remarks/टिप्पणियां</th>
             </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </fieldset>

    <script>
 
$(document).ready(function() {

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
      var dt1=$('#alternate_date').val();
    var dt2=$('#alternate_date2').val();
	//alert(dt1);alert(dt2);exit;
    $('#table_verified_list > tbody').empty();
      
      
           $.ajax({
            type: "POST",
      url:"<?php echo base_url() . 'ReportProfileVerification/get_profile_verification_report/'?>"+dir_id+"/"+dt1+"/"+dt2,
           //dataType: "JSON",
          //  success: function(data){    
          // $.each(data,function(index, val) {
             data:{csrf_token:csrf_token},   
                success: function(data){
             data=JSON.parse(data);         
            csrf_token=data.csrf_token;
             $.each(data.rep_data,function(index, val) {    
            $('#fset_emp_list').removeClass('hide');
    $('#fset_emp_list').addClass('show');
      var html="<tr><td>"+ ++srno +"</td>"; 
       html+="<td>"+val.login_id+"</td>";  
      html+="<td>"+val.name+"</td>"; 
       html+="<td>"+val.desig_desc+"</td>"; 
       html+="<td>"+val.dte_desc+"</td>";
      switch(val.status)
        {
                case 'R': 
                var_status = 'Rejected';
                var_remarks= (val.remarks);
                 break;
                case 'V': 
                var_status = 'Verified';
                var_remarks= '';
                 break;
         } 

       html+="<td>"+var_status+"</td>";  
      html+="<td>"+val.verified_by+"</td>"; 
       html+="<td>"+val.verified_on+"</td>"; 
       html+="<td>"+var_remarks+"</td>"; 
      
        html+="</tr>";
                $('#table_verified_list > tbody:last-child').append(html);
                });

              },
                    error: function(){
                                  msg="Error while getting Family verified list of Employees !";
                                  window.alert(msg);
                              }
       
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
      
