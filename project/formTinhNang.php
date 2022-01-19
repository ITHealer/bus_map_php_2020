<?php
	require 'site.php';
	load_top();
	load_header();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Tính năng</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/grid.css">
    <link rel="stylesheet" href="style/css/style.css">
	<link rel="stylesheet" href="style/css/styletinhnang.css">
</head>
<body>
<div class="vertical-container">
    <div class="grid wide">
        <div class="row about-us">
            <div class="col l-6 box-col">
                <div class="box-orange">
                    <div class="ti-server"></div>
                    <span class="box-orange-text">
                        Dữ liệu BusMap luôn được cập nhật thường xuyên và chính xác
                    </span>
                </div>
                <div class="box-blue">
                    <div class="ti-face-smile"></div>
                    <span class="box-blue-text">
                        Giao diện thân thiện, dễ sử dụng
                    </span>
                </div>
                <div class="box-green">
                    <div class="ti-panel"></div>
                    <span class="box-green-text">
                        Nhiều tính năng hỗ trợ việc đi lại bằng xe buýt thuận tiện hơn
                    </span>
                </div>
            </div>
            <div class="col l-1"></div>
            <div class="col l-5">
                <div class="func-content">
                    <h1>BusMap Là Gì?</h1>
                    <img class="img-line" src="style/img/Line.svg" alt="Line">
                    <div class="text">
                        <p class="func-context">
                            Xe buýt ngày càng trở thành phương tiện công cộng phổ biến, mọi người được khuyến khích sử dụng xe buýt nhiều hơn vì độ an toàn và thân thiện với môi trường. Ở Bình Định có hơn 20 tuyến xe buýt khác nhau với hơn 500 điểm dừng. Vì vậy việc di chuyển bằng xe buýt là hết sức thuận tiện.
                        </p>
                        <p class="func-context">
                            Từ lí do đó, BusMap đã ra đời với mục đích sẽ giúp cho mọi người đi xe buýt tốt hơn và thuận tiện hơn.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="row func-container">
            <h2 class="title-func">Các tính năng</h2>
            <div class="col l-4 func-col-1">
                <div class="func-icon">
                    <div class="inner-circle">
                        <img class="func-iconsearch" src="style/img/Search-Icon-green.svg" alt="Search">
                    </div>
                    <h3 class="title-feature">Tìm đường thông minh</h3>
                    <p class="content-feature">
                        Chỉ dẫn cho người dùng những cách đi tốt nhất bằng xe buýt giữa 2 địa điểm bất kì
                    </p>
                </div>

                <div class="func-icon">
                    <div class="inner-circle">
                        <img class="func-iconsearch" src="style/img/Layer-Icon-green.svg" alt="Search">
                    </div>
                    <h3 class="title-feature">Cập nhật dữ liệu trực tuyến</h3>
                    <p class="content-feature">
                        Giúp ứng dụng luôn được chạy với dữ liệu xe buýt mới nhất của Bình Định
                    </p>
                </div>

                <div class="func-icon">
                    <div class="inner-circle">
                        <img class="func-iconsearch" src="style/img/Info-Icon-green.svg" alt="Search">
                    </div>
                    <h3 class="title-feature">Tra cứu thông tin</h3>
                    <p class="content-feature">
                        Tra cứu thông tin chi tiết của từng tuyến xe: biểu đồ giờ xuất bến, các trạm đi qua
                    </p>
                </div>
            </div>

            <div class="col l-4">
                <img class="img-feature" src="style/img/info_TraCuu.jpg" alt="Image">
            </div>

            <div class="col l-4 func-col-2">
                <div class="func-icon">
                    <div class="inner-circle">
                        <img class="func-iconsearch" src="style/img/Clock-Icon-green.svg" alt="Search">
                    </div>
                    <h3 class="title-feature">Xem thời gian chờ xe buýt</h3>
                    <p class="content-feature">
                        Xem thời gian xe buýt sẽ đến tại một trạm bất kì, dựa trên dữ liệu thời gian thực từ GPS của xe buýt
                    </p>
                </div>

                <div class="func-icon">
                    <div class="inner-circle">
                        <img class="func-iconsearch" src="style/img/Feedback-Icon-green.svg" alt="Search">
                    </div>
                    <h3 class="title-feature">Phản hồi ý kiến</h3>
                    <p class="content-feature">
                        Chức năng phản hồi ý kiến về chất lượng xe buýt cho Trung tâm Điều hành
                    </p>
                </div>

                <div class="func-icon">
                    <div class="inner-circle">
                        <img class="func-iconsearch" src="style/img/Bus-Icon-green.svg" alt="Search">
                    </div>
                    <h3 class="title-feature">Tìm trạm dừng</h3>
                    <p class="content-feature">
                        Tìm kiếm vị trí trạm dừng xe buýt gần vị trí người dùng hiện tại, hiển thị trực quan trên bản đồ
                    </p>
                </div>
            </div>
        </div>
        <!--  -->
        
        <!--  -->
    </div>
</div>

</body>
</html>

<?php
	load_footer();
?>