<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file contains the code to initialize the Postits routines.
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

// prevent this file from being accessed directly
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

$PRECHECK = array();

/*
 * Specify required Website Baker version
 */
$PRECHECK['WB_VERSION'] = array('VERSION' => '2.8', 'OPERATOR' => '>=');

/*
 * Check if the jQuery folder exists in /include
 */
$status = file_exists(WB_PATH . '/include/jquery');
$required = $TEXT['INSTALLED'];
$actual = ($status) ? $TEXT['INSTALLED'] : $TEXT['NOT_INSTALLED'];

$PRECHECK['CUSTOM_CHECKS'] = array(
	'jQuery' => array('REQUIRED' => $required, 'ACTUAL' => $actual, 'STATUS' => $status)
);