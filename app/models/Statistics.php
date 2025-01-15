<?php

class Statistics extends tableDataObject{

    const TABLENAME = 'orders';

    public static function salesRevenue(){
        global $healthdb;
    
        $getSum = "SELECT SUM(totalAmount) as sumRevenue FROM orders where paymentStatus = 'Successful' AND stockDeducted = 1";
        $healthdb->prepare($getSum);
        $result = $healthdb->singleRecord();
        return $result->sumRevenue;
    }


    public static function unitsSold(){
        global $healthdb;
    
        $getNum = "SELECT COUNT(`quantity`) AS countUnits FROM carts c JOIN `orders` d ON c.`uuid` = d.`uuid` WHERE d.paymentStatus = 'Successful' AND d.stockDeducted = 1";
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

        $gePrevious = "SELECT SUM(totalAmount) AS previousSales FROM orders WHERE YEAR(updatedAt) = YEAR(CURDATE()) - 1 
        AND `paymentStatus` = 'Successful' AND `stockDeducted` = 1";
        $healthdb->prepare($gePrevious);
        $result = $healthdb->singleRecord();
        $previousSales =  $result->previousSales;

        $getCurrent = "SELECT SUM(totalAmount) AS currentSales FROM orders WHERE YEAR(updatedAt) = YEAR(CURDATE()) 
        AND `paymentStatus` = 'Successful' AND `stockDeducted` = 1";
        $healthdb->prepare($getCurrent);
        $result = $healthdb->singleRecord();
        $currentSales =  $result->currentSales;

        return  (($currentSales - $previousSales)/$currentSales) * 100;
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

        $getCount = "SELECT COUNT(*) AS `countStock` FROM `websiteorders` WHERE `status` = 1";
        $healthdb->prepare($getCount);
        $result = $healthdb->singleRecord();
        return $result->countStock;
    }

}
