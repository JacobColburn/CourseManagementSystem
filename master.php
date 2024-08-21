<?php
//error reports
error_reporting(E_ALL ^ E_NOTICE);
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/signupMVC/signup_view.inc.php';
require_once 'includes/loginMVC/login_view.inc.php';



if (!isset($_SESSION['id'])) {
    $currentPage = basename($_SERVER['PHP_SELF']); // Get current file name and changes brand text depedning on current page
    $brandText = "Course Registration System";
    $brandLink = "index.php";

    switch ($currentPage) {
        case "index.php":
            $brandText = "Login";
            $brandLink = "login.php";
            break;
        case "reg.php":
            $brandText = "Already Registered?";
            $brandLink = "login.php";
            break;
        case "login.php":
            $brandText = "Sign Up";
            $brandLink = "reg.php";
            break;
        case "courses.php":
            $brandText = "Home";
            $brandLink = "index.php";
            break;
        case "contact.php":
            $brandText = "Home";
            $brandLink = "index.php";
            break;
    }

} else{
    $currentPage = basename($_SERVER['PHP_SELF']); // Get current file name and changes brand text depedning on current page
    $brandText = "Course Registration System";
    $brandLink = "index.php";

    switch ($currentPage) {
        case "index.php":
            $brandText = "Logout";
            $brandLink = "includes/loginMVC/logout.inc.php";
            break;
        case "reg.php":
            $brandText = "Logout";
            $brandLink = "includes/loginMVC/logout.inc.php";
            break;
        case "login.php":
            $brandText = "Logout";
            $brandLink = "includes/loginMVC/logout.inc.php";
            break;
        case "courses.php":
            $brandText = "Logout";
            $brandLink = "includes/loginMVC/logout.inc.php";
            break;
        case "transcript.php":
            $brandText = "Logout";
            $brandLink = "includes/loginMVC/logout.inc.php";
            break;
        case "contact.php":
            $brandText = "Logout";
            $brandLink = "includes/loginMVC/logout.inc.php";
            break;
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
    <title>Course Enrollment System</title>
</head>
<body>
    
    <h1>Course Registration Wesbite</h1>
    
    <?php 
        
        if(!isset($_SESSION["id"])){ ?>
                
            <nav class="navbar bg-transparent fixed-top">
        <div class="container-fluid">
        <button class="navbar-toggler bg-light order-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand bg-light mx-2" href="<?php echo $brandLink; ?>"><?php echo $brandText; ?></a>
        
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-light">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="reg.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="courses.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact_us.php">Contact Us</a>
            </li>
            </ul>
        </div>
        </div>
            
        <?php }  else if(isset($_SESSION["id"])){
 ?>
            <nav class="navbar bg-transparent fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler bg-light order-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand bg-light mx-2" href="<?php echo $brandLink; ?>"><?php echo $brandText; ?></a>
        
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-light">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="courses.php">Courses</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" aria-current="page" href="transcript.php">My Transcipt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="contact_us.php">Contact Us</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link-red" href='includes/loginMVC/logout.inc.php'>Logout</a>
            </li>
            </ul>
        </div>
        </div>
        <?php } ?>
             
    
    

		
    </div>
    </nav>
    
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     
</body>

</html>