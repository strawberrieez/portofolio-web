<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "porto_web";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($name) || empty($email) || empty($phone)) {
    header("Location: home.html?success=0");
    exit;
}

$sql = "INSERT INTO porto_db (name, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    header("Location: home.html?success=0");
    exit;
}

$stmt->bind_param("ssss", $name, $email, $phone, $message);
if ($stmt->execute()) {
    header("Location: home.html?success=1");
} else {
    header("Location: home.html?success=0");
}
exit;
?>
