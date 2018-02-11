<?php
$facebook_categories = [
  'Blood Group' => "Blood Group Of Patient",
  'ESR' => "Erythrocyte Sedimentation Rate",
  'Haematocrit' => "Ratio of WBCs to total Blood Cell.",
  'CBC' => 'Complete Blood Count.'
];
$instagram_categories = [
  'Type 1 Diabetes' => "Type1 Diabetes",
  'Narcolepsy' => "Narcolepsy Disease",
  'HLA Typing' => "Type of Bone Marrow",
  'Parkinsons Disease' => 'Parkinsons Disease'
];
$twitter_categories = [
  'Pharmacogenomics' => "Medicines which suits genes.",
  'Hereditary Disease' => "Disease inherited by parents.",
  'HIV Test' => 'Tests related to HIV.',
  'Last Disease' => 'Suffered with last Disease.'
];
$youtube_categories = [
  'Smoke' => "Smokes or not.",
  'Alcohol' => "Drinks Alcohol or not.",
  'Anxiety Level' => "Tension States.",
  'Allergies' => "Allergic Or not",


];

$all_social_supported = ['facebook', 'instagram', 'twitter', 'youtube'];
?>
<style>
	</style>
<div id="page-content">
  <!-- Progress Bar Wizard Block -->
  <div class="block">
    <!-- Progress Bars Wizard Title -->
    <div class="block-title">
      <h2><strong>Start new Report</strong> </h2>
    </div>
    <!-- END Progress Bar Wizard Title -->
    <!-- Progress Bar Wizard Content -->
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <div class="block-section">
          <h3 class="sub-header text-center"><strong>Create a Report with 4 easy steps!</strong></h3>
        </div>
      </div>
      <div class="col-md-offset-1 col-md-10">
        <!-- Wizard Progress Bar, functionality initialized in js/pages/formsWizard.js -->
        <div class="progress progress-striped active">
          <div id="progress-bar-wizard" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
        </div>
        <!-- END Wizard Progress Bar -->

        <!-- Progress Wizard Content -->
        <form id="advanced-wizard" action="<?php echo SITEURL.'brand/add_campaign' ?>" method="post" class="form-horizontal">
		  <div id="advanced-first" class="step">
		  <center><h2 style="color:green;">Personal Details</h2></center>
		   <div class="form-group">
              <label class="col-md-4 control-label" for="example-firstname">Patient Id <span class="text-danger">*</span></label>
              <div class="col-md-7">
                <input autocomplete="off" type="text" class="form-control" placeholder="Patient Id" name="p_id_p" required maxlength="50">
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Enter Your Patient Name"></i></div>
            </div>  
            <div class="form-group">
              <label class="col-md-4 control-label" for="example-firstname">Name <span class="text-danger">*</span></label>
              <div class="col-md-7">
                <input autocomplete="off" type="text" class="form-control" placeholder="Name Of Patient" name="name_p" required maxlength="50">
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Enter Your Patient Name"></i></div>
            </div>  
			<div class="form-group">
              <label class="col-md-4 control-label" for="example-firstname">Age <span class="text-danger">*</span></label>
              <div class="col-md-7">
                <input autocomplete="off" type="number" min ="0" class="form-control" placeholder="Age Of Patient" name="age_p" required maxlength="3">
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Enter Your Patient Age"></i></div>
            </div>
			<div class="form-group">
              <label class="col-md-4 control-label" for="example-firstname">Weight <span class="text-danger">*</span></label>
              <div class="col-md-7">
                <input autocomplete="off" type="number" min = "0" class="form-control" placeholder="Weight Of Patient" name="weight_p" required maxlength="50">
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Enter Your Patient Weight"></i></div>
            </div>  
			<div class="form-group">
              <label class="col-md-4 control-label" for="example-firstname">Height <span class="text-danger">*</span></label>
              <div class="col-md-7">
                <input autocomplete="off" type="number" min = "0" class="form-control" placeholder="Height Of Patient" name="height_p" required maxlength="50">
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Enter Your Patient Height"></i></div>
            </div>  
			<div class="form-group">
              <label class="col-md-4 control-label" for="example-firstname">Address <span class="text-danger">*</span></label>
              <div class="col-md-7">
                <input autocomplete="off" type="text" class="form-control" placeholder="Address Of Patient" name="address_p" required maxlength="50">
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Enter Your Patient Address"></i></div>
            </div>  
            
           

          </div>
 
          <div id="advanced-second" class="step">
		  <center><h2 style="color:green;">Test Categorization</h2></center>
            <div id="add-social-links">
              <label class="col-md-4 control-label" for="example-firstname">Test Category <span class="text-danger">*</span></label>
              <div style="display: none">
                <input id="facebook-check-box" class="c-category" type="checkbox" name="c-category[]" value="Facebook" required>
                <input id="twitter-check-box" class="c-category" type="checkbox" name="c-category[]" value="Twitter">
                <input id="instagram-check-box" class="c-category" type="checkbox" name="c-category[]" value="Instagram">
                <input id="youtube-check-box" class="c-category" type="checkbox" name="c-category[]" value="Youtube">
                <input id="linkedin-check-box" class="c-category" type="checkbox" name="c-category[]" value="LinkedIn">
              </div>

              <div class="col-md-7">
                <a target="_blank" href="javascript:void(0);" class="widget widget-hover-effect2 themed-background-muted-light" onclick="check_category('facebook');">
                  <div id="facebook-display-box" class="widget-simple">
                    <div class="widget-icon pull-right themed-background">
                      <i class="fa fa-blood"></i>
                    </div>
                    <h4 class="text-left">
                      <strong></strong><br><small>Blood Test</small>
                    </h4>
                  </div>
                </a>
                <a target="_blank" href="javascript:void(0);" class="widget widget-hover-effect2 themed-background-muted-light" onclick="check_category('twitter');">
                  <div id="twitter-display-box" class="widget-simple">
                    <div class="widget-icon pull-right themed-background">
                      <i class="fa "><img></i>
                    </div>
                    <h4 class="text-left">
                      <strong></strong><br><small>Chronic Disease</small>
                    </h4>
                  </div>
                </a>
                <a target="_blank" href="javascript:void(0);" class="widget widget-hover-effect2 themed-background-muted-light" onclick="check_category('instagram');">
                  <div id="instagram-display-box" class="widget-simple">
                    <div class="widget-icon pull-right themed-background">
                      <i class="fa fa-genetic"></i>
                    </div>
                    <h4 class="text-left">
                      <strong></strong><br><small>Genitic Info</small>
                    </h4>
                  </div>
                </a>
                <a target="_blank" href="javascript:void(0);" class="widget widget-hover-effect2 themed-background-muted-light" onclick="check_category('youtube');">
                  <div id="youtube-display-box" class="widget-simple">
                    <div class="widget-icon pull-right themed-background">
                      <i class="fa fa-others"></i>
                    </div>
                    <h4 class="text-left">
                      <strong></strong><br><small>Others</small>
                    </h4>
                  </div>
                </a>
              </div>
			  <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="Click on all the Disease For Which The Test is Performed !!"></i></div>
            </div>
          </div>
          <!-- END Third Step -->

          <div id="advanced-third" class="step">
            <div id="add-category">
              <!-- Let jQuery do it -->
            </div>

          </div>

          <div id="back-next-buttons" class="form-group form-actions">
            <div class="col-md-8 col-md-offset-4">
              <input type="reset" class="btn btn-sm btn-warning progress-track-back-button" id="back3" value="Back">
              <input type="submit" class="btn btn-sm btn-primary progress-track-next-button" id="next3" value="Next">
            </div>
          </div>

        </form>
        <!-- END Progress Wizard Content -->
      </div>
    </div>
    <!-- END Progress Bar Wizard Content -->
  </div>
  <!-- END Progress Bar Wizard Block -->
