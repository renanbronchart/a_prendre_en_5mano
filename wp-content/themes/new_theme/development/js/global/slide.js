var body = document.body,
      boxElement = document.querySelector('.good'),
      mainContainer = document.querySelector('html'),
      back2 = document.querySelector('.last2'),
      images = document.querySelector('.background').children ,
      textchildren = [],
      imageschildren = [],
      Left,
      Right,
      scroll = 0;

      function makeImg() // cree un tableau contenant les texts
      {
          for (var i = 0; i < images.length; i++)
          {
              imageschildren[i] =
              {
                  element : images[i]
              }
          };
          return false
      }
      makeImg();

      function handle( event )
      {
          var e = event;
          requestAnimationFrame( Onscroll.bind( handle,e ) );
      };
      function Onscroll( e )
      {
          Left = body.scrollLeft, // the position of the scrollLeft
          Right = body.scrollLeft + body.clientWidth; // the position of the scrollRight
          bodyWidth = body.scrollWidth;
          if( e.deltaY ){ // verify if we scroll top to bottom and not left to right ;
              if( e.deltaY > 0)// scroll right
              {
                  if( Right >= bodyWidth ) return; // if you get to the end of the scroll no more action
              };
              if( e.deltaY < 0) // scroll left
              {
                  if( Left <= 0) return; // if you get to the end of the scroll no more action
              };
          }
          return false;
      };
      function mouseposition(event){
          // requestAnimationFrame(mouseE)
          imageschildren[0].element.style.cssText =
          "transform: translate3d(0px,"+ (event.clientY * 0.01) +"px, 0px);transition:0.5s all";
          imageschildren[1].element.style.cssText =
          "transform: translate3d("+ (event.clientX * 0.1) +"px, "+ (event.clientY * 0.1) +"px,0px);transition:0.5s all";
          imageschildren[2].element.style.cssText =
          "transform: translate3d("+ (event.clientX * 0.05) +"px, "+ (event.clientY * 0.1) +"px,0px);transition:0.5s all";
          imageschildren[3].element.style.cssText =
          "transform: translate3d(-"+ (event.clientX * 0.1) +"px, "+ (event.clientY * 0.01) +"px,0px);transition:0.5s all";
          imageschildren[4].element.style.cssText =
          "transform: translate3d("+ (event.clientX * 0.1) +"px, "+ (event.clientY * 0.1) +"px,0px);transition:0.5s all";
          imageschildren[5].element.style.cssText =
          "transform: translate3d("+ (event.clientX * 0.2) +"px, "+ (event.clientY * 0.01) +"px,0px);transition:0.5s all";
          imageschildren[6].element.style.cssText =
          "transform: translate3d("+ (event.clientX * 0.2) +"px, "+ (event.clientY * 0.01) +"px,0px);transition:0.5s all";
      }
      window.addEventListener('mousewheel', handle,false);
      window.addEventListener('mousemove', mouseposition,false);
