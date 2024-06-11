<?php
session_start();

// Check if the engineer is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to the login page
    exit();
}

// Access the session variables
$username = $_SESSION['username'];
$idNumber = $_SESSION['idNumber'];
$fullname = $_SESSION['fullname'];
$dir= $_SESSION['directorate'];

// You can now use the session variables in your dashboard page
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SDL Document Tracking System</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
  <link href="kilimo.png" rel="icon">
  <link href="assets/logo.png" rel="apple-touch-icon">


    <link rel="apple-touch-icon" href="kilimo.png">
    <link rel="shortcut icon" href="kilimo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
    <style>
    .content {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .send-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #a5c90f;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .send-button:hover {
        transform: scale(1.1);
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    }

    h2 {
        color: #a5c90f;
        animation: colorChange 3s infinite alternate;
    }

    @keyframes colorChange {
        from {
            color: #000;
        }
        to {
            color: #a5c90f;
        }
    }
</style>
<style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #a5c90f;
            background-color: white;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #a5c90f;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #a5c90f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #92b30f; /* Slightly darker color on hover */
        }

        input[type="text"]:hover,
        input[type="date"]:hover,
        textarea:hover {
            border-color: #92b30f;
        }

        .field-description {
            font-size: 12px;
            color: #a5c90f;
        }
        h1 {
        color: #a5c90f;
    }
    h2{
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    label input[type="checkbox"] {
        margin-right: 10px;
    }
    table {
       margin: 0 auto;
       border-collapse: collapse;
       width: 80%;
    }

    th, td {
       padding: 8px;
       text-align: left;
       color: black;
    }

    th {
       background-color:#a5c90f;
       color: white;
    }

    tr:nth-child(even) {
       background-color: #f2f2f2;
    }
    tr:nth-child(odd) {
       background-color: ;
    }

    tr:hover {
       background-color: #d4d4d4;
    }

    </style>
</head>


<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="userDashboard.php" style="color: #a5c90f;"><i class="menu-icon fa fa-laptop"></i> Dashboard </a>
                    </li>
                    <li class="active">
                        <a href="incomingLetters.php" style="color: #a5c90f;"><i class="menu-icon pe-7s-cash"></i> Incoming Letters </a>
                    </li>
                    <li class="active">
                        <a href="sentLetters.php" style="color: #a5c90f;"><i class="menu-icon pe-7s-cart"></i> Sent Letters</a>
                    </li>
                    <li class="active">
                        <a href="passingByLetters.php" style="color: #a5c90f;"><i class="menu-icon fa fa-envelope-open "></i> PassingBy Letters</a>
                    </li>
                    <li class="active">
                        <a href="outgoingLetters.php" style="color: #a5c90f;" ><i class="menu-icon fa fa-share "></i> OutGoing Letters </a>
                    </li>
                         
                    <li class="menu-item-has-children dropdown">
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
         <header id="header" class="header" style="background-color: #ECFFDC;">
            <div class="top-left">
                <div class="navbar-header" style="background-color: #ECFFDC;">
                    <a class="navbar-brand" href="userDashboard.php"><img src="sdl.png" alt="" width="100%"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "dts";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
   die('Connect Error(' . mysqli_connect_errno() . ')');
} else {

   // Retrieve all sent messages by the user
   $sql = "SELECT * FROM letters WHERE $dir = 'Received'";

   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      echo "<h2><span class='theme-text'>OutGoing</span> <span class='accepted-jobs'>Letters</span></h2>";
      echo "<table>";
      echo "<tr><th>SerialNumber</th><th>Sender</th><th>Destination</th><th>Subject</th><th>Action</th></tr>";

      while ($row = $result->fetch_assoc()) {
         $serial = isset($row['serial_number']) ? $row['serial_number']: '';
         $senderName = isset($row['sender']) ? $row['sender'] : '';
         $sentTo = isset($row['final_destination']) ? $row['final_destination'] : '';
         $subject= isset($row['subject']) ? $row['subject'] : '';

         echo "<tr>";
         echo "<td>$serial</td>";
         echo "<td>$senderName</td>";
         echo "<td>$sentTo</td>";
         echo "<td>$subject</td>";
         echo "<td><button onclick=\"acceptAssignment('$serial')\">Forward</button></td>";
         echo "</tr>";
      }

      echo "</table>";
   } else {
      echo "<p>No passing by letters found in the database.</p>";
   }

   $conn->close();
}
?>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer" style="background-color: #a5c90f;">
            <div class="footer-inner" style="background-color: #a5c90f;">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
    <script>
   function acceptAssignment(id) {
      window.location.href = "forwardLetters.php?id=" + id;
   }
</script>

    
</body>
</html>
