<?php
require_once '../database/connect.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    settype($id, "int");

    if ($id > 0) {
        $sql_select = "SELECT * FROM user WHERE id_user = $id";
        $rs = mysqli_query($conn, $sql_select) or die(mysqli_error($conn));
        $item = mysqli_fetch_assoc($rs);

        if (isset($_POST["btnsubmit"])) {
            $fullname = $_POST["fullname"];
            $sex = $_POST["sex"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $access = $_POST["access"];

            $fullname = mysqli_real_escape_string($conn, $fullname);
            $sex = mysqli_real_escape_string($conn, $sex);
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            $phone = mysqli_real_escape_string($conn, $phone);
            $email = mysqli_real_escape_string($conn, $email);
            $access = mysqli_real_escape_string($conn, $access);

            $sql_update = "UPDATE user SET 
                fullname='$fullname', 
                sex='$sex', 
                username='$username', 
                password='$password', 
                phone='$phone', 
                email='$email', 
                access='$access' 
                WHERE id_user=$id";

            mysqli_query($conn, $sql_update) or die(mysqli_error($conn));

            // Redirect to the index page after updating
            header("location:index.php");
        }

        ob_start(); // Create a new output buffer
        ?>
        <!DOCTYPE html>
        <html lang="en">

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
            <meta charset="UTF-8">
            <title>Edit User</title>
            <style>
                body {
                    font-size: 18px;
                }

                table {
                    width: 50%;
                    margin: 20px auto;
                    border-collapse: collapse;
                }

                table, th, td {
                    border: 1px solid #ddd;
                }

                th, td {
                    padding: 12px;
                    text-align: left;
                }

                input[type="text"] {
                    width: 100%;
                    padding: 8px;
                    margin: 5px 0;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                    font-size: 16px;
                }

                input[type="reset"], input[type="submit"] {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }

                input[type="reset"] {
                    background-color: #f44336;
                    margin-right: 10px;
                }

                /* Center-align the buttons */
                td[colspan="2"] {
                    text-align: center;
                }
            </style>
        </head>

        <body>
            <form name="frm_capnhat" method="post">
                <table>
                    <h2 style="text-align: center;">Cập nhật thông tin người dùng</h2>
                    <tr>
                        <td>Họ Tên</td>
                        <td><input type="text" name="fullname" value="<?php echo $item['fullname']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Giới Tính</td>
                        <td><input type="text" name="sex" value="<?php echo $item['sex']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td><input type="text" name="username" value="<?php echo $item['username']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="text" name="password" value="<?php echo $item['password']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Số Điện Thoại</td>
                        <td><input type="text" name="phone" value="<?php echo $item['phone']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?php echo $item['email']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Quyền</td>
                        <td><input type="text" name="access" value="<?php echo $item['access']; ?>" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="reset" value="Làm lại" name="btnreset" />
                            <input type="submit" value="Lưu" name="btnsubmit" />
                        </td>
                    </tr>
                </table>
            </form>
        </body>

        </html>
        <?php
        $output = ob_get_clean();
        echo $output;
    }
}
?>
