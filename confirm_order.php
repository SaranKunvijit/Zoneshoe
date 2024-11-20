<?php
session_start();
include('api/config.php');

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
    $item_count = mysqli_real_escape_string($conn, $_POST['item_count']);
    $product_ids = $_POST['product_ids'];
    $quantities = $_POST['quantity'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $username = $_SESSION['username']; // Get username from session

    // Insert order into orders table
    $sql = "INSERT INTO orders (username, total_price, item_count, name, address, phone) 
            VALUES ('$username','$total_price', '$item_count', '$name', '$address', '$phone')";
    
    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn); // Get the ID of the newly inserted order

        // Insert order details into order_details table
        foreach ($product_ids as $index => $product_id) {
            $quantity = mysqli_real_escape_string($conn, $quantities[$index]);
            $product_id = mysqli_real_escape_string($conn, $product_id);
            $sql_details = "INSERT INTO order_details (order_id, product_id, quantity) 
                            VALUES ('$order_id', '$product_id', '$quantity')";
            mysqli_query($conn, $sql_details);
        }

        // Clear cart data from session
        unset($_SESSION['cart']);
        unset($_SESSION['strProductID']);
        unset($_SESSION['strQty']);

        echo '<script>alert("คำสั่งซื้อของคุณถูกบันทึกเรียบร้อยแล้ว!");
        window.location.href = "detail_buy.php";
        </script>';
    
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกคำสั่งซื้อ: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("location: detail_buy.php");
    exit;
}
?>
