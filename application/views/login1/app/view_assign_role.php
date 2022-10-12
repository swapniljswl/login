 <link href="<?php echo base_url('assets/css/jquery.treetable.css')?>" rel="stylesheet" type="text/css">
 <link href="<?php echo base_url('assets/css/jquery.treetable.theme.default.css')?>" rel="stylesheet" type="text/css">
 
 <script src="<?php echo base_url('assets/js/jquery.treetable.js'); ?>"></script>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-title-box">
						<h4 class="page-title">User Role Assignment</h4>

						<ol class="breadcrumb p-0 m-0">

							<li>
								<a href="#">Administration</a>
							</li>
							<li class="active">
								User Role Assignment
							</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<form class="form">

		      <div class="form-group">
		        <button type="button" class="btn btn-info waves-effect waves-light w-lg m-r-10 m-b-5" id="save_btn" disabled>Save</button>
		        <button type="button" class="btn btn-info waves-effect waves-light w-lg m-r-10 m-b-5" id="reset_btn">Reset</button>
		      </div>
				<div class="card-box form-group">
					<div class="row">
						<div class="col-sm-6">
							<label for="user_id">User Id</label>
							<input type="text" class="form-control" id="user_id">
						</div>
						<div class="col-sm-4">
						<button type="button" class="btn btn-info waves-effect waves-light w-lg m-r-10 m-b-5 m-t-30" id="get_user_dtl">Get Detail</button>
						</div>
					</div>
					<div class=" row user_dtl hide m-r-10 m-l-5">
						<p><b>User ID:</b><span id="login_id" class="user_info m-l-5"></span></p>
						<p><b>Name:</b><span id="user_name" class="user_info m-l-5"></span></p>
						<p><b>Designation:</b><span id="desig" class="user_info m-l-5"></span></p>
						<p><b>Diretorate:</b><span id="dte" class="user_info m-l-5"></span></p>
					</div>
				</div>
				<div class="card-box">

					<div class="row">
						<div class="table-responsive">
							<table id="role_tree" class="treetable" style="font-size: 1em;">
								<thead>
									<tr>

										<th>Role Name</th>
										<th style="display:none;">Role_id</th>
										<th style="display: none;">lft</th>
										<th style="display: none;">rght</th>
										<th></th>

									</tr>
								</thead>
								<tbody>
									<tr data-tt-id="<?php echo $root_role['role_id']; ?>">

										<td><?php echo $root_role['role_name']; ?></td>
										
										<td class="hide"><?php echo $root_role['role_id'];?></td>
										<td class="hide"><?php echo $root_role['lft'];?></td>
										<td class="hide"><?php echo $root_role['rght'];?></td>
										<td></td>
									</tr>

									<?php
									foreach ($role_items as $role_item)
									{
										echo '<tr data-tt-id="'.$role_item['role_id'].'" data-tt-parent-id="'.$role_item['parent_id'].'">';

										echo '<td>'.$role_item['role_name'].'</td>';
										
										echo '<td style="display:none;">'.$role_item['role_id'].'</td>';
										echo '<td style="display:none;">'.$role_item['lft'].'</td>';
										echo '<td style="display:none;">'.$role_item['rght'].'</td>';
										echo '<td><input type="checkbox"></td>';
										echo '</tr>';
									}

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
	</div><!-- End of Container-->
<script>
$("#role_tree").treetable({ expandable: true,clickableNodeNames: true,initialState: "expanded" });

$(document).ready(function(){	

	$('#role_tree').on('change','input[type=checkbox]',function(){
    // $(this).closest('tr').toggleClass('changed');
    role_id=$(this).closest('tr').attr('data-tt-id');
    chk_box_val=$(this).closest('tr').find('input[type*=checkbox]').is(':checked');
    sub_row=$('#role_tree').find('tr[data-tt-parent-id='+role_id+']');
    sub_chk_box=sub_row.find('input[type*=checkbox]');
    sub_chk_box.prop('checked',chk_box_val);
    sub_chk_box.prop('disabled',chk_box_val);
    sub_row.removeClass('changed');
  });
   $('#role_tree').on('click','input[type=checkbox]',function(){
      $(this).closest('tr').toggleClass('changed');
   });

   $('#get_user_dtl').click(function(){
   	user_id=$('#user_id').val();
   	$.ajax({
   		type:"POST",
   		url: "<?php echo base_url('Assign_Role/get_user_dtl') ?>",
   		data:{user_id :user_id},
   		success:function(response)
   		{
   			response=JSON.parse(response);
   			if(response.error==true){
   				show_info_dialog(response.error_msg);
   				$('.user_dtl').addClass('hide');
   			}
   			else
   			{
   				$('#login_id').text(response.user_dtl.login_id);
   				$('#user_name').text(response.user_dtl.name);
   				$('#desig').text(response.user_dtl.desig_desc);
   				$('#dte').text(response.user_dtl.dte_desc);
   				$('#role_tree > tbody').each(function(i,val){
      				$(this).find('input[type*=checkbox]').prop('checked',false);
      				$(this).find('input[type*=checkbox]').prop('disabled',false);
    			});
   				if(response.user_roles!=0)
   				{
   					$.each(response.user_roles,function(i,val){
			            row=$('#role_tree > tbody').find('tr[data-tt-id='+response.user_roles[i].role_id+']');
			            chk_box=row.find('input[type*=checkbox]');
			            chk_box.prop('checked',true);
			            chk_box.change();
			        });

			        $('#role_tree').treetable("expandAll");
   				}
   				$('.user_dtl').removeClass('hide');
   				$('#user_id').prop('disabled',true);
   				$('#get_user_dtl').prop('disabled',true);
   				$('#save_btn').prop('disabled',false);
   			}
   		},
   		error:function()
   		{
   			msg="Error while getting user details.";
   			show_info_dialog(msg);
   			$('.user_dtl').addClass('hide');
   		}
   	})
   });
   
   $('#save_btn').click(function(){
   	var user_roles={};
      $('#role_tree > tbody tr.changed').each(function(i,val){
        user_roles[i]={
          role_id   : $(this).find('td:eq(1)').text(),
          user_id   : $('#user_id').val(),
          val       : ($(this).find('input[type*=checkbox]').is(':checked'))?1:0
        };
      });
      user_roles=JSON.stringify(user_roles);
      console.log(user_roles);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url('Assign_Role/save') ?>",
        data:{user_roles : user_roles},
        success:function(response){
          response=JSON.parse(response);
          if(response.error==true){
            show_info_dialog(response.error_msg);
          }
          else{
            show_info_dialog(response.msg,response.url);
          }
        },
        error:function(){
          msg="Error while saving user roles.";
          show_info_dialog(msg);
        }
      });

   });
   $('#reset_btn').click(function(){
   		$('.user_info').text('');
   		$('.user_dtl').addClass('hide');
		$('#user_id').prop('disabled',false);
		$('#get_user_dtl').prop('disabled',false);
		$('#user_id').val('');
		$('#save_btn').prop('disabled',true);
		$('#role_tree > tbody').each(function(i,val){
      		$(this).find('input[type*=checkbox]').prop('checked',false);
      		$(this).find('input[type*=checkbox]').prop('disabled',false);
    	});
   });

   $('button').focusin(function(){
      $(this).toggleClass('btn-primary');
      $(this).toggleClass('btn-info');
    });

    $('button').focusout(function(){
      $(this).toggleClass('btn-primary');
      $(this).toggleClass('btn-info');
    });
});
</script>