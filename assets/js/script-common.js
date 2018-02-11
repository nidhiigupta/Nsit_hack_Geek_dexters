function approve_campaign(x) {
  swal({
    title: "Are you sure?",
    text: "You are about to approve the campaign, are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    closeOnConfirm: false
  },
  function(y){
    if(y==true){
      $.post(SITEURL+'admin/approve_campaign/'+x,{},function(data,status){
        swal("Approved!", 'The campaign was Approved', "success");
        sort_campaigns();
      });
    }
  });
}
function block_campaign(x) {
  swal({
    title: "Are you sure?",
    text: "You are about to block the campaign, are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    closeOnConfirm: false
  },
  function(y){
    if(y==true){
      $.post(SITEURL+'admin/block_campaign/'+x,{},function(data,status){
        swal("Approved!", 'The campaign was Blocked', "success");
        sort_campaigns();
      });
    }
  });
}

function view_campaign_admin(camp_id) {
  var url=SITEURL+'admin/view_campaign';
  $.redirect(url, {'camp_id': camp_id}, "GET");
}

$('#admin-registration-form').on('submit',function(e){
  e.preventDefault();
  var ele=$('#admin-registration-form');
  var values=ele.serialize();
  var url=ele.attr('action');
  $.post(url,values,function(data,status){
    if(data.status==true){
      swal({
        title: "Success",
        text: data.msg,
        type: "success",
        confirmButtonText: "Ok",
        closeOnConfirm: false
      },
      function(){
        window.location.replace(SITEURL+"admin");
      });
    }
    else{
      $.each(data,function(key,value){
        if(value) {
          swal({
            title: "Error!",
            text: value,
            type: "error",
            html: true
          });
        }

      });
    }
    if(data.custom){
      swal('OOPs!',data.custom,'error');
    }
  });
});
$('#profile-form').on('submit',function(e){
  e.preventDefault();
  var ele=$('#profile-form');
  var values=ele.serialize();
  var url=ele.attr('action');
  $.post(url,values,function(data,status) {
  });
});
$('#bank-details-form').on('submit',function(e){
  e.preventDefault();
  var ele=$('#bank-details-form');
  var values=ele.serialize();
  var url=ele.attr('action');
  $('#bank-details-form div.text-danger').remove();
  $.post(url,values,function(data,status){
    if(data.error===false){
      ele[0].reset();
      swal("Good job!", data.msg, "success");
      location.reload();
    }else{
      $.each(data ,function(index,value){
        $('input[name="'+index+'"]').after(value);
      });
    }

  });
});

$('#advanced-wizard').on('submit',function(e){
  swal("Please wait", "Creating Campaign...", "info");
  e.preventDefault();
  var ele=$('#advanced-wizard');
  var uri=ele.attr('action');
  $.ajax({
    url:uri, // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData:false,        // To send DOMDocument or non processed data file it is set to false
    success: function(data) {
      if(data.status==true){
        ele[0].reset();
        $('#campaign-modal').modal('toggle');
        swal({
          title: "Good job!",
          text: 'Campaign is submitted for review. It will be live after approval.',
          type: "success",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ok",
          closeOnConfirm: false
        },
        function(y){
          $.redirect(SITEURL+'brand/campaigns/all');
        });
      }
      else{
        if(typeof(data.form_errors)==='object'){
          var html='';
          $.each(data.form_errors, function( key, value ) {
            html=html+value;
          });
          swal({
            title: "<h2>Error!</h2>",
            text: html,
            html: true,
            type: "error"
          });
        }
        else{
          swal({
            title: "<h2>Error!</h2>",
            text:data.error,
            html: true,
            type: "error"
          });
        }
      }
    }
  });
});

