/* 
 * Enter your Custom Javascript Functions here
*/

jQuery(document).ready(function($){
	$('.fancybox').fancybox( {
		maxWidth	: 800,
		maxHeight	: 600,
	
			
	}); 
	$('.menu-navigate,.sidebar-close').click(function() { 
		$('.pagesidebar').toggleClass('open');
		$('.pusher').toggleClass('open');
	});

	$('.toggle-dropdown .toggler').click(function() { 
		$(this).parent().toggleClass('active');
		$('#inner-wrapper.swipe').toggleClass('active');
	});

	

	 $(window).scroll(function(event){
    var st = $(this).scrollTop();
    if($('header').hasClass('fix')){
      var headerheight=$('header').height();
      if(st > headerheight){
        $('header').addClass('fixed');
      }else{
        $('header').removeClass('fixed');
      }
    }
  });
});
