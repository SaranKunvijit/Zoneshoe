<?php include('api/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>เพิ่มสินค้า</title>
    <link rel="stylesheet" href="style/product.css">

</head>
<body>
    <div class="form-container">
        <p>เพิ่มสินค้าใหม่</p>
        <form action="admin/insert_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">ชื่อสินค้า</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>

            <div class="form-group">
                <label for="description">รายละเอียดสินค้า</label>
                <input type="text" name="description" id="description" required>
            </div>

            <div class="form-group">
                <label for="product_price">ราคา</label>
                <input type="text" name="product_price" id="product_price" required>
            </div>

            <div class="form-group">
                <label for="category">หมวดหมู่</label>
                <select id="category" name="category_id" required>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $query = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_assoc($query)) {
                        echo "<option value='" . $data['category_id'] . "'>" . $data['brand'] . "</option>";
                    }
                    mysqli_close($conn);
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">รูปภาพ</label>
                <input type="file" name="image" id="image" accept="image/gif, image/png, image/jpg">
            </div>

            <div class="form-group">
                <button type="submit" name="add_product" class="add">เพิ่มสินค้า</button>
            </div>
        </form>

        <a href="admin_brand.php" >
            <button  class="back">ย้อนกลับ</button>
        </a>
    </div>
</body>
</html>
