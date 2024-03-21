<?php
session_start();
require_once '../database/connect.php';

if (isset($_GET["tukhoa"])) {
    $tukhoa = $_GET["tukhoa"];
    $tukhoa = mysqli_real_escape_string($conn, $tukhoa);

    $sql = "SELECT user.id_user, fullname, sex, username, password, phone, email, access
            FROM user
            WHERE fullname LIKE '%$tukhoa%' OR username LIKE '%$tukhoa%'";
    
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($rs) > 0) {
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .result-message {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table border="1">
        <caption class="caption_1">THÔNG TIN TÌM KIẾM NGƯỜI DÙNG</caption>
        <tr>
            <td colspan="8">
                <?php echo "Tìm thấy thông tin " . mysqli_num_rows($rs) . " người dùng"?>
            </td>
        </tr>
        <tr style="font-weight: bold; background-color: #f2f2f2;">
            <td width="70px">STT</td>
            <td>Họ Tên</td>
            <td>Giới Tính</td> 
            <td>User Name</td>
            <td>Password</td>
            <td>Số Điện Thoại</td>
            <td>Email</td> 
            <td>Quyền</td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($rs)) { ?>
            <tr>
                <td><?php echo $row["id_user"] ?></td>
                <td><?php echo $row["fullname"] ?></td>
                <td><?php echo $row["sex"] ?></td>
                <td><?php echo $row["username"] ?></td>
                <td><?php echo $row["password"] ?></td>
                <td><?php echo $row["phone"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td><?php echo $row["access"] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
    } else {
        echo "Không có dữ liệu người dùng nào";
    }
}
?>
