jQuery(function($) {
  "use strict";  	  
 
 /* ----------------------------------------------------------- */
   /*  Header Fixed on Scroll
   /* ----------------------------------------------------------- */
$(window).on('scroll', function(){

        if( $(window).scrollTop()>40 ){

        $('.navbar').addClass('main-nav-fixed animated fadeInDown');
        } 
        else {

        $('.navbar').removeClass('main-nav-fixed animated fadeInDown');

        }

    }); 
 /* -------------- End -------------------------------*/ 	
 
/* ----------------------------------------------------------- */
  /*  Scroll Top
  /* ----------------------------------------------------------- */	
$(window).scroll(function(){
		// scroll to top visible function
		if ($(window).scrollTop() > $(window).height()/2){
			$('.scroll_to_top').fadeIn();
		}
		else {
			$('.scroll_to_top').fadeOut();
		}
	});
	$('.scroll_to_top').click(function(){
		$('html, body').animate({scrollTop: 0},800);
});
/* -------------- End -------------------------------*/	

$('.main-slider').slick({
  dots: false,
  arrows:true,
  autoplay: true,
  autoplaySpeed: 5000
});

/*------------------Media Slider-------*/
$(".instagram-slider").slick({
  speed: 5000,
  pauseOnHover:false,
  autoplay: true,
  autoplaySpeed: 0,
  cssEase: 'linear',
  slidesToShow: 5,
  slidesToScroll: 1,
  infinite: true,
  swipeToSlide: true,
  centerMode: true,
  focusOnSelect: true,
  arrows:false,
  responsive: [
          {
            breakpoint: 750,
            settings: {
              slidesToShow: 3,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
            }
          }
          ]
});
/*----------End---------*/

/* Animatation JS */
new WOW().init();

});