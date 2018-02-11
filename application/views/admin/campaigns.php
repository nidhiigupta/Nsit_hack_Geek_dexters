<div id="page-content">
  <!-- Media Widgets Header -->
  <div class="content-header">
    <div class="header-section">
      <h1>
        <i class="gi gi-film"></i>Campaigns <br><small>Admin</small>
      </h1>
    </div>
  </div>
  <!-- END Media Widgets Header -->
  <!-- Simple Widgets with Icons Row -->

    <div class="content-header">
      <ul class="nav-horizontal text-center nav-pills-category">
        <li class="active"><a href="javascript:void(0)"><i class="fa fa-folder-open"></i>All</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i>Facebook</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i>Twitter</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i>Instagram</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-youtube"></i>YouTube</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i>LinkedIn</a></li>
      </ul>
    </div>

    <div class="row campaigns" >
      <!--Let jQuery do it-->
    </div>

</div>
<!-- END Page Content -->

<script type="text/javascript">
var siteurl="<?php echo SITEURL?>";
var assets="<?php echo ASSETS?>";
window.onload=sort_campaigns;

$(function() {
  $('ul.nav-pills-category').find('li a').click(function(){
    $('ul.nav-pills-category li').removeClass();
    $(this).parent('li').addClass('active');
    if (typeof sort_campaigns === "function") {
      sort_campaigns();
    }
  });
});

function sort_campaigns(){
  var segment = '<?php print($this->uri->segment(3)); ?>';
  var url=siteurl+"admin/campaigns_ajax";
  var val=$('#camp_type').val();

  var category=$('ul.nav-pills-category').find('li.active').text();
  $.post(url,{type:val, cat:category, seg:segment},function(data) {
    if(data!=false){
      $('.campaigns').html('<h3 class="text-center text-success">Camapigns whose category is <i class="text-danger">'+category+'</i></h3>');
      $.each(data, function(key, obj) {
        var html='<div class="col-sm-6 col-md-3">';
        html+='  <div class="widget">';
        html+='    <div class="widget-advanced" style="border: 2px solid #1BBAE1;border-radius: 5px;">';
        html+='      <div class="widget-header text-center themed-background-dark" style="height: 220px; background-image: url('+assets+obj.camp_image+');';
        html+=' background-size: cover;">';
        html+='      </div>';
        var desp;
        if(obj.desp.length > 46) {
          desp = obj.desp.slice(0, 46);
          desp = desp.concat(' ...');
        }
        else {
          desp = obj.desp;
        }
        var category_html = "";
        $.each(obj.total_camp_category.split('|'), function(key, value) {
          if(value == 'Facebook')
          category_html += '<span class="fa fa-facebook"></span>  ';
          else if(value == 'Twitter')
          category_html += '<span class="fa fa-twitter"></span>  ';
          else if(value == 'Instagram')
          category_html += '<span class="fa fa-instagram"></span>  ';
          else if(value == 'Youtube')
          category_html += '<span class="fa fa-youtube"></span>  ';
          else if(value == 'LinkedIn')
          category_html += '<span class="fa fa-linkedin"></span>  ';
        });
        html+='      <div class="widget-main" style="padding: 10px 15px 15px">';
        html+='        <div class="row text-center animation-fadeIn">';
        html+='          <div class="col-12">';
        html+='        <h3 class="widget-content-light">';
        html+='          <a href="javascript:void(0);" class="themed-color">'+obj.camp_name+'</a><br>';
        html+='        </h3>';
        html+='            <h3><small>'+desp+'</small></h3>';
        html+='          </div>';
        html+='          <div class="col-xs-4"><h3><small style="color:black;">'+obj.total_price+" "+obj.camp_price_currency+'</small><br><small><b>Price</b></small></h3></div>';
        html+='          <div class="col-xs-4"><h3><small style="color:black;">'+category_html+'</small><br><small><b>Category</b></small></h3></div>';
        html+='          <div class="col-xs-4"><h3><small><button type="button" class="btn btn-primary" onclick="view_campaign_admin('+obj.id+')">VIEW</button>';
        html+='        </div>';
        html+= '<div class="col-sm-12">'
        var temp = '';
        html+='<button class="camp-btn btn btn-warning" onclick="approve_campaign('+obj.id+')">Approve</button> ';
        html+='<button class="camp-btn btn btn-warning" onclick="block_campaign('+obj.id+')">Block</button>';
        html+= '</div>';
        html+='      </div>';
        html+='    </div>';
        html+='  </div>';
        html+='</div>';
        $('.campaigns').append(html);
      });
    }
    else {
      $('.campaigns').html('<h3 class="text-center text-success">There are no camapigns whose category is <i class="text-danger">'+category+'</i></h3>');
    }
  });
}
</script>
<script type="text/javascript">


</script>
