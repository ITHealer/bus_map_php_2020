<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/style.css">
</head>
<body>
    <div id="top">

        <!-- Begin top -->
        <div id="logo" class="logo-top">
            <a href="index.php">
                <img src="style/img/logo_BusMap.jpg" alt="Logo" class="edit-logo">
            </a>
        </div>
        <ul id="top-nav">
            <li><a href="formVeChungToi.php">Về chúng tôi</a></li>
            <li><a href="formSignIn.php">Đăng ký</a></li>
            <li><a href="formLogin.php">Đăng nhập</a></li>
            <li>
                <a href="#">
                    Khác
                    <i class="nav-arrow-down ti-angle-down"></i>
                </a>
                <ul class="top-nav-sub">
                    <li><a href="formTinhNang.php">Tính năng</a></li>
                    <li><a href="formHuongDan.php">Hướng dẫn</a></li>
                    <li><a href="formLienHe.php">Liên hệ</a></li>
                </ul>
            </li>
            
            <!-- Begin: Search button -->
            <li class="search-btn ">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<input type="text" id="search" placeholder="Search..." name="timkiem"/>
					<button class="icon" name="btn_search" type="submit"><i class="fa fa-search"></i></button>
					
				</form>
				<?php
					$kn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
					mysqli_set_charset($kn, 'UTF8');
					mysqli_query($kn, "set name 'utf8'");
				?>
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
        <!-- End top -->
    </div>
</body>
</html>