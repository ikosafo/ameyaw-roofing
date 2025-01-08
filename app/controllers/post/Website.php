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

}
 