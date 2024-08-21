<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'includes/loginMVC/login_view.inc.php';


class dbConnect{

    private $servername;
    private $user; 
    private $pass;
    private $dbname;

    public function connect(){
        $this->servername = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbname = "enrollment_system";

        try {
            $dsn = "mysql:host=".$this->servername. ";dbname=".$this->dbname;
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $pdo;
        
        
        } catch (PDOException $e) {
            echo "Connection error: ".$e->getMessage();
        
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
</head>
<body>
    
    <?php 
    require 'master.php';
     
    ?>
    
    <h2>Welcome to my Course Management System!</h2>
    
    <div class="container">
    <div class="boxed" style="text-align: center; font-weight: bold;">
    <?php output_username() ?>

    </div>
    </div>
    
   
    
    <?php 
    
    check_signup_errors();
    require_once 'footer.php'; 
    ?>  
</body>

</html>