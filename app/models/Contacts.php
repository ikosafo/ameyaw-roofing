<?php

class Contacts extends tableDataObject
{
    const TABLENAME = 'websiteaddress';


    public static function contactDetails() {
        global $healthdb;
    
        $getList = "SELECT * FROM `websiteaddress` LIMIT 1";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        if ($resultRec) {
            $addressid = $resultRec->addressid;
            $primaryPhone = $resultRec->primaryPhone;
            $secondaryPhone = $resultRec->secondaryPhone;
            $location = $resultRec->location;
            $logo = $resultRec->logo;
            $createdAt = $resultRec->createdAt;
            $updatedAt = $resultRec->updatedAt;
            $uuid = $resultRec->uuid;
    
            return [
                'addressid' => $addressid,
                'primaryPhone' => $primaryPhone,
                'secondaryPhone' => $secondaryPhone,
                'location' => $location,
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt,
                'logo' => $logo,
                'uuid' => $uuid
            ];
        } else {
            return null; 
        }
    }


    public static function saveContacts($primaryContact, $secondaryContact, $location, $uuid)  
    {
        global $healthdb;

        $getRec = "SELECT * FROM `websiteaddress` LIMIT 1";
        $healthdb->prepare($getRec);
        $resultRec = $healthdb->singleRecord();

        if ($resultRec) {
            // Update existing record
            $updateQuery = "UPDATE `websiteaddress` 
                            SET `primaryPhone` = ?, 
                                `secondaryPhone` = ?, 
                                `location` = ?, 
                                `updatedAt` = NOW() 
                            WHERE `uuid` = ?";
            $healthdb->prepare($updateQuery);
            $healthdb->bind(1, $primaryContact);
            $healthdb->bind(2, $secondaryContact);
            $healthdb->bind(3, $location);
            $healthdb->bind(4, $uuid); 

            if ($healthdb->execute()) {
                echo 3; // Successfully updated
            } else {
                echo 4; // Update failed
            }
            return;
        } else {
            // Insert new product
            $insertQuery = "INSERT INTO `websiteaddress` (`primaryPhone`, `secondaryPhone`, `location`, `uuid`, `createdAt`) 
                            VALUES (?, ?, ?, ?, NOW())";
            $healthdb->prepare($insertQuery);
            $healthdb->bind(1, $primaryContact);
            $healthdb->bind(2, $secondaryContact);
            $healthdb->bind(3, $location);
            $healthdb->bind(4, $uuid); // Fixed index

            if ($healthdb->execute()) {
                echo 1; // Successfully inserted
            } else {
                echo 5; // Insert failed
            }
            return;
        }
    }


    public static function listSupport() {
        global $healthdb;

        $getList = "SELECT * FROM `supportcenter` where `status` = 1 ORDER BY `clientid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function contactForm() {
        global $healthdb;

        $getList = "SELECT * FROM `supportcontact` where `status` = 1 ORDER BY `contactid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function getTotalSupport() {
        global $healthdb;

        $query = "select count(*) as count from `supportcenter` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalContacts() {
        global $healthdb;

        $query = "select count(*) as count from `supportcontact` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalSupportWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `supportcenter` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalContactsWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `supportcontact` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function fetchSupportRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `supportcenter` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function fetchContactsRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `supportcontact` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }
    

}