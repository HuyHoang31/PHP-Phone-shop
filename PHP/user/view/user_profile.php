<?php
include('../view/header.php');
require_once('../model/database.php');
global $messager;
?>

<div class="body">
    <div class="body_user">
        <section class="list_action">
            <hr>
            <ul>
                <li><a href="../view/user_profile.php" class="chose">Hồ sơ</a></li>
                <li><a href="../view/user_address.php">Địa chỉ</a></li>
                <li><a href="../view/user_payment.php">Ngân
                        hàng</a></li>
                <li><a href="../view/user_change_password.php">Đổi mật khẩu</a></li>
            </ul>
        </section>
        <section class="user">
            <div class="info">
                <h1>Hồ sơ cá nhân</h1>
                <p>Quản lí thông tin cá nhân</p>
                <hr class="hrhr">
                <div>
                    <div class="form">
                        <form action="../controller/user_controller.php?action=update_profile" method="post">
                            <h5 style="color: red;"><?php echo $messager ?></h5><br>
                            <input class="form-control" type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                            <label for="">Họ và tên</label><input type="text" name="customerName"
                                value="<?php echo $user['customerName'] ?>"><br><br>
                            <label for="">Email</label><input type="email" placeholder="Email" name="email"
                                value="<?php echo $user['email'] ?>"><br><br>
                            <label for="">Số điện thoại</label><input type="text" name="phone"
                                value="<?php echo $user['phone'] ?>"><br><br>
                            <label for="">Giới tính</label>
                            <input  type="radio" name="gender" value="nam" <?php if ($user["gender"] == 'nam') {
                                                                                echo 'checked';
                                                                            } ?>>Nam
                            <input type="radio" name="gender" value="nữ" <?php if ($user["gender"] == 'nữ') {
                                                                                echo 'checked';
                                                                            } ?>>Nữ
                            <input type="radio" name="gender" value="khác" <?php if ($user["gender"] == 'khác') {
                                                                                echo 'checked';
                                                                            } ?>>Khác<br><br>
                            <label for="">Ngày sinh</label>
                            <input type="date" name="birthday" value="<?php echo $user['birthday'] ?>"> <br><br>

                            <input type="submit" value="Lưu" class="save">

                        </form>
                    </div>
                    <form action="../controller/user_controller.php?action=update_img_customer" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="customerId" value="<?php echo $user['customerId'] ?>">
                        <input type="hidden" name="email" value="<?php echo $user['email'] ?>">
                        <div class="img_user">
                            <div class="border">
                                <?php
                                if ($user['customerImg'] != null) { ?>
                                <img class="link_img" src="../img/<?php echo $user['customerImg']; ?>" alt="avatar">
                                <?php } ?>
                            </div>
                            <div>
                                <label for="img" class="chose_img">Chọn file <i class="bi bi-card-image"></i><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                        <path
                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                                    </svg></label>
                                <input id="img" type="file" class="link_img" name="customerImg"><br>
                                <input type="submit" name="submit" value="Tải lên">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
include('../view/footer.php');
?>