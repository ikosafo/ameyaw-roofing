<?php

class Statistics extends tableDataObject{

    const TABLENAME = 'orders';

    public static function salesRevenue(){
        global $healthdb;
    
        $getSum = "SELECT SUM(totalPrice + delivery + installation - discount) as `sumRevenue` 
           FROM `inspections` WHERE paymentStatus = 'Successful'";

        $healthdb->prepare($getSum);
        $result = $healthdb->singleRecord();
        return $result->sumRevenue;
    }


    public static function unitsSold(){
        global $healthdb;
    
        $getNum = "SELECT COUNT(`totalPrice`) AS countUnits FROM `inspections` WHERE paymentStatus = 'Successful'";
        $healthdb->prepare($getNum);
        $result = $healthdb->singleRecord();
        return $result->countUnits;
    }


    public static function productNumber(){
        global $healthdb;
    
        $getNum = "SELECT COUNT(*) AS countUnits FROM `products` WHERE `status` = 1";
        $healthdb->prepare($getNum);
        $result = $healthdb->singleRecord();
        return $result->countUnits;
    }


    public static function categoryNumber(){
        global $healthdb;
    
        $getNum = "SELECT COUNT(*) AS countUnits FROM `productcategories` WHERE status = 1";
        $healthdb->prepare($getNum);
        $result = $healthdb->singleRecord();
        return $result->countUnits;
    }


    public static function materialNumber(){
        global $healthdb;
    
        $getNum = "SELECT COUNT(*) AS countUnits FROM `producttypes` WHERE status = 1";
        $healthdb->prepare($getNum);
        $result = $healthdb->singleRecord();
        return $result->countUnits;
    }
    
    

    public static function topSelling() {
        global $healthdb;

        $getTop = "SELECT c.`productId` AS topCount FROM carts c JOIN `orders` d ON c.`uuid` = d.`uuid`
                WHERE d.`paymentStatus` = 'Successful' AND d.`stockDeducted` = 1 ORDER BY c.`quantity` DESC LIMIT 1";
        $healthdb->prepare($getTop);
        $result = $healthdb->singleRecord();
        return $result->topCount;
    }


    public static function currentGrowthRate() {
        global $healthdb;

        $gePrevious = "SELECT SUM(totalPrice + delivery + installation - discount) AS previousSales FROM `inspections` WHERE YEAR(paymentPeriod) = YEAR(CURDATE()) - 1 
        AND `paymentStatus` = 'Successful'";
        $healthdb->prepare($gePrevious);
        $result = $healthdb->singleRecord();
        $previousSales =  $result->previousSales;

        $getCurrent = "SELECT SUM(totalPrice + delivery + installation - discount) AS currentSales FROM `inspections` WHERE YEAR(paymentPeriod) = YEAR(CURDATE()) 
        AND `paymentStatus` = 'Successful'";
        $healthdb->prepare($getCurrent);
        $result = $healthdb->singleRecord();
        $currentSales =  $result->currentSales;
        if ($previousSales == 0) {
            $previousSales == 1;
        }

        return  $currentSales * 100;
    }


    public static function stockLevel() {
        global $healthdb;

        $getCount = "SELECT SUM(stockQuantity) AS `countStock` FROM products WHERE `status` = 1";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }


    public static function lowStockLevel() {
        global $healthdb;

        $getCount = "SELECT COUNT(stockQuantity) AS `countStock` FROM products WHERE `status` = 1 AND stockQuantity < 15";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }


    public static function removedStock() {
        global $healthdb;

        $getCount = "SELECT SUM(quantity) AS `countStock` FROM `stockmovements` WHERE `status` = 1 AND (movementType = 'Remove' OR movementType = 'Transfered')";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }


    public static function totalOrders() {
        global $healthdb;

        $getCount = "SELECT COUNT(*) AS `countStock` FROM `inspections` WHERE `status` = 1";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }


    public static function totalInvoices() {
        global $healthdb;

        $getCount = "SELECT COUNT(*) AS `countStock` FROM `inspections` WHERE `status` = 1 AND `profile` != ''";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }


    public static function totalSales() {
        global $healthdb;

        $getCount = "SELECT COUNT(*) AS `countStock` FROM `inspections` WHERE `status` = 1 AND `paymentStatus` = 'Successful'";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }

    public static function totalUsers() {
        global $healthdb;

        $getCount = "SELECT COUNT(*) AS `countUsers` FROM `users` WHERE `status` = 1 AND `see` = 1";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countUsers;
    }


    public static function totalClients() {
        global $healthdb;

        $getCount = "SELECT COUNT(*) AS `countUsers` FROM `inspections` WHERE `status` = 1";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countUsers;
    }


    public static function totalAdministrators() {
        global $healthdb;

        $getCount = "SELECT COUNT(*) AS `countUsers` FROM `users` WHERE `status` = 1 AND `see` = 1 AND userType = 'Administrator'";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countUsers;
    }
    

}
