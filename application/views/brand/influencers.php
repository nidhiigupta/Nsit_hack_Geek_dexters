<style>
.shadow {
	-webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
	-moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
	box-shadow:         3px 3px 5px 6px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
}
.avatar, .avatar img {
	border-radius: 500px;
}


.thumb-xxxs {
	width: 20px;
}
.text-md {
	font-size: 18px;
}
.text-md2 {
	font-size: 11px;
	color:#64D3F1;
}
.font-bold {
	font-weight: 600;

}
.md-truncate {
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
}
.i-checks input[type=radio]+i, .i-checks input[type=radio]+i:before, .i-switch i:after {
	border-radius: 50%;
}

.i-checks>i {
	width: 20px;
	height: 20px;
	line-height: 1;
	border: 1px solid #e5e5e5;
	background-color: #fff;
	margin-top: -2px;
	display: inline-block;
	vertical-align: middle;
	margin-right: 4px;
	position: relative;
}

.i-checks input, .i-checks>i, .i-checks>span {
	margin-left: -20px;
}

*, :after, :before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
user agent stylesheet
i, cite, em, var, address, dfn {
	font-style: italic;
}

.checkbox label, .radio label {
	min-height: 20px;
	padding-left: 20px;
	margin-bottom: 0;
	font-weight: 400;
	cursor: pointer;
}

.i-checks, .i-switch, .send-proposal-cancel, a {
	cursor: pointer;
}

label {
	font-weight: 400;
}
.i-checks input:checked+i {
	border-color: #4F5D73;

}
.i-checks input:checked+i:before {
	left: 4px;
	top: 4px;
	width: 10px;
	height: 10px;
	background-color: #4F5D73;
}


.i-checks>i:before {
	content: "";
	position: absolute;
	left: 50%;
	top: 50%;
	width: 0;
	height: 0;
	background-color: transparent;
	-webkit-transition: all .2s;
	transition: all .2s;
}
.i-checks>i {
	width: 20px;
	height: 20px;
	line-height: 1;
	border: 1px solid #e5e5e5;
	background-color: #fff;

	margin-top: -2px;
	display: inline-block;
	vertical-align: middle;
	margin-right: 4px;
	position: relative;
}

.i-checks input, .i-checks>i, .i-checks>span {
	margin-left: -20px;
}

*, :after, :before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
user agent stylesheet
i, cite, em, var, address, dfn {
	font-style: italic;
}

.checkbox label, .radio label {
	min-height: 20px;
	padding-left: 20px;
	margin-bottom: 0;
	font-weight: 400;
	cursor: pointer;
}
dt, kbd kbd, label {
	font-weight: 700;
}

label {
	cursor: default;
}
</style>

<!-- Article Block -->
<div id="page-content">
	<div class="block block-alt-noborder">
		<b><h3>Here are our Influencers. Create a <a href="<?php echo SITEURL ?>brand/start_campaign">Campaign</a> to start .</h3></b>
		<div class="row">
			<div class="influencers col-md-9" >
			</div>
			<div class="col-md-3">
				<div class="side-panel" id="side-scroll-container" >
					<button class="btn btn-default btn-sm pull-right m-t" onclick="refresh()"  title="Clear Filters">
						<i class="fa fa-undo"></i>
					</button>
					<div class="m-t">
						<div class="panel-body">
							<label class="font-bold text-u-c">
								<b><h3>Filters</h3></b>
							</label>
							<br>
							<form name="categories" id="myform">
								<div class="radio">
									<label class="i-checks">
										<b>Channel Category</b>
									</label>
									<br>
									<div class="checkbox" >
										<label class="i-checks">
											<input type="checkbox" name="Crypto Currencies" value="1" aria-invalid="false" > <i></i> Crypto Currencies
										</label>
									</div>
									<div class="checkbox" ><label class="i-checks"><input type="checkbox" name="Entertainment " value="2" aria-invalid="false"> <i></i> Entertainment </label></div>
									<div class="checkbox" ><label class="i-checks"><input type="checkbox" name="Fashion" value="3"  aria-invalid="false"> <i></i> Fashion</label></div>
									<div class="checkbox" ><label class="i-checks"><input type="checkbox"  name="Finance" value="4"  aria-invalid="false"> <i></i> Finance</label></div>
									<div class="checkbox"><label class="i-checks"><input type="checkbox"  name="Food and Beverage" value="5"  aria-invalid="false"> <i></i> Food and Beverage</label></div>
									<div class="checkbox"  ><label class="i-checks"><input type="checkbox"  name="Gaming" value="6"  aria-invalid="false"> <i></i>Gaming</label></div>
									<div class="checkbox"  ><label class="i-checks"><input type="checkbox"  name="News" value="6"  aria-invalid="false"> <i></i>News</label></div>

									<div class="checkbox"  ><label class="i-checks"><input type="checkbox" name="Parenting" value="6"  aria-invalid="false"> <i></i> Parenting</label></div>
									<div class="checkbox" ><label class="i-checks"><input type="checkbox"  name="Tech" value="6"  aria-invalid="false"> <i></i>Tech </label>
									</div>
								</div>
							</form>
							<br><br>
							<form id="myform2">
								<div class="radio">
									<label class="i-checks">
										<b>Sort By</b>
									</label>
									<br>
									<div class="radio">
										<label class="i-checks"><input type="radio" name="318" id="fbradio" aria-invalid="false"> <i></i>
											Number Of Facebook Followers
										</label>
									</div>
									<div class="radio">
										<label class="i-checks"><input type="radio" name="318" id="twradio" aria-invalid="false"> <i></i>
											Number Of Twitter Followers
										</label>
									</div>
									<div class="radio">
										<label class="i-checks"><input type="radio"  name="318" id="insradio" aria-invalid="false"> <i></i>
											Number Of Instagram Followers
										</label>
									</div>
									<div class="radio">
										<label class="i-checks"><input type="radio"  name="318" id="youradio" aria-invalid="false"> <i></i>
											Number Of Youtube Followers
										</label>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var siteurl="<?php echo SITEURL?>";
