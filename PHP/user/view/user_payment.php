<?php
include('../view/header.php');
global $messager;
require_once('../model/database.php');
require_once('../model/CreditDB.php');
?>
<div class="body">
    <div class="body_user">
        <section class="list_action">
            <hr>
            <ul>
                <li><a href="../view/user_profile.php">Hồ sơ</a></li>
                <li><a href="../view/user_address.php">Địa chỉ</a></li>
                <li><a href="../view/user_payment.php" class="chose">Ngân hàng</a>
                </li>
                <li><a href="../view/user_change_password.php">Đổi mật khẩu</a></li>
            </ul>
        </section>
        <section class="user">
            <div class="info">
                <h1>Ngân hàng</h1>
                <p>Quản lí thông tin cá nhân</p>
                <hr class="hrhr">
                <div>
                    <div class="form">
                        <h3>Thẻ tín dụng</h3>
                        <?php global $messager;
                        echo $messager; ?>
                        <table class="table1">
                            <thead>
                                <th>Số tài khoản</th>
                                <th>Số dư</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- <td><?php $user["customerCreditCode"] ?></td>
                                    <td><?php $user["amount"] ?></td> -->
                                </tr>
                            </tbody>
                        </table>
                        <?php ?>
                        <td class="td_function"><input type="button" value="Thêm thẻ tín dụng" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            <div class="modal fade" id="staticBackdrop2">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Thẻ tín dụng</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table2">
                                                <?php
                                                $credits = new CreditDB;
                                                $lists = $credits->get_all();
                                                global $lists;
                                                if ($lists != null) { ?>
                                                <thead>
                                                    <th>Số tài khoản</th>
                                                    <th>Số dư</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach ($lists as $lists) : ?>
                                                    <tr>
                                                        <td><?php echo $lists['creditCardCode'] ?>
                                                            <input type="hidden" name="creditCardCode"
                                                                value="<?php echo $lists['creditCardCode'] ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($lists['amount'], 0, ',', '.')    ?>
                                                            <input type="hidden" name="amount"
                                                                value="<?php echo number_format($lists['amount'], 0, ',', '.')    ?>">
                                                        </td>
                                                        <td><input type="button" value="Thêm"></td>
                                                    </tr> <?php endforeach; ?>
                                                </tbody><?php } else { ?>
                                                <h3>Không tìm thấy tài khoản nào! </h3>
                                                <?php  } ?>
                                            </table>


                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php ?>
                        <br>
                        <label for=""></label>
                    </div>

                </div>
                <hr class="hrhr">

            </div>
        </section>

    </div>
</div>
<?php
include('../view/footer.php');
?>