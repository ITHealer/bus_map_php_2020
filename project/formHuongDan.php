<?php
	require 'site.php';
	load_top();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Hướng dẫn</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/grid.css">
    <link rel="stylesheet" href="style/css/style.css">
    <link rel="stylesheet" href="style/css/huongdan.css">
</head>
<body>
<div class="introduce-container">
        <img src="style/img/infoHD.jpg" alt="Image">        
        <div class="wrapper">
        </br></br></br></br>
            <img src="style/img/Baivietphobien.jpg" alt="Image">        
        </br></br></br></br>
        </div>

        <h1 class="big-title">Khám phá theo chủ đề</h1>
        <div class="list-topic">
            <div class="content-intro">
                <img class="" src="style/img/GroupHouse.webp" alt="Image">
                <a class="item-intro" href="formHuongDanTongQuan.php">
                    <div class="des-intro">
                        <h3 class="title-2">Tổng quan</h3>
                        <div class="desc">
                            <p>Các hướng dẫn tổng quan về ứng dụng bao gồm đăng ký, đăng nhập, cài đặt khu vực sẽ giúp bạn có trải nghiệm tốt nhất cùng ứng dụng tại thành phố bạn đang sống.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="content-intro2">
                <img class="" src="style/img/GroupTD.png" alt="Image">
                <a class="item-intro" href="formHuongDanTimDuong.php">
                    <div class="des-intro">
                        <h3 class="title-2">Tìm đường</h3>
                        <div class="desc">
                            <p>Chúng tôi sẽ gợi ý và chỉ dẫn bạn di chuyển giữa hai địa điểm khác nhau bằng xe buýt .</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="content-intro3">
                <img class="" src="style/img/GroupTraCuu.webp" alt="Image">
                <a class="item-intro" href="formHuongDanTraCuu.php">
                    <div class="des-intro">
                        <h3 class="title-2">Tra cứu tuyến xe</h3>
                        <div class="desc">
                            <p>Bạn có thể xem các thông tin chi tiết về chuyến xe mà mình quan tâm với tính năng tra cứu thông tin tuyến xe.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="content-intro4">
                <img class="" src="style/img/GroupKhac.webp" alt="Image">
                <a class="item-intro" href="formTinhNangBoSung.php">
                    <div class="des-intro">
                        <h3 class="title-2">Tính năng bổ sung</h3>
                        <div class="desc">
                            <p>BusMap còn bổ sung các tính năng khác để người dùng có những trải nghiệm tuyệt vời hơn như: xem thông tin danh sách các tuyến, xem tin tức, thanh toán nhanh bằng QR code...</p>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>

</body>
</html> 
<?php
	load_footer();
?>