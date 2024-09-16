<?php
include('connection.php');
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['name']) && isset($data['fname']) && isset($data['address']) && isset($data['city']) && isset($data['age']) && isset($data['bgroup']) && isset($data['email']) && isset($data['mno'])) {
    $id = $data['id'];
    $name = $data['name'];
    $fname = $data['fname'];
    $address = $data['address'];
    $city = $data['city'];
    $age = $data['age'];
    $bgroup = $data['bgroup'];
    $email = $data['email'];
    $mno = $data['mno'];

    $query = $db->prepare("UPDATE donor_registration SET name = ?, fname = ?, address = ?, city = ?, age = ?, bgroup = ?, email = ?, mno = ? WHERE id = ?");
    $result = $query->execute([$name, $fname, $address, $city, $age, $bgroup, $email, $mno, $id]);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>