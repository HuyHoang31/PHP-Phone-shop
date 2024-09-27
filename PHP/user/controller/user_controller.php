<?php
require('../model/database.php');
require('../model/CustomerDB.php');
require('../model/UserDB.php');
require('../model/ProductDB.php');
require('../model/CreditDB.php');
require('../model/CategoryDB.php');
require('../model/BuildDB.php');
require('../model/CartDB.php');
require('../model/Orders.php');


$action = filter_input(INPUT_GET, 'action');
if ($action == null) {
    $action = 'home';
}
if ($action == 'home') {
    include('../view/homepage.php');
}
if ($action == 'login') {
    $email = filter_input(INPUT_POST, 'email');
    $password = md5(filter_input(INPUT_POST, 'password'));
    $UserDB = new UserDB;
    $user = $UserDB->Check_Email($email);
    if ($user) {
        if ($password == $user["password"]) {
            $guests = 1;
            session_start();
            $_SESSION['customerId'] = $user;
                header('Location: ../view/homepage.php');
                exit();
            
        } else {
            $index = 1;
            include('../view/login.php');
        }
    } else {
        $index = 1;
        include('../view/login.php');
    }
}
if ($action == 'register') {
    $email = filter_input(INPUT_POST, 'email');
    $customerName = filter_input(INPUT_POST, 'customerName');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');
    $password2 = filter_input(INPUT_POST, 'password2');
    $hashedPassword = md5($password);
    $UserDB = new UserDB;
    $c_e = $UserDB->Check_Email($email);
    $c_p = $UserDB->Check_Phone($phone);
    if ($c_e == false and $c_p == false) {
        if ($email != null  && $password != null && $password2 != null && $phone != null & $customerName != null) {
            if (preg_match("/^0[0-9]{9}$/", $phone)) {
                if (preg_match("/^.{6,}$/", $password)) {
                    if ($password == $password2) {
                        $UserDB = new UserDB;
                        $user = $UserDB->Register($email, $hashedPassword, $phone, $customerName);
                        $ss = 1;
                        include('../view/login.php');
                    } else {
                        $ss = 2;
                        $messager = 'Xác nhận mật khẩu không trùng khớp';
                        include('../view/register.php');
                    }
                } else {
                    $ss = 2;
                    $messager = 'mật khẩu phải từ 6 trở lên và không được chứa khoảng trắng';
                    include('../view/register.php');
                }
            } else {
                $ss = 2;
                $messager = 'Số điện thoại không đúng định dạng ';
                include('../view/register.php');
            }
        } else {
            $ss = 2;
            $messager = 'Nhập thiếu dữ liệu ';
            include('../view/register.php');
        }
    } else {
        $ss = 2;
        $messager = 'Email hoặc SDT đã được đăng kí trước';
        include('../view/register.php');
    }
}

if ($action == 'logout') {
    session_start();
    session_destroy();
    // Xóa cookie
    setcookie('customerId', '', time() - 3600);
    setcookie('email', '', time() - 3600);
    header('Location: ../view/homepage.php');
    exit();
}

// update user

