<?php
session_start();
include('api/config.php');

if (isset($_GET['id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);
    $username = $_SESSION['username'];

    //มีการตรวจสอบว่ามีสินค้าอยู่ในตะกร้าไหมถ้าไม่มีให้กลับไป cart.php
    if (!isset($_SESSION["intLine"]) || !isset($_SESSION["strProductID"])) {
        header("Location: cart.php");
        exit;
    }
    //ค้นหารายการสินค้าในตะกร้า
    $key = array_search($product_id, $_SESSION["strProductID"]);

//ตรวจสอบว่ามีสินค้าอยู่ในตะกร้าหรือไม่ และหากมีสินค้าในตะกร้า ก็สามารถลดจำนวนได้ ซึ่งจะมีการอัปเดตข้อมูลในฐานข้อมูล
    if ($key !== false) {
        if ($_SESSION["strQty"][$key] > 1) {
            $_SESSION["strQty"][$key] -= 1;

            $sql = "UPDATE cart SET quantity = quantity - 1 WHERE username = '$username' AND product_id = '$product_id'";
            mysqli_query($conn, $sql);
        } else {
            $sql = "DELETE FROM cart WHERE username = '$username' AND product_id = '$product_id'";
            mysqli_query($conn, $sql);

            unset($_SESSION["strProductID"][$key]);
            unset($_SESSION["strQty"][$key]);
            $_SESSION["strProductID"] = array_values($_SESSION["strProductID"]);
            $_SESSION["strQty"] = array_values($_SESSION["strQty"]);
        }
    }
    header("Location: cart.php");
}
?>
