<?php
global $ss;
global $messager; ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../view/css/login.css">
</head>

<body>
    <div></div>
    <div class="full_form">

        <form action="../controller/user_controller.php?action=register" method="post">
            <h1 class="name">Đăng kí</h1>
            <?php if ($ss == 2) {  ?>
            <h5><?php echo $messager ?></h5>
            <input class="input" type="email" name="email" placeholder="Email" <?php echo 'class="error"' ?>><br><br>
            <input type="text" name="phone" placeholder="Số điện thoại" <?php echo 'class="error"' ?>><br><br>
            <input type="text" name="customerName" placeholder="Họ và tên" <?php echo 'class="error"' ?>><br><br>
            <input type="password" name="password" placeholder="Password" <?php echo 'class="error"' ?>><br><br>
            <input type="password" name="password2" placeholder="Nhập lại password"
                <?php echo 'class="error"' ?>><br><br>
            <input type="submit" value="register" class="submit1" name="action"><br><br>
            <a href="../view/login.php"><input type="button" value="Đăng nhập"></a>
            <?php } else { ?>
            <input class="input" type="email" name="email" placeholder="Email"><br><br>
            <input class="input" type="text" name="phone" placeholder="Số điện thoại"><br><br>
            <input class="input" type="text" name="customerName" placeholder="Họ và tên"><br><br>
            <input class="input" type="password" name="password" placeholder="Password"><br><br>
            <input class="input" type="password" name="password2" placeholder="Nhập lại password"><br><br>
            <input type="submit" value="register" class="submit1" name="action"><br><br>
            <span class="register"> <a href="../view/login.php">Or Login Up Using </a> </span><br><br>
            <?php } ?>
        </form>
    </div>
    <footer>

    </footer>
</body>

</html>