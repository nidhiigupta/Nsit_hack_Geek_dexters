<div id="page-content">
  <div class="content-header">
    <div class="header-section">
      <h1>
        <i class="fa fa-inr"></i>Prediction<br><small>Your Data Our Responsibiliy &#x263A;!!</small>
      </h1>
    </div>
  </div>

  <!-- END Datatables Header -->

  <!-- Datatables Content -->
  <div class="block full">
    <div class="block-title">
      <h2><strong>Prediction</strong> List</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-5">
				<label>Prediction Basis</label></div>
				<div class="col-md-7">
				<select class="form-control" name="predict" onchange="change_img(this.value);">
					<option value="">Choose One</option>
					<option value="only_month">Month Wise Patient Crowd Over A Year</option >
					<option value="alcohol_village">Diabaties People Blood Group Wise</option >
					<option value="plot_area_age">Occurence of Diseases among various age groups in diffrent areas.</option >
					<option value="plot_month_age">Heat map of Occurence of Diseases among various age groups over a year.</option >
					<option value="plot_month_age">Area wise Occurence of Disease among different Genders.</option >
					<option value="alcohol_village">Number Of Patients consuming alcohol in Different Villages</option >
					<option value="predict">Crowd Prediction Over Months And Age.</option >
					</select>
			</div>

		</div>
    </div>
	</div>
	<div class="col-md-12" id="dis_img" >
	<center><img width="100%" height="500" id="src_chnge" src="<?php echo ASSETS;?>proui/img/no_match.png"></img></center>
	</div>
    <!-- END Datatables Content -->
  
  <script>
  $('#dis_img').fadeOut('fast');
  function change_img(value){
	
	 $('#dis_img').fadeIn('fast');
	 $("#src_chnge").attr("src","<?php echo ASSETS;?>proui/img/"+value+".png");
	  }
  </script>
  <script src="<?php echo ASSETS;?>proui/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>
