var body = document.body,
      boxElement = document.querySelector('.good'),
      mainContainer = document.querySelector('.background'),
      back2 = document.querySelector('.last2'),
      images = document.querySelector('.background').children ,
      textchildren = [],
      imageschildren = [],
      imageNumber = 0,
      Left,
      Right,
      scroll = 0;

      function makeText() // cree un tableau contenant les texts
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

      function makeImg() // cree un tableau contenant les texts
      {
          for (var i = 0; i < images.length; i++)
          {
            if(images[i].attributes[0].name == 'class') imageNumber = i;
              imageschildren[i] =
              {
                  element : images[i]
              }
          };
          return imageschildren;
      }
      makeImg();

      function makeText() // cree un tableau contenant les texts
      {
          for (var i = 0; i < images.length; i++)
          {
            if(images[i].attributes[0].name == 'data-position') textchildren[i - (imageNumber + 1)] = {element: images[i]}
          };
          return textchildren;
      }
      makeText();


      function handle( event )
      {
          var e = event;
          requestAnimationFrame( Onscroll.bind( handle,e ) );
      };
      function Onscroll( e )
      {
        var scrollPos = mainContainer.scrollLeft; // the position of the scrollLeft
        if( 200 < scrollPos ){
          textchildren[0].element.classList.add('show')
         }
        if( 1500 < scrollPos ){
           console.log('hello');
           textchildren[1].element.classList.add('show')
         }
        if( 3000 < scrollPos ){
          console.log('hello');
          textchildren[2].element.classList.add('show')
        }
        if( 5000 < scrollPos ){
         console.log('hello');
         textchildren[3].element.classList.add('show')
        }
        if( 6000 < scrollPos ){
          console.log('hello');
          textchildren[4].element.classList.add('show')
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
      };
      mainContainer.addEventListener('mousewheel', handle,false);
      window.addEventListener('mousemove', mouseposition,false);
