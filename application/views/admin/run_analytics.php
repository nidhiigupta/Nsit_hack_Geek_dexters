<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<link src="<?php echo ASSETS;?>js/jquery.min.js">

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Background Analytics<small>Running</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li>
                <li><a href="#">Settings 2</a></li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">REQUEST CONSOLE</p>
          <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row" id="analytics_data">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">

function analytics_post(analytics_id, camp_id, inf_id, loop_after) {
  var url = SITEURL+'admin/call_analytics';

  $.post(url,{'analytics_id': analytics_id, 'camp_id': camp_id, 'inf_id': inf_id},function(data){
    console.log(data);
    $('#analytics_data').append('[ANALYTICS] Called campaign '+camp_id+' using Influencer '+inf_id+' with Analytics ID '+analytics_id+' will repeat after '+loop_after+' ms<br>');
  });
}

function report_post(report_id, category, loop_after) {
  var url = SITEURL+'admin/call_reports';

  if(category == 'Facebook' || category == 'Instagram' || category == 'Twitter') {
    $.post(url,{'report_id': report_id, 'category': category},function(data){
      $('#analytics_data').append('[REPORT] Called category '+category+' with Report ID '+report_id+' will repeat after '+loop_after+' ms<br>');
    });
  }
}
setInterval(function update_javascript_calls() {
  var url=SITEURL+'admin/get_analytics_javascript';
  $.ajax({
    url: url,
    type: "POST",
    data: {},
    success: function(data) {
      console.log(data);
      if(data.error != 1) {
        $('#javascript_dump').append(data.html);
      }
    }
  });
  return update_javascript_calls;
}(), 10000);

</script>
<div id="javascript_dump">

</div>
