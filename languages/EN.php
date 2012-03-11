<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual PostIts (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file contains the English text outputs for the Postits module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @translation	cwsoft
 * @version     1.2.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// English module description
$module_description = 'Module to send short messages (Postits) to other users or groups. For details visit <a href="https://github.com/cwsoft/wb-anynews#readme" target="_blank">GitHub</a>.';

// initialize global $LANG variable as array if needed
if (! isset($LANG) || (isset($LANG) && ! is_array($LANG))) {
	$LANG = array();
}

// Postits text outputs
$LANG['POSTITS'] = array(
	// unread Postits
	'TXT_SUBMITTED_POSTITS' => 'Status of your submitted Postits',
	'TXT_LOGIN_REQUIRED'    => 'You must be logged in to view the status of your submitted Postits.',
	'TXT_UNREAD_POSTS'      => 'The list below shows your submitted Postits, which were not yet read by the recipient(s).',
	'TXT_ALL_POSTS_READ'    => 'No unread Postits exists.',
	'TXT_RECIPIENT'         => 'Recipient',
	'TXT_USER'              => 'User',
	'TXT_GROUP'             => 'Group',
	
	// submit PostIts 
	'TXT_SUBMIT_POSTITS'    => 'Submit new Postits',
	'TXT_MESSAGE'           => 'Message',
	'TXT_SUBMITTED_WHEN'    => 'Submitted',
	'TXT_PLEASE_SELECT'     => 'Please select ...',
	'TXT_SUBMIT'            => 'Submit Postits',
	
	// status messages
	'TXT_RECIPIENT_MISSING' => 'No valid recipient selected.',
	'TXT_MESSAGE_MISSING'   => 'No message specified.',
	'TXT_SEND_SUCCESS'      => 'Postits successfully submitted.',
	'TXT_SEND_FAILED'       => 'Unable to submit your Postits.',
	'TXT_USAGE'             => 'To send new Postits, select the recipients from the users and/or groups list. Then type a short message (max. 150 chars.) into the text field and press the submit button.',
	'TXT_ERROR'             => 'Error while accessing database.',
	
	// date format
	'DATE_FORMAT'           => 'm/d/y G:i'
);