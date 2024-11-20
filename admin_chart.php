<?php

session_start();
include('api/config.php');
// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("location: login.php"); // ถ้าไม่ล็อกอิน, เปลี่ยนเส้นทางไปหน้าเข้าสู่ระบบ
    exit;
}

// ตรวจสอบระดับของผู้ใช้
if ($_SESSION['role'] !== 'admin') {
    header("location: admin.php"); // ถ้าไม่ใช่แอดมิน, เปลี่ยนเส้นทางไปหน้าผู้ใช้ทั่วไป
    exit;
}



//ดึงข้อมูลจากสินค้าจาก products มี product_name และ product_price และ oder_detail นำ quantity มาใช้คำนวณกับราคารวม โดยใช้ product_id ในการเชื่อมทั้ง 2 ตาราง
$sql = "SELECT p.product_name, p.product_price, SUM(oi.quantity) AS total_quantity_sold, 
        SUM(p.product_price * oi.quantity) AS total_sales
        FROM products p
        JOIN order_details oi ON p.product_id = oi.product_id
        GROUP BY p.product_id
        ORDER BY total_sales DESC";  // เรียงลำดับตามยอดขายรวม
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style/chart.css">

    <title>Admin</title>
</head>

<body>
    <?php include('nav_admin.php'); ?>
    <h2>สินค้าที่มียอดขายรวมสูงสุด</h2>
    
    <div class="chart">
        <canvas id="totalSalesChart"></canvas>
    </div>
    
    <div class="deltail">
    <table class="sales-table">
    <thead>
        <tr>
            <th>ชื่อสินค้า</th>
            <th>จำนวนที่ขาย</th>
            <th>ยอดขายรวม (บาท)</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['total_quantity_sold']; ?></td>
                <td>฿<?php echo number_format($row['total_sales'], 2); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</div>
    <script>
        <?php

        mysqli_data_seek($query, 0);
        $product_names = [];
        $total_sales = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $product_names[] = $row['product_name'];
            $total_sales[] = $row['total_sales'];
        }
        ?>

        const productNames = <?php echo json_encode($product_names); ?>;
        const totalSales = <?php echo json_encode($total_sales); ?>;

        const ctx = document.getElementById('totalSalesChart').getContext('2d');
const totalSalesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: productNames,
        datasets: [{
            label: 'ยอดขายรวม (บาท)',
            data: totalSales,
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            borderColor: 'rgba(0, 0, 0, 0.5)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false, 
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

    </script>





</body>

</html>