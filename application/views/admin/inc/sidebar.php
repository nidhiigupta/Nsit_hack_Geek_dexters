<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo SITEURL.$this->uri->segment(1);?>" class="site_title"><i class="fa fa-paw"></i> <span>Webassets</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <<div class="profile_pic">
        <?php
        $img=$this->session->image;
        $visible_img=ASSETS.$img;
        ?>
        <img src="<?php echo$visible_img;?>" alt="..." class="img-circle profile_img">
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
        <h3>ADMIN</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo SITEURL.'admin/dashboard';?>">Dashboard</a></li>
              <li><a href="<?php echo SITEURL.'admin/admins';?>">All Admins</a></li>
              <li><a href="<?php echo SITEURL.'admin/reporting';?>">Reporting</a></li>
              <!-- <li><a href="<?php echo SITEURL.'admin/run_analytics';?>">Run Background analytics</a></li> -->
            </ul>
          </li>
          <li><a href="<?php echo SITEURL.'admin/brands';?>"><i class="fa fa-building"></i>Brands <span class="label label-success pull-right"></span></a></li>
          <li><a href="<?php echo SITEURL.'admin/influencers';?>"><i class="fa fa-user"></i>Influencers <span class="label label-success pull-right"></span></a></li>
          <li><a href="<?php echo SITEURL.'admin/payments';?>"><i class="fa fa-inr"></i>Paymets <span class="label label-success pull-right"></span></a></li>
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
