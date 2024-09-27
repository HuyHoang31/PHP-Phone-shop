<?php include('../view/header.php');
require_once('../model/CategoryDB.php');
require_once('../model/ProductDB.php');
require_once('../model/database.php');

?>

<div class="body">
    <div class="b_h b_h2">
        <section class="aside">
            <ul class="main_menu">
                <h1>Doanh mục</h1>
                <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=2">Hãng</a>
                    <ul class="sub_menu">
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=2">Apple</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=1">Samsum</a>
                        </li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=7">Xiaomi</a>
                        </li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=5">Vivo</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=6">Realme</a>
                        </li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=3">Nokia</a></li>
                    </ul>
                </li>
                <li><a href="">Linh kiện</a>
                    <ul class="sub_menu">
                        <li><a href="">Chơi game / cấu hình cao</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=7">Pin khủng trên
                                5000 mAh</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=2">Chụp ảnh quay
                                phim </a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=2">Livestream
                            </a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=1">Mỏng nhẹ</a>
                        </li>


                    </ul>
                </li> 
                </li>
            </ul>
        </section>
        <!-- <section></section> -->
        <section class="body_product">
            <div class="categoryname">
                <h2><?php $CategoryDB = new CategoryDB;
                    $g_c = $CategoryDB->Get_Category($categoryid);
                    echo $g_c['categoryName'] ?>
                </h2>

            </div>
            <section class="product_list" id="product_list">
                <?php if (!empty($lists)) { ?>
                <?php
                    foreach ($lists as $product) :
                        $number = $ProductDB->Get_Number_Viewd($product['productId']);
                    ?>
                <a
                    href="../controller/user_controller.php?action=get_detail_product&productId=<?php echo $product['productId'] ?>&categorys_categoryid=<?php echo $g_c[' categoryid'] ?>">
                    <div class="poster" id="product_product">
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
                            <div class="p_price_old">
                                <del><?php echo number_format($product['priceOld'], 0, ',', '.') ?>đ</del>
                            </div>
                            <div class="p_price"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</div>
                            <div class="p_price"><?php echo number_format($product['quantity_product']) ?></div>
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
</div>
<?php include('../view/footer.php') ?>