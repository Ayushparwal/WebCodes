<?php
session_start(); // Start the session

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

// Handle user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Add code to validate user credentials
    $sql = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, set session variable and redirect to dashboard
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed, display error message
        echo "Invalid username or password";
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
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>


<style>
    body{
        background-color: lightsteelblue;
    }
    input[type="text"],
    input[type="password"],
    input[type="email"] {
        font-size: 20px;
    }
</style>
<body>


<div id="login_section">
    <h2>User Login</h2>
    <form action="login.php" method="post">
        <!-- Login form inputs -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Sign up here</a>.</p>
</div>



</body>
</html>
