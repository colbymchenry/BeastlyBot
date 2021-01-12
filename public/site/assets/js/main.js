(function ($) {
 "use strict";
 
/* venobox  */	
$(document).ready(function(){
    $('.venobox').venobox();
});
/* wow js  */
 new WOW().init();
/* mobile-menu  */	
new Mmenu(
	document.querySelector('#mobile-menu'),
	{
		extensions	: [ 'theme-light' ],
		setSelected	: true,
		counters	: false,
		iconbar		: {
			top 		: [
				'<a href="index.html"><span class="fa fa-home"></span></a>'
			],
			bottom 		: [
				'<a href="#/"><span class="fa fa-facebook"></span></a>',
				'<a href="#/"><span class="fa fa-twitter"></span></a>',
				'<a href="#/"><span class="fa fa-linkedin"></span></a>',
				'<a href="#/"><span class="fa fa-instagram"></span></a>'
			]
		},
		navbars		: [
			{
				type		: 'tabs',
				content		: [
					'<a href="#panel-menu"><i class="ti-menu"></i> <span>Menu</span></a>',
					'<a href="#panel-lang"><i class="fa fa-flag"></i> <span>Lang</span></a>'
				]
			},
			{
				content		: [ 'prev', 'breadcrumbs', 'close' ]
			}
		]
	},
	{
		navbars		: {
			breadcrumbs	: {
				removeFirst	: true
			}
		}
	}
);
/* scrollUp */	
$.scrollUp({
	scrollText: '<i class="arrow_carrot-up"></i>',
	easingType: 'linear',
	scrollSpeed: 900,
	animation: 'slide'
});
/* counterUp  */
$('.count1').counterUp({
	delay: 10,
	time: 1000
});	

$('.count2').counterUp({
	delay: 15,
	time: 2000
});

$('.count3').counterUp({
	delay: 20,
	time: 3000
});

$('.count4').counterUp({
	delay: 10,
	time: 4000
});
/* Hero Slider */
var mainSlider = $('.main-slider');
mainSlider.slick({
	arrows: true,
	prevArrow:"<button type='button' class='slick-prev'><i class='arrow_carrot-left'></i></button>",
	nextArrow:"<button type='button' class='slick-next'><i class='arrow_carrot-right'></i></button>",
	autoplay: false,
	autoplaySpeed: 5000,
	dots: true,
	pauseOnFocus: false,
	pauseOnHover: false,
	fade: true,
	infinite: true,
	slidesToShow: 1,
	responsive: [
		{
			breakpoint: 767,
			settings: {
				arrows: false
			}
		},
		{
			breakpoint: 479,
			settings: {
				arrows: false
			}
		}
	]
});
/* testimonial-carousel */
$(".testimonial-carousel").slick({
  dots: true,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 1376,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
$(".testimonial-carousel-2").slick({
  dots: true,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
$(".testimonial-carousel-3").slick({
  dots: true,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});

/* brands-carousel */
$(".brands-carousel").slick({
  dots: false,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 3
      }
    },
    {
      breakpoint: 361,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    }
  ]
});
if ($(window).width() < 768) {
	$(".brands-list").slick({
		dots: false,
		arrows:false,
		infinite: true,
		speed: 300,
		slidesToShow: 2,
		slidesToScroll: 1,
		autoplay: true,
		adaptiveHeight: true,
		prevArrow: '<i class="fa fa-angle-left"></i>',
		nextArrow: '<i class="fa fa-angle-right"></i>',
		  responsive: [
			{
			  breakpoint: 361,
			  settings: {
				arrows: false,
				slidesToShow: 1
			  }
			}
		  ]
	});
}
if ($(window).width() < 768) {
	$(".client-carousel").slick({
		dots: false,
		arrows:false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		adaptiveHeight: true,
		prevArrow: '<i class="fa fa-angle-left"></i>',
		nextArrow: '<i class="fa fa-angle-right"></i>',
	});
}
/* case-carousel */
$(".case-carousel").slick({
  dots: true,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
/* service-carousel  */
$(".service-carousel").slick({
  dots: true,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        arrows: false,
        slidesToShow: 3,
		slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 481,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }
  ]
});
$(".service-carousel-2").slick({
  dots: true,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  centerMode: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        arrows: false,
        slidesToShow: 3,
		slidesToScroll: 1
      }
    },
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 481,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }
  ]
});
/* product-carousel */
$(".products-carousel").slick({
  dots: false,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 481,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }
  ]
});
/* portfolio-carousel */
if ($(window).width() < 992) {
	$(".portfolio-carousel").slick({
	  dots: false,
	  arrows:false,
	  infinite: true,
	  speed: 500,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  autoplay: true,
	  adaptiveHeight: true,
	  prevArrow: '<i class="fa fa-angle-left"></i>',
	  nextArrow: '<i class="fa fa-angle-right"></i>',
	  responsive: [
		{
		  breakpoint: 992,
		  settings: {
			arrows: false,
			slidesToShow: 2
		  }
		},
		{
		  breakpoint: 481,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
	  ]
	});
}
/* isotop */

$(window).on('load',function() {
	
	var layoutMode = 'fitRows';

	if($(window).width() < 992) {
		layoutMode = 'masonry';
	}
	
	$('.gallery-items').isotope({
		layoutMode: layoutMode,
	});
});

$('.gallery-nav li').on('click', function() {
	
  $(".gallery-nav li").removeClass("active");
  $(this).addClass("active");        

	var selector = $(this).attr('data-filter'); 
	$(".gallery-items").isotope({ 
		filter: selector, 
		animationOptions: { 
			duration: 750, 
			easing: 'linear', 
			queue: false
		} 
	}); 
  return false; 
});
/* blog masonry */	
$(window).on('load',function() {
	
	$('.blog-masonry').isotope({
		layoutMode: 'masonry',
	});
});
/* pricing-carousel */
if ($(window).width() < 992) {
	$(".pricing-carousel").slick({
		dots: false,
		arrows:false,
		infinite: true,
		speed: 500,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: true,
		adaptiveHeight: true,
		prevArrow: '<i class="fa fa-angle-left"></i>',
		nextArrow: '<i class="fa fa-angle-right"></i>',
		responsive: [
		{
		  breakpoint: 992,
		  settings: {
			arrows: false,
			slidesToShow: 2
		  }
		},
		{
		  breakpoint: 768,
		  settings: {
			arrows: false,
			slidesToShow: 1
		  }
		}
		]
	});
}
/* blog-carousel  */
$(".blog-carousel").slick({
  dots: false,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    },
    {
      breakpoint: 481,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }
  ]
});
$(".blog-carousel-2").slick({
  dots: false,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 2,
  slidesToScroll: 1,
  autoplay: false,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
/* team-carousel  */
$(".team-carousel").slick({
  dots: false,
  arrows:false,
  infinite: true,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: false,
  adaptiveHeight: true,
  prevArrow: '<i class="fa fa-angle-left"></i>',
  nextArrow: '<i class="fa fa-angle-right"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
/* countdown */
$('[data-countdown]').each(function() {
	
	var $this = $(this), finalDate = $(this).data('countdown');
	
	$this.countdown(finalDate, function(event) {
	$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span><p>/Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>/Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>/Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>/Sec</p></span>'));
	});
	
});
/* cart-plus-minus-button */  
$(".qtybutton").on("click", function() {
	var $button = $(this);
	var oldValue = $button.parent().find("input").val();

	if ($button.text() == "+") {
	  var newVal = parseFloat(oldValue) + 1;
	} else {
		// Don't allow decrementing below zero
		if (oldValue > 0) {
			var newVal = parseFloat(oldValue) - 1;
		} else {
			newVal = 0;
		}
	}
	
	$button.parent().find("input").val(newVal);
});
/* menu-stick  */
var s = $("#sticker");
var pos = s.position();					   
$(window).on('scroll', function() {
	var windowpos = $(window).scrollTop();
	if (windowpos > pos.top) {
		s.addClass("stick");
	} else {
		s.removeClass("stick");	
	}
});
})(jQuery); 