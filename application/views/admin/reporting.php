<!-- page content -->
<link src="<?php echo ASSETS;?>js/jquery.min.js">
<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>

<div id="page-content">
  <div class="content-header content-header-media">
    <div class="header-section">
      <a href="page_ready_user_profile.php">
        <img src="<?php echo ASSETS.'proui/' ?>img/placeholders/headers/article_header.jpg" alt="header image" class="animation-pulseSlow">
      </a>
      <h1>Reporting</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
      <!-- Article Block -->
      <div class="block block-alt-noborder">
        <h1>Reporting</h1>
        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <p class="text-muted font-13 m-b-30">Add new Reports</p>
          <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <a href="<?php echo $facebook_login_url; ?>"><button type="button" name="facebook_login_url"><span class="fa fa-facebook"></span> Link Facebook page</button></a>
          </div>
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <a href="<?php echo $instagram_login_url; ?>"><button type="button" name="facebook_login_url"><span class="fa fa-instagram"></span> Link Instagram Account</button></a>
          </div>
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <a href="<?php echo $twitter_login_url; ?>"><button type="button" name="twitter_login"><span class="fa fa-twitter"></span> Link Twitter account</button></a>
          </div>
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <a href="<?php echo $linkedin_login_url; ?>"><button type="button" name="linkedin_login"><span class="fa fa-linkedin"></span> Link LinkedIn page</button></a>
          </div>

          <p class="text-muted font-13 m-b-30">Your Reports</p>
          <?php foreach ($data as $key => $value) {
            print_r("<strong>".$value['name']."</strong> Category ".$value['category']." with page_id ".$value['id']." <a target='_blank' href='".ASSETS."downloads/reporting/reporting_".$value['report_id'].".csv'><i class='fa fa-download' aria-hidden='true'></i></a><br>");
          } ?>
        </div>
      </div>
    </div>
  </div>
</div>
