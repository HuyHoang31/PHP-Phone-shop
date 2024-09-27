<?php
class ProductDB
{
    private $productId, $productName, $information, $price,$quantity_product, $separetaCategoryId;
    public function __construct()
    {
    }
    public function Get_Product_To_Category($categoryId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products  WHERE categorys_categoryid = :categoryId';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Get_Product_Category1()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM `products` WHERE `categorys_categoryid`=1';
        $statement = $db->prepare($query);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }

    public function Get_Product_Build($productId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products  WHERE productId = :productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetch();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Get_Product_Detail($categoryId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products  WHERE categorys_categoryid = :categoryId LIMIT 10';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Get_Product_Seach($seach)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM `products` WHERE productName like :seach';
        $statement = $db->prepare($query); //  chuẩn bị truy vấn SQL để thực thi, sử dụng kết nối cơ sở dữ liệu đã thiết lập trước đó.
        $statement->bindValue(':seach', $seach); // gán giá trị của tham số $seach vào tham số với tên :seach trong truy vấn SQL. Điều này đảm bảo rằng truy vấn sẽ xử lý chuỗi tìm kiếm một cách an toàn.
        $statement->execute();//thực thi truy vấn đã chuẩn bị trước đó.
        $lists = $statement->fetchAll(); //Lấy tất cả các dòng kết quả từ truy vấn và lưu chúng vào một mảng đa chiều $lists.
        $statement->closeCursor(); // đóng con trỏ kết quả của truy vấn, giải phóng tài nguyên.
        return $lists;// trả về mảng chứa kết quả của truy vấn cho người gọi của hàm.
        $db = Database::closeConnection();
    }
    public function Get_Number_Viewd($productId)
    {
        $db = Database::getDB();
        $query = 'SELECT numberViewed FROM products  WHERE productId = :productId';
        $statement = $db->prepare($query); 
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetch();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Add_Number_View($numberViewd, $productId)
    {
        $db = Database::getDB();
        $query = 'UPDATE products SET numberViewed=:numberViewd WHERE productId =:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':numberViewd', $numberViewd);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Add_products($productName, $information, $priceOld, $price, $quantity_product,$categorys_categoryid, $productlmgMain)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO `products`(`productName`, `infomation`,priceOld,price,quantity_product,categorys_categoryid,productlmgMain) VALUES (:productName,:information,:priceOld,:price,:quantity_product,:categorys_categoryid,:productlmgMain)';
        $statement = $db->prepare($query);
        $statement->bindValue(':productName', $productName);
        $statement->bindValue(':information', $information);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':priceOld', $priceOld);
        $statement->bindValue(':quantity_product', $quantity_product);
        $statement->bindValue(':categorys_categoryid', $categorys_categoryid);
        $statement->bindValue(':productlmgMain', $productlmgMain);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Get_Product_Home_Id()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products WHERE categorys_categoryid= 2 or categorys_categoryid= 3 or categorys_categoryid= 4 order by productId desc LIMIT 9 ';
        $statement = $db->prepare($query);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Get_Infor_Product($productId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products  WHERE productId = :productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetch();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
        public function Get_Infor_Products($productId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products  WHERE productId = :productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Update_product_ADMIN($productName, $information, $price, $priceOld,$quantity_product, $categoryId, $productId)
    {
        $db = Database::getDB();
        $query = 'UPDATE `products` SET productName=:productName,infomation=:information,price=:price,priceOld=:priceOld,quantity_product=:quantity_product,categorys_categoryid=:categoryId WHERE productId=:productId;';
        $statement = $db->prepare($query);
        $statement->bindValue(':productName', $productName);
        $statement->bindValue(':information', $information);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':priceOld', $priceOld);
        $statement->bindValue(':quantity_product', $quantity_product);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Update_product_ADMIN_Img($productlmgMain, $productId)
    {
        $db = Database::getDB();
        $query = 'UPDATE `products` SET productlmgMain=:productlmgMain WHERE productId=:productId;';
        $statement = $db->prepare($query);
        $statement->bindValue(':productlmgMain', $productlmgMain);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Delete_Product_ADMIN($productId)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM `products` WHERE productId=:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Get_Product_View()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products  order by numberViewed desc ';
        $statement = $db->prepare($query);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;

        $db = Database::closeConnection();
    }
    public function Check_Product()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM products ';
        $statement = $db->prepare($query);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Update_quantity_product($value,$productId)
    {
        $db = Database::getDB();
        $query = 'UPDATE `products` SET`quantity_product`=quantity_product-:value WHERE `productId`=:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':value', $value);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
}
