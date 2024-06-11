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
<?php
if (isset($_GET['id'])) {
    $serial = $_GET['id'];

    // Include your database connection logic here
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "dts";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() . ')');
    }

    // Update the $dir field to 'Received' for the specified serial number
    $updateSql = "UPDATE letters SET $dir = 'Forwarded' WHERE serial_number = '$serial'";
    if ($conn->query($updateSql) === TRUE) {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Letter was forwarded successfully.');\n";
                echo "window.location='outgoingLetters.php'";
                echo "</script>";
    } else {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Letter couold not be forwarded.');\n";
                echo "window.location='outgoingLetters.php'";
                echo "</script>";
    }

    $conn->close();
} else {
    echo "error number";
}
?>
