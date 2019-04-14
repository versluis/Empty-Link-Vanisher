// EMPTY LINK VANISHER
// JavaScript Document

// print jQuery version
// alert ("We're rocking jQuery Version " + jQuery.fn.jquery);

// print a variable from PHP
// alert ('Random Value from PHP is ' + elv_data.random_value);

// print a concatenated string
$elv_vanish_class = elv_data.elv_class + ' a';

// vanish empty links
jQuery($elv_vanish_class).each(function() {
    if(!jQuery(this).attr('href')) {
        jQuery(this).parent().hide();      
	} 
});