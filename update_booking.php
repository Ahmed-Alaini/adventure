<?php
session_start();

// Database connection
require_once 'db.php'; // Replace with your database connection file

// Ensure this is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $user_id = $_SESSION['user_id'] ?? null;

    if ($user_id) {
        $sql = "UPDATE bookings SET booked = 0 WHERE user_id = ? AND booked = 1";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No rows were updated.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare database query.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User ID not found.']);
    }

    $conn->close();
    exit;
}
?>
