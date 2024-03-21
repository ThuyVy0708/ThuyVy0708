<?php require('../layout/header.php') ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css"> <!-- Add this line -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/details.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.sidebar_menu');
    const toggleBtn = document.querySelector('.toggle-sidebar-btn');
    const container = document.querySelector('.container');

    toggleBtn.addEventListener('click', function () {
        const isSidebarHidden = sidebar.style.left === '-250px';
        sidebar.style.left = isSidebarHidden ? '0' : '-250px';
    });

    // Đóng sidebar khi nhấn vào bên ngoài thanh side bar
    container.addEventListener('click', function (event) {
        if (event.target !== toggleBtn && !sidebar.contains(event.target)) {
            sidebar.style.left = '-250px';
        }
    });
});
</script>
    <title>Vie's House</title>
</head>
<main>
    <div class="container">
        <div id="ant-layout">
        <section class="search-quan">
                <i class="fas fa-search"></i>
                <form action="../homepage/menu.php" method="GET">
                    <input name="search" type="text" placeholder="Tìm món hoặc thức ăn">
                </form>
            </section>
        </div>
        <!-- END LAYOUT  -->
        <section class="main">
            <?php
            if (isset($_GET['page'])) {
                $page = trim(strip_tags($_GET['page']));
            } else {
                $page = "";
            }
            switch ($page) {
                case "menu":
                    require('../menu-con/trasua.php');
                    require('../menu-con/caphe.php');
                    require('../menu-con/monannhe.php');
                    require('../menu-con/banhmi.php');
                    break;
                default:
                    break;
            }
            //switch
            if (isset($_GET['id_category'])) {
                $id_category = trim(strip_tags($_GET['id_category']));
            } else {
                $id_category = 0;
            }
            ?>
            <section class="recently">
                <div class="title">
                    <?php
                    $sql = "select * from category where id=$id_category";
                    $name = executeResult($sql);
                    foreach ($name as $ten) {
                        echo '<h1>' . $ten['name'] . '</h1>';
                    }
                    ?>
                </div>
                <div class="product-recently">
                    <div class="row">
                        <?php
                        $sql = "select * from product where id_category=$id_category";
                        $productList = executeResult($sql);
                        foreach ($productList as $item) {
                            echo '
                                <div class="col">
                                    <a href="../cart/details.php?id=' . $item['id'] . '">
                                        <img class="thumbnail" src="../../admin/product/' . $item['thumbnail'] . '" alt="">
                                        <div class="title">
                                            <p>' . $item['title'] . '</p>
                                        </div>
                                        <div class="price">
                                            <span>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</span>
                                        </div>
                                        <div class="more">
                                            <div class="star">
                                                <img src="../images/icon/icon-star.svg" alt="">
                                                <span>4.6</span>
                                            </div>
                                            <div class="time">
                                                <img src="../images/icon/icon-clock.svg" alt="">
                                                <span>15 comment</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ';
                        }
                        ?>
                        <?php
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $sql = "SELECT * from product where title like '%$search%'";
                            $listSearch = executeResult($sql);
                            foreach ($listSearch as $item) {
                                echo '
                                <div class="col">
                                    <a href="../cart/details.php?id=' . $item['id'] . '">
                                        <img class="thumbnail" src="../../admin/product/' . $item['thumbnail'] . '" alt="">
                                        <div class="title">
                                            <p>' . $item['title'] . '</p>
                                        </div>
                                        <div class="price">
                                            <span>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</span>
                                        </div>
                                        <div class="more">
                                            <div class="star">
                                                <img src="../images/icon/icon-star.svg" alt="">
                                                <span>4.6</span>
                                            </div>
                                            <div class="time">
                                                <img src="../images/icon/icon-clock.svg" alt="">
                                                <span>15 comment</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <button class="toggle-sidebar-btn"><span class="fas fa-bars"></span></button>
                        <aside class="sidebar_menu">
                            <ul class="hidden-sm hidden-xs">
                                <li>
                                    <a class="menu_scroll_link view_all active"
                                        href="../homepage/menu.php">Tất Cả</a>
                                </li>
                                <li>
                                    <a class="menu_scroll_link "
                                        href="/LTW/store/homepage/menu.php?id_category=4">Cà Phê</a>                                            
                                </li>

                                <li>
                                    <a class="menu_scroll_link" 
                                       href="/LTW/store/homepage/menu.php?id_category=1">Trà sữa</a>                                      
                                </li>

                                <li>
                                    <a class="menu_scroll_link "
                                       href="/LTW/store/homepage/menu.php?id_category=3">Bánh mì</a>                                           
                                </li>

                                <li>
                                    <a class="menu_scroll_link "
                                        href="/LTW/store/homepage/menu.php?id_category=2">Món ăn nhẹ</a>                                            
                                </li>
                            </ul>
                        </aside>
                </div>
                </div>
            </section>
        </section>
    </div>
    <style>
        section.main section.recently .title h1 {
            border-bottom: 1px solid rgb(35, 54, 30);
        }
        .sidebar_menu {
    width: 250px;
    height: 100%;
    position: fixed;
    top: 0;
    left: -250px;
    background-color: #f4f4f4;
    transition: left 0.3s ease-in-out;
    overflow-y: auto;
}

.sidebar_menu ul {
    list-style: none;
    padding: 0;
}

.sidebar_menu li {
    padding: 10px;
}

.sidebar_menu a {
    text-decoration: none;
    color: #333;
    font-size: 18px; /* Adjust the font size as needed */
    display: block;
    transition: color 0.1s ease-in-out;
    left: 25px;
    
}

.sidebar_menu a:hover {
    color: #007bff; /* Change the color on hover as needed */
}

.toggle-sidebar-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    background: none;
    border: none;
    font-size: 24px; /* Adjust the font size as needed */
}

    .toggle-sidebar-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    background: none;
    border: none;
    font-size: 24px; /* Adjust the font size as needed */
}

    </style> 
<?php require('../layout/footer.php') ?>