<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file contains the German text outputs for the Postit module.
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

// German module description
$module_description = 'Dieses Module erm&ouml;glicht das Verschicken von Kurznachrichten (PostIts) an andere Benutzer oder Gruppen. Weitere Details finden Sie <a href="{WB_URL}/modules/postits/help/help_DE.html" target="_blank">hier</a>.';

// declare module language array
$LANG = array();

// Text outputs frontend view (htt/frontend.htt)
$LANG[0] = array(
	'HEADING_FRONTEND'		=> 'Status Ihrer gesendeten Postits',
	'TXT_LOGIN_FIRST'		=> 'Sie m&uuml;ssen sich erst anmelden, um den Status Ihrer Postits abfragen zu k&ouml;nnen.',
	'TXT_UNREAD_POSTS'		=> 'Nachfolgend sind die von Ihnen verschickten Postits aufgelistet, welche noch nicht gelesen wurden.',
	'TXT_POSTS_READ'		=> 'Die von Ihnen verschickten Postits wurden bereits gelesen.',
	'TXT_TH_COL1'			=> 'Empf&auml;nger',
	'TXT_TH_COL2'			=> 'Abgeschickt',
	'TXT_TH_COL3'			=> 'Nachricht',
	'DATE_FORMAT'			=> 'd.m.y H:i'
);

// Text outputs backend view (htt/backend.htt)
$LANG[1] = array(
	'HEADING_BACKEND'		=> 'Postit verschicken',
	'TXT_SEND_POSTIT'		=> 'Postits k&ouml;nnen an einzelne Benutzer und/oder einzelne Gruppen verschickt werden. ' .
							   'Die Mehrfachauswahl von Benutzern und/oder Gruppen ist m&ouml;glich. Der Nachrichtentext ' .
							   'kann maximal 150 Zeichen betragen.',
	'TXT_HELP'				=> 'Hilfe',
	'TXT_STATUS'			=> 'Postit Status',
	'TXT_ERROR_MESSAGE'		=> 'Uups, Fehler beim Zugriff auf die Datenbank.',
	'TXT_RECIPIENT'			=> 'Empf&auml;nger',
	'TXT_USER'				=> 'Benutzer',
	'TXT_GROUP'				=> 'Gruppen',
	'TXT_MESSAGE'			=> 'Nachricht',
	'TXT_PLEASE_SELECT'		=> 'Bitte w&auml;hlen ...',
	'TXT_SUBMIT'			=> 'Postit senden',
	'TXT_RECIPIENT_MISSING'	=> 'Es wurde kein g&uuml;ltiger Empf&auml;nger ausgew&auml;hlt.',
	'TXT_MESSAGE_MISSING'	=> 'Es wurde keine Nachricht eingegeben.',
	'TXT_SEND_OK'			=> 'Die Postits wurden erfolgreich verschickt.',
	'TXT_SEND_FAILED'		=> 'Postits konnten nicht verschickt werden.'
);

?>