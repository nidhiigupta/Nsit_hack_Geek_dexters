<!-- page content -->
<div class="right_col" role="main">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
<div class="x_title">
<h2>Influencers <small>list</small></h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Settings 1</a>
    </li>
    <li><a href="#">Settings 2</a>
    </li>
  </ul>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="x_content">
<p class="text-muted font-13 m-b-30">
List of all influencers
</p>
<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="row"><div class="col-sm-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
<thead>
  <tr role="row">
    <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 200px;">Name</th>
    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;">Email</th>
    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">Phone</th>
    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 165px;">Date</th>
    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 10px;">Action</th>
  </tr>
</thead>
<tbody>
<?php
  if(isset($influencers)|| 1):
    $n=1;
    foreach($influencers as $inf):
?>
<tr role="row" class="odd">
    <td tabindex="0" class="sorting_1"><?php echo$inf->inf_name;?></td>
    <td><?php echo$inf->inf_email;?></td>
    <td><?php echo$inf->inf_phone;?></td>
    <td><?php echo$inf->inf_signup_date;?></td>
    <td>
      <?php if($inf->is_active){?>
      <button class="fa btn fa-ban btn-danger" onclick="toggle_suspend_influencer(<?php echo$inf->inf_id?>,this)"></button>
      <?php }else{?>
      <button class="fa btn fa-check btn-success" onclick="toggle_suspend_influencer(<?php echo$inf->inf_id?>,this)"></button>
      <?php }?>
      <button class="fa btn fa-trash-o btn-danger" onclick="delete_influencer(<?php echo$inf->inf_id?>,this)"></button>
    </td>
</tr>
<?php endforeach; endif;?>
</tbody>
</table></div></div>
  <!---->
</div>
</div>
</div>
</div>
</div>
</div>
<!-- /page content -->


<script type="text/javascript">
  function toggle_suspend_influencer(id,obj){
    $.post("<?php echo SITEURL.'admin/update_influencer';?>",{id:id},function(d,s){
      if(d.status == true){
        if($(obj).attr('class')==='fa btn fa-check btn-success'){
          swal(d.title, d.msg, "success");
          $(obj).removeClass('fa-check btn-success');
          $(obj).addClass('fa-ban btn-danger');
        }else{
          swal(d.title, d.msg, "success");
          $(obj).removeClass('fa-ban btn-danger');
          $(obj).addClass('fa-check btn-success');
        }
      }
      else{
        swal(d.title, d.msg, "error");
      }
    });
  }
  function delete_influencer(id,obj){
     swal({
        title: "Are you sure?",
        text: "You can not recover influencer later",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.post("<?php echo SITEURL.'admin/delete_influencer';?>",{id:id,},function(d){
            if(d.status == true){
              $(obj).parent().parent().remove();
              swal("Deleted!", d.msg, 'success');
            }else{
              swal("Failed!", d.msg, 'error');
            }

          });

        }else{
          swal("Cancelled",'Data is safe', "error");
        }
      });

  }
</script>
