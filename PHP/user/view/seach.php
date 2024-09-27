<?php
include('../view/header.php');
require_once('../model/CategoryDB.php');
require_once('../model/ProductDB.php');
require_once('../model/database.php');
global $seach;
?>

<div class="body">
    <h2>Tìm kiếm với từ khóa "<?php echo $seach; ?>" có <?php echo count($seach_product) ?> sản phẩm :</h2>
    <section class="body_product">
        <section class="product_list">
            <?php
            if (!empty($seach_product)) { ?>
                <?php
                foreach ($seach_product as $product) : ?>
                    <a href="../controller/user_controller.php?action=get_detail_product&productId=<?php echo $product['productId'] ?>">
                        <div class="poster">
                            <div class="product" id="product">
                            <?php $target_dir = '../img/';
                            $addressimg = $product['productlmgMain'];
                            if (file_exists("$target_dir/$addressimg")) {
                            ?>
                    <div class="p_img"><img src="../img/<?php echo $product['productlmgMain'] ?>" alt=""></div>
                    <?php } else { ?>
                    <div class="p_img"><img src="<?php echo $product['productlmgMain'] ?>" alt=""></div>
                    <?php } ?>
                                <div class="p_name"><?php echo $product['productName'] ?></div>
                                <div class="p_price"><?php echo number_format($product['price']) ?>đ</div>
                            </div>
                        </div>
                    </a>
                <?php endforeach;
            } else { ?>
                <h1></h1>
                <h4>Không có sản phẩm nào</h4>
            <?php  } ?>
        </section>
    </section>
</div>
<?php include('../view/footer.php'); ?>