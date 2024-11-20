<?php
session_start();
include('api/config.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/cart.css">
</head>
<style>
        .btn-back {
            margin-top: 20px;
            padding: 10px 150px;
            background: black;
            color: white;
            border-radius: 30px;
            cursor: pointer;
        }
        .cart-detail h3 {
    white-space: normal;  /* Allow text to wrap onto new lines */
    word-wrap: break-word; /* Break long words onto the next line if necessary */
    max-width: 200px;      /* Ensure it doesn't exceed the container width */
}
</style>

<body>
<?php include('navbar.php'); ?>

<p class="name-cart">รายการสินค้า</p>
<div class="container-cart">
    <div class="cart-items">
        <?php
        $total = 0;
        $sum_price = 0;
        $item_count = 0; // นับจำนวนสินค้าในตะกร้า
        $hasItems = false;

        if (isset($_SESSION["intLine"]) && isset($_SESSION["strProductID"]) && isset($_SESSION["strQty"])) {
            for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                // ตรวจสอบว่ามีค่าที่ต้องการก่อนที่จะเข้าถึง
                if (isset($_SESSION["strProductID"][$i]) && !empty($_SESSION["strProductID"][$i]) && isset($_SESSION["strQty"][$i])) {

                    $product_id = mysqli_real_escape_string($conn, $_SESSION["strProductID"][$i]);

                   
                    $sqli = "SELECT * FROM products WHERE product_id = '$product_id'";
                    $result = mysqli_query($conn, $sqli);
                    $row = mysqli_fetch_assoc($result);

                    $_SESSION['product_price'] = $row['product_price'];

                    $total = $_SESSION['strQty'][$i];
                    //มีการคำนวณหาราคาสินค้าโดยการนำราคาสินค้ามาคูณกับจำนวนสินค้าแต่ละชิ้นและนำมาบวกกัน
                    $sum = $total * $row['product_price'];
                    $sum_price += $sum;
                    $item_count += $total; 
                    $hasItems = true;
                    $_SESSION['sum_price'] = $sum_price;

                    ?>
                    <div class="cart-item">
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>">
                        <div class="cart-detail">
                            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                            <a href="pro_delete.php?Line=<?php echo $i; ?>"><i class="fa-regular fa-trash-can" style="color: #000000;"></i></a>
                        </div>
                        <div class="product-price">
                            <p class="p-price"><?php echo number_format($row['product_price'], 2); ?></p>
                            <div class="quantity-selector">
                                <!-- ปุ่มลบ -->
                                <button class="quantity-btn minus-btn" <?php if ($_SESSION['strQty'][$i] <= 1) echo 'disabled'; ?>
                                    onclick="window.location.href='del_cart.php?id=<?php echo htmlspecialchars($row['product_id']); ?>'">-</button>
                                <!-- ปุ่มเพิ่ม -->
                                <input type="text" value="<?php echo $_SESSION['strQty'][$i]; ?>" readonly>
                                <button class="quantity-btn plus-btn"
                                    onclick="window.location.href='add_cart.php?id=<?php echo htmlspecialchars($row['product_id']); ?>'">+</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <?php
    if (!$hasItems) {
        ?>
        <p>ไม่มีสินค้าในตะกร้า</p>
        <?php
    }
    ?>

    <?php if ($hasItems) { ?>
        <div class="cart-summary">
            <h1>สรุป</h1>
            <p class="total-item">จำนวนสินค้า <span><?php echo $item_count; ?></span></p>
            <p class="total-price">ยอดรวม ฿<?php echo number_format($sum_price); ?></p>

            <!-- ฟอร์มที่ส่งข้อมูลไปยัง buy.php -->
            <form action="buy.php" method="POST">
                <input type="hidden" name="total_price" value="<?php echo $sum_price; ?>">
                <input type="hidden" name="item_count" value="<?php echo $item_count; ?>">

                <?php 
                for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                    if (isset($_SESSION["strProductID"][$i]) && !empty($_SESSION["strProductID"][$i]) && isset($_SESSION["strQty"][$i])) { ?>
                        <input type="hidden" name="product_ids[]" value="<?php echo htmlspecialchars($_SESSION["strProductID"][$i]); ?>">
                        <input type="hidden" name="quantity[]" value="<?php echo htmlspecialchars($_SESSION["strQty"][$i]); ?>">
                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>"> <!-- Add this line -->
                <?php }
                } ?>

                <button type="submit" class="buy">สั่งซื้อ</button> 
            
            </form>
            <a href="javascript:history.back()">
                <button class="btn-back">ย้อนกลับ</button>
            </a>
        </div>
    <?php } ?>
</div>
</body>
</html>
