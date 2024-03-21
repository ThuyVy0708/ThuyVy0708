<?php
require_once('../database/dbhelper.php');
require_once('../buy/utility.php');
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
    <title>Lịch sử mua hàng</title>
</head>

<body>
    <div id="wrapper">
        <?php require('../layout/header.php') ?>
        <main>
            <section class="cart">
                <div class="container-top">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="padding: 1rem 0;">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="../cart/cart.php">Giỏ hàng</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link active" href="../cart/history.php">Lịch sử mua hàng</a>
                                </li>
                            </ul>
                            <h2 style="padding-top:2rem" class="">Lịch sử mua hàng</h2>
                        </div>
                        <div class="panel-body"></div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr style="font-weight: 500;text-align: center;">
                                    <td width="50px">STT</td>
                                    <td>Ảnh</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá</td>
                                    <td>Số lượng</td>
                                    <td>Tổng cộng</td>
                                    <td>Trạng thái</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_COOKIE['username'])) {
                                    $username = $_COOKIE['username'];

                                    // Get user ID
                                    $sql = "SELECT * FROM user WHERE username = '$username'";
                                    $user = executeResult($sql);
                                    $userId = $user[0]['id_user'];

                                    // Get order details for the user
                                    $sql = "SELECT od.*, p.title, p.thumbnail
                                            FROM order_details od
                                            JOIN product p ON od.product_id = p.id
                                            WHERE od.id_user = '$userId'
                                            ORDER BY od.order_id DESC";
                                    $order_details_List = executeResult($sql);

                                    $total = 0;
                                    $count = 0;

                                    foreach ($order_details_List as $item) {
                                        echo '
                                        <tr style="text-align: center;">
                                            <td width="50px">' . (++$count) . '</td>
                                            <td style="text-align:center">
                                                <img width="50px" src="../../admin/product/' . $item['thumbnail'] . '">
                                            </td>
                                            <td>' . $item['title'] . '</td>
                                            <td class="b-500 orange">' . number_format($item['price'], 0, ',', '.') . '<span> VNĐ</span></td>
                                            <td width="100px">' . $item['num'] . '</td>
                                            <td class="b-500 red">' . number_format($item['num'] * $item['price'], 0, ',', '.') . '<span> VNĐ</span></td>
                                            <td style="color:green; font-weight:600;">' . $item['status'] . '</td>
                                        </tr>
                                        ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
        <?php require_once('../layout/footer.php'); ?>
    </div>
</body>
<style>
    main {
        padding-bottom: 4rem;
    }

    .b-500,
    .bold {
        font-weight: 500;
    }

    .red {
        color: rgba(207, 16, 16, 0.815);
    }

    .orange {
        color: #a25437;
    }

    .clock {
        font-size: 18px;
    }
</style>

</html>
