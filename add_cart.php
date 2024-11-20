<?php
session_start();
include('api/config.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
//เป็นการเพิ่มสินค้าลงในตะกร้าโดยมีการตรวจสอบว่ามีสินค้าอยู่หรือไม่ถ้าไม่มีก็จะทำการเพิ่มสินค้าลงไป แต่ถ้ามีสินค้าอยู่จะมีการเพิ่มจำนวนสินค้าขึ้นไปอีก
if (!isset($_SESSION["intLine"])) {  //การตรวจสอบว่ามีการเพิ่มสินค้าลงในตะกร้าหรือไม่
    $_SESSION["intLine"] = 0;
    $_SESSION["strProductID"] = array();
    $_SESSION["strQty"] = array(); 

    $_SESSION["strProductID"][0] = mysqli_real_escape_string($conn, $_GET["id"]);
    $_SESSION["strQty"][0] = 1;

    $product_id = $_GET["id"]; //ถ้าไม่มีสินค้าและเมื่อกดเพิ่มก็จะทำการเก็บรหัสสินค้าและจำนวนลงในตะกร้า
    $quantity = 1;
    $username = $_SESSION['username'];

    $sql = "INSERT INTO cart (username, product_id, quantity) VALUES ('$username', '$product_id', '$quantity')";
    mysqli_query($conn, $sql);

    header("Location: cart.php");
    exit;
} else {
    if (!isset($_SESSION["strProductID"])) { //ถ้ามีสินค้าแล้วก็จะทำการเพิ่มสินค้าจาก 1 เป็น 2
        $_SESSION["strProductID"] = array(); 
    }

    $key = array_search($_GET["id"], $_SESSION["strProductID"]); //ค้นหารหัสสินค้าในฐานข้อมูล

    if ($key !== false) {
        // ถ้าพบสินค้าในฐานข้อมูลและเมื่อกดเพิ่มสินค้าขึ้นก็จะเพิ่มสินค้าขึ้นอีก
        $_SESSION["strQty"][$key] += 1;

        $product_id = $_GET["id"];
        $username = $_SESSION['username'];
        //ดึงข้อมูลจากฐานข้อมูลมาและทำการอัปเดตสินค้าที่อยู่ในตะกร้า
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE username = '$username' AND product_id = '$product_id'";
        mysqli_query($conn, $sql);
    } else {
        //หากไม่พบสินค้าก็จะทำการเพิ่มสินค้าลงไปในตะกร้า
        $_SESSION["intLine"]++;
        $intNewLine = $_SESSION["intLine"];
        $_SESSION["strProductID"][$intNewLine] = mysqli_real_escape_string($conn, $_GET["id"]);
        $_SESSION["strQty"][$intNewLine] = 1;

        $product_id = $_GET["id"];
        $quantity = 1;
        $username = $_SESSION['username'];

        $sql = "INSERT INTO cart (username, product_id, quantity) VALUES ('$username', '$product_id', '$quantity')";
        mysqli_query($conn, $sql);
    }

    header("Location: cart.php");
    exit;
}
?>