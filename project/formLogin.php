<?php
	session_start();
?>
<?php
	require 'site.php';
	load_top();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Đăng nhập</title>
    <link rel="stylesheet" href="style/css/login.css">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
	
</head>
<body>
    <section>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="box">
            <div class="square" style="--i:0;"></div>
            <div class="square" style="--i:1;"></div>
            <div class="square" style="--i:2;"></div>
            <div class="square" style="--i:3;"></div>
            <div class="square" style="--i:4;"></div>
            <div class="container">
                <div class="form">
                    <h2>Đăng nhập</h2>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="inputBox">
                            <input type="text" name="username" placeholder="Tên đăng nhập" required />
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" placeholder="Mật khẩu" required />
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="btn_submit" value="Đăng nhập">
                        </div>
<!-- Xử lý PHP và hiện thông báo -->
<p style="color: #f00">
<?php
if (isset($_POST['username']) && isset($_POST['password']))
{
	//1. Lấy dữ liệu từ form lên.
	$tendangnhap = $_POST["username"];
	$matkhaudn = $_POST["password"];
		
		
	//2. Kết nối dữ liệu 
	$conn = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");
	
	//3. Thiết lập bảng mã cho kết nối
	mysqli_query($conn, "set name 'utf8'");
	
	//4. Xây dựng câu lệnh sql
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["btn_submit"])) {
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$tendangnhap = strip_tags($tendangnhap);
		$tendangnhap = addslashes($tendangnhap);
		$matkhaudn = strip_tags($matkhaudn);
		$matkhaudn = addslashes($matkhaudn);
		if ($tendangnhap == "" || $matkhaudn =="") 
		{
			echo "Tên đăng nhập hoặc mật khẩu bạn không được để trống!";
		}
		else
		{
			$sql = "select tendangnhap, matkhau, quyen from taikhoan where tendangnhap = '".$tendangnhap."' and matkhau = '".md5($matkhaudn)."' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {
				echo "Tên đăng nhập hoặc mật khẩu không đúng !";
			}
			else if($result = mysqli_fetch_array($query))
			{
				if($result['quyen'] == 0)
				{
					//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
					$_SESSION['dn'] = $tendangnhap;
					// Thực thi hành động sau khi lưu thông tin vào session
					// ở đây mình tiến hành chuyển hướng trang web tới một trang  vd gọi là index.php
					header('Location: formAdminTrangChu.php'); 
				}
				else
				{
					$_SESSION['dn'] = $tendangnhap;
					header('Location: formTrangChu.php'); 
				}
			}
		}
	}
	//5.Đóng kết nối
	mysqli_close($conn);
}
?>
</p>
<!-- Xử lý PHP và hiện thông báo -->
                        <p class="forget">Quên mật khẩu ? <a href="#">Chọn vào đây</a> </p>
                        <p class="forget">Chưa có tài khoản ? <a href="formSignIn.php">Đăng ký</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>