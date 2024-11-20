<?php
include('../api/config.php');
if (isset($_GET['id'])) {
    $sql = "DELETE FROM userss WHERE user_id = '".mysqli_real_escape_string($conn, $_GET['id'])."' ";
    if (mysqli_query($conn, $sql)) {
        echo '<script> 
                alert("ลบข้อมูลสำเร็จ");
                window.location.href = "../admin.php";
              </script>';
    } else {
        echo '<script> 
                alert("ลบข้อมูลไม่สำเร็จ");
                window.location.href = "../admin.php";
              </script>';
    }
}
mysqli_close($conn);
?>