var assets="<?php echo ASSETS?>";

window.onload=sort_inf('ALL');
var data2 = '';
function sort_inf(name){

	var url=siteurl+"brand/influencer_ajax";
	var html = "";
	send = {hell:name};

	$.post(url,send,function(data){


		if(data!=false){
			//console.log(data);
			//$('.influencers').html('<h3 class="text-center text-success">The influencer(s) whose Category is <i class="text-danger">'+val+'</i></h3>');
			data2 =data;

			for (var i = 0; i < data.length; i++) {
				if(!data[i].fb_followers)
				data[i].fb_followers = '-';
				if(!data[i].ins_followers)
				data[i].ins_followers = '-';
				if(!data[i].tw_followers)
				data[i].tw_followers = '-';
				if(!data[i].yt_followers)
				data[i].yt_followers = '-';
			}


			$('.influencers').html('');
			for (var s = 0; s < data.length; s++) {
				html += '<div class="col-md-4">';
				html += '  <div class="widget">';
				html += '    <div class="widget-advanced shadow">';
				html += '   <center>  <div class="widget-header2 text-center " >';
				html += '        <center><a href="javascript:void(0);">';
				html += '          <img width="232" height="232"  src="'+data[s].image+'" alt="avatar" class="animation-bigEntrance">';
				html += '        </a></center>';
				html += '</div></center><div>';
				html += '       <center> <h4 class="widget-content-light">';
				html += '          <a target="_blank" href="'+SITEURL+'view_profile/influencer?id='+data[s].id+'" class="text-md font-bold md-truncate">'+data[s].name+'</a><br>';
				html += '        </h4>';
				html += '       Category - <span class=" md-truncate">'+data[s].industry+'</span></center>';
				html += '      </div>';

				html += '      <div class="widget-main">';
				html += '        <div class="list-group remove-margin">';
				html += '          <a href="javascript:void(0)" class="list-group-item">';
				html += '            <span class="pull-right"><strong>'+data[s].fb_followers+'</strong></span>';
				html += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/facebook_thumbnail.png"> &nbsp;  Page Likes</h5>';
				html += '          </a>';
				html += '          <a href="javascript:void(0)" class="list-group-item">';
				html += '            <span class="pull-right"><strong>'+data[s].tw_followers+'</strong></span>';
				html += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/twitter_thumbnail.png">&nbsp;   Followers</h5>';
				html += '            <p class="list-group-item-text"></p>';
				html += '          </a>';
				html += '          <a href="javascript:void(0)" class="list-group-item">';
				html += '            <span class="pull-right"><strong>'+data[s].ins_followers+'</strong></span>';
				html += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/instagram_thumbnail.png"> &nbsp;  Followers</h5>';
				html += '            <p class="list-group-item-text"></p>';
				html += '          </a>';
				html += '          <a href="javascript:void(0)" class="list-group-item">';
				html += '            <span class="pull-right"><strong>'+data[s].yt_followers+'</strong></span>';
				html += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/youtube_thumbnail.png">&nbsp;   Subscribers</h5>';
				html += '            <p class="list-group-item-text"></p>';
				html += '          </a>';
				html += '        </div>';
				html += '      </div>';
				html += '    </div>';
				html += '  </div>';
				html += '</div>';
			}

			checkboxArr = [];
			$('.influencers').append(html);
		}
		else{

			$('.influencers').html('<h3 class="text-center text-success">There are no Influencer</h3>');
		}
	});
}
function check_category(){
	var hello = "";
	var updated_data = [];
	if(checkboxArr.length==0){
		updated_data =data2;
	}else{

		var updated_data = [];

		j = 0;
		for(var k=0;k<data2.length ;k++){

			if(checkboxArr.includes(data2[k].industry)){

				updated_data[j] = data2[k];
				j++;
			};

		}

	}
	$('.influencers').html('');
	if(updated_data.length!=0){
		hello = '';
		for (var s = 0; s < updated_data.length; s++) {


			hello += '<div class="col-md-4">';
			hello += '  <div class="widget">';
			hello += '    <div class="widget-advanced shadow">';
			hello += '      <center>  <div class="widget-header2 text-center ">';
			hello += '      <a href="javascript:void(0);">';
			hello += '          <img width="232" height="232"  src="'+updated_data[s].image+'" alt="avatar" class="animation-bigEntrance">';
			hello += '        </a></div></center><div><center>';

			hello += '        <h4 class="widget-content-light">';
			hello += '          <a href="javascript:void(0);" class="text-md font-bold md-truncate">'+updated_data[s].name+'</a><br>';
			hello += '        </h4>';
			hello += '        Category - <span class="md-truncate">'+updated_data[s].industry+'</span></center>';
			hello += '      </div>';

			hello += '      <div class="widget-main">';
			hello += '        <div class="list-group remove-margin">';
			hello += '          <a href="javascript:void(0)" class="list-group-item">';
			hello += '            <span class="pull-right"><strong>'+updated_data[s].fb_followers+'</strong></span>';
			hello += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/facebook_thumbnail.png"> &nbsp;  Page Likes</h5>';
			hello += '          </a>';
			hello += '          <a href="javascript:void(0)" class="list-group-item">';
			hello += '            <span class="pull-right"><strong>'+updated_data[s].tw_followers+'</strong></span>';
			hello += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/twitter_thumbnail.png">&nbsp;   Followers</h5>';
			hello += '            <p class="list-group-item-text"></p>';
			hello += '          </a>';
			hello += '          <a href="javascript:void(0)" class="list-group-item">';
			hello += '            <span class="pull-right"><strong>'+updated_data[s].ins_followers+'</strong></span>';
			hello += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/instagram_thumbnail.png"> &nbsp;  Followers</h5>';
			hello += '            <p class="list-group-item-text"></p>';
			hello += '          </a>';
			hello += '          <a href="javascript:void(0)" class="list-group-item">';
			hello += '            <span class="pull-right"><strong>'+updated_data[s].yt_followers+'</strong></span>';
			hello += '            <h5 class="list-group-item-heading remove-margin"><img class="thumb-xxxs avatar" src="<?php echo ASSETS."proui/" ?>img/youtube_thumbnail.png">&nbsp;   Subscribers</h5>';
			hello += '            <p class="list-group-item-text"></p>';
			hello += '          </a>';
			hello += '        </div>';
			hello += '      </div>';
			hello += '    </div>';
			hello += '  </div>';
			hello += '</div>';
		}
	}
	else{
		hello += '<h2 class="text-center text-danger">No Matching Influencers</h2>';
		hello += '<h4 class="text-center">The filters that you have selected do not match any of our Influencers.<br>Try a simpler set of filters to find more matches</h4>'
		//hello +='<center><img class="thumb-xxxs avatar"  height="150" width="150" src="<?php echo ASSETS."proui/" ?>img/no_match.png"></center>'

	}
	checkboxArr = [];
	$('.influencers').append(hello);


}
var checkboxArr=[];
function check2(test,checkboxArr){
	if(checkboxArr.length==1){

		sort_inf('ALL');
	}
	else{
		if(test!=0){
			check_category();
			test =0;
		}
	}

}

var test = 0;
$('#myform :checkbox').change(function() {

	$('input[type=checkbox]').each(function(){
		if($(this). prop("checked") == true){
			test++;
			checkboxArr.push(this.name);
		}

	});
	console.log(checkboxArr);

	check2(test,checkboxArr);

});
$('#myform2 :radio').change(function() {
	$('input[type=radio]').each(function(){
		if($(this). prop("checked") == true){

			sort_inf(this.id);
		}

	});

});


function refresh(){
	window.location.reload();


}


</script>
