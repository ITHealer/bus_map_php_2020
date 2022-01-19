<?php
	require 'site.php';
	load_topTraCuuTimDuong();
?>
<?php
	$conn = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");					
	mysqli_set_charset($conn, 'UTF8');
	mysqli_query($conn, "set name 'utf8'");
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
    <title>BusMap | Tìm đường</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/grid.css">
    <link rel="stylesheet" href="style/css/style.css">
	<link rel="stylesheet" href="style/css/styletrangthai.css">
	<style>
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
<div class="tab-map">
    <div class="tab">
        <div class="tabs">
            <div class="tab-item">
              <i class="tab-icon ti-search"></i>
              Tra Cứu
            </div>
            <div class="tab-item active">
              <i class="tab-icon ti-map-alt"></i>
              Tìm Đường
            </div>
            <!-- line là cái gạch chạy phía dưới title -->
            <div class="line"></div>
        </div>
          <!-- Content -->
        <div class="tab-content">
            <div class="tab-pane">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input style="float: right;" class="tra_input" type="text" name="tuyen" size="30" placeholder="Tìm tuyến xe">
                <input class="btnsubmit" type= "submit" name= "btnTim" value= "Tìm">
				<!-- Xử lý danh sách các tuyến -->
            </form>
			<!-- Start: Load tên tuyến -->
			<?php
				if(!isset($_POST["btnTim"]) || $_POST["tuyen"] == '')
				{
					$caulenhdstuyen = "select matuyen from danhsachtuyen ORDER BY matuyen";
					$ketquadstuyen = mysqli_query($kn,$caulenhdstuyen)or die ("không thực hiện được câu lệnh");
					$num_rows = mysqli_num_rows($ketquadstuyen);
					// mysqli_num_rows trả về số lượng bản ghi
					if ($num_rows > 0) 
					{
						while($row = mysqli_fetch_array($ketquadstuyen))
						{
							$caulenh="SELECT a.matuyen, tentuyen, giokhoihanh, gioketthuc ,trangthai, SUM(giave) AS GiaVe FROM danhsachtuyen AS a, danhsachtramke AS b ,vengay WHERE a.matuyen='".$row["matuyen"]."' AND b.matuyen='".$row["matuyen"]."' AND b.mavengay=vengay.mavengay";
							$ketqua=mysqli_query($kn,$caulenh)or die ("không thực hiện được câu lệnh");

							// hiển thị dữ liệu trên trang
							while($rowkq = mysqli_fetch_array($ketqua)) { ?> 
							<a href='formThongTinTraCuu.php?matuyen=<?php echo $rowkq["matuyen"]; $_ ?>' class="btn-item">
								<div class="items">
									<div class="icon-container">
										<img class="icon-car" src="style/img/icon-car.svg" alt="icon">
									</div> 
									<div class="items-info">
										<?php echo ""."<br>" ?>
										<div class="name"><span class="name-title">Tuyến </span><?php echo $rowkq["matuyen"]."<br>"?></div>
										<div class="status"> 
											<div class="status-pos">
												<i><?php if ($rowkq['trangthai']=='1') {
															$trangthai="ON"; 
														?>
															<span class="on"> <?php echo $trangthai; ?> </span>
														<?php 
														} else {
															$trangthai="OFF";
														?>
															<span class="off"> <?php echo $trangthai; ?> </span>
														<?php
														} 
													?>
												</i>
											</div>
										</div>
										<div class="description"><?php echo $rowkq["tentuyen"]."<br>"?></div>
										<div class="icon-ex ti-alarm-clock"><?php echo  " ".$rowkq["giokhoihanh"]." - ".$rowkq["gioketthuc"]; ?></div>
										<div class="ex-icon-money">
											<i class="icon-money ti-money"><?php echo $rowkq['GiaVe'] ?></i>
										</div>
									</div>
								</div>
							</a>
					<?php  } 
					?>
				<!-- End: Load tên tuyến -->
				<!-- Start: tìm kiếm -->
				<?php
						} 
					} 
				} else  
					if(isset($_POST["btnTim"]) && $_POST["tuyen"] != '')
					{
						$timtuyen = $_POST['tuyen'];
						$timtuyen = strip_tags($timtuyen);
						$timtuyen = addslashes($timtuyen);
						$caulenhtimkiem = "select matuyen from danhsachtuyen where matuyen like '%".$timtuyen."%' ORDER BY matuyen";
						$ketquatim = mysqli_query($kn,$caulenhtimkiem)or die ("không thực hiện được câu lệnh");
						$num_rows = mysqli_num_rows($ketquatim);
						if ($num_rows > 0) 
						{
							while($row = mysqli_fetch_array($ketquatim))
							{
								$caulenhhienthitimkiem = "SELECT a.matuyen, tentuyen, giokhoihanh, gioketthuc ,trangthai, SUM(giave) AS GiaVe FROM danhsachtuyen AS a, danhsachtramke AS b ,vengay WHERE a.matuyen='".$row['matuyen']."' AND b.matuyen='".$row['matuyen']."' AND b.mavengay=vengay.mavengay";
								$ketquatimkiem = mysqli_query($kn, $caulenhhienthitimkiem);
								
								while ($rowkq= mysqli_fetch_array($ketquatimkiem))
								{ ?>
								<a href='formThongTinTraCuu.php?matuyen=<?php echo $rowkq["matuyen"] ?>' class="btn-item">
									<div class="items">
										<div class="icon-container">
											<img class="icon-car" src="style/img/icon-car.svg" alt="icon">
										</div> 
										<div class="items-info">
											<?php echo ""."<br>" // Nếu bỏ dòng này chỉnh lại css ?>
											<div class="name"><span class="name-title">Tuyến </span><?php echo $rowkq["matuyen"]."<br>"?></div>
											<div class="status"> 
											<div class="status-pos">
												<i><?php if ($rowkq['trangthai']=='1') {
															$trangthai="ON"; 
														?>
															<span class="on"> <?php echo $trangthai; ?> </span>
														<?php 
														} else {
															$trangthai="OFF";
														?>
															<span class="off"> <?php echo $trangthai; ?> </span>
														<?php
														} 
													?>
												</i>
											</div>
										</div>
											<div class="description"><?php echo $rowkq["tentuyen"]."<br>"?></div>
											<div class="icon-ex ti-alarm-clock"><?php echo  " ".$rowkq["giokhoihanh"]." - ".$rowkq["gioketthuc"]; ?></div>
											<div class="ex-icon-money">
												<i class="icon-money ti-money"><?php echo $rowkq['GiaVe'] ?></i>
											</div>
										</div>
									</div>
								</a>
						<?php  } 
							} 
						}
					}
				?>
				<!-- End: tìm kiếm -->
        </div>
		<!-- End: Tra cứu -->
		
			<!-- Start: Tìm đường -->	
            <div class="tab-pane active">
                <div class="controls-container">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="origin-search">
                            <div class="icon_container">
                                <img class="icon-origin" src="style/img/icondiadiemdi.svg" alt="Location">
                                <input type="text" name="diemxuatphat" placeholder="Chọn địa điểm xuất phát">
                            </div>
                        </div>
                        <div class="origin-search">
                            <div class="icon_container">
                                <img class="icon-distination" src="style/img/icondiadiemden.svg" alt="Location">
                                <input type="text" name="diemketthuc" placeholder="Chọn địa điểm kết thúc">
                            </div>
							
                        </div>
						<div><input style="float: right;" class="btnsubmit" name="TD_input" type="submit" value="Tìm kiếm" /></div>
                       
                        <div class="swap">
                            <img class="icon_swap" src="style/img/swap.svg" alt="Swap">
                        </div>
                        <div class="decorations-container"></div>
                    </form>
                    <div class="label-route">
                        Số tuyến đi tối đa
                    </div>
                    <!-- Tab -->
                    <div class="tabs">
                        <div class="tabway-item active">1 Tuyến</div>
                        <div class="tabway-item">2 Tuyến</div>
                        <!-- line là cái gạch chạy phía dưới title -->
                        <div class="line"></div>
                    </div>
					
                    <div class="tab-content">
                        <div class="tab-paneway active">
                     <!-- php load từ đây -->
					<?php
					if (isset($_POST['diemxuatphat']) && isset($_POST['diemketthuc']))
					{
							
						$xuatphat = $_POST["diemxuatphat"];
						$ketthuc = $_POST["diemketthuc"];	
						$_SESSION['xp'] = $xuatphat;
						$_SESSION['kt'] = $ketthuc;		
						
						$tim=' ';$thaythe='%';
						$xuatphat = strip_tags($xuatphat);
						$xuatphat = addslashes($xuatphat);
						$xuatphat = str_replace($tim,$thaythe,$xuatphat);
						$ketthuc = strip_tags($ketthuc);
						$ketthuc = addslashes($ketthuc);
						$ketthuc = str_replace($tim,$thaythe,$ketthuc);
						
						$sqlxp="SELECT matram from danhsachtram WHERE tentram like '%".$xuatphat."%'";
						$sqlkt="SELECT matram from danhsachtram WHERE tentram like '%".$ketthuc."%'";
						$ketquaxp = mysqli_query($conn,$sqlxp)or die ("không thực hiện được câu lệnh");		
						$num_rowsxp = mysqli_num_rows($ketqua);
						if ($num_rowsxp > 0) 
						{							
							while($rowxp = mysqli_fetch_array($ketquaxp))
							{ $xuatphat=$rowxp['matram'];}
						}
						$ketquakt = mysqli_query($conn,$sqlkt)or die ("không thực hiện được câu lệnh");
						$num_rowskt = mysqli_num_rows($ketquakt);
						if ($num_rowskt > 0) 
						{							
							while($rowkt = mysqli_fetch_array($ketquakt))
							{ $ketthuc=$rowkt['matram'];}
						}
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
								$sql = "select distinct a.matuyen, c.tentuyen,trangthai from danhsachtuyen AS c, danhsachtramke a inner join danhsachtramke b on a.matuyen=b.matuyen and a.matram='".$xuatphat."'and b.matram='".$ketthuc."' WHERE c.matuyen = a.matuyen";
								$ketqua = mysqli_query($conn,$sql)or die ("không thực hiện được câu lệnh");
								//Bước 2: 1 tuyến
								$num_rows = mysqli_num_rows($ketqua);
								if ($num_rows > 0) 
								{							
									while($row = mysqli_fetch_array($ketqua))
									{		
					?>
                        <a href='formThongTinTimDuong.php?matuyen=<?php echo "".$row['matuyen'].""; ?>
										&&matuyen1=&&matuyen2=&&xp=<?php echo "".$xuatphat."";?>
										&&kt=<?php echo "".$ketthuc."";?>' class="btn-item"> 
							<div class="find-the-way" style="height: 165px; margin-bottom: 20px;">							
                                <div class="title-container" >
                                    <span class="title-text">
									<div class="status "> 
										<div style="left: 280px; margin-top: 15px;" class="status-pos">
											<i><?php if ($row['trangthai']=='1') {
														$trangthai="ON"; 
													?>
														<span class="on"> <?php echo $trangthai; ?> </span>
													<?php 
													} else {
														$trangthai="OFF";
													?>
														<span class="off"> <?php echo $trangthai; ?> </span>
													<?php
													} 
												?>
											</i>
										</div>
									</div>
									
                                        Đi tuyến :  <?php echo "".$row['matuyen']."<br>";?>															
													<?php echo "".$row['tentuyen']."";?>
                                    </span>
									
                                    <div class="time">
										
										<?php
										$thoigian1tuyen = 0;
										while ($xuatphat != $ketthuc)
										{	
											$caulenhtimtramke="select distinct tramke from danhsachtramke where matram ='".$xuatphat."' and matuyen='".$row['matuyen']."'";
											$ketquatimtramke= mysqli_query($conn,$caulenhtimtramke) or die ("không thực hiện được câu lệnh");;
											while ($rowrttg1tuyen= mysqli_fetch_array($ketquatimtramke))
											{
												$caulenhtongthoigian1tuyen= "select SUM(thoigian) AS ThoiGian from danhsachtramke where matram='".$xuatphat."' and tramke='".$rowrttg1tuyen['tramke']."' and matuyen='".$row['matuyen']."'";
												$ketquatongthoigian1tuyen= mysqli_query($conn,$caulenhtongthoigian1tuyen)or die ("không thực hiện được câu lệnh");
												while ($rowtongthoigian= mysqli_fetch_array($ketquatongthoigian1tuyen))
												{								
													$thoigian1tuyen = $thoigian1tuyen + (int)$rowtongthoigian['ThoiGian'];
												}
												$xuatphat=$rowrttg1tuyen['tramke'];
											}
										}
										echo $thoigian1tuyen;
										?> 
                                        <!-- Load thời gian chỗ này -->
                                        <span>phút</span>
                                    </div>
                                </div>
                                
								<div class="route-infomation">
                                    <div class="walk-distance">
                                        <img src="style/img/person.svg" alt="Person" class="icon-walk">
                                        <div class="texture">
                                            <?php 
											$caulenhkhoangcachperson="SELECT SUM(khoangcach) AS DoDai FROM danhsachtramke AS a WHERE a.matuyen='".$row['matuyen']."'";
											$ketquakhoangcachperson=mysqli_query($conn,$caulenhkhoangcachperson)or die ("không thực hiện được câu lệnh");
											while($rowkcperson = mysqli_fetch_array($ketquakhoangcachperson)) { ?> 
												<?php echo $rowkcperson["DoDai"]."km"?>
											<?php  
											} 
											?>
                                        </div>
                                    </div>
                                    <div class="arrow-container">
                                        <img src="style/img/arrow_right.svg" alt="arrow_right" class="icon-arrow">
                                    </div>
                                    <div class="bus-distance">
                                        <img src="style/img/bus-solid.svg" alt="Icon-Bus" class="icon-bus">
                                        <div class="texture">
											<?php 
											$caulenhkhoangcach="SELECT SUM(khoangcach) AS DoDai FROM danhsachtramke AS a WHERE a.matuyen='".$row['matuyen']."'";
											$ketquakhoangcach=mysqli_query($conn,$caulenhkhoangcach)or die ("không thực hiện được câu lệnh");
											while($rowkc = mysqli_fetch_array($ketquakhoangcach)) { ?> 
												<?php echo $rowkc["DoDai"]."km"?>
											<?php  
											} 
											?>
                                        </div>
                                    </div>
                                    <div class="price-bus">
                                        <?php 
											$caulenhgiave="SELECT SUM(giave) AS GiaVe FROM danhsachtramke AS a, vengay WHERE a.matuyen='".$row['matuyen']."' AND a.mavengay=vengay.mavengay";
											$ketquagiave=mysqli_query($conn,$caulenhgiave)or die ("không thực hiện được câu lệnh");
											while($rowgv = mysqli_fetch_array($ketquagiave)) { ?> 
												<?php echo $rowgv["GiaVe"]."$"?>
										<?php  
										} 
										?>
                                        <!-- Load giá -->
                                    </div>
                                </div>
                                <div class="message-container">
                                    <span class="text-bold">
                                        <img src="style/img/wifi-signal.svg" alt="Wifi" class="wifi-sign">
                                        Xe tới trong ? phút
                                        <!-- Load phút -->
                                        <span>tại trạm </span>
										<?php 
											$caulenhtentram= "select tentram from danhsachtram where matram='".$xuatphat."'";
											$ketquatentram= mysqli_query($conn,$caulenhtentram)or die ("không thực hiện được câu lệnh");
											while ($rowtt= mysqli_fetch_array($ketquatentram))
											{								
												echo $rowtt['tentram'];
											}
										?>
                                        <!-- Load tên trạm -->
                                    </span>
                                </div>
                            </div>
						<?php }
							}
						}
					}
						mysqli_close($conn);
					}	?>
						</a>
                            <!--  -->
                        </div>
                        <div class="tab-paneway">
							<!-- Tab2 -->
					<?php
					if (isset($_POST['diemxuatphat']) && isset($_POST['diemketthuc']))
					{
						$xuatphat = $_POST["diemxuatphat"];
						$ketthuc = $_POST["diemketthuc"];		
						$conn = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");					
						mysqli_set_charset($conn, 'UTF8');
						mysqli_query($conn, "set name 'utf8'");
						$tim=' ';$thaythe='%';
						$xuatphat = strip_tags($xuatphat);
						$xuatphat = addslashes($xuatphat);
						$xuatphat = str_replace($tim,$thaythe,$xuatphat);
						$ketthuc = strip_tags($ketthuc);
						$ketthuc = addslashes($ketthuc);
						$ketthuc = str_replace($tim,$thaythe,$ketthuc);
						
						$sqlxp="SELECT matram from danhsachtram WHERE tentram like '%".$xuatphat."%'";
						$sqlkt="SELECT matram from danhsachtram WHERE tentram like '%".$ketthuc."%'";
						$ketquaxp = mysqli_query($conn,$sqlxp)or die ("không thực hiện được câu lệnh");		
						$num_rowsxp = mysqli_num_rows($ketqua);
						if ($num_rowsxp > 0) 
						{							
							while($rowxp = mysqli_fetch_array($ketquaxp))
							{ $xuatphat=$rowxp['matram'];}
						}
						$ketquakt = mysqli_query($conn,$sqlkt)or die ("không thực hiện được câu lệnh");
						$num_rowskt = mysqli_num_rows($ketquakt);
						if ($num_rowskt > 0) 
						{							
							while($rowkt = mysqli_fetch_array($ketquakt))
							{ $ketthuc=$rowkt['matram'];}
						}
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
								$_SESSION['xp'] = $xuatphat;
								$_SESSION['kt'] = $ketthuc;		
								 
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
										if ($matuyen1 != $matuyen2)
										{ 
											$_SESSION['mt1']= $matuyen1;
											$_SESSION['mt2']= $matuyen2;?>
							<a href='formThongTinTimDuong.php?matuyen=&&matuyen1=<?php echo "".$matuyen1.""?>
								&&matuyen2=<?php echo "".$matuyen2."";?>&&xp=<?php echo "".$xuatphat."";?>
											&&kt=<?php echo "".$ketthuc."";?>' class="btn-item"> 		
							<div class="find-the-way" style="height: 115px; margin-bottom: 20px;">							
                                <div class="title-container">
                                    <span class="title-text">
                                        Đi tuyến : <?php echo "Đi tuyến ".$matuyen1." và ".$matuyen2."<br>"; ?>																						
                                    </span>
                                    <div class="time">
									<!-- Thời gian qua từng trạm -->
									
									<!-- Load thời gian chỗ này. Thời gian chỗ này thời gian qua các trạm mà 2 tuyến đó đi qua. giống cái chi tiết các trạm-->
                                        <span>phút</span>
                                    </div>
                                </div>
                                <div class="route-infomation">
                                    <div class="walk-distance">
                                        <img src="style/img/person.svg" alt="Person" class="icon-walk">
                                        <div class="texture">
											<?php 
											$caulenhkhoangcachperson="SELECT SUM(khoangcach) AS DoDai FROM danhsachtramke AS a WHERE a.matuyen='".$row['matuyen']."'";
											$ketquakhoangcachperson=mysqli_query($conn,$caulenhkhoangcachperson)or die ("không thực hiện được câu lệnh");
											while($rowkcperson = mysqli_fetch_array($ketquakhoangcachperson)) { ?> 
												<?php echo $rowkcperson["DoDai"]."km"?>
											<?php  
											} 
											?>
                                            <!-- Load khoảng cách -->
                                        </div>
                                    </div>
                                    <div class="arrow-container">
                                        <img src="style/img/arrow_right.svg" alt="arrow_right" class="icon-arrow">
                                    </div>
                                    <div class="bus-distance">
                                        <img src="style/img/bus-solid.svg" alt="Icon-Bus" class="icon-bus">
                                        <div class="texture">
											<?php 
											$caulenhkhoangcach="SELECT SUM(khoangcach) AS DoDai FROM danhsachtramke AS a WHERE a.matuyen='".$row['matuyen']."'";
											$ketquakhoangcach=mysqli_query($conn,$caulenhkhoangcach)or die ("không thực hiện được câu lệnh");
											while($rowkc = mysqli_fetch_array($ketquakhoangcach)) { ?> 
												<?php echo $rowkc["DoDai"]."km"?>
											<?php  
											} 
											?>
                                            <!-- Load khoảng cách -->
                                        </div>
                                    </div>
                                    <div class="price-bus">
                                        <?php 
											$caulenhgiave="SELECT SUM(giave) AS GiaVe FROM danhsachtramke AS a, vengay WHERE a.matuyen='".$row['matuyen']."' AND a.mavengay=vengay.mavengay";
											$ketquagiave=mysqli_query($conn,$caulenhgiave)or die ("không thực hiện được câu lệnh");
											while($rowgv = mysqli_fetch_array($ketquagiave)) { ?> 
												<?php echo $rowgv["GiaVe"]."$"?>
										<?php  
										} 
										?>
                                        <!-- Load giá -->
                                    </div>
                                </div>
                                <div class="message-container">
                                    <span class="text-bold">
                                        <img src="style/img/wifi-signal.svg" alt="Wifi" class="wifi-sign">
                                        Xe tới trong ? phút
                                        <!-- Load phút -->
                                        <span>tại trạm </span>
										<?php 
											$caulenhtentram= "select tentram from danhsachtram where matram='".$xuatphat."'";
											$ketquatentram= mysqli_query($conn,$caulenhtentram)or die ("không thực hiện được câu lệnh");
											while ($rowtt= mysqli_fetch_array($ketquatentram))
											{								
												echo $rowtt['tentram'];
											}
										?>
                                        <!-- Load tên trạm -->
                                    </span>
                                </div>
                            </div>
							</a>
							<?php	
										}							
									}
								}
							}
						}
						//5.Đóng kết nối
						mysqli_close($conn);
					}	?>							
                        </div>
                    </div>
					
                    <!-- End tab -->
                </div>
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

    const tabsWay = $$(".tabway-item");
    const panesWay = $$(".tab-paneway");

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
    });

    tabsWay.forEach((tab, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const paneWay = panesWay[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tab.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tabway-item.active").classList.remove("active");
        $(".tab-paneway.active").classList.remove("active");

        this.classList.add("active");
        paneWay.classList.add("active");
        };
    });

</script>
 
<script>
    const $sub = document.querySelector.bind(document);
    const $$sub = document.querySelectorAll.bind(document);
    const tabsSub = $$sub(".tabsub__item");
    const panesSub = $$sub(".tabsub-pane");

    const tabSubActive = $sub(".tabsub__item.active");
    const lineSub = $sub(".tabsub .line");

    line.style.left = tabSubActive.offsetLeft + "px";
    // offsetWidth kích thước chiều ngang của line. Set nó vào thuộc tính left vs width của line
    line.style.width = tabSubActive.offsetWidth + "px";

    tabsSub.forEach((tabSub, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const paneSub = panesSub[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tabSub.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tabsub__item.active").classList.remove("active");
        $(".tabsub-pane.active").classList.remove("active");

        line.style.left = this.offsetLeft + "px";
        line.style.width = this.offsetWidth + "px";

        this.classList.add("active");
        paneSub.classList.add("active");
        };
    });
</script>

</body>
</html>