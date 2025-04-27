<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$sql = "INSERT INTO user (email, password, first_name, last_name) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $password, $first_name, $last_name);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Signup successful.";
    // Redirect or login the user automatically
    header("Location: index.html");
} else {
    if ($stmt->errno == 1062) {
        echo "<script>alert('Error: This email is already registered. Please use a different email.'); window.history.back();</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
$stmt->close();
$conn->close();
?>
