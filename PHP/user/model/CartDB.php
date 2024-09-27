<?php
class CartDB
{
    public function ADD_TO_Cart($customer_customerId, $products_productId, $quantity, $date)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO `cart`( `quantity`, `date`, `products_productId`, `customer_customerId`) VALUES (:quantity,:date,:products_productId,:customer_customerId)';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_customerId', $customer_customerId);
        $statement->bindValue(':products_productId', $products_productId);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':date', $date);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Get_Product_Cart($customerId)
    {
        $db = Database::getDB();
        $query = 'SELECT p.productId,p.productName ,p.productlmgMain,p.price,c.quantity FROM cart c JOIN products p on c.products_productId=p.productId WHERE customer_customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    // public function Check_Product_Cart($customerId)
    // {
    //     $db = Database::getDB();
    //     $query = 'SELECT p.productName ,p.productlmgMain,p.price,c.quantity FROM cart c JOIN products p on c.productId=p.productId WHERE customerId=:customerId';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':customerId', $customerId);
    //     $statement->execute();
    //     $lists = $statement->fetchAll();
    //     $statement->closeCursor();
    //     return $lists;
    //     $db = Database::closeConnection();
    // }
    public function UpdateCart($customerId, $productId, $quantity, $date)
    {
        $db = Database::getDB();
        $query = 'UPDATE `cart` SET quantity=:quantity,date=:date WHERE customer_customerId =:customerId and products_productId =:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':productId', $productId);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':date', $date);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Delete_Product_Cart($customerId, $productId)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM `cart` WHERE customer_customerId =:customerId and products_productId =:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Delete_Cart($customerId)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM `cart` WHERE customer_customerId =:customerId ';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
}
