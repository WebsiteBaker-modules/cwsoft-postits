# PostIts module for CMS WebsiteBaker (2.8.2)

The latest version and code changes of the ***wb-postits*** module can be found on [GitHub](https://github.com/cwsoft/wb-postits).

## About the PostIts module

The PostIts module allows you to send short text messages (150 characters) to users or groups via the WebsiteBaker backend. PostIts are automatically displayed on the screen, once the recipient logs into WebsiteBaker. PostIts can be displayed on the frontend and/or the backend of your WebsiteBaker installation. The sender can check, wheather his PostIts notes were already read by the recipient, by visiting the Postits page on the frontend (requires to be logged into WebsiteBaker).

***Note:*** In order to get PostIts automatically displayed on the frontend and/or backend, you may need to add the required jQuery files to the frontend and/or backend template files. The required steps are explained in more detail below. 

## Prerequisites

The PostIts module ***requires WebsiteBaker v2.8.2***.

Due to massive changes of the WebsiteBaker jQuery integration between WebsiteBaker 2.8.0 and 2.8.2, the PostIts module may not work with WB 2.8.0 or 2.8.1. For sure PostIts will not work with WB 2.7 or lower. If you need to get the PostIts module working for WebsiteBaker version prior to 2.8.2, you are pretty much on your own - sorry for that.

## Installation

The installation steps are explained below:

1. download the latest archive from [GitHub](https://github.com/cwsoft/wb-postits/downloads)
2. extract the downloaded archive on your local computer and unzip it e.g. with [7-zip](http://7-zip.org)
3. open the extracted archive and search for a file named ***wb-postits-installer.zip*** inside
4. log into your WebsiteBaker backend and go to the Add-ons / Modules section
5. install the ***wb-postits-installer.zip*** file with the WebsiteBaker installer
6. now go to the pages section and create a new page of type ***PostIts***
7. select a user and group (admin) and enter a test message for your first Postit
8. press the send postits button 
9. visit the Postits page on the frontend and check if PostIts are already shown

***Note:*** PostIts will only be displayed at your frontend and/or backend, if you add some lines to the frontend and/or template file. Sorry for that but WebsiteBaker does not yet have a nice API, which would allow module authors to register and load required module files automatically as known from other CMS systems, but this will be fixed with WB 2.9 (or latest WB 3.0) :-)

### Frontend template modifications

If you visit the PostIt page on the frontend and find a JavaScript message, you need to adapt the ***index.php*** of your frontend template. Best is to open the ***index.php*** of your default template with the admin tool [Addon File Editor](https://github.com/cwsoft/wb-addon-file-editor/downloads). If you do not have this handy tool installed yet, download and install it before proceeding. The default WebsiteBaker frontend template in WB 2.8.2 would be be */templates/round/index.php* (the part /round/ needs to be replaced with your frontend template).

Open the ***index.php*** with the Addon File Editor and search for the following lines

<pre>
if (function_exists('register_frontend_modfiles')) {
    register_frontend_modfiles('css');
    register_frontend_modfiles('js');
</pre>

and change it as follows:

<pre>
if (function_exists('register_frontend_modfiles')) {
    register_frontend_modfiles('css');
    register_frontend_modfiles('jquery');
    register_frontend_modfiles('js');
</pre>

The PostIts should now work on the frontend part of WebsiteBaker. Hust hit F5 or reload your page to check if it works. If it still doesn't work, check that you added the code above to the active template and you made no typos. 

### Backend template modifications (optional)

If you want to show PostIts also in the backend part of WebsiteBaker, you need to modify the template file ***header.htt*** of your backend theme. If you are using the default WebsiteBaker backend theme of WB 2.8.2, the file is located at */templates/wb_theme/templates/header.htt*. Open the file with the Addon File Editor and search for the following lines at the top of the file.

<pre>
<script src="{WB_URL}/include/jquery/jquery-min.js" type="text/javascript"></script>
<script src="{WB_URL}/include/jquery/jquery-insert.js" type="text/javascript"></script>
<script src="{WB_URL}/include/jquery/jquery-include.js" type="text/javascript"></script>
</pre>

and change it as follows:

<pre>
<script src="{WB_URL}/include/jquery/jquery-min.js" type="text/javascript"></script>
<script src="{WB_URL}/include/jquery/jquery-ui-min.js" type="text/javascript"></script>
<script src="{WB_URL}/include/jquery/jquery-insert.js" type="text/javascript"></script>
<script src="{WB_URL}/include/jquery/jquery-include.js" type="text/javascript"></script>
<link href="{WB_URL}/modules/postits/css/postits.css" rel="stylesheet" type="text/css" />
<script src="{WB_URL}/modules/postits/javascript/postits.js" type="text/javascript"></script>
</pre>

The PostIts should now also appear in the backend part of WebsiteBaker.

## Usage of PostIts

If you followed all steps above, it's time to play with PostIts. Log into WebsiteBaker backend and create a new page of type "PostIts". Select the users or groups you want to send a Postit. Make use of multi-selection to send the same message to several users at the same time. Type in a message (max. 150 characters) and press the submit button.

***Note:*** Postits only appear in the frontend/backend of Website Baker, if the PostIt recipient is loged in.