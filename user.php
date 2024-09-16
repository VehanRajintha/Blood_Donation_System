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
    header("Location: donor-login.php");
    exit();
}

// Update last activity time stamp
$_SESSION['last_activity'] = time();

// Check if the user is logged in
if (!isset($_SESSION['un'])) {
    header("Location: donor-login.php");
    exit();
}

$email = $_SESSION['un'];

// Fetch user details
$q = $db->prepare("SELECT * FROM donor_registration WHERE email = :email");
$q->bindParam(':email', $email);
$q->execute();
$user = $q->fetch(PDO::FETCH_OBJ);

// Update user details if form is submitted
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $bgroup = $_POST['bgroup'];
    $mno = $_POST['mno'];

    $q = $db->prepare("UPDATE donor_registration SET name = :name, fname = :fname, address = :address, city = :city, age = :age, bgroup = :bgroup, mno = :mno WHERE email = :email");
    $q->bindParam(':name', $name);
    $q->bindParam(':fname', $fname);
    $q->bindParam(':address', $address);
    $q->bindParam(':city', $city);
    $q->bindParam(':age', $age);
    $q->bindParam(':bgroup', $bgroup);
    $q->bindParam(':mno', $mno);
    $q->bindParam(':email', $email);

    if ($q->execute()) {
        echo "<script>alert('Details updated successfully');</script>";
        // Refresh the page to show updated details
        header("Refresh:0");
    } else {
        echo "<script>alert('Failed to update details');</script>";
    }
}

