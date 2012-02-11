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
 * @version     1.0.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl.html
*/

// check if action is defined
if (!(isset($_POST['action']) && ($_POST['action'] == 'check_postits') && isset($_POST['show']) && is_numeric($_POST['show'])))
	return false;

// make sanity check of referer URL
require_once('../../config.php');
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 
	(isset($HTTP_SERVER_VARS['HTTP_REFERER']) ? $HTTP_SERVER_VARS['HTTP_REFERER'] : '');

// if referer is set check it
if ($referer != '' && (!(strpos($referer, WB_URL) !== false || strpos($referer, WB_URL) !== false))) return false;

// check if user has loged in
require_once('../../framework/class.admin.php');
$admin = new admin('Pages', 'start', false, false);
if (!$admin->is_authenticated()) return false;

// load module language file
$lang = (dirname(__FILE__)) . '/languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang) ? (dirname(__FILE__)) . '/languages/EN.php' : $lang );

/**
 * Check if Postits exists for the current user
 */
$table = TABLE_PREFIX . 'mod_postits';
$max_posts = ($_POST['show'] > 0) ? (int) $_POST['show'] : '5';
$user_id = $admin->add_slashes((int) $admin->get_session('USER_ID'));
$sql = "SELECT * FROM `$table` WHERE `recipient_id` = '$user_id' ORDER BY id ASC LIMIT $max_posts";
$results = $database->query($sql);
if (!$results) return false;

// extract all messages and convert to JSON object string
$json_postit = '';
while ($row = $results->fetchRow()) {
	// create JSON object string
	$json_postit .= '{'
	. '"id": "' . $row['id'] . '", "message": "' . strip_tags($row['message'], '<br>')
	. '", "sender": "' . htmlentities($row['sender_name']) . '<br />' . date($LANG[0]['DATE_FORMAT'], $row['posted_when'])
	. '"}, ';
}

// output JSON object string
echo '{"Data": [' . substr($json_postit, 0, -2) . ']}';

?>