<link href="<?php echo ASSETS;?>css/twitter_analytics.css" rel="stylesheet">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

function display_graph(fav, ret, clicks) {
	if(clicks == -1) {
		var name=['Favorites', 'Retweets'];
		var data1=[fav, ret];
	}
	else {
		var name=['Clicks', 'Favorites', 'Retweets'];
		var data1=[clicks, fav, ret];
	}
	var chart = new Highcharts.Chart({
		chart: {
			renderTo: 'graph',
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
			text: 'Campaigns- Twitter Analytics'
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
			name: "Twitter Analytics",
			data: data1
		}
	]
});
}


</script>


<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">

			<?php
			if($info['msg']) {

				if($info['msg'] == 'error') {
					?>
					<div id="container" style="height: 100px"></div>
					<pre>
						<h3 class="text-center text-danger"><?php echo $info['error']; ?></h3>
					</pre>

					<?php
				}

				else if($info['msg'] == 'print') {
					$final = [];
					$i = 0;
					$flag = 0;
					$data = json_decode(json_encode($info['data']), true);
					$data = $data[0];
					$link = $info['link'];
					$id = $info['id'];
					$cat = $this->uri->segment(1);
					if($cat == 'brand')
					$cat = 1;
					else
					$cat = 0;

					print('<pre><span class="fa fa-twitter"></span><h3 class="text-center text-success">Twitter Analytics</h3><h5 class="text-center">');
					?>
					<button onclick="view_analytics(<?php echo $this->input->post('camp_id'); ?>, <?php echo $cat; ?>);" type="button">Refresh</button>
					<?php  print('</h5>');
					print("<br><h4 class='col-md-offset-3 col-lg-offset-3 col-sm-offset-3'><div id='tweet-container'></div></h4></pre>");
					print("<div class='col-md-offset-2 col-sm-offset-2 col-md-8 col-sm-8 col-xs-12'><div id='graph'></div></div>");
					if(isset($info['clicks'])) {
						print("<script type='text/javascript'>display_graph({$data['favorite_count']}, {$data['retweet_count']}, {$info['clicks']});</script>");
					}
					else
					print("<script type='text/javascript'>display_graph({$data['favorite_count']}, {$data['retweet_count']}, -1);</script>");
				}
				else {
					print('<div id="container" style="height: 100px"></div>');
					print('<pre><h3 class="text-center text-success">Invalid Link.</h3></pre>');
				}
			}
			else {
				print("Error!");
			}
			?>

		</div>
	</div>
</div>
<script src="<?php echo ASSETS;?>vendors/jquery/dist/jquery.min.js"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script type="text/javascript">
$(function() {
	twttr.widgets.createTweet(
		'<?php echo $id; ?>',
		document.getElementById("tweet-container"),
		{
			linkColor: "#55acee"
		}
	);
})

</script>
