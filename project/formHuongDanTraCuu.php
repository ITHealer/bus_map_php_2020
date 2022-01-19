<?php
	require 'site.php';
	load_top();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Hướng dẫn tra cứu</title>
    <link rel="stylesheet" href="style/css/style.css">
    <link rel="stylesheet" href="style/css/huongdan.css">
</head>
<body>
    <div class="introduce-container">
        <img src="style/img/imageHDTraCuu.jpg" alt="Image">        
        <h1>Tra cứu thông tin tuyến xe</h1>
        
        <div class="rich-text">
            <p>Bạn có thể xem các thông tin chi tiết về chuyến xe mà mình quan tâm với tính năng tra cứu thông tin tuyến xe.</p>
            <p>
                <strong>Các bước thực hiện:</strong><br>
                <strong>Bước 1:</strong> Tại màn hình trang index của ứng dụng, chọn “Đăng nhập”
            </p>
            <p>
                <img class="img-intro" src="style/img/B1HDDN.jpg" alt="Image">
                <strong>Bước 2:</strong> Chọn tuyến xe mà bạn muốn tra cứu thông tin. Bạn có thể cuộn theo danh sách hoặc tìm nhanh bằng cách gõ tên tuyến ở thanh tìm kiếm.
            </p>
            <p>
                <img class="img-intro" src="style/img/B2HDTC.png" alt="Image">
            </p>
            <p>Các thông tin hiển thị bao gồm:</p>
            <p>+ <strong>Tên và lộ trình tuyến:</strong> hiển thị tên tuyến và điểm đầu-điểm cuối của tuyến xe</p>
            <p>+ <strong>Độ dài tuyến:</strong> hiển thị độ dài quãng đường từ điểm đầu-điểm cuối của tuyến xe</p>
            <p>+ <strong>Biểu đồ giờ:</strong> hiển thị giờ xuất bến của các chuyến xe trong ngày</p>
            <p>+ <strong>Trạm dừng:</strong> hiển thị tên các trạm dừng xe buýt theo đúng thứ tự trong lộ trình của tuyến</p>
            <p>+ <strong>Giá vé:</strong> cho biết tuyến xe có giá tiền của mỗi lượt di chuyển</p>
            <p>+ <strong>Thời gian chạy:</strong> hiển thị giờ xuất phát và giờ ngừng hoạt động của xe</p>
            <p>+ <strong>Giãn cách tuyến:</strong> hiển thị tần suất hoạt động của xe</p>
            <p>+<strong> Số xe chạy trên tuyến:</strong> hiển thị tổng số xe hoạt động trong ngày của tuyến</p>
            <p>+ <strong>Đánh giá:</strong> hiển thị nhận xét về chất lượng của xe buýt và dịch vụ từ chính các hành khách đã sử dụng tuyến xe.</p>
            <img class="img-intro" src="style/img/B3HDTraCuu.png" alt="Image">
        </div>
        <div class="download-intro">
            <img src="style/img/footerHD.jpg" alt="Image">
        </div>
    </div>

</body>
</html> 
<?php
	load_footer();
?>