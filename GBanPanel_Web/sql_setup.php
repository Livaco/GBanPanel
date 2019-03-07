<?php
  echo("<h1><b>Once this has completed delete the file sql_setup.php or people will be able to reset your bans!</b></h1>");
  echo("Creating SQL tables. ");

  include("config.php");
  $conn = new mysqli($sqlhost, $sqluser, $sqlpass, $sqlname);
  if($conn->connect_error) {
    die("SQL settings not setup correctly. Unable to connect.");
  }
  $sql1 = "CREATE TABLE `gbanpanel_bans` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `User` text,
 `Admin` text,
 `Reason` text,
 `Time` int(11) DEFAULT NULL,
 `Unban` int(11) DEFAULT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1";
  $result = $conn->query($sql1);
  if(!$result) {
    die("Unble to create table. Dying.");
  } else {
    die("Done. You can delete this file.");
  }
?>
