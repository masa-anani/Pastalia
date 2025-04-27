<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

// Retrieve booking details from rejected_bookings
$sql = "SELECT * FROM rejected WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if ($booking) {
    // Insert booking details into book_table
    $sql_insert = "INSERT INTO book_table (id, name, phone, email, num_of_person, datetime, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("isssiss", $booking['id'], $booking['name'], $booking['phone'], $booking['email'], $booking['num_of_person'], $booking['datetime'], $booking['note']);
    $stmt_insert->execute();
    $stmt_insert->close();

    // Delete booking from rejected_bookings
    $sql_delete = "DELETE FROM rejected WHERE id=?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();
    $stmt_delete->close();

    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
