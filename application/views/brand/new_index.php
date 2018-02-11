
<div id="page-content">
	<div class="content-header content-header-media">
		<div class="header-section">
			<div class="row">
				<!-- Main Title (hidden on small devices for the statistics to fit) -->
				<div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
					<h1>Welcome <strong><?php echo $_SESSION['name'];?></strong><br><small>You Look Awesome!</small></h1>
				</div>

				<div class="col-md-8 col-lg-6">
					<div class="row text-center">
						<div class="col-xs-4 col-sm-3">
							<h2 class="animation-hatch">
								<strong><?php echo $campcount;?></strong><br>
								<small><i class="fa fa-gamepad"></i> Campaigns</small>
							</h2>
						</div>
						<div class="col-xs-4 col-sm-3">
							<h2 class="animation-hatch">
								<strong><?php echo $totalprice;?></strong><br>
								<small><i class="fa fa-inr"></i> Spending</small>
							</h2>
						</div>
						<div class="col-xs-4 col-sm-3">
							<h2 class="animation-hatch">
								<strong><?php echo $infcount;?></strong><br>
								<small><i class="fa fa-user"></i> Influencers</small>
							</h2>
						</div>

						<div class="col-sm-3 hidden-xs">
							<h2 class="animation-hatch">
								<strong><?php echo $brandcount;?></strong><br>
								<small><i class="fa fa-user"></i> Brands</small>
							</h2>
						</div>

					</div>
				</div>
				<!-- END Top Stats -->
			</div>
		</div>
		<!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
		<img src="<?php echo ASSETS.'proui/' ?>img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
	</div>
	<!-- END Dashboard Header -->
	<!--<div class="row">
	<div class="col-lg-12">
	<a href="" class="widget widget-hover-effect1">
	<div class="widget-simple">

					<h3 class="widget-content animation-pullDown">
						<strong><?php echo $yourcamp;?></strong><br>
						Your Campaigns
					</h3>
				</div>
	</a>
	</div>
	</div>-->
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<!-- Widget -->
			<a href="<?php echo SITEURL?>brand/campaigns/all" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
						<i class="fa fa-gamepad"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<strong><?php echo $yourcamp;?></strong><br>
						<small>Your Campaigns</small>
					</h3>
				</div>
			</a>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-lg-3">
			<!-- Widget -->
			<a href="<?php echo SITEURL?>brand/payments" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-spring animation-fadeIn">
						<i class="gi gi-usd"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<strong><?php echo $price?></strong><br>
						<small>Your Spending</small>
					</h3>
				</div>
			</a>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-lg-3">
			<!-- Widget -->
			<a href="<?php echo SITEURL?>brand/chat" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-fire animation-fadeIn">
						<i class="gi gi-envelope"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<?php echo $yourchat;?> <strong>Messages</strong>
						<small>Get In Touch</small>
					</h3>
				</div>
			</a>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-lg-3">
			<!-- Widget -->
			<a href="<?php echo SITEURL?>brand/profile" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-fire animation-fadeIn">
						<i class="gi gi-wallet"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<?php echo $yourwallet;?> <strong>Balance</strong>
						<small> Add Money To Wallet  </small>
					</h3>
				</div>
			</a>
			<!-- END Widget -->
		</div>

	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-6">
			<!-- Widget -->
			<a href="<?php echo SITEURL?>brand/campaigns/offers" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
						<img width="75" height = "75" src="<?php echo ASSETS.'proui/' ?>img/ongoing.jpg">
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<strong><?php echo $ongoing_camp;?></strong><br>
						<small>Ongoing Campaigns</small>
					</h3>
				</div>
			</a>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-lg-6">
			<a href="<?php echo SITEURL?>brand/campaigns/all" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-spring animation-fadeIn">
						<img id="uid_dimg_2" src="<?php echo ASSETS.'proui/' ?>img/completed.png" width="70" >
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<strong><?php echo $completed_camp ?></strong><br>
						<small>Completed Campaigns</small>
					</h3>
				</div>
			</a>

		</div>

	</div>
	<form action="<?php echo SITEURL?>brand/dashboard" method="post">
		<div class="row">
			<div class="col-lg-12 col-sm-12" >          <div class="widget">

				<div class="widget-extra text-center themed-background-dark-night">
					<h3 class="widget-content-light"><i class="gi gi-notes_2 animation-floating"></i> Select<strong>Campaign</strong></h3>
				</div>
				<div class="widget-simple">
				<?php if($dropdown!=False){ ?>
					<div class="col-lg-2"></div>
					<div class="col-lg-6">

						<select class="form-control" name="main_id" >
							<option value="">Choose One</option>
							<?php foreach($dropdown as $row){ ?>
								<option value="<?php echo $row['id'];?>" <?php if($row['id']==$latest[0]['id']){echo 'selected';}?>><?php echo $row['camp_name']?></option>
							<?php } ?>
						</select>

					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<center> <button type="submit" class="btn btn-primary">View Analytics</button></center>
						</div>
					</div>
					<?php }else{ ?>
					<div class="col-lg-6">
					<p class="alert alert-danger">You do not have any active Campaigns.<br> Click on Create New Campaign to create one.</p><br>


					</div>
					<div class="col-lg-6">
					<a href="<?php echo SITEURL?>brand/start_campaign" class="btn btn-primary" > Create New Campaign</a>
					</div>
					<?php } ?>
				</div>
			</div></div>

		</div>
	</form>

	<?php if($facebook==true || $multiple_fb ==true){ ?>
		<div class="row" id="fb">
			<div class="col-lg-12 col-sm-12" >          <div class="widget">
				<div class="widget-extra text-center themed-background-dark-night">
				
					<h3 class="widget-content-light"><i class="fa fa-arrow-up animation-floating"></i> Facebook <strong> Camp Stats</strong>
					<?php if($dropdown_fb){ ?>
					
					<div class="pull-right" style="display:inline;">
					<span  style="display:inline;">
					<p style="display:inline;color:white;font-size:0.9em;">Select Page-</p>
					</span>
					<span class="pull-right" style="display:inline;">
					<select class="form-control" name="main_id" onchange="multiple_fb(this.value);" >
							<option value="nochoice">Choose One</option>
							<?php foreach($dropdown_fb as $row){ ?>
								<option value="<?php echo $row['id'];?>" <?php if($row['id']==$latest[0]['id']){echo 'selected';}?>><?php echo $row['name']?></option>
							<?php } ?>

						</select>
						</span>
						</div>
					<?php } ?>
					<!--<span class="pull-right">
					
					<select class="form-control" name="main_id" onchange="facebook_hit();" >
							<option value="">Choose One</option>
							<option value="">Last 24 Hours</option>
							<option value="">Last 3 Days</option>
							<option value="">Last 7 Days</option>
							<option value="" selected="selected">From Begining</option>

						</select>
						</span>--></h3>

				</div>
				
				<div class="widget-simple" id="widget-fb">
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myfb"></canvas>
					</div></div>
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myfb2"></canvas>
					</div></div>
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myfb3"></canvas>
					</div></div>
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myfb4"></canvas>
					</div></div>
					<div class="col-lg-12">
						<div class="col-lg-6 col-sm-12" ><div class="widget">
							<canvas width="1393px;" height="1000px;" id="myfb5"></canvas>
						</div></div>
						<div class="col-lg-6 col-sm-12" ><div class="widget">
							<canvas width="1393px;" height="1000px;" id="myfb6"></canvas>
						</div></div>
					</div>
				</div>
				<div class="widget-simple" id="widget-fb-nopage">
					<h3><p class="alert alert-success">You Have Multiple Pages Linked for This Campaign Please Select a Page From Above Dropdown.</p></h3>
				</div>
			</div></div>

		</div>
	<?php }?>
	<?php if($twitter==true){ ?>
		<div class="row" id="tw">
			<div class="col-lg-12 col-sm-12" >          <div class="widget">
				<div class="widget-extra text-center themed-background-dark-night">
					<h3 class="widget-content-light"><i class="fa fa-arrow-up animation-floating"></i> Twitter <strong> Camp Stats</strong>
					
					<span class="pull-right">
					<!--
					<select class="form-control" name="main_id" onchange="twitter_hit();" >
							<option value="">Choose One</option>
							<option value="">Last 24 Hours</option>
							<option value="">Last 3 Days</option>
							<option value="">Last 7 Days</option>
							<option value="" selected="selected">From Begining</option>

						</select>-->
						</span></h3>
				</div>
				<div class="widget-simple">
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="mytwitter"></canvas>
					</div>
					</div>

					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="mytwitter2"></canvas>
					</div></div>
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="mytwitter3"></canvas>
					</div></div>
				</div>
			</div></div>

		</div>

	<?php }?>
	<?php if($insta==true){ ?>
		<div class="row" id="ins">
			<div class="col-lg-12 col-sm-12" >          <div class="widget">
				<div class="widget-extra text-center themed-background-dark-night">
					<h3 class="widget-content-light"><i class="fa fa-arrow-up animation-floating"></i> Instagram <strong> Camp Stats</strong><span class="pull-right">	<!--<select class="form-control" name="main_id" onchange="instagram_hit();" >
							<option value="">Choose One</option>
							<option value="">Last 24 Hours</option>
							<option value="">Last 3 Days</option>
							<option value="">Last 7 Days</option>
							<option value="" selected="selected">From Begining</option>

						</select>-->
						</span></h3>
				</div>
				<div class="widget-simple">
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myinsta"></canvas>
					</div>
					</div>

					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myinsta2"></canvas>
					</div></div>
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myinsta3"></canvas>
					</div></div>
				</div>
			</div></div>

		</div>

	<?php }?>
	<?php if($youtube==true){ ?>
		<div class="row" id="you">
			<div class="col-lg-12 col-sm-12" >          <div class="widget">
				<div class="widget-extra text-center themed-background-dark-night">
					<h3 class="widget-content-light"><i class="fa fa-arrow-up animation-floating"></i> Youtube <strong> Camp Stats</strong><span class="pull-right">	<!--<select class="form-control" name="main_id" onchange="youtube_hit();" >
							<option value="">Choose One</option>
							<option value="">Last 24 Hours</option>
							<option value="">Last 3 Days</option>
							<option value="">Last 7 Days</option>
							<option value="" selected="selected">From Begining</option>

						</select>-->
						</span></h3>
				</div>
				<div class="widget-simple">
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myyou"></canvas>
					</div>
					</div>

					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myyou2"></canvas>
					</div></div>
					<div class="col-lg-6 col-sm-12" ><div class="widget">
						<canvas width="1393px;" height="1000px;" id="myyou3"></canvas>
					</div></div>
				</div>
			</div></div>

		</div>

	<?php }?>
	<?php if($click_check==true){ ?>
		<div class="row" id="click_check">
			<div class="col-lg-12 col-sm-12" >          <div class="widget">
				<div class="widget-extra text-center themed-background-dark-night">
					<h3 class="widget-content-light"><i class="fa fa-arrow-up animation-floating"></i> Clicks<strong> Camp Stats</strong></h3>
				</div>
				<div class="widget-simple">
					<?php for ($i=0;$i<sizeof($click_check);$i++){
					?>
					<div class="col-lg-6 col-sm-12" ><div class="widget">

						<canvas id="barChart<?php echo $i;?>" width="1393px;" height="1000px;"></canvas>
					</div>
					</div>
					<?php } ?>

				</div>
			</div></div>

		</div>

	<?php }?>

