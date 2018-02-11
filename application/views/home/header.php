<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl" class="home">
<style>
.shivam ul{
	list-style:none;
	position:absolute;
	left:-9999px;
	z-index:20;
	font-size:16px;
	padding-top:0px;
	margin-top:-2px;
}
.hover:hover {
	color:white;
	background-color:#9b45b4;
}
</style>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

	<meta charset="UTF-8">
	<!--<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/favicons/favicon-16x16.png" sizes="16x16">
	<title>Geek Dexters</title>

	<!-- / Yoast SEO plugin. -->
	<link rel='stylesheet' id='ac_poi_maps-css'  href='<?php echo ASSETS.'new_index/';?>wp-content/plugins/ac_poi_maps/css/styleef15.css?ver=4.8' type='text/css' media='all' />
	<link rel='stylesheet' id='def_style-css'  href='<?php echo ASSETS.'new_index/';?>wp-content/plugins/ac_poi_maps/css/map_elemef15.css?ver=4.8' type='text/css' media='all' />
	<link rel='stylesheet' id='contact-form-7-css'  href='<?php echo ASSETS.'new_index/';?>wp-content/plugins/contact-form-7/includes/css/stylesa288.css?ver=4.8.1' type='text/css' media='all' />
	<link rel='stylesheet' id='ac_google_fonts-css'  href='<?php echo ASSETS.'new_index/';?>css/fonts.googleapis.com/css56db.css?family=Work+Sans%3A400%2C700&amp;subset=latin-ext&amp;ver=4.8' type='text/css' media='all' />
	<link rel='stylesheet' id='ac_main_style-css'  href='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/styleef15.css?ver=4.8' type='text/css' media='all' />
	<link rel="stylesheet" href="<?php echo ASSETS.'new_index/';?>css/animate.css">
	<link rel="stylesheet" href="<?php echo ASSETS.'new_index/';?>css/font-awesome/css/font-awesome.min.css">

	<!-- sweetalert -->
	<link rel="stylesheet" type="text/css" href="<?php echo ASSETS.'sweetalert';?>/dist/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ASSETS.'sweetalert';?>/themes/google/google.css">

</head>
<body class="home page-template-default page page-id-6 page-parent page-start" id="body"  data-lang="pl">
	<div class="margin-top-div"></div>
	<header id="header" class="clearfix" style="z-index:99;">
		<div class="clearfix">
			<div class="logo_wrapper col3p" style="background-color:white;">
				<h1 class="home">
					<a href="<?php echo SITEURL.'home' ?>" >
						<img class="color" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/logo_header.jpg" width="160" height="60" alt="WHYRAL logo header color" />
						<img class="tansparent" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/logo_header.png" width="160" height="60" alt="WHYRAL logo header transparent" />
					</a>
				</h1>
			</div>
			<div class="main_menu_wrapper col11p">
				<div id="menu_bar" class="clearfix ">
					<div class="menu_wrapper col8p">
						<nav id="menu_main" class="clearfix ICL_LANGUAGE_CODE">
							<ul id="menu-main-menu" class="menu"><li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-6 current_page_item menu-item-23 hover"><a href="<?php echo SITEURL; ?>"><span  style="font-size:14.5px;">Home</span></a></li>
								<li id="menu-item-22" class="dropdown solnav hover"><a href="#"><span style="font-size:14.5px;">Solutions</span></a>
									<ul class="dropdown-menu " >
										<li class="hover"><a href="<?php echo SITEURL.'home/brand'; ?>"><span style="font-size:15px;">Doctors</span></a></li>
										<li class="hover"><a href="<?php echo SITEURL.'home/influencer'; ?>"><span style="font-size:14.5px;">Influencer</span></a></li>
									</ul>
								</li>
								<li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 hover"><a href="<?php echo SITEURL.'home/about'; ?>"><span style="font-size:14.5px;">About Us</span></a></li>
								
								<li id="menu-item-19" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19 hover"><a href="<?php echo SITEURL.'home/contact'; ?>"><span style="font-size:14.5px;">Support</span></a></li>

							</ul>
						</nav>
					</div>
					<div class="b2b_wrapper col3p signupin">
						<ul>
							<?php if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']==1): ?>
								<li id="menu-item-22" class="dropdown shivam" id="dropdown"><a href="#" class="lsbtn"><?php// print_r($_SESSION['name']); ?></a>
									<ul class="dropdown-menu">
										<?php if(isset($_SESSION['influencer'])): ?>
											<li class="hover"><a href="<?php echo SITEURL.'influencer/dashboard'?>" style="font-size:13.5px;">My Dashboard</a></li>
										<?php elseif(isset($_SESSION['brand'])): ?>
											<li class="hover"><a href="<?php echo SITEURL.'brand/dashboard'?>" style="font-size:13.5px;">My Dashboard</a></li>
										<?php endif; ?>
										<li class="hover"><a href="<?php echo SITEURL.'logout'?>" style="font-size:13.5px;">Logout</a></li>
									</ul>
								</li>
							<?php else: ?>
								<li id="menu-item-22" class="dropdown shivam" id="dropdown"><a href="#" class="lsbtn" style="font-size:13.5px;">Login / Signup</a>
									<ul class="dropdown-menu">
										<li class="hover"><a href="<?php echo SITEURL.'login?user=brand'?>" style="font-size:13.5px;">Doctors</a></li>
										<li class="hover"><a href="<?php echo SITEURL.'login?user=influencer'?>" style="font-size:13.5px;">Patients</a></li>
									</ul>
								</li>
							<?php endif; ?>
						</ul>
					</div>

				</div>
			</div>
			<div id="mobile_switcher">
				<svg viewBox="0 0 800 600">
					<path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
					<path d="M300,320 L540,320" id="middle"></path>
					<path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
				</svg>
			</div>
		</div>
	</header>
