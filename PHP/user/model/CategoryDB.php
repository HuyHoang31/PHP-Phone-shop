<?php
class CategoryDB
{
    public function Get_Category($categoryId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM `categorys` WHERE ` categoryid`=:categoryId';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();
        $c = $statement->fetch();
        $statement->closeCursor();
        return $c;
        $db = Database::closeConnection();
    }
    public function GetAllCategorys()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM categorys ';
        $statement = $db->prepare($query);
        $statement->execute();
        $c = $statement->fetchAll();
        $statement->closeCursor();
        return $c;
        $db = Database::closeConnection();
    }
}
