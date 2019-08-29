jQuery(document).ready(function( $ ) {  

  // Theme slider
  var owl = $('.theme-slider').owlCarousel({
    loop:true,
    margin:0,
    nav: true,
    dots: false,
    navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000
  });

  //Usual Owlcarousel keyup!
  $(document.documentElement).keyup(function (event) {    
    if (event.keyCode == 37) {
      owl.trigger('prev.owl.carousel');
    } else if (event.keyCode == 39) {
      owl.trigger('next.owl.carousel');
    }
  });

  function heroSliderResize(windowHeight, windowWidth){
    if (windowWidth >768) {
      var newWindowHeight = parseInt(windowHeight) / 2;

      if (windowWidth >990) {
        $('.container-image img, .mainMenu').css('height',''+windowHeight+'px'); 
      }else{
        $('.container-image img, .mainMenu').css('height',''+newWindowHeight+'px');         
      }

    }else{
      $('.mainMenu').css('height',''+windowHeight+'px'); 
      $('.container-image img').css('height','auto'); 
    }
  }

  heroSliderResize($(window).height(), $(window).width());

  $(window).on('resize', function () {
    heroSliderResize($(window).height(), $(window).width());
  });

  // Mobile menu
  $('.menuBtn').click(function() {
    $(this).toggleClass('act');
      if($(this).hasClass('act')) {
        $('.mainMenu').addClass('act');
        $('body').css('overflow','hidden');
      }
      else {
        $('.mainMenu').removeClass('act');
        $('body').css('overflow','visible');
      }
  });  

  var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8;

	//hide timeline blocks which are outside the viewport
	hideBlocks(timelineBlocks, offset);

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		(!window.requestAnimationFrame) 
			? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
			: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
	});

	function hideBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top > $(window).scrollTop()+$(window).height()*offset ) && $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		});
	}

	function showBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
		});
	}

});



