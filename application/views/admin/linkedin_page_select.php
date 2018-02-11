<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script type="text/javascript">
var html = "";
var pages = <?php echo $pages?>;
$.each(pages, function(index, value) {
  html += "<option id='"+value.id+"' value='"+value.id+"'>"+value.name+"</option>";
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
    var page_name = $('#'+page_id_selected).html();
    var url=SITEURL+'admin/add_report';
    $.redirect(url, {'cat': 'LinkedIn', 'id': page_id_selected, 'name': page_name});
  }
  else {
    $.redirect(SITEURL+'admin');
  }
});
</script>
