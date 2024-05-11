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

// Handle modifying train details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the form fields are named train_id, new_destination, etc.
    $train_id = $_POST['train_id'];
    $new_destination = $_POST['new_destination'];
    // Add more form fields as needed
    
    // Add code to update the train details in the database
    $sql_modify_train = "UPDATE Trains SET Destination = '$new_destination' WHERE TrainID = $train_id";
    if ($conn->query($sql_modify_train) === TRUE) {
        echo "Train details modified successfully";
    } else {
        echo "Error modifying train details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body{
        background-color: lightgreen;
    }
</style>
<body>
    
<div id="admin_panel_section">
        <h2>Admin Panel</h2>
        <!-- Placeholder: Display admin functionalities (e.g., modify train details, view all bookings) -->
        <!-- Example: Form to modify train details, Table to view all bookings -->
        <form action="modify_train.php" method="post">
            <!-- Add fields to modify train details -->
            <label for="train_id">Train ID:</label>
            <input type="text" id="train_id" name="train_id" required><br>
            <label for="new_destination">New Destination:</label>
            <input type="text" id="new_destination" name="new_destination" required><br>
            <!-- Add more form fields as needed -->
            <input type="submit" value="Modify Train Details">
        </form>
        
        <a href="cancel_ticket.php">Cancel Ticket</a>


</body>
</html>
