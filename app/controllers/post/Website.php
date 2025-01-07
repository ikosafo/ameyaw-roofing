<?php

class Website extends PostController
{

    public function saveEmail() {
        $email = $_POST['email'];
        SiteData::saveEmail($email);
    }

}
 