/*///////////////////////////////////////////////////////////////////////
Part of the code from the book 
Building Findable Websites: Web Standards, SEO, and Beyond
by Aarron Walter (aarron@buildingfindablewebsites.com)
http://buildingfindablewebsites.com
Distrbuted under Creative Commons license
http://creativecommons.org/licenses/by-sa/3.0/us/
///////////////////////////////////////////////////////////////////////*/
// Load Events Listeners
Event.observe(window, 'load', init, false);
function init(){
	Event.observe('signup','submit',storeAddress);
}
// AJAX call sending sign up info to store-address.php
function storeAddress(event) {
	// Update user interface
	$('response').innerHTML = 'Adding email address...';
	// Prepare query string and send AJAX request
	var pars = 'ajax=true&email=' + escape($F('email'));
	var myAjax = new Ajax.Updater('response', 'inc/store-address.php', {method: 'get', parameters: pars});
	Event.stop(event); // Stop form from submitting when JS is enabled
}