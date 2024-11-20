<?php
session_start();
include('api/config.php');

if (isset($_GET["Line"])) {
    $Line = (int)$_GET["Line"];
    if (isset($_SESSION["strProductID"][$Line])) {
        $product_id = mysqli_real_escape_string($conn, $_SESSION["strProductID"][$Line]);
        $username = $_SESSION['username'];

        // ลบข้อมูลจากฐานข้อมูล
        $sql = "DELETE FROM cart WHERE username = '$username' AND product_id = '$product_id'";
        mysqli_query($conn, $sql);

        // ลบข้อมูลจากเซสชัน
        unset($_SESSION["strProductID"][$Line]);
        unset($_SESSION["strQty"][$Line]);

        // รีเซ็ตค่าในเซสชัน
        $_SESSION["strProductID"] = array_values($_SESSION["strProductID"]);
        $_SESSION["strQty"] = array_values($_SESSION["strQty"]);
    }
}
header("Location: cart.php");
exit;
?>
