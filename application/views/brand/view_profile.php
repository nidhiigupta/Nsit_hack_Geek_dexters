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
            <?php echo form_open_multipart(SITEURL.'brand/update_profile','id="update-profile-form"');?>
            <div class="input-group">
              <span class="input-group-addon">Image</span>
              <input type="file" class="form-control" name="userfile" id="userfile">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Name</span>
              <input type="text" class="form-control" placeholder="Your name" value="<?php echo $profile->name?>" name="profile_name">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Email</span>
              <input type="email" min="0" class="form-control" placeholder="Your email" disabled="disabled" value="<?php echo $profile->email?>" name="profile_email">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Mobile</span>
              <input type="number" min="0" class="form-control" placeholder="Your contact no" value="<?php echo $profile->phone?>" name="profile_contact">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon1">Website</span>
              <input type="url" class="form-control" name="profile_website" value="<?php echo $profile->website?>">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
            <?php echo form_close();?>
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-8">
      <a href="javascript:void(0)" class="widget widget-hover-effect2">
        <div class="widget-extra themed-background-dark">
          <h4 class="widget-content-light"><strong>Wallet</strong></h4>
        </div>
        <div class="widget-extra-full">
          <span class="h2 themed-color-dark animation-expandOpen"><?php echo $wallet_amount ?> INR</span>
          <hr>
          <form class="" action="<?php echo SITEURL.'payu/' ?>create_payment_with_payu" method="post">
            <input class="form-control" type="text" name="amount" value="1000.0" required>
            <button class="btn btn-success" type="submit" name="button">Add money</button>
          </form>

        </div>
      </a>
    </div>

  </div>
  <!-- END Customer Content -->
</div>
<!-- END Page Content -->
