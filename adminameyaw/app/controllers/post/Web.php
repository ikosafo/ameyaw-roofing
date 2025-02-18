<?php

class Web extends PostController
{

    public function addContacts() {
        $contactDetails = Contacts::contactDetails();
        $this->view("web/addContacts", 
            ['contactDetails' => $contactDetails]
        ); 
        
    }
    
    public function saveContacts() {
        $primaryContact = $_POST['primaryContact'];
        $secondaryContact = $_POST['secondaryContact'];
        $location = $_POST['location'];
        $uuid = $_POST['uuid'];
        Contacts::saveContacts($primaryContact, $secondaryContact, $location, $uuid);
    }


    public function uploadLogo()
    {

        if (!defined('UPLOAD_PATH')) {
            define('UPLOAD_PATH', Tools::uploadPath()); 
        }        
    
        foreach ($_POST as $name => $value) {
            $$name = $value;
        }
    
        $name = $_FILES['Filedata']['name'];
        $type = $_FILES['Filedata']['type'];
        $size = $_FILES['Filedata']['size'];
        $uniqueuploadid = $_POST['randno'];
    
        $docdate = date("Y-m-d");
        $uploads = new Uploads();
        $uploads->filename = $_FILES['Filedata'];
        $uploads->target_dir = UPLOAD_PATH;
        $uploadresponse = $uploads->upLoadFile();
    
        if ($uploadresponse['status'] == 'SUCCESS') {
            $newname = $uploadresponse['filename'];
            Product::insertProductImage($newname,$name,$type,$size,$uniqueuploadid);
        } else {
            echo 'Error Uploading File';
        }
    }

    public function listSupport() {
        $listSupport = Contacts::listSupport();
        $this->view("web/listSupport",[
            'listSupport' => $listSupport
        ]); 
    }


    public function listContactForm() {
        $contactForm = Contacts::contactForm();
        $this->view("web/listContactForm",[
            'contactForm' => $contactForm
        ]); 
    }

    

    
}
