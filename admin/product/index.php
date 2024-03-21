<?php
session_start();
require_once('../database/dbhelper.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản Lý Sản Phẩm</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScrseipt -->
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
                <a class="nav-link" href="../category/index.php">Quản lý danh mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../product/index.php">Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../cart/index.php">Quản lý giỏ hàng</a>
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
                <h2 class="text-center">Quản lý Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row add-user-btn">
                            <a href="add.php">
                                <button class="btn btn-success">Thêm Sản Phẩm</button>
                            </a>
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
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="font-weight: 500;">
                        <td width="70px">STT</td>
                        <td>Hình Ảnh</td>
                        <td>Tên Sản Phẩm</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Nội dung</td>
                        <td>Loại Sản Phẩm</td>
                        <td width="50px"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lấy danh sách Sản Phẩm
                    try {

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $limit = 5;
                        $start = ($page - 1) * $limit;
                        $sql = "SELECT product.*, category.name as category_name FROM product JOIN category ON product.id_category = category.id limit $start,$limit";
                        executeResult($sql);
                        // $sql = 'select * from product limit $star,$limit';
                        $productList = executeResult($sql);

                        $index = 1;
                        foreach ($productList as $item) {
                            echo '  <tr>
                                <td>' . ($index++) . '</td>
                                <td style="text-align:center">
                                    <img src="' . $item['thumbnail'] . '" alt="" style="width: 50px">
                                </td>
                                <td>' . $item['title'] . '</td>
                                <td>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</td>
                                <td>' . $item['number'] . '</td>
                                <td>' . $item['content'] . '</td>
                                <td>' . $item['category_name'] . '</td>    
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-danger" onclick="deleteProduct(' . $item['id'] . ')">Xoá</button>
                                        </div>
                                        <div class="col">
                                            <a href="change.php?id=' . $item['id'] . '">
                                                <button class="btn btn-success">Sửa</button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }
                    } catch (Exception $e) {
                        die("Lỗi thực thi sql: " . $e->getMessage());
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <ul class="pagination">
            <?php
            $sql = "SELECT * FROM `product`";
            $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {
                $numrow = mysqli_num_rows($result);
                $current_page = ceil($numrow / 5);
                // echo $current_page;
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
    <script type="text/javascript">
        function deleteProduct(id) {
            var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
            if (!option) {
                return;
            }

            console.log(id)
            //ajax - lenh post
            $.post('delete.php', {
                'id': id,
                'action': 'delete'
            }, function(data) {
                location.reload()
            })
        }
    </script>
</body>

</html>