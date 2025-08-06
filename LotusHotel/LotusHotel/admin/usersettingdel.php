<?php
session_start();
include('../db.php');

$id = $_GET['eid'] ?? null;
$err = "";
if ($id !== null && is_numeric($id)) {
    $stmt = $con->prepare("DELETE FROM `users` WHERE id = :id");
    if ($stmt->execute([':id' => $id])) {
        $err = "Xóa người dùng thành công.";
    } else {
        $err = "Không thể xóa người dùng.";
    }
} else {
    $err = "ID không hợp lệ.";
}

header("Location: usersetting.php?error=" . urlencode($err));

exit;
?>
