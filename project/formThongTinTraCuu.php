<?php
	require 'site.php';
	load_topTraCuuTimDuong();
?>
<?php
	$kn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
	mysqli_set_charset($kn, 'UTF8');
	mysqli_query($kn, "set name 'utf8'");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Thông tin tra cứu</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/style.css">
	<link rel="stylesheet" href="style/css/stylethongtintracuu.css">
	<?php
		// $_REQUEST['$parameter_name']
		$matuyen = $_REQUEST['matuyen'];
	?>
</head>
<body>
<div class="tab-map">
	<!-- Start tab -->
    <div class="tab">
        <div class="tab-heading">
            <div class="back">
			<a style="text-decoration: none" href="formTraCuuTimDuong.php">
				<i class="back__icon ti-arrow-left"></i>
			</a>
            </div>
            <div class="route">
                <span class="route__text">Tuyến <?php echo $matuyen ?></span>
            </div>
        </div>
        <div class="tabs">
            <div class="tabs-item tab-item active">
                Xem lượt đi
            </div>
            <div class="tabs-item tab-item">
                Xem lượt về
            </div>
            <!-- line là cái gạch chạy phía dưới title -->
            <div class="line"></div>
        </div>
        <!-- Start content 2 tab xem lượt đi và xem lượt về -->
        <div class="tab-content">
			<!-- Start tab content xem lượt đi -->
            <div class="tab-pane active">
                <div class="tabsub-map">
                    <div class="tabsub">
                        <div class="tabsub-heading">
                            <div class="tabsub-item">
                                Biểu đồ giờ
                            </div>
                            <div class="tabsub-item active">
                                Trạm dừng
                            </div>
                            <div class="tabsub-item">
                                Thông tin
                            </div>
                            <div class="tabsub-item">
                                Đánh giá
                            </div>
                        </div>
                        <!-- Start content tabssub-->
                        <div class="tabsub-content">
							<!-- Start tab content: Biểu đồ giờ -->
                            <div class="tabsub-pane">
							<?php
								$caulenhbieudogio = "SELECT `b`.`bienso` , `a`.`maxe`, `a`.`giokhoihanh` FROM `lotrinh` AS `a` INNER JOIN `xe` AS `b` ON `a`.`maxe` = `b`.`maxe` WHERE `a`.`matuyen` = '".$matuyen."'";
								$ketquabieudogio = mysqli_query($kn,$caulenhbieudogio)or die ("không thực hiện được câu lệnh");
								// hiển thị dữ liệu trên trang
								while($row = mysqli_fetch_array($ketquabieudogio)) { ?>
									<div class="barchart__hour" ><?php echo $row["giokhoihanh"] ?></div>
									<!-- Start: Biển số
									<div class="modalcar-text">< ?php echo $row["bienso"]." "?></div>
									<div class="modalcar"> 
										<div class="modalcar-close">
											<div class="icon-modalcar">
												<img class="icon-car" src="style/img/icon-car.svg" alt="icon">
												
												<div class="modalcar-text">< ?php echo $row["bienso"]." "?></div>
										
											</div> 
										</div>    
									</div>
									<!-- End: Biển số -->
									<?php  
								} 
								?>
                            </div>	
						</div>
						<!-- End tab content: Biểu đồ giờ -->
						
						<!-- Start tab content: Trạm dừng -->
						<div class="tabsub-pane active">
						<?php
							$caulenhtramdung = "SELECT b.tentram FROM danhsachtramke AS a, danhsachtram AS b WHERE a.matuyen = '".$matuyen."' AND a.matram = b.matram";
							$ketquatramdung=mysqli_query($kn,$caulenhtramdung)or die ("không thực hiện được câu lệnh");
							// hiển thị dữ liệu trên trang
							while($row = mysqli_fetch_array($ketquatramdung)) { ?> 
							<div class="station_info">
								<i class="dot ti-control-record"> </i><?php echo $row["tentram"]."<br>"?>
							</div>
							<?php  
							} 
							?>
						</div>
						<!-- End tab content: Trạm dừng -->
						<!-- Start tab content: Thông tin -->
						<div class="tabsub-pane">
						<?php 
							$caulenhthongtintuyen="SELECT a.matuyen, tentuyen, giokhoihanh, gioketthuc, tansuat, lotrinh, soluongxe , SUM(giave) AS GiaVe, SUM(khoangcach) AS DoDai FROM danhsachtuyen AS a, danhsachtramke AS b ,vengay WHERE a.matuyen='".$matuyen."' AND b.matuyen='".$matuyen."' AND b.mavengay=vengay.mavengay";
							$ketquathongtintuyen=mysqli_query($kn,$caulenhthongtintuyen)or die ("không thực hiện được câu lệnh");
							// hiển thị dữ liệu trên trang
							while($row = mysqli_fetch_array($ketquathongtintuyen)) { ?> 
							<div class="inforoute">
								<i class="dot ti-control-record"> </i><b>Tuyến: </b><?php echo $row["matuyen"]."<br>"?>
								<i class="dot ti-control-record"> </i><b>Tên tuyến: </b><?php echo $row["tentuyen"]."<br>"?>
								<i class="dot ti-control-record"> </i><b>Giá vé: </b><?php echo $row["GiaVe"]." đồng<br>"?>
								<i class="dot ti-control-record"> </i><b>Độ dài tuyến: </b><?php echo $row["DoDai"]." km<br>"?>
								<i class="dot ti-control-record"> </i><b>Thời gian chạy: </b><?php echo  " ".$row["giokhoihanh"]."h - ".$row["gioketthuc"]."h<br>"; ?>
								<i class="dot ti-control-record"> </i><b>Giãn cách tuyến: </b><?php echo $row["tansuat"]." phút/chuyến<br>"?>
								<i class="dot ti-control-record"> </i><b>Số lượng xe: </b><?php echo $row["soluongxe"]." xe/tuyến<br>"?>
								<i class="dot ti-control-record"> </i><b>Lộ trình: </b><?php echo $row["lotrinh"]."<br>"?>
							</div>
							<?php  
							} 
							?>
						</div>
						<!-- End tab content: Thông tin -->
						<!-- Start tab content: Đánh giá -->
						<div class="tabsub-pane">
							<div class="rating__info">
								<div class="info__title">
									Tổng hợp đánh giá
								</div>
								<div class="info__content">
									<div class="rating__avarage">
										3.02
									</br>
										<div class="star__haft ti-star"></div>
										<div class="star__haft ti-star"></div>
										<div class="star__haft ti-star"></div>
										<div class="star__haft-black ti-star"></div>
										<div class="star__haft-black ti-star"></div>
									</br>
										<div class="rating__user">
											<i class="ti-user"></i>
											<span>105</span>
										</div>
									</div>
									<div class="barchart">
										<img src="style/img/Bar_Chart.jpg" width="200px" alt="Biểu đồ rating">
									</div>
								</div>
								<div class="rating__review">
									<div class="review_title">Các bài đánh giá</div>
									<div class="container__user">
										<div class="review__container">
											<img src="style/img/UMH2.jpg" alt="Avartar" class="review__avatar">
											<div class="review__info">
												<div class="review__name">Healer</div>
												<div class="review__time">Cách đây 1 giờ</div>
											</div>
											<div class="review__star">
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft-black ti-star"></div>
											</div>
										</div>
										<p class="review__text">
											App rất hữu ích!
										</p>
									</div>
									<div class="container__user">
										<div class="review__container">
											<img src="style/img/TBT.jpg" alt="Avartar" class="review__avatar">
											<div class="review__info">
												<div class="review__name">Tường</div>
												<div class="review__time">Cách đây 2 giờ</div>
											</div>
											<div class="review__star">
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
											</div>
										</div>
										<p class="review__text">
											Tuyệt vời. Xe chạy rất êm và an toàn!
										</p>
									</div>
									<div class="container__user">
										<div class="review__container">
											<img src="style/img/NTTL.jpg" alt="Avartar" class="review__avatar">
											<div class="review__info">
												<div class="review__name">Liễu</div>
												<div class="review__time">Cách đây 3 giờ</div>
											</div>
											<div class="review__star">
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft ti-star"></div>
												<div class="star__haft-black ti-star"></div>
											</div>
										</div>
										<p class="review__text">
											Xe đi mát vãi!
										</p>
									</div>
								</div>
							</div>
						</div>
						<!-- End tab content: Đánh giá -->
					</div>
					<!-- End content tabssub-->
				</div>
			</div>
		</div>
		<!-- End tab content xem lượt đi -->
			
		<!-- Start tab content xem lượt về -->
		<div class="tab-pane">
			<div style="margin-top: -28px; margin-left: 12px;" class="tabsub-map">
				<div class="tabsub">
					<div class="tabsub-heading">
						<div class="tabsub-item">
							Biểu đồ giờ
						</div>
						<div class="tabsub-item active">
							Trạm dừng
						</div>
						<div class="tabsub-item">
							Thông tin
						</div>
						<div class="tabsub-item">
							Đánh giá
						</div>
					</div>
					<!-- Start content tabssub-->
					<div class="tabsub-content">
						<!-- Start tab content: Biểu đồ giờ -->
						<div class="tabsub-pane">
						<?php
							$caulenhbieudogio = "SELECT giokhoihanh FROM lotrinh AS a WHERE a.matuyen = '".$matuyen."'";
							$ketquabieudogio = mysqli_query($kn,$caulenhbieudogio)or die ("không thực hiện được câu lệnh");
							// hiển thị dữ liệu trên trang
							while($row = mysqli_fetch_array($ketquabieudogio)) { ?> 
								<div class="barchart__hour"><?php echo $row["giokhoihanh"]." "?></div>
							<?php  
							} 
							?>
						</div>	
					</div>
					<!-- End tab content: Biểu đồ giờ -->
					<!-- Start tab content: Trạm dừng -->
					<div class="tabsub-pane active">
					<?php
						$caulenhtramdung = "SELECT b.tentram FROM danhsachtramke AS a, danhsachtram AS b WHERE a.matuyen = '".$matuyen."' AND a.matram = b.matram";
						$ketquatramdung=mysqli_query($kn,$caulenhtramdung)or die ("không thực hiện được câu lệnh");
						// hiển thị dữ liệu trên trang
						while($row = mysqli_fetch_array($ketquatramdung)) { ?> 
						<div class="station_info">
							<i class="dot ti-control-record"> </i><?php echo $row["tentram"]."<br>"?>
						</div>
						<?php  
						} 
						?>
					</div>
					<!-- End tab content: Trạm dừng -->
					<!-- Start tab content: Thông tin -->
					<div class="tabsub-pane">
					<?php 
						$caulenhthongtintuyen="SELECT a.matuyen, tentuyen, giokhoihanh, gioketthuc, tansuat, lotrinh, soluongxe , SUM(giave) AS GiaVe, SUM(khoangcach) AS DoDai FROM danhsachtuyen AS a, danhsachtramke AS b ,vengay WHERE a.matuyen='".$matuyen."' AND b.matuyen='".$matuyen."' AND b.mavengay=vengay.mavengay";
						$ketquathongtintuyen=mysqli_query($kn,$caulenhthongtintuyen)or die ("không thực hiện được câu lệnh");
						// hiển thị dữ liệu trên trang
						while($row = mysqli_fetch_array($ketquathongtintuyen)) { ?> 
						<div class="inforoute">
							<i class="dot ti-control-record"> </i><b>Tuyến: </b><?php echo $row["matuyen"]."<br>"?>
							<i class="dot ti-control-record"> </i><b>Tên tuyến: </b><?php echo $row["tentuyen"]."<br>"?>
							<i class="dot ti-control-record"> </i><b>Giá vé: </b><?php echo $row["GiaVe"]." đồng<br>"?>
							<i class="dot ti-control-record"> </i><b>Độ dài tuyến: </b><?php echo $row["DoDai"]." km<br>"?>
							<i class="dot ti-control-record"> </i><b>Thời gian chạy: </b><?php echo  " ".$row["giokhoihanh"]."h - ".$row["gioketthuc"]."h<br>"; ?>
							<i class="dot ti-control-record"> </i><b>Giãn cách tuyến: </b><?php echo $row["tansuat"]." phút/chuyến<br>"?>
							<i class="dot ti-control-record"> </i><b>Số lượng xe: </b><?php echo $row["soluongxe"]." xe/tuyến<br>"?>
							<i class="dot ti-control-record"> </i><b>Lộ trình: </b><?php echo $row["lotrinh"]."<br>"?>
						</div>
						<?php  
						} 
						?>
					</div>
					<!-- End tab content: Thông tin -->
					<!-- Start tab content: Đánh giá -->
					<div class="tabsub-pane">
						<div class="rating__info">
							<div class="info__title">
								Tổng hợp đánh giá
							</div>
							<div class="info__content">
								<div class="rating__avarage">
									3.02
								</br>
									<div class="star__haft ti-star"></div>
									<div class="star__haft ti-star"></div>
									<div class="star__haft ti-star"></div>
									<div class="star__haft-black ti-star"></div>
									<div class="star__haft-black ti-star"></div>
								</br>
									<div class="rating__user">
										<i class="ti-user"></i>
										<span>105</span>
									</div>
								</div>
								<div class="barchart">
									<img src="style/img/Bar_Chart.jpg" width="200px" alt="Biểu đồ rating">
								</div>
							</div>
							<div class="rating__review">
								<div class="review_title">Các bài đánh giá</div>
								<div class="container__user">
									<div class="review__container">
										<img src="style/img/UMH2.jpg" alt="Avartar" class="review__avatar">
										<div class="review__info">
											<div class="review__name">Healer</div>
											<div class="review__time">Cách đây 1 giờ</div>
										</div>
										<div class="review__star">
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft-black ti-star"></div>
										</div>
									</div>
									<p class="review__text">
										App rất hữu ích!
									</p>
								</div>
								<div class="container__user">
									<div class="review__container">
										<img src="style/img/TBT.jpg" alt="Avartar" class="review__avatar">
										<div class="review__info">
											<div class="review__name">Tường</div>
											<div class="review__time">Cách đây 2 giờ</div>
										</div>
										<div class="review__star">
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
										</div>
									</div>
									<p class="review__text">
										Tuyệt vời. Xe chạy rất êm và an toàn!
									</p>
								</div>
								<div class="container__user">
									<div class="review__container">
										<img src="style/img/NTTL.jpg" alt="Avartar" class="review__avatar">
										<div class="review__info">
											<div class="review__name">Liễu</div>
											<div class="review__time">Cách đây 3 giờ</div>
										</div>
										<div class="review__star">
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft ti-star"></div>
											<div class="star__haft-black ti-star"></div>
										</div>
									</div>
									<p class="review__text">
										Xe đi mát vãi!
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End tab content: Đánh giá -->
				</div>
				<!-- End content tabssub-->
			</div>
		</div>
		<!-- End tab content xem lượt về -->
	</div>
		<!-- End content 2 tab xem lượt đi và xem lượt về -->
	<!-- End tab -->
    <div class="google-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d52085.82053445098!2d108.83165752902532!3d14.000112291067511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1637656705057!5m2!1svi!2s" width="1000" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
