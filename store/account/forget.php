<?php require('connect.php') ?>
<?php
require_once('../database/dbhelper.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="container">
                <section class="logo">
                    <a href="../homepage/index.php"><img src="../images/logo-grabfood.png" alt=""></a>
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
                    </div>
                    <div class="login">
                        <?php
                        if (isset($_COOKIE['username'])) {
                            echo '<a style="color:black;" href="">' . $_COOKIE['username'] . '</a>
                            <div class="logout">
                                <a href="account/changePass.php"><i class="fas fa-exchange-alt"></i>Đổi mật khẩu</a> <br>
                                <a href="account/logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                            </div>
                            ';
                        } else {
                            echo '<a href="../account/login.php"">Đăng nhập</a>';
                        }

                        ?>


                    </div>
                </section>
            </div>
        </header>
        <h2 style="text-align: center;">Quên mật khẩu</h2>
        <div class="container">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Tên của bạn:</label>
                    <input class="form-control" type="text" name="name" required="required" />
                </div>
                <div class="form-group">
                    <label>Gmail của bạn:</label>
                    <input class="form-control" type="email" name="email" required="required" />
                </div>
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input class="form-control" type="text" name="subject" required="required" />
                </div>
                <div class="form-group">
                    <label>Lý do:</label>
                    <textarea class="form-control" name="message" id="" cols="30" rows="4"></textarea>
                </div>
                <button name="send" class="btn btn-primary">Gửi</button>
                <?php
                $previous = "javascript:history.go(-1)";
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $previous = $_SERVER['HTTP_REFERER'];
                }
                ?>
                <a href="<?= $previous ?>" class="btn btn-warning">Quay lại</a>
            </form>
        </div>
    </div>
</body>

</html>