</div>
<?php if($latest){ ?>
<script>
	var any =0;
	function arrayMax(arr) {
		var len = arr.length, max = -Infinity;
		while (len--) {
			if (arr[len] > max) {
				max = arr[len];
			}
		}
		return max;
	};
	function change(){
		alert("hi");
		}
	function toDateTime(secs) {
		var t = new Date(1970, 0, 1); // Epoch
		t.setSeconds(secs);
		return t;
	}
	function formatDate(date) {
		var d = new Date(date),
		month = '' + (d.getMonth() + 1),
		day = '' + d.getDate(),
		year = d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [year, month, day].join('-');
	}
	var siteurl="<?php echo SITEURL?>";

	var camp = <?php echo $latest[0]['id']; ?>;

	var daa = {camp_id : camp};

</script>
<?php }?>

<?php if($facebook==true){ ?>
	<script>
		facebook_hit();
		function facebook_hit(range){
			var url_fb=siteurl+"brand/dashboard_fb";
		$(document).ready(function(){
			$.ajax({
				url:url_fb,
				type:"POST",
				data:daa,
				success:function(data){

					if(data!='')
					{
						if(data.error != 'NOT FOUND'){

							var impression = [];
							var post_impressions_unique = [];
							var post_consumptions = [];
							var post_consumptions_unique = [];
							var post_engaged_users = [];

							var timestamp = [];
							var reach =[];
							var like = [];
							var haha = [];
							var wow = [];
							var love = [];
							var sorry = [];
							var anger = [];
							var share = [];
							var comment =[];

							for (var i=0;i<data.length-1;i++){

								impression.push(data[i].data.post_impressions);
								post_impressions_unique.push(data[i].data.post_impressions_unique);
								post_consumptions.push(data[i].data.post_consumptions);
								post_consumptions_unique.push(data[i].data.post_consumptions_unique);
								post_engaged_users.push(data[i].data.post_engaged_users);
								reach.push(data[i].data.post_fan_reach);
								like.push(data[i].data.post_reactions_like_total);
								haha.push(data[i].data.post_reactions_haha_total);
								wow.push(data[i].data.post_reactions_wow_total);
								love.push(data[i].data.post_reactions_love_total);
								sorry.push(data[i].data.post_reactions_sorry_total);
								anger.push(data[i].data.post_reactions_anger_total);
								share.push(data[i].data.shares);
								comment.push(data[i].data.comments);


								dateString=new Date(toDateTime(data[i].timestamp)).toUTCString();
								dateString=dateString.split(' ').slice(1, 3).join(' ');
								dateString='';

								timestamp.push(dateString);
							}
							Math.max.apply(null, reach);
							var chartdata = {
								labels : timestamp,
								datasets : [
								{
									label:'Impression',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",

									data :impression

								},
								{
									label:'Impression Unique',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",

									data :post_impressions_unique

								},


								]
							}

							var ctx = $('#myfb');
							var ctx2 = $('#myfb2');
							var ctx3 = $('#myfb3');
							var ctx4 = $('#myfb4');
							var ctx5 = $('#myfb5');
							var ctx6 = $('#myfb6');
							var chartOptions = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max :Math.ceil(Math.max(Math.max.apply(null, impression),Math.max.apply(null, post_impressions_unique))+ Math.max(Math.max.apply(null, impression),Math.max.apply(null, post_impressions_unique))/3.5),
											stepSize:  Math.ceil(Math.max(Math.max.apply(null, impression),Math.max.apply(null, post_impressions_unique))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Impressions',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx,{
								type:'line',
								data :chartdata,
								options:chartOptions

							});
							var chartdata4 = {
								labels : timestamp,
								datasets : [

								{
									label :'Reach',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",
									data :reach

								},


								]
							}

							var chartdata2 = {
								labels : timestamp,
								datasets : [
								{
									label:'Consumptions',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",

									data :post_consumptions

								},
								{
									label:'Consumptions Unique',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",

									data :post_consumptions_unique

								},


								]
							}

							var chartdata5 = {
								labels : timestamp,
								datasets : [

								{
									label:'Love',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F25268",

									data :love

								},
								{
									label:'Haha',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F2BA15",

									data :haha

								},
								{
									label:'Wow',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6B727E",

									data :wow

								},
								{
									label:'Sorry',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F0BA8E",

									data :love

								},
								{
									label:'Angry',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F7714B",

									data :anger

								}

								]
							}

							var chartdata6 = {
								labels : timestamp,
								datasets : [
								{
									label:'Likes',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",

									data :like

								},
								{
									label:'Shares',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",

									data :share

								},
								{
									label:'Comment',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#42B72A",

									data :comment

								},


								]
							}


							var chartOptions2 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min : 0,
											max :Math.ceil(Math.max(Math.max.apply(null, post_consumptions),Math.max.apply(null, post_consumptions_unique))+ Math.max(Math.max.apply(null, post_consumptions),Math.max.apply(null, post_consumptions_unique))/3.5),
											stepSize:  Math.ceil(Math.max(Math.max.apply(null, post_consumptions),Math.max.apply(null, post_consumptions_unique))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Consumptions',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx2,{
								type:'line',
								data :chartdata2,
								options:chartOptions2

							});
							var chartdata3 = {
								labels : timestamp,
								datasets : [
								{
									label :'Engaged Users',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",
									data :post_engaged_users

								},


								]
							}

							var chartOptions3 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, post_engaged_users)+ Math.max.apply(null, post_engaged_users)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, post_engaged_users)/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Engaged Users',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx3,{
								type:'line',
								data :chartdata3,
								options:chartOptions3

							});
							var chartOptions4 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, reach)+ Math.max.apply(null, reach)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, reach)/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Reach',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx4,{
								type:'line',
								data :chartdata4,
								options:chartOptions4

							});
							var chartOptions5 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min :0,
											max :Math.max(Math.max.apply(null, anger),Math.max.apply(null, love),Math.max.apply(null, wow),Math.max.apply(null, haha),Math.max.apply(null, sorry))+ Math.max(Math.max.apply(null, anger),Math.max.apply(null, love),Math.max.apply(null, wow),Math.max.apply(null, haha),Math.max.apply(null, sorry))/3.5,
											stepSize: Math.ceil(Math.max(Math.max.apply(null, anger),Math.max.apply(null, love),Math.max.apply(null, wow),Math.max.apply(null, haha),Math.max.apply(null, sorry))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Reactions',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx5,{
								type:'line',
								data :chartdata5,
								options:chartOptions5

							});
							var chartOptions6 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min : 0,
											max :Math.ceil(Math.max(Math.max.apply(null, like),Math.max.apply(null, share),Math.max.apply(null, comment))+ Math.max(Math.max.apply(null, like),Math.max.apply(null, share),Math.max.apply(null, comment))/3.5),
											stepSize: Math.ceil(Math.max(Math.max.apply(null, like),Math.max.apply(null, share),Math.max.apply(null, comment))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Likes ,Shares ,Comments',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx6,{
								type:'line',
								data :chartdata6,
								options:chartOptions6

							});

							}else{

							$("#fb").hide();
						}

						}else{
						$('#fb').hide();

					}
					},error:function(data){
					console.log(data);
				}
			})
		});

	}

	</script>
