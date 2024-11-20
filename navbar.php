<?php
include('api/config.php');
// คำนวณจำนวนสินค้าที่อยู่ในตะกร้า
$item_count = 0;
if (isset($_SESSION["intLine"]) && isset($_SESSION["strProductID"]) && isset($_SESSION["strQty"])) {
    for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
        if (isset($_SESSION["strProductID"][$i]) && !empty($_SESSION["strProductID"][$i]) && isset($_SESSION["strQty"][$i])) {
            $item_count += $_SESSION["strQty"][$i]; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -3px;
            background-color: red;
            color: white;
            border-radius: 70%;
            padding: 2px 8px;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="con-nav">
    <div class="logo">
        <img src="img/bg/logoshoe.png" alt="" width="350px">
    </div>
    <nav class="navbar">
        <ul class="nav-list">
            <li><a href="home.php">หน้าแรก</a></li>
            <li class="dropdown">
                แบรนด์
                <ul class="dropdown-content">
                    <a href="nike.php">Nike</a>
                    <a href="adidas.php">Adidas</a>
                    <a href="puma.php">Puma</a>
                    <a href="vans.php">Vans</a>
                </ul>
            </li>
            <li><a href="detail_buy.php">รายการสั่งซื้อ</a></li>
            <li>
                <a href="cart.php" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping" style="color: #000000; font-size: 20px;"></i>
                    <?php if ($item_count > 0) { ?>
                        <span class="cart-count"><?php echo $item_count; ?></span>
                    <?php } ?>
                </a>
            </li>
            <li><a href="code/logout.php" class="logout-btn">ออกจากระบบ</a></li>
        </ul>
    </nav>
</div>

</body>

</html>
