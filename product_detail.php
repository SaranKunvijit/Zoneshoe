<?php  
include('api/config.php');


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>รายละเอียดสินค้า</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<style>
        a {
            text-decoration: none;
            color: inherit;
        }

 .container-product .del {
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: normal;
    max-width: 400px;
    line-height: 1.5;

          
}

    </style>
<body>
 <?php include('navbar.php') ?>
    <div class="container-product">
        <div>
        <img src="uploads/<?php echo $data['image']; ?>"  class="product-image">

        </div>
        <div class="product">
            <h1 class="product-name"><?php echo $data['product_name']; ?></h1>
            <p class="deltail">รายละเอียดสินค้า</p>
            <p class="del"><?php echo $data['description']; ?></p>
            <p class="price">฿<?php echo $data['product_price']; ?></p>

            <div class="buy-cart">
                <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                <a href="add_cart.php?id=<?php echo $data['product_id']; ?>">
                <button class="btn-cart">เพิ่มลงตะกร้า</button>
                </a>
                <a href="javascript:history.back()">
                    <button class="btn-buy">ย้อนกลับ</button>
                </a>

              
            </div>
        </div>
    </div>




    <script>
  
        const buttons = document.querySelectorAll('.btn-size');

        buttons.forEach(button => {
            button.addEventListener('click', function () {

                buttons.forEach(btn => btn.classList.remove('selected'));

                // เพิ่มคลาส selected ให้กับปุ่มที่ถูกกด
                this.classList.add('selected');
            });
        });

    </script>
</body>

</html>