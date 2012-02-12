<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file deletes the module tables when the module is deinstalled.
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

// drop existing postit table
$table = TABLE_PREFIX . 'mod_postits';
$database->query("DROP TABLE IF EXISTS `$table`");