<?php

class Product extends tableDataObject
{
    const TABLENAME = 'products';


    private $username;
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); 
        }
        $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }
    public function getUsername() {
        return $this->username;
    }


    public static function saveCategory($categoryName,$uuid) {
        global $healthdb;
    
        $getName = "SELECT * FROM `productcategories` WHERE `categoryName` = '$categoryName' AND `uuid` != '$uuid' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();
    
        if ($resultName) {
            // Category already exists
            Tools::logAction("Category already exists", "Failed");
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
                Tools::logAction("Product category updated", "Successful");
                echo 3; 
                return;
            } else {
                $query = "INSERT INTO `productcategories`
                (`categoryName`,`uuid`,`createdAt`)
                VALUES ('$categoryName','$uuid',NOW())";
                $healthdb->prepare($query);
                $healthdb->execute();
                Tools::logAction("Product category insert", "Successful");
                echo 1; 
            }
        }
    }
    

    public static function saveType($typeName,$uuid) {
        global $healthdb;
    
        $getName = "SELECT * FROM `producttypes` WHERE `typeName` = '$typeName' AND `uuid` != '$uuid' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();
    
        if ($resultName) {
            // Type already exists
            echo 2;
            return;
        } else {
            $getType = "SELECT * FROM `producttypes` WHERE `uuid` = '$uuid' AND `status` = 1";
            $healthdb->prepare($getType);
            $resultType = $healthdb->singleRecord();
    
            if ($resultType) {
                $updateQuery = "UPDATE `producttypes` 
                                SET `typeName` = '$typeName', `updatedAt` = NOW() WHERE `uuid` = '$uuid'";
                $healthdb->prepare($updateQuery);
                $healthdb->execute();
                echo 3; 
                return;
            } else {
                $query = "INSERT INTO `producttypes`
                (`typeName`,`uuid`,`createdAt`)
                VALUES ('$typeName','$uuid',NOW())";
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


    public static function listTypes() {
        global $healthdb;

        $getList = "SELECT * FROM `producttypes` where `status` = 1 ORDER BY `typeId` DESC";
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


    public static function typeDetails($typeid) {
        global $healthdb;

        $getList = "SELECT * FROM `producttypes` where `typeId` = '$typeid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
        $typeId = $resultRec->typeId;
        $typeName = $resultRec->typeName;
        $uuid = $resultRec->uuid;
        return [
            'typeId' => $typeId,
            'typeName' => $typeName,
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


    public static function deleteType($typeid) {

        global $healthdb;
            $query = "UPDATE `producttypes` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `typeId` = '$typeid'";

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


    public static function saveProduct($productName,$productCategory,$materialType,$uuid,$rate)  
    {
        global $healthdb;

        $getName = "SELECT * FROM `products` WHERE `productName` = ? AND `materialType` = ? AND `uuid` != ? AND `status` = 1";
        $healthdb->prepare($getName);
        $healthdb->bind(1, $productName);
        $healthdb->bind(2, $materialType);
        $healthdb->bind(3, $uuid);
        $resultName = $healthdb->singleRecord();

        if ($resultName) {
            echo 2; 
            return;
        }

        $getProduct = "SELECT * FROM `products` WHERE `uuid` = ? AND `status` = 1";
        $healthdb->prepare($getProduct);
        $healthdb->bind(1, $uuid);
        $resultProduct = $healthdb->singleRecord();

        if ($resultProduct) {
            $updateQuery = "UPDATE `products` 
                            SET `productName` = ?, 
                                `categoryId` = ?, 
                                `materialType` = ?, 
                                `rate` = ?, 
                                `updatedAt` = NOW() 
                            WHERE `uuid` = ?";
            $healthdb->prepare($updateQuery);
            $healthdb->bind(1, $productName);
            $healthdb->bind(2, $productCategory);
            $healthdb->bind(3, $materialType);
            $healthdb->bind(4, $rate);
            $healthdb->bind(5, $uuid);

            if ($healthdb->execute()) {
                echo 3; 
            } else {
                echo 4; 
            }
            return;
        } else {
            $insertQuery = "INSERT INTO `products` (`productName`, `categoryId`, `materialType`, `uuid`, `rate`, `createdAt`) 
                            VALUES (?, ?, ?, ?, ?, NOW())";
            $healthdb->prepare($insertQuery);
            $healthdb->bind(1, $productName);
            $healthdb->bind(2, $productCategory);
            $healthdb->bind(3, $materialType);
            $healthdb->bind(4, $uuid);
            $healthdb->bind(5, $rate);

            if ($healthdb->execute()) {
                echo 1; 
            } else {
                echo 5;
            }
            return;
        }
    }



    public static function saveWebsiteProduct($productName, $productCategory, $uuid, $description)  
    {
            global $healthdb;
        
            $getName = "SELECT * FROM `websiteproducts` WHERE `productName` = ? AND `uuid` != ? AND `status` = 1";
            $healthdb->prepare($getName);
            $healthdb->bind(1, $productName);
            $healthdb->bind(2, $uuid);
            $resultName = $healthdb->singleRecord();
        
            if ($resultName) {
                echo 2; 
                return;
            }
        
            $getCategory = "SELECT * FROM `websiteproducts` WHERE `uuid` = ? AND `status` = 1";
            $healthdb->prepare($getCategory);
            $healthdb->bind(1, $uuid);
            $resultCategory = $healthdb->singleRecord();
        
            if ($resultCategory) {
                $updateQuery = "UPDATE `websiteproducts` 
                                SET `productName` = ?, 
                                    `categoryId` = ?, 
                                    `description` = ?, 
                                    `updatedAt` = NOW() 
                                WHERE `uuid` = ?";
                $healthdb->prepare($updateQuery);
                $healthdb->bind(1, $productName);
                $healthdb->bind(2, $productCategory);
                $healthdb->bind(3, $description);
                $healthdb->bind(4, $uuid);
        
                if ($healthdb->execute()) {
                    echo 3; 
                } else {
                    echo 4; 
                }
                return;
            } else {
                
                $insertQuery = "INSERT INTO `websiteproducts` 
                                (`productName`, `categoryId`, `description`, 
                                `uuid`, `createdAt`) 
                                VALUES (?, ?, ?, ?, NOW())";
                $healthdb->prepare($insertQuery);
                $healthdb->bind(1, $productName);
                $healthdb->bind(2, $productCategory);
                $healthdb->bind(3, $description);
                $healthdb->bind(4, $uuid);
        
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


    public static function getTotalWebsiteProducts() {
        global $healthdb;

        $query = "select count(*) as count from `websiteproducts` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalSupplierProducts($supplierId) {
        global $healthdb;

        $query = "select count(*) as count from `products` WHERE `supplierId` = '$supplierId' AND `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalProductsThreshold() {
        global $healthdb;

        $threshold = Tools::productThreshold;
        $query = "select count(*) as count from `products` WHERE `status` = 1 AND stockQuantity < '$threshold'";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalMovements() {
        global $healthdb;

        $query = "select count(*) as count from `stockmovements` WHERE `status` = 1";
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


    public static function getTotalWebsiteProductsWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `websiteproducts` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalSupplierProductsWithFilter($supplierId,$searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `products` WHERE `supplierId` = '$supplierId' AND `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalProductsWithFilterThreshold($searchQuery) {
        global $healthdb;

        $threshold = Tools::productThreshold;
        $query = "select count(*) as count from `products` WHERE `status` = 1 AND stockQuantity < '$threshold' AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalMovementsWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `stockmovements` WHERE `status` = 1 AND 1 " . $searchQuery;
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


    public static function fetchWebsiteProductsRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `websiteproducts` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchSupplierProductsRecords($supplierId,$searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `products` WHERE `supplierId` = '$supplierId' AND `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchProductsRecordsThreshold($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $threshold = Tools::productThreshold;
        $query = "select * from `products` WHERE `status` = 1 AND stockQuantity < '$threshold' AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchMovementsRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `stockmovements` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }
    
    
    public static function productDetails($dbid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `products` WHERE `productId` = ?";
        $healthdb->prepare($getList);
        $healthdb->bind(1, $dbid); 
        $resultRec = $healthdb->singleRecord();
    
        if ($resultRec) {
            return [
                'productId' => $resultRec->productId,
                'productName' => $resultRec->productName,
                'materialType' => $resultRec->materialType,
                'createdAt' => $resultRec->createdAt,
                'updatedAt' => $resultRec->updatedAt,
                'categoryId' => $resultRec->categoryId,
                'uuid' => $resultRec->uuid,
                'rate' => property_exists($resultRec, 'rate') ? $resultRec->rate : ""
            ];
        } else {
            return null; 
        }
    }  


    public static function websiteProductDetails($dbid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `websiteproducts` WHERE `productId` = '$dbid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        if ($resultRec) {
            $productId = $resultRec->productId;
            $categoryId = $resultRec->categoryId;
            $productName = $resultRec->productName;
            $description = $resultRec->description;
            $createdAt = $resultRec->createdAt;
            $updatedAt = $resultRec->updatedAt;
            $uuid = $resultRec->uuid;
    
            return [
                'productId' => $productId,
                'productName' => $productName,
                'description' => $description,
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


    public static function deleteWebsiteProduct($dbid) {

        global $healthdb;
        $query = "UPDATE `websiteproducts` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `productId` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }


    public static function insertProductImage($newname, $name, $type, $size, $uniqueuploadid)
    {
        global $healthdb;
    
        // Check if a record with the same unique ID exists
        $chkunique = "SELECT `newname`, `randomnumber` FROM `documents` WHERE `randomnumber` = '$uniqueuploadid'";
        $healthdb->prepare($chkunique);
        $resultunique = $healthdb->singleRecord();
    
        if ($resultunique) {
            $oldImage = $resultunique->newname;
    
            // Unlink (delete) the old image from the server
            if (file_exists(UPLOAD_PATH . $oldImage)) {
                unlink(UPLOAD_PATH . $oldImage); 
            }
    
            $query = "UPDATE `documents`
                      SET `name` = '$name',
                          `newname` = '$newname',
                          `size` = '$size',
                          `type` = '$type',
                          `docdate` = NOW()
                      WHERE `randomnumber` = '$uniqueuploadid'";
    
            $healthdb->prepare($query);
            $healthdb->execute();
    
            echo 2;
    
        } else {
            $query = "INSERT INTO `documents`
                      (`name`, `newname`, `size`, `type`, `randomnumber`, `docdate`)
                      VALUES ('$name', '$newname', '$size', '$type', '$uniqueuploadid', NOW())";
    
            $healthdb->prepare($query);
            $healthdb->execute();
    
            echo 1; 
        }
    }


    public static function listWebsiteProducts() {
        global $healthdb;

        $getList = "SELECT * FROM `websiteproducts` where `status` = 1 ORDER BY `productId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


}