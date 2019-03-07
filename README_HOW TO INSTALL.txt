Installing the Ban Panel requres the following:
Webserver running PHP Version 5.2
MySQL Database (W/ PHPMyAdmin if you want to modify the Database)

Note that the Database can be local to your Webserver, the website has a api.php that adds all the SQL stuff for you. The way it authenticates is with a password you set and with your SteamAPIKey (more on that later).

To install the WEBSERVER
---------------------------------
Goto your Webserver's Directory and extract the files from the folder GBanPanel_Web in the archive into it. Then go into the files and go inside config.php
Modify it to your settings and then go into the Ban Panel's directory with a web browser. You should be redirected to sql_setup.php, where it will create the SQL Tables inside the Database.
If successfully created, delete that file otherwise someone can recreate your SQL tables. Go into your Index, login and you should be good to go for the website.

To install the GARRY'S MOD ADDON
---------------------------------
Extract the addon's folder called gbanpanel_lua into your addon's folder of your server. Goto lua/gbanpanel/config/config.lua and modify it to what your settings are. Restart your server and you should be done.

If you are having issues setting up the ban panel, goto livaco.tk and make a ticket on the dashboard, and i'l assist you. Good luck!