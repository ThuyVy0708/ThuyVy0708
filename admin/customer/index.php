<?php
session_start();
require_once('../database/dbhelper.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản lý Khách hàng</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        .nav-link {
            font-size: 24px; /* Adjust the font size as needed */
        }

        /* Thêm CSS để cài đặt chữ kích thước lớn hơn cho bảng */
        table {
            font-size: 20px; /* Điều chỉnh kích thước chữ ở đây */
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
                <a class="nav-link" href="../cart/index.php">Quản lý giỏ hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/index.php">Quản lý người dùng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../customer/index.php">Quản lý khách hàng</a>
            </li>
        </ul>
        <?php require_once('../header.php'); ?>
    </div>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản lý thông tin khách hàng</h2>
            </div>
            <div class="panel-body">
                <div class="row">
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
                    <div class="col-md-6">
                        <form method="GET" action="search.php" class="search-form float-md-right">
                            <div class="form-row">
                                <div class="col search-input">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm..." name="tukhoa">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr style="text-align: center; color: black; font-weight: bold;">
                            <td width="70px">STT</td>
                            <td>Tên khách hàng</td>
                            <td>Giới tính</td>
                            <td>Số điện thoại</td>
                            <td>Địa chỉ</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Lấy danh sách danh mục
                        try {
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
                            $limit = 5;
                            $start = ($page - 1) * $limit;
                            $sql = "SELECT * FROM customer LIMIT $start, $limit";
                            $customerList = executeResult($sql);
                            $index = 1;
                            foreach ($customerList as $item) {
                                $formattedPhone = '(+84) ' . (isset($item['phone']) ? $item['phone'] : '');
                                echo '  
                                <tr style="text-align: center;">
                                <td width="50px">' . ($index++) . '</td>
                                <td style="text-align:center">' . $item['fullname'] . '</td>
                                <td>' . $item['sex'] . '</td>
                                <td width="200px">' . $formattedPhone . '</td>
                                <td>' . $item['address'] . '</td>                               
                                </tr>';
                            }
                        } catch (Exception $e) {
                            die("Lỗi thực thi sql: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
                <ul class="pagination">
                    <?php
                    $sql = "SELECT COUNT(*) as total FROM `customer`";
                    $totalRecords = executeSingleResult($sql)['total'];
                    $totalPages = ceil($totalRecords / $limit);
                    for ($i = 1; $i <= $totalPages; $i++) {
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
    </div>
</body>

</html>