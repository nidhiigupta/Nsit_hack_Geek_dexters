<?php

	if($this->input->post('inf_id') && $this->input->post('brand_id')) {
		$single = 1;
		$brand_id = $this->input->post('brand_id');
		$inf_id = $this->input->post('inf_id');
		$cat = $this->input->post('cat');

		print("<script type='text/javascript'>
		var INF_ID = {$inf_id};
		var auto = 1;
		var BRAND_ID = {$brand_id};
		var CAT = {$cat};
		</script>");
	}
	else {

		if($this->uri->segment(1) == 'influencer') {
			$inf_id = $this->influencer_model->get_id();
			print("<script type='text/javascript'>
			var INF_ID = {$inf_id};
			var CAT = 0;
			var auto = 0;
			</script>");
		}
		else if($this->uri->segment(1) == 'brand') {
			$brand_id = $this->brand_model->get_id();
			print("<script type='text/javascript'>
			var BRAND_ID = {$brand_id};
			var CAT = 1;
			var auto = 0;
			</script>");
		}
	}
?>
<style>
	.active{
	background-color:#1BBAE1;

	}
</style>



<div id="page-content">
	<!-- Chat Header -->
	<div class="content-header">
		<div class="header-section">
			<h1>
				<i class="fa fa-comments"></i>Inbox<br><small>Your Social Center</small>
			</h1>
		</div>
	</div>

	<!-- END Chat Header -->

	<!-- Chat Block -->
	<div class="block">
		<!-- Title -->
		<div id="remove" class="block-title">

			<h2 ><i class="fa fa-pencil animation-pulse"></i> <strong>Private</strong> Chat</h2>(This Is Just A Sample Chat)
		</div>

		<div class="chatui-container block-content-full">
			<!-- People -->
			<div class="chatui-people themed-background-dark">
				<div class="chatui-people-scroll">
					<!-- Online -->
					<h2 class="chatui-header"><i class="fa fa-circle text-success pull-right"></i><strong>Contacts</strong></h2>
					<div class="list-group" id="chat-element">


					</div>

				</div>
			</div>
			<!-- END People -->

			<!-- Talk -->
			<div class="chatui-talk">
				<div class="chatui-talk-scroll" id="main-msg">
					<ul>
						<li class="chatui-talk-msg">
							<img src="<?php echo ASSETS;?>/proui/img/placeholders/avatars/avatar6.jpg" alt="Avatar" class="img-circle chatui-talk-msg-avatar">
							Click on Contact to Start Communucating...
						</li>
					</ul>
				</div>
			</div>
			<!-- END Talk -->

			<!-- Input -->
			<div class="chatui-input">
				<form   method="post" class="form-horizontal form-control-borderless remove-margin">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
						<input type="text" id="chatui-message" name="chatui-message"  class="form-control input-lg" placeholder="Type a message and hit enter..">
					</div>
				</form>
			</div>
			<!-- END Input -->
		</div>
		<!-- END Content -->
	</div>
	<!-- END Chat Block -->
</div>
<!-- END Page Content -->





<script type="text/javascript" src="<?php echo ASSETS.'js/jquery.min.js' ?>"></script>
<script type="text/javascript">


	function define_conv(brand_id, inf_id) {

		$(function() {
			$( 'ul.nav li' ).on( 'click', function() {
				$( this ).parent().find( 'li.active' ).removeClass( 'active' );
				$( this ).addClass( 'active' );
			});
		});

		BRAND_ID = brand_id;
		INF_ID = inf_id;
		start_conv();
		var chatHeight          = 600; // Default chat container height in large screens
		var chatHeightSmall     = 300; // Default chat components (talk & people) height in small screens

		/* Cache some often used variables */
		var chatCon             = $('.chatui-container');
		var chatTalk            = $('.chatui-talk');
		var chatTalkScroll      = $('.chatui-talk-scroll');

		var chatPeople          = $('.chatui-people');
		var chatPeopleScroll    = $('.chatui-people-scroll');



				chatTalkScroll
                .slimScroll({
                    height: chatTalk.outerHeight(),
                    color: '#000',
                    size: '3px',
                    position: 'right',
                    touchScrollStep: 200
				});

				chatPeopleScroll
                .slimScroll({
                    height: chatPeople.outerHeight(),
                    color: '#fff',
                    size: '3px',
                    position: 'right',
                    touchScrollStep: 200
				});
		chatTalkScroll
						.animate({ scrollTop: chatPeopleScroll[0].scrollHeight },1000);


	}
	function start_conv() {
		var url = SITEURL+'brand/get_conv';
		var html = "";
		var html2 = "";
		var $this = $(this);

		$.ajax({
			url: url,

			type: "POST",
			data: {'brand_id': BRAND_ID, 'inf_id': INF_ID},
			success: function(data) {

				var data2 = data;
				var name2 = '';
				if(CAT == 0){
					name2 = data2.brand_name;
					var res = name2.capitalize();
					}else{
					name2 = data2.inf_name;
					var res = name2.capitalize();
				}

				brand_name = data.brand_name;
				inf_name = data.inf_name;
				data = data.data;
				var name = "";
				html += '<ul>';
				for(var i = 0; i < data.length; i++) {
					var obj = data[i];

					if(CAT == 0)
					name = brand_name;
					else
					name = inf_name;
					if((CAT == 0 && obj.msg_by == 'i') || (CAT == 1 && obj.msg_by == 'b')) {
						html += '<li class="text-center"><small>'+obj.time+'</small></li>'
						html += '<li class="chatui-talk-msg chatui-talk-msg-highlight themed-border"><img src="<?php echo ASSETS;?>/proui/img/placeholders/avatars/avatar2.jpg" alt="Avatar" class="img-circle chatui-talk-msg-avatar">'+obj.msg+'</li>'
					}
					else {
						html += '<li class="text-center"><small>'+obj.time+'</small></li>'
						html += '<li class="chatui-talk-msg themed-border"><img src="<?php echo ASSETS;?>/proui/img/placeholders/avatars/avatar2.jpg" alt="Avatar" class="img-circle chatui-talk-msg-avatar">'+obj.msg+'</li>'
					}
				}

				html += '</ul>';
				html2 +='';
				$('#main-msg').html("");
				if(CAT == 0)
				name = brand_name;
				else
				name = inf_name;
				$('#remove').html('<h2 ><i class="fa fa-pencil animation-pulse"></i> <strong>Message</strong> To<strong> '+ name.capitalize()	+'</strong></h2>');
				$('#main-msg').append(html);
				$('#remove').append(html2);


			}
		});
	}
	String.prototype.capitalize = function() {
		return this.charAt(0).toUpperCase() + this.slice(1);
	}
	loaddata();

	function loaddata(){
		$(function() {

			var url = SITEURL+'brand/get_chats';
			var id = 0;
			if(CAT == 0)
			id = INF_ID;
			else
			id = BRAND_ID;
			html2 = '';
			$.ajax({
				url: url,
				type: "POST",
				data: {'id': id, 'cat': CAT},
				success: function(data) {
					if(data=='' && auto !=1){
						$('.block').html('');
						html2 +="<p class='alert alert-danger'>You Dont Have Any Contacts Yet...</p>"
						$('.block').append(html2);

						}
					html = "";

					html += '<ul class="nav">';
					for(var i = 0; i < data.length; i++) {
						var obj = data[i];
						var name = "";
						if(CAT == 0)
						name = obj.brand_name;
						else
						name = obj.inf_name;
						html += ' <li ><a href="javascript:void(0)" class="list-group-item" onclick="define_conv('+data[i].brand_id+","+data[i].inf_id+');"><span class="badge"></span><img src="<?php echo ASSETS;?>/proui/img/placeholders/avatars/avatar14.jpg" alt="Avatar" class="img-circle"><h5 class="list-group-item-heading"><strong>'+name.capitalize()+'</strong> <br><small style="color:white;" class="pull-right">'+data[i].time+'</small></strong><br> </h5></a></li>';
					}
					html += '</ul>';
					$('#chat-element').html("");
					$('#chat-element').append(html);

				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {

				}
			});
		});
	}

</script>

<script >

	function message(){
		var msg = $("#chatui-message").val();
		if(msg==""){
			swal("ERROR","You can't send empty text","error");
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
				alertify.logPosition("top right");
				alertify.success('Message Sent !!');
				loaddata();
				start_conv();
			},
			error : function(data) {
				console.log(data);
				error404();
			}
		});

	}

	var ReadyChat = function() {
		var chatHeight          = 600; // Default chat container height in large screens
		var chatHeightSmall     = 300; // Default chat components (talk & people) height in small screens

		/* Cache some often used variables */
		var chatCon             = $('.chatui-container');
		var chatTalk            = $('.chatui-talk');
		var chatTalkScroll      = $('.chatui-talk-scroll');

		var chatPeople          = $('.chatui-people');
		var chatPeopleScroll    = $('.chatui-people-scroll');

		var chatInput           = $('.chatui-input');
		var chatMsg             = '';

		/* Updates chat UI components height */
		var updateChatHeight = function(){
			var windowW = window.innerWidth
			|| document.documentElement.clientWidth
			|| document.body.clientWidth;

			if (windowW < 768) { // On small screens
				chatCon
                .css('height', (chatHeightSmall * 2) + chatInput.outerHeight());

				chatTalk
                .add(chatTalkScroll)
                .add(chatTalkScroll.parent())
                .add(chatPeople)
                .add(chatPeopleScroll)
                .add(chatPeopleScroll.parent())
                .css('height', chatHeightSmall);
			}
			else if (windowW > 767) { // On large screens
				chatCon
                .css('height', chatHeight);

				chatTalk
                .add(chatTalkScroll)
                .add(chatTalkScroll.parent())
                .css('height', chatHeight - chatInput.outerHeight());

				chatPeople
                .add(chatPeopleScroll)
                .add(chatPeopleScroll.parent())
                .css('height', chatHeight);
			}
		};

		return {
			init: function() {
				// Initialize default chat height
				updateChatHeight();

				// Update chat UI components height on window resize
				$(window).resize(function(){ updateChatHeight(); });

				// Initialize scrolling on chat talk + people
				chatTalkScroll
                .slimScroll({
                    height: chatTalk.outerHeight(),
                    color: '#000',
                    size: '3px',
                    position: 'right',
                    touchScrollStep: 100
				});

				chatPeopleScroll
                .slimScroll({
                    height: chatPeople.outerHeight(),
                    color: '#fff',
                    size: '3px',
                    position: 'right',
                    touchScrollStep: 100
				});

				// When the chat message form is submitted
				chatInput
                .find('form')
                .submit(function(e){
                    // Get text from message input
                    chatMsg = chatInput.find('#chatui-message').val();
					message();
                    // If the user typed a message
                    if (chatMsg) {
                        // Add it to the message list
                        chatTalk
						.find('ul')
						.append('<li class="chatui-talk-msg chatui-talk-msg-highlight themed-border animation-expandUp">'
						+ '<img src="<?php echo ASSETS; ?>proui/img/placeholders/avatars/avatar2.jpg" alt="Avatar" class="img-circle chatui-talk-msg-avatar">'
						+ $('<div />').text(chatMsg).html()
						+ '</li>');

                        // Scroll the message list to the bottom
                        chatTalkScroll
						.animate({ scrollTop: chatTalkScroll[0].scrollHeight },1500);

                        // Reset the message input
                        chatInput
						.find('#chatui-message')
						.val('');
					}

                    // Don't submit the message form
                    e.preventDefault();
				});
			}
		};
	}();
	if(auto ==1){
		loaddata();
		define_conv(BRAND_ID, INF_ID);

		}
</script>
<script>$(function(){ ReadyChat.init(); });</script>
