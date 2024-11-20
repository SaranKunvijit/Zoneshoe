<?php
session_start();
require_once('api/config.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>ลงชื่อเข้าใช้</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/styles.css">
</head>
<style>
    .error {
        color: red;
        font-weight: bold;

    }

    .errors {
        color: red;
        font-weight: bold;

    }

    .success {
        color: green;
        font-weight: bold;
    }
</style>

<body>
    <!-- มีการใช้ id=main ในการคลุมที่ใช้ในการสลับหน้าของฟอร์ม -->
    <div class="container" id="main"> 
        <div class="sign-up">
            <form action="code/register_db.php" method="post">

                <h1>สมัครสมาชิก</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-line"></i></a>
                </div>

                <p>or use eamil for registeration</p>

                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="error" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="success" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>
                <input type="text" name="username" placeholder="ชื่อผู้ใช้">
                <input type="text" name="name" placeholder="ชื่อ-นามสกุล">
                <input type="text" name="address" placeholder="ที่อยู่">
                <input type="text" name="phone" placeholder="หมายเลขโทรศัพท์">
                <input type="password" name="password" placeholder="รหัสผ่าน">
                <button type="submit" name="signup">สมัครสมาชิก</button>
            </form>
        </div>


        <div class="sign-in">
            <form action="code/login_db.php" method="post">

                <h1>เข้าสู่ระบบ</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-line"></i></a>
                </div>

                <p>or use your your account</p>
                <?php if (isset($_SESSION['errors'])) { ?>
                    <div class="errors" role="alert">
                        <?php
                        echo $_SESSION['errors'];
                        unset($_SESSION['errors']);
                        ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="success" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>
                <input type="text" name="username" placeholder="ชื่อผู้ใช้">
                <input type="password" name="password" placeholder="รหัสผ่าน">
                <a href="">For get your password</a>
                <button type="submit" name="signin">เข้าสู่ระบบ</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-left">
                    <h1>Wellcome back</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button id="sign-In">เข้าสู่ระบบ</button>
                </div>
                <div class="overlay-right">
                    <h1>Hello Friend</h1>
                    <p>Enter your personal details and start your journey with us.</p>
                    <button id="sign-Up">สมัครสมาชิก</button>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        //เมื่อมีการกดปุ่มสมัครสมาชิก จะเป็นการเพิ่มคลาส  right-panel-active เข้ามาใน main เพื่อแสดงฟอร์ม signup แต่ถ้ามีการกดปุ่ม signin จะเป็นการลบคลาส  right-panel-active ออกจาก main และทำการแสดงฟอร์ม signin ขึ้นมาและมีการตรวจสอบว่าฟอร์มล่าสุดที่มีการเปิดเป็นฟอร์ม signin หรือ signup
        //มีการใช้ id=main ในการสลับระหว่างฟอร์ม
        const signUpButton = document.getElementById('sign-Up');
        const signInButton = document.getElementById('sign-In');
        const main = document.getElementById('main');

        //เมื่อผู้ใช้กดปุ่ม "สมัครสมาชิก" จะมีการเพิ่มคลาส right-panel-active ให้กับองค์ประกอบ main ซึ่งครอบฟอร์มทั้งหมด
        signUpButton.addEventListener('click', () => {
            main.classList.add("right-panel-active");
            localStorage.setItem('form', 'signup');
        });
        //เมื่อผู้ใช้กดปุ่ม "เข้าสู่ระบบ" จะเป็นการลบคลาส right-panel-active ออกจาก main การลบคลาสนี้จะทำให้ฟอร์ม "เข้าสู่ระบบ" แสดงขึ้นมาแทนฟอร์ม "สมัครสมาชิก"
        signInButton.addEventListener('click', () => {
            main.classList.remove("right-panel-active");
            localStorage.setItem('form', 'signin');
        });


        //ถ้าฟอร์มที่เปิดล่าสุดเป็น "สมัครสมาชิก" (ค่าจาก localStorage เป็น signup) จะเพิ่มคลาส right-panel-active ให้กับ main เพื่อแสดงฟอร์มสมัครสมาชิก
        const savedForm = localStorage.getItem('form');
        if (savedForm === 'signup') {
            main.classList.add("right-panel-active");
        }

    </script>
</body>

</html>