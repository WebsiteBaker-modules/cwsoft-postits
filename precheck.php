<?php
/*
 * Page module: Postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file checks the installation requirements during installation
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

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

/**
 * Check if minimum requirements for this module are fullfilled
 * Only excecuted from WebsiteBaker 2.8 onwards
 */
$PRECHECK = array( 
	// requires WebsiteBaker 2.8.x (from 2.8.2 onwards)
	'WB_VERSION' => array('VERSION' => '2.8.2', 'OPERATOR' => '>='), 

	// make sure PHP version is 5.2.2 or higher
	'PHP_VERSION' => array('VERSION' => '5.2.2', 'OPERATOR' => '>=')
);

/*
 * Check if the jQuery folder exists in /include
 */
$status = file_exists(WB_PATH . '/include/jquery');
$required = $TEXT['INSTALLED'];
$actual = ($status) ? $TEXT['INSTALLED'] : $TEXT['NOT_INSTALLED'];

$PRECHECK['CUSTOM_CHECKS'] = array(
	'jQuery' => array('REQUIRED' => $required, 'ACTUAL' => $actual, 'STATUS' => $status)
);