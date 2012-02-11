<?php
/**
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file prevents directory listing.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @author		Christian Sommer (doc), Marcus Jann
 * @copyright	(c) 2006-2009
 * @license		http://www.gnu.org/licenses/gpl.html
 * @version		0.61
 * @platform	Website Baker 2.8+
 *
*/

// prevent directory listing
header('Location: ../../../index.php');

?>