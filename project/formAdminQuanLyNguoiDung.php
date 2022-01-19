<?php
	require 'site.php';
	load_menuAdmin();
?>
<?php
	$conn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
	mysqli_set_charset($conn, 'UTF8');
	mysqli_query($conn, "set name 'UTF8'");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Quản lý người dùng</title>
    <link rel="stylesheet" href="style/css/styleAdmin.css">
</head>
<body>
<div class="details" style="grid-template-columns: 1fr;">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Người dùng</h2>
			<div class="search_sub">
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<label for="">
						<input type="text" name="search_user" id="" placeholder="Tìm kiếm...">
						<ion-icon name="search-outline"></ion-icon>
					</label>
				</form>
			</div>
			<div class="modal_add">
				<input type="submit" name="add" value="Thêm" class="btn btn_input" />
			</div>
			<div class="modal_del">
				<input type="submit" name="del" value="Xóa" class="btn btn_input" />
			</div>
			<div class="modal_update">
				<input type="submit" name="update" value="Sửa" class="btn btn_input" />
			</div>
			<a href="#" class="btn">Xem tất cả</a>
		</div>
		<table>
			<thead>
				<tr>
					<td>Tên đăng nhập</td>
					<td>Mật khẩu</td>
					<td>Họ tên</td>
					<td>Ngày sinh</td>
					<td>Giới tính</td>
					<td>Email</td>
					<td>Quyền</td>
				</tr>
			</thead>
				<?php
				if( !isset($_POST["search_user"]) && !isset($_POST["add"]) && !isset($_POST["del"]) && !isset($_POST["update"]))	
				{
					$caulenh="select * from taikhoan";
					$ketqua=mysqli_query($conn,$caulenh)or die ("không thực hiện được câu lệnh");
					while($rowuser = mysqli_fetch_array($ketqua))
					{ 
				?>
				<tbody>
					<tr>
						<td><?php echo $rowuser['tendangnhap']; ?></td>
						<td><?php echo $rowuser['matkhau']; ?></td>
						<td><?php echo $rowuser['hoten']; ?></td>
						<td><?php echo $rowuser['ngaysinh']; ?></td>
						<td><?php echo $rowuser['gioitinh']; ?></td>
						<td><?php echo $rowuser['email']; ?></td>
						<?php 
						if($rowuser['quyen'] == 0)
						{ ?>
							<td><span class="status privacyadmin"><?php echo $rowuser['quyen']."</br>"; ?></span></td>
						<?php					
						} else{ ?>
							<td><span class="status delivered"><?php echo $rowuser['quyen']."</br>"; ?></span></td>
						<?php
						}
						?>
					</tr>
					<?php 
					}
				}					
				else
					if (isset($_POST["search_user"]))
					{
						$caulenh="select * from taikhoan where tendangnhap='".$_POST["search_user"]."'";
						$ketqua=mysqli_query($conn,$caulenh)or die ("không thực hiện được câu lệnh");
						while($rowuser = mysqli_fetch_array($ketqua))
						{ 
					?>
						<tr>
							<td><?php echo $rowuser['tendangnhap']; ?></td>
							<td><?php echo $rowuser['matkhau']; ?></td>
							<td><?php echo $rowuser['hoten']; ?></td>
							<td><?php echo $rowuser['ngaysinh']; ?></td>
							<td><?php echo $rowuser['gioitinh']; ?></td>
							<td><?php echo $rowuser['email']; ?></td>
							<?php 
							if($rowuser['quyen'] == 0)
							{ ?>
								<td><span class="status privacyadmin"><?php echo $rowuser['quyen']."</br>"; ?></span></td>
							<?php					
							} else{ ?>
								<td><span class="status delivered"><?php echo $rowuser['quyen']."</br>"; ?></span></td>
							<?php
							}
							?>
						</tr>
						<?php 
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>
    <!-- Start: modal ADD -->
    <div class="modal js-modal modal_user">
        <div class="modal-container js-modal-container">
            <div class="modal-close js-modal-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
            <header class="modal-header">
                <span class="modal-heading-icon"><ion-icon name="person-add-outline"></ion-icon></span>
                Thêm người dùng
            </header>
            <div class="modal-body edit_route_user">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<input type="text" name="username" class="modal-input" placeholder="Nhập tên đăng nhập...">
					<input type="password" name="pass" class="modal-input" placeholder="Nhập mật khẩu...">
					<input type="password" name="repass" class="modal-input" placeholder="Nhập lại mật khẩu...">
					<input type="text" name="customer" class="modal-input" placeholder="Nhập họ tên...">
					<input type="date" name="ns" class="modal-input" min="1900-01-01" max="2021-12-31" required />
					<div class="checkbox_gender">
						Nam<input  type="checkbox" name="gender" value="Nam" class="modal-input" >
						Nữ<input type="checkbox" name="gender" value="Nữ" class="modal-input" >
					</div>
					<input type="text" name="mail" class="modal-input" placeholder="Nhập email...">
					<div class="checkbox_privacy">
						Admin<input type="checkbox" name="privacy" value="0" class="modal-input" >
						Customer<input type="checkbox" name="privacy" value="1" class="modal-input" >
					</div>
					<input id="crud_add" value="Thêm" type="submit" name="btn_adduser" >
						<i class="ti-check"></i>
					</input>
				</form>
            </div>
        </div>
    </div>
<!-- PHP thêm người dùng -->
<?php
if(isset($_SESSION['dn']))
{
	if (isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['repass']) && isset($_POST['customer']) && isset($_POST['ns']) && isset($_POST['gender']) && isset($_POST['mail']) && isset($_POST['privacy']))
	{
		$tendangnhap=$_POST['username'];
		$matkhau=$_POST['pass'];
		$nhaplaimatkhau=$_POST['repass'];
		$hoten=$_POST['customer'];
		$ngaysinh=$_POST['ns'];
		$gioitinh=$_POST['gender'];
		$email=$_POST['mail'];
		$privacy = $_POST['privacy'];
		if(isset($_POST['btn_adduser']))
		{
			/*Chỗ này xử lý thêm nếu rảnh*/
			$tendangnhap = strip_tags($tendangnhap);
			$tendangnhap = addslashes($tendangnhap);
			$matkhau = strip_tags($matkhau);
			$matkhau = addslashes($matkhau);
			/*kết thúc*/
			
			$tb="";
			if($matkhau!=$nhaplaimatkhau)
			{
				$tb = "Nhập mật khẩu không đúng";
			}
			else
			{
				$lenhkt = "select tendangnhap from taikhoan where tendangnhap='".$tendangnhap."'";
				$kq = mysqli_query($conn, $lenhkt) or die("Không thực hiện được câu lệnh");
				
				if($kq)
				{
					$tb="Tên đăng nhập này đã tồn tại, vui lòng đăng ký tên đăng nhập khác!";
				}
				else 
				{
					$sodu = 50;
					$lenh="insert into taikhoan (tendangnhap, matkhau, hoten, ngaysinh, gioitinh, email, sodu, quyen) values('".$tendangnhap."','".md5($matkhau)."','".$hoten."','".$ngaysinh."','".$gioitinh."','".$email."','".$sodu."','".$privacy."')";
					$results = mysqli_query($conn, $lenh)or die("Không đăng ký được");
					if($results)
					{
						$tb="Đã đăng ký thành công";
					}
					else{$tb ="Không đăng ký được, lỗi";}
				}
			}
		}
	}
}
?>
	<!-- End: modal ADD -->

    <!-- Start: modal DEL -->
    <div class="modalDel js-modal-del">
        <div class="modal-container js-modal-del-container">
            <div class="modal-close js-modal-del-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
            <header class="modal-header">
                <span class="modal-heading-icon"><ion-icon name="person-outline"></ion-icon></span>
                Xóa người dùng
            </header>
            <div class="modal-body">
                <label for="crud_del_station_code" class="modal-label">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    Tên đăng nhập
                </label>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<input id="crud_del_station_code" name="del_tendangnhap" type="text" class="modal-input" placeholder="Nhập tên đăng nhập..." required />
					<input id="crud_del" value="Xóa" type="submit" name="btn_deluser" >
						<i class="ti-check"></i>
					</input>
				</form>
            </div>
            <footer class="modal-footer">
                <p class="modal-help">Need <a href="#">help?</a></p>
            </footer>
        </div>
    </div>
	<!-- PHP xóa người dùng -->
<?php 
if(isset($_SESSION['dn']))
{
	if(isset($_POST['del_tendangnhap']))
	{
		$deltendangnhap = $_POST['del_tendangnhap'];
		if(isset($_POST['btn_deluser']))
		{
			$deltendangnhap = strip_tags($deltendangnhap);
			$deltendangnhap = addslashes($deltendangnhap);
			$cmddeluser = "delete from taikhoan where tendangnhap = '".$deltendangnhap."'";
			$resultdeluser = mysqli_query($conn, $cmddeluser) or die("Không thực hiện được câu lệnh");
		}
	}
}
?>
	<!-- End: modal DEL -->
	
    <!-- Start: modal UP -->
    <div class="modalUp js-modal-up modal_user">
        <div class="modal-container js-modal-up-container">
            <div class="modal-close js-modal-up-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
            <header class="modal-header">
                <span class="modal-heading-icon"><ion-icon name="people-outline"></ion-icon></span>
                Sửa người dùng
            </header>
            <div class="modal-body edit_route_user">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="text" name="up_username" class="modal-input" placeholder="Nhập tên đăng nhập...">
				<input type="text" name="up_customer" class="modal-input" placeholder="Nhập họ tên...">
				<input type="date" name="up_ns" class="modal-input" min="1900-01-01" max="2021-12-31" required />
                <div class="checkbox_gender">
                    Nam<input  type="checkbox" name="up_gender" value="Nam" class="modal-input" >
                    Nữ<input type="checkbox" name="up_gender" value="Nữ" class="modal-input" >
                </div>
                <input type="text" name="up_mail" class="modal-input" placeholder="Nhập email...">
                <div class="checkbox_privacy">
                    Admin<input type="checkbox" name="up_privacy" value="0" class="modal-input" >
                    Customer<input type="checkbox" name="up_privacy" value="1" class="modal-input" >
                </div>
                <input id="crud_add" value="Sửa" type="submit" name="btn_upuser" >
					<i class="ti-check"></i>
				</input>
				</form>
            </div>
        </div>
    </div>
	<!-- PHP sửa người dùng -->
<?php
if(isset($_SESSION['dn']))
{
	if (isset($_POST['up_username']) && isset($_POST['up_customer']) && isset($_POST['up_ns']) && isset($_POST['up_gender']) && isset($_POST['up_mail']) && isset($_POST['up_privacy']))
	{
		$tendangnhap=$_POST['up_username'];
		$hoten=$_POST['up_customer'];
		$ngaysinh=$_POST['up_ns'];
		$gioitinh=$_POST['up_gender'];
		$email=$_POST['up_mail'];
		$privacy = $_POST['up_privacy'];
		
		if(isset($_POST['btn_upuser']))
		{
			$tendangnhap = strip_tags($tendangnhap);
			$tendangnhap = addslashes($tendangnhap);
			$hoten = strip_tags($hoten);
			$hoten = addslashes($hoten);
			$email = strip_tags($email);
			$email = addslashes($email);
			$tb = "";
			$cmdupuser="update taikhoan set hoten = '".$hoten."', ngaysinh = '".$ngaysinh."', gioitinh = '".$gioitinh."', email = '".$email."', quyen = '".$privacy."' where tendangnhap = '".$tendangnhap."'";
			$resultupuser = mysqli_query($conn, $cmdupuser)or die("Cập nhật không thành công");
			
			if($resultupuser)
			{
				$tb="Đã cập nhật thành công";
			}
			else
			{
				$tb ="Cập nhật không thành công, lỗi!";
			}
		}
	}
	mysqli_close($conn);
}
?>
	<!-- End: modal UP -->

<!-- ADD -->
<script>
    const addBtns = document.querySelectorAll('.modal_add')  
    const modal = document.querySelector('.js-modal')
    const modalClose = document.querySelector('.js-modal-close')
    const modalContainer = document.querySelector('.js-modal-container')
    
    function show_CRUD(){
        modal.classList.add('open');
    }

    function hide_CRUD(){
        modal.classList.remove('open');
    }

    for(const addBtn of addBtns){
        addBtn.addEventListener('click', show_CRUD)
    }

    modalClose.addEventListener('click', hide_CRUD)

    modal.addEventListener('click', hide_CRUD)

    modalContainer.addEventListener('click', function(event){
        event.stopPropagation()
    })
</script>

<!-- DEL -->
<script>
    const delBtns = document.querySelectorAll('.modal_del')  
    const modalDel = document.querySelector('.js-modal-del')
    const modalCloseDel = document.querySelector('.js-modal-del-close')
    const modalContainerDel = document.querySelector('.js-modal-del-container')

    function show_CRUD(){
        modalDel.classList.add('open');
    }

    function hide_CRUD(){
        modalDel.classList.remove('open');
    }

    for(const delBtn of delBtns){
        delBtn.addEventListener('click', show_CRUD)
    }

    modalCloseDel.addEventListener('click', hide_CRUD)

    modalDel.addEventListener('click', hide_CRUD)

    modalContainerDel.addEventListener('click', function(event){
        event.stopPropagation()
    })
</script>

<!-- UP -->
<script>
    const upBtns = document.querySelectorAll('.modal_update')  
    const modalUp = document.querySelector('.js-modal-up')
    const modalCloseUp = document.querySelector('.js-modal-up-close')
    const modalContainerUp = document.querySelector('.js-modal-up-container')
    
    function show_CRUD(){
        modalUp.classList.add('open');
    }

    function hide_CRUD(){
        modalUp.classList.remove('open');
    }

    for(const upBtn of upBtns){
        upBtn.addEventListener('click', show_CRUD)
    }

    modalCloseUp.addEventListener('click', hide_CRUD)

    modalUp.addEventListener('click', hide_CRUD)

    modalContainerUp.addEventListener('click', function(event){
        event.stopPropagation()
    })
</script>

</body>
</html>