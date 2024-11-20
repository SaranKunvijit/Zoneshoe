<?php
session_start();
include('api/config.php');
// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("location: login.php"); // ถ้าไม่ล็อกอิน, เปลี่ยนเส้นทางไปหน้าเข้าสู่ระบบ
    exit;
}


// if ($_SESSION['role'] !== 'admin') {
//     header("location: home.php"); 
//     exit;
// }

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM userss";
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


<body>
<?php include('nav_admin.php'); ?>

    <div class="container-table">
        <h3>แสดงข้อมูลผู้ใช้</h3>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ที่อยู่</th>
                    <th>หมายเลขโทรศัพท์</th>
                    <th>สถานะ</th>
                    <th></th> <!-- สำหรับไอคอนลบ -->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $data) { ?>

                    <tr>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['address']; ?></td>
                        <td><?php echo $data['phone']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td>
                            <a href="admin/admin_delete.php?id=<?php echo $data['user_id']; ?>">
                                <button class="btn-delete">ลบ</button>
                            </a>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>