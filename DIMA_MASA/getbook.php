<?php
$servername = "localhost";
$username = "root"; // Use your MySQL username
$password = ""; // Use your MySQL password
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, phone, email,num_of_person,datetime,note FROM book_table";
$result = $conn->query($sql);

$book = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $book[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($book);
?>
