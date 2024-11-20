<?php
include('../api/config.php');
if (isset($_GET['id'])) {
    $sql = "DELETE FROM products WHERE product_id = '".mysqli_real_escape_string($conn, $_GET['id'])."' ";
    if (mysqli_query($conn, $sql)) {
        header('location: ../admin_brand.php');
    } else {
        echo '<script> 
                alert("ลบข้อมูลไม่สำเร็จ");
                window.location.href = "../admin_brand.php";
              </script>';
    }
}
mysqli_close($conn);
?>