<?php } ?>

<?php if($multiple_fb==true){ ?>
	<script>
		
		$('#widget-fb').fadeOut('fast');
		function multiple_fb(range){
		
			var daa_mul = {camp_id : camp,analy_id:range};
			var url_fb=siteurl+"brand/dashboard_fb";
		$(document).ready(function(){
			$.ajax({
				url:url_fb,
				type:"POST",
				data:daa_mul,
				success:function(data){
				//console.log(data);
					if(data.error == 'pagenot'){
					
						$('#widget-fb-nopage').fadeIn('fast');
						$('#widget-fb').fadeOut('fast');
						return false;
					}
					if(data!='')
					{
						if(data.error != 'NOT FOUND'){
							$('#widget-fb-nopage').fadeOut('fast');
							$('#widget-fb').fadeIn('fast');
							var impression = [];
							var post_impressions_unique = [];
							var post_consumptions = [];
							var post_consumptions_unique = [];
							var post_engaged_users = [];

							var timestamp = [];
							var reach =[];
							var like = [];
							var haha = [];
							var wow = [];
							var love = [];
							var sorry = [];
							var anger = [];
							var share = [];
							var comment =[];

							for (var i=0;i<data.length-1;i++){

								impression.push(data[i].data.post_impressions);
								post_impressions_unique.push(data[i].data.post_impressions_unique);
								post_consumptions.push(data[i].data.post_consumptions);
								post_consumptions_unique.push(data[i].data.post_consumptions_unique);
								post_engaged_users.push(data[i].data.post_engaged_users);
								reach.push(data[i].data.post_fan_reach);
								like.push(data[i].data.post_reactions_like_total);
								haha.push(data[i].data.post_reactions_haha_total);
								wow.push(data[i].data.post_reactions_wow_total);
								love.push(data[i].data.post_reactions_love_total);
								sorry.push(data[i].data.post_reactions_sorry_total);
								anger.push(data[i].data.post_reactions_anger_total);
								share.push(data[i].data.shares);
								comment.push(data[i].data.comments);


								dateString=new Date(toDateTime(data[i].timestamp)).toUTCString();
								dateString=dateString.split(' ').slice(1, 3).join(' ');
								dateString='';

								timestamp.push(dateString);
							}
							Math.max.apply(null, reach);
							var chartdata = {
								labels : timestamp,
								datasets : [
								{
									label:'Impression',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",

									data :impression

								},
								{
									label:'Impression Unique',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",

									data :post_impressions_unique

								},


								]
							}

							var ctx = $('#myfb');
							var ctx2 = $('#myfb2');
							var ctx3 = $('#myfb3');
							var ctx4 = $('#myfb4');
							var ctx5 = $('#myfb5');
							var ctx6 = $('#myfb6');
							var chartOptions = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max :Math.ceil(Math.max(Math.max.apply(null, impression),Math.max.apply(null, post_impressions_unique))+ Math.max(Math.max.apply(null, impression),Math.max.apply(null, post_impressions_unique))/3.5),
											stepSize:  Math.ceil(Math.max(Math.max.apply(null, impression),Math.max.apply(null, post_impressions_unique))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Impressions',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx,{
								type:'line',
								data :chartdata,
								options:chartOptions

							});
							var chartdata4 = {
								labels : timestamp,
								datasets : [

								{
									label :'Reach',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",
									data :reach

								},


								]
							}

							var chartdata2 = {
								labels : timestamp,
								datasets : [
								{
									label:'Consumptions',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",

									data :post_consumptions

								},
								{
									label:'Consumptions Unique',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",

									data :post_consumptions_unique

								},


								]
							}

							var chartdata5 = {
								labels : timestamp,
								datasets : [

								{
									label:'Love',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F25268",

									data :love

								},
								{
									label:'Haha',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F2BA15",

									data :haha

								},
								{
									label:'Wow',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6B727E",

									data :wow

								},
								{
									label:'Sorry',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F0BA8E",

									data :love

								},
								{
									label:'Angry',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#F7714B",

									data :anger

								}

								]
							}

							var chartdata6 = {
								labels : timestamp,
								datasets : [
								{
									label:'Likes',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",

									data :like

								},
								{
									label:'Shares',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",

									data :share

								},
								{
									label:'Comment',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#42B72A",

									data :comment

								},


								]
							}


							var chartOptions2 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min : 0,
											max :Math.ceil(Math.max(Math.max.apply(null, post_consumptions),Math.max.apply(null, post_consumptions_unique))+ Math.max(Math.max.apply(null, post_consumptions),Math.max.apply(null, post_consumptions_unique))/3.5),
											stepSize:  Math.ceil(Math.max(Math.max.apply(null, post_consumptions),Math.max.apply(null, post_consumptions_unique))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Consumptions',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx2,{
								type:'line',
								data :chartdata2,
								options:chartOptions2

							});
							var chartdata3 = {
								labels : timestamp,
								datasets : [
								{
									label :'Engaged Users',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6d9cf9",
									data :post_engaged_users

								},


								]
							}

							var chartOptions3 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, post_engaged_users)+ Math.max.apply(null, post_engaged_users)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, post_engaged_users)/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Engaged Users',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx3,{
								type:'line',
								data :chartdata3,
								options:chartOptions3

							});
							var chartOptions4 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, reach)+ Math.max.apply(null, reach)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, reach)/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Reach',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx4,{
								type:'line',
								data :chartdata4,
								options:chartOptions4

							});
							var chartOptions5 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min :0,
											max :Math.max(Math.max.apply(null, anger),Math.max.apply(null, love),Math.max.apply(null, wow),Math.max.apply(null, haha),Math.max.apply(null, sorry))+ Math.max(Math.max.apply(null, anger),Math.max.apply(null, love),Math.max.apply(null, wow),Math.max.apply(null, haha),Math.max.apply(null, sorry))/3.5,
											stepSize: Math.ceil(Math.max(Math.max.apply(null, anger),Math.max.apply(null, love),Math.max.apply(null, wow),Math.max.apply(null, haha),Math.max.apply(null, sorry))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Reactions',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx5,{
								type:'line',
								data :chartdata5,
								options:chartOptions5

							});
							var chartOptions6 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",

											fontStyle: 'bold',
											fontSize: 15,

											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min : 0,
											max :Math.ceil(Math.max(Math.max.apply(null, like),Math.max.apply(null, share),Math.max.apply(null, comment))+ Math.max(Math.max.apply(null, like),Math.max.apply(null, share),Math.max.apply(null, comment))/3.5),
											stepSize: Math.ceil(Math.max(Math.max.apply(null, like),Math.max.apply(null, share),Math.max.apply(null, comment))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Likes ,Shares ,Comments',
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx6,{
								type:'line',
								data :chartdata6,
								options:chartOptions6

							});

							}else{

							$("#fb").hide();
						}

						}else{
						$('#fb').hide();

					}
					},error:function(data){
					console.log(data);
				}
			})
		});

	}

	</script>
