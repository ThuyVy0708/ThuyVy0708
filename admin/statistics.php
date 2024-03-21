<?php
session_start();
require_once('database/dbhelper.php');

// Hàm thống kê doanh số với khoảng thời gian
function getSalesStatistics($start_date, $end_date) {
    // Kiểm tra định dạng ngày
    if (!validateDate($start_date) || !validateDate($end_date)) {
        return null;
    }

    $sql = "SELECT orders.*, order_details.*, product.title, product.price, customer.fullname as customer_fullname, customer.phone
            FROM orders
            INNER JOIN order_details ON order_details.order_id = orders.id
            INNER JOIN product ON product.id = order_details.product_id
            INNER JOIN customer ON customer.id = orders.id_customer
            WHERE orders.order_date BETWEEN '$start_date' AND '$end_date'
            AND order_details.status = 'Đã nhận hàng'";

    $completedOrderDetails = executeResult($sql);
    $totalQuantity = 0;
    $totalSalesAmount = 0;

    foreach ($completedOrderDetails as $item) {
        $totalPrice = $item['num'] * $item['price']; // Tính tổng tiền
        $totalSalesAmount += $totalPrice;
        $totalQuantity += $item['num'];
    }

    // Add logic for canceled orders
    $sqlCanceled = "SELECT orders.*, order_details.*, product.title, product.price, customer.fullname as customer_fullname, customer.phone
                    FROM orders
                    INNER JOIN order_details ON order_details.order_id = orders.id
                    INNER JOIN product ON product.id = order_details.product_id
                    INNER JOIN customer ON customer.id = orders.id_customer
                    WHERE orders.order_date BETWEEN '$start_date' AND '$end_date'
                    AND order_details.status = 'Đã hủy'";

    $canceledOrderDetails = executeResult($sqlCanceled);

    $totalCanceledQuantity = 0;
    $totalCanceledValue = 0;

    foreach ($canceledOrderDetails as $item) {
        $totalCanceledQuantity += $item['num'];
        $totalCanceledValue += $item['num'] * $item['price'];
    }

    
    $sqlProcessing = "SELECT orders.*, order_details.*, product.title, product.price, customer.fullname as customer_fullname, customer.phone
                      FROM orders
                      INNER JOIN order_details ON order_details.order_id = orders.id
                      INNER JOIN product ON product.id = order_details.product_id
                      INNER JOIN customer ON customer.id = orders.id_customer
                      WHERE orders.order_date BETWEEN '$start_date' AND '$end_date'
                      AND order_details.status IN ('Đang chuẩn bị', 'Đang giao')";

    $processingOrderDetails = executeResult($sqlProcessing);

    $processingQuantity = 0;
    $processingValue = 0;
    foreach ($processingOrderDetails as $item) {
        $processingQuantity += $item['num'];
        $processingValue += $item['num'] * $item['price'];
    }

    // Return an associative array with total_quantity, total_revenue, total_canceled_quantity, total_canceled_value, and processing_quantity
    return [
        'total_quantity' => $totalQuantity,
        'total_revenue' => $totalSalesAmount,
        'total_canceled_quantity' => $totalCanceledQuantity,
        'total_canceled_value' => $totalCanceledValue,
        'processing_quantity' => $processingQuantity,
        'processing_value' => $processingValue
    ];
}

// Hàm kiểm tra định dạng ngày
function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

// Khai báo biến hiển thị kết quả
$resultMessage = '';

