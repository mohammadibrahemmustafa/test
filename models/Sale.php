<?php


class Sale
{
    public static function sumPrices($searchParameters){
        try {

            $db = DBConnector::getInstance();

            $query = 'SELECT SUM(p.price) as \'sumPrices\'  FROM `sales` s
                  INNER JOIN `customers` c ON c.id = s.customer_id
                  INNER JOIN `products` p ON p.id = s.product_id';

            if (count($searchParameters) > 0 ){
                $query = $query . ' WHERE c.name LIKE :customer_name AND p.name LIKE :product_name AND p.price > :price';
                $preparedStatement = $db->prepare($query);
                $preparedStatement->execute(
                    [
                        'customer_name' => $searchParameters['customer_name'] == null ?  '%%' : '%'.$searchParameters['customer_name'].'%' ,
                        'product_name' => $searchParameters['product_name'] == null ?  '%%' : '%'.$searchParameters['product_name'].'%' ,
                        'price' => $searchParameters['price'] == null ?  -1 : $searchParameters['price']
                    ]
                );
            }else{
                $preparedStatement = $db->prepare($query);
                $preparedStatement->execute();

            }

            $sum = $preparedStatement->fetch();
            return ['result' => true, 'message' => 'success', 'data' => $sum];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => 'There is an error while getting the data', 'data' => null];
        }
    }
    public static function select($searchParameters){
        try {

            $db = DBConnector::getInstance();
            $query = 'SELECT c.name as \'customer_name\', p.name as \'product_name\',p.price  FROM `sales` s
                  INNER JOIN `customers` c ON c.id = s.customer_id
                  INNER JOIN `products` p ON p.id = s.product_id';
            if (count($searchParameters) > 0 ){
                $query = $query . ' WHERE c.name LIKE :customer_name AND p.name LIKE :product_name AND p.price > :price';
                $preparedStatement = $db->prepare($query);
                $preparedStatement->execute(
                    [
                        'customer_name' => $searchParameters['customer_name'] == null ?  '%%' : '%'.$searchParameters['customer_name'].'%' ,
                        'product_name' => $searchParameters['product_name'] == null ?  '%%' : '%'.$searchParameters['product_name'].'%' ,
                        'price' => $searchParameters['price'] == null ?  -1 : $searchParameters['price']
                    ]
                );
            }else{
                $preparedStatement = $db->prepare($query);
                $preparedStatement->execute();

            }

            $customers = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
            return ['result' => true, 'message' => 'success', 'data' => $customers];
        } catch (PDOException $exception) {

            return ['result' => false, 'message' => 'There is an error while getting the data', 'data' => null];
        }
    }
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