<?php } ?>
<?php if($twitter==true){ ?>
	<script>
		twitter_hit();
		function twitter_hit(range){
			var url_tw=siteurl+"brand/dashboard_twitter";
		$(document).ready(function(){
			$.ajax({
				url:url_tw,
				type:"POST",
				data:daa,
				success:function(data){

					if(data!='')
					{
						if(data.error != 'NOT FOUND'){

							var favorites = [];
							var retweets = [];
							var timestamp = [];
							var replies = [];

							for (var i in data){

								favorites.push(data[i].data.favorites);
								retweets.push(data[i].data.retweets);
								replies.push(data[i].data.replies);
								dateString=new Date(toDateTime(data[i].timestamp)).toUTCString();
								dateString=dateString.split(' ').slice(1, 3).join(' ');
								dateString = '';
								timestamp.push(dateString);
							}

							var chartdata = {
								labels : timestamp,
								datasets : [
								{
									label : 'Favorites',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#1DA1F2",

									data :favorites

								},


								]
							}

							var ctx = $('#mytwitter');
							var ctx2 = $('#mytwitter2');
							var ctx3 = $('#mytwitter3');
							var chartOptions = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, favorites)+ Math.max.apply(null, favorites)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, favorites)/6)

										},
										scaleLabel: {
											display: true,
											labelString: 'Favorites',
											fontColor: "#4267B2",
											fontSize: 15,
											fontStyle: 'bold',
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"


										}
									}]
								}
							};


							var LineGraph = new Chart(ctx,{
								type:'line',
								data :chartdata,
								options:chartOptions

							});

							var chartdata2 = {
								labels : timestamp,
								datasets : [
								{
									label :'Retweets',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#FF6384",
									data :retweets

								},


								]
							}


							var chartOptions2 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, retweets)+ Math.max.apply(null, retweets)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, retweets)/6)
										},
										scaleLabel: {
											display: true,
											labelString: 'Retweets',
											fontColor: "#4267B2",
											fontSize: 15,
											fontStyle: 'bold',
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"


										}
									}]
								}
							};


							var LineGraph = new Chart(ctx2,{
								type:'line',
								data :chartdata2,
								options:chartOptions2

							});
							var chartdata3 = {
								labels : timestamp,
								datasets : [
								{
									label : 'Replies',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#42B72A",
									data :replies

								},

								]
							}


							var chartOptions3 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.ceil(Math.max.apply(null, replies)+ Math.max.apply(null, replies)/3.5),
											stepSize:  Math.ceil(Math.max.apply(null, replies)/6)
										},
										scaleLabel: {
											display: true,
											labelString: 'Replies',
											fontColor: "#4267B2",
											fontSize: 15,
											fontStyle: 'bold',
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"


										}
									}]
								}
							};


							var LineGraph = new Chart(ctx3,{
								type:'line',
								data :chartdata3,
								options:chartOptions3

							});
							}else{

							$("#tw").hide();
						}

						}else{

						$('#tw').hide();
					}
					},error:function(data){
					console.log(data);
				}
			})
		});


			}

	</script>
