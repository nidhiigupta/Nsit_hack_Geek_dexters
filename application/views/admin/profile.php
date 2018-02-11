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
<!-- page content -->
<div class="right_col" role="main">
  <div class="row" >
  	<div id="profile1">
	  	<div class="col-xs-4 col-sm-4" style="padding-top:0%">
	  		<p class="text-left">Member Since <?php #echo substr($profile->admin_signup_date,0,4)?></p>
	  		<img src="<?php echo ASSETS.$profile->admin_image?>" alt="..." class="img-circle profile_img" style="min-width: 50px;"> 
	  	</div>
	  	<div class="col-xs-8 col-sm-8" style="font-size: medium;padding-top:3%;">

	  		<p>Name:<?php echo $profile->admin_name?></p>
	  		<p>Email:<a href="mailto:<?php echo $profile->admin_email?>"><?php echo $profile->admin_email?></a></p>
	  		<p>Phone:<?php echo $profile->admin_phone?></p>
        <button class="btn btn-info"  data-toggle="modal" data-target="#profile-update-modal">Edit Profile</button>

	  	</div>
  	</div>
  </div>
   <div class="row">
    <!-- Modal -->
    <div id="profile-update-modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart(SITEURL.'admin/update_profile','id="update-profile-form-inf"');?>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                <input type="text" class="form-control" placeholder="Your name" value="<?php echo $profile->admin_name?>" name="profile_name">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-at"></span></span>
                <input type="email" min="0" class="form-control" placeholder="Your email" disabled="disabled" value="<?php echo $profile->admin_email?>" name="profile_email">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                <input type="number" min="0" class="form-control" placeholder="Your contact no" value="<?php echo $profile->admin_phone?>" name="profile_contact">
              </div>
              <div class="form-group">
                <div class="col-sm-6">
                   <input type="file" name="userfile" id="userfile">
                </div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-success">Upddate</button>
                </div>
              </div>
            <?php echo form_close();?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
