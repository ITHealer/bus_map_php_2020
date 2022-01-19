<?php
	require 'site.php';
	load_topfunction();
?>
<html>
<head>
	<meta charset="utf8">
	<title>BusMap | Thay đổi mật khẩu</title>
	<link href="style/css/signin.css" rel="stylesheet" type="text/css"/>
	<link href="style/css/stylethaydoithongtincanhan.css" rel="stylesheet" type="text/css"/>
</head>
<body class="bg"> 
<div class="signin-block" style="margin-top: 132px" >
<?php
$oldpassErr = $passErr = $repassErr = "";
$oldpass = $pass = $repass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (empty($_POST["oldpass"])) {
		$oldpassErr = "Vui lòng nhập vào mật khẩu cũ!";
	} else {
		$oldpass = test_input($_POST["oldpass"]);
	}
	
	if (empty($_POST["pass"])) {
		$passErr = "Vui lòng nhập vào mật khẩu mới!";
	} else {
		$pass = test_input($_POST["pass"]);
	}
		
	if (empty($_POST["repass"])) {
		$repassErr = "Vui lòng nhập lại mật khẩu mới!";
	} else {
		$repass = test_input($_POST["repass"]);
	}
	
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="fdk" method="POST">
		<table align="center">
			</br>
			<h1 align="center"> Thay đổi mật khẩu</h1>
			<p align="center"><span class="error">* Thông tin cần có!</span></p>
			<tr><td class="td">Mật khẩu:</td></tr>
			<tr>
				<td>Mật khẩu cũ</td>
				<td><input type="password" name="oldpass" pattern="[a-zA-Z0-9!@#$%^&*]{6,}" required /> 
				<td>
				<span class="error">* <?php echo $oldpassErr;?></span>
				<br><br>
				</td>
			</tr>
			<tr>
				<td>Mật khẩu mới</td>
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
			<tr>
				<td></td>
				<td align="right" ><input type= "submit" name= "btn_submit" value= "Cập nhật"></td>
			</tr>
		<table>
	</form>
<?php
if(isset($_SESSION['dn']))
{
	if (isset($_POST['oldpass']) && isset($_POST['pass']) && isset($_POST['repass']) )
	{
		$matkhaucu=$_POST['oldpass'];
		$matkhaumoi=$_POST['pass'];
		$rematkhaumoi=$_POST['repass'];
		$tendangnhap = $_SESSION['dn'];
		$connect = mysqli_connect("localhost", "root", "", "xebuyt")or die("Không kết nối được");
		mysqli_query($connect, "set names 'utf8'");
		if (isset($_POST["btn_submit"])) 
		{
			$matkhaucu = strip_tags($matkhaucu);
			$matkhaucu = addslashes($matkhaucu);
			$matkhaumoi = strip_tags($matkhaumoi);
			$matkhaumoi = addslashes($matkhaumoi);
			$rematkhaumoi = strip_tags($rematkhaumoi);
			$rematkhaumoi = addslashes($rematkhaumoi);
			if ($matkhaucu =="") 
			{
				echo "Mật khẩu bạn không được để trống!";
			}
			else
			{
				if($matkhaumoi!=$rematkhaumoi)
				{
					$tb = "Nhập mật khẩu không đúng";
				}
				else
				{
					$lenh="update taikhoan set matkhau='".md5($matkhaumoi)."' where tendangnhap='".$tendangnhap."'";
					$tb="";
					$results = mysqli_query($connect, $lenh)or die("Cập nhật không thành công!");
					if($results)
					{
						$tb="Đã cập nhật thành công";
					}
					else{$tb ="Cập nhật không thành công, lỗi!";}
				}
			}
		}
		//5.Đóng kết nối
		mysqli_close($connect);
		echo "<b><i>".$tb."</i></b>";
	}
}
?>
</div>
</body>
</html>