<div id="page-content">
  <div class="content-header">
    <div class="header-section">
      <h1>
        <i class="fa fa-inr"></i>Body Mass Index<br><small></small>
      </h1>
    </div>
  </div>

  <!-- END Datatables Header -->

  <!-- Datatables Content -->
  <div class="block full">
    <div class="block-title">
      <h2><strong>Body</strong> Mass Index</h2>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<div class="col-md-4"><label>Weight in Kilograms</label></div>
			<div class="col-md-8"><input class="form-control" id="w" type="number" min="0" name="wieght" required></div>
			</div>
			<div class="form-group">
			<div class="col-md-4"><label>Height in Centimeteres</label></div>
			<div class="col-md-8"><input class="form-control" id="h" type="number" min="0" name="height" required></div>
			</div>
			<div class="form-group">
			<center><button class="btn btn-primary" id="btn" onclick="calculate()">Submit</button></center>
			</div>
			

		</div>
		
    </div>
	</div>
	<div id="hello"></div>
	
    <!-- END Datatables Content -->
  
  <script>
  $('#hello').html("");
	function calculate(){
		
		height = $('#h').val();
		weight = $('#w').val();
		if(height == null || weight==null){
		swal('Please Fill The Entries!!');	
		return false;
		}
		height = height/100;
		bm  = parseFloat(weight/(height*height).toFixed(2));
		bm = Math.round(bm * 100) / 100;
		var html = "";
		
		html+='<p class="alert alert-success" style="color:black;" >Your BMI  '+bm+'<p>';
		$('#hello').append(html);
		
	}
 
  </script>
  <script src="<?php echo ASSETS;?>proui/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>
