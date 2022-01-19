<?php
	require 'site.php';
	load_menuAdmin();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Admin Thống kê</title>
    <link rel="stylesheet" href="style/css/styleadmin.css">
	<style>
	.imgBx img{
		width: 50px;
		height: 50px;
		border-radius: 50%;
		margin: 20px 0;
	}
	.text-feedback{
		margin-left: 10px;
	}
	</style>
</head>
<body>
<div class="details">
		<div class="recentOrders">
			<div class="cardHeader">
				<h2>Thống kê</h2>
				<div class="modal_add">
					<input type="submit" name="add" value="Thêm" class="btn" />
				</div>
				<div class="modal_del">
					<input type="submit" name="del" value="Xóa" class="btn" />
				</div>
				<div class="modal_update">
					<input type="submit" name="update" value="Sửa" class="btn" />
				</div>
				
				<a href="#" class="btn">Xem tất cả</a>
			</div>
			<!-- Nội dung -->
			<table>
				<thead>
					<tr>
						<td>Ngày</td>
						<td>Số vé</td>
						<td>Tổng tiền</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>21/12/2021</td>
						<td>30</td>
						<td>100000$</td>
					</tr>
					<tr>
						<td>22/12/2021</td>
						<td>40</td>
						<td>150000$</td>
					</tr>
					<tr>
						<td>23/12/2021</td>
						<td>35</td>
						<td>120000$</td>
					</tr>
					<tr>
						<td>24/12/2021</td>
						<td>30</td>
						<td>100000$</td>
					</tr>
					<tr>
						<td>25/12/2021</td>
						<td>43</td>
						<td>180000$</td>
					</tr>
					<tr>
						<td>26/12/2021</td>
						<td>30</td>
						<td>100000$</td>
					</tr>
					<tr>
						<td>27/12/2021</td>
						<td>30</td>
						<td>100000$</td>
					</tr>
					<tr>
						<td>28/12/2021</td>
						<td>30</td>
						<td>100000$</td>
					</tr>
					<tr>
						<td>29/12/2021</td>
						<td>30</td>
						<td>100000$</td>
					</tr>
				</tbody>
			</table>
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
</body>
</html>