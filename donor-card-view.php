<?php
include('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Card View</title>
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
            width: 99%;
            height: 96%;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            /*overflow-y: auto;
             /* Enable vertical scrolling */
            position: relative;
            z-index: 2;

        }
        #header {
            color: white;
            padding: 20px;
            text-align: center;
        }
        #header a {
            color: black;
            text-decoration: none;
        }
        #body {
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card {
            width: 200px;
            height: 250px;
            background: rgba(255, 182, 193, 0.9); /* Light red background */
            border-radius: 20px; /* Rounded corners */
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        .card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .card:hover {
            transform: translateY(-10px);
            background: rgba(255, 182, 193, 1);
        }
        .card h3 {
            margin: 10px 0;
        }
        .card p {
            margin: 5px 0;
        }
        .card button {
            background-color: #ff6b81;
            border: none;
            color: white;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 14px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .card button:hover {
            background-color: #ff4757;
            transform: translateY(-5px);
        }
        .animated-text {
            font-family: 'Roboto', sans-serif;
            font-size: 2.5em;
            color: #ff4757;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: colorChange 3s infinite alternate;
        }
        @keyframes colorChange {
            0% {
                color: #ff4757;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
            50% {
                color: #ffffff;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
            100% {
                color: #000000;
                text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
            }
        }
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        #popup {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1001;
            width: 80%;
            max-width: 500px;
            text-align: center;
        }
        #popup form {
            display: flex;
            flex-direction: column;
        }
        #popup label {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }
        #popup input, #popup textarea {
            margin-top: 5px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        #popup button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff4757;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #popup button:hover {
            background-color: #ff6b81;
            transform: translateY(-5px);
        }

        #back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #back-button:hover {
            background-color: #d43f3f;
        }

        #back-button::before {
             content: '←'; /* Unicode arrow character */
            margin-right: 10px; /* Space between arrow and text */
            font-size: 20px; /* Adjust size of the arrow */
            transition: transform 0.3s ease; /* Smooth transition for hover effect */
        }

        #back-button:hover::before {
            transform: translateX(-5px); /* Move arrow slightly to the left on hover */
        }
        /* Specific styles for the exchange button */
        #exchange-button::before {
            content: '⇄'; /* Unicode exchange character */
        }

        #exchange-button:hover::before {
            transform: translateX(0); /* No movement for the exchange button */
        }

        /* Popup styles */
        .ppopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1500px; /* Increased width */
            height: 80%; 
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            z-index: 1000;
            padding: 20px;
        }
        .ppopup iframe {
            width: 1500px;
            height: 800px;
            border: none;
            border-radius: 50px;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff4d4d;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
        }

        .popup-close:hover {
            background: #d43f3f;
        }

        /* Overlay styles */
        .poverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

    </style>
</head>
<body>
<iframe id="spline-background" src="https://my.spline.design/clonercubesgenerativecopy-1ccd78409e8f3f19ff885ee714254f95/" frameborder="0"></iframe>
<div id="full">
    <div id="inner_full">
        <div id="header">
            <h2 class="animated-text" style="margin-top:5%;"><a href="admin-home.php">Current Donor List</a></h2>
            <a href="user_home.php" id="back-button">Back to Home</a>
            <a href="javascript:void(0);" id="exchange-button" onclick="openpPopup()">Exchange Blood</a>
        </div>
        <div id="body">
            <h1></h1>
            <center>
                <div id="form" class="card-container">
                    <?php
                    $q = $db->query("SELECT * FROM donor_registration");
                    while($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                        ?>
                        <div class="card">
                            <img src="./images/profile.png" alt="Profile Image">
                            <h3><?= $r1->name; ?></h3>
                            <p><b>Mobile No:</b> <?= $r1->mno; ?></p>
                            <p><b>Blood Group:</b> <?= $r1->bgroup; ?></p>
                            <button data-email="<?= $r1->email; ?>" onclick="openPopup('<?= $r1->email; ?>')">Request Blood</button>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </center>
        </div>
        <div id="footer">
            <h4 align="center">Copyright@projectbdms</h4>
            <p align="center"><a href="logout.php" class="logout-button">Logout</a></p>
        </div>
    </div>
</div>

<div id="poverlay" class="poverlay" onclick="closePopup()"></div>
<div id="ppopup" class="ppopup">
    <button class="popup-close" onclick="closePopup()">&times;</button>
    <iframe src="userexchange-blood-reg.php"></iframe>
</div>

<div id="overlay">
    <div id="popup">
        <form id="requestForm" action="send-request.php" method="post">
            <input type="hidden" name="email" id="donorEmail">
            <label for="message">Your Message:</label>
            <textarea name="message" id="message" rows="4" placeholder="Type your message here..." required></textarea>
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <label for="contact">Your Contact Number:</label>
            <input type="text" name="contact" id="contact" placeholder="Enter your contact number" required>
            <button type="submit">Send Request</button>
        </form>
    </div>
</div>

<script>
    function openPopup(email) {
        console.log('openPopup called with email:', email); // Debugging log
        document.getElementById('donorEmail').value = email;
        document.getElementById('overlay').style.display = 'flex';
        document.getElementById('popup').style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed'); // Debugging log

        document.getElementById('overlay').onclick = function() {
            console.log('overlay clicked'); // Debugging log
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }

        document.getElementById('popup').onclick = function(event) {
            event.stopPropagation();
        }

        document.getElementById('requestForm').onsubmit = function(event) {
            event.preventDefault();
            console.log('requestForm submitted'); // Debugging log
            var form = this;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Request sent successfully!');
                    document.getElementById('overlay').style.display = 'none';
                    document.getElementById('popup').style.display = 'none';
                }
            };
            var formData = new FormData(form);
            var encodedData = new URLSearchParams(formData).toString();
            xhr.send(encodedData);
        }

        // Attach openPopup function to buttons
        var buttons = document.querySelectorAll('.card button');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                openPopup(this.getAttribute('data-email'));
            });
        });
    });
</script>
<script>
        function openpPopup() {
            document.getElementById('ppopup').style.display = 'block';
            document.getElementById('poverlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('ppopup').style.display = 'none';
            document.getElementById('poverlay').style.display = 'none';
        }
    </script>
</body>
</html>