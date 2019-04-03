<?php
  // This file is used to setup your ban panel. If you need help make a ticket on my website.

  // Your Steam API key, get this from https://steamcommunity.com/dev/apikey
  $steamapikey = "Some_Steam_API_Key";

  // The Password for running POST requests on api.php. Make sure this is set to the same thing as your config in the lua.
  $apipass = "Password101";

  // If access should be restricted to the panel.
  $restrictaccess = false;

  // The way the Dates are displayed. This is the american way by default.
  $datedisplay = "m/d/Y H:i:s";

  // SteamID64s allowed to use the Ban Panel if above is true.
  $steamidallowed = array("76561198121018313", "11111111111111111");

  // The SQL database stuff. It will create 2 tables by iteself.
  $sqlhost = "localhost"; // Host
  $sqluser = "root"; // Username
  $sqlpass = ""; // Password
  $sqlname = "GBanPanel"; // Database Name

  // The SQL Tables prefix.
  $sqlprefix = "gbanpanel_"
?>