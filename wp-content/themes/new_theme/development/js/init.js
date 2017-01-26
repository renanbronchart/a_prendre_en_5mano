var mediaQueries = mediaQueries || {};

(function(mediaQueries) {
  var detectDevice = function detectDevice() {
    if("matchMedia" in window) { // Détection
      if(window.matchMedia("(min-width:768px)").matches) {
        mediaQueries.device = 'desktop';
      } else {
        mediaQueries.device = 'mobile';
      }
    }
  };

  var init = function init() {
    console.log('init');
    detectDevice();

    $(window).on('resize', function () {
      detectDevice();
    });

    $(document).on('ready', function() {
      // $('.contactForm__content').find('style').remove();
    });
  };

  init();
})(mediaQueries);
