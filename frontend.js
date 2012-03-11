/*
 * Page module: Postits
 *
 * This module allows you to send virtual PostIts (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * Checks if register_frontend_modfiles('jquery') method is called from the index.php file of the template.
 * Outputs a status message (only on Postits page) if the uer needs to adapt his template.
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

// display message if jQuery is not loaded via register_frontend_modfiles
if (typeof jQuery == 'undefined' || typeof(WB_URL) == "undefined" || typeof(Postits) == "undefined") {
	// create a message to be displayed to the user
	msg = "Sorry, your template is not yet ready to use the PostIts module.";
	msg += "\nEnsure the code below exists within the </head></head> section of your frontend template 'index.php' file.";
	msg += "\nIt is important to keep the exact order of code lines as shown below.";
	msg += "\n\n<?php";
	msg += "\n    if (function_exists('register_frontend_modfiles')) {";
	msg += "\n        register_frontend_modfiles('css');";
	msg += "\n        register_frontend_modfiles('jquery');";
	msg += "\n        // ensure PostIts show up on all frontend pages";
	msg += "\n        echo '<script src=\"' . WB_URL . '/modules/postits/javascript/postits.js\" type=\"text/javascript\"></script>';";
	msg += "\n        register_frontend_modfiles('js');"
	msg += "\n    }\n?>";
	msg += "\n\nTip: Template modifications can be easily done with the WebsiteBaker admin tool AFE.";
	msg	+= "\nDownload AFE: https://github.com/cwsoft/wb-addon-file-editor#readme.";
	
	// output status message so user is aware that he needs to modify his template
	alert(msg);
} 