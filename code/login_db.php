<?php
session_start();
include('../api/config.php');
    //กรณีที่ล็อคอินสำเร็จ ถูกหลังบ้านจะทำการตรวจสอบข้อมูลในฐานข้อมูล และหากข้อมูลถูกต้อง ระบบจะทำการบันทึกข้อมูลชื่อผู้ใช้และสถานะ
    
    //กรณีไม่สำเร็จ ระบบจะตรวจข้อมูลที่กรอกไม่ถูกต้อง (เช่น ชื่อผู้ใช้ไม่ตรง หรือรหัสผ่านผิด) ระบบจะบันทึก ข้อความข้อผิดพลาด
    
    //มีการรับข้อมูลจากฟอร์ม signin
if (isset($_POST['signin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    //ตรวจสอบว่ามีการกรอกข้อมูลครบหรือไหม
    if (empty($username)) {
        $_SESSION['errors'] = "กรุณากรอกชื่อผู้ใช้";
        header("location: ../login.php");
    }
    if (empty($password)) {
        $_SESSION['errors'] = "กรุณากรอกรหัสผ่าน";
        header("location: ../login.php");
    }
    //มีการตรวจสอบข้อมูลว่าข้อมูลที่ทำการกรอกตรงกับฐานข้อมูลไหม
    if (!isset($_SESSION['errors'])) {
        $query = "SELECT * FROM userss WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // ตรวจสอบรหัสผ่านและ status ของผู้ใช้ว่าเป็น แอดมินหรือผู้ใช้ทั่วไป
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['status']; 
                //ถ้า status เท่ากับ admin จะทำการเด้งไปยังหน้าล็อคอิน
                if ($user['status'] === 'admin') {
                    header("location: ../admin.php"); 
                } else {
                    //แต่ถ้าไม่ใช่ admin ให้เด้งไปหน้า home
                    header("location: ../home.php");
                }
            } else {
                //มีการตรวจสอบว่าถ้ามีการกรอกชื่อผู้ใช้หรือรหัสผ่านผิดจะเด้งไปยังหน้าล็อคอิน
                $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านผิด";
                header("location: ../login.php");
            }
        } else {
            $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านผิด";
            header("location: ../login.php");
        }
    } else {
        $_SESSION['errors'] = "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน";
        header("location: ./login.php");
    }
}
?>