// var mediaQueries = mediaQueries || {};

// (function (mediaQueries) {
//   var showTeam = function showTeam() {
//     var showDetails = function showDetails($el) {
//       $('.overlayBlack').addClass('overlayBlack--active');
//       $el.parents('.team__members').addClass('team__members--active');

//       $el.parents('.team__member').removeClass('team__member--active');
//       $el.parents('.team__member').addClass('team__member--active');
//     };

//     var displayDetails = function displayDetails() {
//       $('.overlayBlack').removeClass('overlayBlack--active');
//       $('.team__members').removeClass('team__members--active');

//       $('.team__member').removeClass('team__member--active');
//     };

//     var toggleDetails = function toggleDetails(mediaDevice) {
//       var eventShow = mediaDevice == 'mobile' ? 'click' : 'mouseenter';

//       $('.team__memberPhoto').off('click, mouseenter');
//       $('.team__member').off('mouseleave');
//       $('body').off('click');

//       if (mediaDevice == 'mobile') {
//         $('body').on('click', function(e) {
//           var $target = $(e.target);

//           if ($(e.target).parent('.team__memberPhoto').length && !$('.team__members--active').length) {
//             showDetails($target);

//           } else if ($('.team__members--active').length) {
//             displayDetails();
//           }
//         })

//       } else {

//         $('.team__memberPhoto').on('mouseenter', function() {
//           var $this = $(this);

//           showDetails($this);
//         })

//         $('.team__member').on('mouseleave', function() {
//           displayDetails();
//         })
//       }
//     };

//     var init = function init() {
//       var mediaDevice = mediaQueries.device;

//       toggleDetails(mediaDevice);

//       $(window).on('resize', function() {
//         if (mediaDevice != mediaQueries.device) {
//           mediaDevice = mediaQueries.device;

//           toggleDetails(mediaDevice);
//         }
//       })
//     };

//     return {init: init}
//   }();

//   showTeam.init();
// })(mediaQueries);
