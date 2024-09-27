<?php include('../view/header.php');
global $detail_product;
require_once('../model/database.php');
require_once('../model/ImgDB.php');
require_once('../model/ProductDB.php');

$ProductDB = new ProductDB;
$lists = $ProductDB->Get_Product_Detail($detail_product['categorys_categoryid']);
$ImgDB = new ImgDB;
$imgs = $ImgDB->Get_Imgs_Product($productId);
// $CategoryDB = new CategoryDB;
// $g_c = $CategoryDB->Get_Category($categoryId);
?>
<div class="body">
    <div class="detail_product">
        <section class="detail_product">
            <?php $target_dir = '../img/';
            $addressimg = $detail_product['productlmgMain'];
            if (file_exists("$target_dir/$addressimg")) {
            ?>
                <div class="img_detail_pd"><img src="../img/<?php echo $detail_product['productlmgMain'] ?>" alt="">
                </div>
            <?php } else { ?>
                <div class="img_detail_pd"><img src="<?php echo $detail_product['productlmgMain'] ?>" alt=""></div>
            <?php } ?>
            <div class="infor_detail_pd">
                <h2><?php echo $detail_product['productName'] ?></h2>
                <div>
                    <strong>Thông số kĩ thuật</strong>
                    <?php if ($detail_product['infomation'] != null) {
                        $token = strtok($detail_product['infomation'], '-'); ?>
                        <ul>
                            <?php while ($token !== false) { ?>
                                <li><?php echo $token ?></li>
                            <?php $token = strtok('-');
                            }  ?>
                        </ul>
                    <?php } else { ?>
                        <div>
                            <h3>Đang được cập nhật...</h3>
                        </div>
                    <?php } ?>

                </div>
                <div class="p_price_old">
                    <del><?php echo number_format($detail_product['priceOld'], 0, ',', '.') ?>đ</del>
                </div>
                <div class="price">

                    <h3>Giá :</h3>
                    <p><?php echo number_format($detail_product['price'], 0, ',', '.') ?>đ</p>
                </div>
                <div class="quantity">

                    <h3 class="quanti">Số lượng :</h3>
                    <p><?php echo number_format($detail_product['quantity_product']) ?></p>
                </div>
                <div class="operation">
                    <form action="../controller/user_controller.php?action=add_product_cart" method="POST">
                        <input type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                        <input type="hidden" name="productId" value="<?php echo $detail_product['productId'] ?>">
                        <input type="hidden" name="productName" value="<?php echo $detail_product['productName'] ?>">
                        <input type="hidden" name="price" value="<?php echo $detail_product['price'] ?>">
                        <input type="hidden" name="information" value="<?php echo $detail_product['infomation'] ?>">
                        <input type="hidden" name="productlmgMain" value="<?php echo $detail_product['productlmgMain'] ?>">
                        <input type="number" name="quantity" min=1 class="quantity_detail"><br><br>
                        <input type="submit" value="Thêm vào giỏ hàng">
                    </form>
                </div>
            </div>
            <div class="more_infor">
                <div class="infor_more">
                    <h2>Giới thiệu sản phẩm</h2>
                </div>
                <?php
                if (!empty($imgs)) {
                    foreach ($imgs as $img) : ?>
                        <div class="p_img_more">
                            <p><?php echo $img['moreInfor']; ?></p>
                            <div>


                                <img src="<?php echo $img['addressImg'] ?>" alt="" class="img_more_infor" width="50%">
                            </div>

                        </div>
                <?php endforeach;
                } ?>
                <div class="endow">
                    <ul>
                        <h5>Thông số kỹ thuật :</h5>

                        <li>- 6.7″</li>

                        <li>- Màn hình Super Retina XDR</li>

                        <h5>- Nhôm với mặt sau bằng kính pha màu</h5>

                        <li>- Nút chuyển đổi Chuông/Im Lặng</li>

                        <li>- Dynamic Island</li>

                        <li>- Chip A16 Bionic với GPU 5 lõi </li>

                        <li>- SOS Khẩn Cấp </li>

                        <h5>Tại Việt Nam, về chính sách bảo hành và đổi trả của Apple, "sẽ được áp dụng chung" theo các điều khoản được liệt kê dưới đây:</h5>
                        <p>1 Chính sách chung: https://www.apple.com/legal/warranty/products/warranty-rest-of-apac-vietnamese.html

</p>

                        <p>2) Chính sách cho phụ kiện: https://www.apple.com/legal/warranty/products/accessory-warranty-vietnam.html</p>

                        <p> 3) Các trung tâm bảo hành Apple ủy quyền tại Việt Nam: https://getsupport.apple.com/repair-locations?locale=vi_VN
                        </p>
                        <p>Qúy khách vui lòng đọc kỹ hướng dẫn và quy định trên các trang được Apple công bố công khai, Shop chỉ có thể hỗ trợ theo đúng chính sách được đăng công khai của thương hiệu Apple tại Việt Nam,
                        </p>
                        <p>Bài viết tham khảo chính sách hỗ trợ của nhà phân phối tiêu biểu:
                        </p>
                        <p> Để thuận tiện hơn trong việc xử lý khiếu nại, đơn hàng của Brand Apple thường có giá trị cao, Qúy khách mua hàng vui lòng quay lại Clip khui mở kiện hàng (khách quan nhất có thể, đủ 6 mặt) giúp Shopee có thêm căn cứ để làm việc với các bên và đẩy nhanh tiến độ xử lý giúp Qúy khách mua hàng.
                        </p>
                    </ul>
                </div>
            </div>
        </section>
        <section class="suggest">
            <h3>Sản phẩm cùng doanh mục</h3>
            <a href=""></a>
            <?php
            if (!empty($lists)) { ?>
                <?php
                foreach ($lists as $product) : ?>
                    <a href="../controller/user_controller.php?action=get_detail_product&productId=<?php echo $product['productId'] ?>">
                        <div class=" poster">
                            <div class="product" id="product">
                                <?php $target_dir = '../img/';
                                $addressimg = $product['productlmgMain'];
                                if (file_exists("$target_dir/$addressimg")) {
                                ?>
                                    <div class="p_img"><img src="../img/<?php echo $product['productlmgMain'] ?>" alt="" width="50%"></div>
                                <?php } else { ?>
                                    <div class="p_img"><img src="<?php echo $product['productlmgMain'] ?>" alt="" width="50%"></div>
                                <?php } ?>
                                <div class="p_name_price">
                                    <div class="p_name"><?php echo $product['productName'] ?></div>
                                    <div class="p_price"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</div>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php endforeach;
            } ?>
        </section>
    </div>

</div>
<?php include('../view/footer.php'); ?>