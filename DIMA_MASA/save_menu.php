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

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];
$price = $_POST['price'];
$image = $_FILES['image']['name'];

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

if ($id) {
    $sql = "UPDATE menu SET name=?, description=?, category=?, price=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $name, $description, $category, $price, $image, $id);
} else {
    $sql = "INSERT INTO menu (name, description, category, price, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $name, $description, $category, $price, $image);
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: ManageMenu.php");
?>
