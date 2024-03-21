<?php
    $hostname = "localhost";//địa chỉ mysql server sẽ kết nối đến
    $username = "root";//username để kết nối đến database
    $password = "";// mật khẩu để kết nối đến database
    $dbname = "banhang";//tên database sẽ kết nối đến
    $conn = mysqli_connect($hostname,$username,$password,$dbname);
    if(!$conn) {
        die ('Không thể kết nối: '). mysqli_error($conn);
        exita();
    }
    mysqli_query($conn,"set names 'utf8'");
?>