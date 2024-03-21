<?php
require_once '../database/connect.php';

if (isset($_GET["tukhoa"])) {
    $tukhoa = $_GET["tukhoa"];
    $tukhoa = mysqli_real_escape_string($conn, $tukhoa);

    $sql = "SELECT product.id, title, price, thumbnail, number, content, category.name as category_name
            FROM product 
            JOIN category ON product.id_category = category.id 
            WHERE title LIKE '%$tukhoa%' OR product.id LIKE '%$tukhoa%'";
    
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($rs) > 0) {
        ?>
        <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
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

                img {
                    max-width: 50px;
                    height: auto;
                }

                .result-message {
                    margin-top: 10px;
                    font-weight: bold;
                }
            </style>
            <link rel="stylesheet" href="CSS/style.css" type="text/css"/>
        </head>
        <body>
        <table border="1">
            <caption class="caption_1">DANH SÁCH SẢN PHẨM</caption>
            <tr>
                <td colspan="7">
                    <?php echo "Tìm thấy thông tin " . mysqli_num_rows($rs) . " sản phẩm"?>
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Hình Ảnh</th>
                <th>TÊN SẢN PHẨM</th>                
                <th>GIÁ</th>
                <th>SỐ LƯỢNG</th>
                <th>NỘI DUNG</th>
                <th>LOẠI SẢN PHẨM</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($rs)) { ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td>
                        <img src="<?php echo $row["thumbnail"] ?>" alt="Thumbnail" style="width: 50px">
                    </td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["price"] ?></td>
                    <td><?php echo $row["number"] ?></td>
                    <td><?php echo $row["content"] ?></td>
                    <td><?php echo $row["category_name"] ?></td>
                </tr>
            <?php } ?>
        </table>
        </body>
        </html>
        <?php
    } else {
        echo "Không có dữ liệu sản phẩm nào";
    }
}
?>
