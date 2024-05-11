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

// Handle ticket cancellation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = $_POST['cancel_ticket_id'];

    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE Tickets SET Status = 'Cancelled' WHERE TicketID = ?");
    $stmt->bind_param("i", $ticket_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Ticket cancelled successfully";
    } else {
        echo "Error cancelling ticket: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    body{
        background-color: lightcyan;
    }
</style>
<body>
<div id="cancellation_section">
        <h2>Cancel Ticket</h2>
        <form action="cancel_ticket.php" method="post">
            <label for="cancel_ticket_id">Ticket ID:</label>
            <input type="text" id="cancel_ticket_id" name="cancel_ticket_id" required><br>
            <input type="submit" value="Cancel Ticket">
        </form>
    </div>
    <!-- <a href="print_receipt.php">Checking your booking</a> -->

</body>
</html>