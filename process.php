<?php
// Для JSON данных
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Или для form-data
// $name = $_POST['name'];

// Обработка данных
$response = ['status' => 'success', 'data' => $data];
echo json_encode($response);
?>