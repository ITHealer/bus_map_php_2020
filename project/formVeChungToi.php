<?php
	require 'site.php';
	load_topIntroduce();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusMap | Trang chủ</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style/css/grid.css">
    <link rel="stylesheet" href="style/css/style.css">
</head>
<body>
<div class="grid wide">
        <div class="row about-us">
            <div class="col l-6">
                <h1>Về chúng tôi</h1>
                <div class="about-us-img">
                    <img src="style/img/about-us.webp" alt="Image about us" class="img-about-us">
                </div>
            </div>
            
            <div class="col l-6">
                <div class="content">
                    <h1 class="text-heading">Quá trình hình thành</h1>
                    <div class="text">
                        <p class="content-about-us">
                            Xuất phát từ ứng dụng phi lợi nhuận, BusMap đặt mục tiêu mang đến giá trị thiết thực nhằm nâng cao chất lượng đời sống người dân. Với tinh thần đổi mới sáng tạo, trách nhiệm đối với xã hội cùng ý chí kiên định “Vì một tương lai thông minh hơn”.
                        </p>
                        <p class="content-about-us">
                            BusMap xem nguồn tri thức kết hợp với các công nghệ lõi là những giá trị trọng điểm để chúng tôi phát triển bền vững, từ đó mang lại chuỗi giải pháp toàn diện không chỉ dành cho nhà nước và doanh nghiệp Việt Nam mà còn hướng đến mối quan hệ hợp tác với các tổ chức ở phạm vi toàn cầu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
       
        <!--  -->
        <div class="row about-us">
            <div class="col l-12">
                <div id="band" class="content-section">
                    <h2 class="section-heading">Nhóm phát triển</h2>
                    
                    <div class="row members-list">
                        <div class="col col-3 modal-animation-1 text-center">
                            <p class="member-name">Ung Minh Hoài</p>
                            <img class="member-img" src="style/img/UMH.png" alt="Name">
                        </div>
                        <div class="col col-3 text-center">
                            <p class="member-name">Nguyễn Thị Thu Liễu</p>
                            <img class="member-img" src="style/img/NTTL.jpg" alt="Name">
                        </div>
                        <div class="col col-3 modal-animation-3 text-center">
                            <p class="member-name">Thái Bá Tường</p>
                            <img class="member-img" src="style/img/TBT.jpg" alt="Name">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="row about-us about-us-footer">
            <div class="col l-12 leader">
                <div class="row members-list">
                    <div class="col col-3 text-center">
                        <img class="member-img leader-img" src="style/img/UMH2.jpg" alt="Name">
                    </div>
                    <div class="col col-9 text-center">
                        <div class="leader-content">
                            <p>Chung tay xây dựng một thành phố thông minh giảm phát thải khí nhà kính. Đoàn kết vững tin phát triển. Đổi mới không ngừng vì một Việt Nam thông minh hơn.</p>
                            <p>"Chung tay - Đoàn kết - Đổi mới"</p>
                        <hr>
                            <p class="leader-title">Ung Minh Hoài</p>
                            <p>Leader</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--  -->

    </div>

</body>
</html>

<?php
	load_footer();
?>