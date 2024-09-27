<?php
require_once('../model/database.php');
require_once('../model/CustomerDB.php');
require_once('../model/UserDB.php');
require_once('../model/ProductDB.php');
require_once('../model/CreditDB.php');
require_once('../model/CategoryDB.php');
require_once('../model/BuildDB.php');
global $chose;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Shop</title>
    <link rel="icon" href="../img/logo/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../view/css/admin.css">
</head>

<body>
    <div class="body">
        <section class="menu_main">
            <h2>Admin</h2>
            <form action="../controller/admin_controller.php">
                <ul class="main">
                    <li><a href="../controller/admin_controller.php?action=lists_customer">Tài khoản khách hàng</a></li>

                    <li class="sp"><a href="../controller/admin_controller.php?action=lists_product_view">Sản phẩm</a>



                    <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=3">Apple</a></li>
                    <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=4">Samsum</a></li>
                    <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=5">Xiaomi</a></li>
                    <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=6">Vivo</a></li>
                    <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=7">Realme</a></li>
                    <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=8">Nokia</a></li>

                    <li><a href="">Đơn hàng</a></li>
                    <li><a href="">Góp ý/Yêu cầu</a></li>
                    <li><a href="">Poster</a></li>

                </ul>

            </form>
        </section>
        <section class="content">
            <div class="header">
                <div class="nav">
                    <h2 class="container ">Phone Shop</h2>
                    
                </div>
            </div>
            <hr>
            <div class="add_p">
                <h4 style="margin: 0 1pc ;">Cập nhật sản phẩm</h4>
            </div>
            <?php global $messager;
            if (isset($messenger)) {
                echo "<h4 style='color:red;'>" . $messenger . "</h4>";
            }
            ?>
            <form action="../controller/admin_controller.php?action=edit_product" method="post" class="form_add"
                enctype="multipart/form-data">
                <?php
                $CategoryDB = new CategoryDB;
                $ProductDB = new ProductDB;
                if (isset($_GET['productId'])) {
                    $productId = $_GET['productId'];
                } else {
                    $productId = $_POST['productId'];
                }

                $lists_p = $ProductDB->Get_Infor_Products($productId);
                foreach ($lists_p as $product) {
                ?>
              
                    
                <input type="text" name="productId" value="<?php echo $product['productId'] ?>" readonly><br>
                <input class="error" type="text" placeholder="Tên sản phẩm" name="productName"
                    value="<?php echo $product['productName'] ?>"><br>
                <input class="error" type="text" placeholder="Thông tin sản phẩm" name="information"
                    value="<?php echo $product['infomation'] ?>"><br>
                <input class="error" type="text" placeholder="Giá thị trường" name="priceOld"
                    value="<?php echo $product['priceOld'] ?>"><br>
                <input class="error" type="text" placeholder="Giá khuyến mãi" name="price"
                    value="<?php echo $product['price'] ?>"><br>
                    <input class="error" type="number" placeholder="Số lượng" name="quantity_product" value="<?php if (isset($quantity_product)) {
                                                                                                    echo $quantity_product;
                                                                                                } ?>"><br>
                <select name="categoryId" id="" class="cate">
                    <!-- <?php $CategoryDB = new CategoryDB;
                    $category = $CategoryDB->GetAllCategorys(); 
                    foreach ($category as $category) { ?>
                    <option value="<?php echo $category['categoryid']  ?>">
                        <?php echo $category['categoryName']  ?></option>
                    <?php } ?> -->
                    <option value="1">Samsum</option>
                    <option value="2">iphone</option>
                    <option value="3">Nokia</option>
                    <option value="4">readme</option>


                </select> <br>
                </select><br>
                <?php $target_dir = '../img/';
                    $addressimg = $product['productlmgMain'];
                    if (file_exists("$target_dir/$addressimg")) {
                    ?>
                <div class="p_img"><img src="../img/<?php echo $product['productlmgMain'] ?>" alt=""></div>
                <?php } else { ?>
                <div class="p_img"><img src="<?php echo $product['productlmgMain'] ?>" alt=""></div>
                <?php } ?>
                <input class="form-control" type="file" name="productlmgMain"><br>
                <input type="submit" value="Cập nhật" class="btn btn-primary">
                 
                <?php } ?>
            </form>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>