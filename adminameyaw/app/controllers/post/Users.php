<?php

class Users extends PostController
{

    public function usermanagement()
    {
        new Guard(); 
        $this->view("users/usermanagement");
    }

    public function permissions()
    {
        new Guard(); 
        $listPermissions = User::listPermissions();
        $this->view("users/permissions",
        ['listPermissions' => $listPermissions]);
    }


    public function changePassword()
    {
        new Guard(); 
        $uuid = Tools::getuuidbyid($_SESSION['uid']);
        $this->view("users/changePassword",
        ['uuid' => $uuid]);
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


    public function editUserDetails() {
        $uuid = trim($_POST['uuid'] ?? ''); 
        //echo "Debug: Received UUID - " . htmlspecialchars($uuid) . "<br>";
    
        if (empty($uuid)) {
            //echo "Debug: UUID is empty!<br>";
            //echo json_encode(['status' => 4, 'message' => 'User not found']);
            return;
        }
    
        User::editUser(
            trim($_POST['fullName'] ?? ''),
            trim($_POST['email'] ?? ''),
            trim($_POST['phoneNumber'] ?? ''),
            trim($_POST['birthDate'] ?? ''),
            $_POST['gender'] ?? '',
            $_POST['maritalStatus'] ?? '',
            trim($_POST['jobTitle'] ?? ''),
            $_POST['department'] ?? '',
            $_POST['employeeType'] ?? '',
            $_POST['userType'] ?? '',
            json_encode($_POST['permissions'] ?? []),
            $uuid
        );
    }


    public function deleteUser() {
        $dbid = $_POST['dbid'];
        User::deleteUser($dbid);
    }


    public function editUser() {
        $dbid = $_POST['dbid'];
        $uuid = Tools::getuuidbyid($dbid);
        $userDetails = User::userDetails($dbid);
        $userPermissions = User::userPermissions($uuid); 
    
        $this->view("users/editUser", [
            'dbid' => $dbid,
            'userDetails' => $userDetails,
            'userPermissions' => $userPermissions,
            'uuid' => $uuid
        ]);
    }
   


    public function deletePermission() {
        $dbid = $_POST['dbid'];
        User::deletePermission($dbid);
    }
    

    public function viewUsers() {
        $dbid = $_POST['dbid'];
        $viewUserDetails = User::viewUserDetails($dbid);
        $this->view("users/viewUsers",[
            'viewUserDetails' => $viewUserDetails,
            'dbid' => $dbid
        ]); 
    }
    
    

}
