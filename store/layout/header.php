<!DOCTYPE html>
    <header>
<html lang="en">
<?php
require_once('../database/config.php');
require_once('../database/dbhelper.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/details.css">
    <link rel="stylesheet" href="../css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title>Vie's House</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="container">
                <section class="logo">
                    <a href="../homepage/index.php"><img src="../images/logo.jpg"></a>
                </section>
                <nav>
                    <ul>
                        <li><a href="../homepage/index.php">Trang chủ</a></li>
                        <li class="nav-cha">
                            <a href="../homepage/menu.php?page=thucdon">Thực đơn</a>
                            <ul class="nav-con">
                                <?php
                                $sql = "SELECT * FROM category";
                                $result = executeResult($sql);
                                foreach ($result as $item) {
                                    echo '<li><a href="../homepage/menu.php?id_category=' . $item['id'] . '">' . $item['name'] . '</a></li>';
                                }
                                ?>
                                <!-- <li><a href="menu.php?page=trasua">Trà sữa</a></li>
                                <li><a href="menu.php?page=monannhe">Món ăn nhẹ</a></li>
                                <li><a href="menu.php?page=banhmi">Bánh mì</a></li>
                                <li><a href="menu.php?page=caphe">Cà phê</a></li> -->
                            </ul>
                        </li>
                        <li><a href="../homepage/about.php">Về chúng tôi</a></li>
                        <li><a href="../homepage/sendMail.php">Liên hệ</a></li>
                    </ul>
                </nav>
                <section class="menu-right">
                    <div class="cart">
                        <a href="../cart/cart.php"><img src="../images/icon/cart.svg" alt=""></a>
                        <?php
                        $cart = [];
                        if (isset($_COOKIE['cart'])) {
                            $json = $_COOKIE['cart'];
                            $cart = json_decode($json, true);
                        }
                        $count = 0;
                        foreach ($cart as $item) {
                            $count += $item['num']; // đếm tổng số item
                        }
                        ?>
                        <span><?= $count ?></span>
                        <!-- <div class="history">
                            <a href="history.php"><i class="fas fa-history" style="font-size: 14px;"></i>Lịch sử</a>
                        </div> -->
                    </div>
                    <div class="login">
                        <?php
                        if (isset($_COOKIE['username'])) {
                            $username=$_COOKIE['username'];
                            if ($username == 'adminquan'|| $username == 'admin') {
                                echo '<a style="color:black;" href="">' . $_COOKIE['username'] . '</a>
                                <div class="logout">
                                    <a href="../admin/"><i class="fas fa-user-edit"></i>Admin</a> <br>
                                    <a href="../account/logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                                </div>';
                            }
                            else{
                                echo '<a style="color:black;" href="">' . $_COOKIE['username'] . '</a>
                            <div class="logout">
                                <a href="../account/changePass.php"><i class="fas fa-exchange-alt"></i>Đổi mật khẩu</a> <br>
                                <a href="../account/logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                            </div>
                            ';
                            }
                        } 
                        else {
                            echo '<a href="../account/login.php">Đăng nhập</a>';
                        }

                        ?>
                    </div>
                </section>
            </div>
        </header>
    </div>
</body>
</html>