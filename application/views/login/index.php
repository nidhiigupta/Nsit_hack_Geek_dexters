<style type="text/css">
main {
	height: 90vh;
}
</style>

<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<?php if (isset($_GET['activate'])): ?>
	<?php if ($_GET['activate'] == 'success'): ?>
		<script type="text/javascript">
	  swal({
	    title: "Success!",
	    text: 'Account activated.',
	    type: "success",
	    html: true
	  },
	  function(){
	  });
	  </script>
	<?php else: ?>
		<script type="text/javascript">
		swal({
	    title: "Error!",
	    text: 'Account was not activated.',
	    type: "error",
	    html: true
	  },
	  function(){
	  });
	  </script>
	<?php endif; ?>

<?php endif; ?>

<main id="content_wrapper" class="clearfix">
	<section class="page_content_wrapper menu page_wrapper clearfix first-section">
		<div class="main-wrapper content_wrap page_wrap editor_wrapper">
			<section class="login">
				<form role="form" action="<?php echo SITEURL.$_GET['user'].'/do_login';?>" method="post" class="login-form" id="login-form" onsubmit="return false;">
					<div class="titulo"><?php if($_GET['user']=='influencer'){echo 'Patient';}elseif($_GET['user']=='brand'){echo 'Doctors'; }?>: Login</div>
					<div class="form-group">
						<!--fbLink -->
						<div id="fbLink"></div>
						<div id="userData"></div>
						<div id="status"></div>
						<!--/fbLink-->
						<label class="sr-only" for="form-username">Email</label>
						<input type="text" name="l-email" placeholder="Email" class="form-username form-control" id="form-username">
						<span class="text-white" id="l-email_error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="form-password">Password</label>
						<input type="password" name="l-pwd" placeholder="Password" class="form-password form-control" id="form-password">
						<span class="text-white" id="l-pwd_error"></span>
					</div>
					<button type="submit" class="enviar">Sign In</button>
					<div class="olvido">
						<div class="col" id="register"><a onclick="return false;" href="#">Register</a></div>
						<div class="col" id="forgot"><a onclick="return false;" href="#">Forgot Password?</a></div>
					</div>
					<div class="clearfix"></div>
					<br />
					<div>
						<h1 style="color:white;">Geek Dexters</h1>
					
					</div>
				</form>
			</section>
			<section class="signup" id="signup2" style="display: none;">
				<div class="titulo">Signup For <?php if($_GET['user']=='inluencer'){echo 'Patient';}elseif($_GET['user']=='brand'){echo 'Doctors'; }?></div>
				<form role="form" action="<?php echo SITEURL.$_GET['user'].'/do_signup';?>" method="post" class="registration-form" id="registration-form" onsubmit="return false;">
					<span class="text-white" id="custom_error"></span>
					<div class="form-group">
						<label class="sr-only" for="form-first-name">First name</label>
						<input type="text" name="fname" placeholder="First name" class="form-first-name form-control" id="form-first-name">
						<span class="text-white" id="fname_error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="form-last-name">Last name</label>
						<input type="text" name="lname" placeholder="Last name" class="form-last-name form-control" id="form-last-name">
						<span class="text-white" id="lname_error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="form-email">Email</label>
						<input type="text" name="email" placeholder="Email" class="form-email form-control" id="form-email">
						<span class="text-white" id="email_error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="p">Password</label>
						<input type="password"  name="pwd" placeholder="Password" class="form-control">
						<span class="text-white" id="pwd_error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="p">re-type Password</label>
						<input type="password"  name="re-pwd" placeholder="Retype Password" class=" form-control">
						<span class="text-white" id="re-pwd_error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="form-about-yourself">Mobile Number</label>
						<input type="text" data-validate-length-range="10,11" name="mobile" placeholder="Mobile Number" class="form-about-yourself form-control" id="form-about-yourself">
						<span class="text-white" id="mobile_error"></span>
					</div>
					<?php if($_GET['user']=='brand'){ ?><div class="form-group">
						<label class="sr-only" for="p">Industry</label>
						<select  style="color:#75756F;background-color:black;padding-top: 10px;padding-right: 220px;padding-bottom: 10px;padding-left: 30px;" class="form-control" name="industry" >
							<option style="color:white;background-color:black;" value="">Select Your Hospital</option>
							<option style="color:white;background-color:black;" value="Crypto Currencies">AIIMS</option>
							<option style="color:white;background-color:black;" value="Crypto Currencies">CMC</option>
							<option style="color:white;background-color:black;" value="Crypto Currencies">Apollo</option>
							<option style="color:white;background-color:black;" value="Crypto Currencies">Sir Ganga Ram Hospital</option>
							<option  style="color:white;background-color:black;" value="Entertainment">King Edward Memorial Hospital</option>
							<option style="color:white;background-color:black;" value="Fashion">Lilavati Hospital</option>
							
						</select>
					</div>
					<br>
					<div class="form-group">
						<label class="sr-only" for="p">Doctor Type</label>
						<select  style="color:#75756F;background-color:black;padding-top: 10px;padding-right: 220px;padding-bottom: 10px;padding-left: 30px;" class="form-control" name="doc_type" >
							<option style="color:white;background-color:black;" value="">Select Your Type</option>
							<option style="color:white;background-color:black;" value="0">Doctors</option>
							<option style="color:white;background-color:black;" value="1">Labs</option>
							
							
						</select>
					</div>
					<p class="alert alert-danger" style="color:white;background-color:black;">If your hospital is not listed Get Affliated With Us.
						
						</p>
					<?php } ?>
					<br>
					
					<br>
					<button type="submit" class="enviar">Sign me up!</button>

					<div class="separator">
						<p class="change_link">Already a member?
							<div class="olvido">
								<div class="col" id="login"><a href="javascript:void(0)"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Login</a></div>
							</div>
						</p>

						<div class="clearfix"></div>
						<br />
						<div>
							<h1 style="color:white;">Geek Dexter</h1>
							
						</div>
					</div>
				</form>
			</section>
			<section class="signup" id="forpass" style="display: none;">
				<div class="titulo">Forgot Password For <?php if($_GET['user']=='influencer'){echo 'Patient';}elseif($_GET['user']=='brand'){echo 'Doctors'; }?></div>
				<form role="form"  action="<?php echo SITEURL.$_GET['user'].'/check_user';?>" method="post" class="registration-form" id="forgot-form" onsubmit="return false;">
					<span class="text-white" id="custom_error"></span>
					<div class="form-group">
						<label class="sr-only" for="form-first-name">Email</label>
						<input type="text" name="for_email" placeholder="Please enter the email linked with your account" class="form-first-name form-control" >
						<span class="text-white" id="fname_error"></span>
					</div>
					<span class="text-white" style="color:red;" id="email_error"></span>
					<div class="form-group" id="append">
						<span class="text-white" style="color:green;" id="fname_error"></span>
					</div>
					<br>
					<button type="submit" class="enviar">Send Password reset link</button>

					<div class="separator">
						<p class="change_link">Already a member?
							<div class="olvido">
								<div class="col" id="login0"><a href="javascript:void(0)"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Login</a></div>
							</div>
						</p>

						<div class="clearfix"></div>
						<br />
						<div>
							<h1 style="color:white;">Geek Dexter</h1>

						</div>
					</div>
				</form>
			</section>
		</div>
	</section>
