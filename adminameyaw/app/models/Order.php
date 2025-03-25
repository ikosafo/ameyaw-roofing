
<?php

class Order extends tableDataObject
{
    const TABLENAME = 'orders';

    public static function orderItems($searchTerm) {
        global $healthdb;
    
        if (empty($searchTerm)) {
            return null;
        }
    
        // Split the search term into individual words
        $searchWords = explode(' ', $searchTerm);
        $conditions = [];
    
        // Generate the LIKE conditions for each word
        foreach ($searchWords as $word) {
            $conditions[] = "`productName` LIKE '%" . $word . "%'";
        }
    
        // Join the conditions with AND to ensure all words must be present (in any order)
        $searchQuery = implode(' AND ', $conditions);
    
        // Query the database
        $getList = "
            SELECT * FROM `products`
            WHERE `status` = 1 
            AND ($searchQuery)
            ORDER BY `productName`
            LIMIT 5";
    
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
    
        return !empty($resultList) ? $resultList : null;
    }   


    public static function orderItemsCount($searchTerm) {
        global $healthdb;
    
        if (empty($searchTerm)) {
            return 0; 
        }
    
        $searchWords = explode(' ', $searchTerm);
        $conditions = [];
    
        foreach ($searchWords as $word) {
            $conditions[] = "`productName` LIKE '%" . $word . "%'";
        }
    
        $searchQuery = implode(' AND ', $conditions);
    
        $getList = "
            SELECT COUNT(*) as `count`
            FROM `products`
            WHERE `status` = 1
            AND ($searchQuery)";  
        $healthdb->prepare($getList);
        $result = $healthdb->singleRecord();
    
        return $result ? $result->count : 0; 
    }


    public static function insertCart($cartid, $uuid) {
        global $healthdb;
        
        if (empty($cartid)) {
            return; 
        }
    
        $checkQuery = "SELECT COUNT(*) as count FROM `carts` WHERE `status` = '1' AND `productId` = ? AND `uuid` = ?";
        $healthdb->prepare($checkQuery);
        $healthdb->bind(1, $cartid);
        $healthdb->bind(2, $uuid);
        $exists = $healthdb->singleRecord();
        $unitPrice = Tools::getProductPrice($cartid);
        
        if ($exists->count > 0) {
            echo 2;
        } else {
            $query = "INSERT INTO `carts`
                (`productId`, 
                 `quantity`, 
                 `uuid`, 
                 `unitPrice`, 
                 `createdAt`)
                VALUES (?, ?, ?, ?, NOW())";
            $healthdb->prepare($query);
            $healthdb->bind(1, $cartid);
            $healthdb->bind(2, '1');
            $healthdb->bind(3, $uuid);
            $healthdb->bind(4, $unitPrice);
            $healthdb->execute();
            echo 1;
        }
    }
    

