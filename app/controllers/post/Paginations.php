<?php

class Paginations extends PostController
{
    public function listProducts()
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

        $totalRecords = Product::getTotalProducts();
        $totalRecordwithFilter = Product::getTotalProductsWithFilter($searchQuery);
        $fetchRecords = Product::fetchProductsRecords($searchQuery, $row, $rowperpage);

        $data = [];
        $no = $row + 1;
        foreach ($fetchRecords as $record) {
            $categoryName = isset($categories[$record->categoryId]) ? $categories[$record->categoryId] : "Unknown";
            $data[] = array(
                "number" => $no++,
                "productName" => $record->productName,
                "categoryId" => $categoryName,
                "materialType" => $record->materialType,
                "unitPrice" => $record->unitPrice,
                "stockQuantity" => $record->stockQuantity,
                "action" => Tools::productTableAction($record->productId),
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

    

}






