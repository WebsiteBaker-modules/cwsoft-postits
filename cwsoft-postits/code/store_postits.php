<?php
/*
 * Page module: cwsoft-postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file stores new Postits in the database.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     cwsoft-postits
 * @author      cwsoft (http://cwsoft.de)
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// include config.php file and admin class
require_once('../../../config.php');
require_once('../../../framework/class.admin.php');

// check if user has permissions to access the Postits module
$admin = new admin('Modules', 'module_view', false, false);
if (!($admin->is_authenticated() && $admin->get_permission('cwsoft-postits', 'module'))) 
	exit("Sorry, you have no permissions to access the Postits module");

// check if page_id was submitted
if (!(isset($_POST['page_id']) && is_numeric($_POST['page_id']))) 
	exit("Sorry, you have no permissions to access the Postits module");

// create admin object with backend header
$admin = new admin('Pages', 'pages_modify', true, false);

// work out redirect URL depending if Postit was send from frontend or backend
if (isset($_POST['frontend'])) {
	// fetch page url segment for given PAGE_ID
	$sql  = 'SELECT `link` FROM `' . TABLE_PREFIX . 'pages` WHERE `page_id` = ' . (int) $_POST['page_id'];
	$link = $database->get_one($sql);
	$link = ($link) ? $link : 'index';
	
	// build back link to calling page 
	$url_back = WB_URL . PAGES_DIRECTORY . $link . PAGE_EXTENSION;

} else {
	$url_back = ADMIN_URL . '/pages/modify.php?page_id=' . (int) $_POST['page_id'];
}

// load module language file
$lang = (dirname(__FILE__)) . '/../languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang) ? (dirname(__FILE__)) . '/../languages/EN.php' : $lang );

// check if recipients were submitted
if (!
	(
	(isset($_POST['users']) && count($_POST['users']) > 0) 
	|| (isset($_POST['groups']) && count($_POST['groups']) >0)
	)
) {
	$admin->print_error($LANG['POSTITS']['TXT_RECIPIENT_MISSING'], $url_back);
}

// check if a message was specified
if (!
	(
	isset($_POST['message']) 
	&& strip_tags(trim($_POST['message'])) != ''
	)
) {
	$admin->print_error($LANG['POSTITS']['TXT_MESSAGE_MISSING'], $url_back);
}

/**
 * Create array with all user_ids and usernames
 */
$table = TABLE_PREFIX . 'users';
$sql = "SELECT `user_id`, `display_name` FROM `$table`";
$results = $database->query($sql);

$user_list = array();
while ($results && $row = $results->fetchRow()) {
	$user_list[$row['user_id']] = $row['display_name'];
}

/**
 * Create array with all recipients
 */
$users = isset($_POST['users']) ? $_POST['users'] : array();
$groups = isset($_POST['groups']) ? $_POST['groups'] : array();

// extract all user_ids which are member of the group_id�s
$recipients = array();
if (count($groups) > 0) {
	$table = TABLE_PREFIX . 'users';
	$sql = "SELECT * FROM `$table`";
	$results = $database->query($sql);
	
	while ($results && $row = $results->fetchRow()) {
		if (key_exists('groups_id', $row)) {
			// multiple groups (introduced with WB 2.7)
			if (in_array($row['groups_id'], $groups)) $recipients[] = $row['user_id'];
		} else {
			// normal group
			if (in_array($row['group_id'], $groups)) $recipients[] = $row['user_id'];	
		}
	}
}

// join users and recipients array and remove duplicate entries
$recipients = array_merge($recipients, $users);
$recipients = array_unique($recipients);

/**
 * Create SQL query string (insert message per selected user)
 */
// prepare data to write into database
$sender_id = (int) $admin->get_session('USER_ID');
$sender_name = $admin->add_slashes($admin->get_session('DISPLAY_NAME'));
// store GMT/UTC time and convert to local user timezone in output only
$posted_when = addslashes(time());

// replace line breaks with <br /> tag
$message = str_replace(array("\r\n", "\n", "\r"), array('<br />', '<br />', '<br />'), $admin->add_slashes($_POST['message']));
$table = TABLE_PREFIX . 'mod_cwsoft-postits';

foreach ($recipients as $recipient => $user_id) {
	$recipient_name = ucfirst(addslashes($user_list[$user_id]));
	$sql = "INSERT INTO `$table` 
		(`sender_id`, `sender_name`, `recipient_id`, `recipient_name`, `message`, `posted_when`) VALUES 
		('$sender_id', '$sender_name', '" . (int) $user_id . "', '$recipient_name', '$message', '$posted_when')";
	$database->query($sql);
}

// output status message
if ($database->is_error()) {
	$admin->print_error($LANG['POSTITS']['TXT_SEND_FAILED'] . '<br />' . $database->get_error(), $url_back);
} else {
	$admin->print_success($LANG['POSTITS']['TXT_SEND_SUCCESS'], $url_back);
}