   $(document).ready(function () {
      $(".main-carousel").owlCarousel({
         loop: true,
         autoplay: true,
         smartSpeed: 3000,
         autoplayTimeout: 5500,
         items: 1,
         nav: true,
         dots: true,
         dotsEach: true,
      });
   }); 

   $(document).ready(function () {
      $(".master-carousel").owlCarousel({
         loop: true,
         smartSpeed: 500,
         items: 3,
         nav: true,
         margin: 5,
      });
   }); 
