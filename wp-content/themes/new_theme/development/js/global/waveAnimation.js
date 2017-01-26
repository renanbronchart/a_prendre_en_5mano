(function() {
  $(document).on('ready', function() {
      var positionSection = ($('#participation_don').offset()).top;
    $(document).on('scroll', function() {
      var windowScroll = $(window).scrollTop();

      if(windowScroll >= positionSection - 400) {
        $('.welcome').addClass('on');
      }
    })
  })
})();