</main>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>js/code.jquery.com/jquery-1.12.4.minb8ff.js?ver=1.12.4'></script>

<script type="text/javascript">
$('#register').on('click',function(){
	$('.login').hide(1000);
	$('#forpass').hide(1000);
	$('#signup2').show(1000);
});
$('#login').on('click',function(){
	$('#signup2').hide(1000);
	$('#forpass').hide(1000);
	$('.login').show(1000);
});
$('#login0').on('click',function(){
	$('#signup2').hide(1000);
	$('#forpass').hide(1000);
	$('.login').show(1000);
});
$('#forgot').on('click',function(){
	$('#signup2').hide(1000);
	$('.login').hide(1000);
	$('#forpass').show(1000);
})
</script>

<script type="text/javascript">
$('#login-form').on('submit',function(e){
	e.preventDefault();
	var ele=$('#login-form');
	var values=ele.serialize();
	var url=ele.attr('action');
	$('.text-white').text('');
	$.post(url,values,function(data,status){
		if(data.status==true){
			window.location.replace("<?php echo SITEURL.$_GET['user'];?>");
		}
		else{
			$.each(data,function(key,value){
				if(value) {
					swal({
						title: "Error!",
						text: value,
						type: "error",
						html: true
					});
				}
			});
		}
	});
});

$('#registration-form').on('submit',function(e){
	e.preventDefault();
	var ele=$('#registration-form');
	var values=ele.serialize();
	var url=ele.attr('action');
	$.post(url,values,function(data,status){
		if(data.status==true){
			swal({
				title: "Success",
				text: data.msg,
				type: "success",
				confirmButtonText: "Ok",
				closeOnConfirm: false
			},
			function(){
				window.location.replace("<?php echo SITEURL.$_GET['user'];?>");
			});
		}
		else{
			$.each(data,function(key,value){
				if(value) {
					swal({
						title: "Error!",
						text: value,
						type: "error",
						html: true
					});
				}

			});
		}
		if(data.custom){
			swal('OOPs!',data.custom,'error');
		}
	});
});

$('#forgot-form').on('submit',function(e){
	//alert('hello');
	e.preventDefault();
	var ele=$('#forgot-form');
	var values=ele.serialize();
	var url=ele.attr('action');
	//alert(url);
	//alert(values);
	$.post(url,values,function(data,status){
		if(data.status==true){
			swal({
				title: "Success",
				text: data.msg,
				type: "success",
				confirmButtonText: "Ok",
				closeOnConfirm: false
			},
			function(){
				window.location.replace("<?php echo SITEURL.$_GET['user'];?>");
			});
		}
		else{
			$.each(data,function(key,value){
				if(value) {
					swal({
						title: "Error!",
						text: value,
						type: "error",
						html: true
					});
				}

			});
		}

	});
});
</script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/plugins/contact-form-7/includes/js/scriptsa288.js?ver=4.8.1'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>js/cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/jquery.matchHeight-minef15.js?ver=4.8'></script>

<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/jquery.jcarousel.minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/jquery.touchSwipe.minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/opinieef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-includes/js/wp-embed.minef15.js?ver=4.8'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
