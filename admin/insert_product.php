<?php
session_start();
include('../api/config.php');

if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

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
                $query = "INSERT INTO products (product_name, description, product_price, category_id, image) VALUES ('$product_name', '$description', '$product_price', '$category_id', '$fileName')";

                if (mysqli_query($conn, $query)) {
                    echo '<script>alert("เพิ่มสินค้าสำเร็จ");
                            window.location.href = "../admin_brand.php";
                            </script>';
                } else {
                    $_SESSION['errores'] = "ไม่สามารถเพิ่มข้อมูลได้: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['errores'] = "ไม่สามารถย้ายไฟล์ที่อัปโหลดได้";
            }
        } else {
            $_SESSION['errores'] = "ประเภทไฟล์ไม่ถูกต้อง. อนุญาตเฉพาะ JPG, JPEG, PNG, และ GIF";
        }
    } else {
        $_SESSION['errores'] = "ไม่มีไฟล์ถูกอัปโหลดหรือเกิดข้อผิดพลาดในการอัปโหลดไฟล์";
    }

    mysqli_close($conn);


}
?>
