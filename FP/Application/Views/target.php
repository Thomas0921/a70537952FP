<?php
spl_autoload_register(function ($class) {


    if (strpos($class, "Base") === 0) {
        require '../Framework/' . $class . '.php';
    } else if (strpos($class, "Model")) {
        require '../Models/' . $class . '.php';
    } else if (strpos($class, "Object")) {
        require '../Objects/' . $class . '.php';
    }else{
        require "../../Helper/".$class.".php";
    }

});
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {

    $userModel = new UserModel();
    $jj = $userModel->Login($_SESSION["email"], $_SESSION["password"], $_SERVER["REMOTE_ADDR"]);

    if ($jj instanceof UserObject) {





    } else {
        echo "Error!" . mysql_error();
        session_unset();
        session_destroy();
        header("Location: ../../index.php");

    }

// echo "已登录";
} else {
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
    // echo "未登录";
    //echo "请重新登录";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="../../Public/css/bootstrap1.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Public/css/MDB PRO 4.2.0.css">
    <link href="../../Public/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Public/css/header.css">
    <link rel="stylesheet" type="text/css" href="../../Public/css/target.css">



    <script src="../../Public/js/jquery-3.1.1.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Tooltips -->
    <script type="text/javascript" src="../../Public/js/tether.min.js"></script>
    <!-- Bootstrap core JavaScript -->

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../../Public/js/mdb.min.js"></script>
    <script src="../../Helper/footable-standalone.latest/js/footable.min.js"></script>
    <script src="../../Helper/js-cookie-1.5.1/src/js.cookie.js"></script>
    <script src="../../Public/js/moment.js"></script>
    <script src="../../Public/js/header.js"></script>
    <script src="../../Public/js/target.js"></script>

</head>
<body class="fixed-sn hideXScroll">
<header>

    <!-- Sidebar navigation -->
    <ul id="mySidenav" class="side-nav fixed sidenav" style="z-index: 11;">

<span id="navControl" class="collapsible-header waves-effect"
      style="font-size:30px;cursor:pointer;text-align: center;display: inline-block;width:100%;margin-top: 10px;"
      onclick="setNav()">&#9776; </span>
        <!-- Logo -->
        <li id="userLogo" style="display: none;">
            <div class="logo-wrapper waves-light sn-avatar-wrapper">
                <a href="Application/Controllers/UserProfile.php">
                    <img src="<?php echo " ../../Public/uploads/".$jj->UserImage;?>" class="img-circle">
                </a>
            </div>
        </li>
        <!--/. Logo -->

        <!--Social-->
        <!--RED,PURPLE,DARK,MDB,GRAPHITE,PINK-->
        <li id="colorStyle" style="display: none">
            <ul class="social">
                <li><a class="icons-sm fb-ic" onclick="changeStyle('red')"><i class="fa fa-square" style="color: #900"> </i></a></li>
                <li><a class="icons-sm git-ic" onclick="changeStyle('purple')"><i class="fa fa-square" style="color: #54057d"> </i></a></li>
                <li><a class="icons-sm li-ic" onclick="changeStyle('green')"><i class="fa fa-square" style="color: #003830"> </i></a></li>
                <li><a class="icons-sm yt-ic" onclick="changeStyle('mdb')"><i class="fa fa-square" style="color: #3f729b"> </i></a></li>
                <li><a class="icons-sm gplus-ic" onclick="changeStyle('graphite')"><i class="fa fa-square" style="color: #37474f"> </i></a></li>
                <li><a class="icons-sm li-ic" onclick="changeStyle('pink')"><i class="fa fa-square" style="color: #ab1550"> </i></a></li>

            </ul>
        </li>


        <!--/Social-->

        <!-- Side navigation links -->
        <li id="sideNavItem" style="display: none">
            <ul class="collapsible collapsible-accordion">
                <li><a href="../../index.php" collapsible-header waves-effect"><i
                        class="fa fa-home"></i>Home</i></a></li>
                <li><a href="UserProfile.php" collapsible-header waves-effect"><i
                        class="fa fa-user"></i>Profile</i></a></li>
                <li><a href="Ranking.php" class="collapsible-header waves-effect"><i class="fa fa-table"></i>Ranking</i></a></li>
                <li><a href="ScheduleSetting.php" class="collapsible-header waves-effect"><i class="fa fa-gear"></i>Schedule Setting</i></a></li>
                <!-- <li><a class="collapsible-header waves-effect"><i class="fa fa-bar-chart"></i>Marketing</i></a></li>
                 <li><a class="collapsible-header waves-effect"><i class="fa fa-pencil"></i> Contact</i></a></li>
                 <li><a class="collapsible-header waves-effect"><i class="fa fa-user"></i> About</i></a></li>-->
            </ul>
        </li>

        <!--/. Side navigation links -->


    </ul>

    <!--/. Sidebar navigation -->

    <!--Navbar-->
    <nav class="navbar navbar-fixed-top scrolling-navbar double-nav main col-lg-12 col-md-12 col-sm-12"
         style="padding-left: 100px;z-index: 10; transition: 0.5s;">

        <!-- SideNav slide-out button -->


        <!-- Breadcrumb-->
        <div class="breadcrumb-dn">
            <p>Welcome,</p>
        </div>


        <ul onclick="showLogout()"id="profile" class="nav navbar-nav pull-right  ">


            <li id="logout"class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $jj->
                    FirstName;?></a>
                <div class="dropdown-menu dropdown-primary dd-right" aria-labelledby="dropdownMenu1"
                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                    <a class="dropdown-item"
                       href="Logout.php">Logout</a>
                </div>
            </li>
        </ul>

    </nav>
    <!--/.Navbar-->

</header>
<div id="wrapper" class="wrapper transition" style="min-height:1000px;">
<div>
<div>
<div id="popup1" class="popup-position">
    <div id="popup-wrapper">
      <div id="popup-container">

    <!--../Controllers/TargetInsert.php-->
    <form action="../Controllers/TargetInsert.php" method="post">
  <table>
    <tr>
      <td style="color: black;">
        Target Name:
      </td>
      <td>
        <input type="text" name="Target_Name">
      </td>
    </tr>
    <tr>
      <td style="color: black;">
        Target Amount:
      </td>
      <td>
        <input type="text" name="Target_Amount">
      </td>
    </tr>
    <tr>
      <td style="color: black;">
        Target Achieve Date:
      </td>
      <td>
        <input type="date" name="Target_AchieveDate" id="Target_AchieveDate" onfocus="dateDiff()">
      </td>
    </tr>
          <!-- no use for showing textbox
          <tr>
            <td>
              Target Days:
            </td>
            <td>
              <input type="text" name="Target_Days" id="Target_Days">
            </td>
          </tr>
        -->
        </table>
          <input type="submit">
          </form>
          <a  href="javascript:void(0)"onclick="toggle_visibility('popup1');">Close</a>

      </div><!--popup_container ends-->
    </div><!--popup-wrapper ends-->
</div><!--popup1 ends-->


<!--Progress Bar new-->
<style type="text/css">
.container{
  margin: 0 auto;
  width: 65%;
  text-align: center;
}
.outter{
  height:25px;
  width:100%;
  border:solid 1px #000;
}
.inner{
  height:25px;
  border-right:solid 1px #000;
  background-color: lightblue;
}
</style>
<div class="container">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Finance";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Target_EnterDate, Target_Days, Target_Name, Target_Amount FROM target ORDER BY Target_AchieveDate LIMIT 5";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
if (mysqli_num_rows($result) >= 5) {
  ?>
  <style>
    #AddTargetLink{
      Display:none;
    }
  </style>
  <?php
}
  while($row = mysqli_fetch_assoc($result)) {
    echo $row["Target_Name"];
    /*
    echo "<br>";
    echo "Target_EnterDate: " . $row["Target_EnterDate"];
    echo "</br>";
    echo " Target_Days: " . $row["Target_Days"]. "<br>";
    echo "Today: ";
    echo date("Y-m-d");
    */
    echo "<br>";
    $Target_EnterDate = strtotime($row["Target_EnterDate"]);
    $today = time();
    $datediff = $today - $Target_EnterDate;
    $answer = round(($datediff / (60 * 60 * 24)),0);
    $Target_Days = $row["Target_Days"];
    $percent = round(($answer/$Target_Days) * 100,1);
    $TargetPerDay = $row["Target_Amount"]/$Target_Days;
    $AmountLeft = $row["Target_Amount"] - ($answer * $TargetPerDay);
    $AmountleftRounded = round($AmountLeft,1);
    if ($percent >= 100) {
      echo "<p style=\" display:inline;\">";
      echo "Congratulation! ";
      echo "<br>";
      echo "You have save RM";
      echo $row["Target_Amount"];
      echo " in ";
      echo $Target_Days;
      echo " Days!";
      echo "</p>";
      echo "<div class=\"outter\">";
      echo "<div class=\"inner\"  style=\"width:100%; background-color: green;\"";
    } else {
      echo "You have to save RM";
      echo $AmountleftRounded;
      echo " more in ";
      echo "$answer Days Left";
      echo "<br>";
      echo "Percentage: $percent%";
      echo "<br>";
      echo "<div class=\"outter\">";
      echo "<div class=\"inner\"  style=\"width:";
      echo $percent;
      echo "%";
      echo ";\">";
    }

    echo "</div>";
    echo "</div>";

    echo "<br>";


}
} else {
echo "0 results";
}

mysqli_close($conn);
?>
<!--Progress Bar new ends-->

  <div id="AddTargetLink" style="border:10px;"><a href="javascript:void(0)" onclick="toggle_visibility('popup1');">Add Target</a></div>
  <a href="TargetDisplay.php">See Details</a>
</div>

</div>

</body>

</html>
