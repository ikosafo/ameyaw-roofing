
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
    
    

}


