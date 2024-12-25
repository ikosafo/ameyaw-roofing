<?php

class Products extends PostController
{
   
    public function addCategories() {
        $this->view("products/addCategories"); 
    }

    public function editCategories() {
        $catid = $_POST['catid'];
        $categoryDetails = Product::categoryDetails($catid);
        $this->view("products/editCategories", 
            ['categoryDetails' => $categoryDetails]
        ); 
    }

    public function viewCategories() {
        $listCategories = Product::listCategories();
        $this->view("products/viewCategories",[
            'listCategories' => $listCategories
        ]); 
    }

    public function saveCategories()
    {
        $categoryName = $_POST['categoryName'];
        $uuid = $_POST['uuid'];
        Product::saveCategory($categoryName,$uuid);
    }

    public function deleteCategory() {
        $catid = $_POST['catid'];
        Product::deleteCategory($catid);
    }

    public function addProducts() {
        $listCategories = Product::listCategories();
        $listSuppliers = Supplier::listSuppliers();
        $this->view("products/addProducts", [
            'listCategories' => $listCategories,
            'listSuppliers' => $listSuppliers
        ]); 
    }

    public function listProducts() {
        $listProducts = Product::listProducts();
        $this->view("products/listProducts",[
            'listProducts' => $listProducts
        ]); 
    }

    public function saveProducts() {
        $productName = $_POST['productName'];
        $productCategory = $_POST['productCategory'];
        $thickness = $_POST['thickness'];
        $materialType = $_POST['materialType'];
        $color = $_POST['color'];
        $length = $_POST['length'];
        $width = $_POST['width'];
        $stockQuantity = $_POST['stockQuantity'];
        $price = $_POST['price'];
        $supplier = $_POST['supplier'];
        $uuid = $_POST['uuid'];
        Product::saveProduct($productName, $productCategory, $thickness, $materialType, $color, $length, $width, $stockQuantity, $price, $supplier, $uuid);
    }

    public function viewProduct() {
        $dbid = $_POST['dbid'];
        $productDetails = Product::productDetails($dbid);
        $this->view("products/viewProduct", 
            ['productDetails' => $productDetails]
        ); 
    }
}
 