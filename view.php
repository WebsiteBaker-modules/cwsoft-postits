<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file provides an overview of Postits send but not yet read by the recipients.
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

/**
 * Load module language file and set-up template
 */
// load module language file
$lang_file = (dirname(__FILE__)) . '/languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang_file) ? (dirname(__FILE__)) . '/languages/EN.php' : $lang_file);

// include template class and set template directory
require_once(WB_PATH . '/include/phplib/template.inc');
$tpl = new Template(dirname(__FILE__) . '/templates');
$tpl->set_file('page', 'frontend.htt');

// replace template placeholder with text from language file
foreach($LANG[0] as $key => $value) {
	$tpl->set_var($key, $value);
}

/**
 * Output template
 */
// check if user is logged in
if (!isset($_SESSION['USER_ID'])) {
	// remove/hide template elements not required
	$tpl->unset_var(array('TXT_UNREAD_POSTS', 'TXT_POSTS_READ'));
	$tpl->set_var('CLASS_HIDE', 'hide');

} else {
	// connect to database and check for unread messages sent by the current user
	$table = TABLE_PREFIX . 'mod_postits';
	$sql = "SELECT * FROM `$table` WHERE `sender_id`='" . $admin->add_slashes((int) $_SESSION['USER_ID']) . "' AND `viewed`='0' ORDER BY id ASC";
	$results = $database->query($sql);

	if ($results && $results->numRows() > 0) {
		// remove/hide template elements not required and add new block
		$tpl->unset_var(array('TXT_POSTS_READ', 'TXT_LOGIN_FIRST'));
		$tpl->set_var('CLASS_HIDE', '');
		$tpl->set_block('page', 'postit_list', 'postit_replace');

		// display all unviewed messages sent by the user
		$count = 0;
		while($row = $results->fetchRow()) {
			$tpl->set_var(array(
				'CLASS_ODD'			=> ($count % 2 != 0) ? 'class="odd"' : '',
				'POSTED_WHEN'		=> date($LANG[0]['DATE_FORMAT'], $row['posted_when']),
				'RECIPIENT_NAME'	=> $row['recipient_name'],
				'MESSAGE'			=> substr($row['message'], 0, 40) . (strlen($row['message']) > 39 ? ' ...' : '')
				)
			);
			$count++;
			$tpl->parse('postit_replace', 'postit_list', true);
		}

	} else {
		// no unviewed posts available (remove hide elements not required)
		$tpl->unset_var(array('TXT_UNREAD_POSTS', 'TXT_LOGIN_FIRST'));
		$tpl->set_var('CLASS_HIDE', 'hide');
	}
}

// ouput the final template
$tpl->pparse('output', 'page');