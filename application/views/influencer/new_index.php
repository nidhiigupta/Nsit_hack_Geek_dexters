<link rel="shortcut icon" href="<?php echo SITEURL ?>img/favicon.png">
<link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
<link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
<link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
<link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
<link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
<link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
<link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
<link rel="apple-touch-icon" href="img/icon180.png" sizes="180x180">

<div id="page-content">
	<div class="content-header content-header-media">
		<div class="header-section">
			<div class="row">
				<!-- Main Title (hidden on small devices for the statistics to fit) -->
				<div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
			<?php  ?>
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
								<small><i class="fa fa-inr"></i> Earning</small>
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

	<div class="row">
		<div class="col-sm-6 col-lg-4">
			<!-- Widget -->
			<a href="<?php echo SITEURL.'influencer/campaigns/approved';?>" class="widget widget-hover-effect1">
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
		<div class="col-sm-6 col-lg-4">
			<!-- Widget -->
			<a href="<?php echo SITEURL.'influencer/campaigns/payments';?>" class="widget widget-hover-effect1">
				<div class="widget-simple">
					<div class="widget-icon pull-left themed-background-spring animation-fadeIn">
						<i class="gi gi-usd"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
						<strong><?php echo $price;?></strong><br>
						<small>Your Earning</small>
					</h3>
				</div>
			</a>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-lg-4">
			<!-- Widget -->
			<a href="<?php echo SITEURL.'influencer/chat';?>" class="widget widget-hover-effect1">
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
	<div class="block">
		<!-- Responsive Full Title -->
		<div class="block-title">
			<h1><strong>Your Camp</strong> Stats</h1>
		</div>
		<!-- END Responsive Full Title -->

		<div class="table-responsive">
			<table class="table table-vcenter table-striped">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Brand</th>
						<th class="text-center">Camp Details</th>
						<th class="text-center">Progress</th>
						<th class="text-center">Offer Status</th>
						<th class="text-center">Campaign Status</th>
						<th class="text-center">Extra</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; foreach($data as $item):  $i++; ?>
					<tr><td class="text-center" ><?php echo $i; ?></td>
						<!-- <td class="text-center" class="avatar" alt="Avatar"><img src="<?php echo ASSETS?>proui/img/placeholders/avatars/avatar14.jpg" alt="avatar" class="img-circle"></td>-->
						<td class="text-center"> <img src="<?php echo ASSETS.$item['image'];?>" width="70" height="70" class="avatar" alt="Avatar">

							<p> <b><?php echo $item['bname']; ?></b><br>
							<small>Member since: <?php echo date("d-m-Y",strtotime($item['created']));?></small></p></td>
							<td class="text-center"><strong>Name: </strong><?php echo $item['camp_name'];?><br><br><strong>Category: </strong><?php echo $item['camp_category'];?><br><br><strong>Completion Date: </strong><?php echo date("d-m-Y",strtotime($item['camp_completion_date']));?></td>
							<td class="text-center">
							<?php if(intval($item['complete'])<50){ ?>
							<div class="widget-extra-full text-center">
                                        <div class="pie-chart" data-percent="<?php echo $item['complete'] ?>" data-size="85" data-bar-color="#FB0606">
                                            <span><?php echo $item['complete']?>%</span>
                                        </div>
                                    </div>
							<?php } ?>
							<?php  if((intval($item['complete'])>=50) && intval($item['complete'])<70){ ?>
							<div class="widget-extra-full text-center">
                                        <div class="pie-chart" data-percent="<?php echo $item['complete'] ?>" data-size="85" data-bar-color="#E67E22">
                                            <span><?php echo $item['complete']?>%</span>
                                        </div>
                                    </div>
							<?php } ?>
							<?php if(intval($item['complete'])>=70){ ?>
							<div class="widget-extra-full text-center">
                                        <div class="pie-chart" data-percent="<?php echo $item['complete'] ?>" data-size="85" data-bar-color="#27AE60">
                                            <span><?php echo $item['complete']?>%</span>
                                        </div>
                                    </div>
							<?php } ?><br>
							<div id="claim">
							<?php if(intval($item['complete'])==100 || date("Y-m-d")>=date("Y-m-d",strtotime($item['camp_completion_date']))) { ?>
							<?php if($item['claim']==FALSE){ ?><button type="button" class="btn btn-success btn-xs" onclick="claim(<?php echo $item['camp']?>)"><i class="fa fa-check fa-2x text-success"></i>  Claim Reward</button><?php }else{ ?>
							<p class="text text-success"><b>Claimed</b></p><?php } ?></div>
							<?php } ?><br>
							</td>
							<?php if($item['status']=='APPROVED'){ ?>
								<th class="text-center"><button type="button" class="btn btn-success btn-xs">Approved</button></td>
								<?php }elseif($item['status']=='PENDING'){ ?>
								<th class="text-center"><button type="button" class="btn btn-warning btn-xs">Pending</button></td>
								<?php }else{ ?>
							<td class="text-center"><button type="button" class="btn btn-danger btn-xs">Rejected</button></td><?php } ?>
							<?php if($item['approval2']==1){ ?>
								<th class="text-center"><button type="button" class="btn btn-success btn-xs">Approved</button></td>
								<?php }elseif($item['approval2']=='NULL'){ ?>
								<th class="text-center"><button type="button" class="btn btn-info btn-xs">No Campaign Yet</button></td>
								<?php }elseif($item['approval2']==-1){ ?>
								<th class="text-center"><button type="button" class="btn btn-danger btn-xs">Rejected</button></td>
								<?php } else{ ?>
							<td class="text-center"><button type="button" class="btn btn-warning btn-xs">Pending</button></td><?php } ?>
							<td class="text-center"><a class='btn btn-info btn-xs' onclick='open_chat(<?php echo $item['brandid']; ?>,<?php echo $item['infid']; ?>, 0); return false;'><i class='fa fa-envelope'></i> Message <?php echo $item['bname']; ?> </a><br>

							<!--<button type="button" class="btn btn-info btn-xs" onclick="view_analytics_(); return false;"><i class="fa fa-bar-chart"></i> View Analytics</button></td>-->
					</tr>
					<?php  endforeach?>

				</tbody>
			</table>
		</div>
		<!-- END Responsive Full Content -->
	</div>



</div>
<script>
	function claim(yo){
	var siteurl="<?php echo SITEURL?>";
	var url = siteurl+"influencer/claim";
	var html='<p class="text text-success"><b>Claimed</b></p>';
	var data = { id:'<?php echo $this->influencer_model->get_id(); ?>',camp:yo};

	 $.post(url,data, function(data) {

    if(data!=false){
		 $('#claim').html("");
		 $('#claim').append(html);
		}else{
		swal('Error','TRY AGAIN!!','error')
		}
		})
		}
</script>
