<?php
header('Content-Type: application/json; charset=utf-8');
if(empty($_GET['room'])){ echo json_encode(['error'=>'Thiếu room']); exit; }

require_once '../db.php';
$stmt = $con->prepare("SELECT * FROM rooms WHERE room_number = :r");
$stmt->execute(['r'=>$_GET['room']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo $row ? json_encode($row) : json_encode(['error'=>'Không tìm thấy phòng']);
