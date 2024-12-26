
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
    
            $query = "UPDATE `carts` SET quantity = ? WHERE cartId = ? AND productId = ?";
            $healthdb->prepare($query);
    
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
    
    
    

}


