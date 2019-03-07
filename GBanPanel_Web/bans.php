<html>
  <head>
    <link rel="stylesheet" href="assets/css/index.css">
  </head>
  <?php
  function relativeTime($time) { // Thanks https://stackoverflow.com/questions/2690504/php-producing-relative-date-time-from-timestamps (xdebug's answer)
    $d[0] = array(1,"second");
    $d[1] = array(60,"minute");
    $d[2] = array(3600,"hour");
    $d[3] = array(86400,"day");
    $d[4] = array(604800,"week");
    $d[5] = array(2592000,"month");
    $d[6] = array(31104000,"year");

    $w = array();

    $return = "";
    $now = time();
    $diff = ($now-$time);
    $secondsLeft = $diff;

    for($i=6;$i>-1;$i--)
    {
         $w[$i] = intval($secondsLeft/$d[$i][0]);
         $secondsLeft -= ($w[$i]*$d[$i][0]);
         if($w[$i]!=0)
         {
            $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'s':'') ." ";
         }

    }

    $return .= ($diff>0)?"ago":"left";
    return $return;
  }

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
          <title>Bans - GBanPanel</title>
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
            <div class="panel-container">
              <p>View our bans.</p>
              <table id="bans">
                <tr>
                  <th>User</th>
                  <th>Admin</th>
                  <th>Reason</th>
                  <th>Banned</th>
                  <th>Unban at</th>
                </tr>
              <?php
              // Page setup
              $perpage = 20;

              if(isset($_GET['page'])) {
                $page = $_GET['page'];
              } else {
                $page = 1;
              }
              $start = ($page - 1) * $perpage;

              $sql = "SELECT * FROM ".$sqlprefix."bans ORDER BY ID DESC LIMIT {$start}, {$perpage}";
              $result = $conn->query($sql);
              $addnumber = false;
              $rows = 0;

              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                    <th id="user"><?php echo $row['User']; ?> </th>
                    <th id="admin"><?php echo $row['Admin']; ?> </th>
                    <th id="reason"><?php echo $row['Reason']; ?> </th>
                    <th id="time"><?php echo relativeTime($row['Time']); ?> </th>
                    <?php
                    if($row['Unban'] == 0) {
                      $unbantime = "Never";
                    } else {
                      $unbantime = relativeTime($row['Unban']);
                    }
                    ?>
                    <th id='unban'><?php echo($unbantime)?></th>
                  </tr>
                  <?php
                  }
                } else {
                  echo("<p>No bans found!</p>");
                }
              ?>
            </table>
            <br>
            <?php
              $sql2 = "SELECT COUNT(ID) AS total FROM ".$sqlprefix."bans";
              $result2 = $conn->query($sql2);
              $row2 = $result2->fetch_assoc();
              $total_pages = ceil($row2["total"] / $perpage);

              for ($i=1; $i<=$total_pages; $i++) {
                ?>
                <button class="page-button" onclick="location.href = 'bans.php?page=<?php echo $i ?>';"><?php echo $i;?></button>
                <?php
              };
            }
            ?>
            <br>
            <button class="login-button" onclick="location.href = 'index.php'">Home</button>
          </div>
        </body>
<html>