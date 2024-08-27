<?php 
require_once "edit_profile.inc.php"; // Include your edit profile logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php require 'master.php'; ?>

    <h2>Edit Your Profile</h2>

    <div class="boxed">
        <div class="container">
            <form action="edit_profile.inc.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile_picture"></label>
                    <div class="profile-picture-container">
                        <?php
                        // Get the profile picture path
                        $profilePicture = $student['profile_picture'] ?? 'default-profile.png';
                        $profilePicturePath = 'uploads/' . htmlspecialchars($profilePicture);

                        // Check if the file exists in the uploads directory
                        if (!file_exists($profilePicturePath)) {
                            $profilePicturePath = 'uploads/default-profile.png'; // Fallback image
                        }
                        ?>
                        <img src="<?php echo $profilePicturePath; ?>" alt="Profile Photo" class="profile-photo" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="profile_picture">Change Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                </div>

                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($student['firstName']); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($student['lastName']); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($student['address']); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" class="form-control" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    <?php require 'footer.php'; ?>
</body>
</html>