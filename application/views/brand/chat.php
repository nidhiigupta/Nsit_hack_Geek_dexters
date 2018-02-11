<?php

if($this->input->post('inf_id') && $this->input->post('brand_id')) {
  $single = 1;
  $brand_id = $this->input->post('brand_id');
  $inf_id = $this->input->post('inf_id');
  $cat = $this->input->post('cat');

  print("<script type='text/javascript'>
  var INF_ID = {$inf_id};
  var BRAND_ID = {$brand_id};
  var CAT = {$cat};
  var SHOW = 0;
  var initial_length = 0;
  var chat = 0;
  var single= 1;
  </script>");
}
else {
  $single = 1;
  if($this->uri->segment(1) == 'influencer') {
    $inf_id = $this->influencer_model->get_id();
    print("<script type='text/javascript'>
    var INF_ID = {$inf_id};
    //alert(INF_ID);
    var CAT = 0;
    var SHOW = 0;
    var initial_length = 0;
    var chat = 0;
    var single =0;
    </script>");
  }
  else if($this->uri->segment(1) == 'brand') {
    $brand_id = $this->brand_model->get_id();
    print("<script type='text/javascript'>
    var BRAND_ID = {$brand_id};
    var CAT = 1;
    var SHOW = 0;
    var initial_length = 0;
    var chat = 0;
    var single = 0;
    </script>");
  }
}
?>

<?php if($single==1){
  ?>
  <link href="<?php echo ASSETS;?>css/chat.css" rel="stylesheet">
  <div class="right_col" role="main">
    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Messenger<small>WebAssets</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-offset-2 col-md-8 mail_list_column" id="chat-element">
                  <!-- Let jQuery put the messages here -->
                </div>
                <!-- /MAIL LIST -->

                <div class="container" id="main-msg">
                  <div class="row chat-window col-md-12" id="chat_window_1" style="margin-left:10px;">
                    <div class="col-xs-12 col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading top-bar">
                          <div class="col-md-8 col-xs-8">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat( )</h3>
                          </div>
                          <div class="col-md-4 col-xs-4" style="text-align: right;">
                            <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                            <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                          </div>
                        </div>

                        <div class="panel-body msg_container_base">

                        </div>

                        <div class="panel-footer">
                          <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                            <span class="input-group-btn">
                              
                            </span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="btn-group dropup">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-cog"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#" id="new_chat"><span class="glyphicon glyphicon-plus"></span> Novo</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-list"></span> Ver outras</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Fechar Tudo</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><span class="glyphicon glyphicon-eye-close"></span> Invisivel</a></li>
                    </ul>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="<?php echo ASSETS.'js/jquery.min.js' ?>"></script>
  <script type="text/javascript">
  loaddata();
  if(single == 1){
    get();
  }
  function loaddata(){
    $(function() {
      if(chat>0){
        $("#chat_window_1").hide();
      }
      var url = SITEURL+'brand/get_chats';

      var id = 0;
      if(CAT == 0)
      id = INF_ID;
      else
      id = BRAND_ID;

      $.ajax({
        url: url,
        type: "POST",
        data: {'id': id, 'cat': CAT},
        success: function(data) {
          // alert(JSON.stringify(data));
          html = "";
          if(data.length == 0) {
            //html += '<pre>';
            html += '  <h3 class="text-center"><?php if(isset($brand_id) && isset($inf_id)){ ?>Looks like you don\'t have any messages.<?php }else{ ?>Looks Like You Dont Have Any Recent Chats.<?php } ?></h3>';
            //html += '</pre>';
            html += '<center><?php if(isset($brand_id) && isset($inf_id)){ ?><button class="btn btn-primary" onclick="get();">START COMMUNICATING</button><?php }else{ ?> <?php } ?></center>';
          }
          else {
            html += '<center><button class="btn btn-primary" onclick="forcerefresh();">Refresh</button></center>';
            html += '<div><hr></div>';
            for(var i = 0; i < data.length; i++) {
              var obj = data[i];
              var name = "";
              if(obj.msg_by == 'b')
              name = obj.brand_name;
              else
              name = obj.inf_name;

              html += '<a href="#" onclick="define_conv('+data[i].brand_id+","+data[i].inf_id+');">';
              html += '  <div class="mail_list">';
              html += '    <div class="left avatar">';
              html += '      <img src="<?php echo $this->custom_functions->check_img($this->session->image);?>" class="img-responsive">';
              html += '    </div>';
              html += '    <div class="right">';
              html += '      <h3><strong>'+name.capitalize()+'</strong> <small>'+data[i].time+'</small></h3>';
              html += '      <p>'+data[i].msg+'</p>';
              html += '    </div>';
              html += '  </div>';
              html += '</a>';
            }
          }
          $('#chat-element').html("");
          $('#chat-element').append(html);

          if(SHOW == 0) {
            $("#chat_window_1").hide();
          }
          else {
            start_conv();
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          //alert("hi");
          //alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
      });
    });
  }
  function start_conv() {
    var url = SITEURL+'brand/get_conv';
    var html = "";
    var $this = $(this);

    $.ajax({
      url: url,

      type: "POST",
      data: {'brand_id': BRAND_ID, 'inf_id': INF_ID},
      success: function(data) {
        //alert(JSON.stringify(data));
        var data2 = data;
        var name2 = '';
        if(CAT == 0){
          name2 = data2.brand_name;
          var res = name2.capitalize();
        }else{
          name2 = data2.inf_name;
          var res = name2.capitalize();
        }
        html += '  <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">';
        html += '    <div class="col-xs-12 col-md-12">';
        html += '      <div class="panel panel-default">';
        html += '        <div class="panel-heading top-bar">';
        html += '          <div class="col-md-7 col-xs-7">';
        html += '            <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span><pho>'+res+' </h3>';
        html += '          </div>';
        html += '          <div class="col-md-5 col-xs-5" style="text-align: right;">';
        html += '            <a href="javascript:forcerefresh()"  ><span  class="glyphicon glyphicon-refresh icon_minim"></span></a>';
        html += '            <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>';
        html += '            <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>';
        html += '          </div>';
        html += '        </div>';
        html += '        <div class="panel-body msg_container_base">';

        brand_name = data.brand_name;
        inf_name = data.inf_name;
        data = data.data;
        var name = "";
        for(var i = 0; i < data.length; i++) {
          var obj = data[i];
          if(CAT == 0)
          name = brand_name;
          else
          name = inf_name;
          if((CAT == 0 && obj.msg_by == 'i') || (CAT == 1 && obj.msg_by == 'b')) {
            html += '<div class="row msg_container base_sent">';
            html += '  <div class="col-md-10 col-xs-10">';
            html += '    <div class="messages msg_sent">';
            html += '      <p>';
            html += obj.msg;
            html += '      </p>';
            html += '      <time datetime="'+obj.time+'">You • '+obj.time;
            html += '      </time>';
            html += '    </div>';
            html += '  </div>';
            html += '  <div class=" col-md-2 col-xs-2 avatar">';
            html += '    <img src="<?php echo $this->custom_functions->check_img($this->session->image);?>" class="img-responsive">';
            html += '  </div>';
            html += '</div>';
          }
          else {
            html += '<div class="row msg_container base_receive">';
            html += '  <div class="col-md-2 col-xs-2 avatar">';
            html += '    <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg">';
            html += '  </div>';
            html += '  <div class="col-md-10 col-xs-10">';
            html += '    <div class="messages msg_receive">';
            html += '      <p>';
            html += obj.msg;
            html += '      </p>';
            html += '      <time datetime="'+obj.time+'">'+name+' • '+obj.time;
            html += '    </div>';
            html += '  </div>';
            html += '</div>';
          }
        }

        html += '        </div>';
		html += '		<form id="s">';
        html += '        <div class="panel-footer">';
        html += '          <div class="input-group">';
        html += '            <input id="btn-input" type="text" tabindex="-1" class="form-control input-sm chat_input" placeholder="Write your message here..." />';
        html += '            <span class="input-group-btn">';
        html += '              <button class="btn btn-primary btn-sm" onclick="message();" id="btn-chat" >Send</button>';
        html += '            </span>';
        html += '          </div>';
        html += '        </div>';
		html += '		</form>';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '  <div class="btn-group dropup">';
        html += '    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">';
        html += '      <span class="glyphicon glyphicon-cog"></span>';
        html += '      <span class="sr-only">Toggle Dropdown</span>';
        html += '    </button>';
        html += '    <ul class="dropdown-menu" role="menu">';
        html += '      <li><a href="#" id="new_chat"><span class="glyphicon glyphicon-plus"></span> Novo</a></li>';
        html += '      <li><a href="#"><span class="glyphicon glyphicon-list"></span> Ver outras</a></li>';
        html += '      <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Fechar Tudo</a></li>';
        html += '      <li class="divider"></li>';
        html += '      <li><a href="#"><span class="glyphicon glyphicon-eye-close"></span> Invisivel</a></li>';
        html += '    </ul>';
        html += '  </div>';

        $('#main-msg').html("");
        $('#main-msg').append(html);

        $("#chat_window_1").show();
        $this.parents('.panel').find('.panel-body').slideUp();

        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
      }
    });
  }

  function define_conv(brand_id, inf_id) {
    chat = chat + 1;
    if(chat >= 1) {
      // alert("hi");
      clearInterval(refresh);
    }
    //alert(chat);
    BRAND_ID = brand_id;
    INF_ID = inf_id;
    update1();
    start_conv();
  }


  $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
      $this.parents('.panel').find('.panel-body').slideUp();
      $this.addClass('panel-collapsed');
      $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
      $this.parents('.panel').find('.panel-body').slideDown();
      $this.removeClass('panel-collapsed');
      $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
  });
  $(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
      $this.parents('.panel').find('.panel-body').slideDown();
      $('#minim_chat_window').removeClass('panel-collapsed');
      $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
  });
  $(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
    size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
  });
  $(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
  });
  function message() {
    var msg = $("#btn-input").val();
    if(msg==""){
      alert("You can't send empty text");
      return false;
    }
    if(CAT=='0'){
      var msg_by = 'i';
    }else if(CAT=='1'){
      var msg_by = 'b';
    }
    var postData = {
      'msg'  : msg,
      'msg_by' : msg_by,
      'b_id' : BRAND_ID,
      'i_id' : INF_ID
    };
    var url = SITEURL+'brand/chat_insert';

    $.ajax({
      type: "POST",
      url:  url,
      data: postData , //assign the var here
      success : function(data) {
		alert("hi");
        loaddata();
        start_conv();
        SHOW = 1;
      },
      error : function(data) {
        error404();
      }
    });

  }
  function update1(){

    var url = SITEURL+'brand/get_conv';
    $.ajax({
      url: url,
      type: "POST",
      data: {'brand_id': BRAND_ID, 'inf_id': INF_ID},
      success: function(data) {
        //alert(data.data.length);

        initial_length = data.data.length;
        setInterval(function() {
          update2();
        }, 360000);
      }
    });
  }
  function update2(){
    //alert(initial_length);
    var url = SITEURL+'brand/get_conv';
    $.ajax({
      url: url,
      type: "POST",
      data: {'brand_id': BRAND_ID, 'inf_id': INF_ID},
      success: function(data){
        if(data.data.length>initial_length){
          initial_length = data.data.length;
          SHOW =0;
          loaddata();
          if(SHOW==1){
            SHOW=0;
          }if(SHOW==0){
            SHOW=1;
          }
        }

      }
    });
  }
  if(chat==0){
    var refresh = setInterval(function(){
      if(single != 1){
        loaddata();
      }else{
        update1();
      }
    },360000);
  }
  function get(){
    clearInterval(refresh);
    loaddata();
    if(SHOW==1){
      SHOW=0;
    }if(SHOW==0){
      SHOW=1;
    }
  }
  function forcerefresh(){
    loaddata();

    if(chat>0){
      start_conv();
    }
  }

  document.getElementById("btn-input")
  .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
      document.getElementById("btn-chat").click();
    }
  });
  String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
  }
  
  $("#s").keypress(function(e) {
    if(e.which == 13) {
    $("#btn-chat").click();
    }
});
  </script>
  <?php } ?>
