<?php
// Start session and include necessary files
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';

// Ensure the user is logged in
if (!isset($_SESSION["id"])) {
    echo "You must be logged in to view this page.";
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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $semester = $_POST['semester'];

    // Prepare the update SQL statement
    $updateQuery = '
        UPDATE students
        SET name = :name, address = :address, phone = :phone, email = :email, semester = :semester
        WHERE id = :id
    ';

    // Prepare the statement and bind the parameters
    $stmt = $pdo->prepare($updateQuery);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':semester', $semester, PDO::PARAM_STR);
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php require 'master.php'; ?>

    <h2>Edit Your Profile</h2>

	<div class="boxed">
    <div class="container">
        <form action="edit_profile.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($student['address']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="semester">Current Semester:</label>
                <input type="text" id="semester" name="semester" value="<?php echo htmlspecialchars($student['semester']); ?>" class="form-control" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    </div>

    <?php require 'footer.php'; ?>
</body>
</html>