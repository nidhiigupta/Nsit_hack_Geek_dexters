<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<?php
if($camp_data_all) {
  $data = json_encode($camp_data_all);
  print_r("<script type='text/javascript'>
  var CAMP_DATA = {$data};
  </script>");
}
if($this->input->get('status') == 'success') {
  ?>
  <script type='text/javascript'>
  swal({
    title: "Success!",
    text: "The transaction was successful.",
    type: "success",
    confirmButtonText: "Ok"
  },
  function(y){
    $.redirect(SITEURL+'brand/view_campaign', {'camp_id': '<?php echo $camp_data_all[0]['id'] ?>'}, "GET");
  });
  </script>
  <?php
}
else if($this->input->get('status') == 'failed') {
  ?>
  <script type='text/javascript'>
  swal({
    title: "Failed!",
    text: "The transaction was not successful.",
    type: "error",
    confirmButtonText: "Ok"
  },
  function(y){
    $.redirect(SITEURL+'brand/view_campaign', {'camp_id': '<?php echo $camp_data_all[0]['id'] ?>'}, "GET");
  });
  </script>
  <?php
}
?>
<script type="text/javascript">
var SORT_VAL = 1;
var GLOBAL_CATEGORY = "";
</script>

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
              <div id="table-jquery">

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

<div class="row">
  <div  id="campaign-modal-view" class=" modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="campaign-modal-view-title" class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-4">
              <img id="campaign-modal-view-img" src="#" class="img-responsive">
            </div>
            <div class="col-sm-8">
              <div id="approve_brand_view">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo ASSETS.'proui/' ?>js/pages/tablesDatatables.js"></script>

<script type="text/javascript">

$(function() {
  var liElement = $('ul.view_camp_category').find('li.active');
  GLOBAL_CATEGORY = $(liElement).find('a').html();

  $('ul.view_camp_category').on('click', function() {
    var liElement = $('ul.view_camp_category').find('li.active');
    GLOBAL_CATEGORY = $(liElement).find('a').html();
    onload();
  });

  onload();
});

function onload() {
  var url=SITEURL+'brand/get_offers_approvals';
  var html = [];
  var global_category = GLOBAL_CATEGORY;
  var key = -1;

  for(var camp_data of CAMP_DATA) {
    key++;
    if(camp_data.camp_category !== global_category) {
      continue;
    }
    else {
      var camp_id = camp_data.camp_id;

      $.ajax({
        url:url,
        type: "POST",
        data: {'range':global_category, 'camp_id':camp_id, 'sort_val': SORT_VAL, 'camp_category': camp_data.camp_category},
        success: function(data) {
          var offer = data.offers;
          var campaign = data.campaign;

          html[key] = "";
          if(offer.length == 0) {
            html[key] += '<div class="alert alert-info alert-dismissible fade in" role="alert">';
            html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            html[key] += '  <h4 class="text-center" style="height: 5px">No Offer requests.</h4>';
            html[key] += '</div>';
          }
          else {
            html[key] += '<div class="table-responsive">';
            html[key] += '  <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">';
            html[key] += '  <thead>';
            html[key] += '    <tr>';
            html[key] += '      <th style="width: 1%">#</th>';
            html[key] += '      <th>~</th>';
            html[key] += '      <th>Influencer</th>';
            html[key] += '      <th style="width: 9%">Project Progress</th>';
            html[key] += '      <th style="width: 15%">Status</th>';
            html[key] += '      <th style="width: 20%">Offer/Campaign</th>';
            html[key] += '      <th style="width: 15%">Action</th>';
            html[key] += '      <th style="width: 15%">Extra</th>';
            html[key] += '    </tr>';
            html[key] += '  </thead>';
            html[key] += '  <tbody>';

            var j = 0;
            for(var i = 0; i < offer.length; i++) {
              var obj = offer[i];
              var proposal = obj.proposal_data;

              var campaign_obj = {'error': '1'};
              $.each(campaign, function(index, value) {
                if(value.pro_id == obj.pro_id) {
                  campaign_obj = value;
                  campaign_obj.error = 0;
                }
              });

              if(obj.approval != -2) {
                j = j+1;
                html[key] += '<tr>';
                html[key] += '  <td>'+j+'.</td>';
                html[key] += '  <td id="inf_id_'+obj.inf_id+'_i">';
                html[key] += '    <img src="'+obj.image+'" class="avatar" alt="avatar" style="width: 50px">';
                html[key] += '  </td>';
                html[key] += '  <td id="inf_id_'+obj.inf_id+'_n">';
                html[key] += '    <p style="margin: 0 10px;"><a target="_blank" href="'+SITEURL+'view_profile/influencer?id='+obj.inf_id+'">' + obj.name + '</a></p>';
                html[key] += '    <small>Member since '+obj.created.substr(0, 10)+'</small>';
                html[key] += '  </td>';
                html[key] += '  <td class="project_progress">';
                html[key] += '    <div class="progress progress_sm">';
                var percent_completion = parseFloat(obj.complete);
                percent_completion = Number((percent_completion).toFixed(2));
                if(percent_completion>75) {
                  html[key] +=  '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+percent_completion+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent_completion+'%">'+percent_completion+'%</div>';
                }
                else if(percent_completion>50){
                  html[key] += '<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'+percent_completion+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent_completion+'%">'+percent_completion+'%</div>';
                }
                else{
                  html[key] += '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'+percent_completion+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent_completion+'%">'+percent_completion+'%</div>';
                }
                html[key] += '    </div>';
                html[key] += '    <small>'+percent_completion+'% Complete</small>';
                html[key] += '  </td>';
                html[key] += '  <td>';
                html[key] += '<div>'
                html[key] += '    <small>Offer: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>';
                if(obj.approval == 0)
                html[key] += '    <button type="button" class="btn btn-info btn-xs">Pending</button>';
                else if(obj.approval == 1)
                html[key] += '    <button type="button" class="btn btn-success btn-xs">Accepted</button>';
                else if(obj.approval == -1)
                html[key] += '    <button type="button" class="btn btn-danger btn-xs">Rejected</button>';
                html[key] += '</div>';
                html[key] += '<div>'
                html[key] += '    <small>Campaign: </small>';
                if(campaign_obj.error == 1) {
                  html[key] += '<button type="button" class="btn btn-xs">No Request</button>';
                }
                else if(campaign_obj.value == -2) {
                  html[key] += '<button type="button" class="btn btn-danger btn-xs">Rejected</button>';
                }
                else {
                  if(campaign_obj.value == 0)
                  html[key] += '<button type="button" class="btn btn-info btn-xs">Pending</button>';
                  else if(campaign_obj.value == 1)
                  html[key] += '<button type="button" class="btn btn-success btn-xs">Accepted</button>';
                  else
                  html[key] += '<button type="button" class="btn btn-warning btn-xs">Requested edit</button>';
                }
                html[key] += '</div>';

                html[key] += '  </td>';
                html[key] += '  <td>';
                if(campaign_obj.error == 1) {
                  html[key] += '<div>';
                  html[key] += '    <small><strong>Offer: '+proposal.pro_price+' '+camp_data.camp_price_currency+'<strong></small>';
                  html[key] += '    <a class="btn btn-primary btn-xs" onclick="view_offer(\''+proposal.pro_name+'\', \''+proposal.pro_price+'\', \''+proposal.pro_msg+'\', \''+camp_data.camp_price_currency+'\'); return false;"><i class="fa fa-folder"></i> View Offer</a>';
                  html[key] += '</div>';
                }

                html[key] += '<div>'
                if(!campaign_obj.error && campaign_obj.value != -2) {
                  html[key] += '<small>Campaign: </small>';
                  if(obj.approval == 1)
                  html[key] += '<a class="btn btn-primary btn-xs" onclick="view_approval(\''+campaign_obj.approve_id+'\'); return false;"><i class="fa fa-folder"></i> Content</a>';
                  else
                  html[key] += '<a class="btn btn-primary btn-xs" onclick="view_approval(\''+campaign_obj.approve_id+'\'); return false;"><i class="fa fa-folder"></i> Approved Content</a>';
                }
                html[key] += '</div>';

                html[key] += '  </td>';
                html[key] += '  <td>';
                html[key] += '<div>';
                if(obj.approval == 0) {
                  html[key] += '<a class="btn btn-success btn-xs" onclick="set_offer(\''+obj.pro_id+'\', 1); return false;"><i class="fa fa-check"></i> Accept</a>';
                  html[key] += '<a class="btn btn-warning btn-xs" onclick="set_offer(\''+obj.pro_id+'\', -1); return false;"><i class="fa fa-close"></i> Reject</a>';
                }
                if(obj.approval != 1) {
                  html[key] += '<a class="btn btn-danger btn-xs" onclick="set_offer(\''+obj.pro_id+'\', -2); return false;"><i class="fa fa-trash-o"></i> Delete</a>';
                }
                else {
                  html[key] += '<a disabled class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
                }
                html[key] += '</div>';
                html[key] += '<div>';
                if(!campaign_obj.error) {
                  if(campaign_obj.value == 0) {
                    html[key] += '<a class="btn btn-success btn-xs" onclick="set_approval(\''+campaign_obj.approve_id+'\', 1, '+obj.brand_id+', '+obj.pro_by+'); return false;"><i class="fa fa-check"></i> Accept</a>';
                    html[key] += '<a class="btn btn-warning btn-xs" onclick="set_approval(\''+campaign_obj.approve_id+'\', -1, '+obj.brand_id+', '+obj.pro_by+'); return false;"><i class="fa fa-close"></i> Request Edit</a>';
                  }
                }
                html[key] += '</div>';
                html[key] += '  </td>';
                html[key] += '  <td>';
                html[key] += "    <a class='btn btn-info btn-xs' onclick='open_chat("+obj.brand_id+","+obj.pro_by+", 1); return false;'><i class='fa fa-envelope'></i> Message "+ obj.name +"</a>";
                html[key] += '    <button type="button" class="btn btn-info btn-xs" onclick="view_analytic('+campaign_obj.camp_id+', 1, '+obj.inf_id+');"><i class="fa fa-bar-chart"></i> View Analytics</button>';
                html[key] += '  </td>';
                html[key] += '</tr>';
              }
            }
            if(j == 0) {
              html[key] += '<div class="alert alert-info alert-dismissible fade in" role="alert">';
              html[key] += '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
              html[key] += '  <h4 class="text-center" style="height: 5px">No Offer requests.</h4>';
              html[key] += '</div>';
            }
            html[key] += '  </tbody>';
            html[key] += '</table>';
            html[key] += '</div>';
          }

          $('#table-jquery').html('');
          $('#table-jquery').html(html[key]);
          TablesDatatables.init();
        }
      });
    }
  }
}

function sort_offers() {
  var val = $('#sort_offers_val').val();
  if(val == 'offer_asc')
  SORT_VAL = 1;
  else if(val == 'offer_desc')
  SORT_VAL = 2;
  else if(val == 'followers_asc')
  SORT_VAL = 3;
  else if(val == 'followers_desc')
  SORT_VAL = 4;
  onload();
}
</script>
