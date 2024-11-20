<?php  
session_start();
include('api/config.php');

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$sql = "SELECT products.*, categories.brand 
        FROM products 
        JOIN categories 
        ON products.category_id = categories.category_id 
        WHERE products.category_id = 2";
$query = mysqli_query($conn, $sql);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <link rel="stylesheet" href="style/style.css">
    <title>Adidas Shoe</title>
</head>
<style>
        a {
            text-decoration: none;
            color: inherit;
        }
        .card {
        /* Other styles */
        position: relative;
        width: 100%; /* Ensure the card fits its container */
        overflow: hidden; /* Hide overflow */
    }
    </style>
<body>
<?php include('navbar.php'); ?>
    <div class="nike">
        <img src="img/adidas/bg/adidas-bg2.png" alt="" style="width: auto; height: 300px;">
    </div>

        <div class="con">
    <p class="recommend">รายการแนะนำ</p>

    <div class="conn">
        <div class="card-container">
            <?php 
            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if (mysqli_num_rows($query) > 0) {
                // วนลูปผ่านข้อมูลที่ดึงมา
                while ($data = mysqli_fetch_assoc($query)) { 
            ?> 
                <a href="product_detail.php?id=<?php echo $data['product_id']; ?>">
                    <div class="card">
                        <img src="uploads/<?php echo $data['image']; ?>" alt="" style="width:100%">
                        <div class="container">
                            <p class="heads"><?php echo $data['product_name']; ?></p>
                            <p class="bd"> <?php echo $data['brand']; ?></p>
                            <p>฿<?php echo $data['product_price']; ?></p>
                        </div>
                    </div>
                </a>
            <?php 
                }
            } else {
                echo "<p>ไม่มีสินค้าที่ตรงตามเงื่อนไข</p>";
            }
            ?>
        </div>
    </div>
    </div>
</body>

</html>