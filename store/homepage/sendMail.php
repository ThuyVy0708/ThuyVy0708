<?php session_start() ?>
<?php require_once('../layout/header.php'); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css"> <!-- Add this line -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/details.css">
    <link rel="stylesheet" href="../css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title>Vie's House</title>
</head>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
</head>
<style>

    form {
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;
    }

    .form-group {
        padding: 10px;
        width: 650px;
    }

    .form-group input {
        padding: 5px 0;
        width: 100%;
    }

    textarea {
        width: 100%;
    }

    button {
        padding: 10px 50px;
        border-radius: 5px;
        color: white;
        background-color: red;
        border: none;
        outline: 0;
    }

    button:hover {
        opacity: 0.7;
        cursor: pointer;
    }

    center {
        font-size: 20px;
        font-weight: bold;
        color: green;
        padding: 20px;
    }
</style>

<body>
    <h2 style="text-align: center;">Hãy liên hệ với chúng tôi nếu bạn gặp các vấn đề trên Website</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Tên của bạn:</label>
            <input type="text" name="name" required="required" />
        </div>
        <div class="form-group">
            <label>Gửi đến gmail:</label>
            <input type="email" name="email" required="required" />
        </div>
        <div class="form-group">
            <label>Tên Email</label>
            <input type="text" name="subject" required="required" />
        </div>
        <div class="form-group">
            <label>Nội dung email</label>
            <textarea name="message" id="" cols="30" rows="10"></textarea>
        </div>
        <button name="send"> Gửi</button>
    </form>
</body>
<?php require_once('../layout/footer.php'); ?>

</html>