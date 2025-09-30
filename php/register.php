<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("INSERT INTO users (email, password_hash, mobile) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $password, $mobile);

    if ($stmt->execute()) {
        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode(['message' => 'User registered successfully']);
    } else {
        header('Content-Type: application/json');
        http_response_code(409);
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
