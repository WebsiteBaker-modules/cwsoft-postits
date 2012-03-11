<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual PostIts (sticky notes) to other users.
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
 * @version     1.2.0
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// German module description
$module_description = 'Modul zum Verschicken von Kurznachrichten (Postits) an andere Benutzer oder Gruppen. Weitere Infos auf <a href="https://github.com/cwsoft/wb-anynews#readme" target="_blank">GitHub</a>.';

// initialize global $LANG variable as array if needed
if (! isset($LANG) || (isset($LANG) && ! is_array($LANG))) {
	$LANG = array();
}

// Postits text outputs
$LANG['POSTITS'] = array(
	// unread Postits
	'TXT_SUBMITTED_POSTITS' => 'Status Ihrer verschickten Postits',
	'TXT_LOGIN_REQUIRED'    => 'Sie m&uuml;ssen angemeldet sein um den Status Ihrer Postits abfragen zu k&ouml;nnen.',
	'TXT_UNREAD_POSTS'      => 'Nachfolgende Liste zeigt Ihre verschickten Postits an, die noch nicht von den Empf&auml;ngern gelesen wurden.',
	'TXT_ALL_POSTS_READ'    => 'Keine ungelesenen Postits vorhanden.',
	'TXT_RECIPIENT'         => 'Empf&auml;nger',
	'TXT_USER'              => 'Benutzer',
	'TXT_GROUP'             => 'Gruppe',
	
	// submit PostIts 
	'TXT_SUBMIT_POSTITS'    => 'Neue Postits versenden',
	'TXT_MESSAGE'           => 'Nachricht',
	'TXT_SUBMITTED_WHEN'    => 'Abgeschickt am',
	'TXT_PLEASE_SELECT'     => 'Bitte ausw&auml;hlen ...',
	'TXT_SUBMIT'            => 'Postits abschicken',
	
	// status messages
	'TXT_RECIPIENT_MISSING' => 'Es wurde kein g&uuml;ltiger Empf&auml;nger ausgew&auml;hlt.',
	'TXT_MESSAGE_MISSING'   => 'Es wurde keine Nachricht eingegeben.',
	'TXT_SEND_SUCCESS'      => 'Postits wurden erfolgreich verschickt.',
	'TXT_SEND_FAILED'       => 'Postits konnten nicht verschickt werden.',
	'TXT_USAGE'             => 'Zum Verschicken von Postits, den oder die Empf&auml;nger aus der Benutzer und/oder Gruppen Liste ausw&auml;hlen. Dann eine Kurznachricht (max. 150 Zeichen) in das Textfeld eintragen und den abschicken Button dr&uuml;cken.',
	'TXT_ERROR'             => 'Konnte keine Datenbankverbindung herstellen.',
	
	// date format
	'DATE_FORMAT'           => 'm/d/y G:i'
);