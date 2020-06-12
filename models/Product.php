<?php

class Product
{
    public function insert($name, $price)
    {
        try {

            $db = DBConnector::getInstance();
            $preparedStatement = $db->prepare(
                'INSERT INTO `products` (`name`, `price`)
         VALUES (:name, :price)'
            );

            $preparedStatement->execute([
                'name' => $name,
                'price' => $price,
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
                'SELECT * FROM `products` 
            WHERE name = :name LIMIT 1 '
            );

            $preparedStatement->execute([
                'name' => $name,
            ]);

            $product = $preparedStatement->fetch();
            if ($product == null) {
                return ['result' => true, 'message' => 'success', 'data' => null];
            }
            return ['result' => true, 'message' => 'success', 'data' => $product];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => 'There is an error while getting the data', 'data' => null];
        }
    }
}