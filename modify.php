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
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @version     1.4.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// load module language file
$lang = dirname(__FILE__) . '/languages/' . basename(LANGUAGE) . '.php';
require_once (! file_exists($lang) ? dirname(__FILE__) . '/languages/EN.php' : $lang);

/**
 * Create Twig template object and configure it
 */
require_once ('thirdparty/Twig/Twig/Autoloader.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(dirname(__FILE__) . '/templates');
$twig = new Twig_Environment($loader, array(
	'autoescape'       => false,
	'cache'            => false,
	'strict_variables' => true,
	'debug'            => false,
));
        
// load Postits frontend template
$tpl = $twig->loadTemplate('backend.htt');

/**
 * Add WB_URL and Postits language text to template variable
 * Access via: {{ WB_URL }}, {{ lang.KEY }}
 */
$data = array();
$data['WB_URL'] = WB_URL; 
foreach ($LANG['POSTITS'] as $key => $value) {
	$data['lang'][$key] = $value;
}

// module backend view is authenticated by WebsiteBaker itself, so no extra code required here 
$data['postits']['AUTHENTICATED'] = true;

/**
 * Add Postits submitted by the logged in user but not yet read by the recipient(s) to template data {{ postits.unread }} 
 */
$table = TABLE_PREFIX . 'mod_postits';
$sql = "SELECT * FROM `$table` WHERE `sender_id`='" . $admin->add_slashes((int) $_SESSION['USER_ID']) . "' AND `viewed`='0' ORDER BY `id` ASC";
$results = $database->query($sql);   

$data['postits']['unread'] = array();
if ($results && $results->numRows() > 0) {
	
	while($row = $results->fetchRow()) {
		$data['postits']['unread'][] = array(
			// convert posted time into the date/time format defined in user Preferences and add possible timezone to GMT/UTC timestamp
			'POSTED_WHEN'    => date(sprintf("%s (%s)", DATE_FORMAT, TIME_FORMAT), $row['posted_when'] + (int) TIMEZONE),
			'RECIPIENT_NAME' => $row['recipient_name'],
			'MESSAGE'        => substr(strip_tags($row['message']), 0, 40) . (strlen(strip_tags($row['message'])) > 39 ? ' ...' : '')
		);
	}
	
	$data['postits']['STATUS_MESSAGE'] = $LANG['POSTITS']['TXT_UNREAD_POSTS'];

} else {
	$data['postits']['STATUS_MESSAGE'] = $LANG['POSTITS']['TXT_ALL_POSTS_READ'];
}

/**
 * Add Postits submit part to the template 
 */
// fetch registered users from database
$table = TABLE_PREFIX . 'users';
$sql = "SELECT * FROM `$table`";
$results = $database->query($sql);

// add all usernames to selection option
$user_options = '';
while ($results && $row = $results->fetchRow()) {
	$user_options .= '<option value="' . (int) $row['user_id'] . '">' . htmlentities($row['username']) . '</option>' . "\n";
}

// fetch registered users from database
$table = TABLE_PREFIX . 'groups';
$sql = "SELECT * FROM `$table`";
$results = $database->query($sql);

// add all groups to selection option
$group_options = '';
while ($results && $row = $results->fetchRow()) {
	$group_options .= '<option value="' . (int) $row['group_id'] . '">' . htmlentities($row['name']) . '</option>' . "\n";
}

// update template variables
$data['postits'] = array_merge($data['postits'], array(
	'URL_SUBMIT'         => WB_URL . '/modules/postits/code/store_postits.php',
	'PAGE_ID'            => (int) $page_id,
	'OPTION_USER_NAMES'  => $user_options,
	'OPTION_GROUP_NAMES' => $group_options
));

// ouput the final template
$tpl->display($data);