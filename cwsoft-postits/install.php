<?php
/*
 * Page module: Postits
 *
 * This module allows you to send virtual Postits (sticky notes) to other users.
 * Requires some modification in the index.php file of the template.
 *
 * This file creates the module settings table when the module is installed.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     cwsoft-postits
 * @author      cwsoft (http://cwsoft.de)
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// prevent this file from being accessed directly
if (defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// drop existing postit table
$table = TABLE_PREFIX . 'mod_cwsoft-postits';
$database->query("DROP TABLE IF EXISTS `$table`");

// create table to store the postit messages
$sql = "CREATE TABLE `$table` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sender_id` INT(11) NOT NULL DEFAULT '0',
  `sender_name` VARCHAR(255) NOT NULL DEFAULT '',
  `recipient_id` INT(11) NOT NULL DEFAULT '0',
  `recipient_name` VARCHAR(255) NOT NULL DEFAULT '',
  `message` VARCHAR(255) NOT NULL DEFAULT '',
  `posted_when` INT(11) NOT NULL DEFAULT '0',
  `viewed` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)";

$database->query($sql);