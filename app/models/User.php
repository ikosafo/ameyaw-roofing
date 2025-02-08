<?php

class User extends tableDataObject
{

    const TABLENAME = 'users';

    public static function saveUser($fullName, $email, $phoneNumber, $birthDate, $gender, $maritalStatus, $jobTitle, $department, $employeeType, $userType, $permissions, $username,$uuid, $hashedPassword) {
        global $healthdb;

        if (empty($fullName) || empty($email) || empty($username) || empty($hashedPassword)) {
            //return json_encode(["status" => "error", "message" => "Required fields are missing."]);
            echo 3;
            return;
        }

        $checkSql = "SELECT id FROM " . self::TABLENAME . " WHERE emailAddress = :email OR phoneNumber = :phoneNumber";
        $healthdb->prepare($checkSql);
        $healthdb->bind(':email', $email);
        $healthdb->bind(':phoneNumber', $phoneNumber);
        $healthdb->execute();

        if ($healthdb->rowCount() > 0) {
            //return json_encode(["status" => "error", "message" => "Email or phone number already exists."]);
            echo 2;
            return;
        }

        $sql = "INSERT INTO " . self::TABLENAME . " (fullName, emailAddress, phoneNumber, birthDate, gender, maritalStatus, jobTitle, department, employeeType, userType, username, password, uuid, createdAt) 
                VALUES (:fullName, :email, :phoneNumber, :birthDate, :gender, :maritalStatus, :jobTitle, :department, :employeeType, :userType, :username, :password, :uuid, NOW())";

        $healthdb->prepare($sql);
        $healthdb->bind(':fullName', $fullName);
        $healthdb->bind(':email', $email);
        $healthdb->bind(':phoneNumber', $phoneNumber);
        $healthdb->bind(':birthDate', $birthDate);
        $healthdb->bind(':gender', $gender);
        $healthdb->bind(':maritalStatus', $maritalStatus);
        $healthdb->bind(':jobTitle', $jobTitle);
        $healthdb->bind(':department', $department);
        $healthdb->bind(':employeeType', $employeeType);
        $healthdb->bind(':userType', $userType);
        $healthdb->bind(':username', $username);
        $healthdb->bind(':password', $hashedPassword);
        $healthdb->bind(':uuid', $uuid);

        if ($healthdb->execute()) {
            // Get last inserted user ID
            $userId = $healthdb->lastInsertId();

            // Insert user permissions if any exist
            $permissionsArray = json_decode($permissions, true) ?? [];
            if (!empty($permissionsArray)) {
                foreach ($permissionsArray as $permission) {
                    $permSql = "INSERT INTO `permission` (`user_id`, `permission`, `uuid`) VALUES (:userId, :permission, :uuid)";
                    $healthdb->prepare($permSql);
                    $healthdb->bind(':userId', $userId);
                    $healthdb->bind(':permission', $permission);
                    $healthdb->bind(':uuid', $uuid);
                    $healthdb->execute();
                }
            }

            //return json_encode(["status" => "success", "message" => "User added successfully."]);
            echo 1;
        }
        //return json_encode(["status" => "error", "message" => "Failed to insert user."]);
        //echo 4;
    }


