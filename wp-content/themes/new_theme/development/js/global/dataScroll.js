// (function() {
//   var scrollAnimation = function scrollAnimation() {
//     var translateElement = function translateElement($el, speed) {
//       $el.each(function () {
//         var $this = $(this);
//         var dataScroll = ((Number($this.attr('data-scroll'))) / 100);
//         var translateY =  ((dataScroll * (($(window).scrollTop()) / 100)) * (Number(speed))) * 2;

//         $this.css("-webkit-Transform", "translate3d(0," + translateY + 'px, 0)');
//         $this.css("-ms-Transform", "translate3d(0," + translateY + 'px, 0)');
//         $this.css("Transform", "translate3d(0," + translateY + 'px, 0)');
//       })
//     };

//     var init = function init() {
//       $(document).on('scroll', function(e) {
//         $("[data-target-parallax]").each(function () {
//           var $this = $(this);
//           var $elementsParallax = $($this.attr('data-target-parallax'));
//           var scrollTop = ($this.offset()).top;
//           var speed = $this.attr('speed-parallax');

//           if ($(window).scrollTop() >= scrollTop) {
//             translateElement($elementsParallax, speed);
//           }

//         })
//       });
//     };

//     return {init: init}
//   }();

//   scrollAnimation.init();
// })();
