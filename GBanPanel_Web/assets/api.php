<?php
  set_include_path("../");
  include("../config.php");
  if(isset($_POST)) {
    if($_POST['Password'] != $apipass) {
      die("Wrong password!");
    } else {
      if($_POST['SteamAPIKey'] != $steamapikey) {
        die("Wrong Steam API Key.");
      } else {
        include("config.php");
        $conn = new mysqli($sqlhost, $sqluser, $sqlpass, $sqlname);
        if($conn->connect_error) {
          die("SQL settings not setup correctly. Unable to connect.");
        }
        $sqluservalue = $conn->real_escape_string($_POST['User']);
        $sqladminvalue = $conn->real_escape_string($_POST['Admin']);
        $sqlreasonvalue = $conn->real_escape_string($_POST['Reason']);
        $sqltimevalue = $_POST['Timee'];
        $sqlunbanvalue = $_POST['Unban'];

        $sql1 = "INSERT INTO `{$sqlprefix}bans`(`User`, `Admin`, `Reason`, `Time`, `Unban`) VALUES('{$sqluservalue}', '{$sqladminvalue}', '{$sqlreasonvalue}', '{$sqltimevalue}', '{$sqlunbanvalue}')";
        if ($conn->query($sql1) === TRUE) {
          die("Ban added to Panel.");
        } else {
          die("ERROR: " . $sql1 . " <br> - ERROR - " . $conn->error);
        }
      }
    }
  }
?>