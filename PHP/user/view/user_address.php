<?php
include('../view/header.php');

if ($user['address'] != null) {
    $parts = explode("-", $user['address']);
    $specific_address = $parts[0];
    $general_address = $parts[1];
} else {
    $specific_address = '';
    $general_address = '';
}
global $messager;

global $phone;
?>
<div class="body">
    <div class="body_user">
        <section class="list_action">
            <hr>
            <ul>
                <li><a href="../view/user_profile.php">Hồ sơ</a></li>
                <li><a href="../view/user_address.php" class="chose">Địa chỉ</a></li>
                <li><a href="../view/user_payment.php?action=list_credit">Ngân hàng</a></li>
                <li><a href="../view/user_change_password.php">Đổi mật khẩu</a></li>
            </ul>
        </section>
        <section class="user">
            <div class="info">
                <h1>Địa chỉ</h1>
                <p>Quản lí thông tin cá nhân</p>
                <hr class="hrhr">
                <div>
                    <div class="form">
                        <form action="../controller/user_controller.php?action=update_address" method="post">
                            <h5 style="color: red;"><?php echo $messager ?></h5><br>
                            <input type="hidden" name="email" value="<?php echo $user['email'] ?>">
                            <input type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                            <label for="">Họ và tên</label><input type="text" name="customerName" placeholder="Tên người nhận" value="<?php echo $user['customerName']; ?>"><br><br>
                            <label for="">Số điện thoại</label><input type="text" name="Phone" placeholder="Số điện thoại người nhận" value="<?php echo $user['phone']; ?>"><br><br>
                            <label for="">Địa chỉ</label>
                            <input type="text" name="general_address" placeholder="Phường(Huyện)/Xả(Thị xã)/Tỉnh(Thành phố)" value="<?php echo $general_address ?>"><br><br>
                            <label for="">Địa chỉ cụ thể</label>
                            <input type="text" name="specific_address" placeholder="Đường/Số nhà(Địa chỉ nhận cụ thể)" value="<?php echo $specific_address ?>"><br><br>

                            <input type="submit" value="Lưu" class="save">
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