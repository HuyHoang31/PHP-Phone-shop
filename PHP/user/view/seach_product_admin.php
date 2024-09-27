<?php
require_once('../model/database.php');
require_once('../model/CustomerDB.php');
require_once('../model/UserDB.php');
require_once('../model/ProductDB.php');
require_once('../model/CreditDB.php');
require_once('../model/CategoryDB.php');
require_once('../model/BuildDB.php');
global $chose;
global $s;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Phone Shop</title>
    <link rel="icon" href="../img/logo/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/css/admin.css">
</head>

<body>
    <div class="body">
        <section class="menu_main">
            <h2>Admin</h2>
            <form action="../controller/admin_controller.php">
                <ul class="main">
                    <li><a href="../controller/admin_controller.php?action=lists_customer">Tài khoản khách hàng</a></li>
                    <li class="sp"><a href="../controller/admin_controller.php?action=lists_product_view">Sản phẩm</a> </li>
                        <ul class="sp">
                           
                             

                        </ul>
                    </li>
                    <li><a href="">Đơn hàng</a></li>
                    <li><a href="">Góp ý/Yêu cầu</a></li>
                    <li><a href="">Poster</a></li>
                </ul>
            </form>
        </section>

        <section class="content">
            <div class="header">
                <div class="nav">
                    <h2>Phone Shop</h2>
                
                </div>
            </div>
            <hr>
            <form class="form_seach" action="../controller/admin_controller.php?action=seach" method="post">
                <div class="seach"><input type="text" name="seach" placeholder="Nhập tên sản phẩm">
                    <input type="submit" class="seach" value="Tìm">
                </div>
            </form>
            <h2>Tìm kiếm với từ khóa "<?php echo $seach; ?>" có <?php global $seach_product; global $s; if($s!=1){  echo count($seach_product);} ?> sản phẩm :</h2>
            <table class="table">
                <tr>
                <td scope="col">Id</td>
                    <td scope="col">Tên sản phẩm</td>
                    <td scope="col">Thông tin</td>
                    <td scope="col">Giá</td>
                    <td scope="col">Doanh mục</td>
                    <td scope="col">Số lượng</td>
                    <td scope="col">Lượt xem</td>
                    <td scope="col">Ảnh chính</td>
                    <td scope="col"></td>
                </tr>
                 
            </div>
            <?php if($seach_product!=null){
            foreach ($seach_product as $products) { ?>
            <form action="." method="post">
            <tr>
                        <input type="hidden" name="productId" value="<?php echo $products['productId'] ?>">
                        <td scope="col"><?php echo $products['productId']; ?></td>
                        <td scope="col"><?php echo $products['productName']; ?></td>
                        <td scope="col"><?php echo $products['infomation']; ?></td>
                        
                        <td scope="col"><?php echo number_format($products['price'], 0, ',', '.'); ?></td>
                        <td scope="col"><?php echo $products['categorys_categoryid']; ?></td>
                        <td scope="col"><?php echo $products['quantity_product']; ?></td>   
                        <td scope="col"><?php echo $products['numberViewed']; ?></td>
                        <?php $target_dir = '../img/';
                            $addressimg = $products['productlmgMain'];
                            if (file_exists("$target_dir/$addressimg")) {
                            ?>
                        <td class="img_product"><img class="img_product"
                                src="../img/<?php echo $products['productlmgMain'] ?>" alt="">
                        </td>
                        <?php } else { ?>
                        <td scope="col" class="img_product"><img class="img_product"
                                src="<?php echo $products['productlmgMain'] ?>" alt=""></td>
                        <?php } ?>
                        <td class="action_p">
                            <button class="btn btn-primary"><a class="a"
                                    href="../view/form_edit_product.php?productId=<?php echo $products['productId'] ?>&categoryId=<?php echo $products['categorys_categoryid'] ?>">Cập
                                    nhật</a></button>
                            <button class="btn btn-primary"><a class="a"
                                    href="../controller/admin_controller.php?action=delete_product&productId=<?php echo $products['productId'] ?>&categoryId=<?php echo $products['categorys_categoryid'] ?>">Xóa</a></button><br>
                        </td>
                    </tr>
            </form>
            <?php }}     ?>
        </section>

        </form>

        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>