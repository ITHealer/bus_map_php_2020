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
    <title>BusMap | Đăng ký</title>
    <link rel="stylesheet" href="style/css/login.css">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
	<style>
		.error {color: #FF0000;}	
	</style>
</head>
<body>
<?php
// define variables and set to empty values
$usernameErr = $passErr = $repassErr = $usercustomerErr = $nsErr = $genderErr = $mailErr = "";
$username = $pass = $repass = $usercustomer = $NS = $gender = $mail = "";

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
	} elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST["mail"])){
			$mailErr= 'Lỗi : Email của bạn không đúng.';
	} else {
		$mail = test_input($_POST["mail"]);
	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


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
                    <h2>Đăng ký</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"">
                        <div class="inputBox_sign">
							<input type="text" placeholder="Tên đăng nhập" name="username" required /> </td>
							<span class="error">* <?php echo $usernameErr;?></span>
                        </div>
                        <div class="inputBox_sign">
							<input type="password" placeholder="Mật khẩu" name="pass" pattern="[a-zA-Z0-9!@#$%^&*]{6,}" required />
							<span class="error">* <?php echo $passErr;?></span>
                        </div>
                        <div class="inputBox_sign">
							<input type="password" placeholder="Nhập lại mật khẩu" name="repass" pattern="[a-zA-Z0-9!@#$%^&*]{6,}" required /> 
							<span class="error">* <?php echo $repassErr;?></span>
                        </div>
                        <div class="inputBox_sign">
							<input type="text" placeholder="Họ tên khách hàng" name="usercustomer" pattern="^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$" required /> 
							<span class="error">* <?php echo $usercustomerErr;?></span>
                        </div>
                        <div class="inputBox_sign">
                            <input type="date" name="NS" min="1900-01-01" max="2021-12-31" required />
							<span class="error">* <?php echo $nsErr;?></span>
                        </div>
                        <div class="inputBox_sign checkbox">
                            <input id="cb" type="checkbox" value="Nam" name="gender">Nam</input> 
					        <input id="cb" type="checkbox" value="Nữ" name="gender">Nữ</input> 
					        <input id="cb" type="checkbox" value="Khác" name="gender">Khác</input>
                        </div>
                        <div class="inputBox_sign">
                            <input type="text" name="mail" placeholder="Email" pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$" required /> 
							<span class="error">* <?php echo $mailErr;?></span>
						</div>
                        <div class="inputBox_sign">
                            <input type="submit" name= "btn_submit" value="Đăng ký">
                        </div>
<!-- Xử lý PHP và hiện thông báo -->
					<p style="color: #f00">
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
		$tendangnhap = strip_tags($tendangnhap);
		$tendangnhap = addslashes($tendangnhap);
		$matkhau = strip_tags($matkhau);
		$matkhau = addslashes($matkhau);
		
		/*kết thúc*/
		
		$connect = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");
		mysqli_query($connect, "set names 'utf8'");
		
		$gh="";
		$sodu = 50;
		$lenh="insert into taikhoan(tendangnhap, matkhau, hoten, ngaysinh, gioitinh, email, sodu) values('".$tendangnhap."','".md5($matkhau)."','".$hoten."','".$ngaysinh."','".$gioitinh."','".$email."','".$sodu."')";
		$tb="";
		if($matkhau != $nhaplaimatkhau)
		{
			$tb = "Mật khẩu nhập lại không đúng!";
		}
		else
		{
			$lenhkt = "select * from taikhoan where tendangnhap='".$tendangnhap."'";
			$kq = mysqli_query($connect, $lenhkt); 
			
			if($dong = mysqli_fetch_array($kq)) 
			{
				$tb="Tên đăng nhập đã tồn tại!";
			}
			else 
			{
				$results = mysqli_query($connect, $lenh)or die("Không đăng ký được");
				if($results)
				{
					$_SESSION['dn'] = $tendangnhap;
					
					$tb="Đăng ký thành công!";
					
				}
				else{$tb ="Đăng ký không thành công!";}
			}
		}
		//5.Đóng kết nối
		mysqli_close($connect);
		echo "<b><i>".$tb."</i></b>";
	}
}
?>
					</p>
<!-- Xử lý PHP và hiện thông báo -->
                        <p class="forget">Đã có tài khoản ? <a href="formLogin.php">Đăng nhập</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
</html>