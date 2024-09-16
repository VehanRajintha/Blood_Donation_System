<?php
include('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
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
            width: 85%;
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
            color: black;
            text-decoration: none;
        }
        #body {
            padding: 20px;
        }
        h1 {
            color: black;
            text-align: center;
        }
        h2 {
            color: black;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #ff6b81;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .back-button:hover {
            background-color: #ff4757;
            transform: translateY(-5px);
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .edit-button {
            background-color: #4CAF50;
            color: white;
        }
        .edit-button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }
        .delete-button {
            background-color: #f44336;
            color: white;
        }
        .delete-button:hover {
            background-color: #e53935;
            transform: translateY(-2px);
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
            text-align: center;
            width: 400px;
        }
        #popup input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        #popup button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 14px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        #popup button:hover {
            background-color: #45a049;
            transform: translateY(-5px);
        }
        #popup .close-button {
            background-color: #f44336;
        }
        #popup .close-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
<iframe id="spline-background" src="https://my.spline.design/clonercubesgenerativecopy-1ccd78409e8f3f19ff885ee714254f95/" frameborder="0"></iframe>
<div id="full">
    <div id="inner_full">
        <div id="header">
            <h2 class="animated-text" style="margin-top:5%;"><a href="admin-home.php">Blood Donation System</a></h2>
        </div>
        <div id="body">
            <br>
            <h1>Current Donor List</h1>
            <center>
                <div id="form">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Age</th>
                            <th>Blood Group</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        $q = $db->query("SELECT * FROM donor_registration");
                        while($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <td><?= $r1->name; ?></td>
                                <td><?= $r1->fname; ?></td>
                                <td><?= $r1->address; ?></td>
                                <td><?= $r1->city; ?></td>
                                <td><?= $r1->age; ?></td>
                                <td><?= $r1->bgroup; ?></td>
                                <td><?= $r1->email; ?></td>
                                <td><?= $r1->mno; ?></td>
                                <td class="action-buttons">
                                    <button class="edit-button" onclick="openEditPopup(<?= $r1->id; ?>, '<?= $r1->name; ?>', '<?= $r1->fname; ?>', '<?= $r1->address; ?>', '<?= $r1->city; ?>', <?= $r1->age; ?>, '<?= $r1->bgroup; ?>', '<?= $r1->email; ?>', '<?= $r1->mno; ?>')">Edit</button>
                                    <button class="delete-button" onclick="deleteDonor(<?= $r1->id; ?>)">Delete</button>
                                </td>
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
            <p align="center"><a href="logout.php"><font color="white">Logout</a></p>
            
        </div>
    </div>
</div>

<div id="overlay">
    <div id="popup">
        <h2>Edit Donor</h2>
        <input type="hidden" id="edit-id">
        <input type="text" id="edit-name" placeholder="Name">
        <input type="text" id="edit-fname" placeholder="Father's Name">
        <input type="text" id="edit-address" placeholder="Address">
        <input type="text" id="edit-city" placeholder="City">
        <input type="number" id="edit-age" placeholder="Age">
        <input type="text" id="edit-bgroup" placeholder="Blood Group">
        <input type="email" id="edit-email" placeholder="Email">
        <input type="text" id="edit-mno" placeholder="Mobile No">
        <button onclick="updateDonor()">Update</button>
        <button class="close-button" onclick="closePopup()">Close</button>
    </div>
    
</div>


<script>
    function openEditPopup(id, name, fname, address, city, age, bgroup, email, mno) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-fname').value = fname;
        document.getElementById('edit-address').value = address;
        document.getElementById('edit-city').value = city;
        document.getElementById('edit-age').value = age;
        document.getElementById('edit-bgroup').value = bgroup;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-mno').value = mno;
        document.getElementById('overlay').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('overlay').style.display = 'none';
    }

    function updateDonor() {
        const id = document.getElementById('edit-id').value;
        const name = document.getElementById('edit-name').value;
        const fname = document.getElementById('edit-fname').value;
        const address = document.getElementById('edit-address').value;
        const city = document.getElementById('edit-city').value;
        const age = document.getElementById('edit-age').value;
        const bgroup = document.getElementById('edit-bgroup').value;
        const email = document.getElementById('edit-email').value;
        const mno = document.getElementById('edit-mno').value;

        fetch('update-donor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, name, fname, address, city, age, bgroup, email, mno })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Donor updated successfully');
                location.reload();
            } else {
                alert('Failed to update donor');
            }
        });
    }


    function deleteDonor(id) {
        if (confirm('Are you sure you want to delete this donor?')) {
            fetch('delete-donor.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Donor deleted successfully');
                    location.reload();
                } else {
                    alert('Failed to delete donor');
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var loader = document.getElementById('sec-loading');
        var content = document.getElementById('full');

        // Show loader
        loader.style.display = 'flex';
        content.style.display = 'none';

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