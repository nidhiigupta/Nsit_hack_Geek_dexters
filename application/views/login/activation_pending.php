<style type="text/css">
main {
  height: 90vh;
}
</style>
<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<?php if ($error == true): ?>
  <script type="text/javascript">
  swal({
    title: "Error!",
    text: 'Token has been already used.',
    type: "error",
    html: true
  },
  function(){
    window.location.replace("<?php echo SITEURL.$_GET['user'];?>");
  });
  </script>
<?php endif; ?>

<main id="content_wrapper" class="clearfix">
  <section class="page_content_wrapper menu page_wrapper clearfix first-section">
    <div class="main-wrapper content_wrap page_wrap editor_wrapper">
      <section class="signup" id="reset-section" style="display: block;">
        <div class="titulo">Reset Password</div>
        <form role="form" action="<?php echo SITEURL.$title.'/reset_pass';?>" method="post" id="reset-form" onsubmit="return false;">
          <span class="text-white" id="custom_error"></span>
          <div class="form-group">
            <label class="sr-only" for="p">Password</label>
            <input type="password" name="pwd" placeholder="Password" class="form-control">
            <span class="text-white" id="pwd_error"></span>
          </div>
          <div class="form-group">
            <label class="sr-only" for="p">re-type Password</label>
            <input type="password" name="re-pwd" placeholder="Retype Password" class="form-control">
            <span class="text-white" id="re-pwd_error"></span>
          </div>
          <input type="hidden" id="id" name="id" class="form-control input-lg" value="<?php echo $_GET['id'];?>">
          <input type="hidden" id="token" name="token" class="form-control input-lg" value="<?php echo $_GET['token']; ?>">
          <br>
          <button type="submit" class="enviar">Change Password</button>

          <div class="separator">
            <p class="change_link">Already a member?
              <div class="olvido">
                <div class="col" id="login"><a href="<?php echo SITEURL ?>login"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Login</a></div>
              </div>
            </p>

            <div class="clearfix"></div>
            <br />
            <div>
              <h1 style="color:white;">WebAssets</h1>
              <p>A Social Media Platform<br>That takes pride in creating success stories.</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </section>
</main>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>js/code.jquery.com/jquery-1.12.4.minb8ff.js?ver=1.12.4'></script>

<script type="text/javascript">
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
  else {
    $.post(url,values,function(data,status){
      if(data.status==true){
        swal({
          title: "Good Job!",
          text: data.msg,
          type: "success",
          html: true
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
      if(data.custum){
        swal("Error!",data.custum,"error");
      }
    });
  }
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