</div>

<script src="<?php echo ASSETS.'proui/' ?>js/pages/formsWizard.js"></script>

<script type="text/javascript">
$(function() {
  FormsWizard.init();
});
function update_category() {
  var val = [];
  var html = "";
  var clickOrInsights = -1;
  var socialSelected = 0;
  var valueSelected, image;
  $('#add-category').html("");

  $(':checkbox:checked').each(function(i) {
    valueSelected = $(this).val();
    if(valueSelected == '1') {
      return;
    }
    if(valueSelected == 'Facebook' || valueSelected == 'Twitter' || valueSelected == 'Instagram' || valueSelected == 'Youtube' || valueSelected == 'LinkedIn') {
      socialSelected++;
    }
  });

  if(socialSelected == 0) {
    html += '<h1>Nothing Selected!</h1>';
    $('#add-category').append(html);
  }
  else {
    $(':checkbox:checked').each(function(i){
      val[i] = $(this).val();
      valueSelected = val[i];
      if(valueSelected == '1') {
        return;
      }
      if(valueSelected == 'Facebook'){
	  valueSelected= 'Blood Test';
      image = 'blood.jpg';
	  }
      else if(valueSelected == 'Twitter'){
      image = 'chronic.jpg';
	  valueSelected= 'Chronic Test';
	  }
      else if(valueSelected == 'Youtube'){
      image = 'others.jpg';
	  valueSelected= 'Others Test';
	  }
      else if(valueSelected == 'Instagram'){
      image = 'heart.png';
	  valueSelected= 'Genetic Test';
	  }
      

      html = "";
      html += '<div class="block">';
      html += '  <div class="block-title">';
      html += '    <h2><strong>'+valueSelected+'</strong> Wizard</h2>';
      html += '  </div>';
      html += '';
      html += '  <div class="row">';
      html += '    <div class="col-sm-2">';
      html += '      <div class="block-section">';
      html += "        <img src='<?php echo ASSETS.'images/' ?>"+image+"' class='camp-img img-responsive center-block' style='height: auto;max-height: 120px;max-width: 100%;width: auto;'>";
      html += '      </div>';
      html += '    </div>';
      


      
      if(valueSelected == 'Blood Test') {
	  
        <?php foreach ($facebook_categories as $key => $value): ?>
		  html += '    <div class="col-sm-10 pull-left" >';
			html += '';
			html += '      <div class="form-group">';
			html += '        <label class="col-md-4 control-label"><?php echo $key;?></label>';
			html += '        <div class="col-md-6">';
			html += '<input class="form-control" type="text" name="c-type-<?php echo $key;?>" required></input>';
			html += '</div>';
			html += ' <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="<?php echo $value; ?>"></i></div>'
			html += '</div>';
			html += '</div>';
       
        <?php endforeach; ?>
      }
      else if(valueSelected == 'Chronic Test') {
        <?php foreach ($instagram_categories as $key => $value): ?>
			  html += '    <div class="col-sm-10 pull-left" >';
			html += '';
			html += '      <div class="form-group">';
			html += '        <label class="col-md-4 control-label"><?php echo $key;?></label>';
			html += '        <div class="col-md-6">';
			html += '<input class="form-control" type="text" name="c-type-<?php echo $key;?>" required ></input>';
			html += '</div>';
			html += ' <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="<?php echo $value; ?>"></i></div>'
			html += '</div>';
			html += '</div>';
        <?php endforeach; ?>
      }
      else if(valueSelected == 'Genetic Test') {
        <?php foreach ($twitter_categories as $key => $value): ?>
        html += '    <div class="col-sm-10 pull-left" >';
			html += '';
			html += '      <div class="form-group">';
			html += '        <label class="col-md-4 control-label"><?php echo $key;?></label>';
			html += '        <div class="col-md-6">';
			html += '<input class="form-control" type="text" name="c-type-<?php echo $key;?>" required></input>';
			html += '</div>';
			html += ' <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="<?php echo $value; ?>"></i></div>'
			html += '</div>';
			html += '</div>';
        <?php endforeach; ?>
      }
      else if(valueSelected == 'Others Test') {
        <?php foreach ($youtube_categories as $key => $value): ?>
         html += '    <div class="col-sm-10 pull-left" >';
			html += '';
			html += '      <div class="form-group">';
			html += '        <label class="col-md-4 control-label"><?php echo $key;?></label>';
			html += '        <div class="col-md-6">';
			html += '<input class="form-control" type="text" name="c-type-<?php echo $key;?>" required></input>';
			html += '</div>';
			html += ' <div class="col-md-1" ><i   class="fa fa-info fa-lg" data-toggle="tooltip" title="" data-original-title="<?php echo $value; ?>"></i></div>'
			html += '</div>';
			html += '</div>';
        <?php endforeach; ?>
      }
     
      
 
      html += '  </div>';
      html += '</div>';
      $('#add-category').append(html);
    });
  }

  
}

function check_category(category) {
  $('#'+category+'-check-box').is(':checked') ? $('#'+category+'-check-box').prop('checked', false) : $('#'+category+'-check-box').prop('checked', true);
  $('#'+category+'-check-box').is(':checked') ? $('#'+category+'-display-box').css('background', 'linear-gradient(to bottom right, #66ff99, #99ff66)') : $('#'+category+'-display-box').css('background', '');
  update_category();
}
</script>
