<?php
include('connection.php');
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];

    $query = $db->prepare("DELETE FROM donor_registration WHERE id = ?");
    $result = $query->execute([$id]);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>