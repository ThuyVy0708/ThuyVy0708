<?php
    session_start();
    require_once('../database/dbhelper.php');
    if(isset($_SESSION['tk'])) {
        $username = $_SESSION['tk'];
    } else {
        header('location: index.php');
        exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Trang chủ</title>
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
        .p {
            font-size: 25px;
            line-height: 1.6;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="manage.php">Trang chủ</a>
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
                <a class="nav-link" href="../product/index.php">Quản lý sản phẩm</a>
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
    <div>
        <!-- Introduction Information -->
        <h2>Vie's House - Trà sữa và đồ ăn vặt ngon ở Sài Gòn</h2>
        <br></br>
        <p class="p">Vie's House là một quán trà sữa và đồ ăn vặt nhỏ nằm ở quận 12, thành phố Hồ Chí Minh.</p>
        <p class="p">Vie's House nổi tiếng với những món trà sữa thơm ngon, được làm từ những nguyên liệu tươi ngon và chất lượng. Quán có nhiều loại trà sữa khác nhau, từ trà sữa truyền thống đến trà sữa hiện đại, đáp ứng nhu cầu của mọi khách hàng.</p>
        <p class="p">Ngoài trà sữa, Vie's House còn phục vụ nhiều đồ ăn và thức uống hấp dẫn khác, như bánh ngọt, cafe, bánh mì,... Những thức ăn, đồ uống ở đây đều được chế biến theo công thức riêng của quán, đảm bảo thơm ngon và chất lượng.</p>
        <p class="p">Không gian của Vie's House tuy nhỏ nhưng được trang trí xinh xắn, ấm cúng. Quán có chỗ ngồi cả trong nhà và ngoài trời, phù hợp với mọi nhu cầu của khách hàng.</p>
        <p class="p">Nếu bạn đang tìm kiếm một quán trà sữa và đồ ăn vặt ngon ở Sài Gòn, thì Vie's House là một lựa chọn tuyệt vời.</p>
    </div>
    <div id="wrapper">
        <?php
        if(isset($username)) {
            echo "<p><span></span></p>";
        } else {
            echo "<p><a href='index.php'>Đăng nhập</a></p>";
        }
        ?>
    </div>
</body>
</html>
