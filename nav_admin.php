<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แอดมิน</title>
    <link rel="stylesheet" href="style/admin.css">
</head>

<body>
    <div class="admin">
        <p>สวัสดีแอดมิน</p>
        <p class="user-admin"><?php echo $_SESSION['username']; ?></p>
    </div>

    <div class="con-nav">
        <nav class="navbar">
            <ul class="nav-list">
                <li><a href="admin.php">ข้อมูลลูกค้า</a></li>
                <li><a href="admin_brand.php">ข้อมูลสินค้า</a></li>
                <li><a href="admin_order.php">รายการการสั่งซื้อ</a></li>
                <li><a href="admin_chart.php">สรุปยอด</a></li>
                <li><a href="code/logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </div>

    
</body>

</html>