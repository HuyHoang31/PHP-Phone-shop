<?php
class BuildDB
{
    public function ADD_TO_BUILD($customerId, $productId, $quantity)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO builds (builds.customerId,builds.productId,builds.quantity)
        SELECT :customerId,products.productId,:quantity
        FROM products
        WHERE products.productId=:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':productId', $productId);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Get_Product_Build($categoryId, $customerId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM builds b JOIN products p on b.productId=p.productId
        JOIN customers c ON c.customerId=b.customerId
WHERE p.categoryId=:categoryId and c.customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $lists = $statement->fetch();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Reset_Build($customerId)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM `builds` WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Delete_Product_To_Build($productId)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM builds WHERE productId=:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement;
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Add_Cart_To_Build($customerId, $date)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO cart (cart.customerId,cart.productId,cart.quantity,cart.date)
        SELECT builds.customerId,builds.productId,builds.quantity,:date
        FROM builds
        WHERE builds.customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':date', $date);

        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
}