    public static function getUsers(){
        global $healthdb;
    
        $getnum = "SELECT COUNT(*) as count FROM `users` where status = 1 AND see = 1";
        $healthdb->prepare($getnum);
        $result = $healthdb->singleRecord();
        return $result->count;
    }

    
    public static function listUsers() {
        global $healthdb;

        $getList = "SELECT * FROM `users` where `status` = 1 AND (`accessLevel` = 'Super Administrator' OR `accessLevel` = 'Administrator')  ORDER BY `createdAt` DESC, `firstName`, `lastName`";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listPermissions() {
        global $healthdb;
    
        $getList = "SELECT p.`id`,p.`uuid`, p.`permission` FROM `permission` p JOIN `users` u ON p.`uuid` = u.`uuid` WHERE p.`status` = 1";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
    

    public static function getLastLogin(){
        global $healthdb;
    
        $username = $_SESSION['username'];
        $getrec = "SELECT `logdate` FROM `logs_mis` 
           WHERE `username` = '$username' 
           AND `message` LIKE '%Logged in Successfully' 
           ORDER BY `logid` DESC LIMIT 1";
            $healthdb->prepare($getrec);
        $result = $healthdb->singleRecord();
        return $result->logdate ?? null;
    }


    public static function getUserStatus() {
        global $healthdb;

        $username = $_SESSION['username'];
        $query = "Select `approval` from `users` where `username` = '$username'";
        $healthdb->prepare($query);
        $result = $healthdb->fetchColumn();
        return $result;

    }


    public static function deleteAdminUser($userid) {
        global $healthdb;
        $query = "UPDATE `users` 
        SET `status` = 0,
        `updatedAt` = NOW()
        WHERE `id` = '$userid'";

        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;  // Successfully updated
       
    }

    
    public static function deleteUserPermission($id) {
        global $healthdb;
        $query = "UPDATE `permission` 
        SET `status` = 0,
        `updatedAt` = NOW()
        WHERE `id` = '$id'";

        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;  // Successfully updated
       
    }


    public static function savePassword($currentPassword,$newPassword,$uid) {
        global $healthdb;

        $encrPassword = md5($newPassword);
        $encNewPassword = md5($currentPassword);
        $chkUser = "SELECT * FROM `users` WHERE `id` = '$uid' AND `password` =  '$encNewPassword'";
        $healthdb->prepare($chkUser);
        $resultUser = $healthdb->singleRecord();

        if ($resultUser) {
            $query = "UPDATE `users` SET 
            `password` = :encrPassword,
            `updatedAt` = NOW()  
            WHERE `id` = '$uid'";
            $healthdb->prepare($query);

            $healthdb->bind(':encrPassword', $encrPassword);

            if (!$healthdb->execute()) {
                die('Execute error: ' . $healthdb->error);
            } else {
                echo 1; 
            }
        } else {
            echo 2;
            return;
        }


    }   


    public static function userDetails($uid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `users` WHERE `id` = '$uid' OR `uuid` = '$uid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'firstName' => $resultRec->firstName,
            'lastName' => $resultRec->lastName,
            'username' => $resultRec->username,
            'emailaddress' => $resultRec->emailaddress,
            'phoneNumber' => $resultRec->phoneNumber,
            'altPhoneNumber' => $resultRec->altPhoneNumber,
            'emailverified' => $resultRec->emailverified,
            'dateBirth' => $resultRec->dateBirth,
            'password' => $resultRec->password,
            'role' => $resultRec->role,
            'accessLevel' => $resultRec->accessLevel,
            'user_id' => $resultRec->user_id,
            'approval' => $resultRec->approval,
            'status' => $resultRec->status,
            'code' => $resultRec->code,
            'createdAt' => $resultRec->createdAt,
            'updatedAt' => $resultRec->updatedAt,
            'lastLogin' => $resultRec->lastLogin,
            'attempts' => $resultRec->attempts,
            'userType' => $resultRec->userType,
            'uuid' => $resultRec->uuid,
            'securityQuestion' => $resultRec->securityQuestion,
            'securityAnswer' => $resultRec->securityAnswer,
            'jobtitle' => $resultRec->jobtitle,
            'department' => $resultRec->department,
            'emergencyContactInfo' => $resultRec->emergencyContactInfo,
            'address' => $resultRec->address,
        ];
    }

    
    public static function userPermissions($userid) {
        global $healthdb;
    
        $getprofessions = "SELECT `permission` FROM `permission` WHERE `uuid` = '$userid' AND `status` = 1";
        $healthdb->prepare($getprofessions);
        $results = $healthdb->resultSet();
        $permissions = array();

        if ($results) {
            foreach ($results as $result) {
                $permissions[] = $result->permission; 
            }
        }
    
        return $permissions; 
    }


    public static function userComplaints($userid) {
        global $healthdb;
    
        $getprofessions = "SELECT `category` FROM `issuecategories` WHERE `uuid` = '$userid' AND `status` = 1";
        $healthdb->prepare($getprofessions);
        $results = $healthdb->resultSet();
        $categories = array();

        if ($results) {
            foreach ($results as $result) {
                $categories[] = $result->category; 
            }
        }
    
        return $categories; 
    }
    

    public static function login($username, $password) {
        $mc = new Mac();
        $ip = $mc->getRealIpAddr();
    
        $_SESSION['ip'] = $ip;
    
        global $healthdb;
        $password = md5($password);

        // Check for the username
        $chkpassword = "SELECT * FROM `users` WHERE `username` = '$username'";
        $healthdb->prepare($chkpassword);
        $resUsername = $healthdb->singleRecord();
        if (!$resUsername) {
            echo json_encode(['status' => 5]);
            return;
        }
    
        // Check login attempts before proceeding
        $attemptCheck = Tools::checkLoginAttempts($username);
    
        // If attempts are exhausted, block login
        if (!$attemptCheck['status']) {
            echo json_encode(['status' => 2, 'message' => $attemptCheck['message']]);
            return;
        }

        $loginquery = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' AND `status` = 1";
        $healthdb->prepare($loginquery);
        $result = $healthdb->singleRecord();
    
        if (!empty($result)) {
            // Reset attempts to the default value (e.g., 5) on successful login
            $resetAttempts = "UPDATE `users` SET `attempts` = 5 WHERE `username` = '$username'";
            $healthdb->prepare($resetAttempts);
            $healthdb->execute();
    
            $emailaddress = $result->emailaddress;
            $verified = $result->emailverified;
            $userid = $result->id;
            $accessLevel = $result->accessLevel;
            $uuid = $result->uuid;
    
            if ($emailaddress == "") {
                $_SESSION['username'] = $username;
                $_SESSION['uid'] = $userid;
                echo json_encode(['status' => 3]);
                Tools::logAction("$username redirected to update details", "Successful");
            }  else {
                $_SESSION['emailaddress'] = $emailaddress;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['uid'] = $userid;
                $_SESSION['emailverified'] = $verified;
                $_SESSION['accessLevel'] = $accessLevel;
                $_SESSION['uuid'] = $uuid;

                echo json_encode(['status' => 1]);
                
                Tools::logAction("$username Logged in successfully", "Successful");
            }
        } else {
            // Decrement attempts on failed login
            $updateAttempts = "UPDATE `users` SET `attempts` = `attempts` - 1 WHERE `username` = '$username'";
            $healthdb->prepare($updateAttempts);
            $healthdb->execute();
    
            // Fetch the updated number of attempts
            $attemptCheck = Tools::checkLoginAttempts($username);
            echo json_encode(['status' => 2, 'message' => $attemptCheck['message']]);
            Tools::logAction("Attempted login by $username", "Failed");
        }
    } 

    
    public static function updateuser($id,$jobtitle,$department,$emailaddress,$telephone)
    {
        global $healthdb;

        $chkemail = "SELECT COUNT(*) as count FROM `users` 
        where (emailaddress = '$emailaddress' OR telephone = '$telephone')";
        $healthdb->prepare($chkemail);
        $result = $healthdb->singleRecord();
        $countEmail = $result->count;
        if ($countEmail > 0) {
            // Email or telephone already exists
            echo 2;
        }
        else {
            // Generate a six-digit verification code
            $verificationCode = random_int(100000, 999999);

            $getuser = "SELECT full_name FROM `users` WHERE `id`='$id'";
            $healthdb->prepare($getuser);
            $result = $healthdb->singleRecord();
            $fullname = $result->full_name;

            $query = "UPDATE `users`
                SET emailaddress='$emailaddress',
                telephone='$telephone',
                jobtitle='$jobtitle', 
                department='$department',
                code='$verificationCode'

                WHERE id='$id'";
            $healthdb->prepare($query);
            $healthdb->execute();

            // Compose the verification email
            $message = "Hello $fullname, <br>Please use the following code to verify your email address: <strong>$verificationCode</strong>";

            //SendEmail::compose($emailaddress, 'AHPC User Verification', $message);
            echo 1;

        }

    }

    public static function verifycode($id,$verification_code)
    {
        global $healthdb;

        $getuser = "SELECT code FROM `users` WHERE `id`='$id'";
        $healthdb->prepare($getuser);
        $result = $healthdb->singleRecord();
        $code = $result->code;

        if ($code == $verification_code) {
            $query = "UPDATE `users`
            SET emailverified=1  WHERE id='$id'";
            $healthdb->prepare($query);
            $healthdb->execute();
            $_SESSION['emailverified'] = 1;
            echo 1;
        }
        else {
            // Code doees not match
            echo 2;
        }
    }

    public static function getTotalUsers() {
        global $healthdb;

        $query = "select count(*) as count from `users` WHERE `status` = 1";
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function getTotalUsersWithFilter($searchQuery) {
        global $healthdb;

        $query = "select count(*) as count from `users` WHERE `status` = 1 AND 1 " . $searchQuery;
        $healthdb->prepare($query);
        $result = $healthdb->singleRecord();
        return $result->count;
    }


    public static function deleteUser($dbid) {

        global $healthdb;
        $query = "UPDATE `users` 
        SET `status` = 0,`updatedAt` = NOW() WHERE `id` = '$dbid'";
        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;   
    }



    public static function fetchUsersRecords($searchQuery, $row, $rowperpage) {
        global $healthdb;
  
        $query = "select * from `users` WHERE `status` = 1 AND 1 " . $searchQuery . " order by createdAt DESC limit " . $row . "," . $rowperpage;
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return $result;      
    }


    public static function logout()
    {

        $username = $_SESSION['username'];
        Tools::logAction("$username Logged out successfully","Successful"); 
        unset($_SESSION['uid']);
        session_destroy();

        Redirecting::location('pages/login');
    }
}
