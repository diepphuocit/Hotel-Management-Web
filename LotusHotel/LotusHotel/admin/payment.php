<?php  
    session_start();  
    include('../includes/session.php');
    requiredLogin();
?>  
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOTUS HOTEL</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">Thanh toán</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tên khách</th>
                                            <th>Số phòng</th>
                                            <th>Loại phòng</th>
                                            <th>CCCD</th>
                                            <th>Check in</th>
                                            <th>Check out</th>
                                            <th>Số ngày</th>
                                            <th>Giá phòng</th>
                                            <th>Nước suối</th>
                                            <th>Nước ngọt</th>
                                            <th>Bia</th>
                                            <th>Giá minibar</th>
                                            <th>Tổng cộng</th>
                                            <th>Ngày tạo</th>
                                            <th>In</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('../db.php');
                                        $sql = "SELECT * FROM payment ORDER BY created_at DESC";
                                        $stmt = $con->query($sql);
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $id = $row['id'];
                                            $rowClass = ($id % 2 == 1) ? 'gradeC' : 'gradeU';
                                            echo "<tr class='{$rowClass}'>
                                                <td>{$row['guest_name']}</td>
                                                <td>{$row['room_no']}</td>
                                                <td>{$row['room_type']}</td>
                                                <td>{$row['cccd']}</td>
                                                <td>{$row['checkin']}</td>
                                                <td>{$row['checkout']}</td>
                                                <td>{$row['no_of_days']}</td>
                                                <td>" . number_format($row['room_price'], 0, ',', '.') . " ₫</td>
                                                <td>{$row['water']}</td>
                                                <td>{$row['soft_drink']}</td>
                                                <td>{$row['beer']}</td>
                                                <td>" . number_format($row['minibar_price'], 0, ',', '.') . " ₫</td>
                                                <td>" . number_format($row['total_price'], 0, ',', '.') . " ₫</td>
                                                <td>{$row['created_at']}</td>
                                                <td><a href='print.php?pid={$id}'><button class='btn btn-primary'><i class='fa fa-print'></i> In</button></a></td>
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
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<script src="assets/js/custom-scripts.js"></script>
</body>
</html>
