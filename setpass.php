<?php
// Start the session
session_start();

// Include the database connection file
include('connection.php');

// Check if the email is set in the session
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if the email is not set
    header("Location: donor-login.php");
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the password from the form
    $password = $_POST['password'];


    // Insert the email and hashed password into the users table
    $sql = "INSERT INTO users (email, pass) VALUES (:email, :pass) ON DUPLICATE KEY UPDATE pass = :pass";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':pass', $password);

    if ($stmt->execute()) {
        // Redirect to donor-login.php after successful insertion
        header("Location: donor-login.php");
        exit();
    } else {
        echo "<script>alert('Error: Data Not Inserted');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Your  Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    /* Reset some default styles */
    body, h1, h2, h3, h4, h5, h6, p, ul, ol, li, form, input, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Set a background color and font for the body */
        body {
            
            font-family: 'Roboto', sans-serif;
            
            background-size: cover;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            margin-bottom: 20%;
        }


        /* Style the container */
        .container {
            
            width: 30%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            margin-top:10%;

            z-index: 2;
        }

        /* Style the form elements */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form input[type="email"], form input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            max-width: 400px;
        }

        form button, form input[type="submit"] {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover, form input[type="submit"]:hover {
            background: #0056b3;
        }
        /* Style the alert message */
        .alert {
            padding: 10px;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Header styles */
        #header {
            margin-bottom: 20px;
        }

        #header h2 {
            font-size: 24px;
            color: #007bff;
        }
        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1;
        }
         /* Footer styles */
         #footer {
            margin-top: 20px;
        }

        #footer h4, #footer p {
            margin: 5px 0;
        }

        #footer a {
            color: white;
            text-decoration: none;
        }
    </style>
<body>
    
    <div class="modal-background"></div>
    
    <div class="container" id="inner_full">
    
        <div id="header">
            <h2>Blood Donation Management System</h2>
        </div>
        
        <div id="body">
            <h1>Set Password</h1>
            <center>
                <div id="form">
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td width="200px" height="50px">E-Mail</td>
                                <td width="200px" height="50px"><input type="email" name="email" value="<?= htmlspecialchars($email); ?>" readonly></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Password</td>
                                <td width="200px" height="50px"><input type="password" name="password" placeholder="Enter Password" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" height="50px"><input type="submit" value="Save"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </center>
        </div>
        <div id="footer">
            <h4 align="center">Copyright@projectbdms</h4>
            <p align="center"><a href="logout.php"><font color="white">Logout</a></p>
        </div>
    </div>
</div>
</body>
</html>