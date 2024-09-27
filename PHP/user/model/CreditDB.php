<?php
class CreditDB
{
    public $creditCardCode;
    public $amount;
    public function __construct()
    {
    }
    public static function get_all()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM credits';
        $statement = $db->prepare($query);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
}
