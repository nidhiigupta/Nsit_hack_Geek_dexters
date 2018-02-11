<?php
/**
* page_head.php
*
* Author: pixelcave
*
* Header and Sidebar of each page
*
*/
$user = $this->uri->segment(1);
?>

<!-- Page Wrapper -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
Available classes:

'page-loading'      enables page preloader
-->


<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<div id="page-wrapper"<?php if ($template['page_preloader']) { echo ' class="page-loading"'; } ?>>
  <!-- Preloader -->
  <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
  <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
  <div class="preloader themed-background">
    <h1 class="push-top-bottom text-light text-center"><strong>Now </strong>Health Care</h1>
    <div class="inner">
      <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
      <div class="preloader-spinner hidden-lt-ie10"></div>
    </div>
  </div>
  <!-- END Preloader -->

  <!-- Page Container -->
  <!-- In the PHP version you can set the following options from inc/config file -->
  <!--
  Available #page-container classes:

  '' (None)                                       for a full main and alternative sidebar hidden by default (> 991px)

  'sidebar-visible-lg'                            for a full main sidebar visible by default (> 991px)
  'sidebar-partial'                               for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
  'sidebar-partial sidebar-visible-lg'            for a partial main sidebar which opens on mouse hover, visible by default (> 991px)
  'sidebar-mini sidebar-visible-lg-mini'          for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)
  'sidebar-mini sidebar-visible-lg'               for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)

  'sidebar-alt-visible-lg'                        for a full alternative sidebar visible by default (> 991px)
  'sidebar-alt-partial'                           for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
  'sidebar-alt-partial sidebar-alt-visible-lg'    for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

  'sidebar-partial sidebar-alt-partial'           for both sidebars partial which open on mouse hover, hidden by default (> 991px)

  'sidebar-no-animations'                         add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

  'style-alt'                                     for an alternative main style (without it: the default style)
  'footer-fixed'                                  for a fixed footer (without it: a static footer)

  'disable-menu-autoscroll'                       add this to disable the main menu auto scrolling when opening a submenu

  'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
  'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

  'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links
-->
<?php
$page_classes = '';

if ($template['header'] == 'navbar-fixed-top') {
  $page_classes = 'header-fixed-top';
} else if ($template['header'] == 'navbar-fixed-bottom') {
  $page_classes = 'header-fixed-bottom';
}

if ($template['sidebar']) {
  $page_classes .= (($page_classes == '') ? '' : ' ') . $template['sidebar'];
}

if ($template['main_style'] == 'style-alt')  {
  $page_classes .= (($page_classes == '') ? '' : ' ') . 'style-alt';
}

if ($template['footer'] == 'footer-fixed')  {
  $page_classes .= (($page_classes == '') ? '' : ' ') . 'footer-fixed';
}

if (!$template['menu_scroll'])  {
  $page_classes .= (($page_classes == '') ? '' : ' ') . 'disable-menu-autoscroll';
}

if ($template['cookies'] === 'enable-cookies') {
  $page_classes .= (($page_classes == '') ? '' : ' ') . 'enable-cookies';
}
?>
<div id="page-container"<?php if ($page_classes) { echo ' class="' . $page_classes . '"'; } ?>>
  <!-- Alternative Sidebar -->
  <div id="sidebar-alt">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-alt-scroll">
      <!-- Sidebar Content -->
      <div class="sidebar-content">
        <!-- Chat -->
        <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->


        <!-- <a href="javascript:void(0)" class="sidebar-title">
        <i class="fa fa-globe pull-right"></i> <strong>Activity</strong>UI
      </a> -->
      <!-- END Messages -->
    </div>
    <!-- END Sidebar Content -->
  </div>
  <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Alternative Sidebar -->

