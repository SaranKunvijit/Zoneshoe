<?php
session_start();
include('../api/config.php');

//รับข้อมูลจากฟอร์ม login 
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $status = 'user';

    //มีการตรวจสอบข้อมูลว่ามีช่องไหนว่างหรือเปล่า ถ้ามีจะแสดงข้อความ
    if (empty($username)) {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้";
        header("location: ../login.php");
    }
    if (empty($name)) {
        $_SESSION['error'] = "กรุณากรอกชื่อ-นามสกุล";
        header("location: ../login.php");
    }
    if (empty($address)) {
        $_SESSION['error'] = "กรุณากรอกที่อยู่";
        header("location: ../login.php");
    }
    if (empty($phone)) {
        $_SESSION['error'] = "กรุณากรอกหมายเลขโทรศัพท์";
        header("location: ../login.php");
    }
    if (empty($password)) {
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        header("location: ../login.php");
    }

    //มีการตรวจสอบว่าในฐานข้อมูลมีชื่อ username นี้หรือเปล่า ถ้ามีก็แสดงข้อความว่า มีบัญชีนี้ถูกใช้ไปแล้ว
    if (!isset($_SESSION['error'])) {
        $user_check_query = "SELECT * FROM userss WHERE username = '$username' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['username'] === $username) {
                $_SESSION['error'] = "มีบัญชีนี้ถูกใช้ไปแล้ว";
                header("location: ../login.php");
            }
        }
        //แต่ถ้าไม่มีก็จะเพิ่มข้อมูลการสมัครสมาชิกลงในฐานข้อมูล
        if (!isset($_SESSION['error'])) {
            $password = password_hash($password, PASSWORD_DEFAULT);   
            $sql = "INSERT INTO userss (username, name, address, phone, password, status) VALUES ('$username', '$name', '$address', '$phone', '$password', '$status')";
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ";
            header('location: ../login.php');
        } else {
            header("location: ../login.php");
        }
    } else {
        header("location: login.php");
    }
}
?>