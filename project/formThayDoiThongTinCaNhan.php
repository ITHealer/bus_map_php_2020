<?php
	require 'site.php';
	load_topfunction();
?>
<?php 
	$connect = mysqli_connect("localhost", "root", "", "xebuyt")or die("Không kết nối được");
	mysqli_query($connect, "set names 'utf8'");
?>
<html>
<head>
	<meta charset="utf8">
	<title>BusMap | Thay đổi thông tin cá nhân</title>
	<link href="style/css/signin.css" rel="stylesheet" type="text/css"/>
	<link href="style/css/stylethaydoithongtincanhan.css" rel="stylesheet" type="text/css"/>
	<style>
		input{
			margin-left: 0;
		}
	</style>
</head>
<body class="bg"> 
<div class="signin-block" style="margin-top: 112px">

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="fdk" method="POST">
		<table align="center">
			<h1 align="center"> Thay đổi thông tin cá nhân</h1>
			<tr><td class="td">Chọn thay đổi mật khẩu</td></tr>
			<tr>
				<td></td>
				<td class="change-pass"><a href="formThayDoiMatKhau.php">Đổi mật khẩu</a></td>
			</tr>
			<tr><td class="td">Thông tin chi tiết cá nhân</td></tr>
			<tr>
				<td>Họ tên khách hàng</td>
				<td>
					<input type="text" name="usercustomer" value="<?php echo $_SESSION["ht"] ?>" pattern="^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$"  /> 
				</td>
			</tr>
			<tr>
				<td>Ngày sinh</td>
				<td><input type="date" value="<?php echo $_SESSION["ns"] ?>" name="NS" min="1900-01-01" max="2021-12-31" /> </td>
			</tr>
			<tr>
				<td>Giới tính</td>
				<td>
					<?php // Các session này ở topfunction
						if($_SESSION["gt"] == "Nam")
						{ 
					?>
						<input id="cb" type="checkbox" checked name="gender">Nam</input> 
						<input id="cb" type="checkbox" name="gender">Nữ</input>
						<input id="cb" type="checkbox" name="gender">Khác</input>
					<?php } else if($_SESSION["gt"] == "Nữ"){ ?>
						<input id="cb" type="checkbox" name="gender">Nam</input> 
						<input id="cb" type="checkbox" checked name="gender">Nữ</input> 
						<input id="cb" type="checkbox" name="gender">Khác</input> 	
					<?php } else if($_SESSION["gt"] == "Khác"){ ?>
						<input id="cb" type="checkbox" name="gender">Nam</input>
						<input id="cb" type="checkbox" name="gender">Nữ</input>
						<input id="cb" type="checkbox" checked name="gender">Khác</input> 
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>Địa chỉ email</td>
				<td>
					<input type="text" name="mail" value="<?php echo $_SESSION["email"] ?>" pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$"  /> 
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="right" ><input type= "submit" name= "btn_submit" value= "Cập nhật"></td>
			</tr>
		</table>
	</form>
<?php
if(isset($_SESSION['dn']))
{
	if (isset($_POST['usercustomer']) && isset($_POST['NS']) && isset($_POST['gender']) && isset($_POST['mail']))
	{
		$hoten=$_POST['usercustomer'];
		$ngaysinh=$_POST['NS'];
		$gioitinh=$_POST['gender'];
		$email=$_POST['mail'];
		$tendangnhap = $_SESSION['dn'];
		$connect = mysqli_connect("localhost", "root", "", "xebuyt")or die("Không kết nối được");
		mysqli_query($connect, "set names 'utf8'");
		if(isset($_POST['btn_submit']))
		{
			$hoten = strip_tags($hoten);
			$hoten = addslashes($hoten);
			$ngaysinh = strip_tags($ngaysinh);
			$ngaysinh = addslashes($ngaysinh);
			$gioitinh = strip_tags($gioitinh);
			$gioitinh = addslashes($gioitinh);
			$email = strip_tags($email);
			$email = addslashes($email);
			
			$tb = "";
			$lenhcapnhatthongtin="update taikhoan set hoten = '".$hoten."', ngaysinh = '".$ngaysinh."', gioitinh = '".$gioitinh."', email = '".$email."' where tendangnhap = '".$tendangnhap."'";
			$ketquacapnhatthongtin = mysqli_query($connect, $lenhcapnhatthongtin)or die("Cập nhật không thành công");
			
			if($ketquacapnhatthongtin)
			{
				$tb="Đã cập nhật thành công";
			}
			else
			{
				$tb ="Cập nhật không thành công, lỗi!";
			}
			//5.Đóng kết nối
			mysqli_close($connect);
			echo "<b><i>".$tb."</i></b>";
		}
	}
}
?>
</div>
</body>
</html>