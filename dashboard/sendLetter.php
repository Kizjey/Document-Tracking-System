<?php
session_start();

// Check if the engineer is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: adminLogin.html"); // Redirect to the login page
    exit();
}

// Access the session variables
$username = $_SESSION['username'];
$idNumber = $_SESSION['idNumber'];
$fullname = $_SESSION['fullname'];

// You can now use the session variables in your dashboard page
?>
<?php
// Replace these with your actual database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dts';

// Connect to the database
$connection = new mysqli($host, $username, $password, $database);
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
    $finalDestination = $_POST['final_destination'];
    $destination1 = $_POST['destination1'];
    $destination2 = $_POST['destination2'];
    $destination3 = $_POST['destination3'];
    $destination4 = $_POST['destination4'];
    $destination5 = $_POST['destination5'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // Insert data into the letters table
    $query = "INSERT INTO letters (serial_number, date, sender, final_destination, destination1, destination2, destination3, destination4, destination5, subject, content) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssssssssss", $serialNumber, $date, $sender, $finalDestination, $destination1, $destination2, $destination3, $destination4, $destination5, $subject, $content);
    $stmt->execute();

    // Redirect to a success page or perform other actions
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Letter</title>
</head>
<body>
    <form action="sendLetter.php" method="post">
        Serial Number: <input type="text" name="serial_number" value="<?php echo generateSerialNumber($connection); ?>" readonly><br>
        Date: <input type="date" name="date"><br>
        Sender: <input type="text" name="sender" value="<?php echo $fullname; ?>" readonly><br>
        Final Destination: <input type="text" name="final_destination"><br>
        Intermediate Destinations (up to 5): <br>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "Intermediate Destination $i: <input type='text' name='destination$i'><br>";
        }
        ?>
        Subject: <input type="text" name="subject"><br>
        Content: <textarea name="content"></textarea><br>
        <input type="submit" value="Send Letter">
    </form>
</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
