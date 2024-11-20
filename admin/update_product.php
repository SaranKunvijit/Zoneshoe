<?php
session_start();
include('../api/config.php');

if (isset($_POST['update_product'])) { 
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $image_updated = false;

    // ตรวจสอบว่ามีการอัปโหลดไฟล์ใหม่หรือไม่
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = '../uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image_updated = true;
            } else {
                $_SESSION['errores'] = "ไม่สามารถย้ายไฟล์ที่อัปโหลดได้";
            }
        } else {
            $_SESSION['errores'] = "ประเภทไฟล์ไม่ถูกต้อง. อนุญาตเฉพาะ JPG, JPEG, PNG, และ GIF";
        }
    }

    if ($image_updated) {
        $query = "UPDATE products SET product_name='$product_name', description='$description', product_price='$product_price', category_id='$category_id', image='$fileName' WHERE product_id='$product_id'";
    } else {
        $query = "UPDATE products SET product_name='$product_name', description='$description', product_price='$product_price', category_id='$category_id' WHERE product_id='$product_id'";
    }

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("อัปเดตสินค้าสำเร็จ"); window.location.href = "../admin_brand.php";</script>';
    } else {
        $_SESSION['errores'] = "ไม่สามารถอัปเดตข้อมูลได้: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
