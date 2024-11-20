<?php
session_start();
include('api/config.php');

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // ค้นหาและอัปเดตจำนวนสินค้าในเซสชัน
    for($i = 0; $i <= (int)$_SESSION["intLine"]; $i++){
        if ($_SESSION["strProductID"][$i] == $product_id) {
            $_SESSION["strQty"][$i] = $quantity;
            break;
        }
    }

    // คุณสามารถส่ง response กลับไปยัง JavaScript ได้
    echo "Quantity updated";
}
?>
