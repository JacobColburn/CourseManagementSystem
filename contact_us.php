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
    <title>Contact Us</title>
</head>
<body>
    
<?php include 'master.php'; ?>
    
    <div class="boxed">  
    
        <section class="contact-us">
            <h1>Contact Us</h1>

            <p>Thank you for visiting our Course Registration System. Whether you have questions about our courses, need assistance with registration, or have any other inquiries, we are here to help!</p>

            <h3>Contact Information:</h3>
            <ul>
                <li><strong>Email:</strong> <a href="mailto:support@courseregistration.com">support@courseregistration.com</a></li>
                <li><strong>Phone:</strong> +1 (555) 123-4567</li>
                <li><strong>Address:</strong> 123 Education Lane, Suite 456, Knowledge City, ST 78901</li>
            </ul>

            <h3>Office Hours:</h3>
            <ul>
                <li><strong>Monday to Friday:</strong> 9:00 AM - 5:00 PM (EST)</li>
                <li><strong>Saturday:</strong> 10:00 AM - 3:00 PM (EST)</li>
                <li><strong>Sunday:</strong> Closed</li>
            </ul>

            <p>Feel free to reach out to us through any of the methods above. We strive to respond to all inquiries within 24 hours during business days. Your feedback and questions are important to us, and we look forward to assisting you!</p>

            <h3>Follow us on social media:</h3>
            <ul>
                <li><a href="#" target="_blank">Facebook</a></li>
                <li><a href="#" target="_blank">Twitter</a></li>
                <li><a href="#" target="_blank">LinkedIn</a></li>
            </ul>
        </section>
    </div>

<?php include 'footer.php'; ?>
    
</body>
</html>