<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_price = $_POST['total_price'];
    $item_count = $_POST['item_count'];
    $product_ids = $_POST['product_ids']; // array ของ product_id
    $quantity = $_POST['quantity']; // array ของ quantities
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <link rel="stylesheet" href="style/buy.css">
    <title>สั่งซื้อสินค้า</title>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <p>โปรดตรวจสอบให้แน่ใจว่าที่อยู่สำหรับจัดส่งที่ป้อนนั้นถูกต้อง
                เนื่องจากเราไม่สามารถแก้ไขที่อยู่ได้หลังจากชำระเงินและคำสั่งซื้อจะไม่ไปรับการดำเนินการ</p>
            <h3>ป้อนชื่อและที่อยู่</h3>
            <form class="address-form" action="confirm_order.php" method="POST">
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                <input type="hidden" name="item_count" value="<?php echo $item_count; ?>">

                <?php
                foreach ($product_ids as $index => $product_id) { ?>
                    <input type="hidden" name="product_ids[]" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity[]" value="<?php echo $quantity[$index]; ?>">
                <?php } ?>

                <input type="text" name="name" placeholder="ชื่อ" required>
                <input type="text" name="address" placeholder="ที่อยู่" required>
                <input type="text" name="phone" placeholder="เบอร์โทรศัพท์" required>
                <button type="submit" class="btn">สั่งซื้อ</button>
            </form>
            <a href="cart.php"><button class="back">ย้อนกลับ</button></a>
        </div>

        <div class="right-section">
            <h2>สรุปคำสั่งซื้อ</h2>
            <div class="order-summary">
                <p>ยอดรวม <span>฿<?php echo number_format($total_price); ?></span></p>
                <p>จำนวนสินค้า <span><?php echo $item_count; ?></span></p>
                <hr>
                <p class="total-amount">ยอดรวม <span>฿<?php echo number_format($total_price); ?></span></p>
            </div>

            <div class="delivery-info">

                <?php
                include('api/config.php');
                foreach ($product_ids as $index => $product_id) {
                    // ดึงข้อมูลสินค้าเพิ่มเติมจากฐานข้อมูล
                    $sqli = "SELECT * FROM products WHERE product_id = '$product_id'";
                    $query1 = mysqli_query($conn, $sqli);
                    $row = mysqli_fetch_assoc($query1);
                    ?>
                    <div class="product-detail">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="">
                        <div class="product-info">
                            <p>ชื่อสินค้า&nbsp;&nbsp;&nbsp;<?php echo $row['product_name']; ?></p>
                            <p>จำนวน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $quantity[$index]; ?></p>
                            <p>ราคา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;฿<?php echo $row['product_price']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>