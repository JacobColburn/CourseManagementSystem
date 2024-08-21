<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect POST data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];

    try {
        require_once '../dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';
        
       
        // Run error handlers
        $errors = [];
        
        if (is_input_empty($firstName, $lastName, $address, $city, $state, $zip, $phone, $email, $password, $passwordRepeat)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (invalid_email($email)) {
            $errors["invalid_input"] = "Invalid Email!";
        }
        if (get_email($pdo, $email)) {
            $errors["email_taken"] = "Email already registered!";
        }
        
        require_once '../config_session.inc.php';
        
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../../reg.php");
            die();
        }
        
        create_user($pdo, $firstName, $lastName, $gender, $address, $address2, $city, $state, $zip, $phone, $email, $password, $passwordRepeat);
        header("Location: ../../index.php?signup=success");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Connection Error: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}
