<!-- page content -->
<div id="page-content">
  <div class="content-header content-header-media">
    <div class="header-section">
      <a href="page_ready_user_profile.php">
        <img src="<?php echo ASSETS.'proui/' ?>img/placeholders/headers/article_header.jpg" alt="header image" class="animation-pulseSlow">
      </a>
      <h1>Administrators</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
      <!-- Article Block -->
      <div class="block block-alt-noborder">
        <h1>Administrators</h1>
        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <p class="text-muted font-13 m-b-30">
            <?php echo form_input(array('type'=>'button','class'=>'btn btn-success', 'value'=>'Create New Admin','data-toggle'=>"modal" , 'title'=>"Update Account" ,'data-target'=>"#myModal"));?>
          </p>
          <div class="row"><div class="col-sm-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 241px;">Name</th>
                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 350px;">Email</th>
                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 100px;">Phone</th>
                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 120px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(isset($admins)|| 1):
                foreach($admins as $admin):
                  ?>
                  <tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><?php echo$admin->admin_name;?></td>
                    <td><?php echo$admin->admin_email;?></td>
                    <td><?php echo$admin->admin_phone;?></td>
                    <td class="text-center">
                      <button  class="fa fa-refresh btn btn-success" data-toggle="modal"  title="Update Account" data-target="#myModal"></button>
                      <button  class="fa fa-trash-o btn btn-danger" title="Delete Account"></button>
                    </td>
                  </tr>
                <?php endforeach; endif;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Admin Profile</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(SITEURL.'admin/do_signup','class="form-horizontal" id="admin-registration-form" onsubmit="return false;"');?>
        <div class="form-group">
          <?php echo form_label('Name*','name',array('class'=>'control-label col-sm-2'));?>
          <div class="col-sm-10">
            <?php echo form_input(array('name'=>'name','class'=>'form-control','placeholder'=>'Enter your name'));?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Email*','email',array('class'=>'control-label col-sm-2'));?>
          <div class="col-sm-10">
            <?php echo form_input(array('name'=>'email','class'=>'form-control','placeholder'=>'Enter your email'));?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Phone* (exact 10)','phone',array('class'=>'control-label col-sm-2'));?>
          <div class="col-sm-10">
            <?php echo form_input(array('name'=>'phone','class'=>'form-control','placeholder'=>'Enter your phone'));?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Password* (min 8)','password',array('class'=>'control-label col-sm-2'));?>
          <div class="col-sm-10">
            <?php echo form_input(array('name'=>'password','class'=>'form-control','placeholder'=>'Enter your password','type' => 'password'));?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-5">
            <label class=" btn btn-success"><input  type="file" style="display:none;">Choose image</label>
          </div>
          <div class="col-sm-5">
            <?php echo form_input(array('type'=>'submit','class'=>'btn btn-success','value'=>'Submit'));?>
          </div>
        </div>
        <?php form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
