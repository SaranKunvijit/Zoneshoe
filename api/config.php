<?php 
 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "zoneshoe";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  /** ตรวจสอบข้อผิดพลาดต่างๆ */
  if (mysqli_connect_errno()) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL ได้: " . mysqli_connect_error();
    //exit();
  }


?>
