<?php


class Sale
{
    public function insert($customerId, $productId, $saleDate, $version)
    {
        try {

            $db = DBConnector::getInstance();
            $preparedStatement = $db->prepare(
                'INSERT INTO `sales` (`customer_id`, `product_id`,`sale_date`,`version`)
         VALUES (:customer_id, :product_id,:sale_date,:version)'
            );


            $preparedStatement->execute([
                'customer_id' => $customerId,
                'product_id' => $productId,
                'sale_date' => $saleDate,
                'version' => $version,
            ]);
            return ['result' => true, 'message' => 'record inserted successfully', 'data' => $db->lastInsertId()];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => 'There is an error while inserting the record', 'data' => null];
        }
    }

    public static function sumPrices(){
        try {

            $db = DBConnector::getInstance();
            $preparedStatement = $db->prepare(
                'SELECT SUM(p.price) as \'sumPrices\'  FROM `sales` s
                  INNER JOIN `customers` c ON c.id = s.customer_id
                  INNER JOIN `products` p ON p.id = s.product_id'
            );

            $preparedStatement->execute();
            $sum = $preparedStatement->fetch();
            return ['result' => true, 'message' => 'success', 'data' => $sum];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => $exception->getMessage(), 'data' => null];
        }
    }

    public static function select(){
        try {

            $db = DBConnector::getInstance();
            $preparedStatement = $db->prepare(
                'SELECT c.name as \'customer_name\', p.name as \'product_name\',p.price  FROM `sales` s
                  INNER JOIN `customers` c ON c.id = s.customer_id
                  INNER JOIN `products` p ON p.id = s.product_id'
            );

            $preparedStatement->execute();
            $customers = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
            return ['result' => true, 'message' => 'success', 'data' => $customers];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => $exception->getMessage(), 'data' => null];
        }
    }

}