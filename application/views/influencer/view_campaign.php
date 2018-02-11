<?php
if($camp_data_all) {
  $data = json_encode($camp_data_all);
  print_r("<script type='text/javascript'>
  var CAMP_DATA = {$data};
  </script>");
}
?>

<style media="screen">
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<!-- Page content -->
<div id="page-content">
  <!-- Article Header -->
  <!-- Article Content -->
  <div class="row">
    <div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
      <!-- Article Block -->
      <div class="block block-alt-noborder">
        <!-- Article Content -->
        <article>
          <h3 class="sub-header text-center"><strong><?php echo $camp_data_all[0]['camp_name']; ?></strong> <small>on <?php echo date("d-m-Y",strtotime($camp_data_all[0]['camp_created'])) ?></small></h3>
          <div class="row push-top-bottom">
            <div class="col-12">
              <p>
                <a href="<?php echo ASSETS.$camp_data_all[0]['camp_image']; ?>" data-toggle="lightbox-image">
                  <img src="<?php echo ASSETS.$camp_data_all[0]['camp_image']; ?>" alt="image" class="img-responsive" style="margin: 0 auto; height: 300px">
                </a>
              </p>
            </div>
          </div>

          <div class="block">
            <p><?php echo $camp_data_all[0]['desp'] ?></p>
          </div>

          <!-- Forum Block -->
          <div class="block">
            <!-- Forum Tabs Title -->
            <div class="block-title">
              <ul class="nav nav-tabs view_camp_category" data-toggle="tabs">
                <?php foreach ($camp_data_all as $key => $camp_data): ?>
                  <li class="<?php echo $key==0?'active':''; ?>"><a href="#navbar_content<?php echo $key; ?>" id="href_id<?php echo $key; ?>"><?php echo $camp_data['camp_category'] ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <!-- END Forum Tabs -->

            <!-- Tab Content -->
            <div class="tab-content">
              <!-- Forum -->
              <?php foreach ($camp_data_all as $key => $camp_data): ?>
                <div class="tab-pane <?php echo $key==0?'active':''; ?>" id="navbar_content<?php echo $key; ?>">

                  <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                      <tr>
                        <th colspan="2"></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="hidden-xs hidden-sm" style="width: 200px;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center" style="width: 100px;"><i class="fa fa-inr fa-2x"></i></td>
                        <td>
                          <h4>
                            <a href="javascript:void(0)"><strong>Price</strong></a><br>
                            <small>Price of <?php echo $camp_data['camp_category']; ?> category</small>
                          </h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a></td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a><h4><?php echo $camp_data['camp_price']; ?></h4></td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a></td>
                      </tr>
                      <tr>
                        <td class="text-center" style="width: 100px;"><i class="gi gi-globe fa-2x"></i></td>
                        <td>
                          <h4>
                            <a href="javascript:void(0)"><strong>Required</strong></a><br>
                            <small>Required <?php echo $camp_data['number_of']; ?> <?php echo $camp_data['camp_type']; ?> for completion</small>
                          </h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a></td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a><h4><?php echo $camp_data['number_of']; ?> <?php echo $camp_data['camp_type']; ?></h4></td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a></td>
                      </tr>
					    <tr>
                        <td class="text-center" style="width: 100px;"><i class="fa fa-inr fa-2x"></i></td>
                        <td>
                          <h4>
                            <a href="javascript:void(0)"><strong>Average cost per <?php echo $camp_data['camp_type']; ?></strong></a><br>
                            <small>Each <?php echo $camp_data['camp_type']; ?> will cost</small>
                          </h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a></td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a><h4><?php echo intval($camp_data['camp_price'])/intval($camp_data['number_of']); ?> </h4></td>
                        <td class="text-center hidden-xs hidden-sm"><a href="javascript:void(0)"></a></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              <?php endforeach; ?>

              <div class="block">
                <div id="basic-wizard" action="page_forms_wizard.php" method="post" class="form-horizontal form-bordered">
                  <div id="first" class="step">
                    <div class="wizard-steps">
                      <div class="row">
                        <div class="col-xs-4 active">
                          <a class="nav-clicked-offer" href="javascript:void(0)"><span>1. Offer</span></a>
                        </div>
                        <div class="col-xs-4">
                          <a class="nav-clicked-campaign" href="javascript:void(0)"><span>2.Campaign</span></a>
                        </div>
                        <div class="col-xs-4">
                          <a class="nav-clicked-post" href="javascript:void(0)"><span>3. Select Post</span></a>
                        </div>
                      </div>
                    </div>
                    <div id="offer-wizard">
                      <!-- Let jQuery do it! -->
                    </div>
                  </div>

                  <div id="second" class="step">
                    <div class="wizard-steps">
                      <div class="row">
                        <div class="col-xs-4 done">
                          <a class="nav-clicked-offer" href="javascript:void(0)"><span><i class="fa fa-check"></i></span></a>
                        </div>
                        <div class="col-xs-4 active">
                          <a class="nav-clicked-campaign" href="javascript:void(0)"><span>2. Campaign</span></a>
                        </div>
                        <div class="col-xs-4">
                          <a class="nav-clicked-post" href="javascript:void(0)"><span>3. Select Post</span></a>
                        </div>
                      </div>
                    </div>
                    <div id="campaign-wizard">
                      <!-- Let jQuery do it! -->
                    </div>
                  </div>

                  <div id="third" class="step">
                    <div class="wizard-steps">
                      <div class="row">
                        <div class="col-xs-4 done">
                          <a class="nav-clicked-offer" href="javascript:void(0)"><span><i class="fa fa-check"></i></span></a>
                        </div>
                        <div class="col-xs-4 done">
                          <a class="nav-clicked-campaign" href="javascript:void(0)"><span><i class="fa fa-check"></i></span></a>
                        </div>
                        <div class="col-xs-4 active">
                          <a class="nav-clicked-post" href="javascript:void(0)"><span>3. Select Post</span></a>
                        </div>
                      </div>
                    </div>
                    <div id="finish-wizard">
                      <!-- Let jQuery do it! -->
                    </div>
                  </div>

                  <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                      <input type="hidden" class="btn btn-sm btn-warning" id="back" value="Back">
                      <input type="hidden" class="btn btn-sm btn-primary" id="next" value="Next">
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </article>
      </div>
      <!-- END Article Block -->
    </div>
  </div>
  <!-- END Article Content -->
</div>
<!-- END Page Content -->
<script src="<?php echo ASSETS.'proui/' ?>js/pages/formsWizard.js"></script>

<script src="<?php echo ASSETS;?>js/form-wizard.js"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<!-- Dropzone.js -->
<script src="<?php echo ASSETS;?>vendors/dropzone/dist/min/dropzone.min.js"></script>

<script type="text/javascript">
var GLOBAL_CATEGORY = "";
</script>

<script type="text/javascript">
function onload() {
  var url = SITEURL+"influencer/check_proposal_get_approvals";
  var html = ["", "", "" , "", ""];
  var global_category = GLOBAL_CATEGORY;
  var key = -1;

  for(var camp_data of CAMP_DATA) {
    key++;
    if(camp_data.camp_category !== global_category) {
      continue;
    }
    else {
      var id = camp_data.camp_id;
      $('#offer-wizard').html("");

      html[key] = "";
      $.post(url, {camp_id:id}, function(data,status) {
        var data_offer = data.offer;
        if(data_offer.val == -2) {
          html[key] += '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
          html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
          html[key] += '  <h4 class="text-center" style="height: 5px">This campaign is no longer available.</h4>';
          html[key] += '</div>';
          $('#offer-wizard').append(html[key]);
          return;
        }
        else if(data_offer.val == 1) {
          html[key] += '<form onsubmit="offer_submit('+key+'); return false;" class="form-group" id="proposal-form'+key+'" action="'+SITEURL+'influencer/proposals_ajax" method="post">';
          html[key] += '<div class="col-md-12">';
          html[key] += '<h4>Brand Offer: <code>'+data_offer.camp_data.camp_price+' '+data_offer.camp_data.camp_price_currency+'</code></h4>';
          html[key] += '</div>';
          html[key] += '<div class="col-md-12">';
          html[key] += '  <div class="input-group">';
          html[key] += '    <span class="input-group-addon">Your offer</span>';
          html[key] += '    <input required autocomplete="off" type="text" class="form-control" name="price" id="price'+key+'">';
          html[key] += '    <span class="input-group-addon">'+data_offer.camp_data.camp_price_currency+'</span>';
          html[key] += '  </div>';
          html[key] += '  <div class="input-group">';
          html[key] += '    <span class="input-group-addon" style="resize:none">Message</span>';
          html[key] += '    <textarea style="resize: none" required autocomplete="off" class="form-control" rows="5" name="msg" id="msg" style="resize: none;" maxlength="250"></textarea>';
          html[key] += '  </div>';
          html[key] += '  <input type="hidden" id="camp_id" name="camp_id" value="'+id+'">';
          html[key] += '  <div class="input-group">';
          html[key] += '   <center> <button id="offer-submit" type="submit" class="btn btn-primary">Make Offer</button></center>';
          html[key] += '  </div>';
          html[key] += '</div>';
          html[key] += '</form>';
        }
        else if(data_offer.val == -1) {
          html[key] += '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
          html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
          html[key] += '  <h4 class="text-center" style="height: 5px; -webkit-border-radius: 0;  -moz-border-radius: 0;  border-radius: 0;"><strong>'+data_offer.cat+'</strong> account not linked to the profile.</h4>';
          html[key] += '</div>';
          html[key] += '<div class="col-md-12">';
          html[key] += '  <div class="input-group">';
          html[key] += '    <span class="input-group-addon">Price</span>';
          html[key] += '    <input disabled autocomplete="off" type="text" class="form-control" name="price" id="price">';
          html[key] += '  </div>';
          html[key] += '  <div class="input-group">';
          html[key] += '    <span class="input-group-addon">Message</span>';
          html[key] += '    <textarea disabled autocomplete="off" class="form-control" rows="5" name="msg" id="msg" maxlength="250"></textarea>';
          html[key] += '  </div>';
          html[key] += '  <input type="hidden" id="camp_id" name="camp_id" value="'+id+'">';
          html[key] += '  <div class="input-group">';
          html[key] += '    <button disabled id="offer-submit" type="submit" class="btn btn-primary"><span>Make Offer</span></button>';
          html[key] += '  </div>';
          html[key] += '</div>';
        }
        else {
          if(data_offer.approval == 1) {
            html[key] += '<div class="alert alert-success alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">Your offer was Accepted!</h4>';
            html[key] += '</div>';
          }
          else if(data_offer.approval == -1 || data_offer.approval == -2) {
            html[key] += '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">Your offer has been rejected.</h4>';
            html[key] += '</div>';
          }
          else {
            html[key] += '<div class="alert alert-info alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">You have made the offer.</h4>';
            html[key] += '</div>';
          }
          html[key] += '<div class="col-md-12">';
          html[key] += '<h4>Brand Offer: <code>'+data_offer.camp_data.camp_price+' '+data_offer.camp_data.camp_price_currency+'</code></h4>';
          html[key] += '</div>';
          html[key] += '<div class="col-md-12">';
          html[key] += '  <div class="input-group">';
          html[key] += '    <span class="input-group-addon">Your offer</span>';
          html[key] += '    <input disabled type="text" class="form-control" name="price" value="'+data_offer.pro_price+'">';
          html[key] += '  </div>';
          html[key] += '  <div class="input-group">';
          html[key] += '    <span class="input-group-addon">Message</span>';
          html[key] += '    <textarea class="form-control" rows="5" name="msg" id="msg" maxlength="250">'+data_offer.pro_msg+'</textarea>';
          html[key] += '  </div>';
          html[key] += '</div>';
        }
        $('#offer-wizard').append(html[key]);

        url=SITEURL+'influencer/get_approval';
        html[key] = "";
        var pro_id = data_offer.pro_id;
        var data = data.campaign;

        if((data.approve == 0 && data.error == 1) || ((data.approve == -1||data.approve == -2) && data.error == 0)) {
          if((data.approve == -1||data.approve == -2) && data.error == 0) {
            html[key] += '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">You have been requested to edit your content. Please check <a href="'+SITEURL+'influencer/chat">Chat</a> for more information from the Brand.</h4>';
            html[key] += '</div>';
          }
          html[key] += '<p>Enter Campaign details.</p>';

          if(data.pro == 2)
          html[key] += '<form class="form-group" onclick="return false;" id="camp-acceptance-form'+key+'">';
          if(data.cat == 'Youtube') {
            if(data.cm_link != '')
            html[key] += '<p><strong>Make sure you have this link present in the description:  </strong><code>'+data.cm_link+'</code></p>';
            html[key] += '<div class="col-md-12">';
            html[key] += '  <div class="input-group">';
            html[key] += '    <span class="input-group-addon">VIDEO<h6>100M max<br>mp4</h6></span>';
            html[key] += '    <div class="dropzone" id="dropzone-video'+key+'">';
            html[key] += '    </div>';
            html[key] += '  </div>';
            html[key] += '</div>';
            html[key] += '<input type="hidden" name="content" id="content" value="youtube"></textarea>';
          }
          if(data.cat != 'Youtube') {
            if(data.pro == 2) {
              if(data.cm_link != '')
              html[key] += '<p><strong>Make sure you have this link present in the content:  </strong><code>'+data.cm_link+'</code></p>';
              html[key] += '<div class="col-md-12">';
              html[key] += '  <div class="input-group">';
              html[key] += '    <span class="input-group-addon">Campaign Content</span>';
              html[key] += '    <textarea required autocomplete="off" maxlength="2000" class="form-control" rows="7" name="content" id="content'+key+'"></textarea>';
              html[key] += '  </div>';
              html[key] += '</div>';

              html[key] += '<div class="col-md-12">';
              html[key] += '  <div class="input-group">';
              if(data.cat == 'Facebook') {
                html[key] += '    <span class="input-group-addon">IMAGE<h6>(Optional)<br>5M max<br>jpg</h6>VIDEO<h6>(Optional)<br>100M max<br>mp4</h6></span>';
              }
              else {
                html[key] += '    <span class="input-group-addon">IMAGE<h6>(Optional)<br>5M max<br>jpg</h6></span>';
              }
              html[key] += '    <div class="dropzone" id="dropzone-image'+key+'">';
              html[key] += '    </div>';
              html[key] += '  </div>';
              html[key] += '</div>';
            }
          }

          html[key] += '<div class="col-sm-6">';
          if(data.pro == 2)
          html[key] += '  <button id="approval-submit'+key+'" type="submit" class="btn btn-success">Request Approval</button>';
          html[key] += '</div>';
          html[key] += '<div class="col-sm-6">';
          html[key] += '</div>';
          html[key] += '<input type="hidden" name="camp_id" value="'+data.camp_id+'">';
          html[key] += '<input type="hidden" name="inf_id" value="'+data.inf_id+'">';
          html[key] += '<input type="hidden" name="pro_id" value="'+pro_id+'">';
          if(data.pro == 2)
          html[key] += '</form>';
          else if(data.pro == 1) {
            html[key] += '<div class="alert alert-info alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">Waiting for Offer Approval.</h4>';
            html[key] += '</div>';
          }
          else {
            html[key] += '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">Make an offer to submit Campaign.</h4>';
            html[key] += '</div>';
          }
          $('#campaign-wizard').html("");
          $('#campaign-wizard').append(html[key]);

          if(data.cat == 'Youtube') {
            if($("#dropzone-video"+key).length) {
              var myDropzone = new Dropzone("#dropzone-video"+key, {
                url: SITEURL+'influencer/add_approval',
                autoProcessQueue: false,
                uploadMultiple: true,
                maxFiles: 1,
                paramName: "userfile",
                maxFilesize: 100,
                acceptedFiles: '.mp4',

                init: function() {
                  this.on('sendingmultiple', function(file, xhr, formData) {
                    var data = $('#camp-acceptance-form'+key).serializeArray();
                    $.each(data, function(index, value) {
                      formData.append(value.name, value.value);
                    });
                  });
                },
                success: function() {
                  swal("Success!", 'The content was submitted', "success");
                  onload();
                }
              });
            }
          }
          else if(data.cat == 'Facebook') {
            if($("#dropzone-image"+key).length) {
              var myDropzone = new Dropzone("#dropzone-image"+key, {
                url: SITEURL+'influencer/add_approval',
                autoProcessQueue: false,
                uploadMultiple: true,
                maxFiles: 2,
                paramName: "userfile",
                maxFilesize: 100,
                acceptedFiles: '.jpg,.mp4',

                init: function() {
                  this.on('sendingmultiple', function(file, xhr, formData) {
                    var data = $('#camp-acceptance-form'+key).serializeArray();
                    $.each(data, function(index, value) {
                      formData.append(value.name, value.value);
                    });
                  });
                  this.on("error", function(file, errormessage, xhr){
                    if(xhr) {
                      var response = JSON.parse(xhr.responseText);
                      alert(response.message);
                    }
                  });
                },
                success: function() {
                  swal("Success!", 'The content was submitted', "success");
                  onload();
                }
              });
            }
          }
          else {
            if($("#dropzone-image"+key).length) {
              var myDropzone = new Dropzone("#dropzone-image"+key, {
                url: SITEURL+'influencer/add_approval',
                autoProcessQueue: false,
                uploadMultiple: true,
                maxFiles: 1,
                paramName: "userfile",
                maxFilesize: 5,
                acceptedFiles: '.jpg',

                init: function() {
                  this.on('sendingmultiple', function(file, xhr, formData) {
                    var data = $('#camp-acceptance-form'+key).serializeArray();
                    $.each(data, function(index, value) {
                      formData.append(value.name, value.value);
                    });
                  });
                  this.on("error", function(file, errormessage, xhr){
                    if(xhr) {
                      var response = JSON.parse(xhr.responseText);
                      alert(response.message);
                    }
                  });
                },
                success: function() {
                  swal("Success!", 'The content was submitted', "success");
                  onload();
                }
              });
            }
          }

          $('#approval-submit'+key).click(function() {
            if(myDropzone.getRejectedFiles().length > 0) {
              swal('Error!', 'Invalid file. Please refresh and upload again.', 'error');
              return;
            }
            if (myDropzone.files.length == 0) {
              if($('#content'+key).val() == '') {
                swal('Error!', 'Campaign content is required', 'error');
                return;
              }
              if(data.cat == 'Youtube') {
                swal('Error!', 'No video selected.', 'error');
                return;
              }
              else {
                swal({
                  title: "Are you sure?",
                  text: "You are about to submit the content",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes",
                  closeOnConfirm: false
                },
                function(y) {
                  if(y==true) {
                    if(data.cm_link != '') {
                      var final_content = $('#content'+key).val();
                      var final_link = data.cm_link;
                      if(!final_content) {
                        swal("Error!", 'No content', "error");
                      }
                      else {
                        if(final_content.indexOf(final_link) == -1) {
                          swal("Error!", "Link not present", "error");
                        }
                        else {
                          $.post(SITEURL+'influencer/add_approval',$('#camp-acceptance-form'+key).serialize(),function(data,status) {
                            swal("Success!", 'The content was submitted', "success");
                            onload();
                          });
                        }
                      }
                    }
                    else {
                      $.post(SITEURL+'influencer/add_approval',$('#camp-acceptance-form'+key).serialize(),function(data,status) {
                        swal("Success!", 'The content was submitted', "success");
                        onload();
                      });
                    }

                  }
                });
              }
            }
            else {
              if($('#content'+key).val() == '') {
                swal('Error!', 'Campaign content is required', 'error');
                return;
              }
              swal({
                title: "Are you sure?",
                text: "You are about to submit the content",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
              },
              function(y) {
                if(y==true) {
                  if(myDropzone.files.length == 0) {
                    swal("Error!", 'No file selected', "error");
                  }
                  else {
                    if(data.cm_link != '') {
                      var final_content = $('#content'+key).val();
                      var final_link = data.cm_link;
                      if(!final_content) {
                        swal("Error!", 'No content', "error");
                      }
                      else {
                        if(final_content.indexOf(final_link) == -1) {
                          swal("Error!", "Link not present", "error");
                        }
                        else {
                          myDropzone.processQueue();
                          swal("Uploading...", 'The content is being uploaded...', "info");
                        }
                      }
                    }
                    else {
                      myDropzone.processQueue();
                      swal("Uploading...", 'The content is being uploaded...', "info");
                    }
                  }
                }
              });
            }
          });

          var htmlTemp = "";
          htmlTemp += '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
          htmlTemp += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
          htmlTemp += '  <h4 class="text-center" style="height: 5px">Please finish the previous steps!</h4>';
          htmlTemp += '</div>';
          $('#finish-wizard').html("");
          $('#finish-wizard').append(htmlTemp);
        }
        else {
          var camp_cont = data.data;
          camp_cont = JSON.parse(camp_cont);

          if(data.approve == 0 && data.error == 2) {
            html[key] += '<div class="alert alert-info alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">Waiting for approval.</h4>';
          }
          else if(data.approve == 1 && data.error == 0) {
            html[key] += '<div class="alert alert-success alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">You have been approved. Post the same content on the Social Media and proceed to next step.</h4>';
          }
          html[key] += '</div>';
          if(data.cat != 'Youtube') {
            if(camp_cont.image != '/assets/images/noimage.png') {
              html[key] += '<div class="col-md-12">';
              html[key] += '  <div class="input-group">';
              html[key] += '    <span class="input-group-addon">IMAGE</span>';
              html[key] += '    <img src="'+SITEURL+camp_cont.image+'" style="width: 40%">';
              html[key] += '  </div>';
              html[key] += '</div>';
            }
            if(camp_cont.video != '') {
              html[key] += '<div class="col-md-12">';
              html[key] += '  <div class="input-group">';
              html[key] += '    <span class="input-group-addon">VIDEO</span>';
              html[key] += '    <video id="my-video" class="video-js" controls preload="auto" width="640" height="480" data-setup="{}">';
              html[key] += '      <source src="'+SITEURL+camp_cont.video+'" type="video/mp4">';
              html[key] += '      <p class="vjs-no-js">';
              html[key] += '        To view this video please enable Javascript, and consider upgrading to a web browser that';
              html[key] += '        <a href="http://videojs.com/html5-video-support/" target="_blank">supports html5 video</a>';
              html[key] += '      </p>';
              html[key] += '    </video>';
              html[key] += '  </div>';
              html[key] += '</div>';
            }

            html[key] += '<div class="col-md-12">';
            html[key] += '  <div class="input-group">';
            html[key] += '    <span class="input-group-addon">Campaign Content</span>';
            html[key] += '    <textarea required autocomplete="off" maxlength="2000" class="form-control" rows="7" name="content" id="content">'+camp_cont.content+'</textarea>';
            html[key] += '  </div>';
            html[key] += '</div>';
          }
          if(data.cat == 'Youtube') {
            html[key] += '<div class="col-md-12">';
            html[key] += '  <div class="input-group">';
            html[key] += '    <span class="input-group-addon">VIDEO</span>';
            html[key] += '    <video id="my-video" class="video-js" controls preload="auto" width="640" height="480" data-setup="{}">';
            html[key] += '      <source src="'+SITEURL+camp_cont.video+'" type="video/mp4">';
            html[key] += '      <p class="vjs-no-js">';
            html[key] += '        To view this video please enable Javascript, and consider upgrading to a web browser that';
            html[key] += '        <a href="http://videojs.com/html5-video-support/" target="_blank">supports html5 video</a>';
            html[key] += '      </p>';
            html[key] += '    </video>';
            html[key] += '  </div>';
            html[key] += '</div>';
          }
          $('#campaign-wizard').html("");
          $('#campaign-wizard').append(html[key]);

          html[key] = "";
          if(data.approve == 0 && data.error == 2) {
            html[key] += '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">Please finish the previous steps!</h4>';
            html[key] += '</div>';
          }
          else {
            if(data.link == 0) {
              html[key] += '<form role="form" onsubmit="return false;" action="'+SITEURL+'influencer/analytics" method="post" class="login-form" id="link-form'+key+'">';
              if(data.cat == 'Facebook') {
                html[key] += '<h4>Confirm your Facebook post.</h4>';
                html[key] += '<h5>Match percentage should be more than 90%.</h5>';
                html[key] += '<div id="add-facebook-post'+key+'"><div class="loader"></div></div>';
                check_facebook_accounts(camp_cont.camp_id, camp_cont.content, "add-facebook-post"+key);
              }
              else if(data.cat == 'Twitter') {
                html[key] += '<h4>Confirm your Tweet.</h4>';
                html[key] += '<h5>Match percentage should be more than 90%.</h5>';
                html[key] += '<div id="add-tweets'+key+'"><div class="loader"></div></div>';
                add_tweets(camp_cont.camp_id, camp_cont.content, "add-tweets"+key);
              }
              else if(data.cat == "Youtube") {
                html[key] += '<h4>Select your campaign video.</h4>';
                html[key] += '<div id="add-youtube-videos'+key+'"><div class="loader"></div></div>';
                add_youtube_videos(camp_cont.camp_id, "add-youtube-videos"+key);
              }
              else if(data.cat == "Instagram") {
                html[key] += '<h4>Confirm your Instagram post.</h4>';
                html[key] += '<h5>Match percentage should be more than 90%.</h5>';
                html[key] += '<div id="add-instagram-post'+key+'"><div class="loader"></div></div>';
                add_instagram_posts(camp_cont.camp_id, camp_cont.content, "add-instagram-post"+key);
              }
              else if(data.cat == "LinkedIn") {
                html[key] += '<h4>Confirm your LinkedIn post.</h4>';
                html[key] += '<h5>Match percentage should be more than 90%.</h5>';
                html[key] += '<div id="add-linkedin-post'+key+'"><div class="loader"></div></div>';
                add_linkedin_posts(camp_cont.camp_id, camp_cont.content, "add-linkedin-post"+key);
              }

              html[key] += '  </div>';
              html[key] += '<input type="hidden" name="cat" value="'+data.cat+'">';
              html[key] += '<div class="input-group col-sm-6">';
              html[key] += '  <input id="final-submit" type="submit" class="btn btn-success btn-large" value="Submit">';
              html[key] += '  <input id="account-submit" type="hidden" class="btn btn-success btn-large" value="Submit">';
              html[key] += '</div>';
              html[key] += '<input type="hidden" name="camp_id" value="'+data.camp_id+'">';
              html[key] += '<input type="hidden" name="inf_id" value="'+data.inf_id+'">';
              html[key] += '</form>';
            }
            else {
              html[key] += '<div class="alert alert-success alert-dismissible fade in" role="alert">';
              html[key] += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
              html[key] += '<h4 class="text-center" style="height: 5px">You have already added the campaign!</h4>';
              html[key] += '</div>';
              var twitterPost = 0;
              var datapost_id = data.post_id;
              var datalink_val = data.link_val;
              if(data.cat == 'Facebook') {
                check_facebook_multiple_pages(datapost_id, datalink_val, camp_cont);
                html[key] += '<div id="facebookMultiplePages"></div>';
              }
              else if(data.cat == 'Twitter') {
                twitterPost = 1;
                html[key] += '<div class="col-sm-10 col-sm-offset-2"><div id="tweet-container-final"></div></div>';
                $('#finish-wizard').html("");
                $('#finish-wizard').append(html[key]);
                twttr.widgets.createTweet(
                  data.post_id,
                  document.getElementById('tweet-container-final'),
                  {
                    linkColor: "#55acee"
                  }
                );
                html[key] = "";

                html[key] += '<div class="text-center"><a target="_blank" type="button" class="btn btn-info" href="'+data.link_val+'">View post</a>';
                html[key] += '<a type="button" class="btn btn-info" onclick="view_analytic('+camp_cont.camp_id+', 0, 0);">View Analytics</a></div>';
              }
              else if(data.cat == "Youtube") {
                html[key] += '<div class="col-sm-10 col-sm-offset-2"><iframe src="https://www.youtube.com/embed/'+data.post_id+'" frameborder="0" allowfullscreen></iframe></div>';

                html[key] += '<div class="text-center"><a target="_blank" type="button" class="btn btn-info" href="'+data.link_val+'">View post</a>';
                html[key] += '<a type="button" class="btn btn-info" onclick="view_analytic('+camp_cont.camp_id+', 0, 0);">View Analytics</a></div>';
              }
              else if(data.cat == "Instagram") {
                html[key] += '<div class="text-center"><a target="_blank" type="button" class="btn btn-info" href="'+data.link_val+'">View post</a>';
                html[key] += '<a type="button" class="btn btn-info" onclick="view_analytic('+camp_cont.camp_id+', 0, 0);">View Analytics</a></div>';
              }

              html[key] += '<div class="input-group col-sm-6">';
              html[key] += '  <input id="post-select-page-submit" type="hidden" class="btn btn-success btn-large" value="Submit">';
              html[key] += '</div>';
            }
          }

          if(!twitterPost) {
            $('#finish-wizard').html("");
          }
          $('#finish-wizard').append(html[key]);

          var form2 = $('#link-form'+key);
          form2.on('submit',function(e){
            e.preventDefault();
            var values=form2.serialize();
            var url=form2.attr('action');
            $('#link-form'+key+' div.text-danger').remove();

            $.post(url,values,function(data,status) {
              if(data.error===false){
                swal({
                  title: "Are you sure?",
                  text: "You are about to submit the campaign",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes",
                  closeOnConfirm: false
                },
                function(y){
                  if(y==true){
                    form2[0].reset();
                    swal({
                      title: "Success!",
                      text: data.msg,
                      type: "success",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    },
                    function(){
                      window.location.replace(SITEURL+'influencer/view_campaign?camp_id='+camp_data.id);
                    });
                  }
                });

              }
              else{
                if(data.msg) {
                  swal('Error!', data.msg, 'error');
                }
                else {
                  $('#link-form'+key+' div.text-danger').remove();
                  $.each(data ,function(index,value){
                    $('#'+index).before(value);
                  });
                }
              }
            });
          });
        }
      });
    }
  }
}

function add_linkedin_posts(camp_id, msg, div_id) {
  $.ajax({
    url: SITEURL+'influencer/get_posts',
    type: "POST",
    data: {'cat': 'LinkedIn', 'msg': msg, 'camp_id': camp_id},
    success: function(data) {
      if(data.multipleAccounts == true) {

      }
      else {
        html = "";
        $.each(data, function(key, value) {
          var id = value.id;
          var post_id = id.split('-');
          if(value.percentage < 90)
          html += '<div class="col-md-2 col-lg-2 col-sm-2"><input disabled type="radio" class="form-control">Match Percentage: '+parseFloat(value.percentage).toFixed(2)+'</div>';
          else
          html += '<div class="col-md-2 col-lg-2 col-sm-2"><input type="radio" class="form-control" name="link" id="link" value="'+id+'">Match Percentage: '+parseFloat(value.percentage).toFixed(2)+'</div>';
          html += '<div class="col-md-10 col-lg-10 col-sm-10"><button><a target="_blank" href="https://www.linkedin.com/feed/update/urn:li:activity:'+post_id[2]+'">Open post</a></button></div><br><br><br><br><br><br>';
        });

        $('#'+div_id).html("");
        $('#'+div_id).append(html);
      }
    }
  });
}

var checkFacebookMultiplePagesCampId = 0;

function check_facebook_multiple_pages(datapost_id, datalink_val, camp_cont) {
  var html = "";
  var htmloptions = "";
  $.ajax({
    url: SITEURL+'influencer/check_accounts',
    type: "POST",
    data: {'cat': 'Facebook'},
    success: function(data) {
      if(data.multipleAccounts == true) {
        var i=0;
        $.each(data.accounts, function(index, value) {
          htmloptions += "<option value='"+value.id+"'>"+value.name+"</option>";
          i++;
        });

        var id_s = datapost_id.split('_');
        html += '<div class="col-sm-10 col-sm-offset-2"><iframe src="https://www.facebook.com/plugins/post.php?href=https://www.facebook.com/'+id_s[0]+'/posts/'+id_s[1]+'/" width="500" height="321" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';

        html += '<div class="text-center"><a target="_blank" type="button" class="btn btn-info" href="'+data.link_val+'">View post</a>';
        html += '<a type="button" class="btn btn-info" onclick="view_analytic('+camp_cont.camp_id+', 0, 0);">View Analytics</a></div>';

        html += "<h3>You have multiple pages linked. You can add posts from all of your pages!</h3>";
        html += '<div class="col-md-8 col-md-offset-2">'
        html += '<select class="form-group" id="pageNameSelectPost">';
        html += htmloptions;
        html += '</select>';
        html += '<a id="facebookMultiplePagesLoadPostsButton" type="button" class="btn btn-info" onclick="facebookMultiplePagesLoadPostsFunction();">Load Posts</a>';
        html += '</div>';
        html += '<div class="col-sm-12"><div id="facebookMultiplePagesLoadPosts"></div></div>';
        html += '<a id="" type="button" class="btn btn-info" onclick="checkFacebookMultiplePagesSubmit();">Submit</a>';
        checkFacebookMultiplePagesCampId = camp_cont.camp_id;

        $('#facebookMultiplePages').html('');
        $('#facebookMultiplePages').append(html);
      }
      else {
        var id_s = data.post_id.split('_');
        html += '<div class="col-sm-10 col-sm-offset-2"><iframe src="https://www.facebook.com/plugins/post.php?href=https://www.facebook.com/'+id_s[0]+'/posts/'+id_s[1]+'/" width="500" height="321" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';

        html += '<div class="text-center"><a target="_blank" type="button" class="btn btn-info" href="'+data.link_val+'">View post</a>';
        html += '<a type="button" class="btn btn-info" onclick="view_analytic('+camp_cont.camp_id+', 0, 0);">View Analytics</a></div>';

        $('#facebookMultiplePages').html('');
        $('#facebookMultiplePages').append(html);
      }
    }
  });
}

function facebookMultiplePagesLoadPostsFunction() {
  var id_selected = $("#pageNameSelectPost").val();
  add_facebook_posts(checkFacebookMultiplePagesCampId, '', 'facebookMultiplePagesLoadPosts', id_selected);
}

function check_facebook_accounts(camp_id, msg, div_id) {
  $.ajax({
    url: SITEURL+'influencer/check_accounts',
    type: "POST",
    data: {'cat': 'Facebook'},
    success: function(data) {
      if(data.multipleAccounts == true) {
        var i=0;
        var html = "";
        $.each(data.accounts, function(index, value) {
          html += "<option value='"+value.id+"'>"+value.name+"</option>";
          i++;
        });

        $('#account-submit').attr("type", "button");
        $('#final-submit').attr("type", "hidden");

        var html1 = "<h3>You have multiple pages linked. You can add posts from all of your pages!</h3>";
        html1 += '<div class="col-md-8 col-md-offset-2">'
        html1 += '<select class="form-group" id="page-name">';
        html1 += html;
        html1 += '</select>';
        html1 += '</div>';
        $('#'+div_id).html("");
        $('#'+div_id).append(html1);

        $('#account-submit').on('click', function() {
          var id_selected = $("#page-name").val();
          $('#'+div_id).html("<div class='loader'></div>");
          $('#account-submit').attr("type", "hidden");
          add_facebook_posts(camp_id, msg, div_id, id_selected);
        });
      }
      else {
        add_facebook_posts(camp_id, msg, div_id, 0);
      }
    }
  });
}

function add_facebook_posts(camp_id, msg, div_id, account) {
  $.ajax({
    url: SITEURL+'influencer/get_posts',
    type: "POST",
    data: {'cat': 'Facebook', 'msg': msg, 'camp_id': camp_id, 'account': account},
    success: function(data) {
      var html = "";
      var account = data.account;
      data = data.data;
      if(data.length == 0) {
        html += "<h3>Posts matching your content were not found.</h3>";
      }
      else {
        $.each(data, function(key, value) {
          var id = value.id;
          var id_s = id.split('_');
          if(value.percentage < 90)
          html += '<div class="col-md-2 col-lg-2 col-sm-2"><input disabled type="radio" class="form-control">Match Percentage: '+parseFloat(value.percentage).toFixed(2)+'</div>';
          else
          html += '<div class="col-md-2 col-lg-2 col-sm-2"><input type="radio" class="form-control" name="link" id="link" value="'+id+'">Match Percentage: '+parseFloat(value.percentage).toFixed(2)+'</div>';
          html += '<div class="col-md-10 col-lg-10 col-sm-10"><iframe src="https://www.facebook.com/plugins/post.php?href=https://www.facebook.com/'+id_s[0]+'/posts/'+id_s[1]+'/" width="500" height="321" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';
        });
      }
      html += '<input type="hidden" name="account" value="'+account+'"></input>';

      $('#'+div_id).html("");
      $('#'+div_id).append(html);
      $('#account-submit').attr("type", "hidden");
      $('#final-submit').attr("type", "submit");
    }
  });
}

function add_instagram_posts(camp_id, msg, div_id) {
  $.ajax({
    url: SITEURL+'influencer/get_posts',
    type: "POST",
    data: {'cat': 'Instagram', 'msg': msg, 'camp_id': camp_id},
    success: function(data) {
      var html = "";
      if(data.length == 0) {
        html += "<h3>Posts matching your content were not found.</h3>";
      }
      else {
        $.each(data, function(key, value) {
          html += '<div class="col-sm-4">'
          if(value.percentage < 90)
          html += '<input disabled type="radio" class="form-control"> Match percent: '+parseFloat(value.percentage).toFixed(2);
          else
          html += '<input type="radio" class="form-control" name="link" id="link" value="'+value.id+'@'+value.link+'"> Match percent: '+parseFloat(value.percentage).toFixed(2);
          html += '</div>';

          html += '<div class="col-sm-8">';
          html += '<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">';
          html += '<div style="padding:8px;">';
          html += '<div style="background-image: url('+value.image+'); line-height:0; margin-top:40px; padding:50.0% 0; text-align:center; width:100%;">';
          html += '<div style="display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;">';
          html += '</div>';
          html += '</div>';
          html += '<p style=" margin:8px 0 0 0; padding:0 4px;">';
          html += '<a href="'+value.link+'" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">';
          html += value.msg;
          html += '</a>';
          html += '</p>';
          html += '</div>';
          html += '</blockquote>';
          html += '</div>';
        });
      }

      $('#'+div_id).html("");
      $('#'+div_id).append(html);
    }
  });
}

function add_tweets(camp_id, msg, div_id) {
  $.ajax({
    url: SITEURL+'influencer/get_posts',
    type: "POST",
    data: {'cat': 'Twitter', 'msg': msg, 'camp_id': camp_id},
    success: function(data) {
      var html = "";
      if(data.length == 0) {
        html += "<h3>Tweets matching your content were not found.</h3>";
        $('#'+div_id).html(html);
      }
      else {
        $('#'+div_id).html("");
        $.each(data, function(key, value) {
          if(key == 'error' || key == 'count')
          return;
          if(value.percentage < 90)
          html = '<section><input disabled type="radio" class="form-control">Match Percentage: '+parseFloat(value.percentage).toFixed(2)+'</section>';
          else
          html = '<section><input type="radio" class="form-control" name="link" id="link" value="'+value.id+'">Match Percentage: '+parseFloat(value.percentage).toFixed(2)+'</section>';
          html += '<div id="tweet-container-'+key+'"></div>';

          $('#'+div_id).append(html);
          twttr.widgets.createTweet(
            value.id,
            document.getElementById('tweet-container-'+key),
            {
              linkColor: "#55acee"
            }
          );
        });
      }
    }
  });
}

function add_youtube_videos(camp_id, div_id) {
  $.ajax({
    url: SITEURL+'influencer/get_posts',
    type: "POST",
    data: {'cat': 'Youtube', 'camp_id': camp_id},
    success: function(data) {
      var html = "";
      var count = 0;
      $.each(data, function(index, value) {
        if(value.kind == "youtube#video") {
          html += "<br>";
          html += '<div class="col-md-2 col-lg-2 col-sm-2"><input type="radio" class="form-control" name="link" id="link" value="'+value.videoId+'"></div><div class="col-md-10 col-lg-10 col-sm-10"><iframe width="280" height="158" src="https://www.youtube.com/embed/'+value.videoId+'" frameborder="0" allowfullscreen></iframe></div>';
          count = count + 1;
        }
      });
      if(count == 0) {
        html += '<p>You do not have any video in your channel.</p>';
      }

      $('#'+div_id).html("");
      $('#'+div_id).append(html);
    }
  });
}

$(function() {
  var liElement = $('ul.view_camp_category').find('li.active');
  GLOBAL_CATEGORY = $(liElement).find('a').html();

  $('ul.view_camp_category').on('click', function() {
    var liElement = $('ul.view_camp_category').find('li.active');
    GLOBAL_CATEGORY = $(liElement).find('a').html();
    onload();
  });

  $('.nav-clicked-offer').on('click', function() {
    $('#first').css('display', 'block');
    $('#second').css('display', 'none');
    $('#third').css('display', 'none');
  });

  $('.nav-clicked-campaign').on('click', function() {
    $('#first').css('display', 'none');
    $('#second').css('display', 'block');
    $('#third').css('display', 'none');
  });

  $('.nav-clicked-post').on('click', function() {
    $('#first').css('display', 'none');
    $('#second').css('display', 'none');
    $('#third').css('display', 'block');
  });

  FormsWizard.init();
  Dropzone.autoDiscover = false;
  onload();
});

function offer_submit(key) {
  var values = $('#proposal-form'+key).serialize();
  values += '&price='+$('#price'+key).val();
  var url = $('#proposal-form'+key).attr('action');
  $('#proposal-form'+key+' .text-danger').remove();

  swal({
    title: "Are you sure?",
    text: "You are about to make an offer.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    closeOnConfirm: false
  },
  function(y) {
    if(y==true) {
      $.post(url,values,function(data,status){
        //console.log(data);
        if(data.error===false) {
          swal({
            title: "Good job!",
            text: data.msg,
            type: "success",
            confirmButtonText: "Ok",
            closeOnConfirm: true
          },
          function() {
            onload();
          });
        }
        else{
          swal('Error', data.msg, 'error');
        }
      });
    }
  });
}
</script>
