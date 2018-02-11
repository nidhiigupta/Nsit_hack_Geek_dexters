<?php
  $likes = $info['likes'];
  $comments = $info['comments'];
  $link = $info['link'];
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

function display_graph(l, c, clicks) {
  if(clicks == -1) {
    var name=['Likes', 'Comments'];
  	var data1=[l, c];
  }
  else {
    var name=['Clicks', 'Likes', 'Comments'];
  	var data1=[clicks, l, c];
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
			text: 'Campaigns- Instagram Analytics'
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
			name: "Instagram Analytics",
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
					$l = $info['likes'];
					$c = $info['comments'];

          $cat = $this->uri->segment(1);
  				if($cat == 'brand')
  					$cat = 1;
  				else
  					$cat = 0;
					print('<pre><span class="fa fa-instagram"></span><h3 class="text-center text-success">Instagram Analytics</h3><h5 class="text-center">');
          ?>
          <button onclick="view_analytics(<?php echo $this->input->post('camp_id'); ?>, <?php echo $cat; ?>);" type="button">Refresh</button></h5>
          <?php
					print("<br><h4 class='text-center' style='margin-left: 35%; display: inline-block'>");
          print('<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50.0% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="');
          print($link);
          print('" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank"></a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"></p></div></blockquote> <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>');
          print("</h4></pre>");
					print("<div class='col-md-offset-2 col-sm-offset-2 col-md-8 col-sm-8 col-xs-12'><div id='graph'></div></div>");
          if(isset($info['clicks']))
            print("<script type='text/javascript'>display_graph({$l}, {$c}, {$info['clicks']});</script>");
          else
            print("<script type='text/javascript'>display_graph({$l}, {$c}, -1);</script>");
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
