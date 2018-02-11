<link href="<?php echo ASSETS;?>css/social-buttons.css" rel="stylesheet">
<style type="text/css">
#profile1{
  width: 95%;
  display: -webkit-inline-box;
  padding: 10px;
  padding-left: 5px;
  margin: 2.5%;
  box-shadow: 1px 1px 1px 1px;
}
</style>

<?php if($this->input->post('swal')): ?>
  <?php $swal_title = $this->input->post('title'); ?>
  <?php $swal_msg = $this->input->post('msg'); ?>
  <?php $swal_type = $this->input->post('type'); ?>
  <script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
  <script type="text/javascript">
  swal({
    title: "<?php echo $swal_title ?>",
    text: "<?php echo $swal_msg ?>",
    type: "<?php echo $swal_type ?>"
  },
  function(y){
    $.redirect(SITEURL+'influencer/profile');
  });
</script>
<?php endif; ?>

<!-- Page content -->
<div id="page-content">
  <!-- Customer Content -->
  <div class="row">
    <div class="col-lg-4">
      <!-- Customer Info Block -->
      <div class="block">
        <!-- Customer Info Title -->
        <div class="block-title">
          <h2><i class="fa fa-file-o"></i> <strong>Influencer</strong> Info</h2>
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
    </div>
    <div class="col-lg-8">
      <div class="block">
        <!-- Forum Tabs Title -->
        <div class="block-title">
          <ul class="nav nav-tabs view_camp_category" data-toggle="tabs">
            <li class="active"><a href="#main-profile-data">Profile</a></li>
            <li class=""><a href="#bank-profile-data">Bank Details</a></li>
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane active" id="main-profile-data">
            <div class="block">
              <h3>Update your profile</h3>
              <hr>
              <h5>Update your profile picture. Select from your social media account, or</h5>
              <div class="row">
                <?php
                $fb_count = 0;
                $tw_count = 0;
                $ins_count = 0;
                $yt_count = 0;
                $lin_count = 0;
                ?>
                <!-- Quick Stats Content -->
                <?php foreach ($tokens as $key => $value): ?>
                  <?php if($value['category'] == 'fb'): ?>
                    <?php $fb_count++; ?>
                    <div class="col-md-6">
                      <a target="_blank" href="javascript:void(0)" onclick="setImageLink('<?php echo $value['image'] ?>', 'Facebook');" class="widget widget-hover-effect2 themed-background-muted-light">
                        <div class="widget-simple">
                          <div class="sidebar-user-avatar pull-right themed-background">
                            <img class="avatar" src="<?php echo $value['image'] ?>" alt="">
                          </div>
                          <h4 class="text-left">
                            <strong>Facebook</strong><br><small>Click to select</small>
                          </h4>
                        </div>
                      </a>
                    </div>
                  <?php elseif($value['category'] == 'tw'): ?>
                    <?php $tw_count++; ?>
                  <?php elseif($value['category'] == 'ins'): ?>
                    <?php $ins_count++; ?>
                    <div class="col-md-6">
                      <a target="_blank" href="javascript:void(0)" onclick="setImageLink('<?php echo $value['image'] ?>', 'Instagram');" class="widget widget-hover-effect2 themed-background-muted-light">
                        <div class="widget-simple">
                          <div class="sidebar-user-avatar pull-right themed-background">
                            <img class="avatar" src="<?php echo $value['image'] ?>" alt="">
                          </div>
                          <h4 class="text-left">
                            <strong>Instagram</strong><br><small>Click to select</small>
                          </h4>
                        </div>
                      </a>
                    </div>
                  <?php elseif($value['category'] == 'yt'): ?>
                    <?php $yt_count++; ?>
                  <?php elseif($value['category'] == 'lin'): ?>
                    <?php $lin_count++; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>

              <?php echo form_open_multipart(SITEURL.'influencer/update_profile','id="update-profile-form-inf"');?>
              <div class="row">
                <div class="col-md-12">
                  <h5>Upload a profile picture</h5>
                  <div class="input-group">
                    <span class="input-group-addon">Image</span>
                    <div id="image-input">
                      <input type="file" class="form-control" name="userfile" id="userfile">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Image</button>
                  </div>
                  <hr>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                    <input type="text" class="form-control" placeholder="Your name" value="<?php echo $profile->name?>" name="profile_name">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-at"></span></span>
                    <input type="email" min="0" class="form-control" placeholder="Your email" disabled="disabled" value="<?php echo $profile->email?>" name="profile_email">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                    <input type="number" min="0" class="form-control" placeholder="Your contact no" value="<?php echo $profile->phone?>" name="profile_contact">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Profile</button>
                  </div>
                </div>
              </div>
              <?php echo form_close();?>
            </div>

            <!-- Orders Block -->
            <div class="block">
              <h3>Link your Social Media</h3>
              <hr>
              <!-- Orders Title -->
              <div class="block-title">
                <div class="block-options pull-right">
                  <span class="label label-success"><strong></strong></span>
                </div>
                <h2><i class="fa fa-truck"></i> <strong>Social Accounts</strong> (<?php echo $fb_count+$tw_count+$ins_count+$yt_count+$lin_count ?>)</h2>
              </div>
              <!-- END Orders Title -->

              <!-- Orders Content -->
              <table class="table table-bordered table-striped table-vcenter">
                <thead>
                  <tr>
                    <td class="text-center">Social Media</td>
                    <td class="text-center">Link</td>
                    <td class="text-center">Followers</td>
                    <td class="text-center">Status</td>
                    <td class="text-center">Added On</td>
                    <td class="text-center">Next refresh</td>
                    <td class="text-center">Actions</td>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tokens as $key => $value): ?>
                    <?php if($value['category'] == 'fb'): ?>
                      <tr>
                        <td class="text-center" style="width: 100px;"><a target="_blank" href="https://facebook.com"><strong><span class="fa fa-facebook"></strong></a>
                        </td>
                        <td class="text-center" style="width: 15%;"><a target="_blank" href="https://facebook.com/<?php echo $value['cat_id']?>"><strong><span class="fa fa-facebook">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs" style="width: 10%;"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['added_on']); ?></td>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['next_refresh']); ?></td>

                    <?php elseif($value['category'] == 'tw'): ?>
                      <tr>
                        <td class="text-center" style="width: 100px;"><a target="_blank" href="https://twitter.com"><strong><span class="fa fa-twitter"></strong></a>
                        </td>
                        <td class="text-center" style="width: 15%;"><a target="_blank" href="https://twitter.com/<?php echo $value['cat_id']?>"><strong><span class="fa fa-twitter">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs" style="width: 10%;"><strong><?php echo $value['followers'] ?></strong>

                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['added_on']); ?></td>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['next_refresh']); ?></td>

                    <?php elseif($value['category'] == 'ins'): ?>
                      <tr>
                        <td class="text-center" style="width: 100px;"><a target="_blank" href="https://instagram.com"><strong><span class="fa fa-instagram"></strong></a>
                        </td>
                        <td class="text-center" style="width: 15%;"><a target="_blank" href="https://www.instagram.com/<?php echo $value['cat_id']?>"><strong><span class="fa fa-instagram">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs" style="width: 10%;"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['added_on']); ?></td>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['next_refresh']); ?></td>

                    <?php elseif($value['category'] == 'yt'): ?>
                      <tr>
                        <td class="text-center" style="width: 100px;"><a target="_blank" href="https://youtube.com"><strong><span class="fa fa-youtube"></strong></a>
                        </td>
                        <td class="text-center" style="width: 15%;"><a target="_blank" href="https://www.youtube.com/channel/<?php echo $value['cat_id']?>"><strong><span class="fa fa-youtube">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs" style="width: 10%;"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['added_on']); ?></td>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['next_refresh']); ?></td>

                    <?php elseif($value['category'] == 'lin'): ?>
                      <tr>
                        <td class="text-center" style="width: 100px;"><a target="_blank" href="https://linkedin.com"><strong><span class="fa fa-linkedin"></strong></a>
                        </td>
                        <td class="text-center" style="width: 15%;"><a target="_blank" href="https://www.linkedin.com/company-beta/<?php echo $value['cat_id']?>"><strong><span class="fa fa-youtube">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs" style="width: 10%;"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['added_on']); ?></td>
                        <td class="hidden-xs text-center"><?php echo date('jS F Y h:i A', $value['next_refresh']); ?></td>

                      <?php endif; ?>
                      <td class="text-center" style="width: 70px;">
                        <div class="btn-group btn-group-xs">
                          <!--<a onclick="socialAccountRefresh(<?php echo $value['id'] ?>)" href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>-->
                          <a onclick="socialAccountDelete(<?php echo $value['id'] ?>)" href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <!-- END Orders Content -->
              <!-- <h4>Note: You have to manually refresh your linked accounts every <strong>60 days</strong>.</h4> -->
            </div>

            <script type="text/javascript">
              function socialAccountDelete(id) {
                swal({
                  title: "Are you sure?",
                  text: "You cannot link new posts after deleting but it won't affect old incomplete campaigns",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ok",
                  closeOnConfirm: false
                },
                function(y){
                  if(y==true){
                    $.ajax({
                      url: '<?php echo SITEURL ?>influencer/delete_social_account',
                      type: 'POST',
                      data: {'id': id},
                      success: function(data) {
                        if(!data.error) {
                          swal("Success!", "Account deleted", 'success');
                          $.redirect("<?php echo SITEURL ?>influencer/profile", {}, "GET")
                        }
                        else {
                          swal("Error!", "Something happened", 'error');
                        }
                      }
                    });
                  }
                });


              }
            </script>

            <div class="block">
              <!-- Orders Title -->
              <div class="block-title">
                <h2><i class="fa fa-truck"></i> <strong>Link your social Account</strong></h2>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="sizing-addon1"><span class="fa fa-facebook">  Page</span></span>
                <div class="col-md-4 collg-3 col-sm-4">
                  <a href="<?php echo $facebook_login_url ?>" class="btn btn-block btn-social btn-sm btn-facebook"><span class="fa fa-facebook"></span> Sign in with Facebook</a>
                </div>
              </div>
              <?php if($tw_count==0): ?>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon1"><span class="fa fa-twitter"> Account</span></span>
                  <div class="col-md-4 collg-3 col-sm-4">
                    <a href="<?php echo $twitter_login_url ?>" class="btn btn-block btn-social btn-sm btn-twitter"><span class="fa fa-twitter"></span> Sign in with Twitter</a>
                  </div>
                </div>
              <?php endif; ?>
              <?php if($ins_count==0): ?>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon1"><span class="fa fa-instagram"> Account</span></span>
                  <div class="col-md-4 collg-3 col-sm-4">
                    <a href="<?php echo $instagram_login_url ?>" class="btn btn-block btn-social btn-sm btn-facebook"><span class="fa fa-facebook"></span> Link with Facebook</a>
                  </div>
                </div>
              <?php endif; ?>
              <?php if($yt_count==0): ?>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon1"><span class="fa fa-youtube"> Channel</span></span>
                  <div class="col-md-4 collg-3 col-sm-4">
                    <a href='<?php echo $google_login_url ?>' class="btn btn-social btn-sm btn-google"><span class="fa fa-youtube"></span> Sign in with Google</a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>


          <div class="tab-pane" id="bank-profile-data">
            <?php if($bank){?>
              <h2 class="text-center">Your Bank's Details</h2>
              <p>Account Holder's Name: <?php echo $bank->account_holder_name?></p>
              <p>Bank Name: <?php echo $bank->bank_name?></p>
              <p>Account No: <?php echo $bank->account_number?></p>
              <p>IFSC Code: <?php echo $bank->ifsc_code?></p>
              <p>Mobile number: <?php echo $bank->mobile_number?></p>

            <?php }else{
              ?>
              <h2 class="text-center">Enter your bank details</h2>
              <br/>
              <?php echo form_open(SITEURL.'influencer/add_bank_account','id="bank-details-form"');?>
              <div class="form-group">
                <label for="email">Account Holder's Name:</label>
                <input type="text" class="form-control" name="holder-name" placeholder="Account Holder's Name">
              </div>
              <div class="form-group">
                <label for="pwd">Bank Name:</label>
                <input type="text" class="form-control" name="bank-name" placeholder="Bank Name">
              </div>
              <div class="form-group">
                <label for="pwd">Account Number:</label>
                <input type="number" class="form-control" name="account-number" placeholder="Account Number">
              </div>
              <div class="form-group">
                <label for="pwd">IFSC Code:</label>
                <input type="text" class="form-control" name="ifsc-code" placeholder="IFSC Code">
              </div>
              <div class="form-group">
                <label for="pwd">Mobile Number:</label>
                <input type="text" class="form-control" maxlength="10" minlength="10" name="mobile-number" placeholder="Mobile Number">
              </div>
              <button type="submit" class="btn btn-default">Save</button>
              <?php echo form_close();?>
            <?php } ?>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- END Customer Content -->
</div>
<!-- END Page Content --> -->
<script type="text/javascript">
function setImageLink(link, category) {
  $('#image-input').html('');
  $('#image-input').append('<input hidden name="image_link" value="'+link+'"><a target="_blank" href="'+link+'"><span class="input-group-addon">Selected '+category+' Image</span></a>');
}
</script>
