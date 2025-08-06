<?php  
    session_start();  
    include('../includes/session.php');
    requiredLogin();
    ob_start();
    include('../db.php');
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

        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           ADMIN - Quản lý người dùng
                        </h1>
                    </div>
                </div> 
            <?php
                $sql = "SELECT * FROM `users`";
                $re = $con->query($sql);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tài khoản</th>
                                            <th>Vai trò</th>
                                            <th>Ngày tạo</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while ($row = $re->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['username']}</td>
                                                <td>{$row['role']}</td>
                                                <td>{$row['created_at']}</td>
                                                <td><a href='usersettingdel.php?eid={$row['id']}' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Xóa</a></td>
                                            </tr>";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Thêm tài khoản lễ tân</button>

                        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Thêm tài khoản lễ tân</h4>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Tên đăng nhập</label>
                                                <input name="username" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu</label>
                                                <div class="input-group">
                                                    <input name="password" type="password" id="password" class="form-control" required>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" onclick="togglePassword()"><i class="fa fa-eye"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input name="phone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                            <input type="submit" name="add_receptionist" class="btn btn-primary" value="Thêm">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['add_receptionist'])) {
                        $username = trim($_POST['username']);
                        $password = $_POST['password'];
                        $phone = $_POST['phone'];

                        if (empty($username) || empty($password)) {
                            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
                        } elseif (strlen($password) < 6) {
                            echo "<script>alert('Mật khẩu phải ít nhất 6 ký tự.');</script>";
                        } else {
                            $stmt = $con->prepare("SELECT * FROM users WHERE username = :username");
                            $stmt->execute([':username' => $username]);

                            if ($stmt->rowCount() > 0) {
                                echo "<script>alert('Tên tài khoản đã tồn tại.');</script>";
                            } else {
                                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                $stmt = $con->prepare("INSERT INTO users (username, password, phone, role) VALUES (:username, :password, :phone, 'receptionist')");
                                $stmt->execute([
                                    ':username' => $username,
                                    ':password' => $hashedPassword,
                                    ':phone' => $phone
                                ]);
                                echo "<script>alert('Thêm tài khoản lễ tân thành công.'); window.location.href='usersetting.php';</script>";
                            }
                        }
                    }
                    ?>

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
    function togglePassword() {
        var input = document.getElementById("password");
        input.type = input.type === "password" ? "text" : "password";
    }
</script>
<script src="assets/js/custom-scripts.js"></script>
</body>
</html>
