$(document).on("submit","#contact-us-form",function(est){
    est.preventDefault();
    $('.text-danger').remove( );
    var ele = $('#contact-us-form');
    var data = ele.serialize();
    var url = ele.attr('action');
    $.ajax({
        data : data,
        url : url,
        method: 'POST'
    }).done(function(getdata){
        if (getdata.status == true) {
            ele[0].reset();
            swal("Good job!", getdata.msg, "success");
            $('#contact-modal').modal('toggle');
        } else {
            if( typeof getdata.errors === 'object' ) {
                $.each(getdata.errors, function(key, val) {
                    $('#contact-us-form textarea[name='+key+']').parent().after(val);
                    $('#contact-us-form input[name='+key+']').parent().after(val);

                });
            } else {
                swal("Oops..!", getdata.errors, "error")
            }
        }
    });
});

$(document).ready(function(){       
    var scroll_start = 0;
    var startchange = $('nav');
    var offset = startchange.offset();
    $(document).scroll(function() { 
        scroll_start = $(this).scrollTop();
        if(scroll_start > offset.top) {
            $('nav').css('background-color', 'rgba(34,34,34,0.95)');
        } else {
            $('nav').css('background-color', 'transparent');
        }
    });
});

$(document).ready(function(){
    // set up hover panels
    // although this can be done without JavaScript, we've attached these events
    // because it causes the hover to be triggered when the element is tapped on a touch device
    $('.hover').hover(function(){
        $(this).addClass('flip');
    },function(){
        $(this).removeClass('flip');
    });
});