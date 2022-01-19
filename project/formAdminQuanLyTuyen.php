<?php
	require 'site.php';
	load_menuAdmin();
?>
<?php
	$kn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
	mysqli_set_charset($kn, 'UTF8');
	mysqli_query($kn, "set name 'utf8'");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Quản lý tuyến</title>
    <link rel="stylesheet" href="style/css/styleAdmin.css">
</head>
<body>
	<div class="details-route">
		<div class="recentOrders">
			<div class="cardHeader">
				<h2>Tuyến</h2>
				<form method="POST">
					<div class="search_sub">
						<label for="">
							<input type="text" name="tuyen" id="" placeholder="Tìm kiếm...">
							<ion-icon name="search-outline"></ion-icon>
						</label>
					</div>
				</form>	
				<div class="modal_del">
					<input type="submit" name="btnXoa" value="Xóa" class="btn btn_input" />
				</div>
				<div class="modal_update">
					<input type="submit" name="btnSua" value="Sửa" class="btn btn_input" />
				</div>
				<a href="formAdminQuanLyTuyen.php" class="btn">Xem tất cả</a>
			</div>
			<table>
				<thead>
					<tr>
						<td>Mã tuyến</td>
						<td>Tên tuyến</td>
						<td>Giờ khởi hành</td>
						<td>Giờ kết thúc</td>
						<td>Mã trạm bắt đầu</td>
						<td>Mã trạm kết thúc</td>
						<td>Tần suất</td>
						<td>Lộ trình</td>
						<td>Số xe</td>
						<td>Trạng thái</td>
					</tr>
				</thead>
				<?php
				if( !isset($_POST["tuyen"]) && !isset($_POST["btnTim"]) && !isset($_POST["btnSua"]) && !isset($_POST["btnXoa"]))	
				{
					$caulenh="select * from danhsachtuyen";
					$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
					while($row = mysqli_fetch_array($ketqua))
					{
						if ($row['trangthai']=='1') {$trangthai="ON";} else {$trangthai="OFF";}?>		
				<tbody>
					<tr>
						<td><?php echo $row['matuyen'];?></td>
						<td><?php echo $row['tentuyen'];?></td>
						<td><?php echo $row['giokhoihanh'];?></td>
						<td><?php echo $row['gioketthuc'];?></td>
						<td><?php echo $row['matrambatdau'];?></td>
						<td><?php echo $row['matramketthuc'];?></td>
						<td><?php echo $row['tansuat'];?></td>
						<td><?php echo $row['lotrinh'];?></td>
						<td><?php echo $row['soluongxe'];?></td>
						<?php 
						if($row['trangthai'] == 0)
						{ ?>
							<td><span class="status privacyadmin"><?php echo $trangthai;?></span></td>
						<?php					
						} else{ ?>
							<td><span class="status delivered"><?php echo $trangthai; ?></span></td>
						<?php
						}
						?>
					<?php
					}
					?>
					</tr>
				<?php
				}					
					else
						if (isset($_POST["tuyen"]))
						{
							$caulenh="select * from danhsachtuyen where matuyen='".$_POST["tuyen"]."'";
							$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
								
							while($row = mysqli_fetch_array($ketqua))
							{
								if ($row['trangthai']=='1') {$trangthai="ON";} else {$trangthai="OFF";}?>	
							<tr>
								<td><?php echo $row['matuyen'];?></td>
								<td><?php echo $row['tentuyen'];?></td>
								<td><?php echo $row['giokhoihanh'];?></td>
								<td><?php echo $row['gioketthuc'];?></td>
								<td><?php echo $row['matrambatdau'];?></td>
								<td><?php echo $row['matramketthuc'];?></td>
								<td><?php echo $row['tansuat'];?></td>
								<td><?php echo $row['lotrinh'];?></td>
								<td><?php echo $row['soluongxe'];?></td>
								<?php 
									if($row['trangthai'] == 0)
									{ ?>
										<td><span class="status privacyadmin"><?php echo $trangthai;?></span></td>
									<?php					
									} else{ ?>
										<td><span class="status delivered"><?php echo $trangthai; ?></span></td>
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
    <div class="modal js-modal">
        <div class="modal-container js-modal-container">
            <div class="modal-close js-modal-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
            <header class="modal-header">
                <span class="modal-heading-icon"><ion-icon name="pulse-outline"></ion-icon></span>
                Thêm tuyến
            </header>
            <div class="modal-body edit_route">
                <input id="crud_add_route_code" type="text" class="modal-input" placeholder="Nhập mã tuyến...">
                <input id="crud_add_route_name" type="text" class="modal-input" placeholder="Nhập tên tuyến...">
                <input id="crud_add_route_hourstart" type="text" class="modal-input" placeholder="Nhập giờ khởi hành...">
                <input id="crud_add_route_hourend" type="text" class="modal-input" placeholder="Nhập giờ kết thúc...">
                <input id="crud_add_route_stationstart" type="text" class="modal-input" placeholder="Nhập mã trạm bắt đầu...">
                <input id="crud_add_route_stationend" type="text" class="modal-input" placeholder="Nhập mã trạm kết thúc...">
                <input id="crud_add_route_frequency" type="text" class="modal-input" placeholder="Nhập tần suất...">
                <input id="crud_add_route_route" type="text" class="modal-input" placeholder="Nhập lộ trình...">
                <input id="crud_add_route_car" type="text" class="modal-input" placeholder="Nhập số lượng xe...">
                <input id="crud_add_route_status" type="text" class="modal-input" placeholder="Nhập trạng thái...">
                <button id="crud_add">
                    Thêm <i class="ti-check"></i>
                </button>
            </div>
        </div>
    </div>
	<!-- End: modal ADD -->

    <!-- Start: modal DEL -->
    <div class="modalDel js-modal-del">
		<form method="POST">
			<div class="modal-container js-modal-del-container">
				<div class="modal-close js-modal-del-close">
					<ion-icon name="close-outline"></ion-icon>
				</div>
				<header class="modal-header">
					<span class="modal-heading-icon"><ion-icon name="pulse-outline"></ion-icon></span>
					Xóa tuyến
				</header>
				<div class="modal-body">
					<label for="crud_del_stationcode" class="modal-label">
						<ion-icon name="navigate-outline"></ion-icon>
						Mã tuyến
					</label>
					<input id="crud_del_stationcode" type="text" name="matuyen" class="modal-input" placeholder="Nhập mã trạm...">
					<button id="crud_del" name="xoa">
						Xóa <i class="ti-check"></i>
					</button>
				</div>
				<?php
					if (isset($_POST['matuyen']) && isset($_POST['xoa']))
					{
						$matuyen=$_POST['matuyen'];
						$sql= "Update danhsachtuyen set trangthai=0 where matuyen='".$matuyen."'";
						$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						if ($ketqua)
						{
							echo "Xóa thành công";
						} 
						else
						{
							echo "Xảy ra lỗi: " . mysqli_error($conn);
						}
					}
				?>
				<footer class="modal-footer">
					<p class="modal-help">Need <a href="#">help?</a></p>
				</footer>
			</div>
		</form>
    </div>
	<!-- End: modal DEL -->
	
    <!-- Start: modal UP -->
    <div class="modalUp js-modal-up">
		<form method="POST">
			<div class="modal-container js-modal-up-container">
				<div class="modal-close js-modal-up-close">
					<ion-icon name="close-outline"></ion-icon>
				</div>
				<header class="modal-header">
					<span class="modal-heading-icon"><ion-icon name="pulse-outline"></ion-icon></span>
					Sửa tuyến
				</header>
				<div class="modal-body edit_route">
					<input id="crud_add_route_code" type="text" class="modal-input" name="matuyen" placeholder="Nhập mã tuyến...">
					<input id="crud_add_route_name" type="text" class="modal-input" name="tentuyen" placeholder="Nhập tên tuyến...">
					<input id="crud_add_route_hourstart" type="text" class="modal-input" name="giokh" placeholder="Nhập giờ khởi hành...">
					<input id="crud_add_route_hourend" type="text" class="modal-input" name="giokt" placeholder="Nhập giờ kết thúc...">
					<input id="crud_add_route_stationstart" type="text" class="modal-input" name="matrambatdau" placeholder="Nhập mã trạm bắt đầu...">
					<input id="crud_add_route_stationend" type="text" class="modal-input" name="matramketthuc" placeholder="Nhập mã trạm kết thúc...">
					<input id="crud_add_route_frequency" type="text" class="modal-input" name ="tansuat" placeholder="Nhập tần suất...">
					<input id="crud_add_route_route" type="text" class="modal-input" name="lotrinh" placeholder="Nhập lộ trình...">
					<input id="crud_add_route_car" type="text" class="modal-input" name="slxe" placeholder="Nhập số lượng xe...">
					<input id="crud_add_route_car" type="text" class="modal-input" name="trangthai" placeholder="Nhập trạng thái...">
					<button id="crud_up" name="sua">
						Sửa <i class="ti-check"></i>
					</button>
				</div>
				<?php
					if (isset($_POST['matuyen']))
					{
						$matuyen=$_POST['matuyen'];
						if($_POST['tentuyen'])
						{
							$tentuyen=$_POST['tentuyen'];
							$sql="Update danhsachtuyen set tentuyen='".$tentuyen."' where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['giokh'])
						{
							$giokhoihanh=$_POST['giokh'];
							$sql="Update danhsachtuyen set giokhoihanh='".$giokhoihanh."'where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['giokt'])
						{
							$gioketthuc=$_POST['giokt'];
							$sql="Update danhsachtuyen set gioketthuc='".$gioketthuc."'where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['matrambatdau'])
						{
							$mtbd=$_POST['matrambatdau'];
							$sql="Update danhsachtuyen set matrambatdau='".$mtbd."' where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['matramketthuc'])
						{
							$mtkt=$_POST['matramketthuc'];
							$sql="Update danhsachtuyen set matramketthuc='".$mtkt."' where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['tansuat'])
						{
							$tansuat=$_POST['tansuat'];
							$sql="Update danhsachtuyen set tansuat='".$tansuat."' where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['slxe'])
						{
							$soluongxe=$_POST['slxe'];
							$sql="Update danhsachtuyen set soluongxe='".$soluongxe."' where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['lotrinh'])
						{
							$lotrinh=$_POST['lotrinh'];
							$sql="Update danhsachtuyen set lotrinh='".$lotrinh."' where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['trangthai'])
						{
							$trangthai=$_POST['trangthai'];
							$sql="Update danhsachtuyen set trangthai=".$trangthai." where matuyen='".$matuyen."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						mysqli_close($kn);
					}
				?>
			</div>
		</form>
    </div>
	<!-- End: modal UP -->
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