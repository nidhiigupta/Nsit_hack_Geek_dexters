<footer id="footer" class="clearfix">
  <div>
    <div>
      <img src="<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/images/logo_header.png" alt="logo footer white">
    </div>
    <div class="footer_menu_wrapper clearfix">
      <ul id="menu-main-menu-1" class="menu">
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="<?php echo SITEURL.'home/about'; ?>">AboutUs</a></li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19"><a href="<?php echo SITEURL.'home/contact'; ?>">Support</a></li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19"><a href="<?php echo SITEURL.'home/privacy'; ?>">Terms Of Use</a></li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19"><a href="<?php echo SITEURL.'home/privacy'; ?>">Privacy</a></li>
      </ul>
    </div>
    <div>
      Copyright © Geek Dexters
    </div>
  </div>
</footer>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>js/code.jquery.com/jquery-1.12.4.minb8ff.js?ver=1.12.4'></script>

<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/plugins/contact-form-7/includes/js/scriptsa288.js?ver=4.8.1'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>js/cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/jquery.matchHeight-minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/mainef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/jquery.jcarousel.minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/jquery.touchSwipe.minef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-content/themes/netfox/js/opinieef15.js?ver=4.8'></script>
<script type='text/javascript' src='<?php echo ASSETS.'new_index/';?>wp-includes/js/wp-embed.minef15.js?ver=4.8'></script>
<!-- sweetalert -->
<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>

<script type="text/javascript">
var width = 100;
var animation_speed = 700;
var time_val = 3000;
var current_slide = 1;

var $slider = $('#slider');
var $slide_container = $('.slides');
var $slides = $('.slide');

var interval;

$slides.each(function(index){
  $(this).css('left',(index*100)+'%');
});

function startSlider() {
  interval = setInterval(function() {
    $slide_container.animate({'left': '-='+(width+'%')}, animation_speed, function() {
      if (current_slide++ === $slides.length) {
        current_slide = 1;
        $slide_container.css('left', 0);
      }
    });
  }, time_val);
}

startSlider();
</script>
<script type="text/javascript">
$(window).scroll(function(){
  var scroll = $(window).scrollTop();
  if (scroll >= 100){
    $(".brandsection").addClass("animated fadeInLeft");
    $(".influencersection").addClass("animated fadeInRight");
  }
})
</script>
</body>
</html>
<script type="text/javascript" src="http://assets.freshdesk.com/widget/freshwidget.js"></script>
<script type="text/javascript">
	FreshWidget.init("", {"queryString": "&widgetType=popup&submitTitle=Send+Query&submitThanks=Thank+you+for+submitting+your+query.", "utf8": "✓", "widgetType": "popup", "buttonType": "text", "buttonText": "Support", "buttonColor": "white", "buttonBg": "#5966DE", "alignment": "2", "offset": "600px", "formHeight": "500px", "url": "https://webassets.freshdesk.com"} );
</script>