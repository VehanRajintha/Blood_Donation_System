<?php
include('connection.php');
session_start();

// Set session timeout duration (in seconds)
$session_timeout = 300;

// Check if the session is set and if it has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    // Session has expired, destroy it
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Update last activity time stamp
$_SESSION['last_activity'] = time();

// Check if the user is logged in
if (!isset($_SESSION['un'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #spline-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            z-index: -1;
            transform: scale(1.2);
        }
        #full {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        #inner_full {
            width: 80%;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            z-index: 2;
        }
        #header {
            color: white;
            padding: 20px;
            text-align: center;
        }
        #header a {
            color: white;
            text-decoration: none;
        }
        #body {
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .card-container
        {
        display: flex;
        flex-direction: column;
        align-items: left;
        gap: 12px; /* Adjust the gap as needed */
        }
        .card {
            width: 400px;
            height: 80px;
            background: rgba(255, 182, 193, 0.9); /* Light red background */
            border-radius: 50px; /* Oval shape */
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            line-height: 100px; /* Center text vertically */
            color: #333;
            text-decoration: none;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            background: #fa3c32;
            
            
        }
        .overlay {
        position: absolute;
        display: flex;
        top: 60%;
        right: 10px;
        width: 60%;
        height: 70%;
        z-index: 1000;
        transform: translateY(-55%);
        border-radius: 100%;
        }
        .logout-button {
            background-color: #ff6b81;
            color: white;
            padding: 5px 20px;
            border-radius: 100px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sec-loading .one {
            border: 5px solid red; /* Change color to red */
        }

        .sec-loading .one::before {
            border-top-color: red; /* Change color to red */
            border-bottom-color: red; /* Change color to red */

        }

    </style>
</head>
<body>
<iframe id="spline-background" src="https://my.spline.design/clonercubesgenerativecopy-1ccd78409e8f3f19ff885ee714254f95/" frameborder="0"></iframe>
<div id="full">
    <div id="inner_full">
        <div id="header">
            <h2 class="animated-text"><a href="admin-home.php">Blood Donation System</a></h2>
        </div>
        <div id="body">
            <br>
            <?php
            $un = $_SESSION['un'];
            if (!$un) {
                header("Location:index.php");
            }
            ?>
            <h1>Welcome Admin</h1>
            <div class="card-container">
                <a href="donor-reg.php" class="card">Donor Registration</a>
                <a href="donor-list.php" class="card">Donor List</a>
                <a href="stock-blood-list.php" class="card">Stock Blood List</a>
                <a href="blood-requests.php" class="card">Blood Requests</a>
                <a href="out-stock-blood-list.php" class="card">Out Stock Blood List</a>
                <a href="exchange-blood-reg.php" class="card">Exchange Blood Reg</a>
                <a href="exchange-blood-list1.php" class="card">Exchange Blood List</a>
            </div>
        </div>
        <div id="footer">
            <h4 align="center">© 2023 Blood Donation. All rights reserved.</h4>
            <p align="center"><a href="logout.php" class="logout-button">Logout</a></p>
        </div>
        <iframe class="overlay" src="https://my.spline.design/roomrelaxingcopy-81318d1d75f557e19af66f40f45c61d8/" frameborder="0"></iframe>
    </div>
    <section class="sec-loading" id="sec-loading">
    <div class="one"></div>
</section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loader = document.getElementById('sec-loading');
        var content = document.getElementById('full');

        // Show loader
        loader.style.display = 'flex';
        content.style.display = 'show';

        // Simulate content loading
        setTimeout(function() {
            // Hide loader and show content
            loader.style.display = 'none';
            content.style.display = 'block';
        }, 2000); // Adjust the timeout as needed
    });
</script>
</body>
</html>