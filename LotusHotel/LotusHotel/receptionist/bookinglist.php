<?php
// recep_roombook.php
require_once '../db.php'; // file chứa kết nối PDO: $con

$dateFilter = $_GET['date'] ?? null;
$sql = "SELECT * FROM roombook";
$params = [];

if ($dateFilter) {
    $sql .= " WHERE checkin = :checkin";
    $params[':checkin'] = $dateFilter;
}

$stmt = $con->prepare($sql);
$stmt->execute($params);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Danh sách đặt phòng - Lễ tân</title>
  <link rel="stylesheet" href="recepstyle.css" />
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
    .main { padding: 20px; max-width: 900px; margin: auto; background: #fff; box-shadow: 0 0 8px #ccc; }
    .search-section { margin-bottom: 20px; }
    .search-section input, .search-section button { padding: 8px; font-size: 16px; }
    .result-item { padding: 10px; border-bottom: 1px solid #ccc; }
    .result-item:last-child { border-bottom: none; }
    .result-item strong { color: #2c3e50; }
    .notfound { color: red; font-style: italic; }
  </style>
</head>
<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="main">
    <h2>Danh sách đặt phòng</h2>
    
    <div class="search-section">
      <form method="get">
        <label for="searchDate">Tìm theo ngày check-in:</label>
        <input type="date" id="searchDate" name="date" value="<?= htmlspecialchars($dateFilter) ?>">
        <button type="submit">Tìm</button>
        <a href="bookinglist.php"><button type="button">Xem tất cả</button></a>
      </form>
    </div>

    <div class="results">
  <?php if (count($bookings) > 0): ?>
    <?php foreach ($bookings as $row): ?>
      <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h4 style="margin-top: 0; color: #007bff;">
          <?= htmlspecialchars($row['name']) ?> - <?= htmlspecialchars($row['room_type']) ?>
        </h4>
        <p>
          <strong>CCCD:</strong> <?= htmlspecialchars($row['cccd']) ?><br>
          <strong>Email:</strong> <?= htmlspecialchars($row['email']) ?><br>
          <strong>SĐT:</strong> <?= htmlspecialchars($row['phone']) ?>
        </p>
        <p>
          <strong>Nhận phòng:</strong> <?= $row['checkin'] ?> |
          <strong>Trả phòng:</strong> <?= $row['checkout'] ?> |
          <strong>Số ngày:</strong> <?= $row['nodays'] ?>
        </p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="notfound">Không có dữ liệu đặt phòng cho ngày <?= $dateFilter ? htmlspecialchars($dateFilter) : 'này' ?>.</p>
  <?php endif; ?>
</div>

  </div>
</body>
</html>
