<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOTUS HOTEL - Hóa đơn lễ tân</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <style>
        #wrapper {
    display: flex;
}

.sidebar {
    width: 250px;
    background-color: #f1f1f1;
    padding: 20px;
    min-height: 100vh;
    border-right: 1px solid #ddd;
}

#page-wrapper {
    flex-grow: 1;
    background-color: #fff;
    padding: 40px;
    margin-left: 0;
}

.table th {
    background-color: #000;
    color: white;
    text-align: center;
}
.table td {
    text-align: center;
}
.table-hover tbody tr:hover {
    background-color: #f5f5f5;
}

.panel-heading {
    font-weight: bold;
    font-size: 16px;
    background-color: #000;
    color: #fff;
    padding: 10px 15px;
    border-bottom: 1px solid #ddd;
    border-radius: 5px 5px 0 0;
}

.page-header {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 30px;
    color: #333;
}

    </style>
</head>
<body>
<div id="wrapper">
    <?php include('includes/navbar.php'); ?>

    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header"><i class="fa fa-credit-card"></i> Hóa đơn khách hàng</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center; font-size: 20px;">
                            Danh sách thanh toán gần đây
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <div class="table-container">
                                    <table class="table table-striped table-bordered" id="payment-table">
                                    <thead class="thead-dark">
                                        <tr style="background-color: #f1f1f1;">
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
                                        <th><strong>Tổng cộng</strong></th>
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
                                            echo "<tr>"
                                                . "<td>{$row['guest_name']}</td>"
                                                . "<td>{$row['room_no']}</td>"
                                                . "<td>{$row['room_type']}</td>"
                                                . "<td>{$row['cccd']}</td>"
                                                . "<td>{$row['checkin']}</td>"
                                                . "<td>{$row['checkout']}</td>"
                                                . "<td>{$row['no_of_days']}</td>"
                                                . "<td>" . number_format($row['room_price'], 0, ',', '.') . " ₫</td>"
                                                . "<td>{$row['water']}</td>"
                                                . "<td>{$row['soft_drink']}</td>"
                                                . "<td>{$row['beer']}</td>"
                                                . "<td>" . number_format($row['minibar_price'], 0, ',', '.') . " ₫</td>"
                                                . "<td style='font-weight: bold;'>" . number_format($row['total_price'], 0, ',', '.') . " ₫</td>"
                                                . "<td>{$row['created_at']}</td>"
                                                . "<td><a href='print.php?pid={$id}' class='btn btn-primary btn-sm'><i class='fa fa-print'></i> In</a></td>"
                                                . "</tr>";
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
