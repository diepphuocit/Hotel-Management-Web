<?php  
session_start();  
include '../includes/session.php';
requiredLogin();
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <?php include 'includes/header.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div id="page-wrapper">
            <div id="page-inner">

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Quản lý đặt phòng
                        </h1>
                    </div>
                </div>

                <?php
                include '../db.php';
                $stmt = $con->query("SELECT COUNT(*) as total FROM roombook");
                $totalBookings = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">

                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    <button class="btn btn-default" type="button">
                                                        Phòng đặt gần đây <span class="badge"><?php echo $totalBookings; ?></span>
                                                    </button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Họ tên</th>
                                                                <th>CCCD</th>
                                                                <th>Email</th>
                                                                <th>SĐT</th>
                                                                <th>Loại phòng</th>
                                                                <th>Check-In</th>
                                                                <th>Check-Out</th>
                                                                <th>Số ngày</th>
                                                                <th>Ngày tạo</th>
                                                                <th>Tổng tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $prices = [
                                                                "Luxury Room" => 1500000,
                                                                "Deluxe Room" => 1000000,
                                                                "Guest House" => 770000,
                                                                "Single Room" => 500000
                                                            ];
                                                            $stmt = $con->query("SELECT * FROM roombook ORDER BY created_at DESC");
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                $roomType = $row['room_type'];
                                                                $days = (int)$row['nodays'];
                                                                $unitPrice = isset($prices[$roomType]) ? $prices[$roomType] : 0;
                                                                $total = $unitPrice * $days;
                                                                $formattedTotal = number_format($total, 0, ',', '.') . ' ₫';

                                                                // Cập nhật cột tổng tiền trong database nếu chưa có
                                                                $updateStmt = $con->prepare("UPDATE roombook SET total_price = ? WHERE id = ?");
                                                                $updateStmt->execute([$total, $row['id']]);

                                                                echo "<tr>
                                                                    <td>{$row['id']}</td>
                                                                    <td>{$row['name']}</td>
                                                                    <td>{$row['cccd']}</td>
                                                                    <td>{$row['email']}</td>
                                                                    <td>{$row['phone']}</td>
                                                                    <td>{$row['room_type']}</td>
                                                                    <td>{$row['checkin']}</td>
                                                                    <td>{$row['checkout']}</td>
                                                                    <td>{$row['nodays']}</td>
                                                                    <td>{$row['created_at']}</td>
                                                                    <td>{$formattedTotal}</td>
                                                                </tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>
