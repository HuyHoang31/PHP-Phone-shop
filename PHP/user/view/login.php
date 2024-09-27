<?php global $index;
global $ss; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../view/css/login.css">
</head>

<body>
    <div class="main">
        <div class="full_form">

            <form action="../controller/user_controller.php?action=login" method="post">
                <h1 class="name">Login</h1>
                <?php if ($index == 1) { ?>
                <h5 class="error">Sai Thông Tin Đăng Nhập hoặc Sai PassWord!</h5>
                <?php } ?>
                <?php
            if ($ss == 1) {
            ?>
                <h5>Bạn đăng kí thành công!</h5>
                <?php } ?>
                <input class="input" type="text" name="email" placeholder="Email "
                    <?php if ($index==1) { echo 'class="error"'; } ?>><br><br>
                <input class="input" type="password" name="password" placeholder="PassWord"
                    <?php if ($index==1) { echo 'class="error"'; } ?>><br><br>

                <!-- <input type="hidden" name="action" value="login"> -->
                <span class="forgetpass"> <a href="">Quên mật khẩu?</a> </span>&emsp;
                <div class="submit">
                    <input type="submit" value="Đăng nhập" class="submit1">
                </div>
                <!-- <input type="hidden" name="action" value="home"> -->
                <input type="hidden" name="action" value="login">
                <br>
                <span class="register"> <a href="../view/register.php">Or Sign Up Using </a> </span><br><br>

            </form>
        </div>
    </div>
</body>

</html>a