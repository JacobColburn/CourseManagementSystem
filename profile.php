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
    header('Location:index.php');
    exit();
}

// Get the student ID from the session variable
$studentId = $_SESSION["id"];

// SQL query to fetch all relevant student information from the 'students' table
$query = '
    SELECT firstName, lastName, gender, address, address2, city, state, zip, phone, email, registered_at, profile_picture
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>

    <?php require 'master.php'; ?>
    
    <h2>Welcome to your profile!</h2>
    <div class="container">
        <div class="boxed">
            <div class="profile-box">
                <div class="profile-header">
                      <div class="profile-picture-container">
                        <?php
                        // Get the profile picture path
                        $profilePicture = $student['profile_picture'] ?? 'default-profile.png';
                        $profilePicturePath = 'uploads/' . htmlspecialchars($profilePicture);

                        // Check if the file exists in the uploads directory
                        if (!file_exists($profilePicturePath)) {
                            $profilePicturePath = 'uploads/default-profile.png'; // Fallback image
                        }
                        ?>
                        <!-- Display profile photo -->
                        <img src="<?php echo $profilePicturePath; ?>" alt="Profile Photo" class="profile-photo">
                    </div>
                    
                    <div class="profile-details">
                        <!-- Display student's name -->
                        <p class="profile-name"><i class="fas fa-id-badge"></i><?php echo " " . htmlspecialchars($student['firstName'] . " " . $student['lastName']); ?></p>
                        <!-- Display student's gender -->
                        <p class="profile-info"><i class="fas fa-user"></i> Gender: <?php echo htmlspecialchars($student['gender']); ?></p>
                        <!-- Display student's address -->
                        <p class="profile-info"><i class="fas fa-map-marker-alt"></i> Address: <?php echo htmlspecialchars($student['address']); ?><?php if (!empty($student['address2'])) echo ', ' . htmlspecialchars($student['address2']); ?>, <?php echo htmlspecialchars($student['city'] . ', ' . $student['state'] . ' ' . $student['zip']); ?></p>
                        <!-- Display student's phone number -->
                        <p class="profile-info"><i class="fas fa-phone"></i> Phone Number: <?php echo htmlspecialchars($student['phone']); ?></p>
                        <!-- Display student's email -->
                        <p class="profile-info"><i class="fas fa-envelope"></i> Email: <?php echo htmlspecialchars($student['email']); ?></p>
                        <!-- Display student's registration date -->
                        <p class="profile-info"><i class="fas fa-calendar-alt"></i> Registered At: <?php echo htmlspecialchars(date("F j, Y, g:i a", strtotime($student['registered_at']))); ?></p>
                    </div>
                </div>

                <div class="profile-footer text-center">
                    <a href="edit_profile.php"><button class="btn btn-primary">Edit Profile</button></a>
                    <a href="transcript.php"><button class="btn btn-secondary">Manage Courses</button></a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
    
</body>
</html>