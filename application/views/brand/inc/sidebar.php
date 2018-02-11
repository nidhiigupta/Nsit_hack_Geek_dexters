<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo SITEURL.$this->uri->segment(1);?>" class="site_title"><i class="fa fa-paw"></i> <span>Webassets</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php echo $this->custom_functions->check_img($this->session->image);?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $this->session->name;?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>BRAND</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo SITEURL.'brand/dashboard';?>">Dashboard</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-home"></i> Campaigns <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo SITEURL.'brand/campaigns/all';?>"><i class="fa fa-laptop"></i>All Campaigns <span class="label label-success pull-right"></span></a></li>
              <li><a href="<?php echo SITEURL.'brand/campaigns/offers';?>"><i class="fa fa-laptop"></i>Offer Requests <span class="label label-success pull-right"></span></a></li>
            </ul>
          </li>

          <li><a href="<?php echo SITEURL.'brand/payments';?>"><i class="fa fa-inr"></i>Payments <span class="label label-success pull-right"></span></a></li>
          <li><a href="<?php echo SITEURL.'brand/influencer';?>"><i class="fa fa-user"></i>Influencers <span class="label label-success pull-right"></span></a></li>

        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
