<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual PostIts (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file implements the backend view of the Postits module.
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
 * Load module language file and set-up template
 */
// load module language file
$lang_file = (dirname(__FILE__)) . '/languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang_file) ? (dirname(__FILE__)) . '/languages/EN.php' : $lang_file);

// include template class and set template directory
require_once(WB_PATH . '/include/phplib/template.inc');
$tpl = new Template(dirname(__FILE__) . '/templates');
$tpl->set_file('page', 'backend.htt');

// replace template placeholder with text from language file
foreach($LANG['POSTITS'] as $key => $value) {
	$tpl->set_var($key, $value);
}

/**
 * Send Postits
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
$tpl->set_var(array(
	'URL_SUBMIT'			=> WB_URL . '/modules/postits/code/store_postits.php',
	'PAGE_ID'				=> (int) $page_id,
	'OPTION_USER_NAMES'		=> $user_options,
	'OPTION_GROUP_NAMES'	=> $group_options
	)
);

// ouput the final template
$tpl->pparse('output', 'page');