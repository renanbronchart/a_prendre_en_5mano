(function() {
  $(document).ready(function() {
    $('.scroll-list').each(function () {
      var $this = $(this);
      var $icon = $this.parents('section').find('.icon-scroll');
      $this.on('scroll', function() {
        if ($this.scrollLeft() >= 50) {
          $icon.fadeOut('fast');
        } else {
          $icon.fadeIn('fast');
        }
      })
    })
  })
})();


