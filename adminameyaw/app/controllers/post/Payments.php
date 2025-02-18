<?php

class Payments extends PostController
{
   
    public function processPayment() {
        $this->view("payments/processPayments"); 
    }


    public function savePayment()
    {
        // Ensure all required POST data is received
        if (empty($_POST['paymentMethod'])) {
            die("Error: Payment method is required.");
        }
        if (empty($_POST['amount'])) {
            die("Error: Amount is required.");
        }
        if (empty($_POST['currency'])) {
            die("Error: Currency is required.");
        }
        if (empty($_POST['referenceNumber'])) {
            die("Error: Reference number is required.");
        }

        $paymentMethod = $_POST['paymentMethod'];
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $referenceNumber = $_POST['referenceNumber'];
        $paymentDescription = $_POST['paymentDescription'] ?? null;

        $cardNumber = $expiryDate = $cvv = null;
        $mobileMoneyNumber = $mobileMoneyProvider = null;
        $bankName = $accountNumber = null;

        // Validate payment method and required fields
        if ($paymentMethod === "Credit/Debit Card") {
            if (empty($_POST['cardNumber']) || empty($_POST['expiryDate']) || empty($_POST['cvv'])) {
                die("Error: Card payment requires cardNumber, expiryDate, and cvv.");
            }
            $cardNumber = $_POST['cardNumber'];
            $expiryDate = $_POST['expiryDate'];
            $cvv = $_POST['cvv'];
        } elseif ($paymentMethod === "Mobile Money") {
            if (empty($_POST['mobileMoneyNumber']) || empty($_POST['mobileMoneyProvider'])) {
                die("Error: Mobile Money payment requires mobileMoneyNumber and mobileMoneyProvider.");
            }
            $mobileMoneyNumber = $_POST['mobileMoneyNumber'];
            $mobileMoneyProvider = $_POST['mobileMoneyProvider'];
        } elseif ($paymentMethod === "Bank Transfer") {
            if (empty($_POST['bankName']) || empty($_POST['accountNumber'])) {
                die("Error: Bank Transfer requires bankName and accountNumber.");
            }
            $bankName = $_POST['bankName'];
            $accountNumber = $_POST['accountNumber'];
        } else {
            die("Error: Invalid payment method.");
        }

        // Call the savePayment method with validated inputs
        Payment::savePayment(
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
        );
    }

    public function paymentHistory() {
        $this->view("payments/paymentHistory"); 
    }


    public function viewPayment() {
        $dbid = $_POST['dbid'];
        $paymentDetail = Payment::paymentDetail($dbid);
        $this->view("payments/viewPayment", 
            ['paymentDetail' => $paymentDetail]
        ); 
    }

    

}
 



