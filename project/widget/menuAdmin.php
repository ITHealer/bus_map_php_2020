<?php 
	session_start();
	if (!isset($_SESSION['dn'])) {
		header('Location: formDangNhap.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css/styleAdmin.css">
<style>

</style>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="formAdminTrangChu.php">
                        <span class="icon"><ion-icon name="bus-outline"></ion-icon></span>
                        <span class="title main-title">BusMap</span>
                    </a>
                </li>

                <li>
                    <a href="formTrangChu.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Chức năng</span>
                    </a>
                </li>
				
				<!--
				<li>
                    <a href="formAdminTrangChu.php">
                        <span class="icon"><ion-icon name="stats-chart-outline"></ion-icon></span>
                        <span class="title">Thống kê</span>
                    </a>
                </li>
				-->
				
                <li>
                    <a href="formAdminQuanLyTuyen.php">
                        <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                        <span class="title">Quản lý tuyến</span>
                    </a>
                </li>

                <li>
                    <a href="formAdminQuanLyTram.php">
                        <span class="icon"><ion-icon name="trail-sign-outline"></ion-icon></span>
                        <span class="title">Quản lý trạm</span>
                    </a>
                </li>

                <li>
                    <a href="formQuanLyXe.php">
                        <span class="icon"><ion-icon name="subway-outline"></ion-icon></span>
                        <span class="title">Quản lý xe</span>
                    </a>
                </li>

                <li>
                    <a href="formQuanLyVe.php">
                        <span class="icon"><ion-icon name="ticket-outline"></ion-icon></span>
                        <span class="title">Quản lý vé</span>
                    </a>
                </li>
				
                <li>
                    <a href="formAdminQuanLyNguoiDung.php">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Người dùng</span>
                    </a>
                </li>

                <li>
                    <a href="formPhanHoi.php">
                        <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                        <span class="title">Phản hồi</span>
                    </a>
                </li>

                <li>
                    <a href="thoat.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <!-- search -->
                <div class="search">
                    <label for="">
                        <input type="text" name="" id="" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <!-- userImage -->
                <div class="user">
                    <img src="style/img/message.png" alt="ImageUser">
                </div>
            </div>

            <!-- cards -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Lượt truy cập</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Vé bán</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Bình luận</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$7,842</div>
                        <div class="cardName">Doanh thu</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        // MenuToggle; Khi click vào sẽ thu category lại;
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main')

        toggle.onclick = function(){
            navigation.classList.toggle('active'); 
            main.classList.toggle('active');
        }

        let list = document.querySelectorAll('.navigation li');
        function activeLink(){
            list.forEach((item) =>
                item.classList.remove('hovered'));
                this.classList.add('hovered');
        }

        list.forEach((item) =>
            item.addEventListener('mouseover', activeLink));
    </script>

