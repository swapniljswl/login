
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
<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
        
          </span>
          </div>
 <div  class="row form-group" >
   <div class="col-md-12" align="text-center">
          <h5 style="color: blue" align="text-center">Assign/Delete Family Admin Role/फ़ैमिली एडमिन की भूमिका असाइन/हटाएं</h5>
        </div>
		   </div>  
        <fieldset class="fset" id="book_rh">
      <legend class="legend"></legend>
      <div class="row form-group">
          
      
          <div class="col-md-12">
           <span class="label label-default  text-primary">Directorate/निदेशालय:</span>
           <select id="dir_code" name="dir_code">
                     <option value="1000">All Directorates</option>
                      <?php
                     foreach($directorate_list as $directorate)
                     {
            echo '<option value="' .$directorate->dte_id. '">' .$directorate->dte_desc.'</option>';
                     }
                     ?>
                    </select>

                    <input type="button" class="btn btn-outline-primary btn-sm btn-info"  onclick="view()" name="view" value="View">
      </div>
      
          
    </fieldset>
        <fieldset class="fset app_list hide" id="fset_emp_list" style="font-size: .8em">
       <legend class="legend">List of Employees of selected directorate/चयनित निदेशालय के कर्मचारियों की सूची</legend>
      <div class='col-md-12 table-responsive' >
        <table class="table table-condensed table-hover" id="table_application_list">
          <thead>
            <tr>
            <th>SNo/क्रमांक</th>    
            <th>IPAS ID/कर्मचारी सं</th>
             <th>Name/नाम</th>
             <th>Designation/पद</th>
            <th>Directorate/निदेशालय</th>
            <th>Role Name/भूमिका का नाम</th>
            <th>Family Role/पारिवारिक भूमिका</th> 

       
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


 }); //document ready

 function view()
    {
      
    var dir_id= $('#dir_code').val();
    var srno=0;
        var user_type1='';
    $('#table_application_list > tbody').empty();
      
      
           $.ajax({
            type: "POST",
      url:"<?php echo base_url() . 'FamilyRole/get_emp_list/'?>"+dir_id,
      
     
      
            dataType: "JSON",
           success: function(data){
      console.log(data);          
                     
          $.each(data,function(index, val) {

            $('#fset_emp_list').removeClass('hide');
    $('#fset_emp_list').addClass('show');
      var html="<tr><td>"+ ++srno +"</td>"; 
       html+="<td>"+data[index].login_id+"</td>";  
      html+="<td>"+data[index].name+"</td>"; 
       html+="<td>"+data[index].dte_desc+"</td>"; 
       html+="<td>"+data[index].desig_desc+"</td>"; 
       
      
      switch(data[index].user_type)
        {
                case null:
                user_type1= '';
                 break;
                case "" :
                 user_type1= '';
                 break;
                case ('0'): 
                  user_type1= '';
                  break;
                case ('4'): 
                  user_type1= 'Dir Admin';
                  break;
                 case ('2'): 
                 user_type1= 'Sub Super Admin';
                  break;
                case ('3'): 
                  user_type1= 'Super Admin'; 
                  break;
                case ('5'): 
                  user_type1= 'Profile Admin'; 
                  break;
                case ('6'):
                 user_type1='Family Admin';
                  break;
				  case ('7'):
                 user_type1='';
                  break; 
                  
        }
       
        html+="<td>"+user_type1+"</td>"; 
      
         if(data[index].user_type =='' || data[index].user_type ==null || data[index].user_type =='0'|| data[index].user_type =='7')
              {
                
                 html+="<td><a class='grant btn-outline-primary' id='"+data[index].login_id+"'  href='#'>Grant</a></td>"; 

              } 
              else if (data[index].user_type =='6')
                {
                
                html+="<td><a class='delete btn-outline-primary' id='"+data[index].login_id+"'  href='#'  onClick='event.preventDefault();'>Revoke</a></td>"; 
              } 
              else 
                {
                
                html+="<td></td>"; 
              } 
            
         
      html+="</tr>";
                   $('#table_application_list > tbody:last-child').append(html);
 
                });

              },
                            error: function(){
                                  msg="Error while getting employee list";
                                  window.alert(msg);
                              }
        }); //ajax_list_dtwise
} // function view()

    
$('#table_application_list').on('click','.grant',function()
    {
          var id1 = $(this).prop('id'); 
          $.ajax({
            url:"<?php echo base_url() . 'FamilyRole/grant_family_role'?>/" + id1,
             type: "POST",
            success:function(response){
                   msg="Family Role Granted";
                   window.alert(msg);
 
 
                var dir_id= $('#dir_code').val();
                var srno=0;
                    var user_type1='';
                $('#table_application_list > tbody').empty();

                 $.ajax({
                          type: "POST",
                          url:"<?php echo base_url() . 'FamilyRole/get_emp_list/'?>"+dir_id,
                          dataType: "JSON",
                          success: function(data){
                                  $.each(data,function(index, val) {

                                    $('#fset_emp_list').removeClass('hide');
                                    $('#fset_emp_list').addClass('show');
                                    var html="<tr><td>"+ ++srno +"</td>"; 
                                    html+="<td>"+data[index].login_id+"</td>";  
                                    html+="<td>"+data[index].name+"</td>"; 
                                    html+="<td>"+data[index].dte_desc+"</td>"; 
                                    html+="<td>"+data[index].desig_desc+"</td>"; 
                                       switch(data[index].user_type)
                                        {
                                           case null:
                user_type1= '';
                 break;
                case "" :
                 user_type1= '';
                 break;
                case ('0'): 
                  user_type1= '';
                  break;
                case ('4'): 
                  user_type1= 'Dir Admin';
                  break;
                 case ('2'): 
                 user_type1= 'Sub Super Admin';
                  break;
                case ('3'): 
                  user_type1= 'Super Admin'; 
                  break;
                case ('5'): 
                  user_type1= 'Profile Admin'; 
                  break;
                case ('6'):
                 user_type1='Family Admin';
                  break;
				  case ('7'):
                 user_type1='';
                  break; 
                    
                                            }
         
                                        html+="<td>"+user_type1+"</td>"; 
      
                                        if(data[index].user_type =='' || data[index].user_type ==null || data[index].user_type =='0'|| data[index].user_type =='7')
                                          {
                                           html+="<td><a class='grant btn-outline-primary' id='"+data[index].login_id+"'  href='#'>Grant</a></td>"; 
                                          } 
                                          else if (data[index].user_type =='6')
                                            {
                                          html+="<td><a class='delete btn-outline-primary' id='"+data[index].login_id+"'  href='#'>Revoke</a></td>"; 
                                              } 
                                          else 
                                            {
                                             html+="<td></td>"; 
                                             } 
                                             html+="</tr>";
                                       $('#table_application_list > tbody:last-child').append(html);
 
                                });

                              },
                               error: function(){
                                  msg="Error while getting employee list";
                                  window.alert(msg);
                              }
                            }); // $.ajax({ Directrare wise list

              },  //success:function(response){
               
                    error: function(){
                      msg="Error while granting Family Role";
                    window.alert(msg);
              }
           
        }); // $.ajax({ Grant
      
     });





    $('#table_application_list').on('click','.delete',function()
    {
          var id1 = $(this).prop('id'); 
          $.ajax({
            url:"<?php echo base_url() . 'FamilyRole/revoke_family_role'?>/" + id1,
             type: "POST",

              success:function(response){
                   msg="Family Role Revoked";
                   window.alert(msg);

var dir_id= $('#dir_code').val();
                var srno=0;
                    var user_type1='';
                $('#table_application_list > tbody').empty();

                 $.ajax({
                          type: "POST",
                          url:"<?php echo base_url() . 'FamilyRole/get_emp_list/'?>"+dir_id,
                          dataType: "JSON",
                          success: function(data){
                                  $.each(data,function(index, val) {

                                    $('#fset_emp_list').removeClass('hide');
                                    $('#fset_emp_list').addClass('show');
                                    var html="<tr><td>"+ ++srno +"</td>"; 
                                    html+="<td>"+data[index].login_id+"</td>";  
                                    html+="<td>"+data[index].name+"</td>"; 
                                    html+="<td>"+data[index].dte_desc+"</td>"; 
                                    html+="<td>"+data[index].desig_desc+"</td>"; 
                                       switch(data[index].user_type)
                                        {
                                           case null:
                user_type1= '';
                 break;
                case "" :
                 user_type1= '';
                 break;
                case ('0'): 
                  user_type1= '';
                  break;
                case ('4'): 
                  user_type1= 'Dir Admin';
                  break;
                 case ('2'): 
                 user_type1= 'Sub Super Admin';
                  break;
                case ('3'): 
                  user_type1= 'Super Admin'; 
                  break;
                case ('5'): 
                  user_type1= 'Profile Admin'; 
                  break;
                case ('6'):
                 user_type1='Family Admin';
                  break;
				  case ('7'):
                 user_type1='';
                  break; 
                    
                                            }
         
                                        html+="<td>"+user_type1+"</td>"; 
      
                                        if(data[index].user_type =='' || data[index].user_type ==null || data[index].user_type =='0'|| data[index].user_type =='7')
                                          {
                                           html+="<td><a class='grant btn-outline-primary' id='"+data[index].login_id+"'  href='#'>Grant</a></td>"; 
                                          } 
                                          else if (data[index].user_type =='6')
                                            {
                                          html+="<td><a class='delete btn-outline-primary' id='"+data[index].login_id+"'  href='#'>Revoke</a></td>"; 
                                              } 
                                          else 
                                            {
                                             html+="<td></td>"; 
                                             } 
                                             html+="</tr>";
                                       $('#table_application_list > tbody:last-child').append(html);
 
                                });

                              },
                               error: function(){
                                  msg="Error while getting employee list";
                                  window.alert(msg);
                              }
       
                            }); // $.ajax({ Directrare wise list




                },  //success:function(response){
                   
            error: function(){
                      msg="Error while Revoking Profile Role";
                    window.alert(msg);
           }
        }); // $.ajax({
      
     });

        </script>
       
