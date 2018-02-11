<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Reset Password</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo ASSETS.'proui/';?>img/favicon.png">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?php echo ASSETS.'proui/';?>img/icon180.png" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo ASSETS.'proui/';?>css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo ASSETS.'proui/';?>css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo ASSETS.'proui/';?>css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo ASSETS.'proui/';?>css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="<?php echo ASSETS.'proui/';?>js/vendor/modernizr.min.js"></script>
    </head>
    <body>
        <!-- Login Alternative Row -->
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div id="login-alt-container">
                        <!-- Title -->
                        <h1 class="push-top-bottom">
                            <i class="gi gi-flash"></i> <strong>WebAssets</strong><br>
                            <small>World’s leading influencer marketing platform.</small>
                        </h1>
                        <!-- END Title -->

                        <!-- Key Features -->
                       <!-- <ul class="fa-ul text-muted">
                            <li><i class="fa fa-check fa-li text-success"></i> Clean &amp; Modern Design</li>
                            <li><i class="fa fa-check fa-li text-success"></i> Fully Responsive &amp; Retina Ready</li>
                            <li><i class="fa fa-check fa-li text-success"></i> 10 Color Themes</li>
                            <li><i class="fa fa-check fa-li text-success"></i> PSD Files Included</li>
                            <li><i class="fa fa-check fa-li text-success"></i> Widgets Collection</li>
                            <li><i class="fa fa-check fa-li text-success"></i> Designed Pages Collection</li>
                            <li><i class="fa fa-check fa-li text-success"></i> .. and many more awesome features!</li>
                        </ul>
                        <!-- END Key Features -->

                        <!-- Footer -->
                        <footer class="text-muted push-top-bottom">
                            <small>Crafted with <i class="fa fa-heart text-danger"></i> by Team <a href="http://webassets.in/" target="_blank">WEBASSETS</a></small>
                        </footer>
                        <!-- END Footer -->
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- Login Container -->
                   <?php if($error==false){ ?>   <div id="login-container">
                        <!-- Login Title -->
                        <div class="login-title text-center">
						<h1><strong>Reset </strong>Password</strong></h1>
                        </div>
                        <!-- END Login Title -->

                        <!-- Login Block -->
                        <div class="block push-bit">
                            <!-- Login Form -->
                          <form action="<?php echo SITEURL.$title.'/reset_pass';?>" method="post"  class="form-horizontal" id="reset-form" onsubmit="return false;">

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                            <input type="password" id="pwd" name="pwd" class="form-control input-lg" placeholder="New Password">
                                            <input type="hidden" id="id" name="id" class="form-control input-lg" value="<?php echo $_GET['id'];?>">
                                            <input type="hidden" id="token" name="token" class="form-control input-lg" value="<?php echo $_GET['token']; ?>">
                                        </div>
                                    </div>
									<div class="col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                            <input type="password" id="re-pwd" name="re-pwd" class="form-control input-lg" placeholder="Re-type New Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-actions">

                                    <div class="col-xs-8 text-right">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Change Password</button>
                                    </div>
									<div class="form-group">
                                    <div class="col-xs-12 text-center">
                                        <small>Did you remember your password?</small> <a <?php if(isset($_GET['user'])){ ?>href="<?php echo SITEURL?>login?user=<?php echo $_GET['user']; ?>"<?php }else{ ?>
											href="<?php echo SITEURL; ?>"
											<?php }?> id="link-reminder"><small>Login</small></a>
                                    </div>
                                </div>
                                </div>

                            </form>
                        </div>    <!-- END Login Form -->
					</div><?php }else{ ?>
					<div id="login-container">
                        <!-- Login Title -->
                        <div class="login-title text-center">
						<h1><strong>Invalid</strong> Request</strong></h1>
                        </div>
						<div class="col-xs-12 text-center">
                                        <small>Did you remember your password?</small> <a <?php if(isset($_GET['user'])){ ?>href="<?php echo SITEURL?>login?user=<?php echo $_GET['user']; ?>"<?php }else{ ?>
											href="<?php echo SITEURL; ?>"
											<?php }?> id="link-reminder"><small>Login</small></a>
                                    </div>
						</div>

					<?php }?>


        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="<?php echo ASSETS.'proui/';?>js/vendor/jquery.min.js"></script>
        <script src="<?php echo ASSETS.'proui/';?>js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo ASSETS.'proui/';?>js/plugins.js"></script>
        <script src="<?php echo ASSETS.'proui/';?>js/app.js"></script>
		<script>
	$('#reset-form').on('submit',function(e){
	e.preventDefault();
	var ele=$('#reset-form');
	var values=ele.serialize();
	var url=ele.attr('action');
	//alert(url);
	$('.text-white').text('');
	var pwd = $('#pwd').val();
	var repwd = $('#re-pwd').val();
	if(pwd!=repwd){
	swal({
		title: "Error!",
		text: "Password Does Not Match",
		type: "error",
		});
		return false;

	}
	$.post(url,values,function(data,status){

		if(data.status==true){
			//console.log(data);
			swal("Good Job!",data.msg,"success");
			window.location.replace("<?php echo SITEURL.$_GET['user'];?>");
		}
		else{
			$.each(data,function(key,value){
				if(value) {
					swal("Error!",value,"error");
				}
			});
		}
		if(data.custum){
			swal("Error!",data.custum,"error");
		}
	});
});

			</script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="<?php echo ASSETS.'proui/';?>js/pages/login.js"></script>
        <script>$(function(){ Login.init(); });</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    </body>
</html>