<!-- Main Sidebar -->
<div id="sidebar">
  <!-- Wrapper for scrolling functionality -->
  <div id="sidebar-scroll">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
      <!-- Brand -->
      <a href="<?php echo SITEURL ?>" class="sidebar-brand">
        <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>Web</strong>Assets</span>
      </a>
      <!-- END Brand -->

      <!-- User Info -->
      <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
        <div class="sidebar-user-avatar">
          <a href="<?php echo SITEURL.$user.'/profile' ?>">
            <img src="<?php echo $this->custom_functions->check_img($_SESSION['image'])?>" alt="avatar">
          </a>
        </div>
        <div class="sidebar-user-name"><?php echo $_SESSION['name'];?></div>
        <div class="sidebar-user-links">
          <a href="<?php echo SITEURL.$user.'/profile' ?>" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
          <a href="<?php echo SITEURL.$user.'/chat' ?>" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
          <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.php in PHP version) -->
          <!-- <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a> -->
          <a href="<?php echo SITEURL.$user.'/logout' ?>" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
        </div>
      </div>
      <!-- END User Info -->

      <?php if ($primary_nav) { ?>
        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">
          <?php foreach( $primary_nav as $key => $link ) {
            $link_class = '';
            $li_active  = '';
            $menu_link  = '';

            // Get 1st level link's vital info
            $url        = (isset($link['url']) && $link['url']) ? $link['url'] : '#';
            $active     = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? ' active' : '';
            $icon       = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . ' sidebar-nav-icon"></i>' : '';

            // Check if the link has a submenu
            if (isset($link['sub']) && $link['sub']) {
              // Since it has a submenu, we need to check if we have to add the class active
              // to its parent li element (only if a 2nd or 3rd level link is active)
              foreach ($link['sub'] as $sub_link) {
                if (in_array($template['active_page'], $sub_link)) {
                  $li_active = ' class="active"';
                  break;
                }

                // 3rd level links
                if (isset($sub_link['sub']) && $sub_link['sub']) {
                  foreach ($sub_link['sub'] as $sub2_link) {
                    if (in_array($template['active_page'], $sub2_link)) {
                      $li_active = ' class="active"';
                      break;
                    }
                  }
                }
              }

              $menu_link = 'sidebar-nav-menu';
            }

            // Create the class attribute for our link
            if ($menu_link || $active) {
              $link_class = ' class="'. $menu_link . $active .'"';
            }
            ?>
            <?php if ($url == 'header') { // if it is a header and not a link ?>
              <li class="sidebar-header">
                <?php if (isset($link['opt']) && $link['opt']) { // If the header has options set ?>
                  <span class="sidebar-header-options clearfix"><?php echo $link['opt']; ?></span>
                <?php } ?>
                <span class="sidebar-header-title"><?php echo $link['name']; ?></span>
              </li>
            <?php } else { // If it is a link ?>
              <li<?php echo $li_active; ?>>
              <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><?php } echo $icon; ?><span class="sidebar-nav-mini-hide"><?php echo $link['name']; ?></span></a>
              <?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?>
                <ul>
                  <?php foreach ($link['sub'] as $sub_link) {
                    $link_class = '';
                    $li_active = '';
                    $submenu_link = '';

                    // Get 2nd level link's vital info
                    $url        = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                    $active     = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? ' active' : '';

                    // Check if the link has a submenu
                    if (isset($sub_link['sub']) && $sub_link['sub']) {
                      // Since it has a submenu, we need to check if we have to add the class active
                      // to its parent li element (only if a 3rd level link is active)
                      foreach ($sub_link['sub'] as $sub2_link) {
                        if (in_array($template['active_page'], $sub2_link)) {
                          $li_active = ' class="active"';
                          break;
                        }
                      }

                      $submenu_link = 'sidebar-nav-submenu';
                    }

                    if ($submenu_link || $active) {
                      $link_class = ' class="'. $submenu_link . $active .'"';
                    }
                    ?>
                    <li<?php echo $li_active; ?>>
                    <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?><i class="fa fa-angle-left sidebar-nav-indicator"></i><?php } echo $sub_link['name']; ?></a>
                    <?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?>
                      <ul>
                        <?php foreach ($sub_link['sub'] as $sub2_link) {
                          // Get 3rd level link's vital info
                          $url    = (isset($sub2_link['url']) && $sub2_link['url']) ? $sub2_link['url'] : '#';
                          $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' class="active"' : '';
                          ?>
                          <li>
                            <a href="<?php echo $url; ?>"<?php echo $active ?>><?php echo $sub2_link['name']; ?></a>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                  </li>
                <?php } ?>
              </ul>
            <?php } ?>
          </li>
        <?php } ?>
      <?php } ?>
    </ul>
    <!-- END Sidebar Navigation -->
  <?php } ?>

