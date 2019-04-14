// EMPTY LNK VANISHER
// JavaScript Document

// print jQuery version
alert ("We're rocking jQuery Version " + jQuery.fn.jquery);

// vanish empty links
jQuery('.one a').each(function() {
    if(!jQuery(this).attr('href')) {
        jQuery(this).parent().hide();      
	} 
});