<?php
session_start();
include '../db.php';

$err = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username-reg']);
    $password_raw = trim($_POST['password-reg']);
    $repeatpassword = trim($_POST['repeatpassword-reg']);
    $tellphone = trim($_POST['tellphone']);

    // Kiểm tra có rỗng không
    if (empty($username) || empty($password_raw) || empty($repeatpassword) || empty($tellphone)) {
        $err = "Vui lòng điền đầy đủ thông tin.";
    } elseif ($password_raw !== $repeatpassword) {
        $err = "Mật khẩu không khớp.";
    } elseif (!preg_match('/^\d{10}$/', $tellphone)) {
        $err = "Số điện thoại phải có 10 chữ số.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $err = "Tên đăng nhập chỉ sử dụng chữ cái, số và dấu gạch dưới.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/', $password_raw)) {
        $err = "Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
    } else {
        // Kiểm tra số điện thoại trùng
        $stmt = $con->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$tellphone]);
        if ($stmt->rowCount() > 0) {
            $err = "Số điện thoại đã được sử dụng. Vui lòng chọn số khác.";
        } else {
            // Kiểm tra username trùng
            $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $err = "Tài khoản đã tồn tại. Vui lòng chọn tên khác.";
            } else {
                // Tạo tài khoản mới
                $password = password_hash($password_raw, PASSWORD_DEFAULT);
                $stmt = $con->prepare("INSERT INTO users (username, password, phone, role) VALUES (?, ?, ?, 'customer')");
                if ($stmt->execute([$username, $password, $tellphone])) {
                    $_SESSION['username'] = $username;
                    header("Location: ../login.php");
                    exit(); // RẤT QUAN TRỌNG: dừng chương trình tại đây
                } else {
                    $err = "Đăng ký không thành công. Vui lòng thử lại.";
                }
            }
        }
    }
}
session_destroy();
?>

<!-- Form đăng ký -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="css/StyleDangKy.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="box-register">
        <form method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="heading-register">Đăng ký</div>
                </div>
                <div class="col-12">
                    <div class="box box-username">
                        <div class="name-username">Tên tài khoản:</div>
                        <div class="container-i container-username">
                            <input type="text" name="username-reg" class="input">
                            <div class="icon-username"><ion-icon name="mail-outline"></ion-icon></div> 
                        </div> 
                    </div>
                </div>
                <div class="col-12">
                    <div class="box box-password">
                        <div class="name-password">Mật Khẩu:</div>
                        <div class="container-i container-password">
                            <input type="password" name="password-reg" class="input" id="input-password">
                            <div class="icon-password">
                                <i class="bi bi-eye" id="pass"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box box-repeatpassword">
                        <div class="name-repeatpassword">Xác nhận mật khẩu:</div>
                        <div class="container-i container-repeatpassword">
                            <input type="password" name="repeatpassword-reg" class="input" id="input-repassword">
                            <div class="icon-repeatpassword">
                                <i class="bi bi-eye" id="repeat-pass"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box box-tellphone">
                        <div class="name-tellphone">Số điện thoại:</div>
                        <div class="container-i container-phone">
                            <input type="tel" name="tellphone" class="input">
                            <div class="icon-tellphone"><ion-icon name="call-outline"></ion-icon></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box box-error" name="err"></div>
                </div>
                <div class="col-12">
                    <div name="success"> </div>
                </div>
                <div class="col-12">
                    <div class="box-button-register">
                        <input type="submit" value="Đăng ký" class="input-button">
                    </div>
                </div>
            </div>
        </form>
         <div class="row row-return-login">
                <div class="return-login">
                    <p>Bạn đã có tài khoản? <a href="../login.php">Đăng nhập</a></p>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        const inputPassword = document.getElementById("input-password");
        const inputRePassword = document.getElementById("input-repassword");
        const passIcon = document.getElementById("pass");
        const repeatPassIcon = document.getElementById("repeat-pass");
        var errorBox = document.querySelector(".box-error");
        const allInputs = document.querySelectorAll("input");
        // Xử lý sự kiện focus cho tất cả các input để ẩn thông báo lỗi
        allInputs.forEach(input => {
            input.addEventListener("focus", () => {
                errorBox.textContent = "";
                errorBox.style.display = "none";
            });
        });

        passIcon.addEventListener("click", function () {
            const showPassword = inputPassword.type === "password";
            inputPassword.type = showPassword ? "text" : "password";
            passIcon.className = showPassword ? "bi bi-eye-slash" : "bi bi-eye";
        });

        repeatPassIcon.addEventListener("click", function () {
            const showRePassword = inputRePassword.type === "password";
            inputRePassword.type = showRePassword ? "text" : "password";
            repeatPassIcon.className = showRePassword ? "bi bi-eye-slash" : "bi bi-eye";
        });
    </script>
</body>
</html>





