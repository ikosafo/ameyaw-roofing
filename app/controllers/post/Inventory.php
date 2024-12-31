<?php

class Inventory extends PostController
{

    public function manageInventory() {
        $listProducts = Product::listProducts();
        $this->view("inventory/manageInventory",[
            'listProducts' => $listProducts
        ]); 
    }


    public function updateState() {
        $dbid = $_POST['dbid'];
        $productDetails = Product::productDetails($dbid);
        $this->view("inventory/updateState", 
            ['productDetails' => $productDetails]
        ); 
    }


    public function saveState() {
        $movementType = $_POST['movementType'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $productId = $_POST['productId'];
        $uuid = $_POST['uuid'];
        ProductInventory::saveState($movementType, $description, $quantity, $productId, $uuid);
    }


    public function viewInventory() {
        $listMovements = ProductInventory::listMovements();
        $this->view("inventory/listMovements", 
            ['listMovements' => $listMovements]
        ); 
    }


    public function listLowStock() {
        $listProducts = Product::listProducts();
        $this->view("inventory/listLowStock",[
            'listProducts' => $listProducts
        ]); 
    }
    
    
    
}
 