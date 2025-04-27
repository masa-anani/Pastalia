<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;

        // Check if the entered email is the specific one you want to redirect
        if ($email === 'dima_masa@gmail.com') {
            header("Location: backend.html");
        }
        elseif ($email === 'pastalia@gmail.com'){
            header("Location: empbackend.html");
        }
        else {
            header("Location: index.html");
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
