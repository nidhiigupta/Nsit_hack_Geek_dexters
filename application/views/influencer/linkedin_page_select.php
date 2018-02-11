<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript">
var html = "";
var pages = <?php echo $pages?>;
$.each(pages, function(index, value) {
  html += "<option value='"+value.id+"'>"+value.name+"</option>";
});

swal({
  title: "Select your LinkedIn Page",
  text: 'LinkedIn Page: <select id="page_name" class="form-group">'+html+'</select>',
  type: "info",
  html: true,
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Confirm",
  closeOnConfirm: false
},
function(y){
  if(y==true){
    var page_id_selected = $("#page_name").val();
    var url=SITEURL+'influencer/linkedin_page_select';
    $.post(url,{'page_id': page_id_selected},function(data){
      if(data.status === true) {
        $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Congrats!', 'msg': 'Your LinkedIn Page is now linked.', 'type': 'success'});
      }
      else {
        $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': 'Database error.', 'type': 'error'});
      }
    });
  }
  else {
    $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': 'Page not selected.', 'type': 'error'});
  }
});
</script>
