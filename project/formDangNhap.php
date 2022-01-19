<?php
	session_start();
?>
<?php
	require 'site.php';
	load_top();
?>
<html> 
	<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<title>BusMap | Đăng nhập</title>
	<link href="style/css/login1.css" rel="stylesheet" type="text/css"/>
	<style>
		.bg{
			background-attachment: fixed;
			background-image: url("style/img/vinbusbglogin1.jpg");
			background-repeat: no-repeat; 
			background-size: cover;
			overflow: scroll;
		}
	</style>
	</head> 
	<body class="bg"> 
	<div class="login-block">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<fieldset>
	    <legend>Thông tin đăng nhập</legend>
	    	<table  align="center" id="table">
				<h1>BusMap</h1>
	    		<tr>
	    			<td>Tên đăng nhập</td>
	    			<td><input type="text" name="username" size="30"></td>
	    		</tr>
	    		<tr>
	    			<td>Mật khẩu</td>
	    			<td><input type="password" name="password" size="30"></td>
	    		</tr>
	    		<tr>
	    			<td colspan="2" align="center"> <input type="submit" class="btn" name="btn_submit" value="Đăng nhập"></td>
	    		</tr>
	    	</table>
		</fieldset>
		</form>
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
					//tiến hành lưu tên đăng nhập vào session
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
	</div>
	</body> 
</html>

