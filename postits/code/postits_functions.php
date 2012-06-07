<?php
/*
 * Page module: Postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file contains utility functions used by the Postits module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

/**
 * Function to extract and prepare the Postits template data 
*/
function getTemplateData()
{
	global $admin, $database, $page_id, $LANG;
	
	/**
	 * Make WB_URL accessible in template {{ WB_URL }}
 	 */
	$data = array();
	$data['WB_URL'] = WB_URL; 
	
	/**
	 * Make Postits language data accessible in template {{ lang.KEY }} 
 	 */
	foreach ($LANG['POSTITS'] as $key => $value) {
		$data['lang'][$key] = $value;
	}
	
	/**
	 * Ensure user is logged in and has permissions to access the Postits module 
 	 */
	require_once(WB_PATH . '/framework/class.admin.php');
	$access = new admin('Modules', 'module_view', false, false);	
	
	$data['postits']['AUTHENTICATED'] = true;	
	if (! ($access->is_authenticated() && $access->get_permission('postits', 'module'))) {
		$data['postits']['AUTHENTICATED'] = false;	
		
		if ($access->is_authenticated()) {
			$data['postits']['STATUS_MESSAGE'] = $LANG['POSTITS']['TXT_NO_PERMISSIONS'];
		} else {
			$data['postits']['STATUS_MESSAGE'] = $LANG['POSTITS']['TXT_LOGIN_REQUIRED'];
		}
		
		$data['postits']['unread'] = array();
		return $data;
	}
	
	/**
	 * Make Postits submitted by current user but not yet read by the recipient(s) accessible in template {{ postits.unread }} 
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
				'MESSAGE'        => strip_tags($row['message']),
			);
		}
		
		$data['postits']['STATUS_MESSAGE'] = $LANG['POSTITS']['TXT_UNREAD_POSTS'];
	
	} else {
		$data['postits']['STATUS_MESSAGE'] = $LANG['POSTITS']['TXT_ALL_POSTS_READ'];
	}
	
	/**
	 * Make Postits submit form data accessible in template {{ postits.KEY }} 
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

	// return template data
	return $data;
}