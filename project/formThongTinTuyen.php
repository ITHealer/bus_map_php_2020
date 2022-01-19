<?php
	require 'site.php';
	load_topfunction();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Thông tin tuyến</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/style.css">
	<link rel="stylesheet" href="style/css/stylethongtintuyen.css">
</head>
<body>
	<div class="grid wide">
		<div class="row thongtintuyen">
			<div class="col l-12 thongtintuyen-content">
				<div class="tieude-thongtintuyen">
					<h3>
						<span class="text-title-1">Thông tin tuyến</span>
					</h3>
				</div>
				<div class="row thongtintuyen">
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name ="thongtintuyen" method="POST">
						<div id="route-infomation" >
							<div class="infomation-route">
							<?php
							if(isset($_SESSION['dn']))
							{
								$sodong = 1;
								if(isset($_GET['trang'])) //lấy page trên URL
								{
									$trangchon =  $_GET['trang'];
								}else
								{
									$trangchon = 0;
								}
								
								$kn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
								mysqli_set_charset($kn, 'UTF8');
								$caulenh="select matuyen from danhsachtuyen";
								$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
								$sodongdl = mysqli_num_rows($ketqua);
								$sotrangdl = $sodongdl/$sodong;
								$vtbd = $trangchon*$sodong; 
								$ltvtrang = "select * from danhsachtuyen limit $vtbd,$sodong";
								$kqpt = mysqli_query($kn, $ltvtrang);
								$stt = 1;
								echo"<table class='table_dstuyen' border='0' align=''>";
								// echo "<caption>DANH SÁCH CÁC TUYẾN XE BUÝT BÌNH ĐỊNH</caption>";
								echo "<tr class='title-inforoute'><td>Mã tuyến</td><td>Tên tuyến</td><td>Giờ khởi hành</td><td>Giờ kết thúc</td><td>Mã trạm bắt đầu</td><td>Mã trạm kết thúc</td><td>Tần suất</td><td>Lộ trình</td><td>Số lượng xe</td><td>Trạng thái</td></tr>";
								while($row = mysqli_fetch_array($kqpt))
								{
									if($row["trangthai"] == 1)
									{
										$status = "ON";
										echo "<tr class='table-inforoute'><td>".$row['matuyen']."</td><td>".$row['tentuyen']."</td><td>".$row['giokhoihanh']."</td><td>".$row['gioketthuc']."</td><td>".$row['matrambatdau']."</td><td>".$row['matramketthuc']."</td><td>".$row['tansuat']."</td><td>".$row['lotrinh']."</td><td>".$row['soluongxe']."</td><td>".$status."</td></tr>";		
										$stt++;
									}
									else{
										$status = "OFF";
										echo "<tr class='table-inforoute'><td>".$row['matuyen']."</td><td>".$row['tentuyen']."</td><td>".$row['giokhoihanh']."</td><td>".$row['gioketthuc']."</td><td>".$row['matrambatdau']."</td><td>".$row['matramketthuc']."</td><td>".$row['tansuat']."</td><td>".$row['lotrinh']."</td><td>".$row['soluongxe']."</td><td>".$status."</td></tr>";		
										$stt++;
									}
									
								}
								echo "</table>";
								
								
								echo "<p align='center'>";
								for($page = 0; $page <= $sotrangdl; $page++)
								{
									if($page%7 == 0) 
										echo "<br><br>";
									$trht = $page+1;
									echo "<a style='margin-right: 10px;' class='page' href='formThongTinTuyen.php?trang=$page'>Trang $trht </a>";
								}
								echo "</p>";
								// giải phóng bộ nhớ của biến đã lưu kết quả truy vấn trước đó
								mysqli_free_result($ketqua);
								mysqli_close($kn);
							}
							?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<?php
	load_footer();
?>