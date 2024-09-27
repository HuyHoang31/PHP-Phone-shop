<?php
class OrdersDB
{
    public function Add_Order($customerId, $date, $price, $methodPayment)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO orders (orders.customerId ,orders.productId,orders.quantity,orders.price,orders.methodPayment,orders.date)
        SELECT cart.customer_customerId,cart.products_productId,cart.quantity,:price,:methodPayment,:date
        FROM cart
        WHERE cart.customer_customerId=:customer_customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_customerId', $customerId);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':methodPayment', $methodPayment);
        $statement->execute();
        return $kq = 1;
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Get_Product_Orders_ProductId($productId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM orders where productId=:productId';
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function Get_Product_Orders($customerId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM orders o join products p on o.productId=p.productId where customerId=:customerId order by date DESC';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
    public function History($customerId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM `orders` JOIN products on orders.productId=products.productId WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }
}
 