<?php

class Product extends tableDataObject
{
    const TABLENAME = 'products';


    public static function saveCategory($categoryName,$uuid) {
        global $healthdb;
    
        $getName = "SELECT * FROM `productcategories` WHERE `categoryName` = '$categoryName' AND `uuid` != '$uuid' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();
    
        if ($resultName) {
            // Category already exists
            echo 2;
            return;
        } else {
            $getCategory = "SELECT * FROM `productcategories` WHERE `uuid` = '$uuid' AND `status` = 1";
            $healthdb->prepare($getCategory);
            $resultCategory = $healthdb->singleRecord();
    
            if ($resultCategory) {
                $updateQuery = "UPDATE `productcategories` 
                                SET `categoryName` = '$categoryName', `updatedAt` = NOW() WHERE `uuid` = '$uuid'";
                $healthdb->prepare($updateQuery);
                $healthdb->execute();
                echo 3; 
                return;
            } else {
                $query = "INSERT INTO `productcategories`
                (`categoryName`,`uuid`,`createdAt`)
                VALUES ('$categoryName','$uuid',NOW())";
                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1; 
            }
        }
    }


    public static function listCategories() {
        global $healthdb;

        $getList = "SELECT * FROM `productcategories` where `status` = 1 ORDER BY `categoryId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function categoryDetails($catid) {
        global $healthdb;

        $getList = "SELECT * FROM `productcategories` where `categoryId` = '$catid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
        $categoryId = $resultRec->categoryId;
        $categoryName = $resultRec->categoryName;
        $uuid = $resultRec->uuid;
        return [
            'categoryId' => $categoryId,
            'categoryName' => $categoryName,
            'uuid' => $uuid
        ];
    }

    
    public static function deleteCategory($catid) {

        global $healthdb;
            $query = "UPDATE `productcategories` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `categoryId` = '$catid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  
       
    }


    public static function listProducts() {
        global $healthdb;

        $getList = "SELECT * FROM `products` where `status` = 1 ORDER BY `productId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function saveProduct(
        $productName, 
        $productCategory, 
        $thickness, 
        $materialType, 
        $color, 
        $length, 
        $width, 
        $stockQuantity, 
        $price, 
        $supplier, 
        $uuid
    )  
    {
            global $healthdb;
        
            $getName = "SELECT * FROM `products` WHERE `productName` = ? AND `uuid` != ? AND `status` = 1";
            $healthdb->prepare($getName);
            $healthdb->bind(1, $productName);
            $healthdb->bind(2, $uuid);
            $resultName = $healthdb->singleRecord();
        
            if ($resultName) {
                echo 2; 
                return;
            }
        
            $getCategory = "SELECT * FROM `products` WHERE `uuid` = ? AND `status` = 1";
            $healthdb->prepare($getCategory);
            $healthdb->bind(1, $uuid);
            $resultCategory = $healthdb->singleRecord();
        
            if ($resultCategory) {
                $updateQuery = "UPDATE `products` 
                                SET `productName` = ?, 
                                    `categoryId` = ?, 
                                    `materialType` = ?, 
                                    `color` = ?, 
                                    `thickness` = ?, 
                                    `length` = ?, 
                                    `width` = ?, 
                                    `unitPrice` = ?, 
                                    `stockQuantity` = ?, 
                                    `supplierId` = ?, 
                                    `updatedAt` = NOW() 
                                WHERE `uuid` = ?";
                $healthdb->prepare($updateQuery);
                $healthdb->bind(1, $productName);
                $healthdb->bind(2, $productCategory);
                $healthdb->bind(3, $materialType);
                $healthdb->bind(4, $color);
                $healthdb->bind(5, $thickness);
                $healthdb->bind(6, $length);
                $healthdb->bind(7, $width);
                $healthdb->bind(8, $price);
                $healthdb->bind(9, $stockQuantity);
                $healthdb->bind(10, $supplier);
                $healthdb->bind(11, $uuid);
        
                if ($healthdb->execute()) {
                    echo 3; 
                } else {
                    echo 4; 
                }
                return;
            } else {
                
                $insertQuery = "INSERT INTO `products` 
                                (`productName`, `categoryId`, `materialType`, `color`, `thickness`, 
                                `length`, `width`, `unitPrice`, `stockQuantity`, `supplierId`, 
                                `uuid`, `createdAt`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                $healthdb->prepare($insertQuery);
                $healthdb->bind(1, $productName);
                $healthdb->bind(2, $productCategory);
                $healthdb->bind(3, $materialType);
                $healthdb->bind(4, $color);
                $healthdb->bind(5, $thickness);
                $healthdb->bind(6, $length);
                $healthdb->bind(7, $width);
                $healthdb->bind(8, $price);
                $healthdb->bind(9, $stockQuantity);
                $healthdb->bind(10, $supplier);
                $healthdb->bind(11, $uuid);
        
                if ($healthdb->execute()) {
                    echo 1;
                } else {
                    echo 5; 
                }
                return;
        }
    }


    public static function getTotalProducts() {
        global $healthdb;

        $query = "select count(*) as count from `products` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalProductsWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `products` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function fetchProductsRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `products` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }
    
    
    public static function productDetails($dbid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `products` WHERE `productId` = '$dbid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        if ($resultRec) {
            $productId = $resultRec->productId;
            $categoryId = $resultRec->categoryId;
            $productName = $resultRec->productName;
            $materialType = $resultRec->materialType;
            $color = $resultRec->color;
            $thickness = $resultRec->thickness;
            $length = $resultRec->length;
            $width = $resultRec->width;
            $unitPrice = $resultRec->unitPrice;
            $stockQuantity = $resultRec->stockQuantity;
            $supplierId = $resultRec->supplierId;
            $createdAt = $resultRec->createdAt;
            $updatedAt = $resultRec->updatedAt;
            $uuid = $resultRec->uuid;
    
            return [
                'productId' => $productId,
                'productName' => $productName,
                'materialType' => $materialType,
                'color' => $color,
                'thickness' => $thickness,
                'length' => $length,
                'width' => $width,
                'unitPrice' => $unitPrice,
                'stockQuantity' => $stockQuantity,
                'supplierId' => $supplierId,
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt,
                'categoryId' => $categoryId,
                'uuid' => $uuid
            ];
        } else {
            return null; 
        }
    }


    public static function deleteProduct($dbid) {

        global $healthdb;
        $query = "UPDATE `products` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `productId` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }
    

    

}