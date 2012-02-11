<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file contains the English text outputs for the Postit module.
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

// English module description
$module_description = 'Module to send short messages (PostIts) to loged in users or groups. See the <a href="{WB_URL}/modules/postits/help/help_EN.html" target="_blank">REAME</a> file for details.';

// declare module language array
$LANG = array();

// Text outputs frontend view (htt/frontend.htt)
$LANG[0] = array(
	'HEADING_FRONTEND'		=> 'Status of your sent Postits',
	'TXT_LOGIN_FIRST'		=> 'You must login first to view the status of your sent Postits.',
	'TXT_UNREAD_POSTS'		=> 'Below the Postits you sent which are not yet read by the recipients.',
	'TXT_POSTS_READ'		=> 'No unread Postits available.',
	'TXT_TH_COL1'			=> 'Recipient',
	'TXT_TH_COL2'			=> 'Sent',
	'TXT_TH_COL3'			=> 'Message',
	'DATE_FORMAT'			=> 'm/d/y G:i'
);

// Text outputs backend view (htt/backend.htt)
$LANG[1] = array(
	'HEADING_BACKEND'		=> 'Submit Postits',
	'TXT_SEND_POSTIT'		=> 'You can submit Postits to users and/or groups. Multi selection of users and groups is supported. ' .
							   'Please note, that the message text may not exceed 150 characters.',
	'TXT_STATUS'			=> 'Postit status',
	'TXT_HELP'				=> 'Help',
	'TXT_ERROR_MESSAGE'		=> 'Error while accessing database.',
	'TXT_RECIPIENT'			=> 'Recipient',
	'TXT_USER'				=> 'User',
	'TXT_GROUP'				=> 'Group',
	'TXT_MESSAGE'			=> 'Message',
	'TXT_SUBMIT'			=> 'Submit Postit',
	'TXT_RECIPIENT_MISSING'	=> 'No valid recipient selected.',
	'TXT_MESSAGE_MISSING'	=> 'No Postit message specified.',
	'TXT_SEND_OK'			=> 'Postits sucessfully submited.',
	'TXT_SEND_FAILED'		=> 'Unable to submit Postits.'
);

?>