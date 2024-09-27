<?php
include('../view/header.php');
global $messager;
?>
<div class="body">
    <div class="body_user">
        <section class="list_action">
            <hr>
            <ul>
                <li><a href="../view/user_profile.php">Hồ sơ</a></li>
                <li><a href="../view/user_address.php">Địa chỉ</a></li>
                <li><a href="../view/user_payment.php?action=list_credit">Ngân hàng</a></li>
                <li><a href="../view/user_change_password.php" class="chose">Đổi mật khẩu</a></li>
            </ul>
        </section>
        <section class="user">
            <div class="info">
                <h1>Cập nhật tài khoản</h1>
                <p>Quản lí thông tin cá nhân</p>
                <hr class="hrhr">
                <div>
                    <div class="form">
                        <form action="../controller/user_controller.php?action=update_password" method="post">
                            <h5 style="color: red;"><?php echo $messager ?></h5><br>
                            <input class="form-control" type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                            <label for="">Mật khẩu cũ</label><input type="password" name="passwordOld"><br><br>
                            <label for="">Mật khẩu mới</label><input type="password" name="passwordNew"><br><br>
                            <label for="">Xác nhận mật khẩu mới</label><input type="password" name="passwordConfirm"><br><br>
                            <input class="form-control" type="hidden" name="action" value="update_password">
                            <input class="form-control" type="submit" value="Lưu" class="save">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
include('../view/footer.php');
?>