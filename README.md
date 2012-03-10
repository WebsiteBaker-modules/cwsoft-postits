# PostIts module for CMS WebsiteBaker (2.8.x)

The PostIts module allows you to send short text messages (150 characters) to other users or groups via the [WebsiteBaker CMS](http://www.websitebaker2.org) backend. The PostIts notes are automatically displayed at the frontend and/or backend, once the recipient logs into WebsiteBaker. The sender can check whether his note was already read by the recipient.

## Download
The released stable `PostIts` installation packages for the WebsiteBaker CMS can be found in the [GitHub download area](https://github.com/cwsoft/wb-postits/downloads). It is recommended to install/update to the latest available version listed. Older versions are provided for compatibility reasons with older WebsiteBaker versions and may contain bugs or security issues. The development history of the PostIts module can be tracked via [GitHub](https://github.com/cwsoft/wb-postits).

## License
The Postits module is licensed under the [GNU General Public License (GPL) v3.0](http://www.gnu.org/licenses/gpl-3.0.html).

## Requirements

The minimum requirements to get PostIts running are as follows:

- WebsiteBaker ***2.8.2*** or higher (recommended last stable 2.8.x version)
- PHP ***5.2.2*** or higher (recommended last stable PHP 5.3.x version)
- small modification of your frontend template (optional backend template)
- your browser must have JavaScript enabled

## Installation

1. download [PostIts v1.2.0](https://github.com/downloads/cwsoft/wb-postits/cwsoft-wb-postits-v1.2.0.zip) WebsiteBaker installation package
2. log into your WebsiteBaker backend and go to the `Add-ons/Modules` section
3. install the downloaded zip archive via the WebsiteBaker installer
4. go to the pages section and create a new page of type `PostIts`
5. select your username or group and enter a test message for your first Postit
6. press the "Submit Postit" button to send the PostIt

### Frontend template modifications (OBLIGATORY)

View the PostIt page you created in your frontend part. If you see a JavaScript message, you need to adapt the ***index.php*** of your frontend template. Open your WebsiteBaker frontend template file ***index.php*** in the [Addon File Editor](https://github.com/cwsoft/wb-addon-file-editor#readme) and search for the following lines. 

	if (function_exists('register_frontend_modfiles')) {
		register_frontend_modfiles('css');
		register_frontend_modfiles('js');
	}

Change the lines above as follows:

	if (function_exists('register_frontend_modfiles')) {
		register_frontend_modfiles('css');
		register_frontend_modfiles('jquery');
        // ensure PostIts show up on all frontend pages
        echo '<script src="' . WB_URL . '/modules/postits/javascript/postits.js" type="text/javascript"></script>';
		register_frontend_modfiles('js');
	}

PostIts will now automatically appear in your frontend, once the recipient is loged in. Reload the frontend view in your browser (F5) to see if it works. 

If it doesn't work, check if you enabled JavaScript in your browser. Ensure you added the code above in the given order to your default frontend template. The code must be placed within the `<head></head>` section.

### Backend template modifications (OPTIONAL)

If you want to show PostIts also in the backend part of WebsiteBaker, you need to modify the template file ***header.htt*** of your backend theme. For the default backend theme of WebsiteBaker 2.8.3, the file is found at */templates/wb_theme/templates/header.htt*. Open the file with the [Addon File Editor](https://github.com/cwsoft/wb-addon-file-editor#readme) and search for the following lines at the top of the file.

	<script src="{WB_URL}/include/jquery/jquery-min.js" type="text/javascript"></script>
	<script src="{WB_URL}/include/jquery/jquery-insert.js" type="text/javascript"></script>
	<script src="{WB_URL}/include/jquery/jquery-include.js" type="text/javascript"></script>

Change the lines above as follows:

	<script src="{WB_URL}/include/jquery/jquery-min.js" type="text/javascript"></script>
	<script src="{WB_URL}/include/jquery/jquery-ui-min.js" type="text/javascript"></script>
	<script src="{WB_URL}/include/jquery/jquery-insert.js" type="text/javascript"></script>
	<script src="{WB_URL}/include/jquery/jquery-include.js" type="text/javascript"></script>
	<link href="{WB_URL}/modules/postits/css/postits.css" rel="stylesheet" type="text/css" />
	<script src="{WB_URL}/modules/postits/javascript/postits.js" type="text/javascript"></script>

PostIts should now also appear in the backend part of WebsiteBaker intallation.

## Usage

If you followed all steps above, it's time to play with PostIts. Log into WebsiteBaker backend and create a new page of type `PostIts`. Select the users or groups you want to send a Postit. Make use of multi-selection to send the same message to several users at the same time. Type in a message (max. 150 characters) and press the submit button.

***Note:*** Postits only appear in the frontend/backend of Website Baker, if the PostIt recipient is loged in.

## Known Issues
You can track the status of known issues or report new issues found in PostIts via GitHubs [issue tracking service](https://github.com/cwsoft/wb-postits/issues). If you run into any issues with Postits, please visit this page first and check if this issue is already known.

## Questions
If you have questions or issues with Postits, please visit the [English](http://www.websitebaker2.org/forum/index.php/topic,4548.msg157963.html#msg157963) WebsiteBaker forum support threads and ask for feedback.

***Always provide the following information with your support request:***

 - detailed error description (what happens, what have you already tried ...)
 - the Postits version (go to WebsiteBaker section Add-ons / Info / Postits)
 - your PHP version (use phpinfo(); or ask your provider if in doubt)
 - WebsiteBaker version, Service Pack number and build number of your version
 - name of the WebsiteBaker frontent template used (e.g. round, allcss ...)
 - information about your operating system (e.g. Windows, Mac, Linux) incl. version
 - information of your browser and browser version used
 - information about changes you made to WebsiteBaker (if any)

## Credits
Credits goes to the WebsiteBaker forum user Marcus Jann ([Marcus70](http://www.websitebaker2.org/forum/index.php?action=profile;u=12071)), who maintained the PostIts module between April and September 2009.