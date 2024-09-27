<?php

class ImgDB
{
    public function __construct()
    {
    }
    public function Get_Imgs_Product($productId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM producttimgs  WHERE products_productId = :productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
}
