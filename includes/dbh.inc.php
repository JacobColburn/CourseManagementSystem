<?php 
// Setting database varibles for database connection
$host = 'localhost';
$dbname = 'enrollment_system';
$dbusername = 'root';
$dbpassword = '';
// try catch method that tries to connect to database
try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) { // if PDOException is thrown error message is returned
    die("Connecetion Error:" . $e->getMessage());
}