<?php } ?>
<?php if($insta==true){ ?>
	<script>
		instagram_hit();
		function instagram_hit(range){
		var url_ins=siteurl+"brand/dashboard_insta";
		$(document).ready(function(){
			$.ajax({
				url:url_ins,
				type:"POST",
				data:daa,
				success:function(data){
				
					if(data!='')
					{
						if(data.error != 'NOT FOUND'){

							var like = [];
							var comment = [];
							var reach = [];
							var engagement = [];
							var impression = [];
							var timestamp = [];

							for (var i in data){

								like.push(data[i].data.like_count);
								comment.push(data[i].data.comments_count);
								reach.push(data[i].data.reach);
								engagement.push(data[i].data.engagement);
								impression.push(data[i].data.impressions);

								dateString=new Date(toDateTime(data[i].timestamp)).toUTCString();
								dateString=dateString.split(' ').slice(1, 3).join(' ');
								dateString = '';
								timestamp.push(dateString);
							}

							var chartdata = {
								labels : timestamp,
								datasets : [
								{
									label :'Likes',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#ff7582",
									data :like

									},{
									label :'Comments',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#42B72A",
									data :comment

								},


								]
							}

							var ctx = $('#myinsta');
							var ctx2 = $('#myinsta2');
							var ctx3 = $('#myinsta3');
							var chartOptions = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#E54655",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max :Math.ceil(Math.max(Math.max.apply(null, like),Math.max.apply(null, comment))+ Math.max(Math.max.apply(null, like),Math.max.apply(null, comment))/3.5),
											stepSize:  Math.ceil(Math.max(Math.max.apply(null, like),Math.max.apply(null, comment))/7)
										},
										scaleLabel: {
											display: true,
											labelString:'Likes',
											fontColor: "#E54655",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx,{
								type:'line',
								data :chartdata,
								options:chartOptions

							});
							var chartdata2 = {
								labels : timestamp,
								datasets : [
								{
									label : 'Reach',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#ff7582",
									data :reach

								},


								]
							}




							var chartOptions2 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#E54655",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.max.apply(null, reach)+ Math.max.apply(null, reach)/3.5,
											stepSize:  Math.floor(Math.max.apply(null, reach)/6)
										},
										scaleLabel: {
											display: true,
											labelString: 'Reach',
											fontColor: "#E54655",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx2,{
								type:'line',
								data :chartdata2,
								options:chartOptions2

							});
							var chartdata3 = {
								labels : timestamp,
								datasets : [
								{
									label : 'Impression',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#ff7582",
									data :impression

								},
								{
									label : 'Engagement',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6D9CF9",
									data :engagement

								},


								]
							}




							var chartOptions3 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#E54655",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.max.apply(null, reach)+ Math.max.apply(null, reach)/3.5,
											stepSize:  Math.floor(Math.max.apply(null, reach)/6)
										},
										scaleLabel: {
											display: true,
											labelString: 'Engagement + Impressions',
											fontColor: "#E54655",
											fontStyle: 'bold',
											fontSize:15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx3,{
								type:'line',
								data :chartdata3,
								options:chartOptions3

							});






						}
						else{
							$('#ins').hide();
						}
						}else{

						$('#ins').hide();
					}
					},error:function(data){
					console.log(data);
				}
			})
		});
		}
	</script>
