<?php  
	session_start();  
	include('../includes/session.php');
	requiredLogin();
	ob_start();
	?> 

<?php
include('db.php');
$rsql ="select id from room";
$stmt = $con->query($rsql);
$rre = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
							 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOTUS HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">ADMIN </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
			
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>Thông tin người dùng </a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i>Cài đặt </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Đăng xuất </a>
                        </li>
                    </ul>
					
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="settings.php"><i class="fa fa-dashboard"></i>Trạng thái phòng </a>
                    </li>
					<li>
                        <a   href="room.php"><i class="fa fa-plus-circle"></i>Thêm phòng </a>
                    </li>
                    <li>
                        <a  class="active-menu" href="roomdel.php"><i class="fa fa-pencil-square-o"></i>Xóa phòng</a>
                    </li>
					

                    
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
       
        
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Xóa phòng 
                        </h1>
                    </div>
                </div> 
                 
                                 
            <div class="row">
                
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Xóa phòng
                        </div>
                        <div class="panel-body">
						<form name="form" method="post">
                            <div class="form-group">
                                            <label>Chọn ID phòng *</label>
                                            <select name="id"  class="form-control" required>
												<option value selected ></option>
												<?php
												foreach ($rre as $rrow) {
													$value = htmlspecialchars($rrow['id']);
													echo "<option value=\"{$value}\">{$value}</option>";
												}
												?>
                                                
                                            </select>
                              </div>
							  
								
							 <input type="submit" name="del" value="Delete Room" class="btn btn-primary"> 
							</form>
							<?php
							 include('db.php');
							 
							 if(isset($_POST['del']))
							 {
								$did = $_POST['id'];
								
								
								$sql ="DELETE FROM `room` WHERE id = '$did'" ;
								$stmt = $con->prepare("DELETE FROM `room` WHERE id = :id");
								if ($stmt->execute([':id' => $did]))
								{
								 echo '<script type="text/javascript">alert("Delete the Room") </script>' ;
										
										header("Location: roomdel.php");
								}else {
									echo '<script>alert("Sorry ! Check The System") </script>' ;
								}
							 }
							
							?>
                        </div>
                        
                    </div>
                </div>
                
                  
		<?php
			include('db.php');
			$sql = "SELECT * FROM room";
			$stmt = $con->query($sql);
			$re = $stmt->fetchAll(PDO::FETCH_ASSOC);
		?>
                <div class="row">
				
				
				<?php
					foreach ($re as $row)
					{
						$id = $row['type'];
						switch ($id) {
							case "Superior Room":
								echo "<div class='col-md-3 col-sm-12 col-xs-12'>
									<div class='panel panel-primary text-center no-boder bg-color-blue'>
										<div class='panel-body'>
											<i class='fa fa-users fa-5x'></i>
											<h3>".$row['bedding']."</h3>
										</div>
										<div class='panel-footer back-footer-blue'>
											".$row['type']."
										</div>
									</div>
								</div>";
								break;
							case "Deluxe Room":
								echo "<div class='col-md-3 col-sm-12 col-xs-12'>
									<div class='panel panel-primary text-center no-boder bg-color-green'>
										<div class='panel-body'>
											<i class='fa fa-users fa-5x'></i>
											<h3>".$row['bedding']."</h3>
										</div>
										<div class='panel-footer back-footer-green'>
											".$row['type']."
										</div>
									</div>
								</div>";
								break;
							case "Guest House":
								echo "<div class='col-md-3 col-sm-12 col-xs-12'>
									<div class='panel panel-primary text-center no-boder bg-color-brown'>
										<div class='panel-body'>
											<i class='fa fa-users fa-5x'></i>
											<h3>".$row['bedding']."</h3>
										</div>
										<div class='panel-footer back-footer-brown'>
											".$row['type']."
										</div>
									</div>
								</div>";
								break;
							case "Single Room":
								echo "<div class='col-md-3 col-sm-12 col-xs-12'>
									<div class='panel panel-primary text-center no-boder bg-color-red'>
										<div class='panel-body'>
											<i class='fa fa-users fa-5x'></i>
											<h3>".$row['bedding']."</h3>
										</div>
										<div class='panel-footer back-footer-red'>
											".$row['type']."
										</div>
									</div>
								</div>";
								break;
						}
					}
				?>
                    
                </div>
            <?php
				
			ob_end_flush();
			?>
                    
            
				
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
    
   
</body>
</html>
