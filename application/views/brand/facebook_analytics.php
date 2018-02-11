<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style type="text/css">
#container, #sliders {
	min-width: 310px;
	max-width: 800px;
	margin: 0 auto;
}
#container {
	height: 400px;
}
</style>
<script type="text/javascript">
var CLICKS = -1;
</script>
<?php
if(isset($info)) {
	if(isset($info['clicks'])) {
		print("<script>
		CLICKS = {$info['clicks']};
		</script>");
	}
	$cat_main = $this->uri->segment(1);
	print("<script>
	var camp_type = '{$info['camp_type']}';
	var number_of = {$info['number_of']};
	var camp_id = {$info['camp_id']};
	var cat_main = '{$cat_main}';
	</script>");
}
?>
<script  type="text/javascript">
window.fbAsyncInit = function() {


	// FB JavaScript SDK configuration and setup
	FB.init({
		appId      : '<?php echo FB_APP_ID; ?>', // FB App ID
		cookie     : true,  // enable cookies to allow the server to access the session
		xfbml      : true,  // parse social plugins on this page
		version    : '<?php echo FB_API_VERSION; ?>' // use graph api version 2.8
	});

	FB.api(
		'/oauth/access_token',
		'GET',
		{client_id: '460531114323275', client_secret: 'deb28650d50c3f7527b3be37c3399b54', grant_type: 'client_credentials'},//,insights.metric(post_impressions,post_consumptions_unique)
		function(resp) {
			console.log(resp);
		}
	);

	// Check whether the user already logged in
	var post_id='/'+"<?php echo $_SESSION['analytics_data'][0]['post_id']?>";
	console.log(post_id);
	FB.api(
		post_id,
		'GET',
		{access_token:'OpQ6ooOHJm_-YvfibAhy9d_EVk0',"fields":"reactions,likes,comments"},//,insights.metric(post_impressions,post_consumptions_unique)
		function(response) {
			var splitt = post_id.split('_');
			console.log(splitt);
			FB.api(
				post_id+"/insights/post_impressions",
				'GET',
				{access_token:'<?php echo FB_ACCESS_TOKEN; ?>'},//,insights.metric(post_impressions,post_consumptions_unique)
				function (ddd) {
					console.log(ddd);

				}
			);

			if(response.error) {
				swal("Error!", response.error.message, "error");
			}
			var len = 0;
			if(response.insights) {
				var insights_data=response.insights.data;
				len=insights_data.length+3;
			}
			else {
				len = 3
			}

			var flag=0;
			var likes_data=response;
			if(likes_data.likes==null)
			number_likes=0;
			else
			number_likes=likes_data.likes.data.length;
			if(likes_data.comments==null)
			number_comments=0;
			else
			number_comments=likes_data.comments.data.length;
			if(likes_data.reactions==null)
			number_reactions=0;
			else
			number_reactions=likes_data.reactions.data.length;
			if(CLICKS == -1) {
				var name=['Likes','Comments','Reactions'];
				var data1=[number_likes,number_comments,number_reactions];
			}
			else {
				var name=['Clicks', 'Likes','Comments','Reactions'];
				var data1=[CLICKS, number_likes,number_comments,number_reactions];
			}
			var current = 0;
			if(camp_type == 'Click')
			current = CLICKS;
			else if(camp_type == 'Like')
			current = number_reactions;
			else if(camp_type == 'Comment')
			current = number_comments;
			p = current*100/number_of;
			if(p > 100)
				p = 100;

			var url=SITEURL+cat_main+'/facebook_analytics_percentage';
			$.ajax({
				url: url,
				type: "POST",
				data: {'camp_id':camp_id, 'p': p},
				success: function(data) {
				}
			});

			for(i=3;i<len;i++)
			{
				name[i]=insights_data[flag++].name;
				data1[i]=insights_data[0].values[0].value;
			}
			//  console.log(name);
			//  console.log(data1);
			var chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					type: 'column',
					options3d: {
						enabled: true,
						alpha: 0,
						beta: 0,
						depth: 20,
						viewDistance: 25
					}
				},
				credits: {
					enabled: false
				},
				title: {
					text: 'Campaigns- Facebook Analytics'
				},
				plotOptions: {
					column: {
						depth: 25
					},
					series: {
						cursor: 'pointer',
						point: {
							events: {
								click: function(event) {

								}
							}
						}
					}
				},
				yAxis: {
					title: {
						text: ""
					}
				},
				xAxis: {
					categories: name
				},
				series: [{
					name: "Facebook Analytics",
					data: data1
				}
			]
		});

	});
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php
			$link = $_SESSION['analytics_data'][0]['camp_link'];
			$link = explode("_", $link);
			$cat = $this->uri->segment(1);
			if($cat == 'brand')
			$cat = 1;
			else
			$cat = 0;
			?>
			<pre><span class="fa fa-facebook"></span><h3 class="text-center text-success">Facebook Analytics</h3><h5 class="text-center"><button onclick="view_analytics(<?php echo $this->input->post('camp_id'); ?>, <?php echo $cat; ?>);" type="button">Refresh</button></h5>
				<br><h4 class='text-center'><iframe src="https://www.facebook.com/plugins/post.php?href=<?php echo $link[0].'/posts/'.$link[1].'/'; ?>" width="500" height="321" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></h4></pre>
				<div class='col-md-offset-2 col-sm-offset-2 col-md-8 col-sm-8 col-xs-12'><div id='graph'></div></div>
				<div id="container" style="height: 400px"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
