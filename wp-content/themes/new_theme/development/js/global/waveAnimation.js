(function() {
  $(document).ready(function() {
      console.log(positionSection)
      var positionSection = ($('#participation_don').offset()).top;
    $(window).on('scroll', function() {
      var windowScroll = $(window).scrollTop();

      if(windowScroll >= positionSection - 400) {
        $('.welcome').addClass('on');
      }
    })
  })
})();
