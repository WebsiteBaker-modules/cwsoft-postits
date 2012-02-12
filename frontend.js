/*
 * Page module: Postits
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * Checks if register_frontend_modfiles('jquery') method is called from the index.php file of the template.
 * Outputs a status message (only on Postits page) if the uer needs to adapt his template.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS Websitebaker 2.8.x
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @version     1.1.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl.html
*/

// check if jQuery is loaded via register_frontend_modfiles function
if (typeof jQuery == 'undefined' || typeof(WB_URL) == "undefined") {
	// create a message to be displayed to the user
	msg = "Uups, your template is not yet ready to display PostIts on the frontend.";
	msg += "\nPlease add the code below inside the <head> </head> section of your 'index.php' template file to get Postits running.";
	msg += "\n\n<?php\n    // automatically include optional WB module files (frontend.css, frontend.js)";
	msg += "\n    if (function_exists('register_frontend_modfiles')) {";
	msg += "\n        register_frontend_modfiles('css');";
	msg += "\n        register_frontend_modfiles('jquery');";
	msg += "\n        register_frontend_modfiles('js');"
	msg += "\n    }\n?>";
	
	// output status message so user is aware that he needs to modify his template to get Postits displayed
	alert(msg);

} else {
	// jQuery loaded and WB_URL defined, so include Postits javascript code
	$.getScript(WB_URL + "/modules/postits/javascript/postits.js", function(){
	});
}