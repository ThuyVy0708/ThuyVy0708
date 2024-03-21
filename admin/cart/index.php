<?php 
session_start();
require_once('../database/dbhelper.php'); 

function getStatusClass($status)
{
    switch ($status) {
        case 'Đang chuẩn bị':
            return 'orange';
        case 'Đã hủy':
            return 'red';
        case 'Đã nhận hàng':
            return 'green';
        case 'Đang giao':
            return 'blue';
        default:
            return '';
    }
}?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản lý giỏ hàng</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        .b-500 {
            font-weight: 500;
        }

        .red {
            color: red;
        }

        .green {
            color: green;
        }

        .orange {
            color: orange;
        }

        .blue {
            color: blue;
        }
        table {
            font-size: 20px;
        }
        .nav-link {
            font-size: 24px; /* Adjust the font size as needed */
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="../home/manage.php">Trang chủ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../statistics_list/index.php">Báo cáo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../statistics.php">Thống kê</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../category/index.php">Quản lý danh mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../product/index.php">Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../cart/index.php">Quản lý giỏ hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/index.php">Quản lý người dùng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../customer/index.php">Quản lý khách hàng</a>
            </li>
        </ul>
        <?php require_once('../header.php'); ?>
    </div>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản lý giỏ hàng</h2>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                        <div class="row add-user-btn">
                            <p>
                                <?php
                                if (!isset($_GET['page'])) {
                                    $pg = 1;
                                    echo 'Bạn đang ở trang: 1';
                                } else {
                                    $pg = $_GET['page'];
                                    echo 'Bạn đang ở trang: ' . $pg;
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                <form action="" method="POST">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr style="font-weight: 500;text-align: center;">
                                <td width="50px">STT</td>
                                <td width="200px">Tên khách hàng</td>
                                <td>Tên Sản Phẩm</td>
                                <td>Số lượng</td>
                                <td>Tổng tiền</td>
                                <td>Số điện thoại</td>
                                <td>Thời gian đặt</td>
                                <td>Trạng thái</td>
                                <!-- <td width="50px">Lưu</td> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $limit = 10;
                                $start = ($page - 1) * $limit;

                                $sql = "SELECT orders.*, order_details.*, product.title, product.price, customer.fullname as customer_fullname, customer.phone
                                FROM orders
                                INNER JOIN order_details ON order_details.order_id = orders.id
                                INNER JOIN product ON product.id = order_details.product_id
                                INNER JOIN customer ON customer.id = orders.id_customer
                                ORDER BY orders.order_date DESC LIMIT $start, $limit";
                            
                                $order_details_List = executeResult($sql);
                                $total = 0;
                                $count = 0;
                                // if (is_array($order_details_List) || is_object($order_details_List)){
                                foreach ($order_details_List as $item) {
                                $formattedPhone = '(+84) ' . (isset($item['phone']) ? $item['phone'] : '');
                                $totalPrice = $item['num'] * $item['price']; // Tính tổng tiền
                                    echo '
                                        <tr style="text-align: center;">
                                            <td width="50px">' . (++$count) . '</td>
                                            <td style="text-align:center">' . $item['customer_fullname'] . '</td>
                                            <td>' . $item['title'] . '</td>
                                            <td> <strong>' . $item['num'] . '</strong></td>
                                            <td class="b-500 red">' . number_format($totalPrice, 0, ',', '.') . '<span> VNĐ</span></td>
                                            <td width="150px">' . $formattedPhone . '</td>
                                            <td width="120px">' . date('Y-m-d', strtotime($item['order_date'])) . '</td>
                                            <td width="100px" class="' . getStatusClass($item['status']) . '">' . $item['status'] . '</td>
                                            <td width="100px">
                                                <a href="edit.php?order_id=' . $item['order_id'] . '" class="btn btn-success">Sửa</a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            } catch (Exception $e) {
                                die("Lỗi thực thi sql: " . $e->getMessage());
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <ul class="pagination">
                <?php
                $order = 'DESC'; // Mặc định sắp xếp theo thời gian đặt giảm dần
                if (isset($_GET['sort']) && $_GET['sort'] == 'date') {
                    $order = 'ASC'; // Nếu người dùng chọn sắp xếp theo thời gian tăng dần
                }
                $sql = "SELECT * from orders, order_details, product, customer
                where order_details.order_id=orders.id and product.id=order_details.product_id and orders.id_customer = customer.id";
                $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                $result = mysqli_query($conn, $sql);
                $current_page = 0;
                if (mysqli_num_rows($result)) {
                    $numrow = mysqli_num_rows($result);
                    $current_page = ceil($numrow / 10);
                }
                for ($i = 1; $i <= $current_page; $i++) {
                    // Nếu là trang hiện tại thì hiển thị thẻ span
                    // ngược lại hiển thị thẻ a
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>