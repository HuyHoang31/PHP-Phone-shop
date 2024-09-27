<?php
class CustomerDB
{
    private $customerId, $customerName, $phone, $email, $address, $gender, $birthday, $customerImg;
    public function __construct()
    {
    }   
    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getCustomerImg()
    {
        return $this->customerImg;
    }

    public function setCustomerImg($customerImg)
    {
        $this->customerImg = $customerImg;
    }
    public function Update_Profile($customerId, $customerName, $phone, $email, $birthday, $gender)
    {
        $db = Database::getDB();
        $query = 'UPDATE `customer` SET `customerName`=:customerName,`phone`=:phone,`email`=:email,birthday=:birthday,gender=:gender WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':customerName', $customerName);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':birthday', $birthday);
        $statement->bindValue(':gender', $gender);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Update_Img_Customer($customerId, $customerImg)
    {
        $db = Database::getDB();
        $query = 'UPDATE `customer` SET `customerImg`=:customerImg WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':customerImg', $customerImg);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Update_Address($customerId, $address)
    {
        $db = Database::getDB();
        $query = 'UPDATE `customer` SET address=:address WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':address', $address);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Update_Password($customerId, $password)
    {
        $db = Database::getDB();
        $query = 'UPDATE `customer` SET password=:password WHERE customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
    public function Add_credit()
    {
    }
    public function Get_All_Customers()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM customer';
        $statement = $db->prepare($query);
        $statement->execute();
        $lists = $statement->fetchAll();
        $statement->closeCursor();
        return $lists;
        $db = Database::closeConnection();
    }


    public function Delete_Customer_ADMIN($customerId)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM `customer` WHERE  customerId=:customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $statement->closeCursor();
        $db = Database::closeConnection();
    }
}
