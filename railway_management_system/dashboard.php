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

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Display the dashboard content
echo "Welcome, " . $_SESSION['username'] . "! This is your dashboard.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard View</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    body{
        background-color: lightsalmon;
    }
    input[type="text"],
    input[type="password"],
    input[type="email"] {
        font-size: 20px;
    }
</style>
<body>
    
<div id="booking_section">
        <h2>Book Ticket</h2>
        <form action="book_ticket.php" method="post">
            <label for="source">Source:</label>
            <select id="source" name="source" required>
                <option value="">Select Source</option>
                <option value="Source 1">Delhi</option>
                <option value="Source 2">Bangalore</option>
                <option value="Source 3">Jaipur</option>
                
                <!-- Add more options as needed -->
            </select><br>
            
            <label for="destination">Destination:</label>
            <select id="destination" name="destination" required>
                <option value="">Select Destination</option>
                <option value="Destination 1">Chennai</option>
                <option value="Destination 2">Mumbai</option>
                <option value="Destination 3">Indore</option>
                <option value="Destination 4">Gwalior</option>

                <!-- Add more options as needed -->
            </select>
            <br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <label for="train_id">Train Number:</label>
            <input type="number" id="train_id" name="train_id" required><br>
            
            <button type="submit" class="book-ticket-button">Book Ticket</button>

        </form>
    </div>
    
    <a href="cancel_ticket.php">Cancel Ticket</a>
    <br>
    <a href="modify_train.php">Change Destination</a>

</body>
</html>
