<?php
    session_start();
    include '../db.php';
    include '../includes/session.php';
    requiredLogin();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quản lý lễ tân</title>
  <link rel="stylesheet" href="recepstyle.css" />
</head>
<body>
    <div class="sidebar">
        <div>
        <h3>Xin chào <?php echo $_SESSION['username']; ?></h3>
        <ul>
            <li><a href="home.php">Đặt phòng</a></li>
            <li><a href="bookinglist.php">Danh sách đặt phòng</a></li>
            <li><a href="payment.php">Hóa đơn</a></li>
            <li><a href="profit.php">Doanh thu</a></li>
        </ul>
        </div>
        <div>
        <ul>
            <li><a href="../logout.php">Đăng xuất</a></li>
        </ul>
        </div>
    </div>
</body>
</html>
