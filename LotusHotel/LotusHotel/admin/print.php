<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hóa đơn</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #999;
            padding: 0.5in;
        }
        .invoice-container {
            background: #FFF;
            padding: 0.5in;
            width: 8.5in;
            margin: 0 auto;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            text-transform: uppercase;
            background: #000;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
        }
        address, .details, .total {
            font-size: 14px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #eee;
        }
        .total th {
            text-align: right;
        }
        .total td {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
include('../db.php');
$pid = $_GET['pid'];
$stmt = $con->prepare("SELECT * FROM payment WHERE id = :pid");
$stmt->execute(['pid' => $pid]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) die('Không tìm thấy hóa đơn.');
?>
<div class="invoice-container">
    <h1>Hóa đơn thanh toán</h1>
    <address>
        <strong>LOTUS HOTEL</strong><br>
        736 Nguyễn Trãi, Phường 5, Quận 6, TP.HCM<br>
        0896468675
    </address>
    <div class="details">
        <p><strong>Khách hàng:</strong> <?= htmlspecialchars($row['guest_name']) ?></p>
        <p><strong>CCCD:</strong> <?= htmlspecialchars($row['cccd']) ?></p>
        <p><strong>Phòng:</strong> <?= htmlspecialchars($row['room_no']) ?> (<?= htmlspecialchars($row['room_type']) ?>)</p>
        <p><strong>Check-in:</strong> <?= htmlspecialchars($row['checkin']) ?> | <strong>Check-out:</strong> <?= htmlspecialchars($row['checkout']) ?></p>
        <p><strong>Số ngày ở:</strong> <?= $row['no_of_days'] ?> ngày</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Dịch vụ</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Phòng (<?= htmlspecialchars($row['room_type']) ?>)</td>
                <td><?= number_format($row['room_price'], 0, ',', '.') ?> ₫</td>
                <td><?= $row['no_of_days'] ?> ngày</td>
                <td><?= number_format($row['room_price'] * $row['no_of_days'], 0, ',', '.') ?> ₫</td>
            </tr>
            <?php if ($row['water'] > 0): ?>
            <tr>
                <td>Nước suối</td>
                <td>10.000 ₫</td>
                <td><?= $row['water'] ?></td>
                <td><?= number_format($row['water'] * 10000, 0, ',', '.') ?> ₫</td>
            </tr>
            <?php endif; ?>
            <?php if ($row['soft_drink'] > 0): ?>
            <tr>
                <td>Nước ngọt</td>
                <td>15.000 ₫</td>
                <td><?= $row['soft_drink'] ?></td>
                <td><?= number_format($row['soft_drink'] * 15000, 0, ',', '.') ?> ₫</td>
            </tr>
            <?php endif; ?>
            <?php if ($row['beer'] > 0): ?>
            <tr>
                <td>Bia</td>
                <td>20.000 ₫</td>
                <td><?= $row['beer'] ?></td>
                <td><?= number_format($row['beer'] * 20000, 0, ',', '.') ?> ₫</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <table class="total">
        <tr>
            <th>Tổng minibar:</th>
            <td><?= number_format($row['minibar_price'], 0, ',', '.') ?> ₫</td>
        </tr>
        <tr>
            <th>Tổng thanh toán:</th>
            <td><?= number_format($row['total_price'], 0, ',', '.') ?> ₫</td>
        </tr>
        <tr>
            <th>Đã thanh toán:</th>
            <td>0 ₫</td>
        </tr>
        <tr>
            <th>Còn lại:</th>
            <td><?= number_format($row['total_price'], 0, ',', '.') ?> ₫</td>
        </tr>
    </table>
</div>
</body>
</html>
