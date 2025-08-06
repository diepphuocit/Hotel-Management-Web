<?php
session_start();
include '../db.php';
// Kiểm tra nếu người dùng đã đăng nhập
include '../includes/session.php';
requiredLogin();


$roomTypes = [
  "Luxury Room" => [
    "desc" => "Luxury Room – Phòng cao cấp, bồn tắm hiện đại.",
    "image" => "../images/r1.jpg",
    "bed" => "1 Giường Super king size  (2m x 2.2m)",
    "price" => "1.500.000 ₫",
    "details" => '
      <p><strong>Dịch vụ bữa ăn:</strong></p>
      <ul>
        <li>Ăn sáng miễn phí (buffet)</li>
        <li>Bữa trưa và tối gọi món tại phòng hoặc ăn tại nhà hàng</li>
        <li>Đồ uống miễn phí trong minibar</li>
      </ul>
      <p><strong>Tiện ích khác:</strong></p>
      <ul>
        <li>Ban công riêng</li>
        <li>Bồn tắm nằm</li>
        <li>TV 55+ inch</li>
        <li>Máy pha cà phê, áo choàng tắm</li>
        <li>Điều hòa nhiệt độ</li>
        <li>Dịch vụ phòng 24/7</li>
      </ul>'
  ],

  "Deluxe Room" => [
    "desc" => "Deluxe Room – Nội thất sang trọng, view ban công.",
    "image" => "../images/r2.jpg",
    "bed" => "1 Giường King size bed (1.8m x 2m)",
    "price" => "1.000.000 ₫",
    "details" => '
      <p><strong>Dịch vụ bữa ăn:</strong></p>
      <ul>
        <li>Ăn sáng miễn phí</li>
        <li>Bữa trưa và tối gọi món</li>
      </ul>
      <p><strong>Tiện ích khác:</strong></p>
      <ul>
        <li>Ban công</li>
        <li>TV 43 inch</li>
        <li>Máy sấy tóc</li>
        <li>Điều hòa nhiệt độ</li>
        <li>Bàn làm việc</li>
      </ul>'
  ],

  "Guest House" => [
    "desc" => "Guest House – Giá tiết kiệm, phù hợp nhóm nhỏ.",
    "image" => "../images/r3.jpg",
    "bed" => "1 Giường Queen size (1.6m x 2m)",
    "price" => "770.000 ₫",
    "details" => '
      <p><strong>Dịch vụ bữa ăn:</strong></p>
      <ul>
        <li>Ăn sáng miễn phí</li>
        <li>Đặt bữa trưa/tối theo yêu cầu</li>
      </ul>
      <p><strong>Tiện ích khác:</strong></p>
      <ul>
        <li>Phòng tắm riêng</li>
        <li>TV 32 inch</li>
        <li>Quạt và điều hòa</li>
        <li>Máy nước nóng</li>
        <li>Wifi miễn phí</li>
      </ul>'
  ],

  "Single Room" => [
    "desc" => "Single Room – Gọn gàng, phù hợp khách công tác.",
    "image" => "../images/r4.jpg",
    "bed" => "1 Giường đơn (1.2m x 2m)",
    "price" => "500.000 ₫",
    "details" => '
      <p><strong>Dịch vụ bữa ăn:</strong></p>
      <ul>
        <li>Ăn sáng miễn phí</li>
      </ul>
      <p><strong>Tiện ích khác:</strong></p>
      <ul>
        <li>TV 32 inch</li>
        <li>Bàn làm việc</li>
        <li>Điều hòa</li>
        <li>Wifi miễn phí</li>
      </ul>'
  ] 
];
$selectedRoom = $_GET['room'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $cccd = $_POST['cccd'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $room_type = $_POST['troom'];
  $checkin = $_POST['cin'];
  $checkout = $_POST['cout'];
  $code1 = $_POST['code1'];
  $code = $_POST['code'];

  $error = '';

  if ($code1 !== $code) {
    $error = "Mã xác nhận không đúng";
  } elseif (strlen($cccd) < 9 || strlen($cccd) > 12) {
    $error = "CCCD không hợp lệ";
  } elseif (!preg_match('/^\\d{10,11}$/', $phone)) {
    $error = "Số điện thoại không hợp lệ";
  } elseif (empty($checkin) || empty($checkout)) {
    $error = "Vui lòng chọn ngày Check-In và Check-Out";
  } elseif ($checkin >= $checkout) {
    $error = "Ngày Check-Out phải sau ngày Check-In";
  }

  if (empty($error)) {
    try {
      $nodays = (new DateTime($checkout))->diff(new DateTime($checkin))->days;
      $stmt = $con->prepare("INSERT INTO roombook (name, cccd, email, phone, room_type, checkin, checkout, nodays) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$name, $cccd, $email, $phone, $room_type, $checkin, $checkout, $nodays]);
      echo "<script>alert('Đặt phòng thành công!'); window.location.href='home.php';</script>";
      exit;
    } catch (PDOException $e) {
      $error = "Lỗi khi thêm vào cơ sở dữ liệu";
    }
  }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVATION LOTUS HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style>
    .room-options-wrapper {
      border: 1px solid #ddd;
      padding: 15px;
      margin-top: 30px;
      border-radius: 8px;
      background-color: #f9f9f9;
      clear: both;
    }
    .room-card {
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 6px;
      background: #fff;
      height: 100%;
      cursor: pointer;
      transition: 0.3s;
      margin-bottom: 20px;
    }
    .room-card:hover {
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .room-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 4px;
    }
    .room-card h6 {
      margin-top: 10px;
      font-weight: bold;
    }
    .room-card p.price {
      color: #d9534f;
      font-weight: bold;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
    }
    .modal-content {
      background: #fff;
      margin: 5% auto;
      padding: 20px;
      width: 600px;
      position: relative;
      border-radius: 8px;
    }
    .modal-content img {
      width: 100%;
      border-radius: 6px;
    }
    .modal .close {
      position: absolute;
      top: 10px; right: 15px;
      font-size: 24px;
      color: #888;
      cursor: pointer;
    }
  </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="home.php"><i class="fa fa-home"></i>Trang chủ</a>
                    </li>
                    
					</ul>
            </div>
        </nav>      
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            ĐẶT PHÒNG 
                        </h1>
                    </div>
                </div>                                 
            <div class="row">                
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Thông tin cá nhân
                        </div>
                        <div class="panel-body">
						<form name="form" method="post">
							  <div class="form-group">
                    <label>Họ và tên</label>
                    <input name="name" class="form-control" required>                                           
                </div>
							  <div class="form-group">
                  <label>CCCD</label>
                  <input name="cccd" class="form-control" required>                                           
                </div>
							  <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="email" class="form-control" required>                                           
                </div>
								<div class="form-group">
                  <label>Số điện thoại</label>
                  <input name="phone" type ="text" class="form-control" required>               
                </div>
                <div class="form-group">
                  <p name="error" style="color:red; text-align:center;"></p>
                </div>
              </div>
            </div>
          </div> 
          <script>
              const input = document.querySelector(".form-control");

              input.addEventListener("focus", function () {
                document.getElementsByName("error")[0].textContent = "";
              });

          </script>                
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Thông tin đặt phòng
                        </div>
                        <div class="panel-body">
								<?php if ($selectedRoom && isset($roomTypes[$selectedRoom])): ?>
                                    <p style="font-weight:bold; color:black;">
                                        Bạn đang đặt phòng: <?php echo htmlspecialchars($selectedRoom); ?>
                                    </p>
                                    <p><?php echo $roomTypes[$selectedRoom]['desc']; ?></p>
                                    <p><strong>Giường:</strong> <?php echo $roomTypes[$selectedRoom]['bed']; ?></p>
                                    <p><strong>Giá:</strong> <?php echo $roomTypes[$selectedRoom]['price']; ?></p>
                                    <img src="<?php echo $roomTypes[$selectedRoom]['image']; ?>" alt="<?php echo htmlspecialchars($selectedRoom); ?>" style="max-width:300px; border-radius:10px;">
                                    <div style="margin-top:10px;">
                                        <?php echo $roomTypes[$selectedRoom]['details']; ?>
                                    </div>
                                    <input type="hidden" name="troom" value="<?php echo htmlspecialchars($selectedRoom); ?>">
                                <?php else: ?>
                                    <p style="color:red;">Không xác định loại phòng. <a href="../index.php">Quay lại chọn phòng</a>.</p>
                                <?php endif; ?>
							  <div class="form-group">
                                            <label>Check-In</label>
                                            <input name="cin" type ="date" class="form-control">           
                               </div>
							   <div class="form-group">
                                            <label>Check-Out</label>
                                            <input name="cout" type ="date" class="form-control">                                            
                               </div>
                       </div>                        
                    </div>
                </div>
                <!-- Gợi ý các loại phòng khác -->
                <?php if ($selectedRoom): ?>
                <div class="room-options-wrapper">
                <h5>Bạn muốn chọn loại phòng khác?</h5>
                <div class="row">
                    <?php foreach ($roomTypes as $type => $info): ?>
                    <?php if ($type !== $selectedRoom): ?>
                    <div class="col-md-4">
                        <div class="room-card" onclick="openRoomModal('<?php echo $type; ?>', '<?php echo $info['image']; ?>', '<?php echo $info['desc']; ?>', '<?php echo $info['price']; ?>')">
                        <img src="<?php echo $info['image']; ?>" alt="<?php echo $type; ?>">
                        <h6><?php echo $type; ?></h6>
                        <p><?php echo $info['desc']; ?></p>
                        <p class="price">Giá: <?php echo $info['price']; ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                </div>
                <?php endif; ?>
                <div id="roomModal" class="modal">
                    <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h4 id="modalRoomName"></h4>
                    <img id="modalRoomImg" src="" alt="">
                    <p id="modalRoomDesc"></p>
                    <p><strong>Giá:</strong> <span id="modalRoomPrice"></span></p>
                    <a id="modalBookingBtn" href="#" class="btn btn-success">Đặt phòng này</a>
                    </div>
                </div>

                <script>
                    function openRoomModal(name, image, desc, price) {
                    document.getElementById('modalRoomName').textContent = name;
                    document.getElementById('modalRoomImg').src = image;
                    document.getElementById('modalRoomDesc').textContent = desc;
                    document.getElementById('modalRoomPrice').textContent = price;
                    document.getElementById('modalBookingBtn').href = 'reservation.php?room=' + encodeURIComponent(name);
                    document.getElementById('roomModal').style.display = 'block';
                    }
                    function closeModal() {
                    document.getElementById('roomModal').style.display = 'none';
                    }
                    window.onclick = function(event) {
                    if (event.target === document.getElementById('roomModal')) {
                        closeModal();
                    }
                    }
                </script>

                <!-- Xác minh mã đơn giản -->
                <div class="col-md-12 col-sm-12">
                    <div class="well">
                        <h4>Xác thực không phải người máy</h4>
                        <p>Mã ngẫu nhiên: <?php $Random_code=rand(); echo$Random_code; ?> </p><br />
						<p>Nhập mã ngẫu nhiên<br /></p>
							<input  type="text" name="code1" title="random code" />
							<input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
						<input type="submit" name="submit" value="Gửi" class="btn btn-primary">
            <?php
            if (isset($_POST['submit'])) {
              // Kiểm tra mã xác nhận nếu có
              if ($_POST['code1'] != $_POST['code']) {
                echo "<script>alert('Mã xác nhận không đúng');</script>";
              } else {
                // Lấy thông tin từ form
                $name = $_POST['name'];
                $cccd = $_POST['cccd'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $room_type = $_POST['troom'];
                $checkin = $_POST['cin'];
                $checkout = $_POST['cout'];
                $err = "";
                // Kiểm tra cccd và sdt
                if (strlen($cccd) < 9 || strlen($cccd) > 12) {
                  $err = "CCCD không hợp lệ";
                  echo "<script>document.getElementsByName('error')[0].textContent = '$err';</script>";
                } elseif (!preg_match('/^\d{10,11}$/', $phone)) {
                  $err = "Số điện thoại không hợp lệ";
                  echo "<script>document.getElementsByName('error')[0].textContent = '$err';</script>";
                } elseif (empty($checkin) || empty($checkout)) {
                  $err = "Vui lòng chọn ngày Check-In và Check-Out";
                  echo "<script>document.getElementsByName('error')[0].textContent = '$err';</script>";
                } elseif ($checkin >= $checkout) {
                  $err = "Ngày Check-Out phải sau ngày Check-In";
                  echo "<script>document.getElementsByName('error')[0].textContent = '$err';</script>";
                } else {
                  $err = "";
                  echo "<script>document.getElementsByName('error')[0].textContent = '$err';</script>";
                  // Tính số ngày ở
                  $date1 = new DateTime($checkin);
                  $date2 = new DateTime($checkout);
                  $nodays = $date2->diff($date1)->days;

                  // Sử dụng PDO để thêm vào cơ sở dữ liệu
                  try {
                    $stmt = $con->prepare("INSERT INTO roombook (name, cccd, email, phone, room_type, checkin, checkout, nodays) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $cccd, $email, $phone, $room_type, $checkin, $checkout, $nodays]);
                    echo "<script>alert('Đặt phòng thành công!');</script>";
                  } catch (PDOException $e) {
                    echo "<script>alert('Lỗi khi thêm vào cơ sở dữ liệu');</script>";
                  }
                }
              }
            }
            ?>
						</form>						
                    </div>
                </div>
            </div> 
                </div>
					</div>
			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
     <!-- Checkin/Checkout -->
    <script>
      const cin = document.getElementById('cin');
      const cout = document.getElementById('cout');

      function validateDates() {
          if (cin.value && cout.value && cout.value <= cin.value) {
              alert("Ngày Check-Out phải sau ngày Check-In.");
              cout.value = ""; // Reset ngày Check-Out
          }
      }
      cin.addEventListener('change', validateDates);
      cout.addEventListener('change', validateDates);
  </script>
</body>
</html>