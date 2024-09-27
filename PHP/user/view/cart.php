<?php include('../view/header.php');

require_once('../model/CategoryDB.php');
require_once('../model/ProductDB.php');
require_once('../model/CartDB.php');
require_once('../model/database.php');


?>
<?php if (isset($_SESSION["customerId"]) == null) {
    $user['customerId'] = null;
} ?>
<div class="body">
    <section class="cart">
        <h1>Giỏ hàng</h1>

        <?php
        $CartDB = new CartDB;
        $list_cart = $CartDB->Get_Product_Cart($user['customerId']);
        if ($list_cart != null) {
        ?>
        <table class="table_cart">
            <thead class="product_c">
                <th class="stt">STT</th>
                <th class="img_c">Ảnh</th>
                <th class="name_c">Tên sản phẩm</th>
                <th class="price_c">Đơn giá</th>
                <th class="quantity_c">Số lượng</th>
                <th class="total_c">Thành tiền</th>
                <th></th>
            </thead>
            <?php
                $sum_total = 0;
                $i = 1;
                foreach ($list_cart as $product) {  ?>
            <tbody>
                <tr class="product_c">
                    <form action="../controller/user_controller.php?action=delete_product_cart" method="post">
                        <td class="stt"><?php echo $i ?></td>
                        <?php $target_dir = '../img/';
                                $addressimg = $product['productlmgMain'];
                                if (file_exists("$target_dir/$addressimg")) {
                                ?>
                        <td class="p_img"><img src="../img/<?php echo $product['productlmgMain'] ?>" alt=""></td>
                        <?php } else { ?>
                        <td class="p_img"><img src="<?php echo $product['productlmgMain'] ?>" alt=""></td>
                        <?php } ?>


                        <td class="name_c"><?php echo $product['productName']  ?></td>

                        <?php $total = floatval($product['quantity']) * floatval($product['price']) ?>

                        <td class="total_c"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</td>

                        <td class="quantity_c"><input type="number" min=1 value="<?php echo $product['quantity']  ?>">
                        </td>
                        <td class="price_c">
                            <?php echo number_format($total, 0, ',', '.') ?>đ</td>
                        <input type="hidden" name="i" value="<?php $i ?>">
                        <input type="hidden" name="productId" value="<?php echo $product['productId'] ?>">
                        <input type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                        <!-- <input type="submit" value="xóa"> -->
                        <td><input class="btn_input" type="submit" value="xóa" class="xoa"> </td>
                    </form>

                </tr>
            </tbody>
            <?php
                    $sum_total = floatval($sum_total) + floatval($total);
                    $i = $i + 1;
                }

                ?>
            <tr>
                <td class=" delete_c"></td>
                <td class="delete_c"></td>
                <td class="delete_c"></td>
                <td class="delete_c"></td>
                <td class="delete_c" id="tt">Tổng tiền :</td>
                <td class="delete_c"><?php echo number_format($sum_total, 0, ',', '.')  ?>đ</td>
                <td class="delete_c"></td>
            </tr>
        </table>
        <?php  } else {
            echo '  
            <h4 class="container">Giỏ Hàng Trống , Vui Lòng Thêm Sản Phẩm !</h4>
            ';
        } ?>
        <div class="button">
            <form class="button" action="../controller/user_controller.php?action=delete_cart" method="post">
                <input type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                <input type="submit" value="Xóa toàn bộ giỏ hàng">

            </form>
            <button class=" btn btn-danger"> <a class="link" href="../view/bill.php">Mua Hàng </a> </button>
        </div>
    </section>

</div>












<?php include('../view/footer.php'); ?>