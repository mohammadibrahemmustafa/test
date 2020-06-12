<?php
    require_once '../db/DBConnector.php';
    require_once '../models/Customer.php';
    require_once '../models/Sale.php';
    require_once '../models/Product.php';

    $salesString = file_get_contents('../data/sales.json');

    $salesArray = json_decode($salesString);

    $db = DBConnector::getInstance();
    $db->beginTransaction();
    foreach ($salesArray as $saleItem) {

        $customerName = $saleItem->customer_name;
        $customerResult = Customer::findByName($customerName);

        // if an exception happened

        if (!$customerResult['result']) {
            echo $customerResult['message'];
            $db->rollBack();
            break;
        }

        // if the customer is not exist

        if ($customerResult['data'] == null) {

            //create and insert a customer
            $customer = new Customer();
            $customerInsertedResult = $customer->insert($customerName, $saleItem->customer_mail);

            if (!$customerInsertedResult['result']) {
                echo $customerInsertedResult['message'];
                $db->rollBack();
                break;
            }
            $customerId = $customerInsertedResult['data'];
            // if the customer is exist
        } else {
            $customerId = $customerResult['data']['id'];

        }

        // product handling
        $productName = $saleItem->product_name;
        $productResult = Product::findByName($productName);

        // if an exception happened
        if (!$productResult['result']) {
            echo $productResult['message'];
            $db->rollBack();
            break;
        }

        // if the product is not exist

        if ($productResult['data'] == null) {
            $product = new Product();
            $productInsertedResult = $product->insert($productName, $saleItem->product_price);
            if (!$productInsertedResult['result']) {
                echo $productInsertedResult['message'];
                $db->rollBack();
                break;
            }
            $productId = $productInsertedResult['data'];
            // if the product is exist
        } else {

            $productId = $productResult['data']['id'];
        }

        // create new sale
        $sale = new Sale();

        $saleInsertedResult = $sale->insert($customerId, $productId, $saleItem->sale_date, $saleItem->version);

        if (!$saleInsertedResult['result']) {
            echo $saleInsertedResult['message'];
            $db->rollBack();
            break;
        }
    }
    if (!$db->commit()) {
        echo 'failed';
    } else {
        echo 'success';
    }

