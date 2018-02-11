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
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane active" id="main-profile-data">
            <div class="block">
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
                  <?php elseif($value['category'] == 'tw'): ?>
                    <?php $tw_count++; ?>
                  <?php elseif($value['category'] == 'ins'): ?>
                    <?php $ins_count++; ?>
                  <?php elseif($value['category'] == 'yt'): ?>
                    <?php $yt_count++; ?>
                  <?php elseif($value['category'] == 'lin'): ?>
                    <?php $lin_count++; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>

              <div class="row">
                <div class="col-md-12">
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
                </div>
              </div>
            </div>

            <!-- Orders Block -->
            <div class="block">
              <h3>Social Media Pages/Accounts</h3>
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
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tokens as $key => $value): ?>
                    <?php if($value['category'] == 'fb'): ?>
                      <tr>
                        <td class="text-center"><a target="_blank" href="https://facebook.com"><strong><span class="fa fa-facebook"></strong></a>
                        </td>
                        <td class="text-center"><a target="_blank" href="https://facebook.com/<?php echo $value['cat_id']?>"><strong><span class="fa fa-facebook">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>

                    <?php elseif($value['category'] == 'tw'): ?>
                      <tr>
                        <td class="text-center"><a target="_blank" href="https://twitter.com"><strong><span class="fa fa-twitter"></strong></a>
                        </td>
                        <td class="text-center"><a target="_blank" href="https://twitter.com/<?php echo $value['cat_id']?>"><strong><span class="fa fa-twitter">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs"><strong><?php echo $value['followers'] ?></strong>

                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>

                    <?php elseif($value['category'] == 'ins'): ?>
                      <tr>
                        <td class="text-center"><a target="_blank" href="https://instagram.com"><strong><span class="fa fa-instagram"></strong></a>
                        </td>
                        <td class="text-center"><a target="_blank" href="https://www.instagram.com/<?php echo $value['cat_id']?>"><strong><span class="fa fa-instagram">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>

                    <?php elseif($value['category'] == 'yt'): ?>
                      <tr>
                        <td class="text-center"><a target="_blank" href="https://youtube.com"><strong><span class="fa fa-youtube"></strong></a>
                        </td>
                        <td class="text-center"><a target="_blank" href="https://www.youtube.com/channel/<?php echo $value['cat_id']?>"><strong><span class="fa fa-youtube">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>

                    <?php elseif($value['category'] == 'lin'): ?>
                      <tr>
                        <td class="text-center"><a target="_blank" href="https://linkedin.com"><strong><span class="fa fa-linkedin"></strong></a>
                        </td>
                        <td class="text-center"><a target="_blank" href="https://www.linkedin.com/company-beta/<?php echo $value['cat_id']?>"><strong><span class="fa fa-youtube">  <?php echo $value['name'] ?></strong></a>
                        </td>
                        <td class="text-center hidden-xs"><strong><?php echo $value['followers'] ?></strong>
                        </td>
                        <?php if ($value['next_refresh']-$value['added_on'] < 0): ?>
                          <td><span class="label label-error">Expired</span></td>
                        <?php elseif ($value['next_refresh']-$value['added_on'] < 20*24*60*60): ?>
                          <td><span class="label label-warning">Active</span></td>
                        <?php else: ?>
                          <td><span class="label label-success">Active</span></td>
                        <?php endif; ?>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <!-- END Orders Content -->
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
  <!-- END Customer Content -->
</div>
<!-- END Page Content --> -->
