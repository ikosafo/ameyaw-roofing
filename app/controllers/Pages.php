<?php

class Pages extends Controller
{

    public function forgetPassword()
    {
        $this->view("pages/auth/forgotpassword");
    }
    

    public function index()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        //$uuid = Tools::getUUIDbyid($uid);
        //$userDetails = Users::userDetails($uuid);
        //$getPropertyNumber = Properties::getPropertyNumber();
        //$getClientNumber = Clients::getClientNumber();
        //$getOpenIssueNumber = Complaints::getOpenIssueNumber();
        //$getBillingGoodStandingNumber = Billings::getBillingGoodStandingNumber();
        $this->view("pages/index",
        [
            //'getPropertyNumber' => $getPropertyNumber,
            //'getClientNumber' => $getClientNumber,
            //'getOpenIssueNumber' => $getOpenIssueNumber,
            //'userDetails' => $userDetails,
            //'getClientNumber' => $getClientNumber,
            //'getBillingGoodStandingNumber' => $getBillingGoodStandingNumber
        ]);
    }


  /*   public function viewRequests()
    {
        new Guard();
        $this->view("pages/viewRequests");
    }


    public function client()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $clientDetails = Clients::clientDetails($clientid);
        $this->view("pages/client",['clientDetails' => $clientDetails]);
    }


    public function worker()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $this->view("pages/worker");
    }


    public function inspector()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $this->view("pages/inspector");
    }
    

    public function addProperty() {
        new Guard();
        $listPropertyCategory = Properties::listPropertyCategory();
        $getPropertyNumber = Properties::getPropertyNumber();
        $getApartmentNumber = Properties::getApartmentNumber();
        $getHouseNumber = Properties::getHouseNumber();
        $getCommercialNumber = Properties::getCommercialNumber();
        $getLandNumber = Properties::getLandNumber();
        $getFurnishedNumber = Properties::getFurnishedNumber();
        $getUnfurnishedNumber = Properties::getUnfurnishedNumber();
        $getSemifurnishedNumber = Properties::getSemifurnishedNumber();
        //$listUsers = Users::listUsers();
        $this->view("pages/addProperty",[
            'listPropertyCategory' => $listPropertyCategory,
            //'listUsers' => $listUsers,
            'getPropertyNumber' => $getPropertyNumber,
            'getApartmentNumber' => $getApartmentNumber,
            'getHouseNumber' => $getHouseNumber,
            'getCommercialNumber' => $getCommercialNumber,
            'getLandNumber' => $getLandNumber,
            'getFurnishedNumber' => $getFurnishedNumber,
            'getUnfurnishedNumber' => $getUnfurnishedNumber,
            'getSemifurnishedNumber' => $getSemifurnishedNumber
        ]);
    }  


    public function addUser() {
        new Guard();
        $listUsers = Users::listUsers();
        $listDepartment = Institution::listDepartment();
        $listServiceIssues = Complaints::listServiceIssues();
        $this->view("pages/addUser",[
            'listUsers' => $listUsers,
            'listDepartment' => $listDepartment,
            'listServiceIssues' => $listServiceIssues
        ]);
    }  


    public function addTenant() {
        new Guard();
        $listUsers = Users::listUsers();
        $listDepartment = Institution::listDepartment();
        $listProperties = Properties::listProperties();
        $this->view("pages/addTenant",[
            'listUsers' => $listUsers,
            'listDepartment' => $listDepartment,
            'listProperties' => $listProperties
        ]);
    }  


    public function editUser() {
        new Guard();

        $listUsers = Users::listUsers();
        $encryptedId = $_GET['userid'];
        $decryptedUserId = Tools::unlock($encryptedId);
        $userDetails = Institution::userDetails($decryptedUserId);
        $uuid = $userDetails['uuid'];
        $userPermissions = Users::userPermissions($uuid);
        $userComplaints = Users::userComplaints($uuid);
        $listDepartment = Institution::listDepartment();

        $this->view("pages/editUser",[
            'listUsers' => $listUsers,
            'listDepartment' => $listDepartment,
            'userid' => $decryptedUserId,
            'userDetails' => $userDetails,
            'userPermissions' => $userPermissions,
            'userComplaints' => $userComplaints
        ]);
    } 
    

    public function editProperty() {
        new Guard();

        $listUsers = Users::listUsers();
        $listProperties = Properties::listProperties();
        $listPropertyCategory = Properties::listPropertyCategory();
        $encryptedId = $_GET['propertyid'];
        $decryptedUserId = Tools::unlock($encryptedId);
        $propertyDetails = Properties::propertyDetails($decryptedUserId);
        $uuid = $propertyDetails['uuid'];

        $this->view("pages/editProperty",[
            'listProperties' => $listProperties,
            'userid' => $decryptedUserId,
            'uuid' => $uuid,
            'propertyDetails' => $propertyDetails,
            'listPropertyCategory' => $listPropertyCategory,
            'listUsers' => $listUsers
        ]);
    } 


    public function editPayment() {
        new Guard();

        $encryptedId = $_GET['paymentid'];
        $decryptedUserId = Tools::unlock($encryptedId);
        $paymentDetails = Billings::paymentDetails($decryptedUserId);
        $this->view("pages/editPayment",['paymentDetails' => $paymentDetails]);
    } 


    public function listUsers() {
        new Guard();
        $listUsers = Users::listUsers();
        $this->view("pages/listUsers",[
            'listUsers' => $listUsers
        ]);
    }  


    public function userPermissions() {
        new Guard();
        $this->view("pages/userPermissions");
    }  


    public function paymentHistory() {
        new Guard();
        $paymentHistory = Billings::paymentHistory();
        $this->view("pages/paymentHistory",[
            'paymentHistory' => $paymentHistory
        ]);
    }  


    public function listClients() {
        new Guard();
        $listClients = Properties::listClients();
        $this->view("pages/listClients",[
            'listClients' => $listClients
        ]);
    }  

    
    public function addClient() {
        new Guard();
        $listProperties = Properties::listProperties();
        $listPhases = Properties::listPhases();
        $this->view("pages/addClient",[
            'listProperties' => $listProperties,
            'listPhases' => $listPhases
        ]);
    } 
    
    
    public function addInspectors() {
        new Guard();
        $listUsers = Users::listUsers();
        $this->view("pages/addInspectors",[
            'listUsers' => $listUsers
        ]);
    } 


    public function rentInformation() {
        new Guard();
        $listProperties = Properties::listProperties();
        $this->view("pages/rentInformation",[
            'listProperties' => $listProperties
        ]);
    } 
    
    
    public function rentInvoices() {
        new Guard();
        $listProperties = Properties::listProperties();
        $this->view("pages/rentInvoices",[
            'listProperties' => $listProperties
        ]);
    } 


    public function maintenanceInvoices() {
        new Guard();
        $listRentInformation = Properties::listRentInformation();
        $this->view("pages/maintenanceInvoices",[
            'listRentInformation' => $listRentInformation
        ]);
    } 


    public function billPayments() {
        new Guard();
        $this->view("pages/billPayments");
    } 


    public function billPaymentsMaintenance() {
        new Guard();
        $this->view("pages/billPaymentsMaintenance");
    } 


    public function billPaymentsRent() {
        new Guard();
        $this->view("pages/billPaymentsRent");
    } 
    

    public function scheduleInspection() {
        new Guard();
        $listProperties = Properties::listProperties();
        $listUsers = Users::listUsers();
        $this->view("pages/scheduleInspection",[
            'listProperties' => $listProperties,
            'listUsers' => $listUsers
        ]);
    } 
    

    public function billPaymentClient() {
        new Guard();
        $this->view("pages/billPaymentClient");
    }
    
    
    public function maintenanceRequests() {
        new Guard();
        $this->view("pages/maintenanceRequests");
    }


    public function billMaintenanceClient() {
        new Guard();
        $this->view("pages/billMaintenanceClient");
    }  


    public function rentReports() {
        new Guard();
        $this->view("pages/rentReports");
    }  


    public function clientPaymentHistory() {
        new Guard();
        $this->view("pages/clientPaymentHistory");
    }  
    

    public function viewClient() {
        new Guard();

        $encryptedId = $_GET['clientid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $clientDetails = Clients::clientDetails($decryptedClientId);
        $clientPaymentHistoy = Billings::clientPaymentHistoy($decryptedClientId);
        $listClientComplaints = Complaints::listClientComplaints($decryptedClientId);
        $propertyid = $clientDetails['propertyid'];
        $propertyName = Tools::propertyClient($propertyid);
        $uuid = $clientDetails['uuid'];
        $phaseid = $clientDetails['phaseid'];

        $this->view("pages/viewClient",[
            'uuid' => $uuid,
            'clientDetails' => $clientDetails,
            'propertyName' => $propertyName,
            'clientPaymentHistoy' => $clientPaymentHistoy,
            'listClientComplaints' => $listClientComplaints,
            'phaseid' => $phaseid
        ]);
    } 


    public function viewComplaint() {
        new Guard();

        $encryptedId = $_GET['complaintid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $complaintDetails = Complaints::complaintDetails($decryptedClientId);
        $complaintid = $complaintDetails['complaintid'];

        $this->view("pages/viewComplaint",[
            'complaintDetails' => $complaintDetails
        ]);
    } 


    public function viewTask() {
        new Guard();

        $encryptedId = $_GET['complaintid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $complaintDetails = Complaints::complaintDetails($decryptedClientId);
        $complaintid = $complaintDetails['complaintid'];

        $this->view("pages/viewTask",[
            'complaintDetails' => $complaintDetails
        ]);
    } 


    public function viewInspectionDetail() {
        new Guard();

        $encryptedId = $_GET['inspectionid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $inspectionDetails = Inspections::inspectionDetails($decryptedClientId);

        $this->view("pages/viewInspectionDetail",[
            'inspectionDetails' => $inspectionDetails
        ]);
    } 


    public function viewPayment() {
        new Guard();

        $encryptedId = $_GET['paymentid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $paymentDetails = Billings::paymentDetails($decryptedClientId);

        $this->view("pages/viewPayment",['paymentDetails' => $paymentDetails]);
    } 


    
    public function viewClientRent() {
        new Guard();
        
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $lastRentId = Tools::lastRentId($clientid);
        $rentInfo = Properties::rentInfo($lastRentId);
        $previousRent = Properties::previousRent($clientid,$lastRentId);

        $this->view("pages/viewClientRent",[
            'rentInfo' => $rentInfo,
            'previousRent' => $previousRent
        ]);
    } 


    public function viewRentInfo() {
        new Guard();

        $encryptedId = $_GET['rentid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $rentInfo = Properties::rentInfo($decryptedClientId);

        $this->view("pages/viewRentInfo",[
            'rentInfo' => $rentInfo
        ]);
    } 


    public function editClient() {
        new Guard();

        $encryptedId = $_GET['clientid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $clientDetails = Clients::clientDetails($decryptedClientId);
        $propertyid = $clientDetails['propertyid'];
        $propertyName = Tools::propertyClient($propertyid);
        $listProperties = Properties::listProperties();
        $listPhases = Properties::listPhases();
        $uuid = $clientDetails['uuid'];

        $this->view("pages/editClient",[
            'uuid' => $uuid,
            'clientDetails' => $clientDetails,
            'propertyName' => $propertyName,
            'listProperties' => $listProperties,
            'listPhases' => $listPhases
        ]);
    } 


    public function editRentInfo() {
        new Guard();

        $encryptedId = $_GET['rentid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $rentInfo = Properties::rentInfo($decryptedClientId);
        $phaseid = $rentInfo['phaseid'];

        $this->view("pages/editRentInfo",[
            'rentInfo' => $rentInfo,
            'phaseid' => $phaseid
        ]);
    } 


    public function viewProperty() {
        new Guard();

        $encryptedId = $_GET['propertyid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $propertyDetails = Properties::propertyDetails($decryptedClientId);
        $ownerDetails = Properties::ownerDetails($decryptedClientId);
        $listClientsProp = Properties::listClientsProp($decryptedClientId);
        $uuid = $propertyDetails['uuid'];

        $this->view("pages/viewProperty",[
            'uuid' => $uuid,
            'propertyDetails' => $propertyDetails,
            'ownerDetails' => $ownerDetails,
            'listClientsProp' => $listClientsProp
        ]);
    } 


    public function listProperties() {
        new Guard();
        $listProperties = Properties::listProperties();
        $this->view("pages/listProperties",[
            'listProperties' => $listProperties
        ]);
    } 
    

    public function listComplaints() {
        new Guard();
        $this->view("pages/listComplaints");
    }  


    public function maintenanceTasks() {
        new Guard();
        $this->view("pages/maintenanceTasks");
    }  

    
    public function inspectionHistory() {
        new Guard();
        $this->view("pages/inspectionHistory");
    } 


    public function complaintStatuses() {
        new Guard();
        $this->view("pages/complaintStatuses");
    }  

    public function trackRepairs() {
        new Guard();
        $this->view("pages/trackRepairs");
    }  


    public function listRentInformation() {
        new Guard();
        $listRentInformation = Properties::listRentInformation();
        $this->view("pages/listRentInformation",[
            'listRentInformation' => $listRentInformation
        ]);
    } 


    public function propertyCategories() {
        new Guard();  
        $this->view("pages/propertyCategories");
    }
    
    
    public function complaintCategories() {
        new Guard();  
        $this->view("pages/complaintCategories");
    }


    public function propertyActivities() {
        new Guard();  
        $this->view("pages/propertyActivities");
    } 


    public function propertyPhases() {
        new Guard();  
        $this->view("pages/propertyPhases");
    } 
    
    
    public function maintenanceFee() {
        new Guard();  
        $this->view("pages/maintenanceFee");
    } 


    public function companyDepartments() {
        new Guard();  
        $this->view("pages/companyDepartments");
    } 


    public function logComplaint() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $listProperties = Properties::listProperties();
        $this->view("pages/logComplaint",
            [
                'listProperties' => $listProperties,
                'clientid' => $clientid
            ]);
    } 


    public function dailyInspection() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $listProperties = Properties::listProperties();
        $this->view("pages/dailyInspection",['listProperties' => $listProperties]);
    } 


    public function changePasswordClient() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $this->view("pages/changePasswordClient",
            ['clientid' => $clientid, 
                'uuid' => $uuid
            ]
        );
    } 


    public function changePasswordUser() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $this->view("pages/changePasswordUser",
            ['uid' => $uid, 
            'uuid' => $uuid
            ]
        );
    } 

    public function userProfileAdmin() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $userDetails = Users::userDetails($uid);
        $this->view("pages/userProfileAdmin", ['userDetails' => $userDetails]
        );
    } 
    

    public function userProfileClient() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $clientDetails = Clients::clientDetails($clientid);
        $this->view("pages/userProfileClient",['clientDetails' => $clientDetails]
        );
    }  */
    

    public function lock()
    {
        new Guard();
        $data = array(
            'username' => $_SESSION['username'],
            'name' => $_SESSION['name'],
            'mainaccesslevel' => $_SESSION['mainaccesslevel']
        );
        unset($_SESSION['uid']);
        session_destroy();
        $this->view('pages/lock', $data);
    }


    public function locked()
    {
        $this->view('pages/locked');
    }
  
   /*  public function mail()
    {
        print_r(SendEmail::compose('yawshadi23@gmail.com', 'hello', 'how are you doing today'));
    } */

}