$('#update-profile-form').on('submit',function(e){
  e.preventDefault();
  var ele=$('#update-profile-form');
  var uri=ele.attr('action');
  $.ajax({
    url:uri, // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData:false,        // To send DOMDocument or non processed data file it is set to false
    success: function(data)   // A function to be called if request succeeds
    {
      //console.log(data);
      if(data.status==true){
        ele[0].reset();
        $('#profile-update-modal').modal('toggle');
        swal({
          title: "Good job!",
          text: data.msg,
          type: "success"
        },
        function(y){
          $.redirect(SITEURL+'brand/profile');
        });
      }
      else{
        if(typeof(data.form_errors)==='object'){
          var html='';
          $.each(data.form_errors, function( key, value ) {
            html=html+value;
          });
          swal({
            title: "<h2>Error!d</h2>",
            text: html,
            html: true,
            type: "error"
          });
        }
        else{
          swal({
            title: "<h2>Error!</h2>",
            text:data.error,
            html: true,
            type: "error"
          });
        }
      }
    }
  });
});
// both for influencer and admin
$('#update-profile-form-inf').on('submit',function(e){
  e.preventDefault();
  var ele=$('#update-profile-form-inf');
  var uri=ele.attr('action');
  $.ajax({
    url:uri, // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData:false,        // To send DOMDocument or non processed data file it is set to false
    success: function(data) {
      if(data.status==true){
        ele[0].reset();
        $('#profile-update-modal').modal('toggle');
        swal({
          title: "Good job!",
          text: data.msg,
          type: "success"
        },
        function(y){
          $.redirect(SITEURL+'influencer/profile');
        });
      }
      else{
        if(typeof(data.form_errors)==='object'){
          var html='';
          $.each(data.form_errors, function( key, value ) {
            html=html+value;
          });
          swal({
            title: "<h2>Error!d</h2>",
            text: html,
            html: true,
            type: "error"
          });
        }
        else{
          swal({
            title: "<h2>Error!</h2>",
            text:data.error,
            html: true,
            type: "error"
          });
        }
      }
    }
  });
});

function set_approval(id, val, brand_id, pro_by) {
  var url=SITEURL+'brand/set_approval';
  var text = "";
  var text2 = "";

  if(val==-1) {
    text = "You will be redirected to chat page where you have to explain Influencer about the changes.";
    text2 = "Ok";
  }
  else {
    text = "Are you sure?";
    text2 = "Yes";
  }
  swal({
    title: "Are you sure?",
    text: text,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: text2,
    cancelButtonText: "Cancel",
    closeOnConfirm: true,
    closeOnCancel: true
  },
  function(isConfirm){
    if (isConfirm) {
      $.ajax({
        url:url,
        type: "POST",
        data: {'approve_id':id, 'value':val},
        success: function(data) {
          if(val==-1) {
            open_chat(brand_id, pro_by, 1);
          }
          else {
            swal({
              title: "Success!",
              text: "Task done.",
              type: "success",
              confirmButtonText: "Ok"
            },
            function(y){
              onload();
            });
          }
        }
      });
    }
    else {
    }
  });
}

function view_offer(pro_name, pro_price, pro_msg, currency) {
  swal({
    title: "Offer: <strong>"+pro_price+" "+currency+"</strong>",
    text: "<strong>Offer by: "+pro_name+"</strong><br>"+pro_msg,
    type: "info",
    confirmButtonColor: "#DD6B55",
    html: true
  });
}

function set_offer(id, val) {
  var url=SITEURL+'brand/set_offer';
  swal({
    title: "Warning!",
    text: "Are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    cancelButtonText: "No",
    closeOnConfirm: true,
    closeOnCancel: true
  },
  function(isConfirm){
    if (isConfirm) {
      $.ajax({
        url:url,
        type: "POST",
        data: {'pro_id':id, 'approval':val},
        success: function(data) {
          if(val == 1) {
            swal({
              title: "Confirm again!",
              text: data.pro_price+" INR (+tax) will be deducted from your wallet. After you accept, Influencer will share content with you.",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Continue",
              cancelButtonText: "Cancel",
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm){
              if (isConfirm) {
                $.redirect(SITEURL+'brand/accept_offer', {'pro_id': id}, "POST");
              }
            });
          }
          else {
            swal({
              title: "Success!",
              text: "Task done.",
              type: "success",
              confirmButtonText: "Ok"
            },
            function(y){
              onload();
            });
          }
        }
      });
    }
    else {
    }
  });
}

