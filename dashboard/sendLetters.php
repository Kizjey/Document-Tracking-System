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

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

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

    label {
        display: block;
        margin-bottom: 10px;
    }

    label input[type="checkbox"] {
        margin-right: 10px;
    }
    </style>
</head>
<?php
// Replace these with your actual database connection details
$host = 'localhost';
$databaseusername = 'root';
$password = '';
$database = 'dts';

// Connect to the database
$connection = new mysqli($host, $databaseusername, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

function generateSerialNumber($connection) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $serialNumber = '';

    // Generate a serial number with a length of 4 characters
    for ($i = 0; $i < 4; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $serialNumber .= $characters[$randomIndex];
    }

    // Check if the generated serial number already exists
    $query = "SELECT * FROM letters WHERE serial_number = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $serialNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the serial number exists, generate a new one recursively
        return generateSerialNumber($connection);
    }

    return $serialNumber;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data including intermediate destinations
    $serialNumber = $_POST['serial_number'];
    $date = $_POST['date'];
    $sender = $_POST['sender'];
    $username = $_POST['username'];
    $finalDestination = $_POST['final_destination'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // Initialize an array to store the selected intermediate destinations
    $selectedDestinations = array();

    // Loop through the intermediate destinations and check if they were selected
    $intermediateDestinations = array("DLP", "POLICY", "AUDIT", "PLANNING", "CFO", "CAS", "DA", "SA", "DHRM", "PS");
    foreach ($intermediateDestinations as $destination) {
        if (isset($_POST[$destination])) {
            $selectedDestinations[$destination] = "Incoming";
        } else {
            $selectedDestinations[$destination] = "";
        }
    }

    // Insert data into the letters table
    $query = "INSERT INTO letters (serial_number, date, sender, username, final_destination, DLP, POLICY, AUDIT, PLANNING, CFO, CAS, DA, SA, DHRM, PS, subject, content) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $connection->prepare($query);

    // Use implode to convert the selected destinations array to a string
    $selectedDestinationsString = implode("", $selectedDestinations);

    // Use the selected destinations in the bind_param call
    $stmt->bind_param("sssssssssssssssss", $serialNumber, $date, $sender, $username, $finalDestination, $selectedDestinations['DLP'], $selectedDestinations['POLICY'], $selectedDestinations['AUDIT'], $selectedDestinations['PLANNING'], $selectedDestinations['CFO'], $selectedDestinations['CAS'], $selectedDestinations['DA'], $selectedDestinations['SA'], $selectedDestinations['DHRM'], $selectedDestinations['PS'], $subject, $content);
    if ($stmt->execute()) {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Letter was sent successfully.');\n";
                echo "window.location='userDashboard.php'";
                echo "</script>";
} else {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Letter could not be sent.');\n";
                echo "window.location='userDashboard.php'";
                echo "</script>";
}

    // Redirect to a success page or perform other action
   
}

?>

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
                    <a class="navbar-brand" href="index.html"><img src="sdl.png" alt="" width="100%"></a>
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
        <form action="sendLetters.php" method="post">
        <label for="serial_number">Serial Number</label>
        <input type="text" name="serial_number" value="<?php echo generateSerialNumber($connection); ?>" readonly>
        <div class="field-description">This serial number will be used to track the letter.</div>

        <label for="date">Date</label>
        <input type="date" name="date">
        <div class="field-description">Select the date of the letter.</div>

        <label for="sender">Sender</label>
        <input type="text" name="sender" value="<?php echo htmlspecialchars($fullname); ?>" readonly>
        <div class="field-description">This field is prepopulated with your name as the sender.</div>

        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

        <label for="final_destination">Final Destination</label>
        <select name="final_destination">
            <option value="">Select a Destination</option>
            <option value="DLP">DLP</option>
            <option value="PLANNING">PLANNING</option>
            <option value="DHRM">DHRM</option>
            <option value="POLICY">POLICY</option>
            <option value="AUDIT">AUDIT</option>
            <option value="SA">SA</option>
            <option value="DA">DA</option>
            <option value="CF4">CF4</option>
            <option value="PS">PS</option>
            <option value="CAS">CAS</option>
        </select>
        <div class="field-description">Select the final destination of the letter.</div>
        <h1>Select To Add More Destinations</h1>

      <?php
$intermediateDestinations = array("DLP", "POLICY", "AUDIT", "PLANNING", "CFO", "CAS", "DA", "SA", "DHRM", "PS");

foreach ($intermediateDestinations as $destination) {
    echo '<label>';
    echo '<input type="checkbox" name="' . $destination . '" value="Incoming"> ' . $destination;
    echo '</label>';
}
?>





        <label for="subject">Subject</label>
        <input type="text" name="subject">
        <div class="field-description">Enter the subject of the letter.</div>

        <label for="content">Content</label>
        <textarea name="content"></textarea>
        <div class="field-description">Enter the content of the letter.</div>

        <input type="submit" value="Send Letter">
    </form>
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

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
</body>
</html>
