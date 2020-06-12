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
}