</div>
<!-- END Sidebar Content -->
</div>
<!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->

<!-- Main Container -->
<div id="main-container">
  <!-- Header -->
  <!-- In the PHP version you can set the following options from inc/config file -->
  <!--
  Available header.navbar classes:

  'navbar-default'            for the default light header
  'navbar-inverse'            for an alternative dark header

  'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
  'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

  'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
  'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
-->
<header class="navbar<?php if ($template['header_navbar']) { echo ' ' . $template['header_navbar']; } ?><?php if ($template['header']) { echo ' '. $template['header']; } ?>">
  <?php if ( $template['header_content'] == 'horizontal-menu' ) { // Horizontal Menu Header Content ?>
    <!-- Navbar Header -->
    <div class="navbar-header">
      <!-- Horizontal Menu Toggle + Alternative Sidebar Toggle Button, Visible only in small screens (< 768px) -->
      <ul class="nav navbar-nav-custom pull-right">
        <li>
          <a href="javascript:void(0)" data-toggle="collapse" data-target="#horizontal-menu-collapse">Menu</a>
        </li>
        <li>
          <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
            <i class="gi gi-share_alt"></i>
            <span class="label label-primary label-indicator animation-floating">4</span>
          </a>
        </li>
      </ul>
      <!-- END Horizontal Menu Toggle + Alternative Sidebar Toggle Button -->

      <!-- Main Sidebar Toggle Button -->
      <ul class="nav navbar-nav-custom">
        <li>
          <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
            <i class="fa fa-bars fa-fw"></i>
          </a>
        </li>
      </ul>
      <!-- END Main Sidebar Toggle Button -->
    </div>
    <!-- END Navbar Header -->


    <!-- Horizontal Menu + Search -->
    <div id="horizontal-menu-collapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="javascript:void(0)">Home</a>
        </li>
        <li>
          <a href="javascript:void(0)">Profile</a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Settings <i class="fa fa-angle-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:void(0)"><i class="fa fa-asterisk fa-fw pull-right"></i> General</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-lock fa-fw pull-right"></i> Security</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-user fa-fw pull-right"></i> Account</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-magnet fa-fw pull-right"></i> Subscription</a></li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
              <a href="javascript:void(0)" tabindex="-1"><i class="fa fa-chevron-right fa-fw pull-right"></i> More Settings</a>
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0)" tabindex="-1">Second level</a></li>
                <li><a href="javascript:void(0)">Second level</a></li>
                <li><a href="javascript:void(0)">Second level</a></li>
                <li class="divider"></li>
                <li class="dropdown-submenu">
                  <a href="javascript:void(0)" tabindex="-1"><i class="fa fa-chevron-right fa-fw pull-right"></i> More Settings</a>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)">Third level</a></li>
                    <li><a href="javascript:void(0)">Third level</a></li>
                    <li><a href="javascript:void(0)">Third level</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Contact <i class="fa fa-angle-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:void(0)"><i class="fa fa-envelope-o fa-fw pull-right"></i> By Email</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-phone fa-fw pull-right"></i> By Phone</a></li>
          </ul>
        </li>
      </ul>
      <!--<form action="page_ready_search_results.php" class="navbar-form navbar-left">
      <div class="form-group">
      <input type="text" class="form-control" placeholder="Search..">
    </div>
  </form>-->
