<?php  
    session_start();  
    include('../includes/session.php');
    requiredLogin();
    include('../db.php');

    $filter = $_GET['filter'] ?? 'day';

    if ($filter === 'month') {
        $query = "
            SELECT DATE_FORMAT(checkout, '%Y-%m') AS period, SUM(total_price) as total_revenue
            FROM payment
            GROUP BY period
            ORDER BY period ASC
        ";
    } elseif ($filter === 'year') {
        $query = "
            SELECT YEAR(checkout) AS period, SUM(total_price) as total_revenue
            FROM payment
            GROUP BY period
            ORDER BY period ASC
        ";
    } else {
        $query = "
            SELECT checkout AS period, SUM(total_price) as total_revenue
            FROM payment
            GROUP BY period
            ORDER BY period ASC
        ";
    }

    $stmt = $con->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $chart_data = '';
    foreach($result as $row) {
        $chart_data .= "{ date:'".$row["period"]."', revenue:".$row["total_revenue"]." }, ";
    }
    $chart_data = rtrim($chart_data, ", ");
?>  
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOTUS HOTEL</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/morris.css" rel="stylesheet" />
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
                        <h1 class="page-header">Thống kê doanh thu</h1>
                        <form method="get" style="margin-bottom: 20px;">
                            <label for="filter-type">Thống kê theo:</label>
                            <select name="filter" id="filter-type" onchange="this.form.submit()">
                                <option value="day" <?= $filter == 'day' ? 'selected' : '' ?>>Ngày</option>
                                <option value="month" <?= $filter == 'month' ? 'selected' : '' ?>>Tháng</option>
                                <option value="year" <?= $filter == 'year' ? 'selected' : '' ?>>Năm</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div id="chart" style="height: 250px;"></div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?= ucfirst($filter == 'day' ? 'Ngày' : ($filter == 'month' ? 'Tháng' : 'Năm')) ?></th>
                                            <th>Doanh thu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($result as $row) {
                                                echo "<tr>
                                                    <td>{$row['period']}</td>
                                                    <td>" . number_format($row['total_revenue'], 0, ',', '.') . " ₫</td>
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

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/raphael-min.js"></script>
    <script src="assets/js/morris.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });

        Morris.Bar({
            element: 'chart',
            data: [<?= $chart_data ?>],
            xkey: 'date',
            ykeys: ['revenue'],
            labels: ['Doanh thu'],
            hideHover: 'auto',
            stacked: false,
            resize: true,
            barColors: ['#0b62a4']
        });
    </script>
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>
