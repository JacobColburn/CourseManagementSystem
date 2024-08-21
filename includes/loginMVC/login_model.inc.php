<?php

declare (strict_types = 1);

function get_user(object $pdo, string $email){ // object set for the PDO connection
    $query = "SELECT * FROM students WHERE email = :email;";
    $stmt = $pdo->prepare($query); //preparing the statemetn before running the qyery avoids SQL injection
    $stmt->bindparam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//PDO type fetch to grab the data
    return $result;
}