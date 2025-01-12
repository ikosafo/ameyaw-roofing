<?php

class Website extends PostController
{

    public function saveEmail() {
        $email = $_POST['email'];
        SiteData::saveEmail($email);
    }

    public function saveContact() {
        $contactName = $_POST['contactName'];
        $contactEmail = $_POST['contactEmail'];
        $contactMessage = $_POST['contactMessage'];
        SiteData::saveContact($contactName,$contactEmail,$contactMessage);
    }

    public function saveOrder() {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $companyName = $_POST['companyName'];
        $region = $_POST['region'];
        $streetAddress = $_POST['streetAddress'];
        $apartmentAddress = $_POST['apartmentAddress'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $emailAddress = $_POST['emailAddress'];
        $orderNotes = $_POST['orderNotes'];
        $shippingDetails = $_POST['shippingDetails'];
        $cart = $_POST['cart'];
    
        SiteData::saveOrder(
            $firstName,
            $lastName,
            $companyName,
            $region,
            $streetAddress,
            $apartmentAddress,
            $city,
            $phone,
            $emailAddress,
            $orderNotes,
            $shippingDetails,
            $cart
        );
    }
    

    

}
 