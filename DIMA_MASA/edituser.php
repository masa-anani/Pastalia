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

$email = $data['email'];
$newPassword = $data['password'];
$newFirstName = $data['first_name'];
$newLastName = $data['last_name'];

$sql = "UPDATE user SET password=?, first_name=?, last_name=? WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $newPassword, $newFirstName, $newLastName, $email);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