<?php } ?>

<?php if($youtube==true){ ?>
	<script>
		youtube_hit();
		function youtube_hit(){
		var url_you=siteurl+"brand/dashboard_youtube";

		$(document).ready(function(){
			$.ajax({
				url:url_you,
				type:"POST",
				data:daa,
				success:function(data){
					console.log(data);
					if(data!='')
					{
						if(data.error != 'NOT FOUND'){
							var averageViewDuration = [];
							var views = [];
							var likes = [];
							var dislikes = [];
							var comments = [];

							var shares = [];


							var timestamp = [];

							for (var i in data){

								averageViewDuration.push(data[i].data.averageViewDuration);
								views.push(data[i].data.views);
								likes.push(data[i].data.likes);
								dislikes.push(data[i].data.dislikes);
								comments.push(data[i].data.comments);
								shares.push(data[i].data.shares);
								dateString=new Date(toDateTime(data[i].timestamp)).toUTCString();
								dateString=dateString.split(' ').slice(1, 3).join(' ');
								dateString = '';
								timestamp.push(dateString);
							}
							var chartdata = {
								labels : timestamp,
								datasets : [
								{
									label :'Average View Duration',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6D9CF9",
									data :averageViewDuration

								},


								]
							}
							var chartdata2 = {
								labels : timestamp,
								datasets : [
								{
									label : 'Views',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6D9CF9",
									data :views

								},


								]
							}
							var chartdata3 = {
								labels : timestamp,
								datasets : [
								{
									label : 'Likes',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#6D9CF9",
									data :comments

								},
								{
									label : 'Disikes',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#ff5656",
									data :dislikes

								},
								{
									label : 'Shares',
									fill :true,
									lineTension :0.1,
									backgroundColor:"#42B72A",
									data :shares

								},

								]
							}

							var ctx = $('#myyou');
							var ctx2 = $('#myyou2');
							var ctx3 = $('#myyou3');
							var chartOptions = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.max.apply(null, averageViewDuration)+ Math.max.apply(null, averageViewDuration)/3.5,
											stepSize:  Math.ceil(Math.max.apply(null, averageViewDuration)/6)
										},
										scaleLabel: {
											display: true,
											labelString:'Average View Duration',
											fontColor: "#4267B2",
											fontSize: 15,
											fontStyle: 'bold',
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};
							var chartOptions2 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max : Math.max.apply(null, views)+ Math.max.apply(null, views)/3.5,
											stepSize:  Math.ceil(Math.max.apply(null, views)/6)
										},
										scaleLabel: {
											display: true,
											labelString: 'Views',
											fontColor: "#4267B2",
											fontSize: 15,
											fontStyle: 'bold',
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};
							var chartOptions3 = {

								scales: {
									xAxes: [{

										scaleLabel: {
											display: true,
											labelString: "Time Stamp",
											fontColor: "#4267B2",
											fontStyle: 'bold',
											fontSize: 15,
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
										}

									}],
									yAxes: [{
										ticks: {
											min: 0,
											max :Math.ceil(Math.max(Math.max.apply(null, likes),Math.max.apply(null, dislikes),Math.max(Math.max.apply(null, shares)))+ Math.max(Math.max.apply(null, likes),Math.max.apply(null, dislikes),Math.max(Math.max.apply(null, shares)))/3.5),
											stepSize:  Math.ceil(Math.max(Math.max.apply(null, likes),Math.max.apply(null, dislikes),Math.max(Math.max.apply(null, shares)))/7)
										},
										scaleLabel: {
											display: true,
											labelString: 'Likes + Dislikes + Shares',
											fontColor: "#4267B2",
											fontSize: 15,
											fontStyle: 'bold',
											fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

										}
									}]
								}
							};

							var LineGraph = new Chart(ctx,{
								type:'line',
								data :chartdata,
								options:chartOptions

							});
							var LineGraph = new Chart(ctx2,{
								type:'line',
								data :chartdata2,
								options:chartOptions2

							});
							var LineGraph = new Chart(ctx3,{
								type:'line',
								data :chartdata3,
								options:chartOptions3

							});
							}else{

							$("#you").hide();
						}

						}else{

						//campaigns').html();

						$('#you').hide();
					}
					},error:function(data){
					console.log(data);
				}
			})
		});
		}
	</script>

