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


    public function addWebsiteProductForm() {
        $listCategories = Product::listCategories();
        $listSuppliers = Supplier::listSuppliers();
        $this->view("products/addWebsiteProductForm", [
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


    public function saveWebsiteProducts() {
        $productName = $_POST['productName'];
        $productCategory = $_POST['productCategory'];
        $price = $_POST['price'];
        $uuid = $_POST['uuid'];
        $description = $_POST['description'];
        Product::saveWebsiteProduct($productName, $productCategory, $price, $uuid, $description);
    }

    
    public function viewProduct() {
        $dbid = $_POST['dbid'];
        $productDetails = Product::productDetails($dbid);
        $this->view("products/viewProduct", 
            ['productDetails' => $productDetails]
        ); 
    }


    public function viewWebsiteProduct() {
        $dbid = $_POST['dbid'];
        $productDetails = Product::websiteProductDetails($dbid);
        $this->view("products/viewWebsiteProduct", 
            ['productDetails' => $productDetails]
        ); 
    }


    public function editProducts() {
        $dbid = $_POST['dbid'];
        $productDetails = Product::productDetails($dbid);
        $listCategories = Product::listCategories();
        $listSuppliers = Supplier::listSuppliers();
        $this->view("products/editProducts", 
            [
                'productDetails' => $productDetails,
                'listCategories' => $listCategories,
                'listSuppliers' => $listSuppliers
            ]
        ); 
        
    }


    public function editWebsiteProducts() {
        $dbid = $_POST['dbid'];
        $productDetails = Product::websiteProductDetails($dbid);
        $listCategories = Product::listCategories();
        $this->view("products/editWebsiteProducts", 
            [
                'productDetails' => $productDetails,
                'listCategories' => $listCategories
            ]
        ); 
        
    }

    
    public function deleteProduct() {
        $dbid = $_POST['dbid'];
        Product::deleteProduct($dbid);
    }


    public function deleteWebsiteProduct() {
        $dbid = $_POST['dbid'];
        Product::deleteWebsiteProduct($dbid);
    }


    public function uploadProductImage()
    {

        if (!defined('UPLOAD_PATH')) {
            define('UPLOAD_PATH', Tools::uploadPath); 
            /* define('UPLOAD_PATH', '/home/ahpcgh/public_html/ahpc/ahpcmis/public/uploads/'); */
        }        
    
        foreach ($_POST as $name => $value) {
            $$name = $value;
        }
    
        $name = $_FILES['Filedata']['name'];
        $type = $_FILES['Filedata']['type'];
        $size = $_FILES['Filedata']['size'];
        $uniqueuploadid = $_POST['randno'];
    
        $docdate = date("Y-m-d");
        $uploads = new Uploads();
        $uploads->filename = $_FILES['Filedata'];
        $uploads->target_dir = UPLOAD_PATH;
        $uploadresponse = $uploads->upLoadFile();
    
        if ($uploadresponse['status'] == 'SUCCESS') {
            $newname = $uploadresponse['filename'];
            Product::insertProductImage($newname,$name,$type,$size,$uniqueuploadid);
        } else {
            echo 'Error Uploading File';
        }
    }


    public function viewWebsiteProducts() {
        $listWebsiteProducts = Product::listWebsiteProducts();
        $this->view("products/viewWebsiteProducts",[
            'listWebsiteProducts' => $listWebsiteProducts
        ]); 
    }


}
 