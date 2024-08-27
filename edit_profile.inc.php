<?php
// Start session and include necessary files
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';

// Ensure the user is logged in
if (!isset($_SESSION["id"])) {
    echo "You must be logged in to view this page.";
    header('Location:index.php');
    exit();
}

// Fetch the student's current data
$studentId = $_SESSION["id"];
$query = 'SELECT * FROM students WHERE id = :id';
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the student data was found
if (!$student) {
    echo "Student information could not be found.";
    exit();
}

if (isset($_POST['update'])) {
    // Fetch the updated data from the form
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Handle profile picture upload
    $profilePicturePath = $student['profile_picture']; // Default to existing picture

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileSize = $_FILES['profile_picture']['size'];
        $fileType = $_FILES['profile_picture']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (in_array($fileExtension, $allowedExts)) {
            $uploadFileDir = 'uploads/';
            $newFileName = $studentId . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profilePicturePath = $newFileName; // Update the profile picture path
            } else {
                echo "There was an error moving the uploaded file.";
            }
        } else {
            echo "Unsupported file extension. Please upload a JPG, JPEG, or PNG file.";
        }
    }

    // Prepare the update SQL statement
    $updateQuery = '
        UPDATE students
        SET firstName = :firstname, lastName = :lastname, address = :address, phone = :phone, email = :email, 
            profile_picture = :profile_picture
        WHERE id = :id
    ';

    // Prepare the statement and bind the parameters
    $stmt = $pdo->prepare($updateQuery);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':profile_picture', $profilePicturePath, PDO::PARAM_STR);
    $stmt->bindParam(':id', $studentId, PDO::PARAM_INT);

    // Execute the update statement
    if ($stmt->execute()) {
        // Redirect back to the profile page or display a success message
        header('Location: profile.php');
        exit();
    } else {
        // Display an error message if the update fails
        echo "Error updating profile. Please try again.";
    }
}
?>