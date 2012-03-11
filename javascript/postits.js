/*
 * Page module: Postits
 *
 * This module allows you to send virtual PostIts (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file includes the Javascript code of the Postits module
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @version     1.2.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// Postits - global settings
var Postits = { 
	'Timer': '',         // internal Postits timer variable
	'Interval': 30000,   // check every xx milliseconds for new Postits (5000 ms := 5 sec, default: 30s)
	'ActivateTimer': 1,  // 1.. activate timer (set to other value for debugging)
	'ShowMax': 99,       // maximum number of Postits shown at once
	'ShowGif': 1         // 1.. show Postit GIF as background, 0.. display a "window style" div 
};

// function is executed if DOM is ready
jQuery(document).ready(function() 
{
	// include Postits CSS file
	jQuery.include([
		WB_URL + '/modules/postits/css/postits.css'
	]); 
	
	// if DOM is ready, check for new Postits
	checkForPostits();

	// only enable timer if not in debug mode
	if (Postits.ActivateTimer == 1) {
		Postits.Timer = window.setInterval('checkForPostits()', Postits.Interval);
	}
});

// function to check if Postits needs to be displayed
function checkForPostits()
{
	// create Ajax call to check if Postits are available
	jQuery.ajax({
		type: 'POST',
		url: WB_URL + '/modules/postits/code/get_postits.php',
		data: 'action=check_postits&show=' + Postits.ShowMax,
		dataType: 'json',
		
		success: function(result){
			if (result && result.Data.length > 0) {
				addPostits(result);
			}
		}
	});
}

// function to add dragable Postit to the document tree from JSON object
function addPostits(result)
{
	if (!(result && result.Data.length > 0)) return;
	
	// loop over JSON object and add Postits to document tree
	postits = result.Data.length;
	
	for (i = 0; i < postits; i++) {
		
		// only add Postit if not already added in previous loop
		if (jQuery('#postit_' + result.Data[i].id).length > 0) continue;
		
		// set starting position
		var x = 300 + (i % 10) * 30 + Math.floor(i/10) * 170;
		var y = 200 + (i % 10) * 20;

		// create a div container for each postit
		if (Postits.ShowGif == 1) {
			jQuery('<div id="postit_' + result.Data[i].id + '" class="postits gif" style="left: ' + x + 'px; top: ' + y + 'px"></div>')
			.append('<a href="#" class="gif"></a>')
			.append('<p class="gif">' + result.Data[i].message + '</p>')
			.append('<p class="sendby">' + result.Data[i].sender + '</p>')
			.appendTo('body')
			.hide().fadeIn('slow')
			.draggable({'containment' : 'html'});
		}
		else {
			jQuery('<div id="postit_' + result.Data[i].id + '" class="postits txt" style="left: ' + x + 'px; top: ' + y + 'px"></div>')
			.append('<div class="header">Postit #' + i + '<a href="#"></a></div>')
			.append('<p>' + result.Data[i].message + '</p>')
			.append('<p class="sendby">' + result.Data[i].sender + '</p>')
			.appendTo('body')
			.hide().fadeIn('slow')
			.draggable({'containment' : 'html'});
		}

		// assign click function to remove Postit from the DOM
		jQuery('#postit_' + result.Data[i].id + ' a').click(function()
		{
			// get postit_id from div
			var id = jQuery(this).parents('div.postits').attr('id');
			id = id.substr(7);
			
			// pass over id of actual PostIt to remove function
			removePostits(id);
		});
	}
}

// function to remove a Postit from the document tree
function removePostits(id)
{
	// create Ajax call to delete Postit from database
	jQuery.ajax({
		type: 'POST',
		url: WB_URL + '/modules/postits/code/delete_postits.php',
		data: 'action=delete&postit_id=' + id + '&show=' + Postits.ShowMax,
		dataType: 'json',
		
		success: function(result){
			if (result && result.status == 'ok') {
				jQuery('#postit_' + id).fadeOut('def'), function()
				{
					jQuery(this).remove();
				}
			} else {
				alert('Unable to delete Postit. Refresh browser (F5) and try again. Id: [' + id + ']');
			}
		}
	});
}