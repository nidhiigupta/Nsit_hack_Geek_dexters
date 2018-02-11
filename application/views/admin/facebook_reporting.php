<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript">
var html = "";
var pages = JSON.parse('<?php echo $pages?>');
//console.log(pages);
$.each(pages, function(index, value) {
  html += "<option value='"+value.id+"'>"+value.name+"</option>";
});

swal({
  title: "Select your Facebook Page",
  text: 'Facebook Page: <select id="page_name" class="form-group">'+html+'</select>',
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
    var url=SITEURL+'admin/add_report'
    $.post(url,{'cat': 'Facebook', 'page_id': page_id_selected},function(data,status){
      if(data.error == 0) {
        swal({
          title: "Success",
          text: 'Facebook page selected',
          type: "success",
          html: true,
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ok",
          closeOnConfirm: true
        },
        function(y){
          $.redirect(SITEURL+'admin/reporting');
        });
      }
      else {
        swal("Error!", "Database error", 'error');
      }
    });
  }
  else {
    $.redirect(SITEURL+'admin/reporting');
  }
});
</script>
