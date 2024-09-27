<?php include('../view/header.php');
require_once('../model/CategoryDB.php');
require_once('../model/ProductDB.php');
require_once('../model/database.php');
?>

<div class="body">
    <div class="b_h">
        <section class="aside">
            <ul class="main_menu">
                <h1 class="">Doanh mục</h1>
                <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=2">Hãng</a>
                    <ul class="sub_menu">
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=3">Apple</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=4">Samsum</a>
                        </li>
                        
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=5">Vivo</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=7">Realme</a>
                        </li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=8">Nokia</a></li>
                    </ul>
                </li>
                <li><a href="">Linh kiện</a>
                    <ul class="sub_menu">
                        <li><a href="">Chơi game / cấu hình cao</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=9">Pin khủng trên
                                5000 mAh</a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=10">Chụp ảnh quay
                                phim </a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=11">Livestream
                            </a></li>
                        <li><a href="../controller/user_controller.php?action=get_product_c&categoryid=12">Mỏng nhẹ</a>
                        </li>


                    </ul>
                </li>
            </ul>
        </section>
        <section class="slayshow">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/computer/2.png" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/computer/2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/computer/3.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/computer/4.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <div class="banner"><img src="../img/computer/1.png" alt="" width="100%" class=""></div>
            </div>
        </section>
    </div>
    <div class="header_aside">
        <div class="img1">
            <img src="../img/computer/5.png" alt="">
        </div>
        <div>
            <img src="../img/computer/6.png" alt="">
        </div>
    </div>
    <!-- <section class="body_aside">
        <div class="body_aside_nav">
            <div>
                <p class="main">Iphone</p>
            </div>
        </div>
    </section> -->
    <section class="product_list">
        <!-- <div class="poster" id="poster"><img src="https://img.pikbest.com/origin/06/44/36/88wpIkbEsTnfB.jpg!w700wp"
                alt="">
        </div> -->
        <?php
        $ProductDB = new ProductDB;
        $list = $ProductDB->Get_Product_Category1();
        if (!empty($list)) { ?>
        <?php
            foreach ($list as $product) : ?>
        <a
            href="../controller/user_controller.php?action=get_detail_product&productId=<?php echo $product['productId'] ?>">

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
                    <div class="p_price_old"><del><?php echo number_format($product['priceOld'], 0, ',', '.') ?>đ</div>
                    </del>
                    <div class="p_price"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</div>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
        <?php } else { ?>
        <h1></h1>
        <h4>Không có sản phẩm nào</h4>
        <?php  } ?>
    </section>
    </section>
    <!-- <section class="body_aside">
        <div class="body_aside_nav">
            <div>
                <p class="main">Sản phẩm mới</p>
            </div>
        </div>
    </section> -->
    <section class="product_list">
        <!-- <div class="poster" id="poster"><img src="../img/622885449934d.jpg" alt="">
        </div> -->
        <?php
        $ProductDB = new ProductDB;
        $list = $ProductDB->Get_Product_Home_Id();
        if (!empty($list)) { ?>
        <?php
            foreach ($list as $product) : ?>
        <a
            href="../controller/user_controller.php?action=get_detail_product&productId=<?php echo $product['productId'] ?>">

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
                    <div class="p_price_old"><del><?php echo number_format($product['priceOld'], 0, ',', '.') ?>đ</div>
                    </del>
                    <div class="p_price"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</div>
                    <div class="p_price"><?php echo number_format($product['quantity_product']) ?></div>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
        <?php } else { ?>
        <h1></h1>
        <h4>Không có sản phẩm nào</h4>
        <?php  } ?>
    </section>
    </section>
    <div class="more"><a href="../controller/user_controller.php?action=get_product_c&categoryId=2"> Xem nhiều sản phẩm
            hơn </a>

    </div>

</div>
<!-- <section class="form_email_support">
    <form action="###">
        <h3 class="information-name">Đăng kí email để nhận ưu đãi và được tư vấn miễn phí</h3>
        <input type="email" placeholder="Nhập email của bạn"><input type="submit">
    </form>
</section> -->

<?php include('../view/footer.php') ?>