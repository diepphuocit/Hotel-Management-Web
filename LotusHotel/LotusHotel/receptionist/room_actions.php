<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../db.php';

$action = $_REQUEST['action'] ?? '';
$room   = $_REQUEST['room']   ?? '';
if(!$room){ echo json_encode(['error'=>'Thiếu room']); exit; }

try{
/* ====== CHECK‑IN ====== */
if($action==='checkin'){
  $name = trim($_POST['guest_name'] ?? '');
  $cccd = trim($_POST['cccd'] ?? '');
  if(!$name) throw new Exception('Thiếu tên khách');

  $con->prepare(
    "UPDATE rooms SET customer_name=:n, cccd=:c,
     check_in=CURDATE(), state='booked'
     WHERE room_number=:r"
  )->execute(['n'=>$name,'c'=>$cccd,'r'=>$room]);

  echo json_encode(['ok'=>1]); exit;
}

/* ====== SAVE ====== */
if($action==='save'){
  $cols = ['customer_name','cccd','phone','email','address',
           'check_out','water','soft_drink','beer'];
  $set=[]; $p=['r'=>$room];
  foreach($cols as $c){
    if(isset($_POST[$c])){ $set[]="$c=:".$c; $p[$c]=$_POST[$c]; }
  }
  if($set){
    $con->prepare("UPDATE rooms SET ".implode(',',$set)." WHERE room_number=:r")
        ->execute($p);
  }
  echo json_encode(['ok'=>1]); exit;
}

/* ====== CHECK‑OUT ====== */
if($action==='checkout'){
  $stmt = $con->prepare("SELECT * FROM rooms WHERE room_number=:r");
  $stmt->execute(['r'=>$room]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if(!$row) throw new Exception('Không tìm thấy phòng');

  $checkout = $_POST['check_out'] ?: date('Y-m-d');
  $days = (new DateTime($row['check_in']))->diff(new DateTime($checkout))->days ?: 1;

  $mb_price = $row['water']*10000 + $row['soft_drink']*15000 + $row['beer']*20000;
  $total    = $days * $row['price_per_day'] + $mb_price;

  $sql = "INSERT INTO payment(room_no,room_type,guest_name,cccd,checkin,checkout,no_of_days,
          room_price,water,soft_drink,beer,minibar_price,total_price)
          VALUES(:room,:type,:name,:cccd,:in,:out,:days,:price,:w,:s,:b,:mb,:tot)";
  $con->prepare($sql)->execute([
    'room' =>$room,
    'type' =>$row['room_type'],
    'name' =>$row['customer_name'],
    'cccd' =>$row['cccd'],
    'in'   =>$row['check_in'],
    'out'  =>$checkout,
    'days' =>$days,
    'price'=>$row['price_per_day'],
    'w'    =>$row['water'],
    's'    =>$row['soft_drink'],
    'b'    =>$row['beer'],
    'mb'   =>$mb_price,
    'tot'  =>$total
  ]);

  $con->prepare("UPDATE rooms SET
       customer_name=NULL, cccd=NULL, phone=NULL, email=NULL, address=NULL,
       check_in=NULL, check_out=NULL,
       water=0, soft_drink=0, beer=0,
       minibar_price=0, total_price=0,
       state='clear'
     WHERE room_number=:r")->execute(['r'=>$room]);

  echo json_encode(['ok'=>1]); exit;
}

/* ====== CLEAN (từ clear → available) ====== */
if($action==='clean'){
  $con->prepare("UPDATE rooms SET state='available' WHERE room_number=:r")
      ->execute(['r'=>$room]);
  echo json_encode(['ok'=>1]); exit;
}

throw new Exception('Hành động không hợp lệ');
}catch(Exception $e){
  echo json_encode(['error'=>$e->getMessage()]);
}
