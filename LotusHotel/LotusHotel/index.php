<?php
include('db.php');
include('includes/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>LOTUS HOTEL</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->
</head>
<body>
<!-- header -->
<div class="banner-top">
	<div class="w3_navigation">
		<div class="container" style="padding: 0;">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1 class="brand"><a class="navbar-brand" href="index.php">LOTUS<span></span><p class="logo_w3l_agile_caption">At Your Service</p></a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item"><a href="" class="menu__link">Trang chủ</a></li>
							<li class="menu__item"><a href="#team" class="menu__link scroll">Team</a></li>
							<li class="menu__item"><a href="#gallery" class="menu__link scroll">Hình ảnh</a></li>
							<li class="menu__item"><a href="#rooms" class="menu__link scroll">Danh sách phòng</a></li>
							<li class="menu__item"><a href="#about" class="menu__link scroll">Giới thiệu</a></li>
							<li class="menu__item"><a href="#contact" class="menu__link scroll">Liên hệ</a></li>
							<li class="menu__item">	<a href="./login.php" class="menu__link">Đăng nhập</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<!-- //header -->
		<!-- banner -->
	<div id="home" class="w3ls-banner">
		<!-- banner-text -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="w3layouts-banner-top">

							<div class="container">
								<div class="agileits-banner-info">
								<h4>LOTUS</h4>
									<h3>Trải nghiệm kỳ nghỉ đẳng cấp</h3>
									<div class="agileits_w3layouts_more menu__item">
			</div>
								</div>	
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top1">
							<div class="container">
								<div class="agileits-banner-info">
								<h4>LOTUS</h4>
									<h3>Wifi miễn phí, hồ bơi & hơn thế nữa</h3>
									<div class="agileits_w3layouts_more menu__item">
			</div>
								</div>	
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top2">
							<div class="container">
								<div class="agileits-banner-info">
								<h4>LOTUS</h4>
								<h3>Đặt ngay – Giá ưu đãi mỗi ngày</h3>
									<div class="agileits_w3layouts_more menu__item">
										</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<!--banner Slider starts Here-->
		</div>
		    <div class="thim-click-to-bottom">
				<a href="#about" class="scroll">
					<!--<i class="fa fa-long-arrow-down" aria-hidden="true"></i>-->
				</a>
			</div>
	</div>	
	<!-- //banner --> 
<!--//Header-->
<!-- //Modal1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
						<!-- Modal1 -->
							<div class="modal-dialog">
							<!-- Modal content-->
							
							</div>
						</div>
<!-- //Modal1 -->
<div id="availability-agileits">
<div class="col-md-12 book-form-left-w3layouts">
	<a href="#rooms" class="menu__link scroll"><h2>Đặt phòng ngay!</h2></a>
</div>

			<div class="clearfix"> </div>
</div>
<!-- /about -->
 	<div class="about-wthree" id="about">
		  <div class="container">
				   <div class="ab-w3l-spa">
                            <h3 class="title-w3-agileits title-black-wthree">Về chúng tôi</h3> 
						   <p class="about-para-w3ls">Khách sạn Lotus là điểm dừng chân lý tưởng dành cho du khách muốn tận hưởng kỳ nghỉ thoải mái và tiện nghi. Với không gian sang trọng, dịch vụ chuyên nghiệp và vị trí thuận lợi gần trung tâm thành phố, Lotus cam kết mang đến cho bạn những trải nghiệm nghỉ dưỡng tuyệt vời nhất.</p>
						   <img src="images/about.jpg" class="img-responsive" alt="Hotel Bar">
										<div class="w3l-slider-img">
											<img src="images/a1.jpg" width="700" height="380" class="img-responsive" alt="Hotel Buffet">>
										</div>
                                       <div class="w3ls-info-about">
										    <h4>You'll love all the services we offer!</h4>
										</div>
		          </div>
		   	<div class="clearfix"> </div>
    </div>
</div>
 	<!-- //about -->
<!--sevices-->
<div class="advantages">
	<div class="container">
		<div class="advantages-main">
				<h3 class="title-w3-agileits">Dịch vụ</h3>
		   <div class="advantage-bottom">
			 <div class="col-md-6 advantage-grid left-w3ls wow bounceInLeft" data-wow-delay="0.3s">
			 	<div class="advantage-block ">
					<i class="fa fa-credit-card" aria-hidden="true"></i>
			 		<h4>Stay First, Pay After! </h4>
			 		<p>Nghỉ trước, thanh toán sau – linh hoạt và thuận tiện cho mọi khách hàng.</p>
					<p><i class="fa fa-check" aria-hidden="true"></i>Phòng được trang trí đẹp, có máy lạnh đầy đủ</p>
					<p><i class="fa fa-check" aria-hidden="true"></i>Chính sách đặt và hủy phòng linh hoạt</p>
			 		
			 	</div>
			 </div>
			 <div class="col-md-6 advantage-grid right-w3ls wow zoomIn" data-wow-delay="0.3s">
			 	<div class="advantage-block">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
			 		<h4>24 Hour Restaurant</h4>
			 		<p>Phục vụ thực đơn đa dạng suốt ngày đêm, đáp ứng mọi nhu cầu ẩm thực của bạn.</p>
					<p><i class="fa fa-check" aria-hidden="true"></i>Wifi tốc độ cao miễn phí</p>
					<p><i class="fa fa-check" aria-hidden="true"></i>Lễ tân phục vụ 24/7</p>
			 	</div>
			 </div>
			<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!--//sevices-->
<!-- team -->
<div class="team" id="team">
	<div class="container">
			<h3 class="title-w3-agileits title-black-wthree">Meet Our Team</h3>
			<div id="horizontalTab">
					<ul class="resp-tabs-list">
					<li>
						<img src="images/teams1.jpg" width="200" height="200" alt="Ngô Ngọc Hòa" class="img-responsive" />
					</li>
					<li>
						<img src="images/teams2.jpg" width="200" height="200" alt="Diệp Gia Phước " class="img-responsive" />
					</li>					
					</ul>
					<div class="resp-tabs-container">
					<div class="tab1">
						<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Ngô Ngọc Hòa</h4>
							<span>Backend DeV</span>
							<p>
								<ul>
									<li>
										Xử lý logic nghiệp vụ bằng PHP.
									</li>
									<li>
										Thiết kế và quản lý cơ sở dữ liệu MySQL.										
									</li>
									<li>
										Xây dựng các chức năng.										
									</li>
									<li>
										Tích hợp upload ảnh phòng và xử lý dữ liệu đầu vào.									
									</li>
								</ul>							
							</p>													
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="tab2">
					<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Diệp Gia Phước</h4>
							<span>Frontend Dev</span>
							<p>
								<ul>
									<li>
										Thiết kế giao diện bằng HTML, CSS, JavaScript và Bootstrap.	
									</li>
									<li>
										Tạo các trang như: trang chủ, danh sách phòng, chi tiết phòng, trang đặt phòng, đăng nhập/đăng ký.										
									</li>
									<li>
										Đảm bảo website hiển thị tốt trên nhiều thiết bị (responsive design).										
									</li>
									<li>
										Tích hợp giao diện với dữ liệu từ backend.										
									</li>
								</ul>
							</p>								
						</div>
						<div class="clearfix"> </div>
					</div>										
					</div>
			</div>
	</div>
</div>
<!-- //team -->
<!-- Gallery -->
	<div class="photo-gallery" id="gallery">
		<div class="gallery">
			<img src="images/g1.jpg" alt="Ảnh 1">
			<img src="images/g2.jpg" alt="Ảnh 2">
			<img src="images/g3.jpg" alt="Ảnh 3">
			<img src="images/g4.jpg" alt="Ảnh 4">
			<img src="images/g5.jpg" alt="Ảnh 5">
			<img src="images/g6.jpg" alt="Ảnh 6">
			<img src="images/g7.jpg" alt="Ảnh 7">
			<img src="images/g8.jpg" alt="Ảnh 8">
			<img src="images/g9.jpg" alt="Ảnh 9">
			<img src="images/g10.jpg" alt="Ảnh 10">
			<img src="images/g11.jpg" alt="Ảnh 11">
			<img src="images/g12.jpg" alt="Ảnh 12">
		</div>

		<div class="modal" id="myModal">
		<span class="close">&times;</span>
		<span class="prev">&#10094;</span>
		<img class="modal-content" id="modalImg">
		<span class="next">&#10095;</span>
		</div>
    </div>
<!-- //Gallery -->

<!-- rooms & rates -->
    <div class="plans-section" id="rooms">
		<div class="container">
			<h3 class="text-center mb-5">Danh sách phòng</h3>
			<div class="row">

			<!-- Luxury Room -->
			<div class="col-md-3 price-grid" onclick="openRoom('Luxury Room', 'images/r1.jpg', '<p><strong>Giường:</strong> 1 Giường Super king size (2m x 2.2m)</p><p><strong>Dịch vụ bữa ăn:</strong></p><ul><li>Ăn sáng miễn phí (buffet)</li><li>Bữa trưa và tối gọi món tại phòng hoặc ăn tại nhà hàng</li><li>Đồ uống miễn phí trong minibar</li></ul><p><strong>Tiện ích khác:</strong></p><ul><li>Ban công riêng</li><li>Bồn tắm nằm</li><li>TV 55+</li><li>Máy pha cà phê, áo choàng tắm</li><li>Điều hòa nhiệt độ</li><li>Dịch vụ phòng 24/7</li></ul>', '1.500.000 Đ')">
				<div class="price-block agile">
					<div class="price-gd-top">
						<img src="images/r1.jpg" alt="Luxury Room" class="img-room" />
						<h4 class="text-center">Luxury Room</h4>
					</div>
					<div class="price-gd-bottom text-center">
						<h3>1.500.000 <span>Đ</span></h3>
						<a href="customer/reservation.php?room=Luxury Room">ĐẶT NGAY</a>
					</div>
				</div>
			</div>

			<!-- Deluxe Room -->
			<div class="col-md-3 price-grid" onclick="openRoom('Deluxe Room', 'images/r2.jpg', '<p><strong>Giường:</strong> 1 Giường King size (1.8m x 2m)</p><p><strong>Dịch vụ bữa ăn:</strong></p><ul><li>Ăn sáng miễn phí (buffet)</li><li>Gọi món trưa và tối tại phòng (phụ phí)</li></ul><p><strong>Tiện ích khác:</strong></p><ul><li>Cửa sổ lớn, view thành phố</li><li>TV 50 inch</li><li>Máy sấy tóc</li><li>Điều hòa</li><li>Bàn làm việc</li></ul>', '1.000.000 Đ')">
				<div class="price-block agile">
				<div class="price-gd-top">
					<img src="images/r2.jpg" alt="Deluxe Room" class="img-room" />
					<h4 class="text-center">Deluxe Room</h4>
				</div>
				<div class="price-gd-bottom text-center">
					<h3>1.000.000 <span>Đ</span></h3>
					<a href="customer/reservation.php?room=Deluxe Room">ĐẶT NGAY</a>
				</div>
				</div>
			</div>

			<!-- Guest House -->
			<div class="col-md-3 price-grid" onclick="openRoom('Guest House Room', 'images/r3.jpg', '<p><strong>Giường:</strong> 1 Giường Queen size (1.6m x 2m)</p><p><strong>Dịch vụ bữa ăn:</strong></p><ul><li>Ăn sáng miễn phí</li><li>Phục vụ bữa trưa theo yêu cầu tại sảnh</li></ul><p><strong>Tiện ích khác:</strong></p><ul><li>Phòng rộng, thoáng</li><li>TV 43 inch</li><li>Điều hòa 2 chiều</li><li>Máy nước nóng</li><li>Tủ lạnh mini</li></ul>', '770.000 Đ')">
				<div class="price-block agile">
				<div class="price-gd-top">
					<img src="images/r3.jpg" alt="Guest House" class="img-room" />
					<h4 class="text-center">Guest House</h4>
				</div>
				<div class="price-gd-bottom text-center">
					<h3>770.000 <span>Đ</span></h3>
					<a href="customer/reservation.php?room=Guest House">ĐẶT NGAY</a>
				</div>
				</div>
			</div>

			<!-- Single Room -->
			<div class="col-md-3 price-grid" onclick="openRoom('Single Room', 'images/r4.jpg', '<p><strong>Giường:</strong> 1 Giường đơn (1m x 2m)</p><p><strong>Dịch vụ bữa ăn:</strong></p><ul><li>Ăn sáng miễn phí</li></ul><p><strong>Tiện ích khác:</strong></p><ul><li>TV 32 inch</li><li>Quạt trần</li><li>Wifi tốc độ cao</li><li>Bàn làm việc nhỏ</li></ul>', '500.000 Đ')">
				<div class="price-block agile">
				<div class="price-gd-top">
					<img src="images/r4.jpg" alt="Single Room" class="img-room" />
					<h4 class="text-center">Single Room</h4>
				</div>
				<div class="price-gd-bottom text-center">
					<h3>500.000 <span>Đ</span></h3>
					<a href="customer/reservation.php?room=Single Room">ĐẶT NGAY</a>
				</div>
				</div>
			</div>

			</div>
		</div>
	</div>
	<!-- Modal popup -->
	<div id="roomModal" class="modal">
		<div class="modal-content">
			<span class="close" onclick="closeModal()">&times;</span>
			<h3 id="roomName"></h3>
			<img id="roomImg" src="" alt="">
			<p id="roomDesc"></p>
			<p><strong>Giá:</strong> <span id="roomPrice"></span></p>
			<a id="bookingBtn" href="reservation.php" class="btn">ĐẶT NGAY</a>
		</div>
	</div>
<!--// rooms & rates -->
  
<!-- contact -->
<section class="contact-w3ls" id="contact">
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
			<div class="contact-agileits">
				<h4>Liên hệ với chúng tôi</h4>
				<p class="contact-agile2">Đăng ký để liên hệ với chúng tôi</p>
				<form  method="post" name="sentMessage" id="contactForm" >
					<div class="control-group form-group">
                        
                            <label class="contact-p1">Họ tên:</label>
                            <input type="text" class="form-control" name="name" id="name" required >
                            <p class="help-block"></p>
                    </div>	
                    <div class="control-group form-group">
                        
                            <label class="contact-p1">Số điện thoại:</label>
                            <input type="tel" class="form-control" name="phone" id="phone" required >
							<p class="help-block"></p>
						
                    </div>
                    <div class="control-group form-group">
                        
                            <label class="contact-p1">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required >
							<p class="help-block"></p>
						
                    </div>
					<div class="control-group form-group">
						<label class="contact-p1">Nhập nội dung:</label>
						<textarea class="my-textarea" name="text" maxlength="500" rows ="5" id="textarea" required></textarea>
						<p class="help-block"></p>
					</div>
                    <input type="submit" name="sub" value="Gửi ngay!" class="btn btn-primary">	
				</form>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
			<h4>Liên hệ với chúng tôi</h4>
			<p class="contact-agile1"><strong>Số điện thoại: </strong>0896468675</p>
			<p class="contact-agile1"><strong>Email: </strong> <a href="mailto:2205CT0067@dhv.edu.vn">2205CT0067@dhv.edu.vn | <a href="mailto:2205CT0001@dhv.edu.vn"></a>2205CT0001@dhv.edu.vn</a></p>
			<p class="contact-agile1"><strong>Địa chỉ: </strong> 736 Nguyễn Trãi, Phường 11, Quận 5, TP.HCM</p>
																
			<div class="social-bnr-agileits footer-icons-agileinfo">
				<ul class="social-icons3">
							<li><a href="https://www.facebook.com/hoa.ngo.402850" target="_blank" class="fa fa-facebook icon-border facebook"></a></li>
							<li><a href="mailto:nnhoait@gmail.com" class="fa fa-envelope icon-border gmail"></a></li>
							</ul>
			</div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.7559319222087!2d106.65780347373047!3d10.75328418939408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ef6ca551517%3A0xc331bdcaa0992e4b!2zNzM2IMSQLiBOZ3V54buFbiBUcsOjaSwgUGjGsOG7nW5nIDExLCBRdeG6rW4gNSwgSOG7kyBDaMOtIE1pbmgsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1749295943845!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- /contact -->
			<div class="copy">
		        <p>© 2025 Lotus Hotel</p>
				<br>
				<p>Work of <a href="https://www.facebook.com/hoa.ngo.402850" target="_blank">Ngô Ngọc Hòa & <a href= "https://www.facebook.com/share/1GEvAd2yLp/" target="_blank"> Diệp Gia Phước</a></p>
		    </div>
<!--/footer -->
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- contact form -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- /contact form -->	
<!-- Calendar -->
		<script src="js/jquery-ui.js"></script>
		<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
				});
		</script>
