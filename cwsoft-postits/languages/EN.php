<?php
/*
 * Page module: cwsoft-postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file contains the English text outputs for the Postits module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     cwsoft-postits
 * @author      cwsoft (http://cwsoft.de)
 * @translation	cwsoft
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// English module description
$module_description = 'Module to send short messages (Postits) to other users or groups. For details visit <a href="https://github.com/cwsoft/websitebaker-postits#readme" target="_blank">GitHub</a>.';

// initialize global $LANG variable as array if needed
global $LANG;
if (! isset($LANG) || (isset($LANG) && ! is_array($LANG))) {
	$LANG = array();
}

// Postits text outputs
$LANG['POSTITS'] = array(
	// unread Postits
	'TXT_SUBMITTED_POSTITS' => 'Status of your submitted Postits',
	'TXT_LOGIN_REQUIRED'    => 'You must be logged in to view the status of your submitted Postits.',
	'TXT_NO_PERMISSIONS'    => 'You have no permissions to send sticky notes with the Postits module.',
	'TXT_UNREAD_POSTS'      => 'The list below shows your submitted Postits, which were not yet read by the recipient(s).',
	'TXT_ALL_POSTS_READ'    => 'No unread Postits exists.',
	'TXT_RECIPIENT'         => 'Recipient',
	'TXT_USER'              => 'User',
	'TXT_GROUP'             => 'Group',
	'TXT_MODULE_TYPE'       => 'Page type module',
	'TXT_HELP'              => 'Help',
	
	// submit PostIts 
	'TXT_SUBMIT_POSTITS'    => 'Submit new Postits',
	'TXT_MESSAGE'           => 'Message',
	'TXT_SUBMITTED_WHEN'    => 'Submitted',
	'TXT_SUBMIT'            => 'Submit Postits',
	'TXT_REMAINING_CHARS'   => 'Remaining characters',
	
	// status messages
	'TXT_RECIPIENT_MISSING' => 'No valid recipient selected.',
	'TXT_MESSAGE_MISSING'   => 'No message specified.',
	'TXT_SEND_SUCCESS'      => 'Postits successfully submitted.',
	'TXT_SEND_FAILED'       => 'Unable to submit your Postits.',
	'TXT_SELECT_RECIPIENTS' => 'Select the recipients you want to send a sticky note from the users and/or groups list below. Multiselection of users/groups is supported.',
	'TXT_ENTER_MESSAGE'     => 'Enter your short message (max. 150 characters) into the sticky note form below. HTML tags and formats will be removed. To send the Postit, press the "Submit Postits" button at the bottom.',
);