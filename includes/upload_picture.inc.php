<?php
// Include database connection and session management
require_once 'dbh.inc.php'; 
require_once 'config_session.inc.php';

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    echo "You must be logged in to upload a profile picture.";
    exit();
}

// Handle file upload
if (isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    
    // Basic validation
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . basename($file['name']);
        
        // Move file to the upload directory
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $studentId = $_SESSION["id"];
            $profilePicture = basename($file['name']);
            
            // Update the student's profile picture path in the database
            $query = 'UPDATE students SET profile_picture = :profile_picture WHERE id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->execute(['profile_picture' => $profilePicture, 'id' => $studentId]);
            
            // Redirect to the profile page
            header('Location: ../profile.php');
            exit();
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "File upload error.";
    }
} else {
    echo "No file uploaded.";
}