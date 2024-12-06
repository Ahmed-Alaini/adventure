<?php
session_start();
require_once 'db.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'] ?? null; // Assuming the user is logged in

    if ($name && $rating && $message) {
        $sql = "INSERT INTO comments (name, rating, message, user_id) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sisi", $name, $rating, $message, $user_id);
            if ($stmt->execute()) {
                echo "Comment submitted successfully!";
                header("Location: index.php"); // Redirect to the main page
                exit();
            } else {
                echo "Failed to submit the comment.";
            }
            $stmt->close();
        } else {
            echo "Error preparing the query.";
        }
    } else {
        echo "All fields are required.";
    }

    $conn->close();
}
?>
