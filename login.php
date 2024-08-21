<?php 
  error_reporting(E_ALL ^ E_NOTICE);
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registration</title>
</head>
<body>
    
    <?php 
        require 'master.php';
     
    ?>

    <div class="container">
    <div class="boxed"> 
    <form method="post" action="includes/loginMVC/login.inc.php">
     
    <div class="mb-3 row ">
      <label for="inputEmail" class="col-sm-1 col-form-label">Email</label>
      <div class="">
      <input type="email" name="email" class="form-control" id="inputEmail">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="inputPassword" class="col-sm-1 col-form-label">Password</label>
      <div class="">
      <input type="password" name="password" class="form-control" id="inputPassword">
      </div>
    </div>
    <button type="submit" class="btn btn-primary d-block mx-auto">Login</button>
    
    
    
    </form>
    <?php
    check_login_errors();
    ?>
    </div>
    </div>
    

  <?php 
  
  require_once 'footer.php'; 
  ?>
</body>

</html>