<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

function display_graph(v, l, c) {
	var name=['Views', 'Likes', 'Comments'];
	//  console.log(insights_data[0].values[0].value);
	var data1=[v, l, c];
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
			text: 'Campaigns- YouTube Analytics'
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
			name: "YouTube Analytics",
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
					$link = $info['link'];
					$l = $info['l'];
					$v = $info['v'];
					$c = $info['c'];
					if($cat == 'brand')
					$cat = 1;
					else
					$cat = 0;

					print('<pre><span class="fa fa-youtube"></span><h3 class="text-center text-success">YouTube Analytics</h3><h5 class="text-center">');
					?>
					<button onclick="view_analytics(<?php echo $this->input->post('camp_id'); ?>, <?php echo $cat; ?>);" type="button">Refresh</button>
					<?php print('</h5>');
					print("<br><h4 class='text-center'><iframe width='560' height='315' src='https://www.youtube.com/embed/{$link}' frameborder='0' allowfullscreen></iframe></h4></pre>");
						print("<div class='col-md-offset-2 col-sm-offset-2 col-md-8 col-sm-8 col-xs-12'><div id='graph'></div></div>");
						print("<script type='text/javascript'>display_graph({$v}, {$l}, {$c});</script>");
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
