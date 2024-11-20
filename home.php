<?php  
session_start();
include('api/config.php');

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// SQL Query เลือกสินค้า 1 ชิ้นต่อแบรนด์
//การดึงข้อมูลจากตาราง products และตาราง categories ที่มีการรวมตารางโดยมีการนำสินค้าแต่ละประเภทมาแสดงแค่ 1ชิ้นโดยให้แสดงแค่ 4ชิ้น
$sql = "SELECT p.*, c.brand 
        FROM (
            SELECT *, ROW_NUMBER() OVER (PARTITION BY category_id ORDER BY product_id) as row_num 
            FROM products
        ) p
        JOIN categories c ON p.category_id = c.category_id
        WHERE row_num = 1
        LIMIT 4";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/bg/ZS-icon.png">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<style>
    a {
        text-decoration: none;
        color: inherit;
    }
    .heads {
        font-size: 16px; /* Adjust font size if needed */
        overflow: hidden; /* Hide overflow */
        text-overflow: ellipsis; /* Add ellipsis (...) */
        white-space: nowrap; /* Prevent text from wrapping */
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
    <h2 class="sentfree">ส่งฟรีเมื่อสั่งสินค้าครบ <span class="highlight">2000 บาท</span> ทั่วประเทศ</h2>
    <div class="con">
        <img src="img/bg/pic0.jpg" alt="" class="main">

        <div class="pic">
            <div class="col-2">
                <img src="img/bg/pic3.jpg" alt="" class="full-image">
            </div>
            <div class="col-2">
                <img src="img/bg/pic4.jpg" alt="" class="full-image">
            </div>
        </div>

        <div class="brand">
            <div class="brand-content">
                <a href="nike.php"><img src="img/brand/nike.png" alt=""></a>
            </div>
            <div class="brand-content">
                <a href="adidas.php"><img src="img/brand/Adidas.png" alt=""></a>
            </div>
            <div class="brand-content">
                <a href="puma.php"> <img src="img/brand/puma.png" alt=""></a>
            </div>
            <div class="brand-content">
                <a href="vans.php"> <img src="img/brand/Vans.png" alt=""></a>
            </div>
        </div>

        <h2 class="recommend">แนะนำ</h2>
        <div class="conn">
            <div class="card-container">
                <?php foreach ($query as $data) { ?> 
                    <a href="product_detail.php?id=<?php echo $data['product_id']; ?>">
                        <div class="card">
                            <img src="uploads/<?php echo $data['image']; ?>" alt="" style="width:100%">
                            <div class="container">
                                <p class="heads"><?php echo $data['product_name']; ?></p>
                                <p> <?php echo $data['brand']; ?></p>
                                <p>฿<?php echo $data['product_price']; ?></p>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>
