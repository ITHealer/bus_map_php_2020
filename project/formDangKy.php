<?php
	require 'site.php';
	load_top();
	
?>
<html>
<head>
	<meta charset="utf8">
	<title>Trang đăng ký</title>
	<link href="style/css/signin.css" rel="stylesheet" type="text/css"/>
	<style>
		.error {color: #FF0000;}
		.bg{
			background-attachment: fixed;
			background-image: url("style/img/Vinbusbglogin.jpg");
			background-repeat: no-repeat; 
			background-size: cover;
			overflow: scroll;
		}
		.td{
			font-size:18px;
			font-weight: bold;
		}
		
	</style>
</head>
<body class="bg"> 
<div class="signin-block">
<?php
// xác định các biến và đặt thành các giá trị trống
$usernameErr = $passErr = $repassErr = $usercustomerErr = $nsErr = $genderErr = $mailErr = "";
$username = $pass = $repass = $usercustomer = $NS = $gender = $mail = "";

// Trả về phương thức truy vấn nào đến SERVER. Dùng $_POST["REQUEST_METHOD"] vẫn được
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "Vui lòng nhập vào tên đăng nhập!";
	} else {
		$username = test_input($_POST["username"]);
	}
	  
	if (empty($_POST["pass"])) {
		$passErr = "Vui lòng nhập vào mật khẩu!";
	} else {
		$pass = test_input($_POST["pass"]);
	}
		
	if (empty($_POST["repass"])) {
		$repassErr = "Vui lòng nhập lại mật khẩu!";
	} else {
		$repass = test_input($_POST["repass"]);
	}
	
	if (empty($_POST["usercustomer"])) {
		$usercustomerErr = "Vui lòng nhập họ tên!";
	} else {
		$usercustomer = test_input($_POST["usercustomer"]);
	}
	
	if (empty($_POST["NS"])) {
		$nsErr = "Vui lòng nhập ngày tháng năm sinh!";
	} else {
		$NS = test_input($_POST["NS"]);
	}
	
	if (empty($_POST["mail"])) {
		$mailErr = "Vui lòng nhập email!";
		//preg_match() được dùng để kiểm tra, so khớp dl
	} elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST["mail"])){
			$mailErr= 'Lỗi : Email của bạn không đúng.';
	} else {
		$mail = test_input($_POST["mail"]);
	}
}

// Hàm loại bỏ 
function test_input($data) {
  $data = trim($data);
  // stripslashes xóa các ký tự \ trong chuỗi. Vì \ là kí tự thoát
  $data = stripslashes($data); 
  // htmlspecialchars chuyển đổi các ký tự thành thực thể html. vd: '<b>' thành &gt;b&..
  $data = htmlspecialchars($data);
  return $data;
}

?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="fdk" method="POST">
		<table align="center" class="table-signin">
			<p></br></p>
			<h1 align="center"> Đăng ký khách hàng</h1>
			<p align="center"><span class="error">* required field</span></p>
			<tr><td class="td">Thông tin đăng nhập:</td></tr>
			<tr>
				<td>Tên đăng nhập</td>
				<td><input type="text" name="username" required /> </td>
				<td>
				<span class="error">* <?php echo $usernameErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td>Mật khẩu</td>
				<td><input type="password" name="pass" pattern="[a-zA-Z0-9!@#$%^&*]{6,}" required /> 
				<td>
				<span class="error">* <?php echo $passErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td>Mật khẩu nhập lại</td>
				<td><input type="password" name="repass" pattern="[a-zA-Z0-9!@#$%^&*]{6,}" required /> 
				<td>
				<span class="error">* <?php echo $repassErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr><td class="td">Thông tin chi tiết cá nhân:</td></tr>
			<tr>
				<td>Họ tên khách hàng</td>
				<td><input type="text" name="usercustomer" pattern="^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$" required /> 
				<td>
				<span class="error">* <?php echo $usercustomerErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td>Ngày sinh</td>
				<td><input type="date" name="NS" min="1900-01-01" max="2021-12-31" required /> 
				<td>
				<span class="error">* <?php echo $nsErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td>Giới tính</td>
				<td ><input id="cb" type="checkbox" value="Nam" name="gender">Nam</input> 
					<input id="cb" type="checkbox" value="Nữ" name="gender">Nữ</input> 
					<input id="cb" type="checkbox" value="Khác" name="gender">Khác</input> 
				<td>
				<span class="error">* <?php echo $genderErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td>Địa chỉ email</td>
				<td><input type="text" name="mail" pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$" required /> 
				<td>
				<span class="error">* <?php echo $mailErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="right" ><input class="btn-Sigin" type= "submit" name= "btn_submit" value= "Đăng ký"></td>
			</tr>
		<table>
	</form>
</div>
<?php

if (isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['repass']) && isset($_POST['usercustomer']) && isset($_POST['NS']) && isset($_POST['gender']) && isset($_POST['mail']))
{
$tendangnhap=$_POST['username'];
$matkhau=$_POST['pass'];
$nhaplaimatkhau=$_POST['repass'];
$hoten=$_POST['usercustomer'];
$ngaysinh=$_POST['NS'];
$gioitinh=$_POST['gender'];
$email=$_POST['mail'];
	if(isset($_POST['btn_submit']))
	{
		
		/*Chỗ này xử lý thêm nếu rảnh*/
		// $tendangnhap = strip_tags($tendangnhap);
		// $tendangnhap = addslashes($tendangnhap);
		// $matkhau = strip_tags($matkhau);
		// $matkhau = addslashes($matkhau);
		
		/*kết thúc*/
		
		$connect = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");
		mysqli_query($connect, "set names 'utf8'");
		
		$gh="";
		$sodu = 50;
		$lenh="insert into taikhoan(tendangnhap, matkhau, hoten, ngaysinh, gioitinh, email, sodu) values('".$tendangnhap."','".md5($matkhau)."','".$hoten."','".$ngaysinh."','".$gioitinh."','".$email."','".$sodu."')";
		$tb="";
		if($matkhau!=$nhaplaimatkhau)
		{
			$tb = "Nhập mật khẩu không đúng";
		}
		else
		{
			$lenhkt = "select * from taikhoan where tendangnhap='".$tendangnhap."'";
			$kq = mysqli_query($connect, $lenhkt); 
			
			if($dong = mysqli_fetch_array($kq)) 
			{
				$tb="Tên đăng nhập này đã tồn tại, vui lòng đăng ký tên đăng nhập khác!";
			}
			else 
			{
				$results = mysqli_query($connect, $lenh)or die("Không đăng ký được");
				if($results)
				{
					$_SESSION['dn'] = $tendangnhap;
					
					$tb="Đã đăng ký thành công";
					
					header("Location: /formDangNhap.php");
				}
				else{$tb ="Không đăng ký được, lỗi";}
			}
			//5.Đóng kết nối
			mysqli_close($connect);
			echo "<b><i>".$tb."</i></b>";
		}
	}
}
?>
</body>
</html>