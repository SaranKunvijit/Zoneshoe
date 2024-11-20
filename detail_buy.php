<?php
session_start();
include('api/config.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM orders WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

// Check if there are any orders
$has_orders = mysqli_num_rows($result) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>คำสั่งซื้อ</title>
    <link rel="stylesheet" href="style/del_order.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="deltail_buy"></div>
    <p>รายการสั่งซื้อ</p>
    
    <?php if ($has_orders) { ?>
        <table>
            <thead>
                <tr>
                    <th>หมายเลขคำสั่งซื้อ</th>
                    <th>ชื่อ</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>ยอดรวม</th>
                    <th>จำนวนสินค้า</th>
                    <th>วันที่สั่งซื้อ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo number_format($row['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($row['item_count']); ?></td>
                        <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="no_buy">ไม่มีรายการสั่งซื้อ</p>
    <?php } ?>
</body>
</html>

<?php mysqli_close($conn); ?>
