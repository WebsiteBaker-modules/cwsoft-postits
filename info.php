<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file defines the variables required for Website Baker.
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

// OBLIGATORY WEBSITE BAKER VARIABLES
$module_directory			= 'postits';
$module_name				= 'Postits';
$module_function			= 'page';
$module_version				= '1.1.0';
$module_status				= '-';
$module_platform			= '2.8.x';
$module_author				= 'cwsoft (http://cwsoft.de)';
$module_license				= '<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public Licencse 3.0</a>';
$module_license_terms		= '-';
$module_requirements		= 'Requires to include postits.inc.php to the head section of the template index.php file.';
$module_description			= 'Module to send short messages (Postits) to loged in users or groups. See the <a href="' . WB_URL . '/modules/postits/help/help_EN.html" target="_blank">REAME</a> file for details.';