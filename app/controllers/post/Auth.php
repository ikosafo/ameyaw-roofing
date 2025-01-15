<?php

class Auth extends PostController
{
    
    public function login()
    {
       $username = $_POST['username'];
       $password = $_POST['password'];
       Users::login($username, $password);
    }


    public function updateuser()
    {
       $id = $_POST['id'];
       $jobtitle = $_POST['jobtitle'];
       $department = $_POST['department'];
       $emailaddress = $_POST['emailaddress'];
       $telephone = $_POST['telephone'];

        Users::updateuser($id,$jobtitle,$department,$emailaddress,$telephone);
    }


    public function verifycode()
    {
       $id = $_POST['id'];
       $verification_code = $_POST['verification_code'];
    
        Users::verifycode($id,$verification_code);
    }
}
