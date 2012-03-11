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

// load module language file
$lang = dirname(__FILE__) . '/languages/' . basename(LANGUAGE) . '.php';
require_once (! file_exists($lang) ? dirname(__FILE__) . '/languages/EN.php' : $lang);

/**
 * Create template object and configure it
 */
require_once(WB_PATH . '/include/phplib/template.inc');
$tpl = new Template(dirname(__FILE__) . '/templates');

// configure handling of unknown {variables} (remove:=default, keep, comment)
$tpl->set_unknowns('keep');

// configure debug mode (0:= default, 1:=variable assignments, 2:=calls to get variable, 4:=show internals)
$tpl->debug = 0;

// include template files
$tpl->set_file('page', 'backend.htt');

// define required template blocks
$tpl->set_block('page', 'unread_postits_list_block', 'unread_postits_list_block_handle');
$tpl->set_block('page', 'unread_postits_block', 'unread_postits_block_handle');

// replace template placeholder with text from language file
foreach($LANG['POSTITS'] as $key => $value) {
	$tpl->set_var($key, $value);
}

/**
 * Prepare the Postits status part of the template 
 */
// extract Postits sent by the logged in user which are not yet read by the recipients
$table = TABLE_PREFIX . 'mod_postits';
$sql = "SELECT * FROM `$table` WHERE `sender_id`='" . $admin->add_slashes((int) $_SESSION['USER_ID']) . "' AND `viewed`='0' ORDER BY `id` ASC";
$results = $database->query($sql);   

if ($results && $results->numRows() > 0) {
	// remove/hide template elements not required and add new block
	$tpl->set_var('TXT_ALL_POSTS_READ', '');

	// display all unviewed messages sent by the user
	while($row = $results->fetchRow()) {
		$tpl->set_var(array(
			'POSTED_WHEN'		=> date($LANG['POSTITS']['DATE_FORMAT'], $row['posted_when']),
			'RECIPIENT_NAME'	=> $row['recipient_name'],
			'MESSAGE'			=> substr($row['message'], 0, 40) . (strlen($row['message']) > 39 ? ' ...' : '')
		));
		
		// add unread postits in append mode
		$tpl->parse('unread_postits_list_block_handle', 'unread_postits_list_block', true);
	}
	// add the unread postits block
	$tpl->parse('unread_postits_block_handle', 'unread_postits_block', false);

} else {
	// no unviewed posts available (remove template elements not required)
	$tpl->set_var('unread_postits_block_handle', '');
	$tpl->set_var('TXT_UNREAD_POSTS', '');
}

/**
 * Prepare the submit Postits part of the template 
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