function view_approval(id) {
  var url=SITEURL+'brand/get_values';
  var html= "";

  $.ajax({
    url:url,
    type: "POST",
    data: {'approve_id':id, 'req': 'approval'},
    success: function(data) {
      $('#campaign-modal-view').modal('toggle');
      var obj = data[0];
      $('#campaign-modal-view-title').html(obj.name);
      $('#campaign-modal-view-img').attr('src', obj.image);
      $('#approve_brand_view').html("");
      if(obj.video) {
        $('#approve_brand_view').append('<h4 class="text-center">Campaign Content</h4>');
        html += '    <video id="my-video" class="video-js" controls preload="auto" data-setup="{}">';
        html += '      <source src="'+obj.video+'" type="video/mp4">';
        html += '      <p class="vjs-no-js">';
        html += '        To view this video please enable JavaScript, and consider upgrading to a web browser that';
        html += '        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>';
        html += '      </p>';
        html += '    </video>';
        $('#approve_brand_view').append(html);
      }
      else {
        $('#approve_brand_view').append('<h4 class="text-center">Campaign Content</h4>');
        $('#approve_brand_view').append(obj.content);
      }
    }
  });
}

function view_campaign_brand(camp_id) {
  var url=SITEURL+'brand/view_campaign';
  $.redirect(url, {'camp_id': camp_id}, "GET");
}

function open_chat(brand_id, inf_id, cat) {
  if(cat == 0) {
    url=SITEURL+'influencer/chat';
  }
  else {
    url=SITEURL+'brand/chat';
  }

  var form = $('<form action="' + url + '" method="post">' +
  '<input type="text" name="brand_id" value="' + brand_id + '" />' +
  '<input type="text" name="inf_id" value="' + inf_id + '" />' +
  '<input type="text" name="cat" value="' + cat + '" />' +
  '</form>');
  $('body').append(form);
  form.submit();
}

function view_campaign(camp_id) {
  url=SITEURL+'influencer/view_campaign';
  $.redirect(url, {'camp_id': camp_id}, "GET");
}

// Campaign suspend
function suspend_campaign(x) {
  swal({
    title: "Are you sure?",
    text: "You are about to suspend the campaign, are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    closeOnConfirm: false
  },
  function(y){
    if(y==true){
      $.post(SITEURL+'brand/'+x,{},function(data,status){
        swal("Suspended!", 'The campaign was Suspended', "success");
        sort_campaigns();
      });
    }
  });
}

function view_analytic(id, cat, inf_id) {
  if(cat==1)
  var str='brand';
  else
  var str='influencer';

  var url=SITEURL+str+'/analytics_check';
  $.ajax({
    url:url,
    type: "POST",
    data: {'camp_id':id, 'inf_id': inf_id},
    success: function(data) {
      if(data.error == true) {
        swal("Error!", "User hasn't posted the campaign yet", "warning");
      }
      else{
        swal({
          title: "<strong>Analytics</strong>",
          text: "<strong> Camp Category:</strong> "+data.cat+"<br><br><strong> Camp Type:</strong> "+data.camp_type+"<br><br><strong> Number of "+data.camp_type+" Required :</strong> "+data.number_of+ "<br><br><strong>Number of "+data.camp_type+" Achived : </strong>"+Math.floor((parseInt(data.percent_completion)*parseInt(data.number_of))/parseInt(100))+"<br><br><strong>Percentage Complete : </strong>"+data.percent_completion+"%",
          type: "info",
          confirmButtonColor: "#DD6B55",
          html: true
        });
      }
    }
  });
}

//campaign sort
$('document').ready(function() {
  $('ul.camp-nav-pills').find('li a').click(function(){
    $('ul.camp-nav-pills li').removeClass();
    $(this).parent('li').addClass('active');
    if (typeof sort_campaigns === "function") {
      sort_campaigns();
    }
  });
});
