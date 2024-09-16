<?php
// Include the database connection file
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
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
            text-align: left;
        }
        input[type="text"], input[type="email"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"], .back-button {
            background-color: #ff4757;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="submit"]:hover, .back-button:hover {
            background-color: #ff6b81;
            transform: translateY(-5px);
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
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
            
            <h1>Donor Registration</h1>
            <center>
                <div id="form">
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td width="200px" height="50px">Name</td>
                                <td width="200px" height="50px"><input type="text" name="name" placeholder="Enter Name" required></td>
                                <td width="200px" height="50px">Father's Name</td>
                                <td width="200px" height="50px"><input type="text" name="fname" placeholder="Enter Father's Name" required></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Address</td>
                                <td width="200px" height="50px"><textarea name="address" placeholder="Enter Address" required></textarea></td>
                                <td width="200px" height="50px">City</td>
                                <td width="200px" height="50px"><input type="text" name="city" placeholder="Enter City" required></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Age</td>
                                <td width="200px" height="50px"><input type="number" name="age" placeholder="Enter Age" required></td>
                                <td width="200px" height="50px">Blood Group</td>
                                <td width="200px" height="50px">
                                    <select name="bgroup" required>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">E-Mail</td>
                                <td width="200px" height="50px"><input type="email" name="email" placeholder="Enter E-Mail" required></td>
                                <td width="200px" height="50px">Mobile No</td>
                                <td width="200px" height="50px"><input type="text" name="mno" placeholder="Enter Mobile No" required></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center" height="50px"><input type="submit" name="sub" value="Save"></td>
                            </tr>
                        </table>
                    </form>
                    <a href="admin-home.php" class="back-button">Back to Home</a>
                </div>
            </center>
            <?php
            if(isset($_POST['sub'])) {
                $name = $_POST['name'];
                $fname = $_POST['fname'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $age = $_POST['age'];
                $bgroup = $_POST['bgroup'];
                $email = $_POST['email'];
                $mno = $_POST['mno'];

                $q = $db->prepare("INSERT INTO donor_registration (name, fname, address, city, age, bgroup, email, mno) VALUES (:name, :fname, :address, :city, :age, :bgroup, :email, :mno)");
                $q->bindValue(':name', $name);
                $q->bindValue(':fname', $fname);
                $q->bindValue(':address', $address);
                $q->bindValue(':city', $city);
                $q->bindValue(':age', $age);
                $q->bindValue(':bgroup', $bgroup);
                $q->bindValue(':email', $email);
                $q->bindValue(':mno', $mno);

                // Execute the query
                if ($q->execute()) {
                    echo "<script>alert('Donor Registration Successful')</script>";
                } else {
                    echo "<script>alert('Data Not Inserted')</script>";
                }
            }
            ?>
        </div>
        <div id="footer">
            <h4 align="center">Copyright@projectbdms</h4>
            <p align="center"><a href="logout.php" class="logout-button">Logout</a></p>
        </div>
    </div>
</div>
</body>
</html>