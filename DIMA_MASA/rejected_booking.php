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

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$name = $data['name'];
$phone = $data['phone'];
$email = $data['email'];
$num_of_person = $data['num_of_person'];
$datetime = $data['datetime'];
$note = $data['note'];

// Begin transaction
$conn->begin_transaction();

try {
    // Insert the booking into rejected_bookings
    $insert_sql = "INSERT INTO rejected (id, name, phone, email, num_of_person, datetime, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("isssiss", $id, $name, $phone, $email, $num_of_person, $datetime, $note);
    $stmt->execute();

    // Delete the booking from the original table
    $delete_sql = "DELETE FROM book_table WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();
    echo json_encode(['status' => 'success', 'message' => 'Booking rejected.']);
} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Failed to reject booking.']);
}

$conn->close();
?>
