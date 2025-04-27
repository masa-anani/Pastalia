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

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$num_of_person = $_POST['num_of_person'];
$datetime = $_POST['datetime'];
$note = $_POST['note'];

$sql = "INSERT INTO book_table (name, phone, email, num_of_person, datetime, note) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("sssiss", $name, $phone, $email, $num_of_person, $datetime, $note);

// Execute statement
if ($stmt->execute()) {
    // Successful insertion
    echo "<script>alert('Record inserted successfully.'); window.history.back();</script>";
} else {
    // Error during insertion
    echo "Error: " . $stmt->error;
    echo "<script>alert('Failed to insert record. Please try again.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
