<?php
/*
 * Page module: cwsoft-postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file contains the Dutch text outputs for the Postits module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     cwsoft-postits
 * @author      cwsoft (http://cwsoft.de)
 * @translation	Dutch translation by Erwin J.M. Venus
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// Dutch module description
$module_description = 'Modul voor het versturen van korte berichten (Postits) aan andere user of groepen. Verdere informatie op <a href="https://github.com/cwsoft/websitebaker-postits#readme" target="_blank">GitHub</a>.';

// initialize global $LANG variable as array if needed
global $LANG;
if (! isset($LANG) || (isset($LANG) && ! is_array($LANG))) {
	$LANG = array();
}

// Postits text outputs
$LANG['POSTITS'] = array(
	// unread Postits
	'TXT_SUBMITTED_POSTITS' => 'Status van jouw verstuurde Postits',
	'TXT_LOGIN_REQUIRED'    => 'Je moet ingelogd zijn om de status van jouw Postits te kunnen opvragen.',
	'TXT_NO_PERMISSIONS'    => 'Je hebt geen toestemming om Postits te versturen met de Postit Module.',
	'TXT_UNREAD_POSTS'      => 'De onderstaande lijst toont uw verstuurde postit(s), die nog niet werden gelezen door de ontvanger(s).',
	'TXT_ALL_POSTS_READ'    => 'Geen ongelezen Postits voorhanden.',
	'TXT_RECIPIENT'         => 'Ontvanger',
	'TXT_USER'              => 'User',
	'TXT_GROUP'             => 'Groep',
	'TXT_MODULE_TYPE'       => 'Site module',
	'TXT_HELP'              => 'Help',
	
	// submit PostIts 
	'TXT_SUBMIT_POSTITS'    => 'Nieuwe Postits versturen',
	'TXT_MESSAGE'           => 'Bericht',
	'TXT_SUBMITTED_WHEN'    => 'Verstuurd',
	'TXT_SUBMIT'            => 'Postit versturen',
	'TXT_REMAINING_CHARS'   => 'Resterende karakters',
	
	// status messages
	'TXT_RECIPIENT_MISSING' => 'Geen geldige ontvanger geselecteerd.',
	'TXT_MESSAGE_MISSING'   => 'Er werd geen bericht ingevoerd.',
	'TXT_SEND_SUCCESS'      => 'Postit succesvol verstuurd.',
	'TXT_SEND_FAILED'       => 'Postit kon niet worden verstuurd.',
	'TXT_SELECT_RECIPIENTS' => 'Selecteer de gewenste ontvanger van de user of groeps lijst. Een meervoudige selectie is mogelijk.',
	'TXT_ENTER_MESSAGE'     => 'Voer uw bericht (max. 150 tekens) in op het onderstaande formulier. HTML-tags en formaten zullen worden verwijderd. Om de Postit te verstuuren, drukt u op de "Postit versturen" knop aan de onderkant.',
);