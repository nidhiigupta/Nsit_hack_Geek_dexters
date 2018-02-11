<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login | </title>

    <!-- Bootstrap -->
    <link href="<?php echo ASSETS.'vendors/bootstrap/dist/css/bootstrap.min.css';?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo ASSETS.'vendors/font-awesome/css/font-awesome.min.css';?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo ASSETS.'vendors/nprogress/nprogress.css';?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo ASSETS.'vendors/animate.css/animate.min.css';?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php #echo ASSETS.'build/css/custom.min.css';?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo ASSETS.'js/jquery.min.js';?>"></script>
    <style>
    .panel-default{
      box-shadow:1px 1px 15px 5px #9e9d9d;
    }
    </style>
  </head>

  <body>
  <div class="cosntainer">
    <div style="height: 25vh;"></div>
    <div class="col-sm-offset-4 col-sm-4">
    <div class="panel panel-default">
      <div class="panel-heading">Administrator Login</div>
      <div class="panel-body">
          <?php echo form_open(SITEURL.'admin/do_login','class="" id="login-form"');?>
            <div class="form-group">
              <span class="text-danger error" id="custom_error"></span><br>
              <label for="email">Email address:</label>
              <?php echo form_input(array('name'=>'email','value'=>set_value('email'),'placeholder'=>'Email','class'=>'form-control'));?>
              <span class="text-danger error" id="email_error"></span>
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <?php echo form_input(array('type'=>'password','name'=>'pwd','value'=>set_value('pwd'),'placeholder'=>'Password','class'=>'form-control'));?>
              <span class="text-danger error" id="pwd_error"></span>
            </div>
            <?php echo form_submit(array('value'=>'Login','class'=>'btn btn-success submit'));?>
          <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>

    <script type="text/javascript">
      $('#login-form').on('submit',function(e){
        e.preventDefault();
        var ele=$('#login-form');
        var url= ele.attr('action');
        var data= ele.serialize();
        $('.error').text();
        $.post(url,data,function(value,status){
           if(value.status==true){
            window.location.replace(" <?php echo SITEURL.'admin/campaigns';?> ");
           }
           else{
            $.each(value,function(key,value){
              $("#"+key+"_error").html(value);
            });
          }
        });
      });
    </script>
  </body>
</html>
