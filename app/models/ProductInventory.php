<?php

class ProductInventory extends tableDataObject{

    const TABLENAME = 'stockmovements';
    
    public static function saveState($movementType, $description, $quantity, $productId, $uuid) {
        global $healthdb;
    
        $quantityLeft = Tools::getQuantityLeft($productId);
    
        if ($movementType === 'Removed' || $movementType === 'Scrapped' || $movementType === 'Transfered') {
            if ($quantity > $quantityLeft) {
                echo "Insufficient stock to perform this operation.";
                return;
            }
            $newQuantity = $quantityLeft - $quantity;
        } elseif ($movementType === 'Added' || $movementType === 'Repaired') {
            $newQuantity = $quantityLeft + $quantity;
        } else {
            echo "Invalid movement type.";
            return;
        }
    
        $updateQuery = "
            UPDATE `products`
            SET `stockquantity` = :newQuantity
            WHERE `productId` = :productId
        ";
    
        $healthdb->prepare($updateQuery);
        $healthdb->bind(':newQuantity', $newQuantity);
        $healthdb->bind(':productId', $productId);
    
        if ($healthdb->execute()) {
            echo 1;  // Success
        } else {
            echo 5;  // Failure
        }
    
        $query = "
            INSERT INTO `stockmovements` (`uuid`, `productId`, `movementType`, `description`, `quantity`, `status`, `createdAt`, `updatedAt`)
            VALUES (:uuid, :productId, :movementType, :description, :quantity, 1, NOW(), NOW())";
    
        $healthdb->prepare($query);
    
        $healthdb->bind(':uuid', $uuid);
        $healthdb->bind(':productId', $productId);
        $healthdb->bind(':movementType', $movementType);
        $healthdb->bind(':description', $description);
        $healthdb->bind(':quantity', $quantity);
    
        if ($healthdb->execute()) {
            echo 1;  // Success
        } else {
            echo 5;  // Failure
        }
    }

    public static function listMovements() {
        global $healthdb;

        $getList = "SELECT * FROM `stockmovements` where `status` = 1 ORDER BY `movementId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
    
}