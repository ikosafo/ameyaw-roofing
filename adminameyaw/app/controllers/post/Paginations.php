<?php

class Paginations extends PostController
{

    public function listProducts()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $pageStatus = $_POST['pageStatus'] ?? null;

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $categories = Tools::getAllCategoryMappings(); // Returns an associative array [id => name]
        $types = Tools::getAllTypeMappings();

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $matchingCategoryIds = [];
            foreach ($categories as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingCategoryIds[] = $id;
                }
            }
            
            $categorySearch = !empty($matchingCategoryIds) 
                ? " OR categoryId IN (" . implode(",", $matchingCategoryIds) . ")" 
                : "";


            $matchingTypeIds = [];
            foreach ($types as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingTypeIds[] = $id;
                }
            }
            
            $typeSearch = !empty($matchingTypeIds) 
                ? " OR materialType IN (" . implode(",", $matchingTypeIds) . ")" 
                : "";

            $searchQuery = "
            AND (
                productName LIKE '%$searchValue%'
                OR materialType LIKE '%$searchValue%'
                $categorySearch
                $typeSearch
            )";
        }

        $totalRecords = Product::getTotalProducts();
        $totalRecordwithFilter = Product::getTotalProductsWithFilter($searchQuery);
        $fetchRecords = Product::fetchProductsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $categoryName = isset($categories[$record->categoryId]) ? $categories[$record->categoryId] : "Unknown";
            $typeName = isset($types[$record->materialType]) ? $types[$record->materialType] : "Unknown";
            $data[] = array(
                "number"        => $no++,
                "productName"   => $record->productName,
                "categoryId"    => $categoryName,
                "materialType"  => $typeName,
                "action"        => ($pageStatus === 'Restock') 
                                    ? Tools::restockTableAction($record->productId) 
                                    : Tools::productTableAction($record->productId),
            );
            
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listSupport()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
           

            $searchQuery = "
            AND (
                emailAddress LIKE '%$searchValue%'
                OR ipAddress LIKE '%$searchValue%'
                OR createdAt LIKE '%$searchValue%'
            )";
        }

        $totalRecords = Contacts::getTotalSupport();
        $totalRecordwithFilter = Contacts::getTotalSupportWithFilter($searchQuery);
        $fetchRecords = Contacts::fetchSupportRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            
            $data[] = array(
                "number"        => $no++,
                "emailAddress"   => $record->emailAddress,
                "createdAt"    => $record->createdAt,
                "ipAddress"  => $record->ipAddress,
            );
            
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listContacts() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $searchQuery = "
            AND (
                contactName LIKE '%$searchValue%'
                OR contactMessage LIKE '%$searchValue%'
                OR contactEmail LIKE '%$searchValue%'
                OR ipAddress LIKE '%$searchValue%'
                OR createdAt LIKE '%$searchValue%'
            )";
        }

        $totalRecords = Contacts::getTotalContacts();
        $totalRecordwithFilter = Contacts::getTotalContactsWithFilter($searchQuery);
        $fetchRecords = Contacts::fetchContactsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) { 
            $data[] = array(
                "number"        => $no++,
                "fullName"   => $record->contactName,
                "emailAddress"   => $record->contactEmail,
                "message"   => $record->contactMessage,
                "createdAt"    => $record->createdAt,
                "ipAddress"  => $record->ipAddress,
            );         
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }
    
    public function viewCustomers()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
           

            $searchQuery = "
            AND (
                clientName LIKE '%$searchValue%'
                OR clientTelephone LIKE '%$searchValue%'
                OR clientEmail LIKE '%$searchValue%'
                OR region LIKE '%$searchValue%'
                OR clientType LIKE '%$searchValue%'
            )";
        }

        $totalRecords = Order::getTotalInspections();
        $totalRecordwithFilter = Order::getTotalInspectionsWithFilter($searchQuery);
        $fetchRecords = Order::fetchInspectionsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            
            $data[] = array(
                "number"        => $no++,
                "clientType"   => $record->clientType,
                "clientName"   => $record->clientName,
                "telephone"    => $record->clientTelephone,
                "clientEmail"  => $record->clientEmail,
                "region"  => $record->region,
                "action"  => Tools::inspectionTableAction($record->inspectionid)
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }
 

    public function listSupplierProducts()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $supplierId = $_POST['supplierId'] ?? null;

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $categories = Tools::getAllCategoryMappings(); // Returns an associative array [id => name]

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $matchingCategoryIds = [];
            foreach ($categories as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingCategoryIds[] = $id;
                }
            }
            
            $categorySearch = !empty($matchingCategoryIds) 
                ? " OR categoryId IN (" . implode(",", $matchingCategoryIds) . ")" 
                : "";

            $searchQuery = "
            AND (
                productName LIKE '%$searchValue%'
                OR materialType LIKE '%$searchValue%'
                OR stockQuantity LIKE '%$searchValue%'
                $categorySearch
            )";
        }

        $totalRecords = Product::getTotalSupplierProducts($supplierId);
        $totalRecordwithFilter = Product::getTotalSupplierProductsWithFilter($supplierId,$searchQuery);
        $fetchRecords = Product::fetchSupplierProductsRecords($supplierId,$searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $categoryName = isset($categories[$record->categoryId]) ? $categories[$record->categoryId] : "Unknown";
            $data[] = array(
                "number"        => $no++,
                "productName"   => $record->productName,
                "categoryId"    => $categoryName,
                "materialType"  => $record->materialType,
                "stockQuantity" => $record->stockQuantity,
            );
            
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }
    

    
    public function manageInventory()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $categories = Tools::getAllCategoryMappings(); 
        $suppliers = Tools::getAllSupplierMappings(); 

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $matchingCategoryIds = [];
            foreach ($categories as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingCategoryIds[] = $id;
                }
            }
            
            $categorySearch = !empty($matchingCategoryIds) 
                ? " OR categoryId IN (" . implode(",", $matchingCategoryIds) . ")" 
                : "";


            $matchingSupplierIds = [];
            foreach ($suppliers as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingSupplierIds[] = $id;
                }
            }
            
            $supplierSearch = !empty($matchingSupplierIds) 
                ? " OR supplierId IN (" . implode(",", $matchingSupplierIds) . ")" 
                : "";

            $searchQuery = "
            AND (
                productName LIKE '%$searchValue%'
                OR materialType LIKE '%$searchValue%'
                OR stockQuantity LIKE '%$searchValue%'
                OR color LIKE '%$searchValue%'
                OR thickness LIKE '%$searchValue%'
                OR length LIKE '%$searchValue%'
                OR width LIKE '%$searchValue%'
                $categorySearch
                $supplierSearch
            )";
        }

        $totalRecords = Product::getTotalProducts();
        $totalRecordwithFilter = Product::getTotalProductsWithFilter($searchQuery);
        $fetchRecords = Product::fetchProductsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $categoryName = isset($categories[$record->categoryId]) ? $categories[$record->categoryId] : "Unknown";
            $supplierName = isset($suppliers[$record->supplierId]) ? $suppliers[$record->supplierId] : "Not Applicable";
            $data[] = array(
                "number" => $no++,
                "productName" => $record->productName,
                "categoryId" => $categoryName . '<br><small>' . $record->materialType . '</small>',
                "dimensions" => '<small>Color: ' . $record->color . '<br>Thickness: ' . $record->thickness . ' mm<br>Length: ' . $record->length . ' m<br>Width: ' . $record->width . ' m</small>',
                "stockQuantity" => $record->stockQuantity,
                "supplier" => $supplierName,
                "action" => Tools::inventoryTableAction($record->productId),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listMovements()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $products = Tools::getAllProductMappings();  

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $matchingProductIds = [];
            foreach ($products as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingProductIds[] = $id;
                }
            }
            
            $productSearch = !empty($matchingProductIds) 
                ? " OR productId IN (" . implode(",", $matchingProductIds) . ")" 
                : "";

            $searchQuery = "
            AND (
                movementType LIKE '%$searchValue%'
                OR quantity LIKE '%$searchValue%'
                OR description LIKE '%$searchValue%'
                $productSearch
            )";
        }

        $totalRecords = Product::getTotalMovements();
        $totalRecordwithFilter = Product::getTotalMovementsWithFilter($searchQuery);
        $fetchRecords = Product::fetchMovementsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $productName = isset($products[$record->productId]) ? $products[$record->productId] : "Unknown";
            $data[] = array(
                "number" => $no++,
                "productName" => $productName,
                "movementType" => $record->movementType,
                "quantity" => $record->quantity,
                "description" => $record->description,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listLowStock()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $categories = Tools::getAllCategoryMappings(); // Returns an associative array [id => name]

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $matchingCategoryIds = [];
            foreach ($categories as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingCategoryIds[] = $id;
                }
            }
            
            $categorySearch = !empty($matchingCategoryIds) 
                ? " OR categoryId IN (" . implode(",", $matchingCategoryIds) . ")" 
                : "";

            $searchQuery = "
            AND (
                productName LIKE '%$searchValue%'
                OR materialType LIKE '%$searchValue%'
                OR unitPrice LIKE '%$searchValue%'
                OR stockQuantity LIKE '%$searchValue%'
                $categorySearch
            )";
        }

        $totalRecords = Product::getTotalProductsThreshold();
        $totalRecordwithFilter = Product::getTotalProductsWithFilterThreshold($searchQuery);
        $fetchRecords = Product::fetchProductsRecordsThreshold($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $categoryName = isset($categories[$record->categoryId]) ? $categories[$record->categoryId] : "Unknown";
            $badgeClass = 'badge badge-danger';
            $data[] = array(
                "number" => $no++,
                "productName" => $record->productName,
                "categoryId" => $categoryName,
                "materialType" => $record->materialType,
                "unitPrice" => $record->unitPrice,
                "stockQuantity" => '<span class="'.$badgeClass.'">'.$record->stockQuantity.'</span>',
                "action" => Tools::productThresholdTableAction($record->productId),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function invoicing()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $searchQuery = "
            AND (
                clientName LIKE '%$searchValue%'
                OR clientTelephone LIKE '%$searchValue%'
                OR clientEmail LIKE '%$searchValue%'
                OR siteLocation LIKE '%$searchValue%'
                OR inspectionDate LIKE '%$searchValue%'
                OR CONCAT(
                    LEFT(COALESCE(UUID, ''), 2),
                    LEFT(COALESCE(clientName, ''), 2),
                    LEFT(COALESCE(clientTelephone, ''), 2),
                    RIGHT(YEAR(NOW()), 2), 
                    LEFT(COALESCE(siteLocation, ''), 2),
                    LEFT(COALESCE(inspectorName, ''), 2)
                ) LIKE '%$searchValue%'
 
            )";
        }

        $totalRecords = Order::getTotalInspections();
        $totalRecordwithFilter = Order::getTotalInspectionsWithFilter($searchQuery);
        $fetchRecords = Order::fetchInspectionsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $data[] = array(
                "number" => $no++,
                "orderId" => '<span style="text-transform:uppercase">' . Tools::generateOrderId($record->inspectionid) . '</span>',
                "clientName" => $record->clientName,
                "clientTelephone" => $record->clientTelephone,
                "siteLocation" => $record->siteLocation,
                "orderStatus" => $record->paymentStatus === 'Successful' 
                    ? '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Successful</span>' 
                    : ($record->profile 
                        ? '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Invoice Created</span>' 
                        : '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Pending</span>'),
                "action" => Tools::invoicingTableAction($record->inspectionid),
            );

        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function receipting()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $searchQuery = "
            AND (
                clientName LIKE '%$searchValue%'
                OR clientTelephone LIKE '%$searchValue%'
                OR clientEmail LIKE '%$searchValue%'
                OR profile LIKE '%$searchValue%'
                OR CONCAT(
                    LEFT(COALESCE(UUID, ''), 2),
                    LEFT(COALESCE(clientName, ''), 2),
                    LEFT(COALESCE(clientTelephone, ''), 2),
                    RIGHT(YEAR(NOW()), 2), 
                    LEFT(COALESCE(siteLocation, ''), 2),
                    LEFT(COALESCE(inspectorName, ''), 2)
                ) LIKE '%$searchValue%'
 
            )";
        }

        $totalRecords = Order::getTotalInspectionsInvoice();
        $totalRecordwithFilter = Order::getTotalInspectionsInvoiceWithFilter($searchQuery);
        $fetchRecords = Order::fetchInspectionsInvoiceRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $data[] = array(
                "number" => $no++,
                "orderId" => '<span style="text-transform:uppercase">' . Tools::generateOrderId($record->inspectionid) . '</span>',
                "clientName" => $record->clientName,
                "clientTelephone" => $record->clientTelephone,
                "profile" => $record->profile,
                "grandTotal" => ($record->totalPrice + $record->delivery + $record->installation) - $record->discount,
                "action"  => ($record->paymentStatus == 'Successful') 
                ? Tools::receiptingTableAction($record->inspectionid) 
                : Tools::salesTableAction($record->inspectionid),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        echo json_encode($response);
    }


    public function listOrders()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);


        $searchQuery = "";
        if (!empty($searchValue)) {

            $searchQuery = "
            AND (
                customerName LIKE '%$searchValue%'
                OR customerEmail LIKE '%$searchValue%'
                OR totalAmount LIKE '%$searchValue%'
                OR deliveryMode LIKE '%$searchValue%'
                OR paymentStatus LIKE '%$searchValue%'
                OR orderId LIKE '%$searchValue%'
                OR CONCAT(
                    COALESCE(orderId, ''),
                    LEFT(COALESCE(customerName, ''), 2),
                    LEFT(COALESCE(uuid, ''), 2),
                    LEFT(COALESCE(customerPhone, ''), 2),
                    LEFT(COALESCE(deliveryMode, ''), 2),
                    LEFT(COALESCE(paymentStatus, ''), 2)
                ) LIKE '%$searchValue%'

                
            )";
        }

        $totalRecords = Order::getTotalOrders();
        $totalRecordwithFilter = Order::getTotalOrdersWithFilter($searchQuery);
        $fetchRecords = Order::fetchOrdersRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $data[] = array(
                "number" => $no++,
                "orderId" => '<span style="text-transform:uppercase">' . Tools::getOrderId($record->orderId) . '</span>',
                "customer" => $record->customerName,
                "totalAmount" => $record->totalAmount,
                "paymentStatus" => $record->paymentStatus === 'Successful' 
                    ? '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Successful</span>' 
                    : ($record->paymentStatus === 'Failed' 
                        ? '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Failed</span>' 
                        : '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">' . $record->paymentStatus . '</span>'),
                "deliveryMode" => '<span style="text-transform:uppercase">' . $record->deliveryMode . '</span>',
                "action" => Tools::orderTableAction($record->orderId),
            );
            
            
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listUsers()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
            $searchQuery = "
            AND (
                fullName LIKE '%$searchValue%'
                OR emailAddress LIKE '%$searchValue%'
                OR phoneNumber LIKE '%$searchValue%'
                OR birthDate LIKE '%$searchValue%'
                OR gender LIKE '%$searchValue%'
                OR maritalStatus LIKE '%$searchValue%'
                OR jobTitle LIKE '%$searchValue%'
                OR department LIKE '%$searchValue%'
                OR employeeType LIKE '%$searchValue%'              
            )";
        }
        $totalRecords = User::getTotalUsers();
        $totalRecordwithFilter = User::getTotalUsersWithFilter($searchQuery);
        $fetchRecords = User::fetchUsersRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $data[] = array(
                "number" => $no++,
                "fullName" => $record->fullName,
                "emailAddress" => $record->emailAddress,
                "telephone" => $record->phoneNumber,
                "jobTitle" => $record->jobtitle,
                "userType" => $record->userType,
                "action" => Tools::userTableAction($record->id),
            );     
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function paymentHistory()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);


        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $searchQuery = "
            AND (
                paymentMethod LIKE '%$searchValue%'
                OR amount LIKE '%$searchValue%'
                OR description LIKE '%$searchValue%'
                    
            )";
        }

        $totalRecords = Payment::getTotalHistory();
        $totalRecordwithFilter = Payment::getTotalHistoryWithFilter($searchQuery);
        $fetchRecords = Payment::fetchHistoryRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $data[] = array(
                "number" => $no++,
                "paymentMethod" => $record->paymentMethod,
                "amount" => $record->amount,
                "description" => $record->paymentDescription,
                /* "action" => Tools::paymentTableAction($record->paymentId), */
            );     
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    

    public function listCustomerOrders()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);
        $customerPhone = $_POST['customerPhone'];

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $searchQuery = "
            AND (
                clientName LIKE '%$searchValue%'
                OR clientTelephone LIKE '%$searchValue%'
                OR clientEmail LIKE '%$searchValue%'
                OR profile LIKE '%$searchValue%'
                OR CONCAT(
                    LEFT(COALESCE(UUID, ''), 2),
                    LEFT(COALESCE(clientName, ''), 2),
                    LEFT(COALESCE(clientTelephone, ''), 2),
                    RIGHT(YEAR(NOW()), 2), 
                    LEFT(COALESCE(siteLocation, ''), 2),
                    LEFT(COALESCE(inspectorName, ''), 2)
                ) LIKE '%$searchValue%'
                
            )";
        }

        $totalRecords = Order::getTotalPhoneOrders($customerPhone);
        $totalRecordwithFilter = Order::getTotalPhoneOrdersWithFilter($customerPhone,$searchQuery);
        $fetchRecords = Order::fetchPhoneOrdersRecords($customerPhone,$searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {

            $totalAmount = ((int) $record->totalPrice + (int) $record->delivery + (int) $record->installation) - (int) $record->discount;

            $paymentStatusLabel = '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">' . $record->paymentStatus . '</span>';
            if ($record->paymentStatus === 'Successful') {
                $paymentStatusLabel = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Successful</span>';
            } elseif ($record->paymentStatus === 'Failed') {
                $paymentStatusLabel = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Failed</span>';
            } elseif ($record->paymentStatus == '') {
                $paymentStatusLabel = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Not Paid</span>';
            }

            $orderStatusLabel = '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Pending</span>';
            if ($record->paymentStatus === 'Successful') {
                $orderStatusLabel = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Successful</span>';
            } elseif ($record->profile) {
                $orderStatusLabel = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Invoice Created</span>';
            }

            $data[] = array(
                "number" => $no++,
                "orderId" => '<span style="text-transform:uppercase">' . Tools::generateOrderId($record->inspectionid) . '</span>',
                "customer" => htmlspecialchars($record->clientName, ENT_QUOTES, 'UTF-8'),
                "totalAmount" => $totalAmount,
                "paymentStatus" => $paymentStatusLabel,
                "orderStatus" => $orderStatusLabel,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listOrderStatus()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);
        $orderStatus = $_POST['orderStatus'];
        $orderFrom = $_POST['orderFrom'];
        $orderTo = $_POST['orderTo'];

        $searchQuery = "";
        if (!empty($searchValue)) { 
            $searchQuery = "
            AND (
                clientName LIKE '%$searchValue%'
                OR clientTelephone LIKE '%$searchValue%'
                OR clientEmail LIKE '%$searchValue%'
                OR totalAmount LIKE '%$searchValue%'
                OR paymentStatus LIKE '%$searchValue%'
                OR orderId LIKE '%$searchValue%'
                OR CONCAT(
                     orderId,
                    LEFT(COALESCE(customerName, ''), 2),
                    LEFT(COALESCE(uuid, ''), 2),
                    LEFT(COALESCE(customerPhone, ''), 2),
                    LEFT(COALESCE(deliveryMode, ''), 2),
                    LEFT(COALESCE(paymentStatus, ''), 2)
                ) LIKE '%$searchValue%'  
            )";
        }

        $totalRecords = Order::getTotalStatusOrders($orderStatus, $orderFrom, $orderTo);
        $totalRecordwithFilter = Order::getTotalStatusOrdersWithFilter($orderStatus,$orderFrom, $orderTo,$searchQuery);
        $fetchRecords = Order::fetchStatusOrdersRecords($orderStatus,$orderFrom, $orderTo,$searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $totalAmount = ((int) $record->totalPrice + (int) $record->delivery + (int) $record->installation) - (int) $record->discount;

            $paymentStatusLabel = '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">' . $record->paymentStatus . '</span>';
            if ($record->paymentStatus === 'Successful') {
                $paymentStatusLabel = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Successful</span>';
            } elseif ($record->paymentStatus === 'Failed') {
                $paymentStatusLabel = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Failed</span>';
            } elseif ($record->paymentStatus == '') {
                $paymentStatusLabel = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Not Paid</span>';
            }

            $orderStatusLabel = '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Pending</span>';
            if ($record->paymentStatus === 'Successful') {
                $orderStatusLabel = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Successful</span>';
            } elseif ($record->profile) {
                $orderStatusLabel = '<span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Invoice Created</span>';
            }
            $data[] = array(
                "number" => $no++,
                "orderId" => '<span style="text-transform:uppercase">' . Tools::generateOrderId($record->inspectionid) . '</span>',
                "customer" => htmlspecialchars($record->clientName, ENT_QUOTES, 'UTF-8'),
                "totalAmount" => $totalAmount,
                "paymentStatus" => $paymentStatusLabel,
                "orderStatus" => $orderStatusLabel,
            ); 
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        echo json_encode($response);
    }
    

    public function listCustomers()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $searchQuery = "";
        if (!empty($searchValue)) {
            $searchQuery = "
            AND (
                clientName LIKE '%$searchValue%'
                OR clientEmail LIKE '%$searchValue%'
                OR clientTelephone LIKE '%$searchValue%'
                OR siteLocation LIKE '%$searchValue%'    
            )";
        }

        $totalRecords = Order::getTotalCustomerOrders();
        $totalRecordwithFilter = Order::getTotalCustomerOrdersWithFilter($searchQuery);
        $fetchRecords = Order::fetchCustomerOrdersRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $data[] = array(
                "number" => $no++,
                "fullName" => Tools::getCustomerNameWithPhone($record->clientTelephone),
                "phone" => $record->clientTelephone,
                "emailAddress" => Tools::getCustomerEmailWithPhone($record->clientTelephone),
                "residence" => Tools::getCustomerResidenceWithPhone($record->clientTelephone),
                "action" => Tools::customerOrderTableAction($record->clientTelephone),  
            );
                     
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }


    public function listWebsiteProducts()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $pageStatus = $_POST['pageStatus'] ?? null;

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length'];
        $searchValue = trim($_POST['search']['value']);

        $categories = Tools::getAllCategoryMappings(); // Returns an associative array [id => name]

        $searchQuery = "";
        if (!empty($searchValue)) {
           
            $matchingCategoryIds = [];
            foreach ($categories as $id => $name) {
                if (stripos($name, $searchValue) !== false) {
                    $matchingCategoryIds[] = $id;
                }
            }
            
            $categorySearch = !empty($matchingCategoryIds) 
                ? " OR categoryId IN (" . implode(",", $matchingCategoryIds) . ")" 
                : "";

            $searchQuery = "
            AND (
                productName LIKE '%$searchValue%'
                $categorySearch
            )";
        }

        $totalRecords = Product::getTotalWebsiteProducts();
        $totalRecordwithFilter = Product::getTotalWebsiteProductsWithFilter($searchQuery);
        $fetchRecords = Product::fetchWebsiteProductsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $categoryName = isset($categories[$record->categoryId]) ? $categories[$record->categoryId] : "Unknown";
            $data[] = array(
                "number"        => $no++,
                "image"   => Tools::displayImages($record->uuid),
                "productName"   => $record->productName,
                "categoryId"    => $categoryName,
                "action"        => Tools::productTableAction($record->productId),
            );
            
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }
    

}






