<?php  
include('api/config.php');

// ตรวจสอบว่ามี `id` ของสินค้าที่ต้องการแก้ไขถูกส่งมาหรือไม่
if (isset($_GET['id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>อัปเดตสินค้า</title>
    <link rel="stylesheet" href="style/product.css">
</head>
<body>
<div class="form-container">
        <p>อัปเดตสินค้า</p>
        <form action="admin/update_product.php" method="post" enctype="multipart/form-data">
            <!-- Hidden input สำหรับเก็บค่า id ของสินค้า -->
            <input type="hidden" name="product_id" value="<?php echo $data['product_id'] ?? ''; ?>">

            <div class="form-group">
                <label for="product_name">ชื่อสินค้า</label>
                <input type="text" name="product_name" id="product_name" value="<?php echo $data['product_name'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">รายละเอียดสินค้า</label>
                <input type="text" name="description" id="description" value="<?php echo $data['description'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="product_price">ราคา</label>
                <input type="text" name="product_price" id="product_price" value="<?php echo $data['product_price'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="category">หมวดหมู่</label>
                <select id="category" name="category_id" required>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $categories_query = mysqli_query($conn, $sql);
                    while ($category = mysqli_fetch_assoc($categories_query)) {
                        $selected = ($category['category_id'] == $data['category_id']) ? 'selected' : '';
                        echo "<option value='" . $category['category_id'] . "' $selected>" . $category['brand'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">รูปภาพ</label>
                <?php if (!empty($data['image'])): ?>
                    <img src="uploads/<?php echo $data['image']; ?>" width="100"><br><br>
                <?php endif; ?>
                <input type="file" name="image" id="image" accept="image/gif, image/png, image/jpg">
            </div>

            <div class="form-group">
                <button type="submit" name="update_product" class="update">อัปเดตสินค้า</button>
            </div>
        </form>

        <a href="admin_brand.php">
            <button class="back">ย้อนกลับ</button>
        </a>
    </div>
</body>
</html>
