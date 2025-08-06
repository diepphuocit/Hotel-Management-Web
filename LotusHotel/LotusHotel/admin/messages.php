<?php  
session_start();  
include('../includes/session.php');
requiredLogin();
include('../db.php');

// Xử lý phản hồi admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_reply'])) {
    if (!isset($_POST['contact_id']) || !isset($_POST['admin_reply'])) {
        die("Thiếu dữ liệu!");
    }

    $contactId = $_POST['contact_id'];
    $adminUsername = $_SESSION['username'] ?? 'admin';
    $replyText = trim($_POST['admin_reply']);
    $rdate = date('Y-m-d');

    // Kiểm tra đã phản hồi chưa
    $checkStmt = $con->prepare("SELECT COUNT(*) FROM reply WHERE contact_id = ?");
    $checkStmt->execute([$contactId]);
    $alreadyReplied = $checkStmt->fetchColumn();

    if ($alreadyReplied == 0) {
        $insert = $con->prepare("INSERT INTO reply (contact_id, admin_username, reply, rdate, is_seen_by_customer) 
                                 VALUES (:contact_id, :admin_username, :reply, :rdate, 0)");
        $insert->execute([
            ':contact_id' => $contactId,
            ':admin_username' => $adminUsername,
            ':reply' => $replyText,
            ':rdate' => $rdate
        ]);
        echo "<script>alert('Đã gửi phản hồi thành công!'); window.location.href='messages.php';</script>";
    } else {
        echo "<script>alert('Đã phản hồi rồi!'); window.location.href='messages.php';</script>";
    }
    exit;
}
?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>LOTUS HOTEL - Quản lý phản hồi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div id="page-wrapper">
        <div id="page-inner">
            <h1 class="page-header">Phản hồi từ khách hàng</h1>
            <div class="panel panel-default">
                <div class="panel-heading">Danh sách phản hồi</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>SĐT</th>
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th>Phản hồi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               $sql = "
    SELECT c.id, c.fullname, c.phone, c.email, c.message, c.cdate,
           r.reply AS admin_reply, r.rdate
    FROM contact c
    LEFT JOIN reply r ON c.id = r.contact_id
    ORDER BY c.id DESC
";
                           $stmt = $con->prepare($sql);
                                $stmt->execute();
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($rows as $row):
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                    <td><?= htmlspecialchars($row['cdate']) ?></td>
                                    <td>
                                        <?php if ($row['admin_reply']): ?>
                                            <div style="max-height: 100px; overflow-y: auto;">
                                                <?= nl2br(htmlspecialchars($row['admin_reply'])) ?><br>
                                                <small><i>Gửi ngày <?= htmlspecialchars($row['rdate']) ?></i></small>
                                            </div>
                                        <?php else: ?>
                                            <form method="post" action="messages.php" class="reply-form">
                                                <input type="hidden" name="contact_id" value="<?= $row['id'] ?>">
                                                <textarea name="admin_reply" class="form-control" rows="2" required></textarea>
                                                <button type="submit" name="send_reply" class="btn btn-primary btn-sm" style="margin-top: 5px;">
                                                    <i class="fa fa-reply"></i> Gửi
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
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