<!-- //Calendar -->
<!-- gallery popup -->
<link rel="stylesheet" href="css/swipebox.css">
				<script src="js/jquery.swipebox.min.js"></script> 
					<script type="text/javascript">
						jQuery(function($) {
							$(".swipebox").swipebox();
						});
					</script>
<!-- //gallery popup -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
			<!-- //flexSlider -->
<script src="js/responsiveslides.min.js"></script>
			<script>
						//equal "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
		<!--search-bar-->
		<script src="js/main.js"></script>	
<!--//search-bar-->
<!--tabs-->
<script src="js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<!--//tabs-->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	
	<div class="arr-w3ls">
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
<!-- //smooth scrolling -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<!--// rooms & rates -->
<script>
function openRoom(name, image, desc, price) {
  document.getElementById('roomName').textContent = name;
  document.getElementById('roomImg').src = image;
  document.getElementById('roomDesc').innerHTML  = desc;
  document.getElementById('roomPrice').textContent = price;
  document.getElementById('bookingBtn').href = "customer/reservation.php?room=" + encodeURIComponent(name);
  document.getElementById('roomModal').style.display = 'block';
  document.getElementById('troom').value = name;
}
function closeModal() {
  document.getElementById('roomModal').style.display = 'none';
}
</script>
<!-- Gallery -->
<script>
    const gallery = document.querySelector('.photo-gallery');
    const images = gallery.querySelectorAll(".gallery img");
    const modal = gallery.querySelector("#myModal");
    const modalImg = gallery.querySelector("#modalImg");
    const closeBtn = gallery.querySelector(".close");
    const prevBtn = gallery.querySelector(".prev");
    const nextBtn = gallery.querySelector(".next");

    let currentIndex = 0;

    function showImage(index) {
      if (index < 0) index = images.length - 1;
      if (index >= images.length) index = 0;
      currentIndex = index;
      modalImg.src = images[currentIndex].src;
    }

    images.forEach((img, i) => {
      img.addEventListener("click", () => {
        modal.style.display = "flex";
        showImage(i);
      });
    });

    closeBtn.onclick = () => modal.style.display = "none";
    nextBtn.onclick = () => showImage(currentIndex + 1);
    prevBtn.onclick = () => showImage(currentIndex - 1);

    window.addEventListener("keydown", (e) => {
      if (modal.style.display === "flex") {
        if (e.key === "ArrowRight") showImage(currentIndex + 1);
        if (e.key === "ArrowLeft") showImage(currentIndex - 1);
        if (e.key === "Escape") modal.style.display = "none";
      }
    });

    window.onclick = (e) => {
      if (e.target == modal) modal.style.display = "none";
    };

	//Ấn vào bất kỳ input và textarea trong form sẽ yêu cầu đăng nhập
	document.querySelectorAll('input, textarea').forEach(element => {
		element.addEventListener('focus', function() {
			window.location.href = 'login.php';
		});
	});
</script>
</body>
</html>


