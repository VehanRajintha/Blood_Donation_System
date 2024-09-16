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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            transform: scale(1.2); /* Zoom in the background */
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
            width: 40%;
            height: 50%;
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
        #header h2 {
            margin: 0;
        }
        #body {
            padding: 20px;
        }
        table {
            margin: 0 auto;
        }
        table td {
            padding: 10px;
        }
        input[type="text"], input[type="submit"] {
            width: 150px;
            height: 30px;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 5px;
        }
        input[type="submit"] {
            width: 100px;
            background-color: #ff6b81;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #ff4757;
            transform: translateY(-5px);
        }
        .btn-donor-login {
            background-color: #ff6b81;
            color: white;
            padding: 10px 20px;
            border-radius: 100px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        

        

    </style>
</head>
<body>
<iframe id="spline-background" src="https://my.spline.design/clonercubesgenerativecopy-1ccd78409e8f3f19ff885ee714254f95/" frameborder="0"></iframe>
<div id="full">
    <div id="inner_full">
        <div id="header">
            <h2>Blood Donation System</h2>
        </div>
        <div id="body">
            <br>
            <h3 align="center">Donor Login</h3>
            <form action="" method="post">
                <table>
                    <tr>
                        <td width="200px" height="70px"><b>Enter Username</b></td>
                        <td width="200px" height="70px"><input type="text" name="un" placeholder="Enter Username"></td>
                    </tr>
                    <tr>
                        <td width="200px" height="70px"><b>Enter Password</b></td>
                        <td width="200px" height="70px"><input type="text" name="ps" placeholder="Enter Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="sub" value="Login"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                         <a href="index.php" class="btn-donor-login">Login as a Admin</a>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        if (isset($_POST['sub'])) {
            $un = $_POST['un'];
            $ps = $_POST['ps'];

            // Prepare the SQL statement with placeholders
            $q = $db->prepare("SELECT * FROM users WHERE email = :email AND pass = :pass");
            $q->bindParam(':email', $un);
            $q->bindParam(':pass', $ps);

            // Execute the query
            $q->execute();

            // Fetch the results
            $res = $q->fetchAll(PDO::FETCH_OBJ);

            if ($res) {
                $_SESSION['un'] = $un;
                header("Location:user.php");
            } else {
                echo "<script>alert('Username or Password is incorrect')</script>";
            }
        }
        ?>
        </div>
        <div id="footer">
            <h4 align="center">Copyright@projectbdms</h4>
        </div>
    </div>
</div>
</body>
</html>