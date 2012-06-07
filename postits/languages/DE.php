<?php
/*
 * Page module: Postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file contains the German text outputs for the Postits module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     postits
 * @author      cwsoft (http://cwsoft.de)
 * @translation cwsoft
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// German module description
$module_description = 'Modul zum Verschicken von Kurznachrichten (Postits) an andere Benutzer oder Gruppen. Weitere Infos auf <a href="https://github.com/cwsoft/wb-postits#readme" target="_blank">GitHub</a>.';

// initialize global $LANG variable as array if needed
global $LANG;
if (! isset($LANG) || (isset($LANG) && ! is_array($LANG))) {
	$LANG = array();
}

// Postits text outputs
$LANG['POSTITS'] = array(
	// unread Postits
	'TXT_SUBMITTED_POSTITS' => 'Status Ihrer verschickten Postits',
	'TXT_LOGIN_REQUIRED'    => 'Sie m&uuml;ssen angemeldet sein um den Status Ihrer Postits abfragen zu k&ouml;nnen.',
	'TXT_NO_PERMISSIONS'    => 'Sie haben keine Berechtigung um Postits mit dem Postits Module zu verschicken.',
	'TXT_UNREAD_POSTS'      => 'Die nachfolgende Liste enth&auml;lt die von Ihnen verschickten Postits, welche noch nicht vom Empf&auml;nger als gelesen markiert wurden.',
	'TXT_ALL_POSTS_READ'    => 'Keine ungelesenen Postits vorhanden.',
	'TXT_RECIPIENT'         => 'Empf&auml;nger',
	'TXT_USER'              => 'Benutzer',
	'TXT_GROUP'             => 'Gruppe',
	
	// submit PostIts 
	'TXT_SUBMIT_POSTITS'    => 'Neue Postits versenden',
	'TXT_MESSAGE'           => 'Nachricht',
	'TXT_SUBMITTED_WHEN'    => 'Abgeschickt am',
	'TXT_SUBMIT'            => 'Postit abschicken',
	'TXT_REMAINING_CHARS'   => 'Noch verf&uuml;gbare Zeichen',
	
	// status messages
	'TXT_RECIPIENT_MISSING' => 'Es wurde kein g&uuml;ltiger Empf&auml;nger ausgew&auml;hlt.',
	'TXT_MESSAGE_MISSING'   => 'Es wurde keine Nachricht eingegeben.',
	'TXT_SEND_SUCCESS'      => 'Postits wurden erfolgreich verschickt.',
	'TXT_SEND_FAILED'       => 'Postits konnten nicht verschickt werden.',
	'TXT_SELECT_RECIPIENTS' => 'W&auml;hle den oder die gew&uuml;nschten Empf&auml;nger aus der Benutzer- bzw. Gruppenliste aus. Eine Mehrfachauswahl ist m&ouml;glich.',
	'TXT_ENTER_MESSAGE'     => 'Gebe die gew&uuml;nschte Kurznachricht (max. 150 Zeichen) in die Postits Form ein. Formatierungen und HTML Tags werden entfernt. Zum Versenden den Button "Postit abschicken" am unteren Rand anklicken.',
);