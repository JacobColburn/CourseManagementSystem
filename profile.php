<?php
// Display all errors except for notices (optional)
error_reporting(E_ALL ^ E_NOTICE);

// Include the database connection and session configuration files
require_once 'includes/dbh.inc.php'; // Connects to the database using PDO
require_once 'includes/config_session.inc.php'; // Manages the session

// Check if the user is logged in by verifying if the session 'id' is set
if (!isset($_SESSION["id"])) {
    // If the user is not logged in, display an error message and stop further execution
    echo "You must be logged in to view this page.";
    exit();
}

// Get the student ID from the session variable
$studentId = $_SESSION["id"];

// SQL query to fetch all information about the student from the 'students' table
$query = '
    SELECT *
    FROM students
    WHERE id = :id
';

// Prepare the SQL query to prevent SQL injection
$stmt = $pdo->prepare($query);

// Bind the student ID from the session to the SQL query as an integer parameter
$stmt->bindParam(':id', $studentId, PDO::PARAM_INT);

// Execute the query to fetch the student's data
$stmt->execute();

// Fetch the student's data as an associative array
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the student data was found
if (!$student) {
    // If no data is found, display an error message and stop further execution
    echo "Student information could not be found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>

    <?php 
    // Include the master page for common UI elements like header, navigation, etc.
    require 'master.php';
    ?>
    
    <h2>Welcome to your profile!</h2>

    <div class="container">
        <div class="boxed">
            <div class="profile-box">
                <div class="profile-header">
                    <!-- Profile photo placeholder -->
                    <img src="profile-photo.jpg" alt="Profile Photo" class="profile-photo">
                    <div class="profile-details">
                        <!-- Display student's name -->
                        <h2 class="profile-name"><?php echo htmlspecialchars($student['name']); ?></h2>
                        <!-- Display student's address -->
                        <p class="profile-info"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($student['address']); ?></p>
                        <!-- Display student's phone number -->
                        <p class="profile-info"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($student['phone']); ?></p>
                        <!-- Display student's email -->
                        <p class="profile-info"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($student['email']); ?></p>
                        <!-- Display student's current semester -->
                        <p class="profile-info"><i class="fas fa-graduation-cap"></i> Semester: <?php echo htmlspecialchars($student['semester']); ?></p>
                    </div>
                </div>
                <div class="profile-footer">
                    <!-- Buttons for editing the profile and managing courses -->
                    <button>Edit Profile</button>
                    <button>Manage courses</button>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // Include the footer for the page
    require_once 'footer.php'; 
    ?>  
</body>
</html>