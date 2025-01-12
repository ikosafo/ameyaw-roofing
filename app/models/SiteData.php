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


    public static function saveOrder($firstName, $lastName, $companyName, $region, $streetAddress, $apartmentAddress, $city, $phone, $emailAddress, $orderNotes, $shippingDetails, $cart) {
        global $healthdb;
    
        // Get IP Address and Location
        $ipAddress = Tools::getIpAddress();  
        $location = Tools::getLocation();  
    
        // Prepare the query to insert data into the `websiteorders` table
        $query = "INSERT INTO `websiteorders`
                    (`firstName`, `lastName`, `companyName`, `region`, `streetAddress`, `apartmentAddress`, `city`, `phone`, `emailAddress`, `orderNotes`, `createdAt`, `status`, `ipAddress`, `shippingDetails`, `cart`)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), '1', ?, ?, ?)";
    
        // Prepare the query for execution
        $healthdb->prepare($query);
    
        // Bind the parameters
        $healthdb->bind(1, $firstName);
        $healthdb->bind(2, $lastName);
        $healthdb->bind(3, $companyName);
        $healthdb->bind(4, $region);
        $healthdb->bind(5, $streetAddress);
        $healthdb->bind(6, $apartmentAddress);
        $healthdb->bind(7, $city);
        $healthdb->bind(8, $phone);
        $healthdb->bind(9, $emailAddress);
        $healthdb->bind(10, $orderNotes);
        $healthdb->bind(11, $ipAddress); // bind IP Address
        $healthdb->bind(12, json_encode($shippingDetails)); // bind shippingDetails as JSON string
        $healthdb->bind(13, json_encode($cart)); // bind cart as JSON string
    
        // Execute the query
        $result = $healthdb->execute();
    
        // Return success or failure response
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