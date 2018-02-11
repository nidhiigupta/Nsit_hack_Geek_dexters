<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<div id="page-content">
  <!-- Customer Content -->
  <div class="row">
    <div class="col-lg-4">
      <!-- Customer Info Block -->
      <div class="block">
        <!-- Customer Info Title -->
        <div class="block-title">
          <h2><i class="fa fa-file-o"></i> <strong>Brand</strong> Info</h2>
        </div>
        <!-- END Customer Info Title -->

        <!-- Customer Info -->
        <div class="block-section text-center">
          <a href="javascript:void(0)">
            <img src="<?php echo $this->custom_functions->check_img($profile->image)?>" alt="avatar" style="width: 300px">
          </a>
          <h3>
            <strong><?php echo $profile->name;?></strong><br><small></small>
          </h3>
        </div>
        <table class="table table-borderless table-striped table-vcenter">
          <tbody>
            <tr>
              <td class="text-right" style="width: 50%;"><strong>Member since</strong></td>
              <td><?php echo date("d-m-Y", strtotime($profile->created)) ?></td>
            </tr>
            <tr>
              <td class="text-right"><strong>Status</strong></td>
              <td><span class="label label-success"><i class="fa fa-check"></i> Active</span></td>
            </tr>
          </tbody>
        </table>
        <!-- END Customer Info -->
      </div>
      <!-- END Customer Info Block -->

      <!-- END Quick Stats Block -->
    </div>
    <div class="col-lg-8">
      <div class="block">
        <!-- Forum Tabs Title -->
        <div class="block-title">
          <ul class="nav nav-tabs view_camp_category" data-toggle="tabs">
            <li class="active"><a href="#main-profile-data">Profile</a></li>
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane active" id="main-profile-data">
            <div class="input-group">
              <span class="input-group-addon">Name</span>
              <input type="text" class="form-control" placeholder="Your name" value="<?php echo $profile->name?>" name="profile_name">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Email</span>
              <input type="email" min="0" class="form-control" placeholder="Your email" disabled="disabled" value="<?php echo $profile->email?>" name="profile_email">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon1">Website</span>
              <input type="url" class="form-control" name="profile_website" value="<?php echo $profile->website?>">
            </div>
          </div>

        </div>
      </div>
    </div>


  </div>
  <!-- END Customer Content -->
</div>
<!-- END Page Content -->
