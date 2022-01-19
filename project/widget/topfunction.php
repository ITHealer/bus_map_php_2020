<?php 
	session_start();
	if (!isset($_SESSION['dn'])) {
		header('Location: formLogin.php');
}
?>
<?php
	$kn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
	mysqli_set_charset($kn, 'UTF8');
	//mysqli_query($kn, "set name 'utf8'");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/style.css">

<style>

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}
</style>
</head>

<body>
    <div id="top">
        <!-- Begin top -->
        <div id="logo" class="logo-top">
            <a href="formTrangChu.php">
                <img src="style/img/logo_BusMap.jpg" alt="Logo" class="edit-logo">
            </a>
        </div>
		<!-- Xem thông tin người dùng -->
		<div id="popup1" class="overlay">
			<div class="popup">
				<h2>Thông tin cá nhân</h2>
				<a class="close" href="#">&times;</a>
				<?php
				$tendangnhap = $_SESSION['dn'];
				$caulenh="select * from taikhoan where tendangnhap = '".$tendangnhap."'";
				$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
				if (mysqli_num_rows($ketqua) > 0) {
				// hiển thị dữ liệu trên trang
				while($row = mysqli_fetch_assoc($ketqua)) 
				{ 	echo ""."<br>" ?>
					<tr> 
						<td> Tên đăng nhập :<?php echo $row["tendangnhap"]."<br>"?></td>
						<td> Họ và tên :<?php echo $row["hoten"]."<br>"; $_SESSION["ht"] = $row["hoten"]; ?></td>
						<td> Ngày sinh :  <?php echo  $row["ngaysinh"]."<br>"; $_SESSION["ns"] = $row["ngaysinh"]; ?></td>
						<td> Giới tính:  <?php echo $row["gioitinh"]."<br>"; $_SESSION["gt"] = $row["gioitinh"]; ?></td>
						<td> Email:  <?php echo $row["email"]."<br>"; $_SESSION["email"] = $row["email"]; ?></td>
						<td> Số dư:  <?php echo $row["sodu"]."<br>"?> </td>
						<td> Quyền:  
						<?php
							if($row["quyen"] == 0)
							{
								echo "Admin";
							} else{
								echo "User<br>";
							}
							$_SESSION["quyen"] = $row["quyen"];
						?></td>
					</tr>
				<?php  } 
					} else {
						echo "0 results";
					}
				?>
			</div>
		</div>
		<!-- End: xem thông tin người dùng -->
        <ul id="top-nav">
            <li><a href="formTraCuuTimDuong.php">Tra cứu</a></li>
            <li><a href="formTimDuongTraCuu.php">Tìm đường</a></li>
            <li><a href="formThongTinTuyen.php">Thông tin tuyến</a></li>
            <li>
				<a href="">Người dùng</a>
				<ul class="top-nav-sub">
					<li>
						<?php if (isset($_SESSION['dn']))  
							echo "<a href='#popup1'> Xem thông tin</a>"; 
						?>
					</li>
					<li>
						<?php if (isset($_SESSION['dn']))  
							echo "<a href='formThayDoiThongTinCaNhan.php'>Thay đổi thông tin</a>"; 
						?>
					</li>
					<?php 
						if($_SESSION["quyen"] == 0)
						{ 
					?> 
					<li>
						<?php  
							echo "<a href='formAdminTrangChu.php'>Trang chủ admin</a>"; 
						?>
					</li>
					<?php 
						}
					?>
				 </ul>
			</li>
            <li><a href="thoat.php">Thoát</a></li>
            <!-- Begin: Search button -->
            <li class="search-btn ">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<input type="text" id="search" placeholder="Search..." name="timkiem"/>
					<button class="icon" name="btn_search" type="submit"><i class="fa fa-search"></i></button>
					
				</form>
				
				<?php if (isset($_POST["timkiem"])&& isset($_POST['btn_search']))
					{
						$search = $_POST["timkiem"];					
						$caulenh="select matuyen from danhsachtuyen where matuyen ='".$search."' and trangthai=1";
						$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
						if (mysqli_num_rows($ketqua) > 0)
						{ 
							header("Location: formThongTinTuyen.php");
						} 
						else {
							header("Location: https://xe-buyt.com/xe-buyt-quy-nhon");
						}
					}
				?>
			</li>
            <!-- End: Search button -->
			
			
        </ul>
    </div>
        <!-- End top -->