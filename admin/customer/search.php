<?php
require_once '../database/connect.php';

// Default values for pagination
$start = 0;
$limit = 10; // Set an appropriate limit based on your requirement

if (isset($_GET["tukhoa"])) {
    $tukhoa = $_GET["tukhoa"];
    $tukhoa = mysqli_real_escape_string($conn, $tukhoa);

    $sql = "SELECT * FROM customer 
            WHERE id LIKE '%$tukhoa%' OR 
                  fullname LIKE '%$tukhoa%' COLLATE utf8_general_ci OR 
                  sex LIKE '%$tukhoa%' COLLATE utf8_general_ci OR 
                  phone LIKE '%$tukhoa%' OR 
                  address LIKE '%$tukhoa%' COLLATE utf8_general_ci 
            LIMIT $start, $limit";
    
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($rs) > 0) {
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Search Results</title>
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
        <caption class="caption_1">DANH SÁCH KHÁCH HÀNG</caption>
        <tr>
            <td colspan="5">
                <?php echo "Tìm thấy thông tin " . mysqli_num_rows($rs) . " khách hàng"?>
            </td>
        </tr>
        <tr style="font-weight: bold; background-color: #f2f2f2;">
            <td>ID</td>
            <td>FULLNAME</td>
            <td>SEX</td>
            <td>PHONE</td>
            <td>ADDRESS</td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($rs)) { ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["fullname"] ?></td>
                <td><?php echo $row["sex"] ?></td>
                <td><?php echo $row["phone"] ?></td>
                <td><?php echo $row["address"] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
    } else {
        echo "Không có dữ liệu khách hàng nào";
    }
}
?>
