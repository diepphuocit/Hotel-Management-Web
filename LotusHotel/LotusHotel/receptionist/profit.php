<?php  
    include '../db.php';

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
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LOTUS HOTEL - Thống kê doanh thu</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.css" />
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css" />
  <link rel="stylesheet" href="assets/css/custom-styles.css" />

  <!-- Morris Chart -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Open Sans', sans-serif;
    }
    .main {
      padding: 30px;
    }
    .chart-container {
      margin-bottom: 30px;
    }
    .h2-text {
      margin-bottom: 20px;
      color: #333;
      border-bottom: 2px solid #007bff;
      padding-bottom: 10px;
    }
    .panel {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .table th {
      background-color: #000;
      color: white;
      text-align: center;
    }
    .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<div class="main">
  <form method="get" class="form-inline mb-3">
    <label for="filter">Thống kê theo: </label>
    <select name="filter" class="form-control" onchange="this.form.submit()">
      <option value="day" <?= $filter == 'day' ? 'selected' : '' ?>>Ngày</option>
      <option value="month" <?= $filter == 'month' ? 'selected' : '' ?>>Tháng</option>
      <option value="year" <?= $filter == 'year' ? 'selected' : '' ?>>Năm</option>
    </select>
  </form>

  <div class="chart-container">
    <h2 class="h2-text"><i class="fa fa-bar-chart"></i> Thống kê doanh thu</h2>
    <div id="chart" style="height: 250px;"></div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết doanh thu
    </div>
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
            <?php foreach ($result as $row): ?>
              <tr>
                <td><?= $row['period'] ?></td>
                <td><?= number_format($row['total_revenue'], 0, ',', '.') ?> ₫</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
  $(document).ready(function () {
    $('#dataTables-example').dataTable();
  });

  Morris.Bar({
    element: 'chart',
    data: [<?= $chart_data ?>],
    xkey: 'date',
    ykeys: ['revenue'],
    labels: ['Doanh thu (VNĐ)'],
    barColors: ['#007bff'],
    hideHover: 'auto',
    resize: true
  });
</script>
</body>
</html>