if ($action == 'update_profile') {
    $customerId = filter_input(INPUT_POST, 'customerId');
    $customerName = filter_input(INPUT_POST, 'customerName');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $birthday = filter_input(INPUT_POST, 'birthday');
    $gender = filter_input(INPUT_POST, 'gender');
    $CustomerDB = new CustomerDB;
    $UserDB = new UserDB;
    if ($email != null and $phone != null and $customerName != null) {
        if (preg_match("/^0[0-9]{9}$/", $phone)) {
            $u = $CustomerDB->Update_Profile($customerId, $customerName, $phone, $email, $birthday, $gender);
            $user = $UserDB->Check_Email($email);
            session_start();
            $_SESSION['customerId'] = $user;
            session_write_close();
            $messager = 'Cập nhật thành công.';
            include('../view/user_profile.php');
            exit();
        } else {
            $messager = 'Số điện thọai không đúng định dạng';
            include('../view/user_profile.php');
        }
        $messager = 'Không được để trống email ,số điện thoại , họ và tên';
        include('../view/user_profile.php');
    }
}
if ($action == 'update_img_customer') {
    $customerId = filter_input(INPUT_POST, 'customerId');
    $email = filter_input(INPUT_POST, 'email');
    $customerImg = basename($_FILES['customerImg']['name']);
    $target_dir = '../img/';
    $target_file = $target_dir . $customerImg;
    move_uploaded_file($_FILES['customerImg']["tmp_name"], $target_file);
    $CustomerDB = new CustomerDB;
    $UserDB = new UserDB;
    $u = $CustomerDB->Update_Img_Customer($customerId, $customerImg);
    $user = $UserDB->Check_Email($email);
    session_start();
    $_SESSION['customerId'] = $user;
    session_write_close();
    include('../view/user_profile.php');
}
if ($action == 'update_address') {
    $customerId = filter_input(INPUT_POST, 'customerId');
    $email = filter_input(INPUT_POST, 'email');
    $specific_address = filter_input(INPUT_POST, 'specific_address');
    $general_address = filter_input(INPUT_POST, 'general_address');
    $address = $specific_address . '-' . $general_address;
    $CustomerDB = new CustomerDB;
    $UserDB = new UserDB;
    $u = $CustomerDB->Update_Address($customerId, $address);
    $user = $UserDB->Check_Email($email);
    session_start();
    $_SESSION['customerId'] = $user;
    session_write_close();
    $messager = 'Cập nhật thành công.';
    include('../view/user_address.php');
    exit();
}
if ($action == 'update_password') {
    $customerId = filter_input(INPUT_POST, 'customerId');
    $passwordOld = filter_input(INPUT_POST, 'passwordOld');
    $passwordNew = filter_input(INPUT_POST, 'passwordNew');
    $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');
    $hashedPassword = md5($passwordNew);
    $hashedPasswordOld = md5($passwordOld);
    $CustomerDB = new CustomerDB;
    $UserDB = new UserDB;
    $c_p = $UserDB->Check_Password($customerId);
    if ($c_p === $hashedPasswordOld) {
        if (preg_match("/^.{6,}$/", $password)) {
            if ($passwordNew == $passwordConfirm) {
                $u_p = $CustomerDB->Update_Password($customerId, $hashedPassword);
                $messager = "Chỉnh sửa thành công.";
                include("../view/user_change_password.php");
            } else {
                $messager = "Xác nhận mật khẩu không chính xác.";
                include("../view/user_change_password.php");
            }
        } else {
            $messager = "Mật khẩu không được ít hơn 6 kí tự";
            include("../view/user_change_password.php");
        }
    } else {
        $messager = "Mật khẩu cũ không chính xác.";
        include("../view/user_change_password.php");
    }
}
if ($action == 'get_product_home') {
    $categoryId = filter_input(INPUT_POST, 'categoryId');
    $categoryId = filter_input(INPUT_GET, 'categoryId');
    $ProductDB = new ProductDB;
    $ProductDB->Get_Product_Category1($categoryId);
    include('../view/homepage.php');
}
if ($action == 'get_product_c') {
    $categoryid = filter_input(INPUT_GET, 'categoryid');
    if($categoryid==null){
        $categoryid=2;
    }
    $ProductDB = new ProductDB;
    $lists = $ProductDB->Get_Product_To_Category($categoryid);
    include('../view/product.php');

    
}
if ($action == 'get_product_build') {
    $categoryId = filter_input(INPUT_GET, 'categoryId');
    $ProductDB = new ProductDB;
    $lists = $ProductDB->Get_Product_To_Category($categoryId);
    include('../view/build.php');
}
if ($action == 'get_category') {
    $categoryId = filter_input(INPUT_POST, 'categoryId');
    $categoryId = filter_input(INPUT_GET, 'categoryId');
    $CategoryDB = new CategoryDB;
    $get_category = $CategoryDB->Get_Category($categoryId);
    include('../view/product.php');
}
if ($action == 'get_detail_product') {
    $productId = filter_input(INPUT_GET, 'productId');
    $numberViewed = filter_input(INPUT_GET, 'numberViewed');
    $ProductDB = new ProductDB;
    $detail_product = $ProductDB->Get_Product_Build($productId);
    $number_viewed_p = $numberViewed + 1;
    $add_number_view = $ProductDB->Add_Number_View($number_viewed_p, $productId);
    include('../view/detail_product.php');
}
if ($action == 'seach') {
    $seach = filter_input(INPUT_POST, 'seach');
    if ($seach == null) {
        include('../view/homepage.php');
    } else {
        $seach_p = '%' . $seach . '%';
        $ProductDB = new ProductDB;
        $seach_product = $ProductDB->Get_Product_Seach($seach_p);
        include('../view/seach.php');
    }
}







// cart_-------------



