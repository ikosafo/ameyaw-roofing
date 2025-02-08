<?php

class Payment extends tableDataObject
{

    const TABLENAME = 'payments';

    public static function savePayment(
        $paymentMethod,
        $amount,
        $currency,
        $referenceNumber,
        $paymentDescription,
        $cardNumber,
        $expiryDate,
        $cvv,
        $mobileMoneyNumber,
        $mobileMoneyProvider,
        $bankName,
        $accountNumber
    ) {
        global $healthdb;
    
        // Validate required fields
        if (empty($paymentMethod) || empty($amount) || empty($currency) || empty($referenceNumber)) {
            die("Error: Missing required fields.");
        }
    
        $query = "INSERT INTO `payments` 
                    (`paymentMethod`, `amount`, `currency`, `referenceNumber`, `paymentDescription`,
                     `cardNumber`, `expiryDate`, `cvv`, `mobileMoneyNumber`, `mobileMoneyProvider`,
                     `bankName`, `accountNumber`, `createdAt`, `updatedAt`, `status`) 
                  VALUES 
                    (:paymentMethod, :amount, :currency, :referenceNumber, :paymentDescription,
                     :cardNumber, :expiryDate, :cvv, :mobileMoneyNumber, :mobileMoneyProvider,
                     :bankName, :accountNumber, NOW(), NOW(), 1)";
    
        $healthdb->prepare($query);
        $healthdb->bind(':paymentMethod', $paymentMethod);
        $healthdb->bind(':amount', $amount);
        $healthdb->bind(':currency', $currency);
        $healthdb->bind(':referenceNumber', $referenceNumber);
        $healthdb->bind(':paymentDescription', $paymentDescription ?: null);
        $healthdb->bind(':cardNumber', $cardNumber ?: null);
        $healthdb->bind(':expiryDate', $expiryDate ?: null);
        $healthdb->bind(':cvv', $cvv ?: null);
        $healthdb->bind(':mobileMoneyNumber', $mobileMoneyNumber ?: null);
        $healthdb->bind(':mobileMoneyProvider', $mobileMoneyProvider ?: null);
        $healthdb->bind(':bankName', $bankName ?: null);
        $healthdb->bind(':accountNumber', $accountNumber ?: null);
    
        if ($healthdb->execute()) {
            return "Payment saved successfully.";
        } else {
            die("Error saving payment.");
        }
    }
    

    public static function getTotalHistory() {
        global $healthdb;

        $query = "select count(*) as count from `payments` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalHistoryWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `payments` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function fetchHistoryRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `payments` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }

    


}