    public static function cartItems($uuid) {
        global $healthdb;

        if (empty($uuid)) {
            return; 
        }

        $getList = "SELECT * FROM `carts` where `status` = 1 AND `uuid` = '$uuid' ORDER BY `cartId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function updateQuantity($productId, $quantity, $cartId) {
        global $healthdb;
    
        try {
            if ($quantity < 1) {
                echo json_encode(['success' => false, 'message' => 'Quantity must be at least 1.']);
                return;
            }
    
            // Check stock quantity
            $stockQuery = "SELECT stockQuantity FROM `products` WHERE productId = ?";
            $healthdb->prepare($stockQuery);
            $healthdb->bind(1, $productId);
            $result = $healthdb->singleRecord();
    
            if (!$result) {
                echo json_encode(['success' => false, 'message' => 'Product not found.']);
                return;
            }
    
            $stockQuantity = $result->stockQuantity;
    
            if ($quantity > $stockQuantity) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Quantity exceeds available stock. Only ' . $stockQuantity . ' items are available.'
                ]);
                return;
            }
    
            // Update cart quantity
            $updateQuery = "UPDATE `carts` SET quantity = ? WHERE cartId = ? AND productId = ?";
            $healthdb->prepare($updateQuery);
            $healthdb->bind(1, $quantity);
            $healthdb->bind(2, $cartId);
            $healthdb->bind(3, $productId);
    
            if ($healthdb->execute()) {
                echo json_encode(['success' => true, 'message' => 'Quantity updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update quantity.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public static function deleteCartItem($cartid) {

        global $healthdb;
            $query = "UPDATE `carts` SET `status` = 0,`updatedAt` = NOW()
            WHERE `cartId` = '$cartid'";
            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  
       
    }


    public static function saveCustomer(
        $customerName,
        $customerEmail,
        $customerPhone,
        $customerResidence,
        $uuid,
        $deliveryMode,
        $address1,
        $address2,
        $city,
        $region,
        $subtotal,
        $deliveryCost
    ) {
        global $healthdb;
    
        $getOrder = "SELECT * FROM `orders` WHERE `uuid` = ? AND `status` = 1";
        $healthdb->prepare($getOrder);
        $healthdb->bind(1, $uuid);
        $resultOrder = $healthdb->singleRecord();
        $deliveryCost = !empty($deliveryCost) ? (float) $deliveryCost : 0;
    
        if ($resultOrder) {
            $updateQuery = "UPDATE `orders` 
                            SET `customerName` = ?, 
                                `customerEmail` = ?, 
                                `customerPhone` = ?, 
                                `customerResidence` = ?, 
                                `deliveryMode` = ?, 
                                `address1` = ?, 
                                `address2` = ?, 
                                `city` = ?, 
                                `region` = ?, 
                                `totalAmount` = ?,
                                `deliveryCost` = ?,
                                `updatedAt` = NOW() 
                            WHERE `uuid` = ?";
                            $healthdb->prepare($updateQuery);
                            $healthdb->bind(1, $customerName);
                            $healthdb->bind(2, $customerEmail);
                            $healthdb->bind(3, $customerPhone);
                            $healthdb->bind(4, $customerResidence);
                            $healthdb->bind(5, $deliveryMode);
                            $healthdb->bind(6, $address1);
                            $healthdb->bind(7, $address2);
                            $healthdb->bind(8, $city);
                            $healthdb->bind(9, $region);
                            $healthdb->bind(10, $subtotal);
                            $healthdb->bind(11, $deliveryCost);
                            $healthdb->bind(12, $uuid);
    
                        if ($healthdb->execute()) {
                            echo 3; 
                        } else {
                            echo 4;
                        }
        } else {
            $insertQuery = "INSERT INTO `orders` 
                (`customerName`, `customerEmail`, `customerPhone`, `customerResidence`, 
                 `uuid`, `deliveryMode`, `address1`, `address2`, `city`, `region`, `totalAmount`, `deliveryCost`, `createdAt`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

                    $healthdb->prepare($insertQuery);
                    $healthdb->bind(1, $customerName);
                    $healthdb->bind(2, $customerEmail);
                    $healthdb->bind(3, $customerPhone);
                    $healthdb->bind(4, $customerResidence);
                    $healthdb->bind(5, $uuid);
                    $healthdb->bind(6, $deliveryMode);
                    $healthdb->bind(7, $address1);
                    $healthdb->bind(8, $address2);
                    $healthdb->bind(9, $city);
                    $healthdb->bind(10, $region);
                    $healthdb->bind(11, $subtotal);  // Bind the subtotal to totalAmount
                    $healthdb->bind(12, $deliveryCost);

                    if ($healthdb->execute()) {
                        echo 1;  // Success
                    } else {
                        echo 5;  // Failure
                    }


        }
    }
    

    /* public static function savePayment($paymentMethod, $paymentStatus, $notes, $uuid) {
        global $healthdb;
    
        $getOrder = "SELECT * FROM `orders` WHERE `uuid` = ? AND `status` = 1";
        $healthdb->prepare($getOrder);
        $healthdb->bind(1, $uuid);
        $resultOrder = $healthdb->singleRecord();
    
        if ($resultOrder) {
            $previousPaymentStatus = strtolower($resultOrder->paymentStatus);
            $stockDeducted = $resultOrder->stockDeducted;
    
            $updateQuery = "UPDATE `orders` 
                            SET `paymentMethod` = ?, 
                                `paymentStatus` = ?, 
                                `notes` = ?,
                                `updatedAt` = NOW() 
                            WHERE `uuid` = ?";
            $healthdb->prepare($updateQuery);
            $healthdb->bind(1, $paymentMethod);
            $healthdb->bind(2, $paymentStatus);
            $healthdb->bind(3, $notes);
            $healthdb->bind(4, $uuid);
    
            if ($healthdb->execute()) {
                $newPaymentStatus = strtolower($paymentStatus);
    
                // Revert stock if the paymentStatus changes from 'successful' to something else
                if ($previousPaymentStatus === 'successful' && $newPaymentStatus !== 'successful' && $stockDeducted == 1) {
                    $getProducts = "SELECT `productId`, `quantity` FROM `carts` WHERE `uuid` = ?";
                    $healthdb->prepare($getProducts);
                    $healthdb->bind(1, $uuid);
                    $healthdb->execute();
                    $products = $healthdb->resultSet();
    
                    foreach ($products as $product) {
                        $productId = $product->productId;
                        $quantity = $product->quantity;
    
                        $updateProduct = "UPDATE `products` 
                                          SET `stockQuantity` = `stockQuantity` + ? 
                                          WHERE `productId` = ?";
                        $healthdb->prepare($updateProduct);
                        $healthdb->bind(1, $quantity);
                        $healthdb->bind(2, $productId);
                        $healthdb->execute();
                    }
    
                    $markStockNotDeducted = "UPDATE `orders` SET `stockDeducted` = 0 WHERE `uuid` = ?";
                    $healthdb->prepare($markStockNotDeducted);
                    $healthdb->bind(1, $uuid);
                    $healthdb->execute();
                }
    
                // Deduct stock if the paymentStatus is 'successful' and stock has not been deducted
                if ($newPaymentStatus === 'successful' && $stockDeducted == 0) {
                    $getProducts = "SELECT `productId`, `quantity` FROM `carts` WHERE `uuid` = ?";
                    $healthdb->prepare($getProducts);
                    $healthdb->bind(1, $uuid);
                    $healthdb->execute();
                    $products = $healthdb->resultSet();
    
                    foreach ($products as $product) {
                        $productId = $product->productId;
                        $quantity = $product->quantity;
    
                        $updateProduct = "UPDATE `products` 
                                          SET `stockQuantity` = `stockQuantity` - ? 
                                          WHERE `productId` = ?";
                        $healthdb->prepare($updateProduct);
                        $healthdb->bind(1, $quantity);
                        $healthdb->bind(2, $productId);
                        $healthdb->execute();
                    }
    
                    $markStockDeducted = "UPDATE `orders` SET `stockDeducted` = 1 WHERE `uuid` = ?";
                    $healthdb->prepare($markStockDeducted);
                    $healthdb->bind(1, $uuid);
                    $healthdb->execute();
                }
    
                echo 3;
            } else {
                echo 4;
            }
        }
    }  */


    public static function customerDetails($dbid) {
        global $healthdb;

        $getList = "SELECT * FROM `inspections` where `inspectionid` = '$dbid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
        $clientType = $resultRec->clientType;
        $clientName = $resultRec->clientName;
        $uuid = $resultRec->uuid;
        $displayName = $resultRec->displayName;
        $clientTelephone = $resultRec->clientTelephone;
        $clientEmail = $resultRec->clientEmail;
        $region = $resultRec->region;
        $city = $resultRec->city;
        $siteLocation = $resultRec->siteLocation;
        $siteReport = $resultRec->siteReport;
        $contactPerson = $resultRec->contactPerson;
        $contactPhone = $resultRec->contactPhone;
        $address = $resultRec->address;
        return [
            'clientType' => $clientType,
            'clientName' => $clientName,
            'uuid' => $uuid,
            'displayName' => $displayName,
            'clientTelephone' => $clientTelephone,
            'clientEmail' => $clientEmail,
            'region' => $region,
            'city' => $city,
            'siteLocation' => $siteLocation,
            'siteReport' => $siteReport,
            'contactPerson' => $contactPerson,
            'contactPhone' => $contactPhone,
            'address' => $address
        ];
    }


    public static function orderDetails($uuid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `orders` WHERE `uuid` = '$uuid' OR `orderId` = '$uuid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'customerName' => $resultRec->customerName ?? null,
            'customerEmail' => $resultRec->customerEmail ?? null,
            'customerPhone' => $resultRec->customerPhone ?? null,
            'customerResidence' => $resultRec->customerResidence ?? null,
            'paymentMethod' => $resultRec->paymentMethod ?? null,
            'paymentStatus' => $resultRec->paymentStatus ?? null,
            'notes' => $resultRec->notes ?? null,
            'deliveryMode' => $resultRec->deliveryMode ?? null,
            'deliveryCost' => $resultRec->deliveryCost ?? null,
            'address1' => $resultRec->address1 ?? null,
            'address2' => $resultRec->address2 ?? null,
            'city' => $resultRec->city ?? null,
            'region' => $resultRec->region ?? null,
            'uuid' => $resultRec->uuid ?? null,
            'orderId' => $resultRec->orderId ?? null,
            'createdAt' => $resultRec->createdAt ?? null,
            'updatedAt' => $resultRec->updatedAt ?? null,
            'totalAmount' => $resultRec->totalAmount ?? null,
        ];
    }


    public static function inspectionDetails($uuid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `inspections` WHERE `uuid` = '$uuid' OR `inspectionid` = '$uuid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'inspectionid' => $resultRec->inspectionid ?? null,
            'clientName' => $resultRec->clientName ?? null,
            'clientTelephone' => $resultRec->clientTelephone ?? null,
            'clientEmail' => $resultRec->clientEmail ?? null,
            'siteLocation' => $resultRec->siteLocation ?? null,
            'inspectionDate' => $resultRec->inspectionDate ?? null,
            'inspectorName' => $resultRec->inspectorName ?? null,
            'siteReport' => $resultRec->siteReport ?? null,
            'createdAt' => $resultRec->createdAt ?? null,
            'updatedAt' => $resultRec->updatedAt ?? null,
            'uuid' => $resultRec->uuid ?? null,
            'address' => $resultRec->address ?? null,
            'profile' => $resultRec->profile ?? null,
            'materialType' => $resultRec->materialType ?? null,
            'delivery' => $resultRec->delivery ?? null,
            'installation' => $resultRec->installation ?? null,
            'discount' => $resultRec->discount ?? null,
            'totalPrice' => $resultRec->totalPrice ?? null,
            'paymentPeriod' => $resultRec->paymentPeriod ?? null,
            'paymentMethod' => $resultRec->paymentMethod ?? null,
            'paymentStatus' => $resultRec->paymentStatus ?? null,
            'displayName' => $resultRec->displayName ?? null,
            'clientType' => $resultRec->clientType ?? null,
            'region' => $resultRec->region ?? null,
            'city' => $resultRec->city ?? null,
            'contactPerson' => $resultRec->contactPerson ?? null,
            'contactPhone' => $resultRec->contactPhone ?? null,
        ];
    }


    public static function paymentDetails($paymentid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `invoicepayment` WHERE `paymentId` = '$paymentid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'paymentMethod' => $resultRec->paymentMethod ?? null,
            'amount' => $resultRec->amount ?? null,
            'referenceNumber' => $resultRec->referenceNumber ?? null,
            'paymentDescription' => $resultRec->paymentDescription ?? null,
            'paymentStatus' => $resultRec->paymentStatus ?? null,
            'changeGiven' => $resultRec->changeGiven ?? null,
            'customerid' => $resultRec->customerid ?? null,
            'createdAt' => $resultRec->createdAt ?? null,
            'updatedAt' => $resultRec->updatedAt ?? null,
        ];
    }


    public static function productionDetails($productionid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `production` WHERE `productionid` = '$productionid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'productid' => $resultRec->productid ?? null,
            'quantity' => $resultRec->quantity ?? null,
            'customerid' => $resultRec->customerid ?? null,
            'createdAt' => $resultRec->createdAt ?? null,
            'updatedAt' => $resultRec->updatedAt ?? null,
            'length' => $resultRec->length ?? null,
            'uuid' => $resultRec->uuid ?? null,
            'productionid' => $resultRec->productionid ?? null,
        ];
    }
    

    public static function listOrders() {
        global $healthdb;

        $getList = "SELECT * FROM `inspections` where `status` = 1 ORDER BY `updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listInspections() {
        global $healthdb;

        $getList = "SELECT * FROM `inspections` where `status` = 1 ORDER BY `inspectionid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }



    public static function listProductions() {
        global $healthdb;

        $getList = "SELECT DISTINCT `customerid` FROM `production` WHERE `status` = 1 ORDER BY `productionid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listCustomerOrders($phoneNumber) {
        global $healthdb;

        $getList = "SELECT * FROM `orders` where `customerPhone` = '$phoneNumber' AND `status` = 1 ORDER BY `orderId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listCustomers() {
        global $healthdb;

        $getList = "SELECT DISTINCT `customerPhone` FROM `orders` WHERE `status` = 1 ORDER BY `orderId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listInvoice($inspectionid) {
        global $healthdb;

        $getList = "SELECT * FROM `invoice` WHERE `status` = 1 AND `inspectionid` = '$inspectionid' ORDER BY `invoiceid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listProduction($inspectionid) {
        global $healthdb;

        $getList = "SELECT * FROM `production` WHERE `status` = 1 AND `customerid` = '$inspectionid' ORDER BY `productionid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listOrderStatus($orderStatus) {
        global $healthdb;

        $getList = "SELECT * FROM `inspections` where `status` = 1 AND `paymentStatus` = '$orderStatus' ORDER BY `inspectionid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function getTotalCustomerOrders() {
        global $healthdb;

        $query = "select count(DISTINCT `clientTelephone`) as count from `inspections` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalOrders() {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalPhoneOrders($customerPhone) {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `clientTelephone` = '$customerPhone' AND `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalStatusOrders($orderStatus,$orderFrom, $orderTo) {
        global $healthdb;

        $startDateTime = "$orderFrom 00:00:00";
        $endDateTime = "$orderTo 23:59:59";

        if ($orderStatus == "All") {
            $query = "select count(*) as count from `inspections` WHERE `status` = 1 
            AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime'";
        }
        else {
            $query = "select count(*) as count from `inspections` WHERE `status` = 1 
            AND `paymentStatus` = '$orderStatus' AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime'";
        }
        $query = "select count(*) as count from `inspections` WHERE `status` = 1 
        AND `paymentStatus` = '$orderStatus' AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime'";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalOrdersWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalPhoneOrdersWithFilter($customerPhone,$searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `clientTelephone` = '$customerPhone' AND `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalCustomerOrdersWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(DISTINCT `clientTelephone`) as count from `inspections` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalStatusOrdersWithFilter($orderStatus,$orderFrom, $orderTo,$searchQuery) {
        global $healthdb;

        $startDateTime = "$orderFrom 00:00:00";
        $endDateTime = "$orderTo 23:59:59";

        if ($orderStatus == "All") {
            $query = "select count(*) as count from `inspections` WHERE `status` = 1 AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime' AND 1 " . $searchQuery;
        }
        else {
            $query = "select count(*) as count from `inspections` WHERE `status` = 1 AND `paymentStatus` = '$orderStatus' AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime' AND 1 " . $searchQuery;
        }
        
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function fetchOrdersRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `inspections` WHERE `status` = 1 AND 1 " . $searchQuery . " order by updatedAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchPhoneOrdersRecords($customerPhone,$searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `inspections` WHERE `clientTelephone` = '$customerPhone' AND `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchCustomerOrdersRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select DISTINCT `clientTelephone` from `inspections` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchStatusOrdersRecords($orderStatus,$orderFrom, $orderTo,$searchQuery, $row, $rowperpage) {
        global $healthdb;

        $startDateTime = "$orderFrom 00:00:00";
        $endDateTime = "$orderTo 23:59:59";
  
        if ($orderStatus == "All") {
            $query = "select * from `inspections` WHERE `status` = 1 AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime' AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        }
        else {
            $query = "select * from `inspections` WHERE `status` = 1 AND `paymentStatus` = '$orderStatus' AND `updatedAt` BETWEEN '$startDateTime' AND '$endDateTime' AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        }
        
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }



    public static function saveInspection(
        $clientType,
        $clientName,
        $clientTelephone,
        $clientEmail,
        $region,
        $siteReport,
        $city,
        $address,
        $contactPerson,
        $contactPhone,
        $displayName,
        $uuid,
        $siteLocation
    ) {
        global $healthdb;

        
        $getOrder = "SELECT * FROM `inspections` WHERE `uuid` = ? AND `status` = 1";
        $healthdb->prepare($getOrder);
        $healthdb->bind(1, $uuid);
        $resultOrder = $healthdb->singleRecord();
    
        if ($resultOrder) {
            $query = "UPDATE `inspections`
                      SET
                          `clientName` = ?,
                          `clientTelephone` = ?,
                          `clientEmail` = ?,
                          `clientType` = ?,
                          `region` = ?,
                          `city` = ?,
                          `siteReport` = ?,
                          `address` = ?,
                          `contactPerson` = ?,
                          `contactPhone` = ?,
                          `displayName` = ?,
                          `siteLocation` = ?,
                          `updatedAt` = NOW()
                      WHERE `uuid` = ? AND `status` = 1";
    
            $healthdb->prepare($query);
            $healthdb->bind(1, $clientName);
            $healthdb->bind(2, $clientTelephone);
            $healthdb->bind(3, $clientEmail);
            $healthdb->bind(4, $clientType);
            $healthdb->bind(5, $region);
            $healthdb->bind(6, $city);
            $healthdb->bind(7, $siteReport);
            $healthdb->bind(8, $address);
            $healthdb->bind(9, $contactPerson);
            $healthdb->bind(10, $contactPhone);
            $healthdb->bind(11, $displayName);
            $healthdb->bind(12, $siteLocation);
            $healthdb->bind(13, $uuid);
    
            $healthdb->execute();
        } else {
            // Insert new record
            $query = "INSERT INTO `inspections`
                (
                    `clientName`,
                    `clientTelephone`,
                    `clientEmail`,
                    `clientType`,
                    `region`,
                    `city`,
                    `siteReport`,
                    `address`,
                    `contactPerson`,
                    `contactPhone`,
                    `displayName`,
                    `uuid`,
                    `siteLocation`,
                    `status`,
                    `createdAt`
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())";
    
            $healthdb->prepare($query);
            $healthdb->bind(1, $clientName);
            $healthdb->bind(2, $clientTelephone);
            $healthdb->bind(3, $clientEmail);
            $healthdb->bind(4, $clientType);
            $healthdb->bind(5, $region);
            $healthdb->bind(6, $city);
            $healthdb->bind(7, $siteReport);
            $healthdb->bind(8, $address);
            $healthdb->bind(9, $contactPerson);
            $healthdb->bind(10, $contactPhone);
            $healthdb->bind(11, $displayName);
            $healthdb->bind(12, $uuid);
            $healthdb->bind(13, $siteLocation);
    
            $healthdb->execute();
        }
    
        echo 1;
    }
    



    public static function saveInvoiceDetails($profile, $materialType, $delivery, $installation, $discount, $inspectionid, $totalPrice) {
        global $healthdb;
    
        $query = "UPDATE `inspections` 
                  SET `profile` = ?, 
                      `materialType` = ?, 
                      `delivery` = ?, 
                      `installation` = ?, 
                      `discount` = ?, 
                      `totalPrice` = ?, 
                      `updatedAt` = NOW()
                  WHERE `inspectionid` = ?";
    
                $healthdb->prepare($query); 
                $healthdb->bind(1, $profile);
                $healthdb->bind(2, $materialType);
                $healthdb->bind(3, $delivery);
                $healthdb->bind(4, $installation);
                $healthdb->bind(5, $discount);
                $healthdb->bind(6, $totalPrice);
                $healthdb->bind(7, $inspectionid);  
                $healthdb->execute();
    
        echo 1;
    }
    

    public static function savePayment($paymentMethod,$amountPaid,$inspectionid,$changeGiven) {
        global $healthdb;

        $amountPaid = str_replace(',', '', $amountPaid);
    
        $healthdb->prepare("SELECT `inspectionid` FROM inspections WHERE `inspectionid` = ?");
        $healthdb->bind(1, $inspectionid);
        $customer = $healthdb->singleRecord();
    
        if (!$customer) {
            echo 0; // Invalid inspection ID
            return;
        }
    
        $customerid = $customer->inspectionid;
        $referenceNumber = uniqid('INV'); 
        $paymentDescription = 'Payment for roofing sheet';
    
        $query = "INSERT INTO `invoicepayment` 
                    (`paymentMethod`, `amount`,`changeGiven`, `referenceNumber`, `paymentDescription`, `createdAt`, `updatedAt`, `customerid`, `paymentStatus`)
                  VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?, 'Successful')";
    
        $healthdb->prepare($query);
        $healthdb->bind(1, $paymentMethod);
        $healthdb->bind(2, $amountPaid);
        $healthdb->bind(3, $changeGiven);
        $healthdb->bind(4, $referenceNumber);
        $healthdb->bind(5, $paymentDescription);
        $healthdb->bind(6, $customerid);
        $healthdb->execute();
    
        echo 1; // Success
    }
    



    public static function saveInvoice($product, $length, $width, $rate, $quantity, $totalPrice, $uuid, $inspectionid) {
        global $healthdb;

        $getName = "SELECT * FROM `invoice` WHERE `productid` = '$product' AND `inspectionid` = '$inspectionid' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();
    
        if ($resultName) {
            // Type already exists
            echo 2;
            return;
        }
    
        $query = "INSERT INTO invoice 
            (`inspectionid`, `productid`, `length`, `width`, `rate`, `quantity`, `totalPrice`, `uuid`, `createdAt`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
        $healthdb->prepare($query);
        $healthdb->bind(1, $inspectionid);
        $healthdb->bind(2, $product);
        $healthdb->bind(3, $length);
        $healthdb->bind(4, $width);
        $healthdb->bind(5, $rate);
        $healthdb->bind(6, $quantity);
        $healthdb->bind(7, $totalPrice);
        $healthdb->bind(8, $uuid);
    
        $healthdb->execute();
        echo 1;
    }



    public static function saveProduction($product, $length, $quantity, $uuid, $inspectionid, $productionid) {
        global $healthdb;

        $getName = "SELECT * FROM `production` WHERE `productid` = '$product' AND `length` = '$length' AND `customerid` = '$inspectionid' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();
    
        if ($resultName) {
            echo 2;
            return;
        }


        $insertQuery = "INSERT INTO `production`
                            (`customerid`, `productid`, `length`, `quantity`, `uuid`, `createdAt`) 
                            VALUES (?, ?, ?, ?, ?, NOW())";
            
            $healthdb->prepare($insertQuery);
            $healthdb->bind(1, $inspectionid);
            $healthdb->bind(2, $product);
            $healthdb->bind(3, $length);
            $healthdb->bind(4, $quantity);
            $healthdb->bind(5, $uuid);
    
            if ($healthdb->execute()) {
                echo 1; 
            } else {
                echo 0; 
            }
    
       /*  $checkQuery = "SELECT * FROM `production` WHERE `uuid` = ?";
        $healthdb->prepare($checkQuery);
        $healthdb->bind(1, $uuid);
        $existingRecord = $healthdb->singleRecord();
    
        if ($existingRecord) {
            $updateQuery = "UPDATE `production`
                            SET `productid` = ?, 
                                `length` = ?, 
                                `quantity` = ?, 
                                `updatedAt` = NOW() 
                            WHERE `productionid` = ?";
            
            $healthdb->prepare($updateQuery);
            $healthdb->bind(1, $product);
            $healthdb->bind(2, $length);
            $healthdb->bind(3, $quantity);
            $healthdb->bind(4, $productionid);
    
            if ($healthdb->execute()) {
                echo 1; 
            } else {
                echo 0; 
            }
        } else {
            $insertQuery = "INSERT INTO `production`
                            (`customerid`, `productid`, `length`, `quantity`, `uuid`, `createdAt`) 
                            VALUES (?, ?, ?, ?, ?, NOW())";
            
            $healthdb->prepare($insertQuery);
            $healthdb->bind(1, $inspectionid);
            $healthdb->bind(2, $product);
            $healthdb->bind(3, $length);
            $healthdb->bind(4, $quantity);
            $healthdb->bind(5, $uuid);
    
            if ($healthdb->execute()) {
                echo 1; 
            } else {
                echo 0; 
            }
        } */
    }
    
    

    public static function getTotalInspections() {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalInspectionsInvoice() {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `status` = 1 AND profile != ''";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalPayments() {
        global $healthdb;

        $query = "select count(*) as count from `invoicepayment` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }
    


    public static function getTotalInspectionsWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalInspectionsInvoiceWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `inspections` WHERE `status` = 1 AND profile != '' AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalPaymentsWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `invoicepayment` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }
    

    public static function fetchInspectionsRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `inspections` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchInspectionsInvoiceRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `inspections` WHERE `status` = 1 AND profile != '' AND  1 " . $searchQuery . " order by updatedAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchPaymentsRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `invoicepayment` WHERE `status` = 1 AND  1 " . $searchQuery . " order by updatedAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }
    
    

    public static function deleteInspection($dbid) {

        global $healthdb;
        $query = "UPDATE `inspections` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `inspectionid` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }


    public static function deleteInvoice($dbid) {

        global $healthdb;
        $query = "UPDATE `invoice` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `invoiceid` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }


    public static function deleteProduction($dbid) {

        global $healthdb;
        $query = "UPDATE `production` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `productionid` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }
    
    
    

}


