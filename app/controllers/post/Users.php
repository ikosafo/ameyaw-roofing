<?php

class Users extends PostController
{

    public function usermanagement()
    {
        new Guard(); 
        $this->view("users/usermanagement");
    }


    public function addUser() {
        $fullName = trim($_POST['fullName'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phoneNumber = trim($_POST['phoneNumber'] ?? '');
        $birthDate = trim($_POST['birthDate'] ?? '');
        $gender = $_POST['gender'] ?? '';
        $maritalStatus = $_POST['maritalStatus'] ?? '';
        $jobTitle = trim($_POST['jobTitle'] ?? '');
        $department = $_POST['department'] ?? '';
        $employeeType = $_POST['employeeType'] ?? '';
        $userType = $_POST['userType'] ?? '';
        $permissions = $_POST['permissions'] ?? []; // Ensure it's always an array
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $uuid = trim($_POST['password'] ?? '');
    
        if (empty($fullName) || empty($username) || empty($password)) {
            die("Error: Full Name, Email, Username, and Password are required.");
        }
    
        User::saveUser(
            $fullName,
            $email,
            $phoneNumber,
            $birthDate,
            $gender,
            $maritalStatus,
            $jobTitle,
            $department,
            $employeeType,
            $userType,
            json_encode($permissions), 
            $username,
            $uuid,
            password_hash($password, PASSWORD_DEFAULT)
        );
    }


    public function deleteUser() {
        $dbid = $_POST['dbid'];
        User::deleteUser($dbid);
    }
    
    

}
