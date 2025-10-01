<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_app";

header('Content-Type: application/json');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid email format.']);
        exit();
    }
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(['message' => 'Password must be at least 6 characters long.']);
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        http_response_code(409);
        echo json_encode(['message' => 'Email already exists.']);
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password_hash, mobile) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $password_hash, $mobile);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(['message' => 'Registration successful!']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'An error occurred during registration.']);
    }

    $stmt->close();
    $conn->close();
}
