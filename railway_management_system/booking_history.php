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

// Fetch booking history data with source and destination from Tickets and Trains tables
$sql = "SELECT t.TicketID, t.TrainID, tr.Source, tr.Destination, t.BookingDate, t.Fare, t.Status FROM Tickets t
        INNER JOIN Trains tr ON t.TrainID = tr.TrainID"; // Join Tickets with Trains table
$result = $conn->query($sql);

// Array to hold booking history data
$booking_history = array();

// Check for errors in query execution
if (!$result) {
    die("Error fetching booking history: " . $conn->error);
}

// Fetch booking history data and store it in the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Sanitize output to prevent XSS attacks
        $row = array_map('htmlspecialchars', $row);
        $booking_history[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($booking_history);
?>
