<?php

class SiteData extends tableDataObject
{
    const TABLENAME = 'supportcenter';

    public static function saveEmail($email) {
        global $healthdb;
        
        $checkQuery = "SELECT COUNT(*) FROM `supportcenter` WHERE `emailAddress` = ?";
        $healthdb->prepare($checkQuery);
        $healthdb->bind(1, $email);
        $healthdb->execute();
        
        $existingCount = $healthdb->fetchColumn();
        
        if ($existingCount > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Email already exists!'
            ]);
            return;
        }
        

        $ipAddress = Tools::getIpAddress();  
        $location = Tools::getLocation();  
        
        $query = "INSERT INTO `supportcenter`
                    (`emailAddress`, `ipAddress`, `createdAt`, `macAddress`, `location`, `status`, `updatedAt`)
                    VALUES (?, ?, NOW(), ?, ?, ?, NOW())";
    
        $healthdb->prepare($query);
        $healthdb->bind(1, $email);
        $healthdb->bind(2, $ipAddress);
        $healthdb->bind(3, ''); 
        $healthdb->bind(4, $location);
        $healthdb->bind(5, '1');  
        $healthdb->execute();
        
        echo json_encode([
            'success' => true,
            'message' => 'Email successfully saved!'
        ]);
    }
    

}