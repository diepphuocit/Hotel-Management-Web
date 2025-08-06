<?php
session_start();
include('../db.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Lấy toàn bộ phản hồi của user
$stmt = $con->prepare("
    SELECT c.message, c.cdate, r.reply AS feedback, r.rdate, r.is_seen_by_customer, r.id AS reply_id
    FROM contact c
    LEFT JOIN reply r ON c.id = r.contact_id
    WHERE c.username = :username
    ORDER BY c.cdate DESC
");
$stmt->execute([':username' => $username]);
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Đánh dấu tất cả phản hồi là đã xem
$unseenIDs = array_column(array_filter($feedbacks, fn($fb) => $fb['is_seen_by_customer'] == 0 && $fb['reply_id']), 'reply_id');
if ($unseenIDs) {
    $inClause = implode(',', array_fill(0, count($unseenIDs), '?'));
    $updateStmt = $con->prepare("UPDATE reply SET is_seen_by_customer = 1 WHERE id IN ($inClause)");
    $updateStmt->execute($unseenIDs);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi của bạn - LOTUS HOTEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-feedback {
            transition: box-shadow 0.3s ease-in-out;
        }
        .card-feedback:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">📨 Phản hồi từ quản trị viên</h2>
                <p class="text-muted">Dưới đây là danh sách tất cả các phản hồi mà bạn đã nhận được</p>
            </div>

            <?php if ($feedbacks): ?>
                <?php foreach ($feedbacks as $fb): ?>
                    <div class="card mb-4 card-feedback">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><strong>📅</strong> <?= htmlspecialchars($fb['cdate']) ?></span>
                                <?php if (!$fb['feedback']): ?>
                                    <span class="badge bg-secondary">Chưa phản hồi</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>👤 Nội dung bạn gửi:</strong><br><?= nl2br(htmlspecialchars($fb['message'])) ?></p>
                            <hr>
                            <p><strong>💬 Phản hồi từ quản trị viên:</strong><br>
                                <?= $fb['feedback'] ? nl2br(htmlspecialchars($fb['feedback'])) : '<em>Chưa có phản hồi.</em>' ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info text-center">⚠️ Bạn chưa có phản hồi nào.</div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="home.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
