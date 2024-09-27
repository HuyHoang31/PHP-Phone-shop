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
session_start();

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
        <nav class="navbar"> 
            <h1 class=" nav_name">AdminLTE</h1>
        </nav>
        
            <form action="../controller/admin_controller.php">
                <ul class="main">
                    <li><a href="../controller/admin_controller.php?action=lists_customer">Tài khoản khách hàng</a></li>
                    <li class="sp"><a href="../controller/admin_controller.php?action=lists_product_view">Sản phẩm</a> </li>
                    <li class="sp"><a href="../view/history.php">Đơn Hàng</a> </li>

                </ul>
            </form>
        </section>
        <section class="content">
            <div class="header">
            <nav class="navbar_container"> 
             <ul class="nav_list">
                <li class="nav_item"><a href="../view/homepage.php" class="main_link">Trang chủ</a></li>
                <li class="nav_item"><a href="" class="main_link">Thư</a></li>
                <li class="nav_item"><a href="" class="main_link">hỗ trợ</a></li>
                <li class="nav_item main_link"><a href="" class="main_link"><?php echo $_SESSION["customerId"]['customerName']  ?></a>
                  
            </li>
                 
             </ul>
           </nav>
                   
                
            </div>
            

            <?php if ($chose == 1) {
            ?>
            <h4>Tài khoản khách hàng</h4>
            <div class="lists_customer">
                <div class="infor">
                    <h5>Id</h5>
                    <h5>Tên tài khoản</h5>
                    <h5>email</h5>
                    <h5>Số điện thoại</h5>
                    <h5>Địa chỉ</h5>
                    <h5></h5>
                </div>
                <?php $CustomerDB = new CustomerDB;
                    $lc = $CustomerDB->Get_All_Customers();
                    foreach ($lc as $customers) {
                        if ($customers['customerId'] == 0) { ?>
                <?php } else { ?>
                <!-- <input type="submit" value="Xóa"> -->
                <form action="../controller/admin_controller.php?action=delete_customer" method="post">
                    <div class="detail">
                        <input type="text" value="<?php echo $customers['customerId']; ?>" name="customerId" readonly>
                        <input type="text" value="<?php echo $customers['customerName']; ?>" name="customerName"
                            readonly>
                        <input type="text" value="<?php echo $customers['email']; ?>" name="email" readonly>
                        <input type="text" value="<?php echo $customers['phone']; ?>" name="phone" readonly>
                        <input type="text" value="<?php echo $customers['address']; ?>" name="phone" readonly>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="xoa"
                            data-bs-target="#exampleModal<?php echo $customers['customerId']; ?>">
                            Xóa
                        </button>
                        <div class="modal fade" id="exampleModal<?php echo $customers['customerId']; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Xác nhận xóa người dùng có Id :<?php echo $customers['customerId']; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">cancel</button>
                                        <button type="button" class="btn btn-primary" id="delete"><a
                                                href="../controller/admin_controller.php?action=delete_customer&customerId=<?php echo $customers['customerId']; ?>">Xóa</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php }
                    } ?>
            </div><?php } ?>


            <?php if ($chose == 2) {
            ?>
            <div class="sp">
                <h4 class="namett">Sản phẩm cửa hàng</h4>
                 
            </div>
            <a href="../view/add_products.php" class="button_add"><button>Thêm sản phẩm</button></a>
            <form class="form_seach" action="../controller/admin_controller.php?action=seach" method="post">
                <div class="seach"><input type="text" name="seach" placeholder="Nhập tên sản phẩm" <?php if (isset($s)) {
                                                                                                            echo 'class="null" ';
                                                                                                        } ?>>
                    <input type="submit" class="seach" value="Tìm">
                </div>
            </form>
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
                <?php
                $ProductDB = new ProductDB;
                $lgc = $ProductDB->Get_Product_View();
                foreach ($lgc as $products) { ?>
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
            <?php }
            } ?>

            <?php if ($chose == 3) {
            ?>
            <div class="sp">
                <h4 class="namett">Sản phẩm cửa hàng</h4>
             <a href="../view/add_products.php" class="button_add"><button>Thêm sản phẩm</button></a>
            </div>
            <form class="form_seach" action="../controller/admin_controller.php?action=seach" method="post">
                <div class="seach"><input type="text" name="seach" placeholder="Nhập tên sản phẩm" <?php if (isset($s)) {
                                                                                                            echo 'class="null" ';
                                                                                                        } ?>>
                    <input type="submit" class="seach" value="Tìm">
                </div>
            </form>
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
                <?php
                $ProductDB = new ProductDB;
                $lgc = $ProductDB->Get_Product_View();
                foreach ($lgc as $products) { ?>
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
                <?php }
            } ?>

                </form>
            </table>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>