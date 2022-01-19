<?php
	require 'site.php';
	load_topTraCuuTimDuong();
?>
<?php
	$kn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
	mysqli_set_charset($kn, 'UTF8');
	mysqli_query($kn, "set name 'utf8'");
?>
<html lang="en">
<style type="text/css">
#menu a {
  text-decoration: none;
  color: #fff;
  display: block;
}
#menu a:hover {
  background: #F1F1F1;
  color: #333;
}
#menu ul {
  background: #1F568B;
  list-style-type: none;
  overflow: hidden;
  width: 100%;
}
#menu li {
  color: #f1f1f1;
  display: inline-block;
  width: 190px;
  height: 40px;
  line-height: 40px;
  margin-left: 0px;
  text-align: center;
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | </title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/style.css">
	
	<style>

	</style>
</head>
<body>
<div class="tab-map">
<div class="tab">
    <div class="tabs">
        <div class="tab-item active">
          <i class="tab-icon ti-search"></i>
          Tra Cứu
        </div>
        <div class="tab-item">
          <i class="tab-icon ti-map-alt"></i>
          Tìm Đường
        </div>

        <!-- line là cái gạch chạy phía dưới title -->
        <div class="line"></div>
    </div>
      <!-- Content -->
    <div class="tab-content">
        <div class="tab-pane active">
            <form action="#" name="fdk" method="POST">
                <input style="float: right;" class="tra_input" type="text" name="tuyen" size="30" placeholder="Tìm tuyến xe">
                <a href="#" ><input class="btnsubmit" type= "submit" name= "btnTim" value= "Tìm"></a>
				<!-- Xử lý danh sách các tuyến -->
            </form>
			<?php 
				$danhsachtuyen = array(
				'T1',
				'T2',
				'T3',
				);
				$count = count($danhsachtuyen);
				for ($i = 0; $i < $count; $i++){ ?>
			<a href="#" class="btn-item">
			<div class="items">
                <div class="icon-container">
                    <img class="icon-car" src="style/img/icon-car.svg" alt="icon">
                </div> 
                <div class="items-info">
                    <!-- Load tên tuyến -->
						<?php
							$caulenh="SELECT tentuyen, giokhoihanh, gioketthuc , SUM(giave) AS GiaVe FROM danhsachtuyen AS a, danhsachtramke AS b ,vengay WHERE a.matuyen='".$danhsachtuyen[$i]."' AND b.matuyen='".$danhsachtuyen[$i]."' AND b.mavengay=vengay.mavengay";
							$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");
							if (mysqli_num_rows($ketqua) > 0) {
							// hiển thị dữ liệu trên trang
							while($row = mysqli_fetch_assoc($ketqua)) { echo ""."<br>" ?>
								<div class="name"><span class="name-title">Tuyến </span><?php echo $danhsachtuyen[$i]."<br>"?></div>
								<div class="description"><?php echo $row["tentuyen"]."<br>"?></div>
								<div class="icon-ex ti-alarm-clock"><?php echo  " ".$row["giokhoihanh"]." - ".$row["gioketthuc"]; ?></div>
								<div class="ex-icon-money">
									<i class="icon-money ti-money"><?php echo $row['GiaVe'] ?></i>
								</div>
						<?php  } 
							} else {
								echo "0 results";
							}
						?>
					<br>
                </div>
            </div>
			</a>
			<?php
			}
			?>
			
        </div>
        <div class="tab-pane">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input class="timduong_input" type="text" name="diemxuatphat" placeholder="Chọn điểm xuất phát">
				
                <input class="timduong_input" type="text" name="diemketthuc" placeholder="Chọn điểm kết thúc">
				
                <input style="float: right;" class="btnsubmit" name="TD_input" type="submit" value="Tìm kiếm" />
				<div> SỐ TUYẾN ĐI TỐI ĐA </div>
					<div id="menu" class="tab-map">
						<ul>
							<li><a class="tab-pane active">1 Tuyến</a></li>
							<li><a class="tab-pane">2 Tuyến</a></li>
						</ul>
					</div>
				</div>
				<div class="tab-content">
				<p>
					ĐI MỘT TUYẾN
						<?php
					if (isset($_POST['diemxuatphat']) && isset($_POST['diemketthuc']))
					{
						$xuatphat = $_POST["diemxuatphat"];
						$ketthuc = $_POST["diemketthuc"];		
						//2. Kết nối dữ liệu 
						$conn = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");
	
						//3. Thiết lập bảng mã cho kết nối
						mysqli_set_charset($conn, 'UTF8');
						mysqli_query($conn, "set name 'utf8'");
	
						if (isset($_POST["TD_input"]))
						{						
							$xuatphat = strip_tags($xuatphat);
							$xuatphat = addslashes($xuatphat);
							$ketthuc = strip_tags($ketthuc);
							$ketthuc = addslashes($ketthuc);
							if ($xuatphat == "" || $ketthuc =="") 
							{
								echo "Vui lòng nhập đủ thông tin!";
							}
							else
							{
							//Bước 1:
								$sql = "select distinct a.matuyen from danhsachtramke a inner join danhsachtramke b on a.matuyen=b.matuyen and a.matram='".$xuatphat."'and b.matram='".$ketthuc."'";
								$ketqua = mysqli_query($conn,$sql)or die ("không thực hiện được câu lệnh");
							//Bước 2: 1 tuyến
								$num_rows = mysqli_num_rows($ketqua);
								if ($num_rows > 0) 
								{									
									echo "***Đi một tuyến:";
									while($row = mysqli_fetch_array($ketqua))
									{
										$sqla= "select tentuyen from danhsachtuyen where matuyen='".$row['matuyen']."'";
										$kqa= mysqli_query($conn,$sqla);
										while ($rowa= mysqli_fetch_array($kqa))
										{
											echo "<br>".$row['matuyen']."-".$rowa['tentuyen']."";		
										}
									}
								}				
						?>
				</p>
				</div>
				<div class="tab-content">
				<p>
				ĐI 2 TUYẾN
						<?php
							//Bước 3: 2 tuyến.
								echo "<br>***Đi 2 tuyến:<br>";
								$sql1= "select distinct danhsachtuyen.matuyen from danhsachtramke,danhsachtuyen where danhsachtramke.matuyen=danhsachtuyen.matuyen and matram='".$xuatphat."'";
								$kq1= mysqli_query($conn,$sql1)or die ("không thực hiện được câu lệnh");
								while ($row1=mysqli_fetch_array($kq1))
								{
									$matuyen1= $row1['matuyen'];
									$sql2= "select distinct danhsachtuyen.matuyen from danhsachtramke,danhsachtuyen where danhsachtramke.matuyen=danhsachtuyen.matuyen and matram='".$ketthuc."'";
									$kq2= mysqli_query($conn,$sql2)or die ("không thực hiện được câu lệnh");
									while ($row2= mysqli_fetch_array($kq2))
									{
										$matuyen2= $row2['matuyen'];					
										$sql3= "SELECT DISTINCT a.matram FROM danhsachtramke a
											INNER JOIN danhsachtramke b on a.matram=b.matram AND a.matuyen='".$matuyen1."' and b.matuyen='".$matuyen2."'";
										$kq3= mysqli_query($conn,$sql3)or die ("không thực hiện được câu lệnh");
										$num_rows1 = mysqli_num_rows($kq3);
										if ($num_rows1 >0) 
										{
											while ($row3=mysqli_fetch_array($kq3))
											{
												$matram=$row3['matram'];
												$sql4= "select tentram from danhsachtram where matram='".$matram."'";
												$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
												while ($row4= mysqli_fetch_array($kq4))
												{								
													echo "".$xuatphat."---->".$row4['tentram']."---->".$ketthuc."<br>";
												}
											}
										}
									}
								}
							}
						}
						//5.Đóng kết nối
						mysqli_close($conn);
					}	
				?>	
				</p>
				</div>
			</form>	
        </div>
    </div>
</div>
	<div class="google-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d52085.82053445098!2d108.83165752902532!3d14.000112291067511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1637656705057!5m2!1svi!2s" width="1000" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>	
<script>

// Để biến $ thay thế phải gõ lại chuỗi document.querySelector.bind(document);
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    // Lấy ra những tg có class=
    const tabs = $$(".tab-item");
    const panes = $$(".tab-pane");

    // Lấy kích thước của từng tab tiêu đề khi ta click. TH viết ở đây để chạy mặc đinh tab đầu
    const tabActive = $(".tab-item.active");
    const line = $(".tabs .line");

    line.style.left = tabActive.offsetLeft + "px";
    // offsetWidth kích thước chiều ngang của line. Set nó vào thuộc tính left vs width của line
    line.style.width = tabActive.offsetWidth + "px";

    tabs.forEach((tab, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const pane = panes[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tab.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tab-item.active").classList.remove("active");
        $(".tab-pane.active").classList.remove("active");

        line.style.left = this.offsetLeft + "px";
        line.style.width = this.offsetWidth + "px";

        this.classList.add("active");
        pane.classList.add("active");
        };
    }
	);
</script>
</body>
</html>