</div>

<script>
    // Để biến $ thay thế phải gõ lại chuỗi document.querySelector.bind(document);
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    // Lấy ra những tg có class=
    const tabs = $$(".tab-item");
    const panes = $$(".tab-pane");

    const tabsSub = $$(".tabsub-item");
    const panesSub = $$(".tabsub-pane");

    // Lấy kích thước của từng tab tiêu đề khi ta click. TH viết ở đây để chạy mặc đinh tab đầu
    const tabActive = $(".tab-item.active");
    const line = $(".tabs .line");

    line.style.left = tabActive.offsetLeft + "px";
    // offsetWidth kích thước chiều ngang của line. Set nó vào thuộc tính left vs width của line
    line.style.width = tabActive.offsetWidth + "px";

    tabs.forEach((tab, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const pane = panes[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tab.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tab-item.active").classList.remove("active");
        $(".tab-pane.active").classList.remove("active");

        line.style.left = this.offsetLeft + "px";
        line.style.width = this.offsetWidth + "px";

        this.classList.add("active");
        pane.classList.add("active");
        };
    });

    tabsSub.forEach((tab, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const paneSub = panesSub[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tab.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tabsub-item.active").classList.remove("active");
        $(".tabsub-pane.active").classList.remove("active");

        this.classList.add("active");
        paneSub.classList.add("active");
        };
    });

</script>

<script>
    const buyBtnsCar = document.querySelectorAll('.barchart__hour')  
    const modalCar = document.querySelector('.modalcar')
    const modalCloseCar = document.querySelector('.modalcar-close')
	
	
	// function onclickMaxe (maxe) {
		// const buyBtnsCar = document.getElementById(maxe)  
		// const modalCar = document.querySelector('.modalcar')
		// const modalCloseCar = document.querySelector('.modalcar-close')
		// buyBtnCar.addEventListener('click', showCar)
		// modalCloseCar.addEventListener('click', hideCar)
	// }
	
    function showCar(){
        modalCar.classList.add('open');
    }

    function hideCar(){
        modalCar.classList.remove('open');
    }
	
    for(const buyBtnCar of buyBtnsCar){
        buyBtnCar.addEventListener('click', showCar)
    }

    modalCloseCar.addEventListener('click', hideCar)
    
</script>

</body>
</html>