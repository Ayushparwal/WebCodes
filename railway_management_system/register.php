<?php
// Database connection parameters

$servername = "localhost";
$port = 3307; // Adjust the port as needed
$username = "ayush";
$password = "Ayush@221004";
$database = "indiaRail";

// Create connection
$conn = new mysqli($servername . ':' . $port, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "database Connected Succesfully \n";
// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_username = $_POST['reg_username'];
    $reg_password = $_POST['reg_password'];
    
    // Add code to check if the username already exists
    $sql_check_username = "SELECT * FROM Users WHERE Username='$reg_username'";
    $result_check_username = $conn->query($sql_check_username);
    if ($result_check_username->num_rows > 0) {
        echo "Username already exists";
    } else {
        // Add code to insert new user into the database
        $sql_insert_user = "INSERT INTO Users (Username, Password, Role) VALUES ('$reg_username', '$reg_password', 'user')";
        if ($conn->query($sql_insert_user) === TRUE) {
            echo "Registration successful";
            echo "<a href='login.php'>  Login here</a>.";
            
        } else {
            echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
