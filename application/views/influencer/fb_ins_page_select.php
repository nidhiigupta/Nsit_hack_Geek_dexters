<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript">
var html = "";
var pages = JSON.parse('<?php echo $pages?>');
//console.log(pages);
$.each(pages, function(index, value) {
  html += "<option value='"+value.ins_id+"'>"+value.ins_username+"("+value.name+")"+"</option>";
});

swal({
  title: "Select your Instagram Account",
  text: 'Instagram Account: <select id="page_name" class="form-group">'+html+'</select>',
  type: "info",
  html: true,
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Confirm",
  closeOnConfirm: false
},
function(y){
  if(y==true){
    var account_id_selected = $("#page_name").val();
    var url=SITEURL+'influencer/fb_ins_page_select';
    $.post(url,{'account_id': account_id_selected},function(data,status){
      if(data) {
        if(!data.error) {
          $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Congrats!', 'msg': 'Your Instagram account is now linked.', 'type': 'success'});
        }
        else {
          $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': data.msg, 'type': 'error'});
        }
      }
      else {
        $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': 'Database error.', 'type': 'error'});
      }
    });
  }
  else {
    $.redirect(SITEURL+'influencer/profile', {'swal': 1, 'title': 'Error!', 'msg': 'Instagram account not selected.', 'type': 'error'});
  }
});
</script>
