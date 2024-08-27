<?php
error_reporting(E_ALL ^ E_NOTICE);

// Include the database connection and session configuration files
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';

// Ensure user is logged in
if (!isset($_SESSION["id"])) {
    echo "You must be logged in to view this page.";
    exit();
}

// Get the student ID from the session
$studentId = $_SESSION["id"];

// Query to fetch all courses from the database
$query = 'SELECT * FROM courses';
$stmt = $pdo->prepare($query);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize the message variable
$message = '';

// Handle course enrollment
if (isset($_POST['enroll'])) {
    $courseId = $_POST['course_id'];

    // Check if the student is already enrolled in the course
    $checkQuery = 'SELECT * FROM enrollments WHERE student_id = :student_id AND course_id = :course_id';
    $checkStmt = $pdo->prepare($checkQuery);
    $checkStmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $checkStmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $message = "You are already enrolled in this course.";
    } else {
        // Enroll the student in the course
        $insertQuery = 'INSERT INTO enrollments (student_id, course_id, semester, enrollment_date) VALUES (:student_id, :course_id, :semester, NOW())';
        $insertStmt = $pdo->prepare($insertQuery);
        $semester = 'Fall 2024'; // Example value, you may want to adjust this
        $insertStmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
        $insertStmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
        $insertStmt->bindParam(':semester', $semester, PDO::PARAM_STR);

        if ($insertStmt->execute()) {
            $message = "Successfully enrolled in the course!";
        } else {
            $message = "Error enrolling in the course. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>All Courses</title>
    <style>
        .success-message {
            color: #28a745; /* Green color for success */
            text-align: center;
            margin: 20px 0;
        }
        .error-message {
            color: #dc3545; /* Red color for errors */
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<?php require 'master.php'; ?>

<h2>These are all of our offered courses!</h2>

<!-- Display the message -->
<?php if (!empty($message)): ?>
    <p class="<?php echo strpos($message, 'Error') !== false ? 'error-message' : 'success-message'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>

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

            <!-- Enroll button -->
            <form action="" method="POST">
                <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['course_id']); ?>">
                <button type="submit" name="enroll" class="btn btn-primary">Enroll</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php 
    require_once 'footer.php'; 
?>  
</body>
</html>
