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
                "number" => ++$no,
                "productName" => $record->productName,
                "categoryId" => $categoryName . '<br><small>' . $record->materialType . '</small>',
                "dimensions" => '<small>Thickness: ' . $record->thickness . ' mm<br>Length: ' . $record->length . ' m<br>Width: ' . $record->width . ' m</small>',
                "stockQuantity" => $record->stockQuantity,
                "supplier" => $record->supplierId,
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




}






