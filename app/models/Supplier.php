<?php

class Supplier extends tableDataObject
{
    const TABLENAME = 'suppliers';


    public static function saveSupplier($supplierName, $emailAddress, $phoneNumber, $businessAddress, $productCategory, $notes, $uuid) {
        global $healthdb;
    
        $getName = "SELECT * FROM `suppliers` WHERE `supplierName` = ? AND `uuid` != ? AND `status` = 1";
        $healthdb->prepare($getName);
        $healthdb->bind(1, $supplierName);
        $healthdb->bind(2, $uuid);
        $resultName = $healthdb->singleRecord();
    
        if ($resultName) {
            echo 2; 
            return;
        } else {
           
            $getCategory = "SELECT * FROM `suppliers` WHERE `uuid` = ? AND `status` = 1";
            $healthdb->prepare($getCategory);
            $healthdb->bind(1, $uuid);
            $resultCategory = $healthdb->singleRecord();
    
            if ($resultCategory) {
               
                $updateQuery = "UPDATE `suppliers` 
                                SET `supplierName` = ?, 
                                    `emailAddress` = ?, 
                                    `phoneNumber` = ?, 
                                    `businessAddress` = ?, 
                                    `productCategory` = ?, 
                                    `notes` = ?, 
                                    `updatedAt` = NOW() 
                                WHERE `uuid` = ?";
                $healthdb->prepare($updateQuery);
                $healthdb->bind(1, $supplierName);
                $healthdb->bind(2, $emailAddress);
                $healthdb->bind(3, $phoneNumber);
                $healthdb->bind(4, $businessAddress);
                $healthdb->bind(5, $productCategory);
                $healthdb->bind(6, $notes);
                $healthdb->bind(7, $uuid);
                $healthdb->execute();
    
                echo 3;
                return;
            } else {
               
                $query = "INSERT INTO `suppliers`
                    (`supplierName`, 
                     `emailAddress`, 
                     `phoneNumber`, 
                     `businessAddress`, 
                     `productCategory`, 
                     `notes`, 
                     `uuid`, 
                     `createdAt`, 
                     `status`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 1)";
                $healthdb->prepare($query);
                $healthdb->bind(1, $supplierName);
                $healthdb->bind(2, $emailAddress);
                $healthdb->bind(3, $phoneNumber);
                $healthdb->bind(4, $businessAddress);
                $healthdb->bind(5, $productCategory);
                $healthdb->bind(6, $notes);
                $healthdb->bind(7, $uuid);
                $healthdb->execute();
    
                echo 1; 
            }
        }
    }


    public static function listSuppliers() {
        global $healthdb;

        $getList = "SELECT * FROM `suppliers` where `status` = 1 ORDER BY `supplierId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function deleteSupplier($dbid) {

        global $healthdb;
        $query = "UPDATE `suppliers` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `supplierId` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }


    public static function supplierDetails($dbid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `suppliers` WHERE `supplierId` = '$dbid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        if ($resultRec) {
            $supplierId = $resultRec->supplierId;
            $supplierName = $resultRec->supplierName;
            $emailAddress = $resultRec->emailAddress;
            $phoneNumber = $resultRec->phoneNumber;
            $businessAddress = $resultRec->businessAddress;
            $productCategory = $resultRec->productCategory;
            $notes = $resultRec->notes;
            $uuid = $resultRec->uuid;
            $createdAt = $resultRec->createdAt;
            $updatedAt = $resultRec->updatedAt;
    
            return [
                'supplierId' => $supplierId,
                'supplierName' => $supplierName,
                'emailAddress' => $emailAddress,
                'phoneNumber' => $phoneNumber,
                'businessAddress' => $businessAddress,
                'productCategory' => $productCategory,
                'notes' => $notes,
                'uuid' => $uuid,
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt
            ];
        } else {
            return null; 
        }
    }


    public static function listProducts($supplierId) {
        global $healthdb;

        $getList = "SELECT * FROM `products` where `supplierId` = '$supplierId' AND `status` = 1 ORDER BY `productId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
    


    

}