// Kiểm tra xem người dùng đã submit form chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Sử dụng hàm thống kê doanh số với khoảng thời gian
    $salesStatistics = getSalesStatistics($start_date, $end_date);

    // Hiển thị kết quả
    if ($salesStatistics) {
        $resultMessage = 'Số lượng sản phẩm bán được: ' . $salesStatistics['total_quantity'] . '<br>' .
            'Tổng doanh thu: ' . number_format($salesStatistics['total_revenue'], 0, ',', '.') . ' VNĐ' . '<br>' .
            'Số lượng sản phẩm bị hủy: ' . $salesStatistics['total_canceled_quantity'] . '<br>' .
            'Tổng giá trị sản phẩm bị hủy: ' . number_format($salesStatistics['total_canceled_value'], 0, ',', '.') . ' VNĐ' . '<br>' .
            'Số lượng sản phẩm đang xử lý: ' . $salesStatistics['processing_quantity'];
            'Giá trị sản phẩm đang xử lý: ' . number_format($salesStatistics['processing_value'], 0, ',', '.') . ' VNĐ';
    } else {
        $resultMessage = 'Không có dữ liệu thống kê.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Thống kê doanh số</title>
    <style>
        .nav-link {
            font-size: 24px; /* Adjust the font size as needed */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .panel {
            width: 100%;
            max-width: 700px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .panel-heading {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: background;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="nav-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="home/manage.php">Trang chủ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="statistics_list/index.php">Báo cáo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="statistics.php">Thống kê</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="category/index.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="product/index.php">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cart/index.php">Quản lý giỏ hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user/index.php">Quản lý người dùng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="customer/index.php">Quản lý khách hàng</a>
        </li>
    </ul>
    <?php require_once('header.php'); ?>
</div>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="text-center">Thống kê doanh số</h1>
                <form method="post" action="">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>" required>

                <label for="end_date">Ngày kết thúc:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>" required>

                <input type="submit" value="Thống kê">
            </form>

                <br>
                <?php
                if ($resultMessage) {
                    echo '<table>
                            <tr>
                                <th>Số lượng sản phẩm bán được</th>
                                <th>Tổng doanh thu</th>
                                <th>Số lượng sản phẩm bị hủy</th>
                                <th>Tổng giá trị sản phẩm bị hủy</th>
                                <th>Số lượng sản phẩm đang xử lý</th>
                                <th>Giá trị sản phẩm đang xử lý</th>
                            </tr>
                            <tr>
                                <td>' . $salesStatistics['total_quantity'] . '</td>
                                <td>' . number_format($salesStatistics['total_revenue'], 0, ',', '.') . ' VNĐ</td>
                                <td>' . $salesStatistics['total_canceled_quantity'] . '</td>
                                <td>' . number_format($salesStatistics['total_canceled_value'], 0, ',', '.') . ' VNĐ</td>
                                <td>' . $salesStatistics['processing_quantity'] . '</td>
                                <td>' . number_format($salesStatistics['processing_value'], 0, ',', '.') . ' VNĐ</td>
                            </tr>
                        </table>';

                    // Add a canvas element for the chart
                    echo '<canvas id="myChart" width="400" height="400"></canvas>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Retrieve data from PHP variables
            var totalQuantity = <?php echo $salesStatistics['total_quantity']; ?>;
            var totalRevenue = <?php echo $salesStatistics['total_revenue']; ?>;
            var totalCanceledQuantity = <?php echo $salesStatistics['total_canceled_quantity']; ?>;
            var totalCanceledValue = <?php echo $salesStatistics['total_canceled_value']; ?>;
            var processingQuantity = <?php echo $salesStatistics['processing_quantity']; ?>;
            var processingValue = <?php echo $salesStatistics['processing_value']; ?>;
            // Set up data for the chart
            var data = {
                labels: ['Đã bán', 'Đã hủy', 'Đang xử lý'],
                datasets: [
                    {
                        label: 'Số tiền',
                        position: 'left',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        yAxisID: 'amount',
                        borderWidth: 1,
                        data: [totalRevenue, totalCanceledValue, processingValue]
                    },
                    {
                        label: 'Số lượng',
                        position: 'right', // Set the position to right
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        yAxisID: 'quantity',
                        borderWidth: 1,
                        data: [totalQuantity, totalCanceledQuantity, processingQuantity]
                    },
                ]
            };

            // Set up options for the chart
            var options = {
                scales: {
                    y: [
                        {
                            type: 'linear',
                            position: 'left',
                            id: 'amount',
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số tiền (VNĐ)'
                            }
                        },
                        {
                            type: 'linear',
                            position: 'right',
                            id: 'quantity',
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số lượng'
                            }
                        }
                    ]
                }
            };

            // Get the canvas element
            var ctx = document.getElementById('myChart').getContext('2d');

            // Create a new chart and render it
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        });
    </script>
</body>

</html>
