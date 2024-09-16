<?php
include('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Blood List</title>
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
        table {
            width: 90%;
            font-size: 18px; /* Adjust the font size as needed */
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        .back-button {
            background-color: #ff4757;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }
        .back-button:hover {
            background-color: #ff6b81;
            transform: translateY(-5px);
        }
        .logout-button {
            background-color: #ff6b81;
            color: white;
            padding: 5px 20px;
            border-radius: 100px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
<iframe id="spline-background" src="https://my.spline.design/clonercubesgenerativecopy-1ccd78409e8f3f19ff885ee714254f95/" frameborder="0"></iframe>
<div id="full">
    <div id="inner_full">
        <div id="header">
            <h2 style="margin-top:5%;"><a href="admin-home.php">Blood Donation System</a></h2>
        </div>
        <div id="body">
            <br>
            <?php
            $un = $_SESSION['un'];
            if(!$un) {
                header("Location:index.php");
            }
            ?>
            <h1>Exchange Blood List</h1>
            <center>
                <div id="form">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Blood Group</th>
                        </tr>
                        <?php
                        $q = $db->query("SELECT * FROM exchange_b");
                        while($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <td><?= $r1->name; ?></td>
                                <td><?= $r1->mno; ?></td>
                                <td><?= $r1->bgroup; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <a href="admin-home.php" class="back-button">Back to Home</a>
                </div>
            </center>
        </div>
        <div id="footer">
            <h4 align="center">Copyright@projectbdms</h4>
            <p align="center"><a href="logout.php" class="logout-button">Logout</a></p>
        </div>
    </div>
</div>
</body>
</html>