<?php
session_start();
require_once('../database/connect.php');

$error = NULL;

if (isset($_POST['submit'])) {
    if (empty($_POST['tk']) || empty($_POST['mk'])) {
        $error = "Vui lòng nhập tài khoản và mật khẩu";
    } else {
        $tk = $_POST['tk'];
        $mk = $_POST['mk'];

        // Use $conn from connect.php
        $sql = "SELECT * FROM user WHERE username='$tk' AND password='$mk'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $rows = mysqli_num_rows($query);

            if ($rows <= 0) {
                $error = 'Tài khoản hoặc mật khẩu chưa đúng';
            } else {
                $user = mysqli_fetch_assoc($query);

                // Kiểm tra quyền truy cập
                if ($user['access'] === 'admin') {
                    $_SESSION['tk'] = $tk;
                    $_SESSION['mk'] = $mk;
                    $_SESSION['username'] = $user['username']; // Set the username in the session
                    header('location: manage.php');
                    exit();
                } else {
                    $error = 'Bạn không có quyền truy cập';
                }
            }
        } else {
            $error = 'Error executing the query: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8" />
    <title>Vie's House- Đăng nhập hệ thống</title>
</head>
<body>
    <?php
    if (!isset($_SESSION['tk'])) {
    ?>
    <form method="post">
        <div id="form-login">
            <h2>Đăng nhập hệ thống quản trị</h2>
            <center><span style="color:red;"><?php echo $error;?></span></center>
            <ul>
                <li><label>Tài khoản</label><input type="text" name="tk" /></li>
                <li><label>Mật khẩu</label><input type="password" name="mk" /></li>
                <li><input type="checkbox" name="check" checked="checked" />Ghi nhớ</li>
                <li><input type="submit" name="submit" value="Đăng nhập" /> <input type="reset" name="resset" value="Làm mới" />                
                    <a href="forget.php" style="margin-top: 10px; margin-left: 10px;">Quên mật khẩu</a>
                </li>
            </ul>
        </div>
    </form>
    <?php
    } else {
        header('location: manage.php');
        exit();
    }
    ?>
</body>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        #form-login {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 350px;
            margin: 50px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        span {
            display: block;
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</html>
