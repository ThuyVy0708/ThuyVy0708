<?php
session_start();
require_once('../database/dbhelper.php');

// Kiểm tra nếu có yêu cầu lọc
if (isset($_GET['filterPermission'])) {
    $filterPermission = $_GET['filterPermission'];

    // Thực hiện truy vấn SQL với điều kiện lọc
    $sql = "SELECT * FROM user WHERE access = '$filterPermission'";
    $user = executeResult($sql);

    // Hiển thị dữ liệu kết quả
    foreach ($user as $item) {
        echo '<tr>
                <td>' . $item['id_user'] . '</td>
                <td>' . $item['fullname'] . '</td>
                <td>' . $item['sex'] . '</td>
                <td>' . $item['username'] . '</td>
                <td>' . $item['password'] . '</td>
                <td>' . $item['phone'] . '</td>
                <td>' . $item['email'] . '</td>
                <td>' . $item['access'] . '</td>
                <td>            
                    <button class="btn btn-danger" onclick="deleteUser(' . $item['id_user'] . ')">Xoá</button>
                    <a href="edit.php?id=' . $item['id_user'] . '" class="btn btn-warning">Edit</a>
                </td>
            </tr>';
    }

    // Dừng quá trình thực thi để không hiển thị nội dung HTML còn lại
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản Lý Người dùng</title>
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
        .filter-container {
            display: flex;
            align-items: center;
        }

        .filter-container label {
            margin-right: 10px;
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
                <a class="nav-link active" href="../user/index.php">Quản lý người dùng</a>
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
                <h2 class="text-center">Quản lý người dùng</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row add-user-btn">
                            <a href="../user/add.php">
                                <button class="btn btn-success">Thêm User</button>
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
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr style="font-weight: 500;">
                            <td width="70px">STT</td>
                            <td>Họ Tên</td>
                            <td>Giới Tính</td> 
                            <td>User Name</td>
                            <td>Password</td>
                            <td>Số Điện Thoại</td>
                            <td>Email</td> 
                            <td>
                                <div class="filter-container">
                                    <label for="filter-permissions">Quyền</label>
                                    <select id="filter-permissions" class="form-control">
                                        <option value="all">Tất cả</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    
                                </div>
                            </td>
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
                            $sql = "SELECT * FROM user limit $start,$limit";
                            executeResult($sql);
                            // $sql = 'select * from product limit $star,$limit';
                            $user = executeResult($sql);

                            $index = 1;
                            foreach ($user as $item) {
                                echo '  <tr>
                                <td>' . ($index++) . '</td>
                                <td>' . $item['fullname'] . '</td>
                                <td>' . $item['sex'] . '</td>
                                <td>' . $item['username'] . '</td>
                                <td>' . $item['password'] . '</td>
                                <td>' . $item['phone'] . '</td>
                                <td>' . $item['email'] . '</td>
                                <td>' . $item['access'] . '</td>
                        <td>            
                            <button class="btn btn-danger" onclick="deleteUser(' . $item['id_user'] . ')">Xoá</button>
                            <a href="edit.php?id=' . $item['id_user'] . '" class="btn btn-warning">Edit</a>
                        </td>
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
                $sql = "SELECT * FROM `user`";
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
        </div>
    </div>
    <script type="text/javascript">
	function deleteUser(id) {
	    var option = confirm('Bạn có chắc chắn muốn xoá người dùng này không?')
		if(!option) {
		    return;
		}
		console.log(id)
		$.post('ajax.php', {
		    'id': id,
		    'action': 'delete'
		}, function(data) {
		    location.reload()
		})
	}
         $(document).ready(function () {
            $('#filter-permissions').change(applyFilter);

            function applyFilter() {
                var filterPermission = $('#filter-permissions').val();

                // Gửi request để lấy dữ liệu với điều kiện lọc
                $.get('index.php', {
                    'filterPermission': filterPermission
                }, function (data) {
                    // Hiển thị dữ liệu mới trên trang
                    $('tbody').html(data);
                });

                if (filterPermission === 'all') {
                    // Nếu chọn "Tất cả", hiển thị tất cả các dòng
                    $('tbody tr').show();
                } else {
                    // Nếu chọn quyền cụ thể, ẩn những dòng không phù hợp
                    $('tbody tr').each(function () {
                        const row = $(this);
                        const permission = row.find('td:nth-child(8)').text(); // Chỉnh lại số cột tương ứng

                        if (permission === filterPermission) {
                            row.show();
                        } else {
                            row.hide();
                        }
                    });
                }
            }
        });
    </script>
</body>

</html>