<?php
/*
 * Page module: Postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file graps the unread Postits for the logged in user from the database.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @version     1.3.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// include config.php file and admin class
require_once('../../../config.php');
require_once('../../../framework/class.admin.php');

// check if user is logged in
$admin = new admin('Pages', 'start', false, false);
if (!$admin->is_authenticated()) return false;

// check if action is defined
if (!
	(
	isset($_POST['action']) 
	&& $_POST['action'] == 'check_postits'
	&& isset($_POST['show']) 
	&& is_numeric($_POST['show'])
	)
) {
	return false;
}

// load module language file
$lang = (dirname(__FILE__)) . '/../languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang) ? (dirname(__FILE__)) . '/../languages/EN.php' : $lang );

/**
 * Check if a Postits exists for the current user
 */
$table = TABLE_PREFIX . 'mod_postits';
$max_posts = ($_POST['show'] > 0) ? (int) $_POST['show'] : '5';
$user_id = (int) $admin->get_session('USER_ID');
$sql = "SELECT * FROM `$table` WHERE `recipient_id` = '$user_id' ORDER BY id ASC LIMIT $max_posts";
$results = $database->query($sql);
if (!$results) return false;

// extract all messages and convert to JSON object string
$json_postit = '';
while ($row = $results->fetchRow()) {
	// create JSON object string
	$json_postit .= '{'
	. '"id": "' . $row['id'] . '", "message": "' . strip_tags($row['message'], '<br>')
	. '", "sender": "' . htmlentities($row['sender_name']) . '<br />' . date(sprintf("%s (%s)", DATE_FORMAT, TIME_FORMAT), $row['posted_when'] + (int) TIMEZONE)
	. '"}, ';
}

// output JSON object string
echo '{"Data": [' . substr($json_postit, 0, -2) . ']}';