if ($action == 'add_product_cart') {
    $customerId = $_POST['customerId'];
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    if ($quantity == null) {
        $quantity = 1;
    }
    $date = date('Y-m-d');
    $CartDB = new CartDB;
    $c_pr = $CartDB->Get_Product_Cart($customerId);
    $c_product = 0;
    foreach ($c_pr as $c_pr) {
        if ($c_pr['productId'] == $productId) {
            $c_product = 1;
        }
    }
    if ($c_product == 0) {
        $CartDB->ADD_TO_Cart($customerId, $productId, $quantity, $date);
    } else {
        $newquantity = $quantity + $c_pr['quantity'];
        ///
        $CartDB->UpdateCart($customerId, $productId, $newquantity, $date);
    }
    header('Location: ../view/cart.php');
    exit();
}
if ($action == 'delete_product_cart') {
    $customerId = $_POST['customerId'];
    $productId = $_POST['productId'];
    $CartDB = new CartDB;
    $CartDB->Delete_Product_Cart($customerId, $productId);
    // echo 'xóa thành công';
    header('Location: ../view/cart.php');
    exit();
}

if ($action == 'delete_cart') {
    $customerId = $_POST['customerId'];
    $CartDB = new CartDB;
    $CartDB->Delete_Cart($customerId);
    // echo 'xóa thành công';
    header('Location: ../view/cart.php');
    exit();
}



// Cart--Session

// if ($action == 'add_product_cart') {
//     session_start();
//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }
//     $productId = $_POST['productId'];
//     $productName = $_POST['productName'];
//     $quantity = $_POST['quantity'];
//     if ($quantity == null) {
//         $quantity = 1;
//     }
//     $price = $_POST['price'];
//     $information = $_POST['information'];
//     $productlmgMain = $_POST['productlmgMain'];
//     $cc = 0;
//     $i = 0;
//     foreach ($_SESSION['cart'] as $item) {
//         if ($item[1] == $productName) {
//             $newquantity = $quantity + $item[2];
//             $_SESSION['cart'][$i][2] = $newquantity;
//             $cc = 1;
//             break;
//         }
//         $i++;
//     }
//     if ($cc == 0) {
//         $item = array($productId, $productName, $quantity, $price, $information, $productlmgMain);
//         $_SESSION['cart'][] = ($item);
//         session_write_close();
//     }
//     header('Location: ../view/cart.php');
//     exit();
// }
// if ($action == 'delete_all_cart') {
//     session_start();
//     if (isset($_SESSION['cart'])) {
//         unset($_SESSION['cart']);
//         session_write_close();
//         header('Location: ../view/cart.php');
//         exit();
//     }
// }
// if ($action == 'delete_product_cart') {
//     session_start();
//     $i = $_POST['i'];
//     array_splice($_SESSION['cart'], $i, 1);
//     session_write_close();
//     header('Location: ../view/cart.php');
//     exit();
// }






if ($action == 'payment') {
    $customerId = $_POST['customerId'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $methodPayment = $_POST['methodPayment'];
    // $quantity_product=$_POST['quantity_product'];
    $date = date("Y-m-d");

    $CartDB = new CartDB;
    $ProductDB = new ProductDB;
    $OrdersDB=new OrdersDB;
    $list_cart = $CartDB->Get_Product_Cart($customerId);
    if ($list_cart != null) {
        if ($address != null) {
            foreach ($list_cart as $product) {
                    $chek_quantity=$ProductDB->Get_Infor_Product($product['productId']);
                    if($product['quantity']<=$chek_quantity['quantity_product']){
                    $ProductDB->Update_quantity_product($product['quantity'],$product['productId']);
                    $kq = $OrdersDB->Add_Order($customerId, $date, $price, $methodPayment);
                }else{
                $messagers = 'Đặt hàng thất bại thử lại sau.Hàng đã hết';
            include('../view/bill.php');

                }
            }
            if (isset($kq) && $kq == 1) {
                $CartDB->Delete_Cart($customerId);
                $messagers = 'Đặt hàng thành công.';
                $s=1;
            include('../view/homepage.php');

            } else {
                $messagers = 'Đặt hàng thất bại thử lại sau';
            }
        } else {
            $messagers = 'Vui lòng nhập địa chỉ nhận hàng';
            include('../view/bill.php');
        }
    } else {
        $messagers = 'Không tìm thấy sản phẩm bạn muốn mua';
        include('../view/bill.php');
    }
}
