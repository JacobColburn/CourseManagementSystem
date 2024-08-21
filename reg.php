<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once 'includes/signupMVC/signup_view.inc.php';
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
    
  <form class="row g-3" action="includes/signupMVC/signup.inc.php" method="POST">
    <div class="col-md-5">
      <label for="firstName" class="form-label">First Name</label>
      <input type="text" name="firstName" class="form-control" id="firstName" placeholder="John">
    </div>
    <div class="col-md-5">
      <label for="lastName" class="form-label">Last Name</label>
      <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Harrington">
    </div>
  
    <div class="col-md-2">
      <label for="gender" class="form-label">Gender</label>
      <input type="text" name="gender" class="form-control" id="gender" placeholder="M or F">
    </div>
    <div class="w-100"> </div>
    <div class="col-7">
      <label for="email" class="form-label">Email</label>
      <input type="text" name="email" class="form-control" id="email" placeholder="johnnyboy@gmail.com">
    </div>
    <div class="col-5">
      <label for="phone" class="form-label">phone</label>
      <input type="text" name="phone" class="form-control" id="phone" placeholder="205-324-4438">
    </div>
    <div class="w-100"> </div>
    <div class="col-6  ">
      <label for="newPassword" class="form-label">New Password</label>
      <input type="password" name="password" class="form-control" id="password1" placeholder="Include at least 1 special character!">
    </div>
  
    <div class="col-6  ">
      <label for="repeatPassword" class="form-label">Repeat Password</label>
      <input type="password" name="passwordRepeat" class="form-control" id="password2" placeholder="Did you forget it Already?">
    </div>
  
    <div class="col-6">
      <label for="inputAddress" class="form-label">Address</label>
      <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
    <div class="col-6">
      <label for="inputAddress2" class="form-label">Address 2</label>
      <input type="text" name="address2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
    </div>
    <div class="col-md-4">
      <label for="inputCity" class="form-label">City</label>
      <input type="text" name="city" class="form-control" id="inputCity" placeholder="Dallas">
    </div>
    <div class="col-md-2">
      <label for="inputState" class="form-label">State</label>
      <input type="text" name="state" class="form-control" id="inputState" placeholder="Tx">
    </div>
    <div class="col-md-3">
      <label for="inputZip" class="form-label">Zip</label>
      <input type="text" name="zip" class="form-control" id="inputZip" placeholder="28710">
    </div>
  
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-primary btn-lg">Sign up</button>
    </div>
  </form>
    
  </div>     
  </div>
  <?php 
  check_signup_errors();
  require_once 'footer.php';
  
  ?>
</body>

</html>