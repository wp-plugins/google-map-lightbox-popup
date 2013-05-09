function generate_popup(){		
jQuery('.createPopup').animate({
height:'0%',
width:'0%',
top:'50%',
left:'50%',
}, 0, function() {
// Animation complete.
});
jQuery('.innerdiv').css({'display':'none','top': 0 });     
}

jQuery('document').ready(function(){ 
	jQuery('.click_it').click(function(){
	
	var createp ='.'+ (jQuery(this).attr('class-value'));
	
	jQuery(createp).animate({
	height:'100%',
	width:'100%',
	top:'0',
	left:'0',
	}, 200, function() {
	// Animation complete.
	});
	var map_val = (jQuery('.gmbdm-dialog').attr('data-map-height'))/2;
	var x = jQuery(window).height();
	var y= (x/2)- map_val;
	if(y < 0 ){y=0;}
	jQuery('.innerdiv').css({'display':'block','top': y, });
	});
	jQuery('.createPopup').click(function(){
		generate_popup();
	});
	jQuery('.innerdiv').click(function(e){
	e.stopPropagation();
	});

});

jQuery(document).keyup(function(e) { 
	if (e.keyCode == 27) { // esc keycode
	generate_popup();
	}
});

jQuery('.cf-close').click(function(e) { 
	generate_popup();        
});