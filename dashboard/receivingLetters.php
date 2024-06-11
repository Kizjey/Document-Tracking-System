<?php
session_start();

// Check if the engineer is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: staffLogin.html"); // Redirect to the login page
    exit();
}

// Access the session variables
$username = $_SESSION['username'];
$idNumber = $_SESSION['idNumber'];
$fullname = $_SESSION['fullname'];
$dir = $_SESSION['directorate']; 

// You can now use the session variables in your dashboard page
?>

<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "dts";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
   die('Connect Error(' . mysqli_connect_errno() . ')');
} else {
   // Check if the ID parameter is provided
   
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Define the list of recipients
    $recipients = array('DLP', 'AUDIT', 'CFO', 'POLICY', 'PLANNING', 'CAS', 'DA', 'SA', 'DHRM', 'PS');

    // Build a SQL query to check if any recipient has the status 'Received' or 'Incoming'
    $checkQuery = "SELECT COUNT(*) AS num_matching FROM letters WHERE serial_number = '$id' AND (";
    foreach ($recipients as $recipient) {
        $checkQuery .= "$recipient = 'Received' OR $recipient = 'Incoming' OR ";
    }
    $checkQuery = rtrim($checkQuery, "OR "); // Remove the trailing "OR"
    $checkQuery .= ")";

    // Execute the query
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        $numMatching = $row['num_matching'];

        if ($numMatching > 0) {
            // At least one recipient has the status 'Received' or 'Incoming'
            echo "<script language=\"JavaScript\">\n";
            echo "alert('The letter has not been cleared by all recipients yet. It cannot be received.');\n";
            echo "window.location='incomingLetters.php'";
            echo "</script>";
        } else {
            // No recipient has the status 'Received' or 'Incoming'
            // Allow the user to receive the letter
            $updateQuery = "UPDATE letters SET status = 'Received' WHERE serial_number = '$id'";
            if ($conn->query($updateQuery) === TRUE) {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Letter was received successfully.');\n";
                echo "window.location='incomingLetters.php'";
                echo "</script>";
            } else {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Error updating letter status:');\n";
                echo "window.location='incomingLetters.php'";
                echo "</script>";
            }
        }
    } else {
        echo "<script language=\"JavaScript\">\n";
        echo "alert('Error executing the query.');\n";
        echo "window.location='incomingLetters.php'";
        echo "</script>";
    }
} else {
    echo "<script language=\"JavaScript\">\n";
    echo "alert('No letter ID provided.');\n";
    echo "window.location='incomingLetters.php'";
    echo "</script>";
}


   $conn->close();
}
?>
