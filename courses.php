<?php
error_reporting(E_ALL ^ E_NOTICE);

// Include the database connection and session configuration files
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';

// Ensure user is logged in
// if (!isset($_SESSION["user_id"])) {
//     echo "You must be logged in to view this page.";
//     exit();
// }

// Query to fetch courses from the database
$query = 'SELECT * FROM courses';
$stmt = $pdo->prepare($query);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>All Courses</title>
</head>
<body>

<?php require 'master.php'; ?>

<h2>This is where all the courses will be!</h2>

<div class="course-container">
    <?php foreach ($courses as $course): ?>
        <div class="course-box">
            <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
            <p><strong>Course ID:</strong> <?php echo htmlspecialchars($course['course_id']); ?></p>
            <p><strong>Course Code:</strong> <?php echo htmlspecialchars($course['course_code']); ?></p>
            <p><strong>Credits:</strong> <?php echo htmlspecialchars($course['course_credits']); ?></p>
            <p><strong>Department:</strong> <?php echo htmlspecialchars($course['department']); ?></p>
            <p><strong>Instructor:</strong> <?php echo htmlspecialchars($course['instructor']); ?></p>
            <p><strong>Students Enrolled:</strong> <?php echo htmlspecialchars($course['students_Enrolled']); ?></p>
            <p><strong>Student Capacity:</strong> <?php echo htmlspecialchars($course['student_capacity']); ?></p>
            <p><strong>Created At:</strong> <?php echo htmlspecialchars($course['created_at']); ?></p>
            <p><strong>Updated At:</strong> <?php echo htmlspecialchars($course['updated_at']); ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>