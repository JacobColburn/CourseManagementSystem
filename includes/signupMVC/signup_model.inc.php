<?php
//functions to query the databse
//declaring strict types to prevent any extra data or typo errors
declare(strict_types=1);

function get_email(object $pdo, string $email){
    $query = "SELECT email FROM students WHERE email = :email;";
    $stmt = $pdo->prepare($query); //preparing the statemetn before running the qyery avoids SQL injection
    $stmt->bindparam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//PDO type fetch reaching for column name isntead of an array
    return $result;
}
function set_user(object $pdo, string $firstName, $lastName, $gender, $address, $address2, $city, $state, $zip, $phone, $email, $password, $passwordRepeat){
    $query = "INSERT INTO students (firstName, lastName, gender, address, address2, city, state, zip, phone, email, password, passwordRepeat) VALUES(:firstName, :lastName, :gender, :address, :address2, :city, :state, :zip, :phone, :email, :password, :passwordRepeat);";

    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":firstName", $firstName);
    $stmt->bindParam(":lastName", $lastName);
    $stmt->bindParam(":gender", $gender);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":address2", $address2);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":state", $state);
    $stmt->bindParam(":zip", $zip);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":passwordRepeat", $passwordRepeat);
    $stmt->execute();
}
