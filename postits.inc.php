<?php
/*
 * Page module: PostIts
 *
 * This module allows you to send virtual post its to other users.
 * Requires some modification in the index.php file of the template and frontend login enabled.
 *
 * This file contains the code to initialize the Postits routines.
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

// function to include the Postits code to the head section
function createPostitsCode()
{
	$wb_url = WB_URL;
	$output = <<< EOT
	<!-- Include Postits CSS and Javascript code -->
	<link rel="stylesheet" type="text/css" href="$wb_url/modules/postits/frontend.css" media="screen" />
	<script type="text/javascript"> var WB_URL = "$wb_url";</script>
	<script type="text/javascript" src="$wb_url/include/jquery/jquery-min.js"></script>
	<script type="text/javascript" src="$wb_url/include/jquery/jquery-ui-min.js"></script>
	<script type="text/javascript" src="$wb_url/modules/postits/js/postits.js"></script>
EOT;
	return $output;
}
?>