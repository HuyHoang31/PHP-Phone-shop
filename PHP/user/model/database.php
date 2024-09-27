<?php
class Database
{
    private static $link = 'mysql:host=localhost;dbname=phoneshopp';
    private static $username = 'root';
    private static $password = '';
    private static $db;
    private function __construct()
    {
    }
    public static function getDB()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$link, self::$username, self::$password);
            } catch (PDOException $ex) {
                $erorr_messeger = $ex->getMessage();
                include('../errors/erorr_DB.php');
                exit();
            }
        }
        return self::$db;
    }
    public static function closeConnection()
    {
        if (self::$db !== null) {
            self::$db = null;
        }
    }
}
