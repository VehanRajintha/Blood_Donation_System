<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Blood Donation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Form container */
#form {
    width: 55%;
    height: 10%;
    margin-bottom: 200px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Form elements */
form input[type="text"],
form input[type="email"],
form textarea {
    width: 40%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    font-family: 'Roboto', sans-serif;
}

/* Textarea specific styles */
form textarea {
    height: 150px;
    resize: vertical;
}

/* Submit button */
form button[type="submit"] {
    padding: 10px 20px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-size: 16px;
    font-family: 'Roboto', sans-serif;
}

/* Submit button hover effect */
form button[type="submit"]:hover {
    background: #0056b3;
}

    </style>
</head>
<body>
<iframe id="spline-background" src="https://my.spline.design/clonercubesgenerativecopy-1ccd78409e8f3f19ff885ee714254f95/" frameborder="0"></iframe>
<div id="full">
    <div id="inner_full">
        <div class="header">
            <div class="logo"><h2>Blood Donation</h2></div>  
            <div class="container">
                <div id="d"><a href="user.php">Dashboard</a></div>
                <div id="d"><a href="userabout.php">About</a></div>
                <div id="d"><a href="usercontactus.php">Contact US</a></div>
                <div id="d"><a href="userhelp.php">Help</a></div>
                <!-- Add more elements as needed -->
            </div>
        </div>
        
        <div id="body">

            <h1>Contact Us</h1>
            <center>
                <div id="form" class="card-container">
                    <div class="content">
                        <p>If you have any questions or need further information, please feel free to contact us. We are here to help you.</p>
                        <p>Email: info@blooddonation.com</p>
                        <p>Phone: +1 234 567 890</p>
                        <p>Address: 123 Blood Donation St, Save Lives City, Country</p>
                        <form action="send_message.php" method="post">
                            <input type="text" name="name" placeholder="Your Name" required>
                            <input type="email" name="email" placeholder="Your Email" required>
                            <textarea name="message" placeholder="Your Message" required></textarea>
                            <button type="submit" class="btn">Send Message</button>
                        </form>
                    </div>
                </div>  
            </center>
            <div id="footer">
                <p>&copy; 2023 Blood Donation. All rights reserved.</p>
                <p>Contact us: info@blooddonation.com | +1 234 567 890</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>