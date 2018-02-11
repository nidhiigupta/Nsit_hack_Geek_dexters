<style>

.hover:hover {
	color:white;
	background-color:#9b45b4;
}
.container {
	position: relative;
	perspective: 1000;
}
.ttle{
	z-index:999;
}
.card {
	position: relative;
	transform-style: preserve-3d;
	transition: 0.5s;
	margin: 40px auto;
	height:200px;
}
.container:hover .card {
	transform: rotateY(180deg);
}
.face {
	position: absolute;
	backface-visibility: hidden;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	color: white;
	line-height: 30px;
	text-align: center;
}
.front {
	z-index: 10;
}
.container:hover .front {
	z-index: 0;
}
.back {
	color:black;
	transform: rotateY(180deg);
}
@media screen and (max-width: 480px) {
	.container {
		position: absolute;
		perspective: 1000;
		width:100px;
		height:170px;
	}
	.ttle{
		display:none;
	}
	.allteam{
		padding-bottom:30px;
	}
	.face {
		position: absolute;
		backface-visibility: hidden;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		color: black;
		line-height: 14px;
		text-align: center;
	}
}
</style>
<section class="banner_start">
	<article>
		<div id="slider">
			<ul class="slides">
				<li class="slide slide1 section">
					<h2>Be safe from upcoming diseases in your area.</h2>
				</li>
				<li class="slide slide2 section">
					<h2>Harness the power of technology towards better health.
					</h2>
				</li>
			</ul>
		</div>
		<p>
			<a href="<?php echo SITEURL.'home/influencer'; ?>" class="hover">Patient</a>
			<a href="<?php echo SITEURL.'home/brand'; ?>" class="hover">Doctor</a>
		</p>
	</article>
	<div class="scroll_button" style="padding-top:60px;">
		<i class="fa fa-angle-double-down" aria-hidden="true"></i>
	</div>
</section>
<section class="offer_start" style="padding-top:100px;">

	<div class="content_wrapper_shortcode white brandsection">
		<div class="section_heading">
			<h3>Doctors</h3>
			<img class="videobtn" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/play-button.svg" width="50px" height="50px">
		</div>
		<p></p>
		<div class="btnalign">
			<a class="custom_submit brsection brandbtn" href="<?php echo SITEURL.'home/brand'; ?>">Get Started</a>

		</div>
	</div>
	<div class="content_wrapper_shortcode white influencersection orbtn">
		<div class="section_heading">
			<h3>Patients</h3>
			<img class="videobtn" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/play-button.svg" width="50px" height="50px">
		</div>
		<p></p>
		<div class="btnalign">
			<a class="custom_submit brsection influencerbtn" href="<?php echo SITEURL.'home/influencer'; ?>">Get Started</a>

		</div>
	</div>
</section>
<section class="team_start" >
	<article class="" >
		<h2>OUR TEAM</h2>
		<div class="div_col4 start_point_list kategoria padding_mod allteam">
			<div class="container" >
				<div class="card">
					<div class="face front icon">
						<div class="icon_wrapper">
							<!-- <img class="color " src="wp-content/themes/netfox/images/Saurabh.jpg"> -->
							<img class="static" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/Saurabh.png"><img class="active" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/Saurabh.png">
						</div>

					</div>

					<div class="description face back">

						<p>Determined and Passionate, Headstrong and Creative, Entertaining and Considerate; I'm the person who never backs down from a commitment. My passion for this is legen-wait-for-it-dary. I'm the CEO and I love it 😁</p>
					</div>
				</div>
				<div class="ttle"><h3>Sarthak Saxena</h3></div>
			</div>
			<div class="container " >
				<div class="card">
					<div class="face front icon">
						<div class="icon_wrapper">
							<!-- <img class="color " src="wp-content/themes/netfox/images/Saurabh.jpg"> -->
							<img class="static" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/sooraj.png"><img class="active" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/sooraj.png">
						</div>

					</div>

					<div class="description face back">
						<p>The CTO here, I'm the Tech enthusiast who lives and breathes technology. A thorough problem solver, I'll solve any and every problem thrown at me.</p>
					</div>
				</div>
				<div class="ttle"><h3><center>Deepshikhar Bhardwaj</center></h3></div>
			</div>
			<div class="container" >
				<div class="card">
					<div class="face front icon">
						<div class="icon_wrapper">
							<!-- <img class="color " src="wp-content/themes/netfox/images/Saurabh.jpg"> -->
							<img class="static" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/Neha.png"><img class="active" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/Neha.png">
						</div>

					</div>

					<div class="description face back">
						<p >I'm the business head and my mantra is very simple - there's no substitute for hard work. I'm one person who enjoys taking on responsibility and I can always be counted on. </p>
					</div>
				</div>
				<div class="ttle"><h3>Aarohi Aggarwal</h3></div>
			</div>
			<div class="container" >
				<div class="card">
					<div class="face front icon">
						<div class="icon_wrapper">
							<!-- <img class="color " src="wp-content/themes/netfox/images/Saurabh.jpg"> -->
							<img class="static" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/sahil.png"><img class="active" src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/sahil.png">
						</div>
					</div>

					<div class="description face back">
						<p>I'm the one who fixes problems even before they appear. I'm called the Legal Advisor and I'm the expert that makes all the difference.</p>

					</div>
				</div>
				<div class="ttle"><h3>Shivam Phutela</h3></div>
			</div>

		</div>

	</article>
</section>
