<?php
	require 'site.php';
	load_topTraCuuTimDuong();
?>
<?php
	$conn = mysqli_connect("localhost", "root", "", "xebuyt") or die("Kết nối không thành công");
	mysqli_set_charset($conn, 'UTF8');
	mysqli_query($conn, "set name 'utf8'");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Thông tin tìm đường</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/grid.css">
    <link rel="stylesheet" href="style/css/style.css">
	<style>
		.dot{
			min-height: 8px;
			min-width: 8px;
			font-weight: 500;
			color: #00897b;
			font-size: 14px;
			margin-right: 10px;
		}
		
		ion-icon{
			margin-right: 8px;
			height: 20px;
			width: 20px;
		}
	</style>
</head>
<body>
<?php
	$matuyen = $_REQUEST['matuyen'];
	$matuyen2 = $_REQUEST['matuyen2'];
	$matuyen1 = $_REQUEST['matuyen1'];
	$xuatphat = $_REQUEST['xp'];
	$ketthuc = $_REQUEST['kt'];
	if ($matuyen != "")
	{
	?>
<div class="tab-map">
    <div class="tab">
        <div class="tab-heading">
            <div class="back">
			<a style="text-decoration: none" href="formTimDuongTraCuu.php">
                <i class="back__icon ti-arrow-left"></i>
			</a>
            </div>
            <div class="route">
                <span class="route__text">Tuyến <?php echo $matuyen ?> </span>
            </div>
        </div>
        <div class="tabs">
            <div class="tabs-item tab-item active">
                Chi tiết cách đi
            </div>
            <div class="tabs-item tab-item">
                Chi tiết trạm đi qua
            </div>
            <div style="background-color: #00897b;" class="line"></div>
        </div>
            <!-- Content -->
        <div class="tab-content">
            <div class="tab-pane active">
                <?php
				if (($xuatphat!="") && ($ketthuc!=""))
				{					
					$sql4= "select tentram from danhsachtram where matram='".$xuatphat."'";
					$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
					while ($row4= mysqli_fetch_array($kq4))
					{								
						$tbd=$row4['tentram'];
					} ?>
					<ion-icon name="navigate-circle-outline"></ion-icon><?php echo "Sử dụng tuyến ".$matuyen." hết hành trình"."<br>"; ?> 
					
					<ion-icon name="bus-outline"></ion-icon><?php echo "Đón xe tại : ".$tbd."<br>"; ?>
				
				
					<?php
					$sql4= "select tentram from danhsachtram where matram='".$ketthuc."'";
					$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
					while ($row4= mysqli_fetch_array($kq4))
					{								
						$tkt=$row4['tentram'];
					}?>
					<ion-icon name="golf-outline"></ion-icon>Xuống xe tại : <?php echo "".$tkt."";?>
				<!-- Nội dụng tab 1 ghi vô đây -->
            </div>
            <div class="tab-pane">
			<?php
                $batdau=$xuatphat;
				$tramke=$xuatphat;
				//echo "<br>"."Danh sách các trạm đi qua là:"."<br>";
				$sql4= "select tentram from danhsachtram where matram='".$batdau."'";
				$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
				while ($row4=mysqli_fetch_array($kq4))
				{	?>							
					<ion-icon name="flag-outline"></ion-icon><?php echo $row4['tentram']."<br>";
				}
				while ($batdau != $ketthuc)
				{	
					$rs="select tramke from danhsachtramke where matram='".$batdau."' and matuyen='".$matuyen."'";
					$kqrs= mysqli_query($conn,$rs);
					while ($rowrs= mysqli_fetch_array($kqrs))
					{
						$batdau=$rowrs['tramke'];
					}
					$sql4= "select tentram from danhsachtram where matram='".$batdau."'";
					$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
					while ($row4= mysqli_fetch_array($kq4))
					{ ?>								
						<ion-icon name="flag-outline"></ion-icon><?php echo $row4['tentram']."<br>";
					}
				}
			?>
				<!-- Nội dụng tab 2 ghi vô đây -->
            </div>
        </div>
		<?php
	}
		else
			echo "Sai rồi bạn ơi!!";
	}
	else
		if ($matuyen == "" && $matuyen1 != "" && $matuyen2 !="")
		{
		?>

<div class="tab-map">
    <div class="tab">
        <div class="tab-heading">
            <div class="back">
			<a style="text-decoration: none" href="formTimDuongTraCuu.php">
                <i class="back__icon ti-arrow-left"></i>
			</a>
            </div>
            <div class="route">
                <span class="route__text">Tuyến đi <?php echo "".$matuyen1.", ".$matuyen2."" ?> </span>
            </div>
        </div>
        <div class="tabs">
            <div class="tabs-item tab-item active">
                Chi tiết cách đi
            </div>
            <div class="tabs-item tab-item">
                Chi tiết trạm đi qua
            </div>
            <!-- line là cái gạch chạy phía dưới title -->
            <div style="background-color: #00897b;" class="line"></div>
        </div>
            <!-- Content -->
        <div class="tab-content">
            <div class="tab-pane active">
                <?php
				if (($xuatphat!="") && ($ketthuc!=""))
				{
					$sql4= "select tentram from danhsachtram where matram='".$xuatphat."'";
					$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
					while ($row4= mysqli_fetch_array($kq4))
					{								
						$tbd=$row4['tentram'];
					}
					?><ion-icon name="navigate-circle-outline"></ion-icon><?php echo "Sử dụng tuyến ".$matuyen." hết hành trình"."<br>";
					?><ion-icon name="bus-outline"></ion-icon><?php echo "Đón xe tại : ".$tbd."<br>";
					?><ion-icon name="flag-outline"></ion-icon><?php echo "Bạn có thể xuống ở các trạm dưới đây để chuyển từ ".$matuyen1." sang tuyến ".$matuyen2."<br>";
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
								echo "<br>"; ?><ion-icon name="walk-outline"></ion-icon><?php echo $row4['tentram'];
							}
						}
					}
					$sql4= "select tentram from danhsachtram where matram='".$ketthuc."'";
					$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
					while ($row4= mysqli_fetch_array($kq4))
					{								
						$tbd=$row4['tentram'];
					}
					echo "</br></br>";?><ion-icon name="golf-outline"></ion-icon><?php echo "Xuống xe tại : ".$tbd."";?>
				<!-- Nội dụng tab 1 ghi vô đây -->
            </div>
            <div class="tab-pane">
			<?php
                $batdau=$xuatphat;
				$tramke=$xuatphat;
				?><ion-icon name="trail-sign-outline"></ion-icon><?php echo "Danh sách các trạm đi qua là:"."<br>";
				$sql4= "select tentram from danhsachtram where matram='".$batdau."'";
				$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
				while ($row4=mysqli_fetch_array($kq4))
				{								
					?><ion-icon name="flag-outline"></ion-icon><?php echo $row4['tentram']."<br>";
				}
				while ($batdau != $ketthuc)
				{	
					$rs="select distinct tramke from danhsachtramke where matram ='".$batdau."'and (matuyen='".$matuyen1."'or matuyen='".$matuyen2."')";
					$kqrs= mysqli_query($conn,$rs) or die ("không thực hiện được câu lệnh");
					while ($rowrs= mysqli_fetch_array($kqrs))
						{$batdau=$rowrs['tramke'];}
					$sql4= "select tentram from danhsachtram where matram='".$batdau."'";
					$kq4= mysqli_query($conn,$sql4)or die ("không thực hiện được câu lệnh");
					while ($row4= mysqli_fetch_array($kq4))
					{				
						?><ion-icon name="flag-outline"></ion-icon><?php echo $row4['tentram']."<br>";
					}
				}
			?>
				<!-- Nội dụng tab 2 ghi vô đây -->
            </div>
        </div>
		<?php
			}
				else
					echo "Sai rồi bạn ơi!!";
		}
		?>
    </div>
    <div class="google-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d52085.82053445098!2d108.83165752902532!3d14.000112291067511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1637656705057!5m2!1svi!2s" width="1000" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
</div>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    // Để biến $ thay thế phải gõ lại chuỗi document.querySelector.bind(document);
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    // Lấy ra những tg có class=
    const tabs = $$(".tab-item");
    const panes = $$(".tab-pane");

    const tabsSub = $$(".tabsub-item");
    const panesSub = $$(".tabsub-pane");

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

    tabsSub.forEach((tab, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const paneSub = panesSub[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tab.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tabsub-item.active").classList.remove("active");
        $(".tabsub-pane.active").classList.remove("active");

        this.classList.add("active");
        paneSub.classList.add("active");
        };
    });

</script>
</body>
</html>
        