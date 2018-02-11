<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript">
var channels = <?php echo $channels; ?>;
var html = "";
var url=SITEURL+"influencer/youtube_channel_select";
$.each(channels, function(index, value) {
  html += "<option id='"+value.id+"' value='"+value.id+"&"+value.subscriberCount+"'>"+value.title+"</option>";
});

swal({
  title: "Select your Youtube Channel",
  text: 'YouTube Channel: <select id="yt_channel_name" class="form-group">'+html+'</select>',
  type: "info",
  html: true,
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Confirm",
  closeOnConfirm: false
},
function(y){
  if(y==true){
    var extra = $("#yt_channel_name").val().split('&');
    var url=SITEURL+"influencer/youtube_channel_select";
    $.post(url,{'yt_id': extra[0], 'yt_followers': extra[1], 'channel_name': $('#'+extra[0]).html()},function(data){
      if(data.status==true){
        $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Congrats!', 'msg': 'Your Youtube Channel is now linked.', 'type': 'success'});
      }
      else{
        $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': 'Database Error!', 'type': 'error'});
      }
    });
  }
  else {
    $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': 'Something went wrong!', 'type': 'error'});
  }
});
</script>
