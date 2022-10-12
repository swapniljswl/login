<link href="<?php echo base_url('assets/css/jquery.treetable.css')?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/jquery.treetable.theme.default.css')?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/jquery.treetable.js'); ?>"></script>

<div class="content">
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="page-title-box">
        <h4 class="page-title">Role Priviledge</h4>

        <ol class="breadcrumb p-0 m-0">

          <li>
            <a href="#">Administration</a>
          </li>
          <li class="active">
            Role Priviledge Master
          </li>
        </ol>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>

 <form class="form">
  
      <div class="form-group">
        <button type="button" class="btn btn-info waves-effect waves-light w-lg m-r-10 m-b-5" id="save_btn">Save</button>
      </div>
    
  <div class="card-box role_dtl">
    <div class="form-group row">  
        <label for="role_list">Select Role</label>
        <select id="role_list" class="form-control" required="" data-parsley-group="grp1">
          <option value=""></option>
          <?php
            foreach ($roles as $item) {
              echo '<option value="'.$item['role_id'].'">'.$item['role_name'].'</option>';
            }
          ?>
        </select>
    </div>
  </div>

  <div class="card-box">

    <div class="row">
     <div class="table-responsive">
       <table id="menu_tree" class="treetable" style="font-size: 1em;">
        <thead>
          <tr>

            <th>Menu Name</th>
            <th>Title</th>
            <th class="hide">Menu_id</th>
            <th class="hide">lft</th>
            <th class="hide">rght</th>
            <th></th>
            <th class="hide"

          </tr>
        </thead>
        <tbody>
          <tr data-tt-id="<?php echo $root_menu['menu_id']; ?>">

            <td><?php echo $root_menu['menu_name']; ?></td>
            <td><?php echo $root_menu['title'];?></td>
            <td class="hide"><?php echo $root_menu['menu_id'];?></td>
            <td class="hide"><?php echo $root_menu['lft'];?></td>
            <td class="hide"><?php echo $root_menu['rght'];?></td>
            <td></td>
          </tr>

          <?php
          foreach ($menu_items as $menu_item)
          {
            echo '<tr data-tt-id="'.$menu_item['menu_id'].'" data-tt-parent-id="'.$menu_item['parent_id'].'">';

            echo '<td>'.$menu_item['menu_name'].'</td>';
            echo '<td>'.$menu_item['title'].'</td>';
            echo '<td class="hide">'.$menu_item['menu_id'].'</td>';
            echo '<td class="hide">'.$menu_item['lft'].'</td>';
            echo '<td class="hide">'.$menu_item['rght'].'</td>';
            echo '<td><input type="checkbox" value="1"></td>';
            echo '</tr>';
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
              
 </form>

</div><!--Eno of Conatiner-->
<script>
$("#menu_tree").treetable({ expandable: true,clickableNodeNames: true,initialState: "collapsed" });
$(document).ready(function(){
  $('#role_list').change(function(){
    role_id=$(this).val();
    $('#menu_tree > tbody').each(function(i,val){
      $(this).find('input[type*=checkbox]').prop('checked',false);
    });
    if(role_id!=''){
    $.ajax({
      type:"POST",
      url:"<?php echo base_url('Role_Priviledge/get_role_menu');?>",
      data:{role_id : role_id},
      success:function(response){
        response=JSON.parse(response);
        if(response.error==true){
          show_info_dialog(response.error_msg);
        }
        else
        {
          $.each(response.role_menu,function(i,val){
            row=$('#menu_tree > tbody').find('tr[data-tt-id='+response.role_menu[i].menu_id+']');
            chk_box=row.find('input[type*=checkbox]');
            chk_box.prop('checked',true);
            chk_box.change();
          });
          $('#menu_tree').treetable("expandAll");
        }
      },
      error:function(){
        msg='Error while getting menu details.';
        show_info_dialog(msg);
      }
    });
  }
  else
    $('#menu_tree').treetable("collapseAll");
  });
  $('#menu_tree').on('change','input[type=checkbox]',function(){
    // $(this).closest('tr').toggleClass('changed');
    menu_id=$(this).closest('tr').attr('data-tt-id');
    chk_box_val=$(this).closest('tr').find('input[type*=checkbox]').is(':checked');
    sub_row=$('#menu_tree').find('tr[data-tt-parent-id='+menu_id+']');
    sub_chk_box=sub_row.find('input[type*=checkbox]');
    sub_chk_box.prop('checked',chk_box_val);
    sub_chk_box.prop('disabled',chk_box_val);
    sub_row.removeClass('changed');
  });
   $('#menu_tree').on('click','input[type=checkbox]',function(){
      $(this).closest('tr').toggleClass('changed');
   });
  $('#save_btn').click(function(){
    $('.form').parsley().whenValidate({
        group : 'grp1'
      }).done(function(){
      var menu_perm={};
      $('#menu_tree > tbody tr.changed').each(function(i,val){
        menu_perm[i]={
          role_id   : $('#role_list').val(),
          menu_id   : $(this).find('td:eq(2)').text(),
          val       : ($(this).find('input[type*=checkbox]').is(':checked'))?1:0
        };
      });
      menu_perm=JSON.stringify(menu_perm);
      //console.log(menu_perm);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url('Role_Priviledge/save') ?>",
          data:{csrf_token:csrf_token,role_priv : menu_perm},
        //data:{role_priv : menu_perm},
        success:function(response){
          response=JSON.parse(response);
            csrf_token=response.csrf_token;
          if(response.error==true){
            show_info_dialog(response.error_msg);
          }
          else{
            show_info_dialog(response.msg,response.url);
          }
        },
        error:function(){
          msg="Error while saving role priviledges";
          show_info_dialog(msg);
        }
      });
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