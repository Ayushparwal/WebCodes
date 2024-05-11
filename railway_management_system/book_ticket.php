<?php
// Database connection parameters
$servername = "localhost";
$port = 3307; // Adjust the port as needed
$username = "ayush";
$password = "Ayush@221004";
$database = "indiaRail";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle ticket booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $source = isset($_POST['source']) ? trim($_POST['source']) : null;
    $destination = isset($_POST['destination']) ? trim($_POST['destination']) : null;
    $date = isset($_POST['date']) ? trim($_POST['date']) : null;
    $train_id = isset($_POST['train_id']) ? intval($_POST['train_id']) : null; // Ensure train_id is an integer

    // Input validation
    if (empty($source) || empty($destination) || empty($date) || $train_id === null) {
        echo "Error booking ticket: Please provide all required information.";
        exit();
    }

    // Check if the TrainID exists in the trains table
    $check_train_sql = "SELECT * FROM trains WHERE TrainID = ?";
    $stmt = $conn->prepare($check_train_sql);
    $stmt->bind_param("i", $train_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Error booking ticket: Invalid TrainID";
        exit();
    }

    // Add code to check ticket availability and calculate fare
    // For demonstration purposes, let's assume the fare is 50.00
    $fare = 500.00; // Default fare
    // Add code to calculate fare based on distance, class, etc.

    $user_id = 1; // Assuming the user is logged in and their ID is 1

    $sql_book_ticket = "INSERT INTO Tickets (UserID, TrainID, BookingDate, Fare) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_book_ticket);
    $stmt->bind_param("iisd", $user_id, $train_id, $date, $fare);
    if ($stmt->execute()) {
        // Redirect back to booking history page after booking a ticket
        header("Location: booking_history.php");
        exit();
    } else {
        echo "Error booking ticket: " . $stmt->error;
    }
}

// Close the database connection
$conn->close();
?>
