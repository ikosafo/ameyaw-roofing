
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
        
        if ($exists->count > 0) {
            echo 2;
        } else {
            $query = "INSERT INTO `carts`
                (`productId`, 
                 `quantity`, 
                 `uuid`, 
                 `createdAt`)
                VALUES (?, ?, ?, NOW())";
            $healthdb->prepare($query);
            $healthdb->bind(1, $cartid);
            $healthdb->bind(2, '1');
            $healthdb->bind(3, $uuid);
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
        $subtotal
    ) {
        global $healthdb;
    
        // First, check if the order already exists for the given uuid and status = 1
        $getOrder = "SELECT * FROM `orders` WHERE `uuid` = ? AND `status` = 1";
        $healthdb->prepare($getOrder);
        $healthdb->bind(1, $uuid);
        $resultOrder = $healthdb->singleRecord();
    
        // If the order exists, update it
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
            $healthdb->bind(11, $uuid);
    
            if ($healthdb->execute()) {
                echo 3; // Update successful
            } else {
                echo 4; // Update failed
            }
        } else {
            // If the order doesn't exist, insert a new one
            $insertQuery = "INSERT INTO `orders` 
                            (`customerName`, `customerEmail`, `customerPhone`, `customerResidence`, 
                             `uuid`, `deliveryMode`, `address1`, `address2`, `city`, `region`, `totalAmount`, `createdAt`) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
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
            $healthdb->bind(11, $subtotal);
    
            if ($healthdb->execute()) {
                echo 1; // Insert successful
            } else {
                echo 5; // Insert failed
            }
        }
    }
    


    public static function savePayment($paymentMethod,$paymentStatus,$notes,$uuid) {
        global $healthdb;

        $getOrder = "SELECT * FROM `orders` WHERE `uuid` = ? AND `status` = 1";
        $healthdb->prepare($getOrder);
        $healthdb->bind(1, $uuid);
        $resultOrder = $healthdb->singleRecord();
    
        if ($resultOrder) {
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
                echo 3; 
            } else {
                echo 4; 
            }
        }
    }


    public static function orderDetails($uuid, $subtotal) {
        global $healthdb;
    
        $getList = "SELECT * FROM `orders` WHERE `uuid` = '$uuid'";
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
            'address1' => $resultRec->address1 ?? null,
            'address2' => $resultRec->address2 ?? null,
            'city' => $resultRec->city ?? null,
            'region' => $resultRec->region ?? null,
            'uuid' => $resultRec->uuid ?? null,
        ];
    }
    
    
    

}


