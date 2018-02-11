<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Total Brands<small>Details</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li>
                <li><a href="#">Settings 2</a></li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">List of all brands </p>
          <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
              <div class="col-sm-12">
                <table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 200px;">Name</th>
                      <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 100px;">Email</th>
                      <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 100px;">Phone</th>
                      <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Website: activate to sort column ascending" style="width: 165px;">Website</th>
                      <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 10px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($brands)):
                      $key=1;
                      foreach($brands as $brand):
                        $n=($key%2==0)?'even':'odd';
                        ?>
                        <tr role="row" class="<?php echo $n;?>">
                          <td tabindex="0" class="sorting_1"><?php echo$brand->brand_name;?></td>
                          <td><?php echo$brand->brand_email;?></td>
                          <td><?php echo$brand->brand_phone;?></td>
                          <td><?php echo$brand->brand_website;?></td>
                          <td>
                            <button class="fa btn <?php echo ($brand->is_active)?'fa-ban btn-danger':'fa-check btn-success';?>" onclick="toggle_suspend_brand(<?php echo$brand->brand_id?>,this)"  id="<?php echo "id_s_".$key;?>"  aria-hidden="true"></button>
                            <button class="fa fa-trash-o btn btn-danger" onclick="delete_brand(<?php echo$brand->brand_id?>,this)"  id="<?php echo "id_d_".$key; $key++;?>"  aria-hidden="true"></button>
                          </td>
                        </tr>
                      <?php endforeach; endif;?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->
  <script type="text/javascript">
  function toggle_suspend_brand(id,obj){
    $.post("<?php echo SITEURL.'admin/update_brand';?>",{id:id},function(d,s){
      if(d.status == true){
        if($(obj).attr('class')==='fa btn fa-check btn-success'){
          swal(d.title, d.msg, "success");
          $('#'+ $(obj).attr('id')).removeClass('fa-check btn-success');
          $('#'+ $(obj).attr('id')).addClass('fa-ban btn-danger');
        }else{
          swal(d.title, d.msg, "success");
          $('#'+ $(obj).attr('id')).removeClass('fa-ban btn-danger');
          $('#'+ $(obj).attr('id')).addClass('fa-check btn-success');
        }
      }
      else{
        swal(d.title, d.msg, "error");
      }
    });
  }
  function delete_brand(id,obj){
    swal({
      title: "Are you sure?",
      text: "You can not recover brand later",
      type: "error",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, Delete it!",
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: true
    },
    function(isConfirm){
      if (isConfirm) {
        $.post("<?php echo SITEURL.'admin/delete_brand';?>",{id:id,},function(d){
          if(d.status == true){
            $('#' + $(obj).attr('id')).parent().parent().remove();
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
