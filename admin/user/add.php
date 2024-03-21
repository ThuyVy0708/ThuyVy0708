<?php
session_start();
require_once('../database/dbhelper.php');
$id = $fullname = $username = $password = $phone = $email = $sex = $id_user = $access = "";
if (!empty($_POST['fullname'])) {
    if (isset($_POST['fullname'])) {
        $fullname = $_POST['fullname'];
        $fullname = str_replace('"', '\\"', $fullname);
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $id = str_replace('"', '\\"', $id);
    }
    if (isset($_POST['username'])) {
        $username= $_POST['username'];
        $username= str_replace('"', '\\"', $username);
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $password = str_replace('"', '\\"', $password);
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // Dữ liệu gửi lên server không bằng phương thức post
        echo "Phải Post dữ liệu"; 
        die;
    }

    // Kiểm tra có dữ liệu thumbnail trong $_FILES không
    // Nếu không có thì dừng
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        $phone = str_replace('"', '\\"', $phone);
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $email = str_replace('"', '\\"', $email);
    }
    if (isset($_POST['sex'])) {
        $sex = $_POST['sex'];
        $sex = str_replace('"', '\\"', $sex);
    }
    if (isset($_POST['id_user'])) {
        $id_user = $_POST['id_user'];
        $id_user = str_replace('"', '\\"', $id_user);
    }
    if (isset($_POST['access'])) {
        $access = $_POST['access'];
        $access = str_replace('"', '\\"', $access);
    }
    if (!empty($fullname)) {
        $created_at = $updated_at = date('Y-m-d H:i:s');
        if ($id == '') {
            // Thêm danh mục
            $sql = "INSERT INTO user (fullname, username, password, phone, email, sex, id_user,access) VALUES ('$fullname', '$username', '$password', '$phone', '$email', '$sex', '$id_user','$access')";
        } 
    }
    execute($sql);
    header('Location: index.php');  
die();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select * from user where id=' . $id;
    $user = executeSingleResult($sql);
    if ($user != null) {
        $fullname = $user['fullname'];
        $username= $user['username'];
        $password = $user['password'];
        $phone = $user['phone'];
        $email = $user['email'];
        $sex = $user['sex'];
        $id_user = $user['id_user'];
        $access = $user['access'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- summernote -->
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
                <h2 class="text-center">Thêm thông tin người dùng</h2>
            </div>
            <div class="panel-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Họ tên người dùng:</label>
                        <input type="text" id="id" name="id" value="<?= $id ?>" hidden="true">
                        <input required="true" type="text" class="form-control" id="fullname" name="fullname" value="<?= $fullname ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Username:</label>
                        <input required="true" type="text" class="form-control" id="username" name="username" value="<?= $username?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Password:</label>
                        <input required="true" type="text" class="form-control" id="password" name="password" value="<?= $password ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Phone:</label>
                        <input required="true" type="number" class="form-control" id="phone" name="phone" value="<?= $phone ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input required="true" type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Giới tính:</label>
                        <input required="true" type="text" class="form-control" id="sex" name="sex" value="<?= $sex ?>">
                    </div>
                    <div class="form-group">
                        <label for="access">Quyền:</label>
                        <input type="text" class="form-control" id="access" name="access" value="<?= $access ?>">
                    </div>
                    <button class="btn btn-success">Lưu</button>
                    <?php
                    $previous = "javascript:history.go(-1)";
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        $previous = $_SERVER['HTTP_REFERER'];
                    }
                    ?>
                    <a href="<?= $previous ?>" class="btn btn-warning">Làm lại</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>