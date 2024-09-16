<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    // Insert the request data into the blood_requests table
    $q = $db->prepare("INSERT INTO blood_requests (email, message, name, contact) VALUES (:email, :message, :name, :contact)");
    $q->bindValue(':email', $email);
    $q->bindValue(':message', $message);
    $q->bindValue(':name', $name);
    $q->bindValue(':contact', $contact);

    if ($q->execute()) {
        echo "Request sent successfully!";
    } else {
        echo "Failed to send request.";
    }
}
?>