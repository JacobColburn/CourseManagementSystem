<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once '../dbh.inc.php'; // Database connection
        require_once 'login_model.inc.php'; // Model functions
        require_once 'login_contr.inc.php'; // Controller functions
            
        // Run error handlers
        $errors = [];
            
        if (is_input_empty($email, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $email);
        
        if (is_email_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect Login Information";
        }
        if (!is_email_wrong($result) && is_password_wrong($password, $result['password'])) {
            $errors["login_incorrect"] = "Incorrect Login";
        }
            
        require_once '../config_session.inc.php'; // Session configuration
        
        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../../login.php");
            exit(); // Use exit instead of die for clarity
        }
        
        // Start session
        session_start();
        
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Set session variables
        $_SESSION['id'] = $result['id'];
        $_SESSION['firstName'] = htmlspecialchars($result['firstName']);
        $_SESSION['last_regeneration'] = time(); 

        // Redirect after successful login
        header("Location: ../../index.php?login=success");
        exit(); // Use exit instead of die for clarity
         
    } catch(PDOException $e) {
        die("Connection Error: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit(); // Use exit instead of die for clarity
}