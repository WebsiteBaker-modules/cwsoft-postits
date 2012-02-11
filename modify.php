<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file provides the module settings via the WB backend.
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

// prevent this file from being accessed directly
if (!defined('WB_PATH')) die(header('Location: ../../index.php'));

// load module language file
$lang_file = (dirname(__FILE__)) . '/languages/' . LANGUAGE . '.php';
$lang_mod = (!file_exists($lang_file) ? 'EN' : LANGUAGE );

require_once(dirname(__FILE__) . '/languages/' . $lang_mod . '.php');

// define module help file link
$help_file = (dirname(__FILE__)) . '/help/help_' . LANGUAGE . '.php'; 
$lang_help = (!file_exists($lang_file) ? 'EN' : LANGUAGE );

// include template class and set template directory
require_once(WB_PATH . '/include/phplib/template.inc');
$tpl = new Template(dirname(__FILE__) . '/htt');
$tpl->set_file('page', 'backend.htt');

/**
 * Send Postits
 */
// replace template placeholder with text from language file
foreach($LANG[1] as $key => $value) {
	$tpl->set_var($key, $value);
}

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

$tpl->set_var(array(
	'URL_HELP'				=> WB_URL . '/modules/postits/help/help_' . $lang_help . '.html',
	'URL_SUBMIT'			=> WB_URL . '/modules/postits/store_postits.php',
	'PAGE_ID'				=> (int) $page_id,
	'OPTION_USER_NAMES'		=> $user_options,
	'OPTION_GROUP_NAMES'	=> $group_options
	)
);


	
// ouput the final template
$tpl->pparse('output', 'page');

?>