$(document).ready(function(){
  initSlider();

  /**
    * thanks to http://www.webgeekly.com/tutorials/create-a-simple-jquery-drop-down-menu-in-3-simple-steps/
    * by reading the article I found the solution to my problem in using setTimeout();
    */
  $('a.mm').each(function() {
    var item = $(this);
    $(this).removeClass('isActive');
    var target = $('#'+item.attr("id")+'-drop-down');
    item.mouseenter(function() {
      target.show();
    });
    /**
     * by using setTimeout we give time to the user to enter the submenu
     * and so to $('#mm-chi-drop-down').mouseenter() to fire, thus preventing 
     * submenu from disappearing. Otherwise we hide the submenu.
     */
    item.mouseleave(function() {
      setTimeout(function() { if ( !item.hasClass('isActive') ) target.hide(); }, 200);
    });
    target.mouseenter(function() {
      item.addClass('isActive');
    });
    target.mouseleave(function() {
      item.removeClass('isActive');
      target.hide();
    });
    // handle mouse clicks
    item.click(function(){
      if ( item.hasClass('isClicked') ) {
        target.hide();
      } else {
        target.show();
      }
      item.toggleClass('isClicked');
    })
    
  });

});

// Slider
var sc=0;
var N=0;
function initSlider() {
	var i=0;
	var zi = 50; // zi: z-index
	$('.slide').each(function(){
		zi = zi+1;
		$(this).attr('id','img-'+i);
		$(this).css('z-index',zi);
		i = i+1;
	});
	N = i;
  // activate slideshow for N>1 (we need at east two images)
	if ( N>1 ) {
    setInterval("slideshow()",5000);		  
	}	    
}
function slideshow() {
	var curr = sc; // current slide
	var next = (sc+1)%N; // next slide
	$('#img-'+curr).fadeOut('slow').hide();
	$('#img-'+next).fadeIn('slow').show();
	sc = next;
}



/**
 * var sub_isActive = false; 
 * $('#main-menu ul li a').mouseenter(function() { 
 *   $('#chi-siamo-drop-down').show(); 
 * }); 
 * $('#main-menu ul li a').mouseleave(function() {     
 *   setTimeout(function() { if ( sub_isActive === false ) $('#chi-siamo-drop-down').hide(); }, 200); 
 * }); 
 * $('#chi-siamo-drop-down').mouseenter(function() { 
 *   sub_isActive = true; 
 * }); 
 * $('#chi-siamo-drop-down').mouseleave(function() { 
 *   sub_isActive = false; 
 *   $('#chi-siamo-drop-down').hide(); 
 * }); 
*/