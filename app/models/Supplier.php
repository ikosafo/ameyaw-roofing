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
    


    

}