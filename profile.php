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
    
    <h2>Welcome to my your profile!</h2>

    <div class="container">
    <div class="boxed">
        <div class="profile-box">
            <div class="profile-header">
            <img src="profile-photo.jpg" alt="Profile Photo" class="profile-photo">
                <div class="profile-details">
                    <h2 class="profile-name">John Doe</h2>
                    <p class="profile-info"><i class="fas fa-map-marker-alt"></i> 123 Main Street, City, Country</p>
                    <p class="profile-info"><i class="fas fa-phone"></i> +1 234 567 890</p>
                    <p class="profile-info"><i class="fas fa-envelope"></i> john.doe@example.com</p>
                    <p class="profile-info"><i class="fas fa-semester"></i> Current Semester</p>
                </div>
            </div>
            <div class="profile-footer">
                <button>Edit Profile</button>
                <button>Manage courses</button>
                </div>
            </div>

        </div>
    </div>
    
    
   
    
<?php 
    require_once 'footer.php'; 
?>  
</body>

</html