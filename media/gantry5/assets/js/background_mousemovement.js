var scrollFollowY = 0,
    y = 0,
    friction = 1/4;
var current_tick = 0

function moveBackground() {
  y = (scrollFollowY) * friction;
  jQuery('.parallax-background').css({
    'background-position-y': y + 'px'
  });
  var height = jQuery('#g-header').height();
  var scaleRate = (height-scrollFollowY/3)/height;
  jQuery(".header-info-block").css({
    'transform': 'translateY('+ y/10 +'em)'
  });
  window.requestAnimationFrame(moveBackground);
}

function init(){
    jQuery(document).scroll(function(e) {
      var scrollY = jQuery(document).scrollTop();
      scrollFollowY = scrollY; 
    });
}

moveBackground();

init();
