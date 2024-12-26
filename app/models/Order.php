
<?php

class Order extends tableDataObject
{
    const TABLENAME = 'orders';

    public static function orderItems($searchTerm) {
        global $healthdb;

        if (empty($searchTerm)) {
            return null;
        }
    
        $getList = "SELECT * FROM `products` WHERE `productName` LIKE :searchTerm ORDER BY `productName` LIMIT 5";
        $healthdb->prepare($getList);
        $healthdb->bind(':searchTerm', '%' . $searchTerm . '%');
        $resultList = $healthdb->resultSet();
        return !empty($resultList) ? $resultList : null;
    }
    

}


