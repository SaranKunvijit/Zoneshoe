<?php
session_start();
include('api/config.php');
// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("location: login.php"); // ถ้าไม่ล็อกอิน, เปลี่ยนเส้นทางไปหน้าเข้าสู่ระบบ
    exit;
}

// ตรวจสอบระดับของผู้ใช้
if ($_SESSION['role'] !== 'admin') {
    header("location: home.php"); // ถ้าไม่ใช่แอดมิน, เปลี่ยนเส้นทางไปหน้าผู้ใช้ทั่วไป
    exit;
}

$sql = "SELECT products.*, categories.brand FROM products JOIN categories ON products.category_id = categories.category_id";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>Admin</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<style>
    th, td {
    overflow-wrap: break-word; /* ให้ข้อความขึ้นบรรทัดใหม่เมื่อมีความยาวเกินไป */
    word-break: break-word; /* แบ่งคำที่ยาวเกินไป */
    white-space: normal; /* ให้ข้อความแตกบรรทัดอัตโนมัติ */
    max-width: 50%; /* กำหนดขนาดสูงสุดของกรอบข้อความ */
    line-height: 1.5; /* ระยะห่างระหว่างบรรทัด */

          
}/* Add this CSS to ensure text in the description cell wraps correctly */
.user-table td {
    overflow-wrap: break-word; /* Breaks long words or URLs */
    word-break: break-word; /* Breaks long words to fit the container */
    white-space: normal; /* Allows text to wrap */
    max-width: 200px; /* Set a max-width to ensure it doesn't stretch too far */
}

</style>
<body>
   <?php include('nav_admin.php'); ?>

    <div class="container-table">
        <h3>แสดงข้อมูลสินค้า</h3>
        <div class="add">
            <a href="add_products.php"><button class="btn-add">เพิ่มสินค้า</button></a>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>ราคา</th>
                    <th>หมวดหมู่</th>
                    <th>รูปภาพ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?php echo $data['product_name']; ?></td>
                        <td><?php echo $data['description']; ?></td>
                        <td><?php echo $data['product_price']; ?></td>
                        <td><?php echo $data['brand']; ?></td>
                        <td><img src="uploads/<?php echo $data['image']; ?>" width="100"></td>
                        <td>
                            <a href="admin/delete_product.php?id=<?php echo $data['product_id']; ?>">
                                <button class="btn-delete">ลบ</button>
                            </a>
                            <a href="updates_products.php?id=<?php echo $data['product_id']; ?>">
                                <button class="btn-update">แก้ไข</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>