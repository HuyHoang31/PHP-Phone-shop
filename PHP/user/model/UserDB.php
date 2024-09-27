<?php
class UserDB
{
    private $customerId, $customerName, $phone, $email, $address, $password, $gender, $birthday, $customerImg;
    public function __construct()
    {
    }
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }
    public function setCustomerImg($customerImg)
    {
        $this->customerImg = $customerImg;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function Check_Email($email)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM customer WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $c_e = $statement->fetch();
        $statement->closeCursor();
        return $c_e;
        $db = Database::closeConnection();
    }

    public function Check_Phone($phone)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM customer WHERE phone = :phone';
        $statement = $db->prepare($query);
        $statement->bindValue(':phone', $phone);
        $statement->execute();
        $c_p = $statement->fetch();
        $statement->closeCursor();
        return $c_p;
        $db = Database::closeConnection();
    }
    public function Register($email, $password, $phone, $customerName)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO `customer`(`email`, `password`,phone,customerName) VALUES (:email,:password,:phone,:customerName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':customerName', $customerName);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Check_Password($customerId)
    {
        $db = Database::getDB();
        $query = 'SELECT password FROM customer WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $c_p = $statement->fetchColumn();
        $statement->closeCursor();
        return $c_p;
        $db = Database::closeConnection();
    }
}
