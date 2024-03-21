<?php
require_once('database/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
    <title>Vie's House</title>
    <style>
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-left {
            display: flex;
            align-items: center;
        }

        .menu-right {
            display: flex;
            align-items: center;
        }

        .menu-right .login {
            position: relative;
            display: flex;
            align-items: center;
            padding: 7px;
            border: 1px solid rgb(196, 196, 196);
            border-radius: 3px;
            margin-left: 10px;
            background-color: #007bff; /* Background color for the button */
            cursor: pointer;
        }

        .menu-right .login a {
            padding: 8px;
            text-decoration: none;
            color: #ffffff; /* Text color for the button */
            font-weight: 500;
        }

        .menu-right .login .logout,
        .menu-right .login .change-pass {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            flex-direction: column;
            background-color: #fff;
            box-shadow: 0px 0px 3px 0px grey;
            padding: 10px;
            z-index: 10;
        }

        .menu-right .login:hover .logout,
        .menu-right .login:hover .change-pass {
            display: flex;
        }

        .menu-right .login .logout a,
        .menu-right .login .change-pass a {
            margin-bottom: 5px;
            color: #000000; /* Text color for the dropdown links */
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="nav-container">
        
        <section class="menu-right">
            <div class="login">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<a style="color:white;" href="">' . $_SESSION['username'] . '</a>
                            <div class="logout">
                                <a href="../account/changePass.php"><i class="fas fa-exchange-alt"></i>Đổi mật khẩu</a> <br>
                                <a href="../account/logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                            </div>
                            ';
                } else {
                    echo '<a href="../home/index.php">Đăng nhập</a>';
                }
                ?>
            </div>
        </section>
    </div>
</body>

</html>