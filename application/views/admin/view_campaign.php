<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<?php
if($camp_data_all) {
  $data = json_encode($camp_data_all);
  print_r("<script type='text/javascript'>
  var CAMP_DATA = {$data};
  </script>");
}
?>
<script type="text/javascript">
var SORT_VAL = 1;
var GLOBAL_CATEGORY = "";
</script>

<!-- Page content -->
<div id="page-content">

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
                    </tbody>
                  </table>
                </div>

              <?php endforeach; ?>
              <hr>

              <div id="table-jquery">
                <div class="text-center">
                  <h2>Actions</h2>
                  <button class="camp-btn btn btn-warning btn-lg" onclick="approve_campaign('<?php echo $_GET['camp_id'] ?>')">Approve</button>
                  <button class="camp-btn btn btn-warning btn-lg" onclick="block_campaign('<?php echo $_GET['camp_id'] ?>')">Block</button>
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
