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
    <title>BusMap | Quản lý trạm</title>
    <link rel="stylesheet" href="style/css/styleAdmin.css">
</head>
<style>
.tram_page .sub_tram_page{
	background: #f7f7f7;
	border: 1px solid #ccc;
	padding: 4px;
	line-height: 2.2;
	margin: 0 4px;
	text-decoration: none;
	color: #000;
}

.tram_page .sub_tram_page:hover{
	background: #287bff;
	color: #fff;
}
</style>
<body>
	<div class="details">
		<div class="recentOrders">
			<div class="cardHeader">
				<h2>Trạm</h2>
				<form method="POST">
				<div class="search_sub">
					<label for="">
						<input type="text" name="tram" id="" placeholder="Tìm kiếm...">
						<ion-icon name="search-outline"></ion-icon>
					</label>
				</div>
				</form>
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
						<td>Mã trạm</td>
						<td>Tên trạm</td>
						<td>Trạng thái</td>
					</tr>
				</thead>
				<?php
				if(isset($_SESSION['dn'])){
					if(isset($_GET['trang']))
					{
						$trangchon =  $_GET['trang'];
					}else
					{
						$trangchon = 0;
					}
					$sotrangdl = 0;
					$sodong = 25;
					$vtbd = $trangchon*$sodong;
					if( !isset($_POST["tram"]) && !isset($_POST["del"]) && !isset($_POST["update"]))	
					{
						$caulenh="select * from danhsachtram";
						$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
						$sodongdl = mysqli_num_rows($ketqua);
						$sotrangdl = $sodongdl/$sodong;
						$ltvtrang = "select * from danhsachtram limit $vtbd,$sodong";
						$kqpt = mysqli_query($kn,$ltvtrang);
						while($row = mysqli_fetch_array($kqpt))
						{
							if ($row['trangthai']=='1') {$trangthai="ON";} else {$trangthai="OFF";}?>
				<tbody>
					<tr>
						<td><?php echo $row['matram'];?></td>
						<td><?php echo $row['tentram'];?></td>
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
					else
						if (isset($_POST["tram"]))
						{
							$caulenh="select * from danhsachtram where matram='".$_POST["tram"]."'";
							$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
								
							while($row = mysqli_fetch_array($ketqua))
							{
								if ($row['trangthai']=='1') {$trangthai="ON";} else {$trangthai="OFF";}?>	
								<tr>
									<td><?php echo $row['matram'];?></td>
									<td><?php echo $row['tentram'];?></td>
									
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
			<?php
				echo "<p class='tram_page' align='center'>";
				for($page = 0; $page <= $sotrangdl; $page++)
				{
					
					if($page%7 == 0)
						echo "<br>";
					$trht = $page+1;
						echo "<a class='sub_tram_page' href='formAdminQuanLyTram.php?trang=$page'>Trang $trht </a>";
				}
				echo "</p>";
				mysqli_close($kn);
				}
			?>
		</div>
		<!-- New Customer -->
		<div class="recentCustomer">
			<div class="cardHeader">
				<h2>Đánh giá</h2>
			</div>
			<table>
				<tr>
					<td width="60px"><div class="imgBx"><img src="style/img/UMH2.jpg" alt="Image"></div></td>
					<td><h4>Healer<br><span>VN</span></h4></td>
					<td><p class="text-feedback">Từ khi sử dụng app tôi không phải chờ xe buýt 15 đến 20 phút như trước nữa mà có thể theo dõi trên app khi nào thì xe đến giúp tiết kiệm thời gian của tôi rất nhiều.</p></td>
				</tr>
				<tr>
					<td width="60px"><div class="imgBx"><img src="style/img/NTTL.jpg" alt="Image"></div></td>
					<td><h4>Liễu<br><span>VN</span></h4></td>
					<td><p class="text-feedback">5 sao!</p></td>
				</tr>
				<tr>
					<td width="60px"><div class="imgBx"><img src="style/img/TBT.jpg" alt="Image"></div></td>
					<td><h4>Tường<br><span>VN</span></h4></td>
					<td><p class="text-feedback">Tiện quá!!!</p></td>
				</tr>
			</table>
		</div>
	</div>
	
	<!-- Modal ADD -->
    <div class="modal js-modal">
        <div class="modal-container js-modal-container">
            <div class="modal-close js-modal-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
            <header class="modal-header">
                <span class="modal-heading-icon"><ion-icon name="trail-sign-outline"></ion-icon></span>
                Thêm trạm
            </header>
            <div class="modal-body">
                <label for="crud_add_station_code" class="modal-label">
                    <ion-icon name="golf-outline"></ion-icon>
                    Mã trạm
                </label>
                <input id="crud_add_station_code" type="text" class="modal-input" placeholder="Nhập mã trạm...">

                <label for="crud_add_station_name" class="modal-label">
                    <ion-icon name="clipboard-outline"></ion-icon>
                    Tên trạm
                </label>
                <input id="crud_add_station_name" type="text" class="modal-input" placeholder="Nhập tên trạm...">
                <button id="crud_add">
                    Thêm <i class="ti-check"></i>
                </button>
            </div>
            <footer class="modal-footer">
                <p class="modal-help">Need <a href="#">help?</a></p>
            </footer>
        </div>
    </div>

    <!-- Modal DEL -->
    <div class="modalDel js-modal-del">
		<form method="POST">
			<div class="modal-container js-modal-del-container">
				<div class="modal-close js-modal-del-close">
					<ion-icon name="close-outline"></ion-icon>
				</div>
				<header class="modal-header">
					<span class="modal-heading-icon"><ion-icon name="trail-sign-outline"></ion-icon></span>
					Xóa trạm
				</header>
				<div class="modal-body">
					<label for="crud_del_station_code" class="modal-label" >
						<ion-icon name="golf-outline"></ion-icon>
						Mã trạm
					</label>
					<input id="crud_del_station_code" type="text" class="modal-input" name="matram" placeholder="Nhập mã trạm...">
					<button id="crud_del" name="xoa">
						Xóa <i class="ti-check"></i>
					</button>
				</div>
				<?php
					if (isset($_POST['matram']) && isset($_POST['xoa']))
					{
						$matram=$_POST['matram'];
						$sql= "Update danhsachtram set trangthai=0 where matram='".$matram."'";
						$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						if ($ketqua)
						{
							header("Location: /formAdminQuanLyTram.php");
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

    <!-- Modal UP -->
    <div class="modalUp js-modal-up">
		<form method="POST">
			<div class="modal-container js-modal-up-container">
				<div class="modal-close js-modal-up-close">
					<ion-icon name="close-outline"></ion-icon>
				</div>
				<header class="modal-header">
					<span class="modal-heading-icon"><ion-icon name="trail-sign-outline"></ion-icon></span>
					Sửa trạm
				</header>
				<div class="modal-body">
					<label for="crud_up_station_code" class="modal-label">
						<ion-icon name="golf-outline"></ion-icon>
						Mã trạm
					</label>
					<input id="crud_up_station_code" type="text" name="matram" class="modal-input" placeholder="Nhập mã trạm...">
					<label for="crud_up_station_name" class="modal-label">
						<ion-icon name="clipboard-outline"></ion-icon>
						Tên trạm
					</label>
					<input id="crud_up_station_name" type="text" class="modal-input" placeholder="Nhập tên trạm...">
					<input id="crud_add_route_car" type="text" class="modal-input" name="trangthai" placeholder="Nhập trạng thái...">
					<button id="crud_up" name="sua">
						Sửa <i class="ti-check"></i>
					</button>
				</div>
				<?php
					if (isset($_POST['matram']))
					{
						$matram=$_POST['matram'];
						if($_POST['tentram'])
						{
							$tentram=$_POST['tentram'];
							$sql="Update danhsachtram set tentram='".$tentram."' where matram='".$matram."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						if($_POST['trangthai'])
						{
							$trangthai=$_POST['trangthai'];
							$sql="Update danhsachtram set trangthai=".$trangthai." where matram='".$matram."'";
							$ketqua=mysqli_query($kn,$sql)or die ("không thực hiện được câu lệnh");
						}
						mysqli_close($kn);
					}
					
				?>
				<footer class="modal-footer">
					<p class="modal-help">Need <a href="#">help?</a></p>
				</footer>
			</div>
		</form>
    </div>

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