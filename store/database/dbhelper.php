<?php
require_once('config.php');

if (!function_exists('execute')) {
    function execute($sql)
    {
        // Lưu dữ liệu vào bảng
        // Mở kết nối đến cơ sở dữ liệu
        $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        if (!$con) {
            die('Connection failed: ' . mysqli_connect_error());
        }
        // Thực hiện truy vấn insert, update, delete
        mysqli_query($con, $sql);

        // Đóng kết nối
        mysqli_close($con);
    }
}

if (!function_exists('executeResult')) {
    function executeResult($sql)
    {
        // Lưu dữ liệu vào bảng
        // Mở kết nối đến cơ sở dữ liệu
        $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        if (!$con) {
            die('Connection failed: ' . mysqli_connect_error());
        }
        // Thực hiện truy vấn insert, update, delete
        $result = mysqli_query($con, $sql);
        // Kiểm tra xem truy vấn có thành công không
        if (!$result) {
            die('Query failed: ' . mysqli_error($con));
        }
        $data   = [];
        while ($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }
        // Đóng kết nối
        mysqli_close($con);
        return $data;
    }
}

if (!function_exists('executeSingleResult')) {
    function executeSingleResult($sql)
    {
        // Lưu dữ liệu vào bảng
        // Mở kết nối đến cơ sở dữ liệu
        $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        if (!$con) {
            die('Connection failed: ' . mysqli_connect_error());
        }
        // Thực hiện truy vấn insert, update, delete
        $result = mysqli_query($con, $sql);
        $row    = mysqli_fetch_array($result, 1);

        // Đóng kết nối
        mysqli_close($con);

        return $row;
    }
}
?>
