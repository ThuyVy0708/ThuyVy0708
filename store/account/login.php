<?php
require_once('../database/config.php');
require_once('../database/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/header.css">

    <title>Đăng nhập</title>
</head>

<body>
    <div id="wrapper" style="padding-bottom: 4rem;">
        <header>
            <div class="container">
                <section class="logo">
                    <a href="../homepage/index.php"><img src="../images/logo-grabfood.svg" alt=""></a>
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
                                    <a href="changePass.php"><i class="fas fa-exchange-alt"></i>Đổi mật khẩu</a> <br>
                                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                                </div>
                            ';
                        } else {
                            echo '<a href="login.php"">Đăng nhập</a>';
                        }
                        ?>
                    </div>
                </section>
            </div>
        </header>
        <div class="container">
            <form action="login.php" method="POST">
                <h1 style="text-align: center;">Đăng nhập hệ thống</h1>
                <div class="form-group">
                    <label for="username">Tài khoản:</label>
                    <input type="text" name="username" class="form-control" placeholder="Tài khoản">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberPassword" name="rememberPassword">
                    <label class="form-check-label" for="rememberPassword">Ghi nhớ</label>
                </div>
                <div style="padding-top: 5px;" class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Đăng nhập">
                    <a href="forget.php" style="margin-top: 10px; margin-left: 10px;">Quên mật khẩu</a>
                    <p style="padding-top: 1rem;">Bạn chưa có tài khoản? <a href="reg.php">Đăng ký</a></p>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST["submit"]) && $_POST["username"] != '' && $_POST["password"] != '') {
        $username = $_POST["username"];
        $password = $_POST["password"];
        // $password = md5($password);
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
        execute($sql);
        $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        $user = mysqli_query($con, $sql);
        if (mysqli_num_rows($user) > 0) {
            echo '<script language="javascript">
                alert("Đăng nhập thành công!"); 
                window.location = "../homepage/index.php";
            </script>';
            $username = trim(strip_tags($_POST['username']));
            $password = trim(strip_tags($_POST['password']));
            session_start();
            setcookie("username", $username, time() + 30 * 24 * 60 * 60, '/');
            setcookie("password", $password, time() + 30 * 24 * 60 * 60, '/');
        } else {
            echo '<script language="javascript">
                alert("Tài khoản hoặc mật khẩu không chính xác !");
                window.location = "login.php";
             </script>';
        }
    }
    ?>
</body>

</html>
