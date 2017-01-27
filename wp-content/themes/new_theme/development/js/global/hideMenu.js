$( document ).ready(function() {
var previousScroll = 0,
   headerOrgOffset = $('#header').height();

$('#header-wrap').height($('#header').height());

$(window).scroll(function () {
   var currentScroll = $(this).scrollTop();
   if (currentScroll > headerOrgOffset) {
       if (currentScroll > previousScroll) {
           $('#header-wrap').slideUp();
       } else {
           $('#header-wrap').slideDown();
       }
   } else {
       $('#header-wrap').slideDown();
   }
   previousScroll = currentScroll;
});

});
