<?php
include('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Blood Registration</title>
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
        }

        th, td {
            padding: 5px;
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
            <?php
            $un = $_SESSION['un'];
            if(!$un) {
                header("Location:index.php");
            }
            ?>
            <h1>Exchange Blood Registration</h1>
            <center>
                <div id="form">
                    <form action="" method="post">
                        <table>
    <tr>
        <td width="300px" height="80px">Enter Name</td>
        <td width="300px" height="80px"><input type="text" name="name" placeholder="Enter Name"></td>
        <td width="300px" height="80px">Enter Father's Name</td>
        <td width="300px" height="80px"><input type="text" name="fname" placeholder="Enter Father Name"></td>
    </tr>

    <tr>
        <td width="300px" height="80px">Enter Address</td>
        <td width="300px" height="80px"><textarea name="address"></textarea></td>
        <td width="300px" height="80px">Enter City</td>
        <td width="300px" height="80px"><input type="text" name="city" placeholder="Enter City"></td>
    </tr>

    <tr>
        <td width="300px" height="80px">Enter Age</td>
        <td width="300px" height="80px"><input type="text" name="age" placeholder="Enter Age"></td>
        <td width="300px" height="80px">Enter E-Mail</td>
        <td width="300px" height="80px"><input type="text" name="email" placeholder="Enter E-Mail"></td>
        
        
    </tr>

    <tr>
        
        <td width="300px" height="80px">Enter Mobile No</td>
        <td width="300px" height="80px"><input type="text" name="mno" placeholder="Enter Mobile No"></td>
    </tr>
    <tr>
        <td width="300px" height="80px">Select Blood Group</td>
    <td width="300px" height="80px">
            <select name="bgroup">
                <option value="" selected disabled>Select Blood Group</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>
            </select>
        </td>
        <td width="300px" height="80px">Exchange Blood Group</td>
        <td width="300px" height="80px">
            <select name="exbgroup">
                <option value="" selected disabled>Select Blood Group</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>
            </select>
        </td>
    </tr>
    
    </table>
    <tr>
        <td>
            <input type="submit" name="sub" Value="Save">
        </td>
    </tr>
                    </form>
                    <a href="admin-home.php" class="back-button">Back to Home</a>
                </div>
            </center>
            <?php
if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $bgroup = isset($_POST['bgroup']) ? $_POST['bgroup'] : ''; 
    $email = $_POST['email'];
    $exbgroup = $_POST['exbgroup'];
    $mno = $_POST['mno'];

    // Server-side validation
    if (empty($name) || empty($fname) || empty($address) || empty($city) || empty($age) || empty($bgroup) || empty($email) || empty($exbgroup) || empty($mno)) {
        echo "<script>alert('All fields are required. Please fill out all fields.')</script>";
    } elseif (!is_numeric($age) || !is_numeric($mno)) {
        echo "<script>alert('Age and Mobile Number must be numeric.')</script>";
    } else {
        // Query to find the donor
        $q = "SELECT * FROM donor_registration WHERE bgroup = :bgroup";
        $st = $db->prepare($q);
        $st->execute([':bgroup' => $bgroup]);
        $num_row = $st->fetch(PDO::FETCH_ASSOC);

        if ($num_row) {
            $id = $num_row['id'];
            $donor_name = $num_row['name'];
            $b1 = $num_row['bgroup'];
            $donor_mno = $num_row['mno'];

            // Insert into out_stoke_b
            $q1 = "INSERT INTO out_stoke_b (bname, name, mno) VALUES (?, ?, ?)";
            $st1 = $db->prepare($q1);
            $st1->execute([$b1, $donor_name, $donor_mno]);

            // Delete from donor_registration
            $q2 = "DELETE FROM donor_registration WHERE id = :id";
            $st2 = $db->prepare($q2);
            $st2->execute([':id' => $id]);

            // Insert into exchange_b
            $q3 = $db->prepare("INSERT INTO exchange_b (name, fname, address, city, age, bgroup, email, mno, ebgroup) 
                VALUES (:name, :fname, :address, :city, :age, :bgroup, :email, :mno, :ebgroup)");

            // Bind the values to the placeholders
            $q3->bindValue(':name', $name);
            $q3->bindValue(':fname', $fname);
            $q3->bindValue(':address', $address);
            $q3->bindValue(':city', $city);
            $q3->bindValue(':age', $age);
            $q3->bindValue(':bgroup', $bgroup);
            $q3->bindValue(':email', $email);
            $q3->bindValue(':mno', $mno);
            $q3->bindValue(':ebgroup', $exbgroup);

            // Execute the query
            if ($q3->execute()) {
                echo "<script>alert('Exchange Successful')</script>";
            } else {
                echo "<script>alert('Data Not Inserted')</script>";
            }
        } else {
            echo "<script>alert('No donor found with the specified blood group')</script>";
        }
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