// Fetch blood requests related to the user's email
$q = $db->prepare("SELECT * FROM blood_requests WHERE email = :email");
$q->bindParam(':email', $email);
$q->execute();
$requests = $q->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #ff4757;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header h2 {
            margin: 0;
            font-size: 2.5em;
            animation: fadeInDown 1s ease-in-out;
        }
        .nav {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .nav div {
            margin: 0 15px;
        }
        .nav a {
            color: black;
            text-decoration: none;
            font-size: 1.2em;
            transition: color 0.3s;
        }
        
        .nav a:hover {
            color: red;
        }
        #body {
            padding: 20px;
            text-align: center;
        }
        h3, {
            color: #333;
            animation: fadeInUp 1s ease-in-out;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
            border-radius: 100;
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #ff4757;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background: #ff4757;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #ff6b81;
        }
        #footer {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #e .btn {
            background: white;
            color: black;
            padding: 10px 20px;
            border-radius: 100px;
            text-decoration: none;
            transition: background 0.3s, transform 0.3s;
        }
        #e .btn:hover {
            background: #e8e8e8 ;
            transform: scale(1.05);
        }
        .form-input {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-submit {
            background: #ff4757;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        .form-submit:hover {
            background: #ff6b81;
            transform: scale(1.05);
        }
        .notification {
            background: #ff4757;
            color: #fff;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            animation: fadeInUp 1s ease-in-out;
        }
        .notification-icon {

            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 20px;
            background: #fff;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            width: 300px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
        }
        .notification-dropdown .notification {
            background: #fff;
            color: #333;
            border-bottom: 1px solid #ddd;
        }
        .notification-dropdown .notification:last-child {
            border-bottom: none;
        }
        .donate-btn {
            background: #ff4757;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            margin-top: 10px;
        }
        .donate-btn:hover {
            background: #ff6b81;
            transform: scale(1.05);
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .copy-text {
            display: flex;
            align-items: center;
        }
        .copy-text .text {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
            flex: 1;
        }
        .copy-text button {
            background: #ff4757;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        .copy-text button:hover {
            background: #ff6b81;
            transform: scale(1.05);
        }
        .copy-text button i {
            font-size: 1.2em;
        }

        .done-btn {
    background-color: green;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}

.done-btn:hover {
    background-color: darkgreen;
    transform: scale(1.05);
}

.remind-btn {
    background-color: red;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}

.remind-btn:hover {
    background-color: darkred;
    transform: scale(1.05);
}
        /* Overlay styles */
        .overlay {
            position: absolute;
            top: 7%;
            left: 90%;
            transform: translate(-50%, -50%);


            padding: 10px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px; /* Space between image and text */
        }
        .overlay-h4 {
            color: white;
            z-index: 4;
        }

        .profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

    </style>
</head>
<body>
<div id="full">
    <div id="inner_full">
        <div class="header">
            <div class="logo"><h2>Blood Donation</h2></div>
            <div class="nav">
                <div id="d"><a href="user.php">Dashboard</a></div>
                <div id="d"><a href="userabout.php">About Us</a></div>
                <div id="d"><a href="usercontactus.php">Contact Us</a></div>
                <div id="d"><a href="userhelp.php">Help</a></div>
                <div id="e"><a href="user_home.php" class="btn">Logout</a></div>
            </div>
            
        </div>
        
        <div id="body">
            <br>
            <h3 align="center">User Dashboard</h3>
            <h4 align="center">Welcome, <?= htmlspecialchars($user->name); ?></h4>
            <form method="post" action="">
            <table border="1" align="center">
                <tr>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Age</th>
                    <th>Blood Group</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                </tr>
                <tr>
                        <td><input type="text" name="name" class="form-input" value="<?= htmlspecialchars($user->name); ?>"></td>
                        <td><input type="text" name="fname" class="form-input" value="<?= htmlspecialchars($user->fname); ?>"></td>
                        <td><input type="text" name="address" class="form-input" value="<?= htmlspecialchars($user->address); ?>"></td>
                        <td><input type="text" name="city" class="form-input" value="<?= htmlspecialchars($user->city); ?>"></td>
                        <td><input type="number" name="age" class="form-input" value="<?= htmlspecialchars($user->age); ?>"></td>
                        <td><?= htmlspecialchars($user->bgroup); ?></td>
                        <td><?= htmlspecialchars($user->email); ?></td>
                        <td><input type="text" name="mno" class="form-input" value="<?= htmlspecialchars($user->mno); ?>"></td>
                    </tr>
            </table>
                <br>
                <div align="center">
                    <input type="submit" name="update" value="Update Details" class="form-submit">
                </div>
            </form>
            <div class="notification-icon" onclick="toggleNotifications()">
                    <dotlottie-player src="https://lottie.host/022dd62b-7d18-4fe4-a25f-04b8922ca7af/DlCvLk7Meg.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></dotlottie-player>
            </div>
            <div class="notification-dropdown" id="notificationDropdown">
                <?php foreach ($requests as $request): ?>
                    <div class="notification">
                        <strong><?= htmlspecialchars($request->name); ?>:</strong> <?= htmlspecialchars($request->message); ?> (Contact: <?= htmlspecialchars($request->contact); ?>)
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <h4 align="center">Blood Requests</h4>
<table border="1" align="center">
    <tr>
        <th>Requester Name</th>
        <th>Message</th>
        <th>Contact Number</th>
        <th>Action</th>
        <th>Status</th>
    </tr>
    <?php foreach ($requests as $request): ?>
    <tr id="request-<?= $request->id; ?>">
        <td><?= htmlspecialchars($request->name); ?></td>
        <td><?= htmlspecialchars($request->message); ?></td>
        <td id="contact-<?= $request->id; ?>">
            <div class="container">
                <div class="label">
                    Contact Number
                </div>
                <div class="copy-text">
                    <input type="text" class="text" id="contact-input-<?= $request->id; ?>" value="<?= htmlspecialchars($request->contact); ?>" readonly>
                    <button>
                        <i class="fa fa-clone"></i>
                    </button>
                </div>
            </div>
        </td>
        <td>
            <button class="done-btn" onclick="markAsDone('<?= $request->id; ?>')">Mark as Done</button>
            <button class="remind-btn" onclick="remindLater('<?= $request->id; ?>')">Remind Later</button>
        </td>
        <td id="status-<?= $request->id; ?>">Pending</td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="overlay">
                    <img src="images/profile.png" alt="Profile Image" class="profile-img">
                    <h4><?= htmlspecialchars($user->name); ?></h4>
                </div>
<br>
<div align="center">
    <a href="user_logout.php" class="btn">Logout</a>
</div>
        </div>
        <div id="footer">
            <h4 align="center">&copy; 2023 Blood Donation. All rights reserved.</h4>
            <p align="center">Contact us: info@blooddonation.com | +1 234 567 890</p>
        </div>
    </div>
</div>

<script>
function toggleNotifications() {
    var dropdown = document.getElementById('notificationDropdown');
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.closest('.notification-icon')) {
        var dropdowns = document.getElementsByClassName("notification-dropdown");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
}


</script>
<script>
document.querySelectorAll(".copy-text").forEach(copyText => {
    copyText.querySelector("button").addEventListener("click", function() {
        let input = copyText.querySelector("input.text");
        input.select();
        document.execCommand("copy");
        copyText.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function() {
            copyText.classList.remove("active");
        }, 2500);
    });
});
</script>
<script>
function markAsDone(requestId) {
    var statusElement = document.getElementById('status-' + requestId);
    if (statusElement) {
        statusElement.innerText = 'Done';
    }
}

function remindLater(requestId) {
    var statusElement = document.getElementById('status-' + requestId);
    if (statusElement) {
        statusElement.innerText = 'Pending';
    }
}

document.querySelectorAll(".copy-text").forEach(copyText => {
    copyText.querySelector("button").addEventListener("click", function() {
        let input = copyText.querySelector("input.text");
        input.select();
        document.execCommand("copy");
        copyText.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function() {
            copyText.classList.remove("active");
        }, 2500);
    });
});
</script>

</body>
</html>