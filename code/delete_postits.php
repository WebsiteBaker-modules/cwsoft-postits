<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual PostIts (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file deletes a Postit from the database.
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

// include config.php file and admin class
require_once('../../../config.php');
require_once('../../../framework/class.admin.php');

// check if user has logged in
$admin = new admin('Pages', 'start', false, false);
if (!$admin->is_authenticated()) return false;

// check if a valid action is defined
if (!(isset($_POST['action']) && $_POST['action'] == 'delete' && 
	isset($_POST['postit_id']) && is_numeric($_POST['postit_id']) && isset($_POST['show']) && is_numeric($_POST['show']))) 
	return false;

/*
 * Delete Postit specified by $_POST['postit_id']
 */
$table = TABLE_PREFIX . 'mod_postits';
$max_posts = ($_POST['show'] > 0) ? (int) $_POST['show'] : '5';
$user_id = $admin->add_slashes((int) $admin->get_session('USER_ID'));
$sql = "DELETE FROM `$table` WHERE `id` = '" . $_POST['postit_id'] . "'";
$database->query($sql);
echo ($database->is_error()) ? '{"status": "error"}' : '{"status": "ok"}';