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


    public static function saveContact($contactName, $contactEmail, $contactMessage) {
        global $healthdb;

        $ipAddress = Tools::getIpAddress();  
        $location = Tools::getLocation();  
    
        $query = "INSERT INTO `supportcontact`
                    (`contactName`, `contactEmail`, `contactMessage`, `ipAddress`, `createdAt`, `location`, `updatedAt`)
                    VALUES (?, ?, ?, ?, NOW(), ?, NOW())";
        
        $healthdb->prepare($query);

        $healthdb->bind(1, $contactName);
        $healthdb->bind(2, $contactEmail);
        $healthdb->bind(3, $contactMessage);
        $healthdb->bind(4, $ipAddress);
        $healthdb->bind(5, $location);
        
        $result = $healthdb->execute();
        
        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Form successfully saved!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save the form. Please try again.'
            ]);
        }
    }

    

}