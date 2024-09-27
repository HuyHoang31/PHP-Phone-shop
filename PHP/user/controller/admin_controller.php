<?php
require('../model/CustomerDB.php');
require('../model/UserDB.php');
require('../model/ProductDB.php');
require('../model/CreditDB.php');
require('../model/CategoryDB.php');
require('../model/BuildDB.php');
require_once('../model/database.php');


$action = filter_input(INPUT_GET, 'action');

if ($action == null) {
    $action = 'lists_customer';
}
if ($action == 'lists_customer') {
    $chose = 1;
    include('../view/admin.php');
}
if ($action == 'lists_product') {
    $categoryId = $_GET['categoryId'];
    $chose = 2;
    include('../view/admin.php');
}
if ($action == 'lists_product_view') {
    $chose = 3;
    include('../view/admin.php');
}
if ($action == 'delete_customer') {
    $customerId = filter_input(INPUT_GET, 'customerId');
    $CustomerDB = new CustomerDB;
    $delete = $CustomerDB->Delete_Customer_ADMIN($customerId);
    $chose = 1;
    include('../view/admin.php');
}
if ($action == 'add_product') {
    $productName = filter_input(INPUT_POST, 'productName');
    $information = filter_input(INPUT_POST, 'information');
    $price = filter_input(INPUT_POST, 'price');
    $priceOld = filter_input(INPUT_POST, 'priceOld');
    $quantity_product=filter_input(INPUT_POST, 'quantity_product');
    $categoryId  = filter_input(INPUT_POST, 'categoryId');
    $ProductDB = new ProductDB;
    $pdN = $ProductDB->Check_Product();

    $productlmgMain = basename($_FILES['productlmgMain']['name']);
    $target_dir = '../img/';
    $target_file = $target_dir . $productlmgMain;
    foreach ($pdN as $pdN) {
        if ($pdN['productName'] == $productName) {
            $c_pdn = 1;
        }
        if ($pdN['productlmgMain'] == $productlmgMain) {
            $c_pdImg = 1;
        }
    }
    if ($categoryId == null) {
        $categoryId = 2;
    }
    if ($productName != null  and $price != null and $productlmgMain != null) {
        if (!isset($c_pdn)) {
            if (is_numeric($price) && is_numeric($priceOld) && intval($priceOld) > intval($price)) {
                if (!isset($c_pdImg)) {
                    move_uploaded_file($_FILES['productlmgMain']["tmp_name"], $target_file);
                    $add_product = $ProductDB->Add_products($productName, $information, $priceOld, $price,$quantity_product, $categoryId, $productlmgMain);
                    $messenger = 'Thêm thành công';
                    header('Location: ../controller/admin_controller.php?action=lists_product&categoryId=' . $categoryId . '');
                    exit();
                } else {
                    $messenger = 'Ảnh đã tồn tại';
                    include('../view/add_products.php');
                }
            } else {
                $messenger = 'Giá tiền phải là số và Giá thị trường phải nhỏ hơn Giá ưu đãi';
                include('../view/add_products.php');
            }
        } else {
            $messenger = 'Tên sản phẩm đã tồn tại';
            include('../view/add_products.php');
        }
    } else {
        $messenger = 'Nhập thiếu dữ liệu';
        include('../view/add_products.php');
    }
}
if ($action == 'logout') {
    session_start();
    session_destroy();
    // Xóa cookie
    setcookie('customerId', '', time() - 3600);
    setcookie('email', '', time() - 3600);
    // header('Location: ../view/login.php');
    include('../view/login.php');
    exit();
}
if ($action == 'edit_product') {
    $categoryId = $_POST['categoryId'];
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $information = $_POST['information'];
    $price = $_POST['price'];
    $priceOld = $_POST['priceOld'];
    $quantity_product=$_POST['quantity_product'];
    $productlmgMain  = basename($_FILES['productlmgMain']['name']);
    $target_dir = '../img/';
    $target_file = $target_dir . $productlmgMain;
    $imageFileType = strtolower(pathinfo($productlmgMain, PATHINFO_EXTENSION));

    $ProductDB = new ProductDB;
    if ($categoryId != null && $productId != null && $productName != null && $price != null) {
        if (is_numeric($priceOld) && is_numeric($price)) {
            if (intval($priceOld) > intval($price)) {
                if ($target_file == null) {
                    $update = $ProductDB->Update_product_ADMIN($productName, $information, $price, $priceOld,$quantity_product, $categoryId, $productId);
                    $messenger = 'Cập nhật thành công';
                    include('../view/form_edit_product.php');
                } else {

                    if ($_FILES["productlmgMain"]["size"] > 500000 and $imageFileType != "jpg" && $imageFileType != "png") {
                        $messenger = 'file ảnh sai định dạng hoặc kích thước ảnh quá lớn';
                        include('../view/form_edit_product.php');
                        exit;
                    } else {
                        if ($productlmgMain == null) {
                            $update = $ProductDB->Update_product_ADMIN($productName, $information, $price, $priceOld,$quantity_product, $categoryId, $productId);
                            $messenger = 'Cập nhật thành công';
                            include('../view/form_edit_product.php');
                        } else {
                            if ($_FILES["productlmgMain"]["size"] > 500000 and $imageFileType != "jpg" && $imageFileType != "png") {
                                $messenger = 'file ảnh sai định dạng hoặc kích thước ảnh quá lớn';
                                include('../view/form_edit_product.php');
                                exit;
                            } else {
                                if (file_exists("$target_dir/$productlmgMain")) {
                                    $messenger = 'file ảnh đã tồn tại';
                                    include('../view/form_edit_product.php');
                                    exit;
                                } else {
                                    move_uploaded_file($_FILES['productlmgMain']["tmp_name"], $target_file);
                                    if ($productlmgMain == null) {
                                        $update = $ProductDB->Update_product_ADMIN($productName, $information, $price, $priceOld,$quantity_product, $categoryId, $productId);
                                        $messenger = 'Cập nhật thành công';
                                        include('../view/form_edit_product.php');
                                    } else {
                                        $update_img = $ProductDB->Update_product_ADMIN_Img($productlmgMain, $productId);
                                        $update = $ProductDB->Update_product_ADMIN($productName, $information, $price, $priceOld,$quantity_product,$categoryId, $productId);
                                        $messenger = 'Cập nhật thành công';
                                        include('../view/form_edit_product.php');
                                    }
                                }
                            }
                        }
                        // }
                    }
                }
            } else {
                $messenger = 'Giá giảm giá phải lớn hơn giá thị trường';
                include('../view/form_edit_product.php');
            }
        } else {
            $messenger = 'Giá giảm giá và giá thị trường phải là số';
            include('../view/form_edit_product.php');
        }
    } else {
        $messenger = 'Nhập thiếu dữ liệu.';
        include('../view/form_edit_product.php');
    }
}
if ($action == "delete_product") {
    $productId = $_GET['productId'];
    $ProductDB = new ProductDB;
    $delete = $ProductDB->Delete_Product_ADMIN($productId);
    header('Location: ../controller/admin_controller.php?action=lists_product&categoryId=' . $_GET['categoryId'] . '');
    exit();
}
if ($action == 'seach') {
    $seach = filter_input(INPUT_POST, 'seach');
    if ($seach == null) {
        $s = 1;
        include('../view/seach_product_admin.php');
    } else {
        $seach_p = '%' . $seach . '%';
        $ProductDB = new ProductDB;
        $seach_product = $ProductDB->Get_Product_Seach($seach_p);
        include('../view/seach_product_admin.php');
    }
}
if ($action == 'arrange') {
    $value = $_GET['value'];
    header('Location: ../view/admin.php?value=' . $_GET['value'] . '');
    exit();
}