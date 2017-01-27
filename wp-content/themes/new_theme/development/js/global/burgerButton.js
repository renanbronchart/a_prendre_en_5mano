$( document ).ready(function() {

   $('.btn-navigation').click(function(){
        $(this).find('.barre').hide();
        $('#close').show();
        $('.navigation').toggleClass('isOpen');
   });

    $('#close').click(function(){
        $('.navigation').removeClass('isOpen');
        $(this).hide();
        $('.barre').show();
    });

    /*$('.btn-navigation').click(function(){
        $(this).find('.barre').toggleClass('white');
        $('.navigation').toggleClass('isOpen');
     });*/

});