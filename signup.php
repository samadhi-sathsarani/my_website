<?php

include __DIR__ . '/db.php';


$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password']; 

    
    $stmt = $conn->prepare("INSERT INTO users (email, full_name, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $name, $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
}
?>