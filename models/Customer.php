<?php

class Customer
{
    public function insert($name, $email)
    {
        try {

            $db = DBConnector::getInstance();
            $preparedStatement = $db->prepare(
                'INSERT INTO `customers` (`name`, `email`)
         VALUES (:name, :email)'
            );

            $preparedStatement->execute([
                'name' => $name,
                'email' => $email,
            ]);
            return ['result' => true, 'message' => 'record inserted successfully', 'data' => $db->lastInsertId()];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => $exception->getMessage(), 'data' => null];
        }
    }

    public static function findByName($name)
    {
        try {

            $db = DBConnector::getInstance();
            $preparedStatement = $db->prepare(
                'SELECT * FROM `customers`
            WHERE name = :name LIMIT 1'
            );

            $preparedStatement->execute([
                'name' => $name,
            ]);


            $customer = $preparedStatement->fetch();
            if ($customer == null) {
                return ['result' => true, 'message' => 'success', 'data' => null];
            }
            return ['result' => true, 'message' => 'success', 'data' => $customer];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => 'There is an error while getting the data', 'data' => null];
        }
    }
}