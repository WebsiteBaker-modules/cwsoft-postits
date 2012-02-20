# PostIts module for CMS WebsiteBaker (2.8.x)

The PostIts module allows you to send short text messages (150 characters) to other users or groups via the [WebsiteBaker CMS](http://www.websitebaker2.org) backend. The PostIts notes are automatically displayed at the frontend and/or backend, once the recipient logs into WebsiteBaker. The sender can check whether his note was already read by the recipient.

## Download
The latest stable PostIts [installation package](https://github.com/cwsoft/wb-postits/raw/master/wb-postits-installer.zip) for the WebsiteBaker CMS is included in the GitHub master branch. Older versions are available as [archives](https://github.com/cwsoft/wb-postits/tags), but are ***NOT*** directly installable in the WebsiteBaker CMS. The history of the PostIts module can be tracked via [GitHub](https://github.com/cwsoft/wb-postits).

## License
The Postits module is licensed under the [GNU General Public License (GPL) v3.0](http://www.gnu.org/licenses/gpl-3.0.html).

## Requirements

The minimum requirements to get PostIts running are as follows:

- WebsiteBaker CMS v2.8.x series (requiring ***v2.8.2 or higher***)
- PHP 5.2.17 (recommended: last stable version of the PHP 5.3.x series)
- small modifications on frontend (optional backend) template file

## Installation

1. download latest stable [WebsiteBaker installation package](https://github.com/cwsoft/wb-postits/raw/master/wb-postits-installer.zip)
2. log into your WebsiteBaker backend and go to the `Add-ons/Modules` section
3. install the downloaded zip archive via the WebsiteBaker installer
4. go to the pages section and create a new page of type `PostIts`
5. select a user and group (admin) and enter a test message for your first Postit
6. press the send postits button 
7. follow the steps below to get PostIts displayed in frontend and/or backend

### Frontend template modifications (OBLIGATORY)

If you visit the PostIt page on the frontend and find a JavaScript message, you need to adapt the `index.php` of your frontend template. Open the file `index.php` of your default template with the WebsiteBaker admin tool [Addon File Editor](https://github.com/cwsoft/wb-addon-file-editor/downloads). If you do not have this handy tool installed yet, download and install it before proceeding. The default WebsiteBaker frontend template in WB 2.8.3 is `/templates/round/index.php`.

Open the file `index.php` with the Addon File Editor and search for the following lines.

<pre>
if (function_exists('register_frontend_modfiles')) {
    register_frontend_modfiles('css');
    register_frontend_modfiles('js');
</pre>

Change the lines above as follows:

<pre>
if (function_exists('register_frontend_modfiles')) {
    register_frontend_modfiles('css');
    register_frontend_modfiles('jquery');
    register_frontend_modfiles('js');
</pre>

PostIts now appear in the frontend of your WebsiteBaker installation once the recipient has loged in. Reload the frontend view in your browser (F5) to see if it works. If it doesn't work, check that you added the code above to the frontend template defined via WebsiteBaker and you made no typos.

### Backend template modifications (OPTIONAL)

If you want to show PostIts also in the backend part of WebsiteBaker, you need to modify the template file `header.htt` of your backend theme. For the default backend theme of WebsiteBaker 2.8.3, the file is found at `/templates/wb_theme/templates/header.htt`. Open the file with the [Addon File Editor](https://github.com/cwsoft/wb-addon-file-editor/downloads) and search for the following lines at the top of the file.

<pre>
&lt;script src="{WB_URL}/include/jquery/jquery-min.js" type="text/javascript"></script>
&lt;script src="{WB_URL}/include/jquery/jquery-insert.js" type="text/javascript"></script>
&lt;script src="{WB_URL}/include/jquery/jquery-include.js" type="text/javascript"></script>
</pre>

Change the lines above as follows:

<pre>
&lt;script src="{WB_URL}/include/jquery/jquery-min.js" type="text/javascript"></script>
&lt;script src="{WB_URL}/include/jquery/jquery-ui-min.js" type="text/javascript"></script>
&lt;script src="{WB_URL}/include/jquery/jquery-insert.js" type="text/javascript"></script>
&lt;script src="{WB_URL}/include/jquery/jquery-include.js" type="text/javascript"></script>
&lt;link href="{WB_URL}/modules/postits/css/postits.css" rel="stylesheet" type="text/css" />
&lt;script src="{WB_URL}/modules/postits/javascript/postits.js" type="text/javascript"></script>
</pre>

The PostIts should now also appear in the backend part of WebsiteBaker.

## Usage

If you followed all steps above, it's time to play with PostIts. Log into WebsiteBaker backend and create a new page of type `PostIts`. Select the users or groups you want to send a Postit. Make use of multi-selection to send the same message to several users at the same time. Type in a message (max. 150 characters) and press the submit button.

***Note:*** Postits only appear in the frontend/backend of Website Baker, if the PostIt recipient is loged in.

## Needing help ??
If you run into problems with the PostIts module, please visit the [English](http://www.websitebaker2.org/forum/index.php/topic,12122) or [German](http://www.websitebaker2.org/forum/index.php/topic,13124) WebsiteBaker forum support threads and ask for feedback. 

***Always provide the following information with your support request:***

 - detailed error description (what happens, what have you tried ...)
 - the PostIts module version (see file /modules/postits/index.php on your server)
 - your PHP version (use phpinfo(); or ask your provider if in doubt)
 - WebsiteBaker version, Service Pack number and build number of your version
 - name of your frontend and backend template
 - information about changes you made to WebsiteBaker (if any)

## Credits
Credits goes to the WebsiteBaker forum user Marcus Jann ([Marcus70](http://www.websitebaker2.org/forum/index.php?action=profile;u=12071)), who maintained the PostIts module between April and September 2009.