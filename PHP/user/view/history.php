<?php include('../view/header.php');
require_once('../model/CategoryDB.php');
require_once('../model/ProductDB.php');
require_once('../model/database.php');
require_once('../model/Orders.php');


?>

<div class="body">
    <!-- <div class="b_h b_h2"> -->
    <section>
        <table class="table">
             
            <tr>
            <th scope="col">Ảnh</th>
            <th scope="col">Tên sản phảm</th>
            <th scope="col">Số lượng </th>
                <!-- <th>Đơn giá</th> -->
                <th scope="col">Tổng</th>
                <tr>
 
           
                <?php $OrdersDB=new OrdersDB;
                 $history=$OrdersDB->History($user['customerId']) ;
                 foreach($history as $s){ ?>
                <tr>
                    <td scope="col  "> <?php $target_dir = '../img/';
                                    $addressimg = $s['productlmgMain'];
                                    if (file_exists("$target_dir/$addressimg")) {
                                    ?>
                            <div class="img_history"><img src="../img/<?php echo $s['productlmgMain'] ?>" alt=""></div>
                            <?php } else { ?>
                            <div class="p_img"><img src="<?php echo $s['productlmgMain'] ?>" alt=""></div>
                            <?php } ?></td>
                    <td scope="col"><?php echo $s['productName'] ?></td>
                    <td scope="col"><?php echo $s['quantity'] ?></td>
                    <td scope="col"><?php echo $s['price'] ?></td>
                
                </tr>
                <?php } ?>
                
           
        </table>
    </section>
    </div>
</div>
<?php include('../view/footer.php') ?>