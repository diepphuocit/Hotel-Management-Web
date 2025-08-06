<?php
try {
    $con = new PDO("mysql:host=localhost;dbname=lotushoteldb;charset=utf8", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Tạo tài khoản hash_password admin và receptionist
    // Kiểm tra nếu chưa tồn tại tài khoản admin thì tạo mới
    $stmt = $con->prepare("SELECT COUNT(*) FROM users WHERE role = 'admin'");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        $password = password_hash('Admin#@#2011', PASSWORD_DEFAULT);
        $stmt = $con->prepare("INSERT INTO users (username, password, phone, role) VALUES ('admin', :password, '0896468675', 'admin')");
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }

} 
catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>