</div>
<!-- END Horizontal Menu + Search -->
<?php } else { // Default Header Content  ?>
  <!-- Left Header Navigation -->
  <ul class="nav navbar-nav-custom">
    <!-- Main Sidebar Toggle Button -->
    <li>
      <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
        <i class="fa fa-bars fa-fw"></i>
      </a>
    </li>
    <!-- END Main Sidebar Toggle Button -->
    <!-- END Template Options -->
  </ul>
  <!-- END Left Header Navigation -->

  <!-- Search Form -->
  <form href="javascript:void(0)" method="post" class="navbar-form-custom">
    <div class="form-group">
      <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
    </div>
  </form>
  <!-- END Search Form -->

  <!-- Right Header Navigation -->
  <ul class="nav navbar-nav-custom pull-right">
    <!-- Alternative Sidebar Toggle Button -->
    <?php
    $notif = 0;
    $uri = $this->uri->segment(1);
    if($uri == 'brand') {
      $brand_id = $this->brand_model->get_id();
      $query = $this->db->select('COUNT(*)')->from('notif_brand')->where(['clicked' => '0', 'brand_id' => $brand_id,'category!='=>'Messages'])->get()->result_array();
      if(isset($query[0]['COUNT(*)']))
      $notif = $query[0]['COUNT(*)'];
      $query = $this->db->select('*')->from('notif_brand')->where(['clicked' => '0', 'brand_id' => $brand_id,'category!='=>'Messages'])->order_by('time', 'desc')->get()->result_array();
    }
    else if($uri == 'influencer') {
      $inf_id = $this->influencer_model->get_id();
      $query = $this->db->select('COUNT(*)')->from('notif_inf')->where(['clicked' => '0', 'inf_id' => $inf_id,'category!='=>'Messages'])->get()->result_array();
      if(isset($query[0]['COUNT(*)']))
      $notif = $query[0]['COUNT(*)'];
      $query = $this->db->select('*')->from('notif_inf')->where(['clicked' => '0', 'inf_id' => $inf_id,'category!='=>'Messages'])->order_by('time', 'desc')->get()->result_array();
    }
	$notif_message = 0;
    $uri = $this->uri->segment(1);
    if($uri == 'brand') {
      $brand_id = $this->brand_model->get_id();
      $query2 = $this->db->select('COUNT(*)')->from('notif_brand')->where(['clicked' => '0', 'brand_id' => $brand_id,'category'=>'Messages'])->get()->result_array();
      if(isset($query2[0]['COUNT(*)']))
      $notif_message = $query2[0]['COUNT(*)'];
      $query2 = $this->db->select('*')->from('notif_brand')->where(['clicked' => '0', 'brand_id' => $brand_id,'category'=>'Messages'])->order_by('time', 'desc')->get()->result_array();
    }
    else if($uri == 'influencer') {
      $inf_id = $this->influencer_model->get_id();
      $query2 = $this->db->select('COUNT(*)')->from('notif_inf')->where(['clicked' => '0', 'inf_id' => $inf_id,'category'=>'Messages'])->get()->result_array();

      if(isset($query2[0]['COUNT(*)']))
      $notif_message = $query2[0]['COUNT(*)'];
      $query2 = $this->db->select('*')->from('notif_inf')->where(['clicked' => '0', 'inf_id' => $inf_id,'category'=>'Messages'])->order_by('time', 'desc')->get()->result_array();
    }
	
	
    ?>

		
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropdown-toggle" id="notif1" data-toggle="dropdown">
        <i class="fa fa-envelope"></i>
		
        <?php if($notif_message): ?>
          <span class="label label-primary label-indicator animation-floating"><?php echo $notif_message ?></span>
        <?php endif ?>
      </a>
      <ul class="dropdown-menu dropdown-custom dropdown-menu-right " id="notif2" style="min-width: 300px">
        <li class="dropdown-header text-center">Notifications <b><a class="pull-right txt-danger clear" style="color:red" ><i class="fa fa-remove"></i> Clear</a></b></li>
        <?php if(!$notif_message): ?>
          <li><a href="javascript:void(0)">No Notifications</a></li>
        <?php else: ?>
          <?php foreach ($query2 as $key => $value): ?>
            <?php
            $date = "";
            if(strtotime(date('M j', $value['time']))+24*60*60 < time()) {
              $date = date('M j', $value['time']);
            }
            else {
              $date = date('g:i A', $value['time']);
            }
            ?>
            <li><a class="notification-class" id="<?php echo $value['id']; ?>" onclick="show_notif(<?php echo $value['id']; ?>);"><span class="badge pull-right"><?php echo $date; ?></span><?php echo $value['msg'] ?></a></li>
          <?php endforeach; ?>

        <?php endif ?>
      </ul>
    </li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropdown-toggle" id="notif1" data-toggle="dropdown">
        <i class="fa fa-info"></i>
        <?php if($notif): ?>
          <span class="label label-primary label-indicator animation-floating"><?php echo $notif ?></span>
        <?php endif ?>
      </a>
      <ul class="dropdown-menu dropdown-custom dropdown-menu-right " id="notif2" style="min-width: 300px">
        <li class="dropdown-header text-center">Notifications <b><a class="pull-right txt-danger clear" style="color:red" ><i class="fa fa-remove"></i> Clear</a></b></li>
        <?php if(!$notif): ?>
          <li><a href="javascript:void(0)">No Notifications</a></li>
        <?php else: ?>
          <?php foreach ($query as $key => $value): ?>
            <?php
            $date = "";
            if(strtotime(date('M j', $value['time']))+24*60*60 < time()) {
              $date = date('M j', $value['time']);
            }
            else {
              $date = date('g:i A', $value['time']);
            }
            ?>
            <li><a class="notification-class" id="<?php echo $value['id']; ?>" onclick="show_notif(<?php echo $value['id']; ?>);"><span class="badge pull-right"><?php echo $date; ?></span><?php echo $value['msg'] ?></a></li>
          <?php endforeach; ?>

        <?php endif ?>
      </ul>
    </li>
    <!-- END Alternative Sidebar Toggle Button -->

    <!-- User Dropdown -->
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo $this->custom_functions->check_img($_SESSION['image'])?>" alt="avatar"> <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
        <li class="dropdown-header text-center">Account</li>
        <li>
          <a href="<?php echo SITEURL.$user.'/chat' ?>">
            <i class="fa fa-envelope-o fa-fw pull-right"></i>
            <span class="badge pull-right">0</span>
            Messages
          </a>

          <a href="#"><i class="fa fa-question fa-fw pull-right"></i>
            <span class="badge pull-right">0</span>
            FAQ
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="<?php echo SITEURL.$user.'/profile' ?>">
            <i class="fa fa-user fa-fw pull-right"></i>
            Profile
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="<?php echo SITEURL.$user.'/logout' ?>"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
        </li>
      </ul>
    </li>
    <!-- END User Dropdown -->
  </ul>
  <!-- END Right Header Navigation -->
<?php } ?>
</header>
<!-- END Header -->
<script type="text/javascript">
$('.clear').click(function(e){
  clear_notif();
  var html2 = "";
  var  html1 = "";
  html1 +=' <i class="fa fa-info"></i>';
  html2 += '<li class="dropdown-header text-center">Notifications <b><a class="pull-right txt-danger clear" style="color:red" ><i class="fa fa-remove"></i> Clear</a></b></li>'
  html2 +=  '<li><a href="javascript:void(0)">No Notifications</a></li>'
  $('#notif2').html("");
  $('#notif1').html("");
  $('#notif2').append(html2);
  $('#notif1').append(html1);
});
function show_notif(id) {
  $.ajax({
    url:'<?php echo SITEURL.$uri ?>/open_notification',
    type: "POST",
    data: {'id':id},
    success: function(data) {
      if(!data.error) {
        window.location.replace(SITEURL+data.link);
      }
    }
  });
}

function clear_notif() {
  $.ajax({
    url:'<?php echo SITEURL.$uri ?>/clear_notification',
    type: "POST",
    data: {'clear':"CLEAR"},
    success: function(data) {
      if(!data.error) {
        swal('Success!', 'Notifications cleared', 'success');
      }
      else {
        swal('Error!', 'Unknown error', 'error');
      }
    }
  });
}
</script>
