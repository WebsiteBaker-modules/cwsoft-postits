<?php
/*
 * Page module: Postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file implements the backend view of the Postits module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     cwsoft-postits
 * @author      cwsoft (http://cwsoft.de)
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// load module language file and Postits functions
$lang = dirname(__FILE__) . '/languages/' . basename(LANGUAGE) . '.php';
require_once (! file_exists($lang) ? dirname(__FILE__) . '/languages/EN.php' : $lang);
require_once ('code/postits_functions.php');

/**
 * Create Twig template object and configure it
 */
// register Twig shipped with Postits if not already done by the WB core (included since WB 2.8.3 #1688)  
if (! class_exists('Twig_Autoloader')) {
	require_once ('thirdparty/Twig/Twig/Autoloader.php');
	Twig_Autoloader::register();
}
$loader = new Twig_Loader_Filesystem(dirname(__FILE__) . '/templates');
$twig = new Twig_Environment($loader, array(
	'autoescape'       => false,
	'cache'            => false,
	'strict_variables' => true,
	'debug'            => false,
));
        
// load Postits frontend template
$tpl = $twig->loadTemplate('backend.htt');

// get Postits template data 
$data = getTemplateData();

// ouput frontend template
$tpl->display($data);