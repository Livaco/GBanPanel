<html>
  <head>
    <link rel="stylesheet" href="assets/css/index.css">
  </head>
  <?php
    include("config.php");
    $conn = new mysqli($sqlhost, $sqluser, $sqlpass, $sqlname);
    if($conn->connect_error) {
      die("SQL settings not setup correctly. Unable to connect.");
    }
    $sql1 = "DESCRIBE `".$sqlprefix."bans`";
    $result = $conn->query($sql1);
    if(!$result) {
      header("Location: sql_setup.php");
      die();
    }

    require('steamauth/steamauth.php');
    if(!isset($_SESSION['steamid'])) {
      ?>
        <head>
          <title>Login - GBanPanel</title>
        </head>
        <body>
          <div class="login-container">
            <p>Welcome to GBanPanel. Please sign in.</p>
            <button class="login-button" onclick="location.href = '?login';" >Login through Steam</button>
          </div>
        </body>
      <?php
    } else {
      include("steamauth/userInfo.php")
      ?>
        <head>
          <title>Index - GBanPanel</title>
        </head>
        <body>
          <?php
            if($restrictaccess == true) {
              if(in_array($steamprofile['steamid'], $steamidallowed) == false) {
                ?>
                  <div class="login-container">
                    <p>Sorry. You do not have access to this page.</p>
                    <button class="login-button" onclick="location.href = '?logout';" >Logout</button>
                  </div>
                <?php
                die("");
              }
            }
          ?>
          <div class="login-container">
            <p>Welcome to GBanPanel. Please select an option.</p>
            <button class="login-button" onclick="location.href = 'bans.php';" >View Bans</button>
            <button class="login-button" onclick="location.href = '?logout';" >Logout</button>
          </div>
        </body>
      <?php
    }
  ?>
<html>