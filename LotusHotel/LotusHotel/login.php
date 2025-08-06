<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Chuẩn bị truy vấn
    $sql = "SELECT id, password, role FROM users WHERE username = :username";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();   
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra mật khẩu
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        // Chuyển hướng theo vai trò
        switch ($row['role']) {
            case 'admin':
                header("Location: admin/home.php");
                break;
            case 'receptionist':
                header("Location: receptionist/home.php");
                break;
            case 'customer':
                header("Location: customer/home.php");
                break;
            default:
                // Vai trò không xác định
                echo '<script>alert("Tài khoản không hợp lệ.");</script>';
                exit;
        }
        exit;
    } else {
        echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/StyleDangNhap.css">
    <title>Login</title>
</head>
<body class ="d-flex justify-content-center align-items-center vh-100 ">
    <div class="login box rounded">
        <form method="POST">
            <div class="row-md ">
                <div class="col-md">
                    <div class="heading-login">
                        <div class="name-login text-center"><h1>Đăng Nhập</h1></div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="box-username">
                        <div class="container-username input-box">
                            <input class="input-username" type="text" name="username" placeholder="Tên Tài Khoản">
                            <ion-icon name="person"></ion-icon>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                   <div class="box-password">
                        <div class="container-password input-box">
                            <input class="input-password toggle-password" type="password" name="password" placeholder="Mật Khẩu" id="password">
                            <ion-icon name="eye-off" id ="icon"></ion-icon>
                        </div> 
                   </div>
                </div>
                <div class="col-md">
                    <div class="button-login">
                        <button class="btn btn-primary w-100  rounded-pill" type="submit" style="height: 45px;">Đăng Nhập</button>
                    </div>
                </div>
                <div class="register-link col-12">
                    <p>Bạn không có tài khoản? <a href ="customer/register.php" >Đăng Ký</a></p>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        const password = document.querySelector("#password");
        const icon = document.querySelector("#icon");
      
        icon.addEventListener("click", function () {
          const showpassword = password.type === "password";
          password.type = showpassword ? "text" : "password";
          icon.name = showpassword ? "eye-off" :"eye";
        });
    </script>
</body>
</html>



