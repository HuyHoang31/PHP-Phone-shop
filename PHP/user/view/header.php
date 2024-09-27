<?php
session_start();
global $guests;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone shop</title>
    <link rel="icon" href="../img/logo/1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../view/css/home.css">
    <link rel="stylesheet" href="../view/css/user.css">
    <link rel="stylesheet" href="../view/css/product.css">
    <link rel="stylesheet" href="../view/css/repon.css">

</head>

<body>
    <section class="nav">
        <p class="p"></p>
        <?php
        if (isset($_SESSION["customerId"]) ) {

            $user = $_SESSION["customerId"];
        ?>
        <div class="login">
            <ul class="main">
                <div class="borders">
                    <?php
                        if ($user['customerImg'] != null) { ?>
                    <img class="link_img" src="../img/<?php echo $user['customerImg']; ?>" alt="avatar">
                    <?php } ?>
                </div>
                <li>
                    <?php
                        echo $user["customerName"];
                        ?>
                    <ul class=" sub">
                        <?php if( $user['customerId']==0) {?>
                        <li><a href="../controller/admin_controller.php">Admin control panel</a></li>
                        <?php  } ?>
                        <li><a href="../view/user_profile.php">Tài khoản</a></li>
                        <?php if( $user['customerId']!=0) {?>
                            <li><a href="../view/history.php">Đơn Hàng</a>  </li>
                        <?php  } ?>
                        <li><a href="../controller/user_controller.php?action=logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <?php } else {

        ?>
        <div class="login hide-on-moblie-tablet .hide-on-moblie">
            <a href="../view/register.php">Đăng kí |</a>&nbsp;
             
            <a href="../view/login.php">Đăng nhập</a>
          
        </div>
        <?php } ?>
    </section>
    <section class="herder">
        <div class="top">
            <div class="img hide-on-moblie-tablet"><img src="../img/logo/1.png" alt="" width="100%"></div>
            <form action="../controller/user_controller.php?action=seach" method="post">
            <div class="seach "><input class="header_seacrch" type="text" name="seach" placeholder="Tìm kiếm theo tên sản phẩm ">
                <button type="submit" class="seach  "><i class="icons bi bi-search"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg></button>
                </div>
            </form>
            <div class="cart"><a href="../view/cart.php">
                    <svg xmlns="http://www.w3.org/2000/svg"    fill="currentColor"
                        class=" icon bi bi-cart" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    <i class="bi bi-cart" id="cart"></i>

                    <!-- <h3>1</h3> -->
                </a>
            </div>
        </div>

    </section>
    <div class="permanent_menu">
        <section class="menu">
            <div>
                <i class="bi bi-list"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </div>
            <section class="nav2">
                <ul>
                    <li><a href="../controller/user_controller.php?action=get_product_home">Trang chủ</a></li>
                    
                    <li><a href="../controller/user_controller.php?action=get_product_c">Sản phẩm</a></li>
                    <li><a href="../view/transport.php">Vận chuyển</a></li>
                    <li><a href="../view/contact.php">Hỗ Trợ</a></li>
                </ul>
            </section>

        </section>
    </div>
 