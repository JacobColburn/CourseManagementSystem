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

// Query to fetch courses the student is enrolled in
$query = '
    SELECT c.* 
    FROM enrollments e
    JOIN courses c ON e.course_id = c.course_id
    WHERE e.student_id = :student_id
';
$stmt = $pdo->prepare($query);
$stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle withdrawal from a course
if (isset($_POST['withdraw'])) {
    $courseId = $_POST['course_id'];

    // Prepare the SQL statement for withdrawal
    $withdrawQuery = '
        DELETE FROM enrollments
        WHERE student_id = :student_id AND course_id = :course_id
    ';
    $stmt = $pdo->prepare($withdrawQuery);
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);

    // Execute the withdrawal
    if ($stmt->execute()) {
        // Redirect back to the same page or display a success message
        header('Location: transcript.php');
        exit();
    } else {
        echo "Error withdrawing from the course. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>My Courses</title>
</head>
<body>

<?php require 'master.php'; ?>

<h2>My Enrolled Courses</h2>

<div class="course-container">
    <?php if (!empty($courses)): ?>
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
                
                <!-- Withdrawal Form -->
                <div class="container">
                <form action="transcript.php" method="POST">
                    <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['course_id']); ?>">
                    <button type="submit" name="withdraw" class="btn btn-danger">Withdraw</button>
                </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No courses found for your enrollment.</p>
    <?php endif; ?>
</div>

<!-- Button to navigate to course listing page -->
<div class="container">
<div class="enroll-button-container">
    <a href="courses.php" class="btn btn-primary">Enroll in a Course</a>
</div>
</div>
<?php 
    require_once 'footer.php'; 
?> 
</body> 
</html>