<?php } ?>
<?php if($click_check == true){

	for($i=0;$i<sizeof($click_check);$i++){

	?>

	<script>

		var url_click=siteurl+"brand/click_dash";
		var html = "";

		$(document).ready(function(){
			$.ajax({
				url:url_click,
				type:"POST",
				data:{camp : <?php echo $click_check[$i]['camp_id']; ?>},
				success:function(data){

					if(data!='')
					{

						if(data.error != 'NOT FOUND'){


							region = [];
							clicks = [];
							colors = ['#49A9EA','#26B99A','#E74C3C','#9CC2CB','#9B59B6','#FFA500','#8FC050','#637B85','#55ACEE','#5F5F5F','#ff6666','#99ff99','#996633']
							for (var i in data){
								if(data[i].region!='Unknown'){
									region.push(data[i].region+'('+data[i].country.toUpperCase()+')');
									}else{
									region.push('Others');
								}
								clicks.push(data[i].clicks);
							}html += '  <table class="tile_info" >';
							html += '    <thead><th>City(Country Code)</th><th>Count</th></thead><br><br>';
							for(var i = 0; i < data.length; i++) {

								if(data[i].region!='Unknown'){
									html += '<br><tr><td><p><i class="fa fa-square" style="color:'+colors[i]+';"></i>'+data[i].region+' ('+data[i].country+')'+' </p></td><td>'+data[i].clicks+'</td></tr>';
									}else{
									html += '<tr><td><p><i class="fa fa-square" style="color:'+colors[i]+';"></i>Others </p></td><td>'+data[i].clicks+'</td></tr>';
								}
							}
							html += '</table>';
							$('#main-msg').html("");
							$('#main-msg').append(html);



							var canvas = document.getElementById("barChart<?php echo $i;?>");
							var ctx = canvas.getContext('2d');

							// Global Options:
							Chart.defaults.global.defaultFontColor = 'black';
							Chart.defaults.global.defaultFontSize = 16;


							var data = {
								labels: region,
								datasets: [
								{
									data: clicks,
									backgroundColor: colors,
									fill: true,
									label: 'My dataset',



								}
								],

							};

							// Notice the rotation from the documentation.

							var options = {
								title: {
									display: true,
									text: 'Clicks Stats For Your Click Campaign',
									position: 'top',
									fontStyle: 'bold',
									fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"

								},
								rotation: -0.7 * Math.PI
							};


							// Chart declaration:
							var myBarChart = new Chart(ctx, {
								type: 'pie',
								data: data,
								options: options
							});
							}else{
							any = any +1;
							if(any==<?php echo sizeof($click_check)?>){

								$('#click_check').hide();
							};

							$("#barChart<?php echo $i;?>").hide();
						}

						}else{

						//campaigns').html();
						any = any +1;
						if(any==<?php echo sizeof($click_check)?>){

								$('#click_check').hide();
							};
						$('#barChart<?php echo $i;?>').hide();
					}
					},error:function(data){
					console.log(data);
				}
			})

		});



		// Fun Fact: I've lost exactly 3 of my favorite T-shirts and 2 hoodies this way :|
	</script>
<?php } ?>


<?php } ?>
